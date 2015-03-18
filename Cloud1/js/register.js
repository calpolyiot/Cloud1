$(document).ready(function() {
   $("#register").click(function() {
      var firstName = $("#firstName").val();
      var lastName = $("#lastName").val();
      var username = $("#username").val();
      var email = $("#email").val();
      var password = $("#password").val();
      var cpassword = $("#cpassword").val();
      
      if (firstName == '' || lastName == '' || username == '' 
       || email == '' || password == '' || cpassword == '') {
         alert("Please fill out all fields.");
      } 
      else if (username.length < 3 || username.length > 24) {
         alert("Username must be between 3-24 characters long.");
      }
      else if (password.length < 5 || password.length > 24) {
         alert("Password must be at least 5-24 characters long.");
      } 
      else if (password != cpassword) {
         alert("Your passwords don't match. Please try again.");
      } 
      else {
         $.post("/../php/register.php", {
            firstName: firstName,
            lastName: lastName,
            username: username,
            email: email,
            password: password
         }, function(data) {
            if (data == "Registration Success!") {
               window.location.href="/../index.php";
            } else {
               alert(data);
            }
         });
      }
   });
   
   $("#home").click(function() {
      window.location.href="/../index.php";
   });
});