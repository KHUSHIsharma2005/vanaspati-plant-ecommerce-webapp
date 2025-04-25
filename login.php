<?php
session_start();

$Email = trim($_POST['email']);
$Password = trim($_POST['password']);

$conn = new mysqli('localhost', 'root', '', 'plants_nursery');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM Registration WHERE email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();

        if ($data['password'] === $Password) {
            // Set session if needed
            $_SESSION['user'] = $data['firstname'];
            echo '<script>alert("Login Successful!"); window.location="Homepage.html";</script>';
        } else {
            echo '<script>alert("Invalid Password!"); window.location="Login_Register.html";</script>';
        }
    } else {
        echo '<script>alert("Invalid Email or Password!"); window.location="Login_Register.html";</script>';
    }
}
?>
