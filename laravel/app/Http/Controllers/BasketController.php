<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $basket = session()->get('basket', []);
        return view('basket', compact('basket'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $basket = session()->get('basket', []);

        if (isset($basket[$id])) {
            $basket[$id]['quantity']++;
        } else {
            $basket[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('basket', $basket);
        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    public function remove($id)
    {
        $basket = session()->get('basket', []);
        if (isset($basket[$id])) {
            unset($basket[$id]);
            session()->put('basket', $basket);
        }

        return redirect()->back()->with('success', 'Товар удален из корзины.');
    }

    public function clear()
    {
        session()->forget('basket');
        return redirect()->back()->with('success', 'Корзина очищена.');
    }
}
