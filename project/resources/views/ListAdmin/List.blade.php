@extends('_Layout.AdminLayout')
@section('style')
    <link rel="stylesheet" href="\PhpDemo\AdminCss\List.css">
    <link rel="stylesheet" href="\PhpDemo\AdminCss\Create.css">
    <link rel="stylesheet" href="\PhpDemo\AdminCss\Delete.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
@endsection
@section('body')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
        @if (session('error'))
        <i class="fa fa-circle-exclamation"></i> 
        @else
        <i class="fa fa-circle-check success"></i>
        @endif
    </div>
@endif

    <div class="delete-container">

    </div>
    <div class="main">
        <div id="data">
        <table id="table">
            <tr class="header-row">
                <th class="header-item items">
                   ID
                </th>
                <th class="header-item items">
                  Title
                </th>
                 <th class="header-item items">
                    Category
                 </th>
                 <th class="header-item items">
                    Thumbnail
                 </th>
                 <th class="header-item items">
                    Create At
                 </th>
                 <th class="header-item items">
                    Update At
                 </th>
                 <th class="header-item items">
                   Action
                 </th>
            </tr>
            
                @foreach ($posts as $p)
                <tr class="table-rows">
                <td class="items">
                 {{$p->id}}
             </td>
             <td class="items">
                 <div class="class-title">
                          {{$p->title}}
                 </div>
             </td>
             <td class="items">
                 {{$p->category->name}}
             </td>
             <td class="items">
          <img src="{{$p->thumbnail}}" width="100px" height="100px" alt="">
            </td>
             <td class="items">
                 {{formatDate($p->created_at)}}
             </td>
             <td class="items">
                {{formatDate($p->updated_at)}}
             </td>
             <td class="items">
              <div class="impact">
                 <a href="#" onclick="Delete({{$p->id}})" title="Delete"><i class="fa-regular fa-trash-can"></i></a>
                 <a href="{{route('admin.post.update.get',['postId' =>$p->id])}}" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
              </div>
             </td>
         </tr>
                @endforeach
        </table>
    </div>
        <div class="search-box">
            <span>Search: </span>
            <input class="search-input" id="Search" name="key" type="text" value="" />
        </div>
        {{-- <div class="action-box">
            <select>
                <option value="0">1</option>
                <option value="1" selected>Action</option>
            </select>
        </div> --}}
   <a href="{{route('admin.post.create.get')}}">
    <div class="action-add">
        <span>Create <i class="fa-solid fa-plus"></i></span>
          </div>
   </a>
    </div>
</div>

@endsection
@section('scripts')
<script>

    function Delete(id){
        $(".delete-container").show("slow");
        $.ajax({
        method: "GET",
        url: '{{route("admin.post.delete")}}',
        data: {
            id: id,
            _token: '{{csrf_token()}}'
        }, 
        success: function(data) {
          $(".delete-container").html(data);
          $(".cancel").click(function(e){
              $(".delete-container").hide("slow");
          });
        }
    });
    }
    $(".alert").show("slow").delay(3000).hide("slow");
     $(".close-error").click(function(e){
         $(".error").hide("slow");
     });


    $("#Search").keyup(function() {
    var stringSearch = $("input[name=key]").val();
    $.ajax({
        method: "POST",
        url: '{{route("admin.post.search")}}',
        data: {
            key: stringSearch,
            _token: '{{csrf_token()}}'
        }, // serializes the form's elements.
        success: function(data) {
            $("#data").html(data);
        }
    });
});
</script>

@endsection