<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials: true');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guvi";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO userdata (username, userpassword) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

$username = $_POST['name'];
$password = $_POST['password'];

if ($stmt->execute()) {
    $response = ["success" => true, "message" => "User registered successfully"];
} else {
    $response = ["success" => false, "message" => "Error: " . $stmt->error];
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>