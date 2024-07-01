<?php
// Sambungkan dengan file koneksi.php
include 'koneksi.php';
// session_start();

// Periksa apakah fungsi bersihkanInput sudah ada atau belum
if (!function_exists('bersihkanInput')) {
    // Jika belum, deklarasikan fungsi tersebut
    function bersihkanInput($data)
    {
        global $koneksi; // Tambahkan ini untuk mengakses variabel $koneksi di dalam fungsi

        // Hindari SQL Injection
        $data = mysqli_real_escape_string($koneksi, $data);

        // Bersihkan dari karakter HTML dan PHP yang tidak diizinkan
        return htmlspecialchars(trim($data));
    }
}

// Ambil data yang dikirimkan melalui form login
$username = bersihkanInput($_POST['username']);
$password = bersihkanInput($_POST['password']);
$user_type = bersihkanInput($_POST['user_type']);

// Hash password sebelum membandingkan dengan yang ada di database
$password = md5($password); // Sebaiknya gunakan metode hashing yang lebih aman, ini hanya contoh sederhana

// Buat kueri SQL berdasarkan tipe pengguna
$query = "SELECT * FROM ";

// Tambahkan nama tabel sesuai dengan tipe pengguna
if ($user_type == 'siswa') {
    $query .= "siswa";
} elseif ($user_type == 'guru') {
    $query .= "guru";
} elseif ($user_type == 'admin') {
    $query .= "admin";
} else {
    // Jika tipe pengguna tidak valid, atur pesan kesalahan atau redirect ke halaman lain
    header('Location:login.php');
}

$query .= " WHERE USERNAME='$username' AND PASSWORD='$password'";

// Jalankan kueri
$result = $koneksi->query($query);

// Periksa apakah kueri berhasil dijalankan
if ($result) {
    // Periksa apakah hasil kueri mengembalikan baris data
    if ($result->num_rows > 0) {
        // Pengguna berhasil login, lakukan tindakan yang diperlukan, misalnya, atur sesi atau arahkan ke halaman lain
        session_start();
        $d = mysqli_fetch_object($result);
        $_SESSION['status-login'] = true;
        $_SESSION['a_global'] = $d;

        // Contoh: atur sesi username
        $_SESSION['username'] = $username;

        // Redirect ke halaman selamat datang atau halaman lain yang sesuai
        if ($user_type == 'siswa') {
            $_SESSION['id'] = $d->ID_SISWA;
            $_SESSION['nama'] = $d->NAMA;
            $_SESSION['kelas'] = $d->KELAS;
            $_SESSION['user_type'] = $user_type; // Ganti variabel yang salah dari $usertype ke $user_type
            header('Location:dashboard-siswa.php');
        } elseif ($user_type == 'guru') {
            $_SESSION['id'] = $d->ID_GURU;
            $_SESSION['id_pengajar'] = $d->ID_PENGAJAR;
            $_SESSION['user_type'] = $user_type; // Ganti variabel yang salah dari $usertype ke $user_type
            header('Location:dashboard-guru.php');
        } elseif ($user_type == 'admin') {
            $_SESSION['id'] = $d->ID_ADMIN;
            $_SESSION['user_type'] = $user_type; // Ganti variabel yang salah dari $usertype ke $user_type
            header('Location:dashboard-admin.php');
        } else {
            // Jika tipe pengguna tidak valid, atur pesan kesalahan atau redirect ke halaman lain
            die("Tipe pengguna tidak valid");
        }
        exit();
    } else {
        // Jika tidak ada baris yang cocok, tampilkan pesan kesalahan atau redirect ke halaman login dengan pesan kesalahan
        header('Location:login.php?error=1');
        exit();
    }
} else {
    // Jika kueri gagal dijalankan, tampilkan pesan kesalahan atau redirect ke halaman login dengan pesan kesalahan
    header('Location:login.php?error=2');
    exit();
}
