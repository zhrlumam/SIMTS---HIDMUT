<?php
session_start();
include_once ('koneksi.php');
// require ('cek-login.php');

if ($_SESSION['user_type'] !== 'guru') {
    header('Location: ../logout.php');
    exit();
}
$id_p = isset($_GET['id_pengajar']) ? $_GET['id_pengajar'] : null;
// Process add form submission
if (isset($_POST['add_tugas'])) {
    $nama_tugas = $_POST['nama_tugas'];
    $keterangan = $_POST['keterangan'];
    $tanggal_pengumpulan = $_POST['tanggal_pengumpulan'];
    $id_pe = $_SESSION['id'];

    $query = "INSERT INTO tugas (NAMA_TUGAS, KETERANGAN_TUGAS, TANGGAL_PENGUMPULAN, ID_PENGAJAR) VALUES ('$nama_tugas', '$keterangan', '$tanggal_pengumpulan', '$id_p')";
    mysqli_query($koneksi, $query);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id_pengajar=$id_p");
    exit();
}

// Process edit form submission
if (isset($_POST['edit_tugas'])) {
    $id_tugas = $_POST['id_tugas'];
    $nama_tugas = $_POST['nama_tugas'];
    $keterangan = $_POST['keterangan'];
    $tanggal_pengumpulan = $_POST['tanggal_pengumpulan'];

    $query = "UPDATE tugas SET NAMA_TUGAS = '$nama_tugas', KETERANGAN_TUGAS = '$keterangan', TANGGAL_PENGUMPULAN = '$tanggal_pengumpulan' WHERE ID_TUGAS = '$id_tugas'";
    mysqli_query($koneksi, $query);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id_pengajar=$id_p");
    exit();
}

// Process delete form submission
if (isset($_POST['delete_tugas'])) {
    $id_tugas = $_POST['id_tugas'];

    $query = "DELETE FROM tugas WHERE ID_TUGAS = '$id_tugas'";
    mysqli_query($koneksi, $query);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id_pengajar=$id_p");
    exit();
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
        SI-MTs Hidayatul Muta'allimin
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="public/front-end/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="public/front-end/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <li class="nav-item">
                    <a class="nav-link active"  href="tugas-siswa.php">
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tugas siswa</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Tugas siswa</h6>
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
                            <p>Tugas</p>
                            <h6>Silahkan Input tugas siswa</h6>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#addTugasModal">Tambah Tugas</button>
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
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $id = $_SESSION['id'];

                                        $tugas = mysqli_query($koneksi, "SELECT * FROM tugas JOIN PENGAJAR ON PENGAJAR.ID_PENGAJAR = TUGAS.ID_PENGAJAR WHERE PENGAJAR.ID_PENGAJAR = $id_p");
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
                                                    <td class="text-center border-bottom border-left border-right">
                                                        <div>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                                data-target="#editTugasModal<?php echo $row['ID_TUGAS']; ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#deleteTugasModal<?php echo $row['ID_TUGAS']; ?>">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                            <a href="pengumpulan-tugas-siswa.php?idt=<?php echo $row['ID_TUGAS']; ?>&?idp=<?php echo $row['ID_PENGAJAR']; ?>"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="editTugasModal<?php echo $row['ID_TUGAS']; ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="editTugasModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editTugasModalLabel">Edit Tugas</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id_tugas"
                                                                        value="<?php echo $row['ID_TUGAS']; ?>">
                                                                    <div class="form-group">
                                                                        <label for="nama_tugas">Nama Tugas</label>
                                                                        <input type="text" class="form-control" id="nama_tugas"
                                                                            name="nama_tugas"
                                                                            value="<?php echo $row['NAMA_TUGAS']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="keterangan">Keterangan</label>
                                                                        <textarea class="form-control" id="keterangan"
                                                                            name="keterangan" rows="3"
                                                                            required><?php echo $row['KETERANGAN_TUGAS']; ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tanggal_pengumpulan">Tanggal
                                                                            Pengumpulan</label>
                                                                        <input type="date" class="form-control"
                                                                            id="tanggal_pengumpulan" name="tanggal_pengumpulan"
                                                                            value="<?php echo $row['TANGGAL_PENGUMPULAN']; ?>"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="edit_tugas"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteTugasModal<?php echo $row['ID_TUGAS']; ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteTugasModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteTugasModalLabel">Delete Tugas
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id_tugas"
                                                                        value="<?php echo $row['ID_TUGAS']; ?>">
                                                                    <p>Are you sure you want to delete this task?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="delete_tugas"
                                                                        class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan=" 5" class="text-center">Tidak ada data tugas
                                                    yang
                                                    tersedia.</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Add Tugas Modal -->
                        <div class="modal fade" id="addTugasModal" tabindex="-1" role="dialog"
                            aria-labelledby="addTugasModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTugasModalLabel">Tambah Tugas
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nama_tugas">Nama Tugas</label>
                                                <input type="text" class="form-control" id="nama_tugas"
                                                    name="nama_tugas" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea class="form-control" id="keterangan" name="keterangan"
                                                    rows="3" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_pengumpulan">Tanggal
                                                    Pengumpulan</label>
                                                <input type="date" class="form-control" id="tanggal_pengumpulan"
                                                    name="tanggal_pengumpulan" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" name="add_tugas" class="btn btn-primary">Add
                                                Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End of Add Tugas Modal -->

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="public/front-end/assets/js/argon-dashboard.min.js?v=2.0.4"></script>

</body>

</html>