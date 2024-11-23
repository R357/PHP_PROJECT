<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Capture form data
$Firstname = $_POST['Firstname'] ?? '';
$Lastname = $_POST['LastName'] ?? '';
$Email = $_POST['Email'] ?? '';
$Phno = $_POST['Phno'] ?? '';

// Database connection
$conn = new mysqli('localhost:8080', 'root', '', 'form_details');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO `registration details` (Firstname, Lastname, Email, Phno) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("ssss", $Firstname, $Lastname, $Email, $Phno);
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
