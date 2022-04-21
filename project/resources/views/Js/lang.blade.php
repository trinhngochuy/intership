
<script>    
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
var click_s=0;

if ("{{ Session::get('lang')}}"=="vi"){
  $(".flag-img").prop("src","\\user.img\\defaul\\viet-nam.png");
         $(".flag").css("left","50%");
  click_s++;
}
    $('.change-lang').click(function(){

        if(click_s % 2 == 0){
          $(".flag-img").prop("src","\\user.img\\defaul\\viet-nam.png");
         $(".flag").css("left","50%");
         $.ajax({
        type: "POST",
        url: "{{route('change-lang.vn')}}",
        data: {
                    _token : "{{csrf_token()}}",
                },
        success: function()
        {
          location.reload(true);
        }
    });
        }
        else{
          $(".flag-img").prop("src","\\user.img\\defaul\\england.png");
         $(".flag").css("left","0%");
         $.ajax({
        type: "POST",
        url: "{{route('change-lang.en')}}",
        data: {
                    _token : "{{csrf_token()}}",
                },
        success: function()
        {
          location.reload(true);
        }
    });
        
        }
        click_s++;
    });
    </script>