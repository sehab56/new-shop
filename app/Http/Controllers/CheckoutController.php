<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Payment;
use App\Shipping;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function index(){
        return view('front-end.checkout.checkout-content');
    }
     public function registration(Request $request){
        $this->validate($request,[
            'email_address'=>'email|unique:customers,email_address'
        ]);
        $customer = new Customer();
        $customer->first_name    = $request->first_name;
        $customer->last_name     = $request->last_name;
        $customer->email_address = $request->email_address;
        $customer->password      = bcrypt($request->password);
        $customer->phone_number  = $request->phone_number;
        $customer->address       = $request->address;
        $customer->save();

        $customerId = $customer->id;
        Session::put('customerId', $customerId);
        Session::put('customerName', $customer->first_name.' '.$customer->last_name);

        $data = $customer->toArray();
        Mail::send('front-end.mails.contfirmation-mail',$data, function($message) use ($data){
            $message->to($data['email_address']);
            $message->subject('contfirmation-mail');
        });
        return redirect('/checkout/shipping');
    }

    public function customerLoginCheck(Request $request){
       $customer = Customer::where('email_address',$request->email_address)->first();
       if ( password_verify($request->password, $customer->password )){

           Session::put('customerId', $customer->id);
           Session::put('customerName', $customer->first_name.' '.$customer->last_name);
           return redirect('/checkout/shipping');

       }else{
           return redirect('/card/checkout')->with('message', 'Password does not exist');
       }

    }

    public function customerLogoutInfo(){
        Session::forget('customerId');
        Session::forget('customerName');
        return redirect('/');

    }

    public function customerLoginInfo (){
        return view('front-end.customer.customer-login');

    }

    public function shippingForm(){
        $customer = Customer::find(Session::get('customerId'));
//        return $customer;
        return view('front-end.checkout.shipping',['customer'=>$customer]);
    }
    public function saveShippingInfo(Request $request){
        $shipping = new Shipping();
        $shipping->full_name     = $request->full_name;
        $shipping->email_address = $request->email_address;
        $shipping->phone_number  = $request->phone_number;
        $shipping->address       = $request->address;
        $shipping->save();

        $shippingId = $shipping->id;
        Session::put('shippingId', $shippingId);

        return redirect('/checkout/payment');
    }

    public function ShippingPaymentInfo(){
        return view('front-end.checkout.payment');
    }

    public function newOrder(Request $request){
//        return $request->all();
        $paymentType = $request->payment_type;
        if ($paymentType =='Cash' ){
            $order = new Order();
            $order->customer_id = Session::get('customerId');
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = Session::get('orderTotal');
            $order->save();
//          return $order;

            $payment = new Payment();
            $payment->order_id     = $order->id;
            $payment->payment_type = $paymentType;
            $payment->save();

            $cartProducts = Cart::getContent();
//          return $cartProducts;
            foreach ($cartProducts as $cartProduct){
                $orderDetail                    = new OrderDetail();
                $orderDetail->order_id          = $order->id;
                $orderDetail->product_id        = $cartProduct->id;
                $orderDetail->product_name      = $cartProduct->name;
                $orderDetail->product_price     = $cartProduct->price;
                $orderDetail->product_quantity  = $cartProduct->quantity;
                $orderDetail->save();
            }
            Cart::clear();

            return redirect('/complete/order');

        }else if($paymentType =='Paypal'){

        }else if ($paymentType =='BKash'){

        }
    }

    public function completeOrder(){
        return 'success';
    }
}
