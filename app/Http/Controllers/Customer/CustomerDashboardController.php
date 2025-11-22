<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CustomerDashboardController extends Controller
{
    // Dashboard view
    public function index()
    {
        return view('customer.dashboard');
    }

    // Show customer orders
//     public function orders()
//     {
//         $user = Auth::user(); // Get the logged-in customer

//         // Fetch orders for this customer
//         $orders = Order::where('user_id', $user->id)
//             ->orderBy('created_at', 'desc')
//             ->get(); // Returns Eloquent collection

//         return view('customer.orders', compact('orders'));
//     }
// }



public function orders()
{
    // For testing: fetch all orders regardless of user
    $orders = Order::orderBy('created_at', 'desc')->get();

    // Optional: mark if user is not logged in
    $loggedIn = Auth::check();

    return view('customer.orders', compact('orders', 'loggedIn'));
}
}