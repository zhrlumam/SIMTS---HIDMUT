<?php include_once ('koneksi.php');
// session_start();
require ('cek-login.php');
if ($_SESSION['user_type'] !== 'siswa') {
  // Jika tidak, redirect ke halaman login
  header('Location: ../logout.php');
  exit();
}
$sql = "SELECT * FROM buku";
$d = mysqli_query(mysqli_connect('localhost', 'root', '', 'simts_db'), $sql);
$jml = mysqli_num_rows($d);
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
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Animasi -->
  <link rel="stylesheet" href="css/animate.min.css">
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
          <a class="nav-link " href="dashboard-siswa.php">
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
          <a class="nav-link active" href="ruang-baca.php">
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ruang baca</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Ruang baca</h6>
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
                      <i class="fa fa-user me-1"> <?php echo htmlspecialchars($_SESSION['a_global']->NAMA); ?></i>
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
    <div class="container-fluid py-0">
      <div class="row">
        <div class="col-12">
          <div class="main-panel">
            <div class="content">
              <main>
                <!-- jumbotron -->
                <div>
                  <section class="py-1 text-center container">
                    <div class="row py-lg-3" id="head">
                      <div class="col-lg-6 col-md-8 mx-auto">

                        <img class="animate__animated animate__tada" src="public/front-end/assets/img/logomts.svg"
                          alt="public/front-end." alt="" height="80">
                        <p style="color: white;">Baca buku apa saja secara <span style="font-weight: 600;">gratis</span>
                          disini.</p>

                        <form class="d-flex" action="ruang-baca.php" method="get">
                          <input class="form-control mx-2" name="cari" type="search" placeholder="cari buku disini..."
                            aria-label="Search" id="boxcari">
                          <button class="btn btn-outline-secondary" type="submit" id="cari">Cari</button>
                        </form>
                        </p>
                        <small class="text-muted">
                          Jumlah buku saat ini : <?php echo $jml; ?>
                        </small>

                      </div>
                    </div>
                  </section>
                </div>

                <div class="album py-4 ">
                  <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                      <?php
                      $no = 1;

                      $batas = 6;
                      $halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
                      $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                      $previous = $halaman - 1;
                      $next = $halaman + 1;

                      $total_halaman = ceil($jml / $batas);

                      $nomor = $halaman_awal + 1;

                      if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        // echo "<h4 class='text-center' style='text-transform: uppercase; letter-spacing: 2.5px;'>Hasil pencarian : " . $cari . "</h4>";
                        echo "<b>Hasil pencarian : " . $cari . "</b>";
                      }
                      if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $data_buku = mysqli_query(mysqli_connect('localhost', 'root', '', 'db_simts'), "SELECT * FROM buku JOIN penulis USING (id_penulis) JOIN kategori USING (id_kategori) WHERE judul LIKE '%" . $cari . "%'");
                      } else {
                        $data_buku = mysqli_query(mysqli_connect('localhost', 'root', '', 'db_simts'), "SELECT * FROM buku JOIN penulis USING (id_penulis) JOIN kategori USING (id_kategori) ORDER BY id_buku DESC LIMIT $halaman_awal, $batas ");

                      }
                      //Menampilkan data
                      while ($data = mysqli_fetch_array($data_buku)) {

                        ?>
                        <div class="col" id="home">
                          <div class="card border-0 shadow-sm">

                            <?php
                            if ($data['cover'] == true) {
                              echo "<img class='thumbnail' height='225' src='file/cover/$data[cover]'>";
                            } else { ?>
                              <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                  dy=".3em">Thumbnail</text>
                              </svg>

                              <?php
                            }
                            ?>
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $data['judul'] ?></h5>
                              <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['penulis'] ?>
                              </h6>
                              <hr>
                              <p class="card-text">
                                <?php
                                $text = $data['sinopsis'];
                                // echo cutText($text, 180) . '...';
                                ?>
                              </p>
                              <div class="d-flex justify-content-between align-items-center mb-auto">
                                <div class="btn-group">
                                  <a href="view.php?id_buku=<?php echo $data['id_buku']; ?>" class="mr-1"><button
                                      type="button" class="btn btn-sm btn-outline-primary">Baca
                                      Buku</button></a>
                                </div>
                                <small class="text-muted"><?php echo $data['jumlah_hlm'] ?>
                                  halaman</small>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                      ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center mt-5 pagination-circle">
                        <li class="page-item <?php if ($halaman <= 1)
                          echo 'disabled'; ?>">
                          <a class="page-link"
                            href="<?php if ($halaman > 1)
                              echo "?halaman=$previous";
                            else
                              echo '#'; ?>">Sebelumnya</a>
                        </li>

                        <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                          <li class="page-item <?php if ($halaman == $i)
                            echo 'active'; ?>">
                            <a class="page-link" href="ruang-baca.php?halaman=<?= $i; ?>"><?= $i; ?></a>
                          </li>
                        <?php endfor; ?>

                        <li class="page-item <?php if ($halaman >= $total_halaman)
                          echo ''; ?>">
                          <!-- Removed 'disabled' class condition -->
                          <a class="page-link"
                            href="<?php if ($halaman < $total_halaman)
                              echo "?halaman=$next";
                            else
                              echo '#'; ?>">Selanjutnya</a>
                        </li>
                      </ul>
                    </nav>

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
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>