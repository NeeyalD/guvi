$(document).ready(function () {
    $("#signupForm").submit(function (e) {
        e.preventDefault();

        var formData = {
            name: $("#username").val(),
            password: $("#password").val()
        };

        $.ajax({
            type: "POST",
            url: "http://localhost/guvi/php/register.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = "login.html";
                } else {
                    alert(response.message);
                    alert("data isnt stored");
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
