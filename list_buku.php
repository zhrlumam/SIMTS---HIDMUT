<?php
include 'koneksibuku.php';
$db = new database();

session_start();

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
                        <span class="nav-link-text ms-1">Edit buku</span>
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit buku</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Edit buku</h6>
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
        <main>
       

        <div class="album py-0">
            <div class="container">
            <h4 class="text-center" style="text-transform: uppercase; letter-spacing: 2.5px;">Daftar Buku</h4>
                <table class="table table-hover mt-5">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Jumlah Halaman</th>
                            <th scope="col">Tahun Terbit</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    //Menampilkan data
                    foreach ($db->tampil_data_buku("SELECT * FROM buku ORDER BY judul ASC") as $data) {
                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?php echo $data['judul']; ?></td>
                                <td><?php echo $data['penulis']; ?></td>
                                <td><?php echo $data['jumlah_hlm']; ?></td>
                                <td><?php echo $data['tahun_terbit']; ?></td>
                                <td>
                                    <a href="edit.php?id_buku=<?php echo $data['id_buku']; ?>&aksi=update">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </a>
                                    <a href="prosesbuku.php?id_buku=<?php echo $data['id_buku']; ?>&aksi=hapus">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
                <div class="my-4 d-md-flex justify-content-md-end">
                    <form action="input_buku.php" method="POST" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-primary me-md-2">Tambah Buku</button>
                        <a href="index.php">
                            <button class="btn btn-secondary" type="button">Batal</button>
                        </a>
                    </form>
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