<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
  public function add(Request $request)
  {
    $auth = session('auth');
    if(!$auth){
      return redirect('/login')->with('error', 'Por favor inicie sesión');
    }
    if ($auth['role'] !== 'customer') {
      abort(403, 'Su usuario no tiene permitido hacer compras');
    }

    $productId = $request->input('product_id');
    $sessionId = session()->getId();

    // Check if product exists
    $product = DB::selectOne("SELECT id FROM products WHERE id = ?", [$productId]);

    if (!$product) {
      return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    // Add to cart
    DB::insert("
            INSERT INTO cart_items (session_id, product_id, quantity)
            VALUES (?, ?, 1)
            ON DUPLICATE KEY UPDATE quantity = quantity + 1
        ", [$sessionId, $productId]);

    return response()->json(['success' => true]);
  }

  public function view()
  {
    $sessionId = session()->getId();

    $cartItems = DB::select("
            SELECT p.id, p.name, p.price, ci.quantity, (p.price * ci.quantity) as total
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.session_id = ?
        ", [$sessionId]);

    $grandTotal = array_sum(array_column($cartItems, 'total'));

    return view('cart_view', [
      'items' => $cartItems,
      'total' => $grandTotal
    ]);
  }


  public function update(Request $request)
  {
    $sessionId = session()->getId();
    $productId = $request->input('product_id');
    $quantity = max(1, (int)$request->input('quantity')); // Ensure at least 1

    DB::update("
        UPDATE cart_items 
        SET quantity = ?
        WHERE session_id = ? AND product_id = ?
    ", [$quantity, $sessionId, $productId]);

    return redirect('/cart');
  }

  public function remove(Request $request)
  {
    $sessionId = session()->getId();
    $productId = $request->input('product_id');

    DB::delete("
        DELETE FROM cart_items
        WHERE session_id = ? AND product_id = ?
    ", [$sessionId, $productId]);

    return redirect('/cart');
  }
}
