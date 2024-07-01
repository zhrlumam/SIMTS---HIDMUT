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

    $delete_query = "DELETE FROM siswa WHERE ID_SISWA = $delete_id";
    $delete_result = mysqli_query($koneksi, $delete_query);

    if (!$delete_result) {
        error_log("Delete siswa query failed: " . mysqli_error($koneksi));
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    }

    header("Location: $_SERVER[PHP_SELF]");
    exit();
}

// Handle update operation if update form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editStudent'])) {
    $edit_id = mysqli_real_escape_string($koneksi, $_POST['edit_id']);
    $username = mysqli_real_escape_string($koneksi, $_POST['editUsername']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['editPassword'])); // Gunakan MD5 untuk enkripsi password jika diperlukan
    $nama = mysqli_real_escape_string($koneksi, $_POST['editNama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['editKelas']); // Ambil nilai dari form untuk Kelas
    $gmail = mysqli_real_escape_string($koneksi, $_POST['editGmail']);

    $update_query = "UPDATE siswa SET USERNAME = '$username', PASSWORD = '$password', NAMA = '$nama', KELAS = '$kelas', GMAIL = '$gmail' WHERE NISN = '$edit_id'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        die("Update query failed: " . mysqli_error($koneksi));
    }
}

// Handle add operation if add form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addStudent'])) {
    $nisn = mysqli_real_escape_string($koneksi, $_POST['NISN']);
    $username = mysqli_real_escape_string($koneksi, $_POST['USERNAME']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['PASSWORD']));
    $nama = mysqli_real_escape_string($koneksi, $_POST['NAMA']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['KELAS']);
    $gmail = mysqli_real_escape_string($koneksi, $_POST['GMAIL']);

    $insert_query = "INSERT INTO siswa (NISN, USERNAME, PASSWORD, NAMA, KELAS, GMAIL) VALUES ('$nisn', '$username', '$password', '$nama', '$kelas', '$gmail')";
    $insert_result = mysqli_query($koneksi, $insert_query);

    if ($insert_result) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        die("Insert query failed: " . mysqli_error($koneksi));
    }
}

$query = "SELECT * FROM siswa";
$result = mysqli_query($koneksi, $query);

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
                    <a class="nav-link " href="dashboard-admin.php">
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
                    <a class="nav-link active #" href="edit-siswa.php">
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit siswa</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Edit siswa</h6>
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
        $query = "SELECT * FROM siswa";
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
                                        <p>Edit Siswa</p>
                                        <h6>Data Siswa MTs hidayatul muta'allimin</h6>
                                    </div>
                                    <div class="col-12 col-md-auto mt-3 mt-md-0">
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#addModal">Tambah siswa</button>
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
                                                    NISN</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Username</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Password</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nama</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Kelas</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Gmail</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        // Loop untuk menampilkan data siswa
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no++; ?></td>
                                                <td class="ps-2"><?php echo $row['NISN']; ?></td>
                                                <td class="text-center"><?php echo $row['USERNAME']; ?></td>
                                                <td class="text-center"><?php echo $row['PASSWORD']; ?></td>
                                                <td class="text-center"><?php echo $row['NAMA']; ?></td>
                                                <td class="text-center"><?php echo $row['KELAS']; ?></td>
                                                <td class="text-center"><?php echo $row['GMAIL']; ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editModal-<?php echo $row['NISN']; ?>">Edit</button>
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-<?php echo $row['ID_SISWA']; ?>">Hapus</button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit Siswa -->
                                            <div class="modal fade" id="editModal-<?php echo $row['NISN']; ?>" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                                <input type="hidden" name="edit_id"
                                                                    value="<?php echo $row['NISN']; ?>">
                                                                <div class="mb-3">
                                                                    <label for="editUsername"
                                                                        class="form-label">Username</label>
                                                                    <input type="text" class="form-control" id="editUsername"
                                                                        name="editUsername"
                                                                        value="<?php echo $row['USERNAME']; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editPassword"
                                                                        class="form-label">Password</label>
                                                                    <input type="password" class="form-control"
                                                                        id="editPassword" name="editPassword"
                                                                        value="<?php echo $row['PASSWORD']; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editNama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="editNama"
                                                                        name="editNama" value="<?php echo $row['NAMA']; ?>"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editKelas" class="form-label">Kelas</label>
                                                                    <input type="text" class="form-control" id="editKelas" name="editKelas" value="<?php echo $row['KELAS']; ?>" required>

                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editGmail" class="form-label">Gmail</label>
                                                                    <input type="email" class="form-control" id="editGmail"
                                                                        name="editGmail" value="<?php echo $row['GMAIL']; ?>"
                                                                        required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        name="editStudent">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="modal fade" id="deleteModal-<?php echo $row['ID_SISWA']; ?>"
                                                tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Hapus Data Guru
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus guru dengan NISN:
                                                            <?php echo $row['NISN']; ?>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="">
                                                                <input type="hidden" name="delete_id"
                                                                    value="<?php echo $row['ID_SISWA']; ?>">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
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
                            <!-- Add Modal -->
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Tambah Data Siswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="">
                                                <div class="mb-3">
                                                    <label for="NISN" class="form-label">NISN</label>
                                                    <input type="text" class="form-control" id="NISN" name="NISN" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="USERNAME" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="USERNAME" name="USERNAME"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="PASSWORD" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="PASSWORD"
                                                        name="PASSWORD" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="NAMA" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="NAMA" name="NAMA" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="KELAS" class="form-label">Kelas</label>
                                                    <input type="number" class="form-control" id="KELAS" name="KELAS"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="GMAIL" class="form-label">Gmail</label>
                                                    <input type="email" class="form-control" id="GMAIL" name="GMAIL"
                                                        required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="addStudent"
                                                        class="btn btn-success">Tambah</button>
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