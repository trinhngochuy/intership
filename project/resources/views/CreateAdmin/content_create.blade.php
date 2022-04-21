
<div class="form-group">
    <span>@lang('admin.title'): </span>
    <input type="text" name="title">
</div>
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
<div class="form-group">
    <span>@lang('admin.description'): </span>
    <textarea name="description" id="" cols="30" rows="10"></textarea>
</div>

<div class="infor-3">
    <div class="form-group">
        <span>@lang('admin.post-day'): </span>
    <input type="text" id="datepicker" autocomplete="off" name="created_at" placeholder="Click here to chose">
        <input  type="hidden" name="updated_at" value="{{  now() }}">
    </div>
    <div class="form-group">
     <span>@lang('admin.thumbnail'): </span>
     <input type="button" class="upimg" value="Update">
        <input type="file" onchange="previewFile()" class="thumbnail" name="image">
    </div>
    <div class="form-group">
     <span>@lang('admin.category'): </span>
     <select name="category_id">
        @foreach ($categories_create as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>   
        @endforeach
      <option value="" selected>@lang('admin.none')</option>
     </select>
    </div>
    
</div>
<div class="image">
    <img id="thumbnail_image" src="" alt="">
</div>
<div class="form-group content">
<span>@lang('admin.content'): </span>
<div id="editor">
<textarea name="content" id="editor-content">

</textarea>
</div>
</div>
<script>
        $("#datepicker" ).datepicker();
$(".upimg").click(function(){
    $("input[name=image]").click();
});

</script>