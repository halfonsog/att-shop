<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransporterController extends Controller
{
    public function dashboard()
    {
        // Add any customer-specific data here
        return view('transporter/dashboard');
    }
}
