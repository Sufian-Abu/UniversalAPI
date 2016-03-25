$(document).ready(function(){
    $("#output").modal('show');
  });

$("form").submit(function(){
  $.post($(this).attr("action"), $(this).serialize());
  return false;
});



    $(function()
    {
        $('#fileUpload').on('change',function ()
        {
            var filePath = $(this).val();
            console.log(filePath);
        });
    });