<?php
$conn = new mysqli("localhost", "root", "", "auto_zone");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['full_name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (full_name, email, password)
        VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>