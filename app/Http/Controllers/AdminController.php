<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Middleware already verified admin access
        $stats = [
//            'pending_products' => app(ProductController::class)->pendingApproval(),
            'pending_suppliers' => app(SupplierController::class)->pendingApproval()
        ];

        return view('admin.dashboard', ['stats' => $stats]);
    }

}