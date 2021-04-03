<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::with('photos')->whereId($id)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return back();

    }

    public function removeItem(Request $request, $id)
    {
        $product = Product::FindOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($product, $product->id);
        $request->session()->put('cart', $cart);
        return back();

    }

    public function getCart()
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        return view('Frontend.cart.index',compact(['cart']));
    }
}
