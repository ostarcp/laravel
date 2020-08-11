@extends('layouts.admin-master')
@section('title', 'Upload Ảnh')
@section('danh_muc','Gallery ảnh sản phẩm '.$product->id)
@section('content')





@foreach ($product->images as $item)
<a href="{{ route('admin.Product.destroyImages',$item->id) }}">
    <img src="/storage/{{$item->small_image}}" style="height:100px; height:100px" alt="">
</a>
   
@endforeach

    <form class="p-3" id="add-form" action="{{route('admin.products.upload',$product)}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
        <label for="">Upload Images</label>
        <input type="file" id="file-input" name="small_images[]" class="form-control-file @error('small_images') is-invalid @enderror"  multiple />
        @foreach ($errors->all() as $error)
        <span class="text-danger" role="alert">
            <span>{{ $error }}</span><br>
        </span>
        @endforeach 
        </div>
        {{-- @error('small_images')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>   
        @enderror --}}
        <button class="btn btn-primary" type="submit">Upload</button>
        <a name="" id="" class="btn btn-danger" href="{{BASE_URL}}admin/products" role="button">Hủy</a>
    </form>


<div class="contrainer p-3">
    <div id="preview"></div>
</div>


@endsection


@section('script')
<script>

function previewImages() {

    var $preview = $('#preview').empty();
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {
    
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
        return alert(file.name +" is not an image");
    } // else...
    
    var reader = new FileReader();

    $(reader).on("load", function() {
        $preview.append($("<img/>", {src:this.result, height:100 }));
        $('img').addClass("m-3")
    });

    reader.readAsDataURL(file);

    }

}

$('#file-input').on("change", previewImages);
</script>
@endsection