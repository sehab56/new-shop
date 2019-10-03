<?php

namespace App\Http\Controllers;
use App\product;
use Cart;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function addToCart(Request $request){
        $product = product::find($request->id);

        Cart::add([
            'id'=>$request->id,
            'name'=>$product->product_name,
            'price'=>$product->product_price,
            'quantity'=>$request->qty,
            'attributes'=>[
                'image' => $product->product_image
             ]
        ]);
        return redirect('/card/show');
    }
    public function showCart(){
        $cartProducts = Cart::getContent();
//        return $cartProducts;
        return view('front-end.cart.show-cart',['cartProducts'=>$cartProducts ]);
    }

    public function deleteCardItem($id){
         Cart::remove($id);
         return redirect('/card/show');
    }
    public function updateCart(Request $request){
//        return $request->all();
        Cart::update($request->id,['quantity'=>$request->quantity] );
        return redirect('/card/show');

    }

}
