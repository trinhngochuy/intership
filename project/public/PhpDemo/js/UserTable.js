//ClientHeader
const array_id = [];
$('.user-name').click(function(){
    const elem = document.createElement('textarea');
    elem.value = $(this).text();
    document.body.appendChild(elem);
    elem.select();
    document.execCommand('copy');
    document.body.removeChild(elem);
 });

 $('.user-name').hover(function () {
    $(this).prev().css( "display", "block" );
}, function () {
$(this).prev().css( "display", "none" );
});
$(".alert").show("slow").delay(3000).hide("slow");
$(".close-error").click(function(e){
    $(".error").hide("slow");
});
$('.email').click(function(){
    const elem = document.createElement('textarea');
    elem.value = $(this).text();
    document.body.appendChild(elem);
    elem.select();
    document.execCommand('copy');
    document.body.removeChild(elem);
 });

 $('.email').hover(function () {
    $(this).prev().css( "display", "block" );
}, function () {
$(this).prev().css( "display", "none" );
});
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
    $(".close-error").click(function(){
        $(".test").hide();
    });
    $(".thumbnail").click(function(e){
        console.log(1);
        $('input[type=file]').click();
      });
    $( function() {
  $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:now",
        },
        $.datepicker.regional["fr"]
    );
});
});
 //Check All script
 $("#all").change(function(e) {
  if ($(this).prop("checked") == false) {
      while (array_id.length > 0) {
          array_id.pop();
      }
  }
});
$("#all").click(function(e) {
  while (array_id.length > 0) {
      array_id.pop();
  }
  $(".checkitem").prop("checked", $(this).prop("checked"))
  $(".checkitem").each(function(e) {
      array_id.push($(this).val());
  });

});
//remove element array_id
function remove(value) {

  const index = array_id.indexOf(value);
  if (index > -1) { array_id.splice(index, 1); }
}
$(".checkitem").change(function(e) {
  if ($(this).prop("checked") == true) {
      array_id.push($(this).val());
  }
  if ($(this).prop("checked") == false) {
      $("#all").prop("checked", false);
      remove($(this).val());
  }
  if ($(".checkitem:checked").length == $(".checkitem").length) {
      $("#all").prop("checked", true);
  }
});
var handlers = [
  // on first click:
  function() {
    $(".menus").show();
  },
  // on second click:
  function() {
    $(".menus").hide();
  }
];
var counter = 0;
$("#menu-buttom").click(function(){
    handlers[counter++].apply();
    counter %= handlers.length;
  });
