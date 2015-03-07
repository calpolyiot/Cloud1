$(document).ready(function() {
   $("#passwordReset").click(function() {
      var email = $("#email").val();
      var oldPassword = $("#oldPassword").val();
      var newPassword = $("#newPassword").val();
      var cNewPassword = $("#cNewPassword").val();
      
      if (email == '' || oldPassword == '' || newPassword == '' || cNewPassword == '') {
         alert("Please fill out all of the fields.");
      }
      else if (newPassword.length < 5 || newPassword.length > 24) {
         alert("New password must be 5-24 characters long.");
      } 
      else if (newPassword != cNewPassword) {
         alert("The new password fields don't match. Please try again.");
      } 
      else {
         $.post("/../php/password-reset.php", {
            email: email,
            oldPassword: oldPassword,
            newPassword: newPassword,
            cNewPassword: cNewPassword
         }, function(data) {
            alert(data);
         });
      }
   });

   $("#home").click(function() {
      window.location.href="/../index.php";
   });
});
