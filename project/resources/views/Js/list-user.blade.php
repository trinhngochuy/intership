<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/PhpDemo/js/UserTable.js"></script>
<script>

$("#Search").keyup(function() {
    var stringSearch = $("input[name=key]").val();
    $.ajax({
        method: "POST",
        url: '{{route("admin.post.search.user")}}',
        data: {
            key: stringSearch,
            _token: '{{csrf_token()}}'
        }, // serializes the form's elements.
        success: function(data) {
            $("#data").html(data);
        }
    });
 
});
    function deleteUser(id){
    $(".removeUser").click(function(event){
        var parent =  $(this).parent().parent().parent();
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
        url: '{{route("admin.post.delete.user")}}',
        type: 'POST',
        dataType: 'json',
        data: {
            user_id:id,
            _token: '{{csrf_token()}}',
        }
    }).always(function (response) {
     if(response==true){
        parent.remove();
            swal("Deleted Successful!", {
                icon: "success",
            });
     }else{
        swal("Deleted Successful!", {
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
    function changeStatus(id){
$(".items").click(function(){
    var element = $(this);
        swal({
  title: "Are you sure?",
  text: "Change User Status!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
        url: '{{route("admin.post.status.user")}}',
        type: 'POST',
        dataType: 'json',
        data: {
            user_id:id,
            _token: '{{csrf_token()}}',
        }
    }).always(function (response) {
     if(response==0){
        element.html(`<i class="fa-solid fa-lock"></i>
        <span>Lock</span>`);
            swal("Change Successful!", {
                icon: "success",
            });
     }else{
        element.html(`<i class="fa-solid fa-lock-open"></i>
        <span>Lock</span>`);
            swal("Change Successful!", {
                icon: "success",
            });
     }
    });
  } else {
    swal("Your imaginary file is safe!");
  }
});

});
    } 
  $(".action-add").click(function(){
    cleanInput();
$(".submit").text("@lang('admin.create')");
$("input[name=user_name]").removeAttr("readonly");
$("input[name=password]").removeAttr("readonly");
$("input[name=config_password]").removeAttr("readonly");
$('form').attr('action', '{{route("admin.post.create.user")}}');
});
function cleanInput(){
    $("#thumbnail_image").attr("src","https://i.pinimg.com/236x/bb/2e/91/bb2e911c44ac2e95ce2fffad7a109e2d.jpg");
    $("input[type=text],input[user_id],input[type=password],input[type=email]").val("");
    $("input[type=checkbox]").prop('checked',false);
}
function changeUser(id){
    cleanInput();
$(".submit").text("@lang('admin.save-change')");
$("input[name=user_name]").attr("readonly","");
$("input[name=password]").attr("readonly","");
$("input[name=config_password]").attr("readonly","");
$('form').attr('action', '{{route("admin.post.save-change.user")}}');
$.ajax({
        url: '{{route("admin.post.change.user")}}',
        type: 'POST',
        dataType: 'json',
        data: {
         user_id:id,
         _token: '{{csrf_token()}}',
        }
    }).always(function (response) {
        $("#thumbnail_image").attr("src",response.thumbnail)
        $("input[name=user_id]").val(response.id);
   $("input[name=first_name]").val(response.first_name);
   $("input[name=last_name]").val(response.last_name);
   $("input[name=user_name]").val(response.user_name);
   $("input[name=password]").val("khongbiet");
   $("input[name=config_password]").val("khongbiet");
   $("input[name=email]").val(response.email);
   $("input[name=birthday]").val(response.birth_day);
response.roles.forEach(function(element) {  
    if(element==1){$("input[name=role_user]").prop('checked',true)}
    if(element==2){$("input[name=role_admin]").prop('checked',true)}
    });
    });
};

</script>