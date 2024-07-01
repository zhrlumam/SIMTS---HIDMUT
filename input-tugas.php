<?php
include_once ('koneksi.php');
require ('cek-login.php');

if ($_SESSION['user_type'] !== 'siswa') {
    // Jika bukan siswa, redirect ke halaman logout
    header('Location: ../logout.php');
    exit();
}
$id_t = isset($_GET['id_tugas']) ? $_GET['id_tugas'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jawaban_tugas = $_POST['jawaban_tugas'];
    $id_siswa = $_SESSION['a_global']->ID_SISWA;

    // Lakukan pemeriksaan apakah pasangan ID tugas dan ID siswa sudah ada
    $stmt_check = $koneksi->prepare("SELECT COUNT(*) FROM detail_tugas WHERE ID_TUGAS = ? AND ID_SISWA = ?");
    $stmt_check->bind_param("ii", $id_t, $id_siswa);
    $stmt_check->execute();
    $stmt_check->bind_result($jumlah_row);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($jumlah_row > 0) {
        // ID tugas yang sama dengan ID siswa yang sama sudah ada dalam database
        echo "<script>alert('Jawaban anda sudah rekam');</script>";
    } else {
        // Masukkan ke database
        $stmt_insert = $koneksi->prepare("INSERT INTO detail_tugas (ID_TUGAS, ID_SISWA, JAWAB_TUGAS) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("iis", $id_t, $id_siswa, $jawaban_tugas);

        if ($stmt_insert->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            // Kesalahan saat memasukkan data
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
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
    <!-- Fonts and icons -->
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

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-success position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
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
                    <a class="nav-link active" href="tugas.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tasks text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tugas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kegiatan.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-alt text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kegiatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pembayaran.php">
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
        <div class="sidenav-footer mx-3">
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
    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Input tugas</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Input Tugas</h6>
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
          <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none text-white">Profile</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="profile-siswa.php">
                <div class="d-flex py-1">
                  <div class="my-auto">
                    <img src="public/front-end/assets/img/team-2.jpg" class="avatar avatar-sm me-3 ">
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">
                      <span>Profil Saya</span>
                    </p>
                    <p class="text-xs text-secondary mb-0">
                      <i class="fa fa-user me-1">  <?php echo htmlspecialchars($_SESSION['a_global']->NAMA); ?></i>
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
            </div>
        </nav>
        <div class="container py-1">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-2">Tugas Harian</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        $no = 1;
                                        $id = isset($_GET['id_tugas']) ? $_GET['id_tugas'] : null;
                                        if ($id !== null) {
                                            $detail = mysqli_query($koneksi, "SELECT * FROM tugas WHERE ID_TUGAS = $id");
                                            if (mysqli_num_rows($detail) > 0) {
                                                while ($row = mysqli_fetch_array($detail)) {
                                                    ?>
                                                    <li class="list-group-item bg-light border-0 mb-3 rounded">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="mb-0"><?= htmlspecialchars($no++) ?>.
                                                                    <?= htmlspecialchars($row['NAMA_TUGAS']) ?></h6>
                                                                <p class="mb-0 text-muted small">Keterangan:
                                                                    <?= htmlspecialchars($row['KETERANGAN_TUGAS']) ?></p>
                                                                <p class="mb-2 text-xs">Batas Pengumpulan: <span
                                                                        class="text-dark ms-sm-2 font-weight-bold"><?= htmlspecialchars($row['TANGGAL_PENGUMPULAN']) ?></span>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                            } else { ?>
                                                <li class="list-group-item bg-light border-0 mb-3 rounded">Belum ada tugas dari
                                                    guru</li>
                                            <?php }
                                        } else { ?>
                                            <li class="list-group-item bg-light border-0 mb-3 rounded">Jawaban anda telah di rekam
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-1">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-2">Input Jawaban Tugas</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label for="jawaban_tugas">Jawaban Tugas:</label>

                                            <textarea class="form-control" id="jawaban_tugas" name="jawaban_tugas"
                                                rows="6" placeholder="Ketikkan jawaban Anda di sini..."></textarea>
                                        </div>

                                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-1">
                            <div class="card">
                                <div class="card-body pt-4 p-3" style="text-align: center;">
                                    <?php
                                    $id_siswa = $_SESSION['a_global']->ID_SISWA;
                                    // Periksa apakah $id_t dan $id_siswa telah di-set sebelumnya
                                    if (isset($id_t) && isset($id_siswa)) {
                                        $nilai = mysqli_query($koneksi, "SELECT * FROM detail_tugas WHERE ID_TUGAS = $id_t AND ID_SISWA = $id_siswa");
                                        if ($nilai) { // Periksa apakah query berhasil dijalankan
                                            if (mysqli_num_rows($nilai) > 0) {
                                                while ($row = mysqli_fetch_array($nilai)) {
                                                    if ($row['NILAI'] !== null) {
                                                        echo '<h6 class="mb-2">' . $row['NILAI'] . '</h6>';
                                                    } else {
                                                        echo '<h6 class="mb-2">Nilai belum dinilai</h6>';
                                                    }
                                                }
                                            } else {
                                                // Tidak ada baris yang cocok dengan kriteria
                                            }
                                        } else {
                                            // Kesalahan saat menjalankan query
                                            echo "Error: " . mysqli_error($koneksi);
                                        }
                                    } else {
                                        // Salah satu atau kedua variabel tidak di-set dengan benar
                                        echo "Belum ada nilai.";
                                    }
                                    ?>
                                    <h6 class="mb-2">Perbaikan</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Core JS Files -->
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