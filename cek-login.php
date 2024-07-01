<?php
session_start();

// Cek apakah sesi username ada
if (!isset($_SESSION['username'])) {
    // Jika tidak, redirect ke halaman login
    echo '<script>alert("Anda belum login. Silakan login terlebih dahulu."); window.location="login.php";</script>';
    exit(); // Pastikan untuk menghentikan eksekusi script setelah pengalihan
}
