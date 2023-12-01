<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
session_start();

$servername = "sql12.freesqldatabase.com";
$username = "sql12666748";
$password = "fF3LvF38ac";
$dbname = "sql12666748";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$enteredUsername = $_SESSION['username'];
$editedName = $_POST['editName'];
$editedDOB = $_POST['editDOB']; 
$editedContact = $_POST['editContact']; 

$sql = "UPDATE userinfo SET username = ?, dob = ?, contact = ? WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $editedName, $editedDOB, $editedContact, $enteredUsername);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $response = ["success" => true, "message" => "Profile updated successfully"];
} else {
    $response = ["success" => false, "message" => "Failed to update profile"];
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
