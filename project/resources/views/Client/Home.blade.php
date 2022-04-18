@extends('_Layout.ClientLayout')
@section('style')
<link rel="stylesheet" href="\PhpDemo\Client\home.css"  />
@endsection
@section('body')
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
<div class="container contentz">
@include("Client.Category_search")
    </div>
@endsection
@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
            $(".alert").show("slow").delay(3000).hide("slow");
          function searchCategory(id){
            $.ajax({
        type: "POST",
        url: "{{route('client.post.filter')}}",
        data:{
            id:id,
            _token: '{{csrf_token()}}',
        }, // serializes the form's elements.
        success: function(data)
        {
    $(".contentz").html(data);
         // show response from the php script.
        }
    });
          }
              $(".like").click(function(){
                  let post_id = $(this).data("id");
                  $(this).css("background-color", "rgba(25, 201, 255, 0.699)");
                $.ajax({
        type: "POST",
        url: "{{route('client.post.like')}}",
        data:{
            post_id:post_id,
            _token: '{{csrf_token()}}',
        },
        success: function(data)
        {
            swal("Good job!", "You clicked the button!", "success");
        }
    });
              });  
    </script>
@endsection