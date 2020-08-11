@extends('layouts.admin-master')
@section('title', 'Danh sách Sản phẩm')
@section('danh_muc','Sản phẩm')
@section('content')

@if (session('status'))

    @if(session('status') === "Deleted!")
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @elseif (session('status') === "Updated!")
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @else
    <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

@endif




<div class="p-3">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Image</th>
                <th>Price</th>
                <th>Amount</th>
                <th><a name="" id="" class="btn btn-primary" href="{{ route('admin.products.create') }}" role="button">Add</a></th>
            </tr>
        </thead>
        
        @can('manage')
        <tbody>  
            @foreach($products as $pd)
                <tr>
                    <td scope="row">{{$pd->id}}</td>
                    <td>{{$pd->name}}</td>
                    <td>{{$pd->getCate()->cate_name}}</td>
                    <td><img src="{{ $pd->imageD() }}"  width="60px" alt=""></td> 
                   
                    <td>{{$pd->price}}</td>
                    <td>{{$pd->amount}}</td>
                    <td class="d-flex align-items-center justify-content-between">
                        <span class="badge badge-primary"><a href="{{route('admin.products.show',$pd)}}" class="text-white">Gallery</a></span>              
                        <a name="" id="" class="btn btn-success mr-2" href="{{route('admin.products.edit',$pd->id)}}" role="button">Edit</a>        
                        @can('delete')
                        
                            <form id="target-{{$pd->id}}" action="{{route('admin.products.destroy',$pd)}}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="button" class="btn btn-danger btn-remove" value="Delete">                      
                            </form>                
                         @endcan
                    </td>   
               
                </tr>
            @endforeach
        </tbody>
     @endcan
    
    </table>

    <div class="container d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>



@isset($pd) 
    @php $idPd = $pd->id; @endphp @else @php $idPd = 'noform'; @endphp
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
                    $("#target-{{$idPd}}").submit();
                }
            }) 
        });
    

    });
</script>
@endsection
