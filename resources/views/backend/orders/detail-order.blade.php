@extends('layouts.admin-master')
@section('title', 'Detail Order')
@section('danh_muc','Detail Hoá Đơn')
@section('content')

<div class="container">
    
<div class="invoice border p-4">
    <div class="row">
        <div class="col-9">
            <h2>Ostar Fashion Shop</h2>
        </div>
        <div class="col-3">
            <h3 class="text-warning">Invoice</h3>
        </div>
    </div>

    <div class="row p-2">
        <div class="col-9">
            <p>60-49 Road 11378</p>
            <p>Bakors Street</p>
            <p>New York, IL 60411</p>
        </div>
        <div class="col-3">
        <p class="text-danger">#{{$order->order_number}}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="bill-to col-12">
            <h4 class="text-warning">Bill To:</h4>
            <div class="bill-detail-name p-2">
                <p>Name: {{$order->first_name}} {{$order->last_name}}</p>
                <p>Address: {{$order->address}}</p>
                <p>Email: {{$order->email}}</p>
                <p>Phone: {{$order->phone}}</p>
            </div>
            
        </div>
    </div>

    <div class="row mt-4">
        <div class="invoice-date col-4">
            <h4 class="text-warning">Invoice Date:</h4>
            <p class="p-2">Create at: {{$order->created_at}}</p>
        </div>

        <div class="col-4">
            <h4 class="text-warning">Terms</h4>
            <p class="p-2">30 Days</p>
        </div>

        <div class="invoice-status col-4">
            <h4 class="text-warning">Status</h4>
                    @if($order->status == "pending")
                        <span class="badge badge-primary"> {{$order->status}} </span>
                    @elseif($order->status == "completed")
                        <span class="badge badge-success"> {{$order->status}} </span>
                    @elseif($order->status == "decline")
                        <span class="badge badge-danger"> {{$order->status}} </span>
                    @endif
        </div>
    </div>
<hr>

    <table class="table border mt-4">
        <thead class="table-warning">
            <tr>
                <th>Product Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $item)
          <tr class="table-light">
              <td scope="row">{{$item->name}}</td>
              <td><img src="{{$item->imageD()}}"  width="40px" alt=""></td>
              <td><small>x</small>{{$item->pivot->quantity}}</td>
              <td>${{$item->pivot->price}}</td>
          </tr>
            @endforeach  
            <tr>
                <td colspan="3" class="text-right">Total:</td>        
                <td colspan="3"><h2 class="text-danger"><strong>${{$order->grand_total}}</strong></h2></td>
            </tr>                                         
        </tbody>
    </table>
</div> 
  
</div>
@endsection