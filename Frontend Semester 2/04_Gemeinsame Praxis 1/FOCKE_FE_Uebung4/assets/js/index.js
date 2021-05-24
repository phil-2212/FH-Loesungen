$(document).ready(function(){
  $.ajax({url: "assets/php/index.php?action=listTypes", success: function(result){

    $("#restful-area").html(result);

    $(document).ready(function(){
      $("button").on("click", function(){
        $.ajax({url: "assets/php/index.php?action=listProductsByTypeId&categoryId=" + $(this).attr('category'), success: function(result){

          $("#restful-area").html(result);
        }});
      });
    });

  }});
});
