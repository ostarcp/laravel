@extends('layouts.admin-master')
@section('title', 'Danh sách Order')
@section('danh_muc','Hoá Đơn')
@section('content')

<table class="table">
    <thead>
        <tr>
            <th>OrderNumber</th>
            <th>Name</th>  
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
            
        </tr>
    </thead>
    
    @can('manage')
    <tbody>  
        @foreach($orders as $item)
            <tr>
                <td scope="row">{{$item->order_number}}</td>
                <td>{{$item->first_name}} {{$item->last_name}}</td>            
                <td>{{$item->address}}</td>    
                <td>{{$item->status}}</td>
                <td>
                    <span class="badge badge-primary"><a href="{{route('admin.order.show',$item->id)}}" class="text-white">View</a></span>
                    <span class="badge badge-success"><a href="{{route('admin.order.edit',$item->id)}}" class="text-white">Edit</a></span>

                    <form id="target-{{$item->id}}" action="{{route('admin.order.destroy',$item)}}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <span class="badge badge-danger"><a href="#" class="text-white btn-remove">Delete</a></span>   
                     </form> 

                </td>
            </tr>
        @endforeach
    </tbody>
 @endcan
 
</table>


@isset($item) 
    @php $idOd = $item->id; @endphp @else @php $idOd = 'noform'; @endphp
@endisset


@if(session('status'))
    <input type="hidden" id="msg" value="{{ session('status') }}">
@endif

@endsection


@section('script')
<script>
    $(document).ready(function(){

        if($('#msg').length > 0){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: $('#msg').val(),
                showConfirmButton: false,
                timer: 1500
            })
        }

        $(".btn-remove").click(function(event) {
            Swal.fire({
                title: 'Thông báo!',
                text: "Bạn có chắc chắn muốn xóa sản phẩm này ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý!'
            }).then((result) => {
                if (result.value) {
                    $("#target-{{$idOd}}").submit();
                }
            }) 
        });
    

    });
</script>
@endsection



