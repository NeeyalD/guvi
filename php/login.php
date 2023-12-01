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

$enteredUsername = $_POST['username'];
$enteredPassword = $_POST['password'];

$sql = "SELECT * FROM userdata WHERE username = ? AND userpassword = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $enteredUsername, $enteredPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sessionId = bin2hex(random_bytes(16));
    $timestamp = time();

    $insertSessionSQL = "INSERT INTO session (username, session_id, timestamp) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($insertSessionSQL);
    $stmtInsert->bind_param("ssi", $enteredUsername, $sessionId, $timestamp);
    $stmtInsert->execute();

    $response = ["success" => true, "message" => "Login successful", "session_id" => $sessionId];
} else {
    $response = ["success" => false, "message" => "Invalid credentials"];
}

$stmt->close();
$stmtInsert->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
