<?php
 
namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use Auth;
use Crypt;
use Exception;

use App\Models\MProducts\MProducts;

class CartController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $carts = session()->get('cart', []);
            return view('front.cart.index', [
                'carts' => $carts
            ]);    
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $product = MProducts::findOrFail(Crypt::decryptString($request->id));
            $cart    = session()->get('cart', []);
    
            if (isset($cart[Crypt::decryptString($request->id)]))
            {
                $cart[Crypt::decryptString($request->id)]['quantity']++;
            }
            else
            {
                $cart[Crypt::decryptString($request->id)] = [
                    'id'        => Crypt::decryptString($request->id),
                    'name'      => $product->name,
                    'code'      => $product->code,
                    'price'     => $product->price,
                    'currency'  => $product->currency,
                    'discount'  => $product->discount,
                    'dimension' => $product->dimension,
                    'unit'      => $product->unit,
                    'thumbnail' => $product->thumbnail,
                    'quantity'  => 1
                ];
            }
            
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $cart = session()->get('cart');
        if(isset($cart[Crypt::decryptString($request->id)]))
        {
            unset($cart[Crypt::decryptString($request->id)]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed successfully');
    }
}