<?php
class Database
{
    function __construct()
    {
        $host   = "localhost";
        $username = "root";
        $password = "";
        $database = "simts_db";

        $con = mysqli_connect($host, $username, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }

        $this->con = $con;
    }

    //tabel anggota
    function tampil_data_buku($query)
    {
        $this->query = $query;
        $data = mysqli_query($this->con, "SELECT * FROM buku JOIN penulis USING (id_penulis) JOIN kategori USING (id_kategori)");
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function tampil_data_penulis($query)
    {
        $this->query = $query;
        $data = mysqli_query($this->con, "SELECT * FROM penulis ORDER BY penulis ASC");
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function tampil_data_kategori($query)
    {
        $this->query = $query;
        $data = mysqli_query($this->con, "SELECT * FROM kategori ORDER BY kategori ASC");
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function input_buku($judul, $id_penulis, $id_kategori, $jumlah_hlm, $tahun_terbit, $tgl_masuk, $sinopsis, $nama_file, $cover)
    {
        //pengecekan tipe harus pdf
        $tipe_file = $_FILES['nama_file']['type']; //mendapatkan mime type
        $tipe_file_cover = $_FILES['cover']['type']; //mendapatkan mime type
        if ($tipe_file == "application/pdf" && $tipe_file_cover == "image/jpeg" || $tipe_file_cover == "image/png") //mengecek apakah file tersebut pdf atau bukan
        {
            $sql = "INSERT INTO buku (id_buku, judul, id_penulis, id_kategori, jumlah_hlm, tahun_terbit, tgl_masuk, sinopsis) VALUES ('','$judul','$id_penulis','$id_kategori', '$jumlah_hlm', '$tahun_terbit', '$tgl_masuk', '$sinopsis')";
            mysqli_query($this->con, $sql); //simpan data dahulu untuk mendapatkan id_buku

            //dapatkan id_buku terakhir
            $query = mysqli_query($this->con, "SELECT id_buku FROM buku ORDER BY id_buku DESC LIMIT 1");
            $data = mysqli_fetch_array($query);

            //mengganti nama pdf
            $nama_baru = "file_" . $data['id_buku'] . ".pdf"; //hasil contoh: file_1.pdf
            $nama_baru_cover = "cover_" . $data['id_buku'] . ".png"; //hasil contoh: cover_1.png
            $file_temp = $_FILES['nama_file']['tmp_name']; //data temp yang di upload
            $file_temp_cover = $_FILES['cover']['tmp_name']; //data temp yang di upload
            $folder = "file"; //folder tujuan

            move_uploaded_file($file_temp, "$folder/buku/$nama_baru"); //fungsi upload
            move_uploaded_file($file_temp_cover, "$folder/cover/$nama_baru_cover"); //fungsi upload
            //update nama file di database
            mysqli_query($this->con, "UPDATE buku SET nama_file='$nama_baru', cover='$nama_baru_cover' WHERE id_buku='$data[id_buku]' ");

            if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :
                echo "<script>alert('Data Berhasil Ditambah')</script>";
                echo "<meta http-equiv='refresh' content='0;list_buku.php'>";
            } else {
                // Jika Gagal, Lakukan :
                echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk ditambah data ke database.')</script>";        //Pesan jika proses tambah gagal
                echo "<meta http-equiv='refresh' content='0;list_buku.php'>";
            }

            // header('location:list_buku.php?pesan=upload-berhasil');
        } else {
            echo "Gagal Upload File Bukan PDF! <a href='../index.php'> Kembali </a>";
        }
    }

    function input_penulis($penulis)
    {
        $sql = "INSERT INTO penulis (id_penulis, penulis) VALUES ('', '$penulis')";
        mysqli_query($this->con, $sql);
        header('location:list_penulis.php?pesan=tambah-penulis-berhasil');
    }

    function input_kategori($kategori)
    {
        $sql = "INSERT INTO kategori (id_kategori, kategori) VALUES ('', '$kategori')";
        mysqli_query($this->con, $sql);
        header('location:list_kategori.php?pesan=tambah-kategori-berhasil');
    }

    function hapus_buku($id_buku)
    {
        $sql = mysqli_query($this->con, "DELETE FROM buku WHERE id_buku='$id_buku'");
        if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
            // Jika Sukses, Lakukan :
            echo "<script>alert('Data Berhasil Dihapus')</script>";
            echo "<meta http-equiv='refresh' content='0;index.php'>";
        } else {
            // Jika Gagal, Lakukan :
            echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menghapus data ke database.')</script>";        //Pesan jika proses tambah gagal
            echo "<meta http-equiv='refresh' content='0;index.php'>";
        }
    }

    function hapus_penulis($id_penulis)
    {
        // Escape the variable to prevent SQL injection
        $id_penulis = mysqli_real_escape_string($this->con, $id_penulis);
    
        // Construct the SQL query
        $sql = "DELETE FROM penulis WHERE id_penulis='$id_penulis'";
    
        // Execute the query
        if (mysqli_query($this->con, $sql)) {
            // If successful, show a success message and refresh the page
            echo "<script>alert('Data Berhasil Dihapus');</script>";
            echo "<meta http-equiv='refresh' content='0;url=list_penulis.php'>";
        } else {
            // If an error occurs, show an error message and refresh the page
            echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menghapus data ke database.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=list_penulis.php'>";
        }
    }
    

    function hapus_kategori($id_kategori)
    {
        // Escape the variable to prevent SQL injection
        $id_kategori = mysqli_real_escape_string($this->con, $id_kategori);
    
        // Construct the SQL query
        $sql = "DELETE FROM kategori WHERE id_kategori='$id_kategori'";
    
        // Execute the query
        if (mysqli_query($this->con, $sql)) {
            // If successful, show a success message and refresh the page
            echo "<script>alert('Data Berhasil Dihapus');</script>";
            echo "<meta http-equiv='refresh' content='0;url=list_kategori.php'>";
        } else {
            // If an error occurs, show an error message and refresh the page
            echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menghapus data ke database.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=list_kategori.php'>";
        }
    }
    

    function edit_buku($id_buku)
    {
        $sql = "SELECT * FROM buku WHERE id_buku='$id_buku'";
        $data = mysqli_query($this->con, $sql);
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function edit_penulis($id_penulis)
    {
        $sql = "SELECT * FROM penulis WHERE id_penulis='$id_penulis'";
        $data = mysqli_query($this->con, $sql);
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function edit_kategori($id_kategori)
    {
        $sql = "SELECT * FROM kategori WHERE id_kategori='$id_kategori'";
        $data = mysqli_query($this->con, $sql);
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function update_buku($id_buku, $judul, $id_penulis, $id_kategori, $jumlah_hlm, $tahun_terbit, $sinopsis, $cover)
    {
        //pengecekan tipe harus pdf
        $tipe_file_cover = $_FILES['cover']['type']; //mendapatkan mime type
        if ($tipe_file_cover == "image/jpeg" || $tipe_file_cover == "image/png") //mengecek apakah file tersebut pdf atau bukan
        {
            $sql = "UPDATE buku SET judul='$judul', id_penulis='$id_penulis', id_kategori='$id_kategori', jumlah_hlm='$jumlah_hlm', tahun_terbit='$tahun_terbit',  sinopsis='$sinopsis' WHERE id_buku='$id_buku'";
            mysqli_query($this->con, $sql); //simpan data dahulu untuk mendapatkan id_buku

            //mengganti nama pdf
            $nama_baru_cover = "cover_" . $id_buku . ".png"; //hasil contoh: cover_1.png
            $file_temp_cover = $_FILES['cover']['tmp_name']; //data temp yang di upload
            $folder = "file"; //folder tujuan

            move_uploaded_file($file_temp_cover, "$folder/cover/$nama_baru_cover"); //fungsi upload
            //update nama file di database
            mysqli_query($this->con, "UPDATE buku SET cover='$nama_baru_cover' WHERE id_buku='$id_buku' ");

            header('location:list_buku.php?pesan=update-buku-berhasil');

        } else {
            echo "Gagal Upload File Bukan PDF! <a href='../index.php'> Kembali </a>";
        }
    }

    function update_penulis($id_penulis, $penulis)
    {
        // Escape the variables to prevent SQL injection
        $id_penulis = mysqli_real_escape_string($this->con, $id_penulis);
        $penulis = mysqli_real_escape_string($this->con, $penulis);
    
        // Construct the SQL query
        $sql = "UPDATE penulis SET penulis='$penulis' WHERE id_penulis='$id_penulis'";
    
        // Execute the query
        if (mysqli_query($this->con, $sql)) {
            // Redirect to the list page with a success message
            header('location:list_penulis.php?pesan=update-penulis-berhasil');
        } else {
            // Handle the error if the query fails
            echo "Error updating record: " . mysqli_error($this->con);
        }
    }
    

    function update_kategori($id_kategori, $kategori)
{
    // Escape the variables to prevent SQL injection
    $id_kategori = mysqli_real_escape_string($this->con, $id_kategori);
    $kategori = mysqli_real_escape_string($this->con, $kategori);

    // Construct the SQL query
    $sql = "UPDATE kategori SET kategori='$kategori' WHERE id_kategori='$id_kategori'";

    // Execute the query
    if (mysqli_query($this->con, $sql)) {
        // If successful, redirect to the list page with a success message
        header('location:list_kategori.php?pesan=update-kategori-berhasil');
    } else {
        // If an error occurs, display an error message
        echo "Error updating record: " . mysqli_error($this->con);
    }
}

}
