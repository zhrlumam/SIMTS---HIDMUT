<?php
// Konfigurasi koneksi database
$host = "localhost"; // Ganti dengan nama host database Anda
$user = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan password database Anda
$database = "simts_db"; // Ganti dengan nama database Anda

// Buat koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk membersihkan input
function bersihkanInput($data)
{
    global $koneksi;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $koneksi->real_escape_string($data);
}
