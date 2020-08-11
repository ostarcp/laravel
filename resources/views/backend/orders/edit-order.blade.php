@extends('layouts.admin-master')
@section('title', 'Edit Order')
@section('danh_muc','Edit: '.$order->order_number)
@section('content')

<form id="add-form" action="{{route('admin.order.update',$order)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
          <div class="row">
              <div class="col-md-6">
                
                 <div class="form-group">
                      <label>First Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') ?? $order->first_name }}" aria-describedby="helpId" name="first_name">
                      @error('first_name')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>

                  <div class="form-group">
                    <label>Last Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('	last_name') is-invalid @enderror" value="{{ old('last_name') ?? $order->last_name }}" aria-describedby="helpId" name="last_name">
                    @error('last_name')
                       <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>   
                    @enderror
                  </div>   

                  <div class="form-group">
                      <label for="">Email<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('	email') is-invalid @enderror" value="{{ old('email') ?? $order->email}}" name="email">
                      @error('email')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?? $order->phone }}"  name="phone" >
                    @error('phone')
                       <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>   
                    @enderror
                  </div>

                  <div class="form-group">
                      <label for="">address<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') ?? $order->address }}"  name="address" >
                      @error('address')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="">zipcode</label>
                      <input type="text" class="form-control @error('zipcode') is-invalid @enderror" value="{{ old('zipcode') ?? $order->zipcode}}" aria-describedby="helpId" name="zipcode">
                      @error('zipcode')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>

                  <div class="form-group">
                      <label for="">Total</label>
                      <input type="text" class="form-control @error('grand_total') is-invalid @enderror" value="{{ old('grand_total') ?? $order->grand_total}}" aria-describedby="helpId" name="grand_total">
                      @error('grand_total')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div> 

                  <div class="form-group">
                    <label for="">item_count</label>
                    <input type="text" class="form-control @error('item_count') is-invalid @enderror" value="{{ old('item_count') ?? $order->item_count}}" aria-describedby="helpId" name="item_count">
                    @error('item_count')
                       <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>   
                    @enderror
                </div> 

                <div class="form-group">
                    <label for="">status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status') }}" aria-describedby="helpId">

                       <option  @if($order->status == "pending")
                                    selected
                                @endif value="pending">Pending</option>

                       <option @if($order->status == "completed")
                                    selected
                                @endif value="completed">Completed</option>

                       <option @if($order->status == "decline")
                                    selected
                                @endif value="decline">Decline</option>
                    </select>
                   
                    @error('status')
                       <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>   
                    @enderror
                </div> 

              </div>
    
            
              <div class="col-md-6">

                   <div class="row">
                      <div class="col-8 offset-1">
                          <table class="table border">
                              <thead class="thead-dark">
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
                                    <td><h4>Total:</h4></td>
                                    <td colspan="3"><h2 class="text-danger"><strong>${{$order->grand_total}}</strong></h2></td>
                                  </tr>                                                           
                              </tbody>
                          </table>
                          @if($order->status == "pending")
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                            </div>   
                          @elseif($order->status == "completed")
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div> 
                            @elseif($order->status == "decline")
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>     
                          @endif
                      </div>
                    </div> 

              </div>
    
    
              <div class="col-12 d-flex justify-content-center">
                  <button class="btn btn-primary" type="submit">Lưu</button>&nbsp;
                  <a href="{{ BASE_URL }}admin/order" class="btn btn-danger">Hủy</a>
              </div>
          </div>
      
      </form>

@endsection