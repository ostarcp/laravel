<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderEmail;
use Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('backend.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
    
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'zipcode' => 'numeric',
            'email' => 'required|email',
            'phone' => ['required','regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'address' => 'required'
                 
        ]);
        //dd($data);
       
       $order = new Order();

       $order->order_number = uniqid('Ord-');

       $order->first_name = $data['first_name'];
       $order->last_name = $data['last_name'];
       $order->address = $data['address'];
       $order->zipcode = $data['zipcode'];
       $order->email = $data['email'];
       $order->phone = $data['phone'];

       $order->grand_total = \Cart::session(auth()->id())->getTotal();
       $order->item_count = \Cart::session(auth()->id())->getContent()->count();
       $order->status = 'pending';
       $order->user_id = auth()->id();

       $order->save();

       // Save orderItems

            $cartItems = \Cart::session(auth()->id())->getContent();

            foreach($cartItems as $item){
                $order->products()->attach($item->id, ['price'=>$item->price, 'quantity'=>$item->quantity ]);
            }
       //Empty Cart
        \Cart::session(auth()->id())->clear();


       // send mail
         Mail::to($order->email)->send(new NewOrderEmail($order));

         return redirect()->route('cart.index')->with('msg','Tks u for Order');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('backend.orders.detail-order',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {      
      if(Gate::denies('edit')){
        abort(403,'Bạn ko có quyền này nhé ');
     }
        return view('backend.orders.edit-order',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if(Gate::denies('edit')){
            abort(403,'Bạn ko có quyền này nhé ');
        }

        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'zipcode' => 'numeric',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'item_count' =>'required|numeric',
            'grand_total' => 'required'
                 
        ]);

        //dd($data);

        $order->update(array_merge(
            $data,
        ));

        return redirect()->route('admin.order.index')->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if(Gate::denies('delete')){
            abort(403,'Bạn ko có quyền này nhé ');
         }
        $order->delete();

        return redirect()->route('admin.order.index')->with('status','Deleted!');
    }
}
