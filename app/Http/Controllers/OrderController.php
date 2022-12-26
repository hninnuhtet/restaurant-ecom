<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('order.index', ['products'=>$products, 'categories'=>$categories]);
    }

    public function cart()
    {
        if(session('cart')){
            return view('order.cart');
        }else{
            return redirect()->route('index');
        }
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->gallery,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function ordercreate(){
        if(session('cart')){
            return view('order.create');
        }else{
            return redirect()->route('index');
        }
    }

    public function orderstore(Request $request){
        if(session('cart')){
            $request->validate([
                'name'=>'required',
                'phone'=>'required',
                'address'=>'required',
            ]);

            $cart = session()->get('cart');

            $total = 0;
            foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
            }

            $customer = Customer::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'address'=>$request->address,
            ]);

            $order = Order::create([
                'order_code'=>mt_rand(1000000000, 9999999999).'_'.$customer->phone,
                'customer_id'=>$customer->id,
                'total_price'=>$total,
            ]);

            foreach($cart as $index=>$item){
                OrderDetail::create([
                    'order_id'=>$order->id, 
                    'product_id'=>$index,  //product_id is saved as index of cart array in session
                    'quantity'=>$item['quantity'],
                ]);
            }

            return redirect()->route('receipt', ['id'=>$order->id]);
        }else{
            return redirect()->route('index');
        }
    }

    public function receipt($id){        
        if(session('cart')){
            $order = Order::findOrFail($id);
            $cart = session()->get('cart');  
            session()->forget('cart'); //delete cart session

            return view('order.receipt', ['order'=>$order, 'cart'=>$cart]);
        }else{
            return redirect()->route('index');
        }
    }

    
}
