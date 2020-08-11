@extends('layouts.admin-master')
@section('title', 'Danh sách User')
@section('danh_muc','User')

@section('content')


<style>
    #add-car-form{
        margin-top: 50px;
        margin-bottom: 100px;
    }
    .form-group label.error{
        color: indianred;
    }
</style>

<form id="add-car-form" action="{{route('admin.users.update',$user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}

        <div class="row">
            <div class="col-md-6">
         
                <div class="form-group">
                    <label for="">Name<span class="text-danger">*</span></label>
                    <input type="text"  class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') ?? $user->name }}" name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Email<span class="text-danger">*</span></label>
                    <input type="email"  class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') ?? $user->email }}" name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="">password</label>
                  
                    <input type="password"  class="form-control @error('password') is-invalid @enderror"  value="{{ old('password') ?? $user->password }}" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">re-password</label>
                    <input type="password" class="form-control" name="repwd">
                    @error('repwd')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                    @enderror
                </div> --}}

                <div class="form-group">
                    <label for="">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror"  value="{{ old('phone') ?? $user->phone }}" name="phone" >
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                    @enderror
                </div>

                <div class="form-group">
                    <label for="roles" class="">Roles:</label>
                  
                        @foreach ($roles as $role)
                            <div class="check">
                                <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                <label for="">{{$role->name}}</label>
                            </div>
                        @endforeach
                    
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-7 offset-1">
                    @if($user->avatar)
                          <img id="preview-img" src="{{BASE_URL }}storage/{{$user->avatar}}" class="img-fluid" style="width:400px; height:300px">
                    @else
                        <img id="preview-img" src="{{ BASE_URL . 'images/default-image.jpg' }}" class="img-fluid" style="width:400px; height:300px">
                    @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện<span class="text-danger">*</span></label>
                    <input type="file" onchange="encodeImageFileAsURL(this)" class="form-control-file" name="avatar">
                </div>

                <div class="form-group">
                  <label for="">Address<span class="text-danger">*</span></label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') ?? $user->address }}">
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                    @enderror
                </div>

            </div>
            <div class="col-12 d-flex justify-content-center">
                <button class="btn btn-primary" type="submit">Lưu</button>&nbsp;
                <a href="{{ BASE_URL }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>


@endsection


@section('script')

<script>

  function encodeImageFileAsURL(element) {
    var file = element.files[0];
    if(file === undefined){
        $('#preview-img').attr('src', "{{ BASE_URL . 'public\images\default-image.jpg' }}");
    }else{
        var reader = new FileReader();
        reader.onloadend = function() {
            $('#preview-img').attr('src', reader.result);    
        }
        reader.readAsDataURL(file);      
    }
}

</script>


@endsection


