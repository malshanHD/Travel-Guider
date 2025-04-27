<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    //
    public function pay()
    {
        // Payment details
        $payment = [
            'merchant_id' => env('PAYHERE_MERCHANT_ID'),
            'return_url' => url('/payment/success'),
            'cancel_url' => url('/payment/cancel'),
            'notify_url' => url('/payhere/callback'),
            'order_id' => uniqid(),
            'items' => 'Test Item',
            'currency' => 'LKR',
            'amount' => '1000.00',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '0771234567',
            'address' => 'No. 1, Galle Road',
            'city' => 'Colombo',
            'country' => 'Sri Lanka',
        ];

        // Log payment details
        Log::info('Payment details', $payment);

        // Construct redirect URL
        $query = http_build_query(array_map('urlencode', $payment));
        $url = 'https://sandbox.payhere.lk/pay/checkout?' . $query;

        // Log redirect URL
        Log::info('Redirect URL', ['url' => $url]);

        // Output URL for manual testing
        echo '<a href="' . $url . '" target="_blank">Click here to test redirect</a>';
    }

    public function callback(Request $request)
    {
        $customerId = $request->query('order_id');

        // Find the customer by ID
        $customer = Customer::find($customerId);

        if ($customer) {
            // Update the activate column to true
            $customer->active_status = true;
            $customer->save();

            return view('User.Invoice', compact('customer', 'customerId'));
            
            return redirect('/home')->with('success', 'Customer activated successfully');

        } else {
            // Redirect to /home with an error message if the customer is not found
            return redirect('/home')->with('error', 'Customer not found');
        }
    }

    public function downloadinvoice($customerId){
        $customer = Customer::find($customerId);
        $pdf = Pdf::loadView('User.invoice-pdf', compact('customer', 'customerId'));
        return $pdf->download('invoice_' . $customerId . '.pdf');
    }
}
