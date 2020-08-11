
<table class="table table-dark">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">ĐƠN HÀNG</th>
    <th scope="col">TÌNH TRẠNG</th>
    <th scope="col">NGÀY</th>
    <th scope="col">THAO TÁC</th>
    </tr>
</thead>
<tbody>
@foreach ($account->orders as $key => $item)    
    <tr>
    <th scope="row">{{$key + 1}}</th>
    <td>{{$item->order_number}}</td>
    <td>{{$item->status}}</td>
    <td>{{ date("d/m/Y", strtotime($item->created_at)) }}</td>

    <td class="first-row">                                      
        <a name="" id="" class="primary-btn up-cart" href="{{route('Account.accountOrderDetail',$item->id)}}" role="button">Xem</a>                                         
    </td>

    </tr>
@endforeach
</tbody>
</table>                              
