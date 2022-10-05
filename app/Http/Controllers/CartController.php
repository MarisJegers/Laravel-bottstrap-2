<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe;
use Auth;

class CartController extends Controller
{
    
    public function index()
    {
        $intent = auth()->user()->createSetupIntent();
        $products = [];
        $totalArr = [];
        $total = 0;
        foreach (auth()->user()->cart->pluck('product_id') as $prod_id) {
            $products[] = Product::where('id', $prod_id)->first();
            $totalArr[] = Product::where('id', $prod_id)->get()->pluck('price')->first();
        }
        $total = array_reduce($totalArr, function($initial, $value){
             return $initial + $value;
            }, 0);
        return view('cart', [
            'cart' => $products,
            'total' => $total
        ], compact('intent'));
    }

    public function remove($id)
    {
        Cart::where('user_id', auth()->id())->where('product_id', $id)->delete();
        return back();
    }

    public function purchase(Request $request)
    {
           

        $user          = Auth::user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($request->total, $paymentMethod);        
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', 'Product purchased successfully!');


        //$request->user()->charge($request->total, $request->stripeToken);
        //Cart::where('user_id', auth()->id())->delete();
            //return redirect()->route('home');
    }

    public function pirkt(){
        return view('pirkt');
    }

    public function charge(String $product, $price)
    {
        $user = Auth::user();
        return view('payment',[
        'user'=>$user,
        'intent' => $user->createSetupIntent(),
        'product' => $product,
        'price' => $price
        ]);
    }

    public function processPayment(Request $request, String $product, $price)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        try
        {
        $user->charge($price*100, $paymentMethod);
        }
        catch (\Exception $e)
        {
        return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect('home');
    }



}
