
$("#log-out").click(function(e){
   let text = "Do you want log out?";
   if (confirm(text) == true) {

} else {
e.preventDefault();
}
});
      $("input[name=key]").keyup(function(e){
       var key =     $("input[name=key]").val();
     if(key ==""){
       $(".sugest").html("");
     }else{
       $.ajax({
   type: "POST",
   url: "{{route('client.post.search')}}",
   data:{
       key:key,
       _token: '{{csrf_token()}}',
   }, // serializes the form's elements.
   success: function(data)
   {
   $(".sugest").html(data);
    // show response from the php script.
   }
});
     }
   });
   