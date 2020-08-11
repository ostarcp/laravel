@extends('layouts.admin-master')
@section('title', 'Comment')
@section('danh_muc','Comments')
@section('content')

<div class="p-3">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Comments</th>
             
            </tr>
        </thead>
        
        @can('manage')
        <tbody>  

           <tr></tr>
                   
        </tbody>
        @endcan
    
    </table>

 
</div>

@endsection