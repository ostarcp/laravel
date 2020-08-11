@extends('layouts.frontend-master')

@section('content')


<div class="container p-4 mt-5 border ">
    <h3 class="mb-2">Tên sản phẩm: {{$abc->name}}</h3>
    <p class="text-danger p-2">Tên danh mục: {{$abc->getCate()->cate_name}}</p>
</div>


   
@endsection