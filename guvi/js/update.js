document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('editForm');

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();
        saveChanges();
    });
});

function saveChanges() {
    const formData = $('#editForm').serialize();  // Serialize the form data

    $.ajax({
        type: "POST",
        url: "http://localhost/guvi/php/updateuser.php",
        data: formData,
        dataType: "json",
        success: function (response) {
            if (response.success) {
                alert("Changes saved successfully");
                displayUserProfile(response.data);
                document.getElementById('editForm').style.display = 'none';
                window.location.href = "../html/profile.html";
            } else {
                alert(response.message);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}
