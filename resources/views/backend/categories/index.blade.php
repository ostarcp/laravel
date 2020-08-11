@extends('layouts.admin-master')
@section('title', 'Danh sách TL')
@section('danh_muc','Thể loại')
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
                <th><a name="" id="" class="btn btn-primary" href="{{ route('admin.categories.create') }}" role="button">Add</a></th>
            </tr>
        </thead>
        
        @can('manage')
        <tbody>  
            @foreach($categories as $cate)
                <tr>
                    <td scope="row">{{$cate->id}}</td>
                    <td>{{$cate->cate_name}}</td>
                    <td>
                        <a name="" id="" class="btn btn-success" href="{{route('admin.categories.edit',$cate->id)}}" role="button">Edit</a>
                    </td>   
                     @can('delete')
                        <td>
                            <form id="target-{{$cate->id}}" action="{{route('admin.categories.destroy',$cate)}}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="button" class="btn btn-danger btn-remove" value="Delete">              
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
     @endcan
     
    </table>
</div>

@isset($cate) 
    @php $formID = $cate->id; @endphp @else @php $formID = 'noform'; @endphp
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
                    $("#target-{{$formID}}").submit();
                }
            })
            
        });
    

    });
</script>
@endsection


