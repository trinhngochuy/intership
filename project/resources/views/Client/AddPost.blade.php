@extends('_Layout.ClientLayout')
@section('style')
<link rel="stylesheet" href="\PhpDemo\AdminCss\Create.css">
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<link rel="stylesheet" href="\PhpDemo\Client\addPost.css"  />
@endsection
@section('body')
@if ($errors->any())
<div class="error">
  <div class="close-error">
    <i class="fa fa-x"></i>
  </div>
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
</div>
@endif
<div class="back-home">
  <a href="{{route('client.posts')}}">
    <i class="fa fa-house"></i>
  </a>
</div>
@if (isset($link) )
<form action="{{$link}}" class="form-create" enctype="multipart/form-data" method="POST">
@else
<form action="{{route('client.post.create.post')}}" enctype="multipart/form-data" class="form-create" method="POST">
@endif
@csrf
@if(isset($post))  
<input type="hidden" value="{{$post->id}}" name="id">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
<div class="form-group">
  <span>@lang('client.title'): </span>
  <input type="text" value="{{$post->title}}" name="title">
</div>
<div class="form-group">
  <span>@lang('client.description'): </span>
  <textarea name="description" id="" cols="30" rows="10">
      {{$post->description}}
  </textarea>
</div>

<div class="infor-3">
  <div class="form-group">
      <span>@lang('client.post-day'): </span>
  <input type="text" id="datepicker" autocomplete="off" value="{{formatDate($post->created_at)}}" name="created_at" placeholder="Click here to chose">
      <input  type="hidden" name="updated_at" value="{{  now() }}">
  </div>
  <div class="form-group">
   <span>@lang('client.thumbnail'): </span>
   <input type="button" class="upimg" value="Update">
      <input type="file"  class="thumbnail" name="image">
  </div>
  <div class="form-group">
   <span>@lang('client.category'): </span>
   <select name="category_id">
      @foreach ($categories_create as $category)
      <option value="{{$category->id}}" {{$post->category_id == $category->id ? "selected" : ""}}>{{$category->name}}</option>   
      @endforeach
    <option value="">@lang('client.none')</option>
   </select>
  </div>
  
</div>
<div class="image">
  <img id="thumbnail_image" src="{{$post->thumbnail}}" alt="">
</div>
<div class="form-group content">
<span>@lang('client.content'): </span>
<div id="editor">
<textarea name="content"   id="editor-content">
 
</textarea>
</div>
</div>
<input type="submit" class="submit" value="@lang('client.update')">
@include('js.ExistPost')
@else
@include('CreateAdmin.content_create') 
<input type="submit" class="submit" value="@lang('client.create')">
<script>
    ClassicEditor
   .create( document.querySelector( '#editor-content' ))
   .then( editor => {
    const data = editor.getData();
        console.log(data);
    });
;
</script>
@endif
@endsection
@section('scripts')
<script>
    $(".submit").click(function(){
$(".form-create").submit();
});
$(".close-error").click(function(e){
         $(".error").hide("slow");
     });
function previewFile() {
  const preview = $("#thumbnail_image");
  const file = document.querySelector('input[type=file]').files[0];
  const reader = new FileReader();
  reader.addEventListener("load", function () {
    // convert image file to base64 string
    preview.prop("src", reader.result);
  }, false);
  if (file) {
    reader.readAsDataURL(file);
  }
}
</script> 
@endsection