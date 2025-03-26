<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
{
    
    $products = DB::select("SELECT * FROM products");
    return view('products.index', compact('products'));
}

    public function search(Request $request)
    {
        $searchTerm = $request->input('q', '');
        
        $products = DB::select("
            SELECT id, name, price, image_path 
            FROM products 
            WHERE name LIKE ? OR description LIKE ?
            ORDER BY name
        ", ["%{$searchTerm}%", "%{$searchTerm}%"]);
        
        return view('products/list', [
            'products' => $products,
            'searchTerm' => $searchTerm
        ]);
    }

    public function show($id)
    {
        $product = DB::selectOne("
            SELECT * FROM products WHERE id = ?
        ", [$id]);
        
        if (!$product) {
 //           abort(404); // Show 404 page if product not found
            header("HTTP/1.0 404 Not Found");
            return require_once resource_path('views/errors/404.php');
        }
        
        return view('products/detail', ['product' => $product]);
    }

    public function manage()
    {
        if (session('user_type') !== 'supplier') {
            abort(403);
        }

        $supplierId = session('user_id');
        $products = DB::select("
        SELECT * FROM products 
        WHERE supplier_id = ?
        ORDER BY name
    ", [$supplierId]);

        return view('products/manage', ['products' => $products]);
    }

    public function create()
    {
        if (session('user_type') !== 'supplier') {
            abort(403);
        }

        return view('products/create');
    }

    public function store(Request $request)
    {
        if (session('user_type') !== 'supplier') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::insert("
        INSERT INTO products (name, description, price, image_path, supplier_id)
        VALUES (?, ?, ?, ?, ?)
    ", [
            $request->name,
            $request->description,
            $request->price,
            $imagePath,
            session('user_id')
        ]);

        return redirect('/products/manage')->with('success', 'Product added!');
    }
}
