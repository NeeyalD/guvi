<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials: true');
$servername = "sql12.freesqldatabase.com";
$username = "sql12666748";
$password = "fF3LvF38ac";
$dbname = "sql12666748";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);


$stmt = $conn->prepare("INSERT INTO userdata (username, userpassword) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

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
