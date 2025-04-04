<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = DB::select("SELECT * FROM suppliers ORDER BY name");
        return view('suppliers/index', ['suppliers' => $suppliers]);
    }

    public function pendingApproval()
    {
        $suppliers = DB::select("SELECT * FROM suppliers WHERE is_approved=0");
        return $suppliers;
    }

    public function show($id)
    {
        $supplier = DB::selectOne("SELECT * FROM suppliers WHERE id = ?", [$id]);
        
        if (!$supplier) {
            abort(404);
        }
        
        $products = DB::select("
            SELECT * FROM products 
            WHERE supplier_id = ?
            ORDER BY name
        ", [$id]);
        
        return view('suppliers/show', [
            'supplier' => $supplier,
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('suppliers/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string'
        ]);
        
        DB::insert("
            INSERT INTO suppliers (name, contact_email, phone, address)
            VALUES (?, ?, ?, ?)
        ", [
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('address')
        ]);
        
        return redirect('/suppliers')->with('success', 'Supplier added!');
    }

    public function commissions($supplierId){
    if (session('auth.role') !== 'admin' && session('auth.ent_id') != $supplierId) {
        abort(403);
    }
    
    $commissions = DB::select("
        SELECT c.*, o.id as order_id, o.created_at as order_date
        FROM commissions c
        JOIN orders o ON c.order_id = o.id
        WHERE c.supplier_id = ?
        ORDER BY c.status, o.created_at DESC
    ", [$supplierId]);
    
    $supplier = DB::selectOne("SELECT name FROM suppliers WHERE id = ?", [$supplierId]);
    
    return view('suppliers/commissions', [
        'commissions' => $commissions,
        'supplier' => $supplier
    ]);
}
}
