$(document).ready(function() {
   $("#passwordForget").click(function() {
      var email = $("#email").val();
      
      if (email == '') {
         alert("Please fill out all of the fields.");
      }
      else {
         $.post("/../php/password-forget.php", {
            email: email,
         }, function(data) {
            alert(data);
         });
      }
   });

   $("#home").click(function() {
      window.location.href="/../index.php";
   });
});
