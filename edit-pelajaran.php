<?php
include_once ('koneksi.php');
require ('cek-login.php');

// Pastikan user adalah admin
if ($_SESSION['user_type'] !== 'admin') {
    header('Location: ../logout.php');
    exit();
}

// Handle delete operation if delete button is clicked
if (isset($_POST['delete_id'])) {
    $delete_id = (int) $_POST['delete_id']; // Cast to integer to prevent SQL injection

    $delete_query = "DELETE FROM pelajaran WHERE ID_PELAJARAN = $delete_id";
    $delete_result = mysqli_query($koneksi, $delete_query);

    if (!$delete_result) {
        // Handle the error gracefully, log it, and redirect
        error_log("Delete query failed: " . mysqli_error($koneksi));
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    }

    // Redirect or refresh the page after deletion
    header("Location: $_SERVER[PHP_SELF]");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submitAdd'])) {
        $kelas = $_POST['add_kelas'];
        $nama_pelajaran = $_POST['add_nama_pelajaran'];

        // Query INSERT ke database
        $queryInsert = "INSERT INTO pelajaran (KELAS, NAMA_PELAJARAN) VALUES ('$kelas', '$nama_pelajaran')";
        if (mysqli_query($koneksi, $queryInsert)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $queryInsert . "<br>" . mysqli_error($koneksi);
        }

    } elseif (isset($_POST['submitEdit'])) {
        $id = $_POST['edit_id'];
        $kelas = $_POST['edit_kelas'];
        $nama_pelajaran = $_POST['edit_nama_pelajaran'];

        // Query UPDATE ke database
        $queryUpdate = "UPDATE pelajaran SET KELAS = '$kelas', NAMA_PELAJARAN = '$nama_pelajaran' WHERE ID_PELAJARAN = '$id'";
        if (mysqli_query($koneksi, $queryUpdate)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $queryUpdate . "<br>" . mysqli_error($koneksi);
        }
    }
}

// Ambil data kelas dari tabel siswa
$queryKelas = "SELECT DISTINCT KELAS FROM siswa";
$resultKelas = mysqli_query($koneksi, $queryKelas);

// Simpan data kelas dalam array
$kelasArray = [];
while ($rowKelas = mysqli_fetch_assoc($resultKelas)) {
    $kelasArray[] = $rowKelas['KELAS'];
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
                        <span class="text-muted">112110099</span>
                    </div>
                </div>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard-admin.php">
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
                    <a class="nav-link " href="edit-guru.php">
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit pelajaran</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Edit pelajaran</h6>
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

                </ul>
            </div>
            </div>
        </nav>
        <?php

        // Misalkan ID siswa yang ingin ditampilkan pembayarannya adalah 1 (harap sesuaikan dengan ID siswa yang sesuai)
// Query untuk mengambil data pembayaran sesuai dengan ID siswa
        $query = "SELECT * FROM pelajaran";
        $result = mysqli_query($koneksi, $query);

        // Memeriksa apakah query berhasil dieksekusi
        if ($result) {
            ?>
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p>Edit Pelajaran</p>
                                        <h6>Data Pelajaran MTs hidayatul muta'allimin</h6>
                                    </div>
                                    <div class="col-12 col-md-auto mt-3 mt-md-0">
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#addModal">Tambah Pelajaran</button>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    No</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Kelas</th>

                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nama pelajaran</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        // Loop untuk menampilkan data pembayaran
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td class="ps-2"><?php echo $row['KELAS']; ?></td>
                                                    <td class="ps-2"><?php echo $row['NAMA_PELAJARAN']; ?></td>

                                                    <td class="text-center">
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal<?php echo $row['ID_PELAJARAN']; ?>">Hapus</button>
                                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#editModal<?= $row['ID_PELAJARAN']; ?>">Edit</button>
                                                        <div class="modal fade"
                                                            id="deleteModal<?php echo $row['ID_PELAJARAN']; ?>" tabindex="-1"
                                                            aria-labelledby="deleteModalLabel<" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel<?php echo $row['ID_PELAJARAN']; ?>">
                                                                            Konfirmasi Penghapusan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin
                                                                        menghapus pelajaran ini?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <form method="POST"
                                                                            action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                                            <input type="hidden" name="delete_id"
                                                                                value="<?php echo $row['ID_PELAJARAN']; ?>">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="modal fade" id="editModal<?= $row['ID_PELAJARAN']; ?>"
                                                            tabindex="-1"
                                                            aria-labelledby="editModalLabel<?= $row['ID_PELAJARAN']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editModalLabel<?= $row['ID_PELAJARAN']; ?>">Edit
                                                                            Pelajaran</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST"
                                                                            action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                                            <input type="hidden" name="edit_id"
                                                                                value="<?php echo $row['ID_PELAJARAN']; ?>">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    for="editKelas<?= $row['ID_PELAJARAN']; ?>"
                                                                                    class="form-label">Kelas</label>
                                                                                <select class="form-control"
                                                                                    id="editKelas<?= $row['ID_PELAJARAN']; ?>"
                                                                                    name="edit_kelas" required>
                                                                                    <option value="">Pilih Kelas</option>
                                                                                    <?php foreach ($kelasArray as $kelas): ?>
                                                                                        <option value="<?php echo $kelas; ?>"
                                                                                            <?= $row['KELAS'] == $kelas ? 'selected' : ''; ?>><?php echo $kelas; ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    for="editNamaPelajaran<?= $row['ID_PELAJARAN']; ?>"
                                                                                    class="form-label">Nama Pelajaran</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="editNamaPelajaran<?= $row['ID_PELAJARAN']; ?>"
                                                                                    name="edit_nama_pelajaran"
                                                                                    value="<?php echo $row['NAMA_PELAJARAN']; ?>"
                                                                                    required>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary"
                                                                                    name="submitEdit">Simpan Perubahan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                           
                                            <?php
                                        }
                                        ?>
                                        <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Delete Modal -->

                            <!-- Add Modal -->
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Tambah Pelajaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <div class="mb-3">
                                                    <label for="addKelas" class="form-label">Kelas</label>
                                                    <select class="form-control" id="addKelas" name="add_kelas" required>
                                                        <option value="">Pilih Kelas</option>
                                                        <?php foreach ($kelasArray as $kelas): ?>
                                                            <option value="<?php echo $kelas; ?>"><?php echo $kelas; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="addNamaPelajaran" class="form-label">Nama Pelajaran</label>
                                                    <input type="text" class="form-control" id="addNamaPelajaran"
                                                        name="add_nama_pelajaran" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        name="submitAdd">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <?php
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }


        ?>

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