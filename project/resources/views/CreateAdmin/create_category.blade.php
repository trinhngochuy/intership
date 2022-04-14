@extends('_Layout.AdminLayout')
@section('style')
    <link rel="stylesheet" href="\PhpDemo\AdminCss\Create_category.css">
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection
@section('body')
<div id="ex1" class="modal">
    <p>Create Category. . .</p>
<div class="create-category">
<input name="category" type="text" placeholder="Category Name">
<button id="create-category">Submit</button>
</div>
  </div>
  
  <!-- Link to open the modal -->
<div class="container">
<div class="main"> 
     <a href="#ex1" rel="modal:open" class="add_category">
    <i class="fa fa-plus"></i> Open Modal
</a>


<div class="cf nestable-lists">

    <div class="dd" id="nestable">
        @if (isset($categories))
        <ol class="dd-list">
      @include('List.list-parent-category',["categories"=>$categories]);
        </ol>

@endif
    </div>



</div>
</div>
</div>
@endsection
@section('scripts')
<script src="/PhpDemo/js/Nestable.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
function myDelete(id) {
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
    url:"{{route('admin.post.delete_category.post')}}",
    type: 'POST',
        data: {
            _token: '{{csrf_token()}}',
            category_id:id,
        },
        success: function(data)
        {
            $(".dd-list").html(data);
            swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
        },
        error: function(data)
        {
            swal("Poof! Your imaginary file has not been deleted!", {
      icon: "error",
    });
        }
    });

  } else {
    swal("Your imaginary file is safe!");
  }
});
}
$("#create-category").click(function(){
let name =  $("input[name=category]").val();
$.ajax({
    url:"{{route('admin.post.create_category.post')}}",
    type: 'POST',
        data: {
            _token: '{{csrf_token()}}',
            category_name:name,
        },
    }).always(function (response) {
 if(response != ""){
    $(".dd-list").html(response);
    swal("Good job!", "You clicked the button!", "success");
 }else{
    swal("Good!", "You clicked the button!", "error");
 }
    })

});
$(document).ready(function()
{
var arr='';
    var updateOutput = function(e)
    {
        var list   = $(e.target);
        $.ajax({
        url: '{{route("admin.post.update_category.post")}}',
        type: 'POST',
        data: {
            _token: '{{csrf_token()}}',
          data: list.nestable('serialize'),
        }
    }).always(function (response) {

         $(".dd-list").html(response);
    });
    };

    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);

  //  updateOutput($('#nestable').data('output', $('#nestable-output')));
});
    </script>
@endsection