<?php
include_once ('koneksi.php');
require ('cek-login.php');
if ($_SESSION['user_type'] !== 'siswa') {
    header('Location: ../logout.php');
    exit();
}

$id_siswa = $_SESSION['id'];

// Fungsi untuk insert data kegiatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_absen'])) {
    // Ambil data dari form
    $id_siswa = $_SESSION['id'];
    $id_kegiatan = $_POST['id_kegiatan'];
    $keterangan_kegiatan = $_POST['keterangan_kegiatan'];
    $gambar_kegiatan = $_FILES['gambar_kegiatan']['name'];
    $temp_gambar = $_FILES['gambar_kegiatan']['tmp_name'];

    // Ambil tanggal absen saat ini
    $tanggal_absen = date("Y-m-d");

    // Upload gambar ke folder di server (C:\xampp\htdocs\simts-new\absen)
    move_uploaded_file($temp_gambar, "C:/xampp/htdocs/simts-new/absen/" . $gambar_kegiatan);

    // Insert data kegiatan ke database
    $query_insert = "INSERT INTO detail_kegiatan (ID_KEGIATAN, ID_SISWA, KETERANGAN_KEGIATAN, GAMBAR, TANGGAL_ABSEN) 
                     VALUES ('$id_kegiatan', '$id_siswa', '$keterangan_kegiatan', '$gambar_kegiatan', '$tanggal_absen')";
    $result_insert = mysqli_query($koneksi, $query_insert);

    if ($result_insert) {
        // Redirect ke halaman detail kegiatan setelah operasi berhasil
        echo '<script>window.location.href = "detail-kegiatan.php?id_kegiatan=' . $id_kegiatan . '";</script>';
        exit();
    } else {
        // Jika gagal insert, tampilkan pesan error
        echo "Error: " . mysqli_error($koneksi);
    }
}


// Fungsi untuk menghapus absen kegiatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_hapus'])) {
    $id_kegiatan_hapus = $_POST['id_kegiatan_hapus'];

    // Ambil nama file gambar dari database sebelum menghapus entri
    $query_get_gambar = "SELECT GAMBAR FROM detail_kegiatan WHERE ID_KEGIATAN = '$id_kegiatan_hapus' AND ID_SISWA = '$id_siswa'";
    $result_get_gambar = mysqli_query($koneksi, $query_get_gambar);

    if (mysqli_num_rows($result_get_gambar) > 0) {
        $row = mysqli_fetch_assoc($result_get_gambar);
        $gambar_hapus = $row['GAMBAR'];
        $file_path = "C:/xampp/htdocs/simts-new/absen/" . $gambar_hapus;

        // Hapus data kegiatan dari database
        $query_delete = "DELETE FROM detail_kegiatan WHERE ID_KEGIATAN = '$id_kegiatan_hapus' AND ID_SISWA = '$id_siswa'";
        $result_delete = mysqli_query($koneksi, $query_delete);

        if ($result_delete) {
            // Hapus file gambar dari folder
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            echo '<script>window.location.href = "detail-kegiatan.php?id_kegiatan=' . $id_kegiatan_hapus . '";</script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="public/front-end/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="public/front-end/assets/img/logomts.svg">
    <title>
        SI-MTs hidayatul muta'allimin
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="public/front-end/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="public/front-end/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="public/front-end/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="public/front-end/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>
<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-success position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0">
                <div class="d-flex align-items-center">
                    <img src="public/front-end/assets/img/logomts.svg" class="navbar-brand-img h-100" alt="main_logo">
                    <div class="ms-3">
                        <span class="font-weight-bold d-block">SI-MTs hidmut</span>
                        <span>
                            <?php echo htmlspecialchars($_SESSION['a_global']->NISN); ?>
                            <i class="fas fa-circle" style="color: green;"></i> <!-- Ikon titik online -->
                            <span class="caret"></span>
                        </span>


                    </div>
                </div>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard-siswa.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-home text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Menu</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tugas.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tasks text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tugas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="kegiatan.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-alt text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kegiatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="pembayaran.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-money-bill-wave text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pembayaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ruang-baca.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-book-open text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ruang baca</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
            <div class="card card-plain shadow-none" id="sidenavCard">
                <img class="w-50 mx-auto" src="public/front-end/assets/img/illustrations/icon-documentation.svg"
                    alt="sidebar_illustration">
                <div class="card-body text-center p-3 w-100 pt-0">
                    <div class="docs-info">
                        <h6 class="mb-0">SI MTS</h6>
                        <p class="text-xs font-weight-bold mb-0">MTs Hidayatul Muta'allimin bugoharjo</p>
                    </div>
                </div>
            </div>

        </div>
    </aside>

    <main class="main-content position-relative border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Absen kegiatan</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Absen kegiatan</h6>
                </nav>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>

                <li class="nav-item dropdown pe-0 d-flex ">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none text-white">Profile</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="profile-siswa.php">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="public/front-end/assets/img/team-2.jpg"
                                            class="avatar avatar-sm me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="text-xs text-secondary mb-0">
                                            <span>Profil Saya</span>
                                        </p>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-user me-1">
                                                <?php echo htmlspecialchars($_SESSION['a_global']->NAMA); ?></i>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="logout.php">
                                <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-danger me-3 my-auto">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="text-xs text-secondary mb-0">
                                            Logout
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                </ul>
            </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4>Absen Kegiatan</h4>
                            <p>Silahkan Absen tentang kegiatan ini.</p>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#addAbsenTugas">Absen kegiatan</button>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Kegiatan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Keterangan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Gambar</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Konfirmasi</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal absen</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $id_kegiatan = isset($_GET['id_kegiatan']) ? intval($_GET['id_kegiatan']) : 0;
                                        $id_siswa = $_SESSION['id'];  // Assuming this is the student's ID
                                        
                                        // Fetch activity details based on id_kegiatan and current user
                                        $query = "SELECT k.*, d.KETERANGAN_KEGIATAN, d.GAMBAR, d.KONFIRMASI_KEGIATAN, d.TANGGAL_ABSEN 
                                          FROM kegiatan k 
                                          LEFT JOIN detail_kegiatan d ON k.ID_KEGIATAN = d.ID_KEGIATAN 
                                          WHERE k.ID_KEGIATAN = $id_kegiatan
                                          AND d.ID_SISWA = $id_siswa";  // Assuming ID_SISWA is the column for user ID in 'detail_kegiatan' table
                                        
                                        $result = mysqli_query($koneksi, $query);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($kegiatan = mysqli_fetch_array($result)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td class="text-center"><?= $_SESSION['nama'] ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($kegiatan['NAMA_KEGIATAN']); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= htmlspecialchars($kegiatan['KETERANGAN_KEGIATAN']); ?></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-link" data-toggle="modal"
                                                            data-target="#gambarModal">
                                                            <img src="absen/<?= htmlspecialchars($kegiatan['GAMBAR']); ?>"
                                                                alt="gambar" style="width: 50px; height: 50px;">
                                                        </button>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <?php if ($kegiatan['KONFIRMASI_KEGIATAN'] == 1) { ?>
                                                            <span class="badge badge-sm bg-gradient-success">Sudah
                                                                Dikonfirmasi</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-sm bg-gradient-warning">Belum
                                                                Dikonfirmasi</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center"><?= htmlspecialchars($kegiatan['TANGGAL_ABSEN']); ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteAbsen">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Gambar Modal -->
                                                <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="gambarModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="gambarModalLabel">Gambar Kegiatan
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="absen/<?= htmlspecialchars($kegiatan['GAMBAR']); ?>"
                                                                    alt="gambar" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="8" class="text-center"
                                                    style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px;">
                                                    Anda belum absen kegiatan
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal for Hapus Absen -->
        <div class="modal fade" id="deleteAbsen" tabindex="-1" role="dialog" aria-labelledby="deleteAbsenLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAbsenLabel">Konfirmasi Hapus Absen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus absen kegiatan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="" method="POST">
                            <input type="hidden" name="id_kegiatan_hapus" value="<?= $id_kegiatan; ?>">
                            <button type="submit" class="btn btn-danger" name="submit_hapus">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Absen Kegiatan -->
        <div class="modal fade" id="addAbsenTugas" tabindex="-1" role="dialog" aria-labelledby="addAbsenTugasLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAbsenTugasLabel">Absen Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="keterangan_kegiatan">Keterangan</label>
                                <textarea class="form-control" id="keterangan_kegiatan" name="keterangan_kegiatan"
                                    rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_absen">Tanggal Absen</label>
                                <input type="date" class="form-control" id="tanggal_absen" name="tanggal_absen"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="gambar_kegiatan">Upload Gambar</label>
                                <input type="file" class="form-control" id="gambar_kegiatan" name="gambar_kegiatan"
                                    required>
                            </div>

                            <input type="hidden" name="id_kegiatan" value="<?= $id_kegiatan; ?>">
                            <button type="submit" class="btn btn-primary" name="submit_absen">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var today = new Date().toISOString().split('T')[0];
                document.getElementById("tanggal_absen").value = today;
            });
        </script>





    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>