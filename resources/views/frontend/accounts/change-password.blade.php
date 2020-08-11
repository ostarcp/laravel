@if (session('status'))
@if (session('status') === "Password Updated!")
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@else
<div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif      
@endif
<form class="p-3" action="{{route('Account.changePassword')}}" method="post" enctype="multipart/form-data">
  @csrf
    <div class="form-group row p-2">
        <label for="" class="col-sm-3 col-form-label">Old password *</label>
        <div class="col-sm-9">
          <input type="password" class="form-control @error('old_password') is-invalid @enderror"  name="old_password">
          @error('old_password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>   
          @enderror
   
        </div>
      </div>

    <div class="form-group row p-2">
      <label for="" class="col-sm-3 col-form-label">New password *</label>
      <div class="col-sm-9">
      <input type="password"  class="form-control @error('new_password') is-invalid @enderror" id="" value="{{ old('new_password') }}" name="new_password">
        @error('new_password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>   
        @enderror
      </div>
    </div> 
    
    <div class="form-group row p-2">
        <label for="" class="col-sm-3 col-form-label">Confirm password *</label>
        <div class="col-sm-9">
          <input type="password"  class="form-control @error('confirm_new_password') is-invalid @enderror" id="" value="{{ old('confirm_new_password') }}" name="confirm_new_password">
          @error('confirm_new_password')
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