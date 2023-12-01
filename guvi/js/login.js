$(document).ready(function () {

    var storedUsername = localStorage.getItem('enteredUsername');
    var storedPassword = localStorage.getItem('enteredPassword');
  
    if (storedUsername && storedPassword) {
      $("#loginname").val(storedUsername);
      $("#loginpassword").val(storedPassword);
    }
  
    $("#loginForm").submit(function (e) {
      e.preventDefault();
  
      var enteredUsername = $("#loginname").val();
      var enteredPassword = $("#loginpassword").val();
  
      localStorage.setItem('enteredUsername', enteredUsername);
      localStorage.setItem('enteredPassword', enteredPassword);
  
      $.ajax({
        type: "POST",
        url: "http://localhost/guvi/php/login.php",
        data: {
          username: enteredUsername,
          password: enteredPassword
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            localStorage.setItem('username', enteredUsername);
            window.location.href = "profile.html";
          } else {
            $("#errorMessage").text(response.message);
          }
        },
        error: function (error) {
          console.log(error);
        }
      });
    });
  });
  