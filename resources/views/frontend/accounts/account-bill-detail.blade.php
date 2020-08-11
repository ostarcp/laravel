@extends('layouts.frontend-master')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <a href="/account"><i class="fa fa-user"></i> Account</a>
                    <span>Bill</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
    <div class="container my-4">
            <table class="table  table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản phẩm </th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $item)
                    <tr>
                        <td scope="row">{{$item->name}}</td>
                        <td>{{$item->pivot->quantity }}</td>
                        <td>${{ $item->pivot->price * $item->pivot->quantity }}</td>
                    </tr>
                    @endforeach    
                    <tr>
                        <td scope="row"><h3>Total:</h3></td>
                        <td colspan="3" class="text-center">${{$order->grand_total}}</td>
                    </tr>           
                </tbody>
            </table>
    </div>
@endsection