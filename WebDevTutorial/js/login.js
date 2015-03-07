$(document).ready(function(){
   $("#login").click(function(){
      $.post("/../php/login.php", {
         Username: $("#user").val(),
         Password: $("#pass").val(),
      }, function(data) {
         if (data == "Login Success!") {
            window.location.href="/../main.php";
         } else {
            alert(data);
         }
      });
   });
});