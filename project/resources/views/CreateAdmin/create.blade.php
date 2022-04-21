@extends('_Layout.AdminLayout')
@section('style')
    <link rel="stylesheet" href="\PhpDemo\AdminCss\Create.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
@endsection
@section('body')
<div class="create">    
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
    @if (isset($link) )
    <form action="{{$link}}" class="form-create" enctype="multipart/form-data"  method="POST">
    @else
    <form action="{{route('admin.post.create.post')}}" class="form-create" enctype="multipart/form-data" method="POST">
    @endif
        @csrf
  @if(isset($post))  
  <input type="hidden" value="{{$post->id}}" name="id">
<div class="form-group">
    <span>@lang('admin.title'): </span>
    <input type="text" value="{{$post->title}}" name="title">
</div>
<div class="form-group">
    <span>@lang('admin.description'): </span>
    <textarea name="description" id="" cols="30" rows="10">
        {{$post->description}}
    </textarea>
</div>

<div class="infor-3">
    <div class="form-group">
        <span>@lang('admin.post-day'): </span>
    <input type="text" id="datepicker" autocomplete="off" value="{{formatDate($post->created_at)}}" name="created_at" placeholder="Click here to chose">
        <input  type="hidden" name="updated_at" value="{{  now() }}">
    </div>
    <div class="form-group">
     <span>@lang('admin.thumbnail'): </span>
     <input type="button" class="upimg" value="@lang('admin.update')">
        <input type="file"  onchange="previewFile()" class="thumbnail" name="image">
    </div>
    <div class="form-group">
     <span>@lang('admin.category'): </span>
     <select name="category_id">
        @foreach ($categories_create as $category)
        <option value="{{$category->id}}" {{$post->category_id == $category->id ? "selected" : ""}}>{{$category->name}}</option>   
        @endforeach
      <option value="0">@lang('admin.none')</option>
     </select>
    </div>
    
</div>
<div class="image">
    <img id="thumbnail_image" src="{{$post->thumbnail}}" alt="">
</div>
<div class="form-group content">
<span>@lang('admin.content'): </span>
<div id="editor">
<textarea name="content"   id="editor-content">
   
</textarea>
</div>
</div>
<input type="submit" class="submit" value="@lang('admin.save-change')">
@include('js.ExistPost')
 @else 
@include('CreateAdmin.content_create') 
<input type="submit" class="submit" value="@lang('admin.create')">
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
   
</div> 

@endsection
@section('scripts')
<script src="\PhpDemo\AdminJs\Admin.js"></script>
   <script>
            $(".submit").click(function(){
            $(".form-create").submit();
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