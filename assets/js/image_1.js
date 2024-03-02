$(document).ready(function(){
    $("#image_1").load("../pages/image_1.php");
    setInterval(function() {
      $("#image_1").load("../pages/image_1.php");
    }, 1000);
  });
