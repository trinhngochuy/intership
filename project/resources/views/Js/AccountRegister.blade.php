<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
 <script>
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
   $().ready(function() {


    $( function() {
  $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:now",
        },
        $.datepicker.regional["fr"]
    );
});

$(".image").click(function(e){
  $('input[type=file]').click();
});

$("input[name=submit]").click(function(){
  const file = document.querySelector('input[type=file]').files[0];
var formData = new FormData($('form')[0]);

$.ajax({
      type: "POST",
      url: "{{route('register')}}",
      processData: false,
  contentType: false,
       data: formData,
      success: function(data)
      {
          $("#massage").html(data)
          $("#massage").show("slow").delay(2000).hide("slow");
      }
  });
});

$('#datepicker').attr('autocomplete','off');
validate();
// $("input[name=first_name]").keyup(function(){
//   validate();
// });
function validate(){
  $("#target").validate({
		rules: {
			"first_name": {
				required: true,
        maxlength: 50,
        minlength: 5,
			},
      "last_name": {
				required: true,
        maxlength: 50,
        minlength: 5,
			},
      "email": {
				required: true,
			},
      "user_name": {
				required: true,
        maxlength: 30,
        minlength: 5,
			},
      "password": {
				required: true,
				validatePassword: true,
				minlength: 8
			},
      "confirm_password": {
				required: true,
        equalTo: "#password",

			},
      "birthday": {
				required: false,
   
			},
    },
      messages: {
			"first_name": {
				required: "must enter",
        maxlength: "up to 50 characters",
        minlength:"at least 5 characters"
			},
      "last_name": {
				required: "must enter",
        maxlength: "up to 50 characters",
        minlength:"at least 5 characters"
			},
      "email": {
				required: "must enter",
			},
      "user_name": {
				required: "must enter",
        maxlength: "up to 30 characters",
        minlength:"at least 5 characters"
			},
      "confirm_password": {
				required: "must enter",
			},
      "birthday": {
				required:"must enter",
			},
		},
  
	});
  $.validator.addMethod("validatePassword", function (value, element) {
            return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
        }, "Hãy nhập password từ 8 đến 16 ký tự bao gồm chữ hoa, chữ thường và ít nhất một chữ số");
}
});
</script>