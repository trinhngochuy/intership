<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  
  $("input[name=search]").keyup(function(){
    searchMyPost();
  });
  $("input[name=start]").change(function(){
    searchMyPost();
  });
  $("input[name=end]").change(function(){
    searchMyPost();
  });
  $("select[name=category]").change(function(){
    searchMyPost();
  });
  function searchMyPost(){
    var keyword = $("input[name=search]").val();
      var start = $("input[name=start]").val();
      var end = $("input[name=end]").val();
      var category = $("select[name=category]").val();
      $.ajax({
                type: "POST",
                url: "{{route('client.post.my.search')}}",
                data: {
                    category:category,
                    start:start,
                    end:end,
                    key:keyword,
                    _token: '{{csrf_token()}}',
                },
                success: function(data)
                {
               $(".posts").html(data);
                }
            });
  }
function deletePost(id){
    $(".remove-post").click(function(event) {
       var parent =  $(this).parent('.post');
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
                type: "POST",
                url: "{{route('client.post.delete')}}",
                data: {
                    id:id,
                    _token: '{{csrf_token()}}',
                },
                success: function(data)
                {
                    parent.remove();
                    swal(" Your file has been deleted!", {
                    icon: "success",
                    });
                },error: function(data)
                {
                    swal("Your file hasn't been deleted!", {
                    icon: "error",
                    });
                }
            });
    } else {
      swal("Your imaginary file is safe!");
    }
  });
  
});
}
</script>