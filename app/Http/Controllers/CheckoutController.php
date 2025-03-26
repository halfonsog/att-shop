<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $sessionId = session()->getId();

        $cartItems = DB::select("
            SELECT p.id, p.name, p.price, ci.quantity
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.session_id = ?
        ", [$sessionId]);

        return view('checkout', ['items' => $cartItems]);
    }

    public function placeOrder(Request $request)
    {
        $sessionId = session()->getId();

        // Validate input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100'
        ]);

        // Calculate total
        $cartItems = DB::select("
            SELECT p.id, p.price, ci.quantity
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.session_id = ?
        ", [$sessionId]);

        $total = array_sum(array_map(function ($item) {
            return $item->price * $item->quantity;
        }, $cartItems));

        // Create order
        DB::beginTransaction();

        try {
            $orderId = DB::table('orders')->insertGetId([
                'customer_name' => $request->input('name'),
                'customer_email' => $request->input('email'),
                'total' => $total,
                'created_at' => now()
            ]);

            foreach ($cartItems as $item) {
                DB::insert("
                    INSERT INTO order_items (order_id, product_id, quantity, price)
                    VALUES (?, ?, ?, ?)
                ", [$orderId, $item->id, $item->quantity, $item->price]);
            }

            // Clear cart
            DB::delete("DELETE FROM cart_items WHERE session_id = ?", [$sessionId]);

            DB::commit();

            return view('order_confirmation', ['orderId' => $orderId]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }

        // In placeOrder method, after creating the order:
        $orderItems = DB::select("
            SELECT p.id, p.supplier_id, oi.quantity, oi.price
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
            ", [$orderId]);

        $commissionRate = 0.15; // 15% commission

        foreach ($orderItems as $item) {
            $supplierAmount = $item->price * $item->quantity * (1 - $commissionRate);
            $commissionAmount = $item->price * $item->quantity * $commissionRate;

            DB::insert("
            INSERT INTO commissions (order_id, supplier_id, amount) VALUES (?, ?, ?)", [$orderId, $item->supplier_id, $commissionAmount]);

            // Update order totals
            DB::update("
    UPDATE orders 
    SET commission = commission + ?,
        supplier_payment = supplier_payment + ?
    WHERE id = ?
", [$commissionAmount, $supplierAmount, $orderId]);
        }
    }
}
