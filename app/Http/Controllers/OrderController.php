<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        if (session('user_type') !== 'admin') {
            abort(403);
        }
        
        $orders = DB::select("
            SELECT o.*, COUNT(oi.id) as item_count
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            GROUP BY o.id
            ORDER BY o.created_at DESC
        ");
        
        return view('orders/index', ['orders' => $orders]);
    }

    public function show($id)
    {
        if (session('user_type') !== 'admin') {
            abort(403);
        }
        
        $order = DB::selectOne("SELECT * FROM orders WHERE id = ?", [$id]);
        $items = DB::select("
            SELECT oi.*, p.name
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
        ", [$id]);
        
        return view('orders/show', [
            'order' => $order,
            'items' => $items
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        if (session('user_type') !== 'admin') {
            abort(403);
        }
        
        DB::update("
            UPDATE orders 
            SET status = ?
            WHERE id = ?
        ", [$request->status, $id]);
        
        return back()->with('success', 'Order updated');
    }
}
