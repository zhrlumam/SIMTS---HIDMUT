<?php
include_once ('koneksi.php');
require ('cek-login.php');

if ($_SESSION['user_type'] !== 'admin') {
    // Jika tidak, redirect ke halaman login
    header('Location: ../logout.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tambah_pembayaran'])) {
        // Ambil data dari form
        $id_siswa = $_POST['nama_siswa'];
        $nama_pembayaran = $_POST['nama_pembayaran'];
        $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
        $konfirmasi_bayar = $_POST['konfirmasi_bayar'];

        // Query untuk menambahkan pembayaran
        $query = "INSERT INTO pembayaran (ID_SISWA, NAMA_PEMBAYARAN, TOTAL_PEMBAYARAN, KONFIRMASI_BAYAR) VALUES ('$id_siswa', '$nama_pembayaran', '$jumlah_pembayaran', '$konfirmasi_bayar')";
        mysqli_query($koneksi, $query);

        header("Location: " . $_SERVER['PHP_SELF'] . "?kelas=" . urlencode($_GET['kelas']));

        exit();
    }

    if (isset($_POST['edit_pembayaran'])) {
        // Ambil data dari form
        $id_pembayaran = $_POST['id_pembayaran'];
        $nama_pembayaran = $_POST['edit_nama_pembayaran'];
        $jumlah_pembayaran = $_POST['edit_jumlah_pembayaran'];
        $konfirmasi_bayar = $_POST['konfirmasi_bayar'];

        // Query untuk memperbarui pembayaran
        $query = "UPDATE pembayaran SET NAMA_PEMBAYARAN='$nama_pembayaran', TOTAL_PEMBAYARAN='$jumlah_pembayaran', KONFIRMASI_BAYAR='$konfirmasi_bayar' WHERE ID_PEMBAYARAN='$id_pembayaran'";
        mysqli_query($koneksi, $query);

        header("Location: " . $_SERVER['PHP_SELF'] . "?kelas=" . urlencode($_GET['kelas']));
        exit();
    }

    if (isset($_POST['hapus_pembayaran'])) {
        // Ambil data dari form
        $id_pembayaran = $_POST['id_pembayaran'];

        // Query untuk menghapus pembayaran
        $query = "DELETE FROM pembayaran WHERE ID_PEMBAYARAN='$id_pembayaran'";
        mysqli_query($koneksi, $query);

        header("Location: " . $_SERVER['PHP_SELF'] . "?kelas=" . urlencode($_GET['kelas']));
        exit();
        
    }
}

// Mengatur nilai kelas berdasarkan parameter yang diterima dari URL
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

// Tambahkan parameter kelas ke query SQL hanya jika parameter kelas ada dalam URL
$kelas_condition = $kelas !== '' ? "WHERE siswa.KELAS = '$kelas'" : '';

// Query SQL untuk mengambil data pembayaran dengan atau tanpa pembatasan kelas
$query = "SELECT pembayaran.ID_PEMBAYARAN, siswa.NAMA, siswa.KELAS, pembayaran.NAMA_PEMBAYARAN, pembayaran.TOTAL_PEMBAYARAN, pembayaran.KONFIRMASI_BAYAR
          FROM pembayaran 
          INNER JOIN siswa ON pembayaran.ID_SISWA = siswa.ID_SISWA
          $kelas_condition";
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="public/front-end/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="public/front-end/assets/img/logomts.svg">
    <title>SI-MTs hidayatul muta'allimin</title>
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
                        <span class="text-muted">112110099</span>
                    </div>
                </div>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active " href="dashboard-admin.php">
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
                    <a class="nav-link " href="edit-pembayaran.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Edit guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="edit-siswa.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Edit siswa</span>
                    </a>
                </li>
            </ul>
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit guru</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Edit guru</h6>
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
                            <a class="dropdown-item border-radius-md" href="profile-admin.php">
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
            </div>
        </nav>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Pembayaran Siswa MTs hidayatul muta'allimin</h6>
                            <div class="col-12 col-md-auto mt-3 mt-md-0">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="tahunDropdown"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pilih kelas
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="tahunDropdown">
                                        <a class="dropdown-item" href="?kelas=7">Kelas 7</a>
                                        <a class="dropdown-item" href="?kelas=8">Kelas 8</a>
                                        <a class="dropdown-item" href="?kelas=9">Kelas 9</a>
                                        <!-- Tambahkan tahun-tahun lainnya sesuai kebutuhan -->
                                    </div>


                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addPaymentModal">
                                    Tambah Pembayaran
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No</th>
                                        <th class="text-center">
                                            Nama</th>
                                        <th class="text-center">
                                            Kelas</th>
                                        <th class="text-center">
                                            Nama Pembayaran</th>
                                        <th class="text-center">
                                            Jumlah</th>
                                        <th class="text-center">
                                            Keterangan</th>
                                        <th class="text-center">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    <?php
                                    // Tambahkan parameter kelas ke query SQL hanya jika parameter kelas ada dalam URL
                                    $kelas_condition = isset($kelas) ? "WHERE siswa.KELAS = '$kelas'" : '';

                                    // Query SQL untuk mengambil data pembayaran dengan atau tanpa pembatasan kelas
                                    $query = "SELECT pembayaran.ID_PEMBAYARAN, siswa.NAMA, siswa.KELAS, pembayaran.NAMA_PEMBAYARAN, pembayaran.TOTAL_PEMBAYARAN, pembayaran.KONFIRMASI_BAYAR
          FROM pembayaran 
          INNER JOIN siswa ON pembayaran.ID_SISWA = siswa.ID_SISWA
          $kelas_condition";

                                    $result = mysqli_query($koneksi, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td class="text-center"><?= htmlspecialchars($row['NAMA']); ?></td>
                                                <td class="text-center"><?= htmlspecialchars($row['KELAS']); ?></td>
                                                <td class="text-center"><?= htmlspecialchars($row['NAMA_PEMBAYARAN']); ?>
                                                </td>
                                                <td class="text-center"><?= htmlspecialchars($row['TOTAL_PEMBAYARAN']); ?>
                                                </td>
                                                <td class="text-center"><?= htmlspecialchars($row['KONFIRMASI_BAYAR']); ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editPaymentModal-<?= $row['ID_PEMBAYARAN']; ?>">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deletePaymentModal-<?= $row['ID_PEMBAYARAN']; ?>">Delete</button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editPaymentModal-<?= $row['ID_PEMBAYARAN']; ?>"
                                                tabindex="-1" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editPaymentModalLabel">Edit
                                                                Pembayaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="edit-pembayaran.php" method="POST">
                                                                <input type="hidden" name="id_pembayaran"
                                                                    value="<?= $row['ID_PEMBAYARAN']; ?>">
                                                                <div class="mb-3">
                                                                    <label for="edit_nama_pembayaran" class="form-label">Nama
                                                                        Pembayaran</label>
                                                                    <input type="text" class="form-control"
                                                                        name="edit_nama_pembayaran"
                                                                        value="<?= htmlspecialchars($row['NAMA_PEMBAYARAN']); ?>"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="edit_jumlah_pembayaran"
                                                                        class="form-label">Jumlah Pembayaran</label>
                                                                    <input type="number" class="form-control"
                                                                        name="edit_jumlah_pembayaran"
                                                                        value="<?= htmlspecialchars($row['TOTAL_PEMBAYARAN']); ?>"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="konfirmasi_bayar" class="form-label">Konfirmasi
                                                                        Pembayaran</label>
                                                                    <select class="form-control" name="konfirmasi_bayar"
                                                                        required>
                                                                        <option value="" selected disabled>Pilih Status
                                                                        </option>
                                                                        <option value="Lunas">Lunas</option>
                                                                        <option value="Belum Lunas">Belum Lunas</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="edit_pembayaran"
                                                                        class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deletePaymentModal-<?= $row['ID_PEMBAYARAN']; ?>"
                                                tabindex="-1" aria-labelledby="deletePaymentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deletePaymentModalLabel">Delete
                                                                Pembayaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this payment?</p>
                                                            <p><strong>Nama Siswa:</strong>
                                                                <?= htmlspecialchars($row['NAMA']); ?></p>
                                                            <p><strong>Kelas:</strong>
                                                                <?= htmlspecialchars($row['KELAS']); ?></p>
                                                            <p><strong>Nama Pembayaran:</strong>
                                                                <?= htmlspecialchars($row['NAMA_PEMBAYARAN']); ?></p>
                                                            <p><strong>Jumlah Pembayaran:</strong>
                                                                <?= htmlspecialchars($row['TOTAL_PEMBAYARAN']); ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="edit-pembayaran.php" method="POST">
                                                                <input type="hidden" name="id_pembayaran"
                                                                    value="<?= $row['ID_PEMBAYARAN']; ?>">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="hapus_pembayaran"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No payments found.</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Payment Modal -->
        <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPaymentModalLabel">Tambah Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit-pembayaran.php" method="POST">
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <select name="nama_siswa" id="nama_siswa" class="form-select" required>
                                    <option value="" selected disabled>Pilih Siswa</option>
                                    <?php
                                    $query_siswa = "SELECT ID_SISWA, NAMA FROM siswa";
                                    $result_siswa = mysqli_query($koneksi, $query_siswa);
                                    if (mysqli_num_rows($result_siswa) > 0) {
                                        while ($siswa = mysqli_fetch_assoc($result_siswa)) {
                                            echo "<option value='{$siswa['ID_SISWA']}'>{$siswa['NAMA']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_pembayaran" class="form-label">Nama Pembayaran</label>
                                <input type="text" class="form-control" name="nama_pembayaran" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                                <input type="number" class="form-control" name="jumlah_pembayaran" required>
                            </div>
                            <div class="mb-3">
                                <label for="konfirmasi_bayar" class="form-label">Konfirmasi Pembayaran</label>
                                <select class="form-control" name="konfirmasi_bayar" required>
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="tambah_pembayaran" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>