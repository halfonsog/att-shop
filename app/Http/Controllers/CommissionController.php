<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    public function index()
    {
        if (session('user_type') !== 'admin') {
            abort(403);
        }

        $commissions = DB::select("
            SELECT c.*, s.name as supplier_name, o.id as order_id
            FROM commissions c
            JOIN suppliers s ON c.supplier_id = s.id
            JOIN orders o ON c.order_id = o.id
            ORDER BY c.status, o.created_at DESC
        ");

        return view('commissions/index', ['commissions' => $commissions]);
    }

    public function markAsPaid($id)
    {
        if (session('user_type') !== 'admin') {
            abort(403);
        }

        DB::transaction(function () use ($id) {
            $commission = DB::selectOne("SELECT * FROM commissions WHERE id = ?", [$id]);

            DB::update("
                UPDATE commissions 
                SET status = 'paid', payment_date = NOW()
                WHERE id = ?
            ", [$id]);

            DB::update("
                UPDATE orders
                SET supplier_payment = ?
                WHERE id = ?
            ", [$commission->amount, $commission->order_id]);
        });

        return back()->with('success', 'Commission marked as paid');
    }

    public function processMonthlyPayments()
    {
        if (session('user_type') !== 'admin') {
            abort(403);
        }

        $result = DB::transaction(function () {
            // Get all pending commissions
            $commissions = DB::select("
            SELECT c.*, s.bank_account
            FROM commissions c
            JOIN suppliers s ON c.supplier_id = s.id
            WHERE c.status = 'pending'
        ");

            // Process each commission
            foreach ($commissions as $commission) {
                // In a real system, you would integrate with a payment API here
                $paymentSuccess = true; // Simulate successful payment

                if ($paymentSuccess) {
                    DB::update("
                    UPDATE commissions 
                    SET status = 'paid', payment_date = NOW()
                    WHERE id = ?
                ", [$commission->id]);

                    // Record the payment in a payments table (would need to create this)
                    DB::insert("
                    INSERT INTO supplier_payments 
                    (supplier_id, amount, commission_ids, payment_date)
                    VALUES (?, ?, ?, NOW())
                ", [
                        $commission->supplier_id,
                        $commission->amount,
                        $commission->id
                    ]);
                }
            }

            return count($commissions);
        });

        return redirect('/commissions')->with('success', "Processed $result payments");
    }
}
