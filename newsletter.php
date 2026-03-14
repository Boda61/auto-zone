<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "auto_zone";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$email = $conn->real_escape_string($email);

// Check duplicate
$check = "SELECT * FROM newsletter WHERE email = '$email' LIMIT 1";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "<script>alert('This email is already subscribed!'); window.location.href='index.html';</script>";
    exit;
}

$sql = "INSERT INTO newsletter (email, subscribed_at) VALUES ('$email', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Subscribed successfully!'); window.location.href='index.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
