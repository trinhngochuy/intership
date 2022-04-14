<script>
    $(document).on('keypress',function(e) {
            if(e.which == 13) {   
                submit();
            }
});
  $("input[name=submit]").click(function(){
    submit();
  });
function submit(){
    $("#massage").show("slow").delay(2000).hide("slow");
       let UserName = $("input[name=UserName]").val();
       let password = $("input[name=password]").val();
       
    $.ajax({
        type: "POST",
        url: "{{route('login')}}",
        data:{
            UserName: UserName,
            password: password,
            _token: '{{csrf_token()}}'
             }, 
        success: function(data)
        {
             $("#massage").html(data.data)
             if (data.route != null) {
            window.location.replace(data.route);
             }
        }
    });
}

</script>