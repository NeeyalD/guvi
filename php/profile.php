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

$sql = "SELECT username, dob, contact FROM user_profiles WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $enteredUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $response = ["success" => true, "data" => $data];
} else {
    $response = ["success" => false, "message" => "Failed to fetch user profile"];
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
