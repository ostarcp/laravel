@extends('layouts.admin-master')
@section('title', 'Sửa TL')
@section('danh_muc','Sửa TL')
@section('content')

<div class="p-3">
<form action="{{route('admin.categories.update',$cate)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}

        <div class="row border p-3 w-50">
        
            <div class="col-md-12">

                <div class="form-group">
                    <label for="">Category Name:</label>
                    <input type="text" name="cate_name" id="" class="form-control @error('cate_name') is-invalid @enderror" value="{{ old('cate_name') ?? $cate->cate_name}}" aria-describedby="helpId">
                        @error('cate_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>   
                        @enderror
                </div>
                
            </div>

            <div class="col-12 d-flex justify-content-start">
                <button class="btn btn-primary" type="submit">Lưu</button>&nbsp;
                <a href="{{ BASE_URL }}admin/categories" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>
</div>



@endsection


