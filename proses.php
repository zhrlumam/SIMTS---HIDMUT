<?php include_once ('koneksi.php');
// session_start();
require ('cek-login.php');
if ($_SESSION['user_type'] !== 'siswa') {
    // Jika tidak, redirect ke halaman login
    header('Location: ../logout.php');
    exit();
} 

