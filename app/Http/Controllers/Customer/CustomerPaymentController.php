<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Order;

class CustomerPaymentController extends Controller
{
    /**
     * Show the Buy Products page
     */
public function buy()
{
    $products = [
        [
            'id' => 1,
            'name' => 'iPhone 15 Pro',
            'description' => 'Latest Apple iPhone 15 Pro with amazing camera and performance.',
            'price' => 150000,
            'image' => asset('storage/uploads/products/iphone15.jpeg'),
        ],
        [
            'id' => 2,
            'name' => 'Samsung Galaxy S23',
            'description' => 'High-performance Android smartphone with sleek design.',
            'price' => 95000,
            'image' => asset('storage/uploads/products/galaxyS23.jpeg'),
        ],
        [
            'id' => 3,
            'name' => 'Dell XPS 13 Laptop',
            'description' => 'Powerful ultrabook for work and gaming with excellent battery life.',
            'price' => 1,
            'image' => asset('storage/uploads/products/dellxps13.jpeg'),
        ],
    ];

    return view('customer.buy', compact('products'));
}



    

    /**
     * Process M-Pesa STK Push Payment
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:12', 
            'amount' => 'required|numeric|min:1',
            'product_name' => 'required|string|max:255',
        ]);

        $phone = $request->phone;
        $amount = $request->amount;
        $productName = $request->product_name;

        // Save product name temporarily in session
        session(['product_name' => $productName]);

        // M-Pesa credentials
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $shortcode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $callbackUrl = env('MPESA_CALLBACK_URL');
        $envType = env('MPESA_ENV', 'sandbox');

        $urls = [
            'sandbox' => [
                'token' => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
                'stk'   => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
            ],
            'live' => [
                'token' => 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
                'stk'   => 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
            ]
        ];

        try {
            // Generate OAuth token
            $credentials = base64_encode($consumerKey . ':' . $consumerSecret);
            $tokenResponse = Http::withHeaders([
                'Authorization' => 'Basic ' . $credentials
            ])->get($urls[$envType]['token']);

            $accessToken = $tokenResponse->json()['access_token'] ?? null;

            if (!$accessToken) {
                \Log::error('Failed to get M-Pesa access token', ['response' => $tokenResponse->json()]);
                return back()->with('error', 'Unable to connect to M-Pesa. Check credentials.');
            }

            $timestamp = date('YmdHis');
            $password = base64_encode($shortcode . $passkey . $timestamp);

            // STK Push request
            $stkResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ])->post($urls[$envType]['stk'], [
                'BusinessShortCode' => $shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone,
                'PartyB' => $shortcode,
                'PhoneNumber' => $phone,
                'CallBackURL' => $callbackUrl,
                'AccountReference' => 'OrderPayment',
                'TransactionDesc' => 'Payment for order'
            ]);

            $stkData = $stkResponse->json();
            \Log::info('STK Push Response', $stkData);

            if (isset($stkData['ResponseCode']) && $stkData['ResponseCode'] === '0') {
                return back()->with('status', 'Payment request sent! Check your phone.');
            }

            return back()->with('error', 'STK Push failed: ' . ($stkData['errorMessage'] ?? 'Check logs'));

        } catch (\Exception $e) {
            \Log::error('M-Pesa STK Push Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Handle M-Pesa Callback
     */
    // public function mpesaCallback(Request $request)
    // {
    //     $data = $request->all();
    //     \Log::info('M-Pesa Callback:', $data);

    //     if (isset($data['Body']['stkCallback']['ResultCode']) && $data['Body']['stkCallback']['ResultCode'] == 0) {
    //         $items = $data['Body']['stkCallback']['CallbackMetadata']['Item'];

    //         $amount = $items[0]['Value'] ?? null;
    //         $mpesaReceipt = $items[1]['Value'] ?? null;
    //         $phone = $items[4]['Value'] ?? null;

    //         // Save payment
    //         Payment::create([
    //             'phone' => $phone,
    //             'amount' => $amount,
    //             'receipt_number' => $mpesaReceipt,
    //             'status' => 'paid'
    //         ]);

    //         // Save order for logged-in user
    //         if (Auth::check()) {
    //             Order::create([
    //                 'product_name' => session('product_name') ?? 'Unknown Product',
    //                 'amount' => $amount,
    //                 'status' => 'completed',
    //                 'user_id' => Auth::id(),
    //             ]);

    //             session()->forget('product_name');
    //         }
    //     }

    //     return response()->json(['status' => 'success']);
    // }


public function mpesaCallback(Request $request)
{
    $data = $request->all();
    \Log::info('M-Pesa Callback:', $data);

    if (isset($data['Body']['stkCallback'])) {
        $callback = $data['Body']['stkCallback'];
        $resultCode = $callback['ResultCode'];
        $resultDesc = $callback['ResultDesc'];

        if ($resultCode == 0) {
            // Payment successful
            $items = $callback['CallbackMetadata']['Item'];
            $amount = $items[0]['Value'] ?? null;
            $mpesaReceipt = $items[1]['Value'] ?? null;
            $phone = $items[4]['Value'] ?? null;

            Payment::create([
                'phone' => $phone,
                'amount' => $amount,
                'receipt_number' => $mpesaReceipt,
                'status' => 'paid'
            ]);

            if (Auth::check()) {
                Order::create([
                    'product_name' => session('product_name') ?? 'Unknown Product',
                    'amount' => $amount,
                    'status' => 'completed',
                    'user_id' => Auth::id(),
                ]);

                session()->forget('product_name');
            }

        } else {
            // Payment failed / canceled
            Payment::create([
                'phone' => $callback['PhoneNumber'] ?? null,
                'amount' => 0,
                'receipt_number' => null,
                'status' => 'cancelled', // or 'failed'
            ]);
        }
    }

    return response()->json(['status' => 'success']);
}




    /**
     * Show My Orders
     */
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('customer.orders', compact('orders'));
    }

/**
 * Check payment status by phone number
 */
public function checkPaymentStatus(Request $request)
{
    $request->validate([
        'phone' => 'required|digits:12',
    ]);

    $phone = $request->phone;

    // Get all payments for this phone
    $payments = Payment::where('phone', $phone)
                        ->orderBy('created_at', 'desc')
                        ->get();

    if ($payments->isEmpty()) {
        return back()->with('error', 'No payments found for this phone number.');
    }

    return view('customer.check-payment', compact('payments', 'phone'));
}
}