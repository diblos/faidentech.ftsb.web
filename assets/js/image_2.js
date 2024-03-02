$(document).ready(function(){
    $("#image_2").load("../pages/image_2.php");
    setInterval(function() {
      $("#image_2").load("../pages/image_2.php");
    }, 1000);
  });
