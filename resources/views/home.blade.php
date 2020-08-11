@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Info</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <br>
                    <div class="row p-3">
                            <a class="btn btn-primary col-12" href="/">Back to ShopPage</a> <br>
                        @can('manage')
                            <a class="btn btn-primary col-12 mt-2" href="{{route('admin.admin')}}">To Administrator Page</a>    
                        @endcan
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
