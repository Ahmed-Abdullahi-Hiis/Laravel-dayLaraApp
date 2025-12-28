<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerPaymentController extends Controller
{
    /**
     * Trigger M-Pesa STK Push
     */
    public function stkPush(Request $request)
    {
        try {
            // Validate incoming request
            $request->validate([
                'phone' => 'required|string',
                'amount' => 'required|numeric|min:1',
            ]);

            $phone = $request->phone;
            $amount = $request->amount;

            // M-Pesa credentials
            $consumerKey = env('MPESA_CONSUMER_KEY');
            $consumerSecret = env('MPESA_CONSUMER_SECRET');
            $shortCode = env('MPESA_SHORTCODE'); // e.g., 174379
            $passkey = env('MPESA_PASSKEY');     // Lipa Na M-Pesa Online Passkey

            // Generate timestamp
            $timestamp = now()->format('YmdHis');
            $password = base64_encode($shortCode . $passkey . $timestamp);

            // Get access token
            $tokenResponse = Http::withBasicAuth($consumerKey, $consumerSecret)
                ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

            if (!$tokenResponse->successful()) {
                Log::error('STK Push: Failed to get access token', ['response' => $tokenResponse->body()]);
                return response()->json(['error' => 'Failed to get access token'], 500);
            }

            $accessToken = $tokenResponse['access_token'];

            // STK Push request payload
            $payload = [
                'BusinessShortCode' => $shortCode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone,
                'PartyB' => $shortCode,
                'PhoneNumber' => $phone,
                'CallBackURL' => env('MPESA_CALLBACK_URL'), // e.g., your Ngrok HTTPS URL
                'AccountReference' => 'TestPayment',
                'TransactionDesc' => 'Payment for goods'
            ];

            Log::info('STK Push Payload', $payload);

            // Send STK Push request
            $response = Http::withToken($accessToken)
                ->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', $payload);

            // Log response
            Log::info('STK Push Response', ['response' => $response->body()]);

            if ($response->successful()) {
                return response()->json(['message' => 'STK Push initiated', 'data' => $response->json()]);
            } else {
                return response()->json([
                    'error' => 'STK Push failed',
                    'details' => $response->body()
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('STK Push Exception', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }
}
