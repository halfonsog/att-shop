<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Check admin auth (we'll implement this properly later)
/*        
        if (!isset($_SESSION['usr'])) {
            return redirect('/login')->with('error', 'Restricted access');
        } else if($_SESSION['usr']->role !== 'admin') {
            abort(403, 'Admin access required');
        }
*/    
        $stats = [
//            'pending_products' => app(ProductController::class)->pendingApproval(),
            'pending_suppliers' => app(SupplierController::class)->pendingApproval()
        ];

        return view('admin.dashboard', ['stats' => $stats]);
    }

}