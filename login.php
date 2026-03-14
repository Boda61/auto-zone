<?php
session_start();
$conn = new mysqli("localhost", "root", "", "auto_zone");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        $_SESSION['user'] = $row['full_name'];
        header("Location: index.html");
        exit();
    } else {
        echo "Wrong password!";
    }

} else {
    echo "Email not found!";
}

$conn->close();
?>