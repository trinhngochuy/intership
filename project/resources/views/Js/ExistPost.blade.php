<script>  
    ClassicEditor
        .create( document.querySelector( '#editor-content' ) )
        .then( editor => {
             var content ="{{$post->content}}";
    
             editor.setData(content);
        } )
        .catch( error => {
            console.error( error );
        } );</script>
            <script>
                $("#datepicker" ).datepicker();
        $(".upimg").click(function(){
            $("input[name=image]").click();
        });
        $("input[name=image]").change(function(){
            var formData = new FormData($('form')[0]);
         console.log(formData);
         $.ajax({
                type: "POST",
                url: "/upload",
                processData: false,
            contentType: false,
                data: formData,
                success: function(data)
                {
                  $(".image").html(data.upload_image);
                  let images = $('#thumbnail_image').attr("src");
            $('input[name=thumbnail]').val(images);
                }
            });
        });
        </script>