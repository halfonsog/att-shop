<?php

namespace App\Http\Controllers;

class CustomerController extends Controller
{
    public function dashboard()
    {
        // Add any customer-specific data here
        return view('customer/dashboard');
    }
}