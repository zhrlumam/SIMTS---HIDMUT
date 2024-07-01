<?php
include 'koneksibuku.php';
$db = new database();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {
    $db->input_buku(trim($_POST['judul']), trim($_POST['id_penulis']), trim($_POST['id_kategori']), trim($_POST['jumlah_hlm']), trim($_POST['tahun_terbit']), date("Y-m-d H:i:s"), trim($_POST['sinopsis']), trim($_FILES['nama_file']['name']), trim($_FILES['cover']['name']));
} elseif ($aksi == "hapus") {
    $db->hapus_buku($_GET['id_buku']);
} elseif ($aksi == "update") {
    $db->update_buku(trim($_POST['id_buku']), trim($_POST['judul']), trim($_POST['id_penulis']), trim($_POST['id_kategori']), trim($_POST['jumlah_hlm']), trim($_POST['tahun_terbit']), trim($_POST['sinopsis']), trim($_FILES['cover']['name']));
} elseif ($aksi == "tambah_penulis") {
    $db->input_penulis(trim($_POST['penulis']));
} elseif ($aksi == "hapus_penulis") {
    $db->hapus_penulis($_GET['id_penulis']);
} elseif ($aksi == "edit_penulis") {
    $db->update_penulis(trim($_POST['id_penulis']), trim($_POST['penulis']));
} elseif ($aksi == "tambah_kategori") {
    $db->input_kategori(trim($_POST['kategori']));
} elseif ($aksi == "hapus_kategori") {
    $db->hapus_kategori($_GET['id_kategori']);
} elseif ($aksi == "edit_kategori") {
    $db->update_kategori(trim($_POST['id_kategori']), trim($_POST['kategori']));
}

