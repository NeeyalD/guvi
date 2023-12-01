document.addEventListener('DOMContentLoaded', function () {
    fetchUserProfile();
});

function fetchUserProfile() {
    $.ajax({
        type: "GET",
        url: "http://localhost/guvi/php/fetch_profile.php",
        dataType: "json",
        success: function (response) {
            if (response.success) {
                displayUserProfile(response.data);
            } else {
                alert(response.message);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function displayUserProfile(data) {
    document.getElementById('name').textContent = data.name;
    document.getElementById('dob').textContent = data.dob;
    document.getElementById('contact').textContent = data.contact;
    document.getElementById('age').textContent = calculateAge(data.dob);
}

function editProfile() {
    window.location.href = "edituser.html"; // Redirect to edituser.html
}

function saveChanges() {
    const formData = {
        name: document.getElementById('editName').value,
        dob: document.getElementById('editDOB').value,
        contact: document.getElementById('editContact').value,
    };

    $.ajax({
        type: "POST",
        url: "http://localhost/guvi/php/update_profile.php",
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

function cancelEdit() {
    document.getElementById('editForm').style.display = 'none';
}

function logout() {
    localStorage.removeItem('username');
    window.location.href = "login.html";
}
