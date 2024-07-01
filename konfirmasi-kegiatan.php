<?php include_once ('koneksi.php');
// session_start();
require ('cek-login.php');
if ($_SESSION['user_type'] !== 'guru') {
    // Jika tidak, redirect ke halaman login
    header('Location: ../logout.php');
    exit();
}
$id_siswa = $_SESSION['id'];
// Check if form is submitted for deleting a kegiatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_hapus'])) {
    $id_kegiatan_hapus = $_POST['id_kegiatan_hapus'];

    // Query to get the image filename from the database
    $query_get_gambar = "SELECT GAMBAR FROM detail_kegiatan WHERE ID_DETAIL = '$id_kegiatan_hapus'";
    $result_get_gambar = mysqli_query($koneksi, $query_get_gambar);

    if (mysqli_num_rows($result_get_gambar) > 0) {
        $row = mysqli_fetch_assoc($result_get_gambar);
        $gambar_hapus = $row['GAMBAR'];
        $file_path = "C:/xampp/htdocs/simts-new/absen/" . $gambar_hapus;

        // Perform deletion from database
        $query_delete = "DELETE FROM detail_kegiatan WHERE ID_DETAIL = '$id_kegiatan_hapus'";
        $result_delete = mysqli_query($koneksi, $query_delete);

        if ($result_delete) {
            // If deletion from database is successful, attempt to delete the image file
            if (file_exists($file_path)) {
                unlink($file_path); // Delete the image file from the server
            }
            echo '<script>window.location.href = "konfirmasi-kegiatan.php?id_kegiatan=' . $id_kegiatan_hapus . '";</script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi); // Display error if deletion fails
        }
    }
}

// Cek apakah form telah disubmit
if (isset($_POST['ver'])) {
    // Tangkap data dari formulir
    $id_detail = $_POST['id_detail'];
    $kegiatan = $_POST['verifikasi'];

    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }

    $sql = "UPDATE detail_kegiatan SET
            KONFIRMASI_KEGIATAN = '$kegiatan'
            WHERE ID_DETAIL = '$id_detail'";

    if ($koneksi->query($sql) === TRUE) {
        echo '<script>window.location.href = window.location.href;</script>';
    } else {
        $alertMessage = "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Cek apakah form telah disubmit
if (isset($_POST['nover'])) {
    $id_detail = $_POST['id_detail'];
    $kegiatan = $_POST['verifikasi'];

    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }

    $sql = "UPDATE detail_kegiatan SET
            KONFIRMASI_KEGIATAN = '$kegiatan'
            WHERE ID_DETAIL = '$id_detail'";

    if ($koneksi->query($sql) === TRUE) {
        echo '<script>window.location.href = window.location.href;</script>';
    } else {
        $alertMessage = "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
$query_kelas = "SELECT DISTINCT KELAS FROM siswa";
$result_kelas = mysqli_query($koneksi, $query_kelas);

// Check if query executed successfully
if (!$result_kelas) {
    die("Query failed: " . mysqli_error($koneksi));
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="public/front-end/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="public/front-end/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
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
                            <?php echo htmlspecialchars($_SESSION['a_global']->NIP); ?>
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
                    <a class="nav-link " href="dashboard-guru.php">
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
                <li class="nav-item ">
                    <a class="nav-link " href="tugas-siswa.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tasks text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tugas siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="kegiatan-siswa.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-alt text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kegiatan siswa</span>
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Kegiatan siswa</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Kegiatan siswa</h6>
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
                            <a class="dropdown-item border-radius-md" href="profile-guru.php">
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
                            <div class="container mt-5">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Kelas
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php
                                        // Loop to generate dropdown items
                                        while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                                            $kelas = $row_kelas['KELAS'];
                                            echo "<li><a class='dropdown-item' href='?kelas=" . urlencode($kelas) . "'>$kelas</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>

                            </div>

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
                                                Kelas</th>
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
                                                Tanggal absen</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Konfirmasi</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    // Get the id_kegiatan from the URL
                                    $no = 1;
                                    $id_kegiatan = isset($_GET['id_kegiatan']) ? intval($_GET['id_kegiatan']) : 0;
                                    $id = $_SESSION['id'];
                                    // Fetch activity details based on id_kegiatan
                                    $query = "SELECT *,kegiatan.NAMA_KEGIATAN, siswa.NAMA AS NAMA_SISWA
          FROM detail_kegiatan
          JOIN siswa ON siswa.ID_SISWA = detail_kegiatan.ID_SISWA
          JOIN kegiatan ON kegiatan.ID_KEGIATAN = detail_kegiatan.ID_KEGIATAN
          WHERE detail_kegiatan.ID_KEGIATAN = $id_kegiatan";

                                    $pengajar = mysqli_query($koneksi, $query);

                                    if (mysqli_num_rows($pengajar) > 0) {
                                        while ($kegiatan = mysqli_fetch_array($pengajar)) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($kegiatan['NAMA_SISWA']); ?>
                                                    </td>
                                                    <td class="text-center"><?= htmlspecialchars($kegiatan['KELAS']); ?>
                                                    </td>
                                                    <td class="text-center"><?= htmlspecialchars($kegiatan['NAMA_KEGIATAN']); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= htmlspecialchars($kegiatan['KETERANGAN_KEGIATAN']); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-link" data-toggle="modal"
                                                            data-target="#gambarModal">
                                                            <img src="absen/<?= htmlspecialchars($kegiatan['GAMBAR']); ?>"
                                                                alt="gambar" style="width: 50px; height: 50px;">
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= htmlspecialchars($kegiatan['TANGGAL_ABSEN']); ?>
                                                    </td>
                                                    <td>
                                                        <!-- Di dalam loop untuk menampilkan detail kegiatan -->
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="d-flex align-items-center">
                                                                        <?php if ($kegiatan['KONFIRMASI_KEGIATAN'] == 0): ?>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id_detail"
                                                                                    value="<?= $kegiatan['ID_DETAIL']; ?>">
                                                                                <input type="hidden" name="verifikasi" value="1">
                                                                                <button type="submit" name="ver"
                                                                                    class="btn btn-success btn-sm text-center">
                                                                                    <i class="fas fa-check-circle"></i> Verifikasi
                                                                                </button>
                                                                            </form>
                                                                        <?php else: ?>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id_detail"
                                                                                    value="<?= $kegiatan['ID_DETAIL']; ?>">
                                                                                <input type="hidden" name="verifikasi" value="0">
                                                                                <button type="submit" name="nover"
                                                                                    class="btn btn-danger btn-sm text-center ml-2">
                                                                                    <i class="fas fa-times-circle"></i> Batalkan
                                                                                    Verifikasi
                                                                                </button>
                                                                            </form>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteAbsen">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- Modal for Hapus Absen -->
                                            <div class="modal fade" id="deleteAbsen" tabindex="-1" role="dialog"
                                                aria-labelledby="deleteAbsenLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteAbsenLabel">Konfirmasi Hapus Absen
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus absen kegiatan ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <!-- Form untuk penghapusan -->
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_kegiatan_hapus"
                                                                    id="id_kegiatan_hapus" value="<?= $kegiatan['ID_DETAIL']; ?>">
                                                                <button type="submit" class="btn btn-danger"
                                                                    name="submit_hapus">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Script JavaScript untuk menentukan id_kegiatan_hapus saat memanggil modal -->
                                            <script>
                                                $('#deleteAbsen').on('show.bs.modal', function (event) {
                                                    var button = $(event.relatedTarget); // Tombol yang memicu modal
                                                    var id_kegiatan = button.data('id_kegiatan'); // Extract info dari data-* attributes
                                                    var modal = $(this);
                                                    modal.find('.modal-footer #id_kegiatan_hapus').val(id_kegiatan);
                                                });
                                            </script>

                                            <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog"
                                                aria-labelledby="gambarModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="gambarModalLabel">Gambar Kegiatan</h5>
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

                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function loadKegiatan(kelas) {
                $.ajax({
                    url: 'load_kegiatan.php', // Ganti dengan file PHP yang menangani permintaan AJAX
                    type: 'POST',
                    data: { kelas: kelas },
                    success: function (response) {
                        $('.table-responsive').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var today = new Date().toISOString().split('T')[0];
                document.getElementById("tanggal_absen").value = today;
            });
        </script>


    </main>

    <!--   Core JS Files   -->
    <script src="public/front-end/assets/js/core/popper.min.js"></script>
    <script src="public/front-end/assets/js/core/bootstrap.min.js"></script>
    <script src="public/front-end/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="public/front-end/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="public/front-end/assets/js/plugins/chartjs.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="public/front-end/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>