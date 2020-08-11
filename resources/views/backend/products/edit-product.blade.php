@extends('layouts.admin-master')
@section('title', 'Sửa Sản phẩm')
@section('danh_muc','Sửa Sản phẩm')
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

<form id="add-form" action="{{route('admin.products.update', $product)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Tên sản phẩm<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $product->name }}" aria-describedby="helpId" name="name">
                      @error('name')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="">TL</label>
                      <select name="cate_id" class="form-control @error('cate_id') is-invalid @enderror" value="{{ old('cate_id') }}" aria-describedby="helpId">
                        @foreach ($categories as $cate)
                        <option
                                @if($cate->id == $product->cate_id)
                                    selected
                                @endif
                                value="{{ $cate->id }}"> {{ $cate->cate_name }} </option>
                       @endforeach
                      </select>
                     
                  </div>
                  <div class="form-group">
                      <label for="">Giá<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') ?? $product->price}}" name="price">
                      @error('price')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="">Số lượng<span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') ??  $product->amount}}"  name="amount" >
                      @error('amount')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="">sale%</label>
                      <input type="text" class="form-control @error('sale') is-invalid @enderror" value="{{ old('sale') ?? $product->sale}}" aria-describedby="helpId" name="sale">
                      @error('sale')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="">Mô tả ngắn</label>
                      <input type="text" class="form-control @error('short_description') is-invalid @enderror" value="{{ old('short_description') ??  $product->short_description}}" aria-describedby="helpId" name="short_description">
                      @error('short_description')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div> 
              </div>
    
            
              <div class="col-md-6">
                  <div class="row">
                      <div class="col-7 offset-1">
                          <img id="preview-img" src="{{ $product->imageD()}}" class="img-fluid" style="width:800px; height:340px">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="">Ảnh đại diện<span class="text-danger">*</span></label>
                      <input type="file" onchange="encodeImageFileAsURL(this)" class="form-control-file @error('image') is-invalid @enderror" value="{{ old('image')}}" aria-describedby="helpId" name="image">
                      @error('image')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
    
                  <div class="form-group">
                      <label for="">Tình trạng<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('tt') is-invalid @enderror" value="{{ old('tt') ?? $product->tt}}" aria-describedby="helpId" name="tt">
                      @error('tt')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror
                  </div>
    
              </div>
    
            <div class="col-12">
                 <div class="form-group">
                      <label for="">Mô tả<span class="text-danger">*</span></label>
                      <textarea class="form-control textarea  @error('description') is-invalid @enderror" name="description" rows="5">{{ old('description') ?? $product->description}}</textarea>  
                      @error('description')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>   
                      @enderror             
                  </div>
            </div>
    
              <div class="col-12 d-flex justify-content-center">
                  <button class="btn btn-primary" type="submit">Lưu</button>&nbsp;
                  <a href="{{ BASE_URL }}admin/products" class="btn btn-danger">Hủy</a>
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


