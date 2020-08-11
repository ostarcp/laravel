@extends('layouts.admin-master')
@section('title', 'Danh sách User')
@section('danh_muc','User')
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

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Auth</th> 
                <th><a name="" id="" class="btn btn-primary" href="{{ route('admin.users.create') }}" role="button">Add</a></th>
            </tr>
        </thead>
        
        @can('manage')
        <tbody>  
            @foreach($users as $user)
                <tr>
                    <td scope="row">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><img src="{{$user->avatarImg()}}" width="60px" alt=""></td>
                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                    <td>
                        <a name="" id="" class="btn btn-success" href="{{route('admin.users.edit',$user->id)}}" role="button">Edit</a>
                    </td>   
                    @can('delete')
                    <td>
                        <form id="target-{{$user->id }}" action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
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
    
@isset($user) 
    @php $formID = $user->id; @endphp @else @php $formID = 'noform'; @endphp
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


