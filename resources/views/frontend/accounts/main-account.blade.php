@extends('layouts.frontend-master')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="breadcrumb-text product-more">
                  <a href="/"><i class="fa fa-home"></i> Home</a>
                  <span>Account</span>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Breadcrumb Section Begin -->

<div class="container my-4">

    <div class="row pt-2">
        <div class="col-4">
            <li class="list-group-item bg-info text-white"><h3><strong>Your Profile</strong></h3></li>
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action mt-2 active" id="list-home-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="home">Profile</a>
            <a class="list-group-item list-group-item-action mt-2" id="list-profile-list" data-toggle="list" href="#list-password" role="tab" aria-controls="profile">Change password</a>
            <a class="list-group-item list-group-item-action mt-2" id="list-messages-list" data-toggle="list" href="#list-bill" role="tab" aria-controls="messages">Billings</a> 
        
          </div>
        </div>
        <div class="col-8">
          <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-home-list">
              @if (session('status'))
                  @if (session('status') === "Account Updated!")
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @else
                  <div class="alert alert-info">
                          {{ session('status') }}
                      </div>
                  @endif      
              @endif
                <div class="row p-3">

                    <div class="col-2">
                         <img class="rounded-circle" src="{{$account->avatarImg()}}" width="100px" height="100px" id="preview-img" alt="">
                    </div>

                    <div class="col-10 p-3">                   
                        <div class="row mb-2">
                            <div class="col-12"><strong>Tên:</strong> <h4 class="d-inline">{{$account->name}}</h4>  </div>
                        </div>

                        <div class="row">
                            <div class="col-4"> Quyền: {{ implode(', ', $account->roles()->get()->pluck('name')->toArray()) }} </div>
                            <div class="col-8"> <small>created at:</small>  {{ date("d/m/Y", strtotime($account->created_at)) }}   </div>
                         </div>
                </div>         
            </div>    

              
                 <form class="p-3" action="{{route('Account.updateAccount',$account)}}" method="post" enctype="multipart/form-data">
                      @csrf
                      {{ method_field('PUT') }}

                        <div class="form-group row p-2">
                          <label for="" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control-plaintext" id="" value="{{$account->email}}" disabled>
                          </div>
                        </div>

                        <div class="form-group row p-2">
                          <label for="" class="col-sm-2 col-form-label">Name *</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="" name="name" value="{{$account->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>   
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row p-2">
                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="" name="phone" value="{{$account->phone}}">
                            </div>
                          </div>


                          <div class="form-group row p-2">
                            <label for="" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="" name="address" value="{{$account->address}}">
                            </div>
                          </div>

                          <div class="form-group row p-2">
                            <label for="" class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control-file @error('avatar') is-invalid @enderror"   onchange="encodeImageFileAsURL(this)" id="" name="avatar">
                              @error('avatar')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>   
                              @enderror
                            </div>
                          </div>

                          <div class="form-group row d-flex justify-content-center">
                                <button type="submit" name="" id="" class="btn btn-primary btn-lg btn-block">Save</button>
                          </div>
                    </form>             
            </div>


            <div class="tab-pane fade " id="list-password" role="tabpanel" aria-labelledby="list-profile-list">
                @include('frontend.accounts.change-password')
            </div>

            <div class="tab-pane fade" id="list-bill" role="tabpanel" aria-labelledby="list-messages-list">
                @include('frontend.accounts.account-bill')
            </div>



          </div>
        </div>
      </div>
</div>

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

$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});


$(document).ready(function(){
    $('a[data-toggle="list"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    console.log(activeTab);
    if(activeTab){
        $('#list-tab a[href="' + activeTab + '"]').tab('show');
    }
});

</script>
@endsection