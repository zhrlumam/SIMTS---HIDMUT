<?php
include_once ('koneksi.php');
require ('cek-login.php');

if ($_SESSION['user_type'] !== 'guru') {
    // Jika tidak, redirect ke halaman login
    header('Location: ../logout.php');
    exit();
}

// Handle form submission
if (isset($_POST['submit_nilai'])) {
    $nilai = $_POST['nilai'];
    $idt = $_POST['idtugas'];

    // Sanitize input
    $nilai = mysqli_real_escape_string($koneksi, $nilai);

    // Insert the nilai into the detail_tugas table
    $query = "UPDATE detail_tugas SET NILAI = '$nilai' WHERE ID_DETAIL_TUGAS = '$idt'";
    if (mysqli_query($koneksi, $query)) {
        // Reload the current page
        echo '<script>window.location.href = window.location.href;</script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
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
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .table-container, .table-container * {
            visibility: visible !important;
        }
        .table-container {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>

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
                <li class="nav-item">
                    <a class="nav-link active" href="tugas-siswa.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tasks text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tugas siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kegiatan-siswa.php">
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Pengumpulan tugas
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Pengumpulan tugas</h6>
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
                            <p>Pengumpulan tugas</p>
                            <h6>Tugas harian siswa</h6>
                            <button class="btn btn-primary mb-3 d-print-none" onclick="printPage()">Cetak Pengumpulan
                                Tugas</button>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Tugas</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Pengumpulan</th>
                                            <!-- Action column only for screen view -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $id = $_SESSION['id'];
                                        $idt = isset($_GET['idt']) ? $_GET['idt'] : null;
                                        $idp = isset($_GET['idp']) ? $_GET['idp'] : null;
                                        $tugas = mysqli_query($koneksi, "SELECT * FROM tugas WHERE ID_TUGAS = $idt");
                                        if (mysqli_num_rows($tugas) > 0) {
                                            while ($row = mysqli_fetch_array($tugas)) {
                                                $id_tugas = $row['ID_TUGAS'];
                                                ?>
                                                <tr>
                                                    <td class="text-center" style="color: black;"><?php echo $no++; ?></td>
                                                    <td style="color: black;">
                                                        <?php echo wordwrap($row['NAMA_TUGAS'], 40, "<br>"); ?>
                                                    </td>
                                                    <td style="color: black;">
                                                        <?php echo wordwrap($row['KETERANGAN_TUGAS'], 40, "<br>"); ?>
                                                    </td>

                                                    <td class="text-center" style="color: black;">
                                                        <?php echo $row['TANGGAL_PENGUMPULAN']; ?>
                                                    </td>
                                                    

                                                      
                                                        <span class="d-none d-print-block">
                                                            <i class="fas fa-edit"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data tugas yang tersedia.</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                                                    </table>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <?php
                                $query = "SELECT *,siswa.NAMA, siswa.KELAS
                                FROM detail_tugas JOIN siswa ON siswa.ID_SISWA = detail_tugas.ID_SISWA  WHERE ID_TUGAS = '$id_tugas'";
                                $result = mysqli_query($koneksi, $query);
                                ?>
                               <div class="table-container">
                               <table class="table table-striped table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Kelas</th>
                                                <th style="width: 250px;">Jawaban</th>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center d-print-none">Action</th><!-- Action column only for screen view -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td style="color: black;"><?php echo $no++; ?></td>
                                                    <td class="text-center" style="color: black;">
                                                        <?php echo $row['NAMA']; ?>
                                                    </td>
                                                    <td class="text-center" style="color: black;">
                                                        <?php echo $row['KELAS']; ?>
                                                    </td>
                                                    <td style="color: black;">
                                                        <?php echo wordwrap($row['JAWAB_TUGAS'], 40, "<br>"); ?>
                                                    </td>

                                                    <td class="text-center" style="color: black;">
                                                        <?php echo $row['NILAI']; ?>
                                                    </td>
                                                    <td class="text-center d-print-none">
                                                        <!-- Button to trigger modal -->
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#insertNilaiModal<?php echo $row['ID_DETAIL_TUGAS']; ?>">
                                                            <i class="fas fa-edit"></i> Insert Nilai
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade"
                                                            id="insertNilaiModal<?php echo $row['ID_DETAIL_TUGAS']; ?>"
                                                            tabindex="-1"
                                                            aria-labelledby="insertNilaiModalLabel<?php echo $row['ID_DETAIL_TUGAS']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="insertNilaiModalLabel<?php echo $row['ID_DETAIL_TUGAS']; ?>">
                                                                            Insert Nilai</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form to insert nilai -->
                                                                        <form action="" method="POST">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    for="nilai<?php echo $row['ID_DETAIL_TUGAS']; ?>"
                                                                                    class="form-label">Nilai</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="nilai<?php echo $row['ID_DETAIL_TUGAS']; ?>"
                                                                                    name="nilai" required>
                                                                                <input type="hidden" name="idtugas"
                                                                                    value="<?php echo $row['ID_DETAIL_TUGAS']; ?>">
                                                                            </div>
                                                                            <button type="submit" class="btn btn-primary"
                                                                                name="submit_nilai">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Icon for print view -->
                                                        <span class="d-none d-print-block">
                                                            <i class="fas fa-edit"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </table>
                                <script>
                                    function printPage() {
                                        window.print();
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    </main>

    <!--   Core JS Files   -->
    <script src="public/front-end/assets/js/core/popper.min.js"></script>
    <script src="public/front-end/assets/js/core/bootstrap.min.js"></script>
    <script src="public/front-end/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="public/front-end/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="public/front-end/assets/js/plugins/chartjs.min.js"></script>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="public/front-end/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>