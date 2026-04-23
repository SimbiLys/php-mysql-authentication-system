<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // --- Basic server-side validation ---
    if (empty($fullname) || empty($email) || empty($password)) {
        header('Location: signup.php?error=All fields are required.');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: signup.php?error=Please enter a valid email address.');
        exit();
    }

    if (strlen($password) < 6) {
        header('Location: signup.php?error=Password must be at least 6 characters.');
        exit();
    }

    if ($password !== $confirm) {
        header('Location: signup.php?error=Passwords do not match.');
        exit();
    }

    // --- Check if email already exists ---
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        header('Location: signup.php?error=An account with this email already exists.');
        $check->close();
        exit();
    }
    $check->close();

    // --- Hash password and insert ---
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $hashed_password);

    if ($stmt->execute()) {
        header('Location: login.php?success=Account created! You can now log in.');
    } else {
        header('Location: signup.php?error=Something went wrong. Please try again.');
    }

    $stmt->close();
    $conn->close();

} else {
    header('Location: signup.php');
}
exit();
?>
