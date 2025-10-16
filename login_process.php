<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: dashboard_nama_nim.php");
    exit;
}

// Data login yang benar
$valid_username = "user";
$valid_email = "admin@gmail.com";
$valid_password = "12345";

// Ambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validasi username hanya huruf dan angka
if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
    echo "<script>alert('Username hanya boleh huruf dan angka!'); window.location='login.html';</script>";
    exit;
}

// Validasi format Gmail
if (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
    echo "<script>alert('Gunakan email Gmail yang valid!'); window.location='login.html';</script>";
    exit;
}

// Cek kecocokan data login
if ($username === $valid_username && $email === $valid_email && $password === $valid_password) {
    $_SESSION['username'] = $username;
    header("Location: dashboard_nama_nim.php");
    exit;
} else {
    echo "<script>alert('Username, email, atau password salah!'); window.location='login.html';</script>";
    exit;
}
?>
