<?php

namespace App\Http\Controllers\Admin;
use App\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct(){
       return $this->middleware('auth');
    }


    public function add(Product $product){
       // dd($product);
       
        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributess' => array(),
            'associatedModel' => $product
        ));
       
        return redirect()->route('cart.index');

    }     
    
    public function index(){
        $cart = \Cart::session(auth()->id())->getContent();
        $cartItems = $cart->sortByDesc('quantity');
        //dd($cartItems);
     
        return view('frontend.cart',compact('cartItems'));  
    }

    public function destroy($itemId){
        \Cart::session(auth()->id())->remove($itemId);
        return back();  
    }

    public function update($rowId){
       // dd(request('quantity'));

         $quanity = request('quantity');

        if($quanity != 0){
            \Cart::session(auth()->id())->update($rowId,[
                'quantity'=> array(
                    'relative' => false,
                     'value' => request('quantity'),
                )
            ]);
        }else{
            return $this->destroy($rowId);
        }
      
        return back();  
}

        public function checkout(){
           
            $cart = \Cart::session(auth()->id())->getContent();
            $cartItems = $cart->sortByDesc('quantity');

            if($cart->count() ==0){
                return redirect()->route('cart.index')->with('status','You should add something to your cart');
            }
            return view('frontend.check-out',compact('cartItems'));
        }
   
}
