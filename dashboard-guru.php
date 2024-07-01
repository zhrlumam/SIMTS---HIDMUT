<?php
include_once ('koneksi.php');
require ('cek-login.php');

// Check user type
if ($_SESSION['user_type'] !== 'guru') {
    // Redirect to logout if not a teacher
    header('Location: ../logout.php');
    exit();
} 

// Query to get average scores per assignment for each class
$sql = "SELECT d.ID_SISWA, AVG(CAST(d.NILAI AS DECIMAL(10,2))) AS avg_nilai, s.KELAS 
        FROM detail_tugas d
        JOIN siswa s ON d.ID_SISWA = s.ID_SISWA
        GROUP BY d.ID_SISWA, s.KELAS";

$result = $koneksi->query($sql);

$tugas = [];
$nilai = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Collecting data for graph
        $tugas[] = "Tugas " . $row['ID_SISWA'] . " Kelas " . $row['KELAS'];
        $nilai[] = $row['avg_nilai'];
    }
} else {
    echo "0 results";
}

$koneksi->close();
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
          <a class="nav-link active" href="dashboard-guru.php">
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
          <a class="nav-link" href="tugas-siswa.php">
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard guru</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard guru</h6>
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
              <a class="dropdown-item border-radius-md" href="profile-guru.php">
                <div class="d-flex py-1">
                  <div class="my-auto">
                    <img src="public/front-end/assets/img/team-2.jpg" class="avatar avatar-sm me-3 ">
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
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <a href="tugas-siswa.php" style="text-decoration: none;">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Tugas harian</p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                      <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <a href="kegiatan-siswa.php" style="text-decoration: none;">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Absen kegiatan</p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                      <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="row mt-4">
  <div class="col-lg-12 mb-lg-0 mb-5">
    <div class="card z-index-2 h-100">
      <div class="card-header pb-0 pt-3 bg-transparent">
        <p class="text-capitalize">Grafik Rata-rata Nilai Tugas</p>
      </div>
      <div class="card-body p-3">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>
</div>


      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-5">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <p class="text-capitalize">Selamat Datang Di Sistem Informasi Mts Hidayatul Muta'allimin</p>
              <h6 class="text-sm mb-0">
                <?php echo htmlspecialchars($_SESSION['a_global']->NAMA); ?>
              </h6>
            </div>
            <div class="card-body p-3">

            </div>
          </div>
        </div>

      </div>

      <footer class="footer pt-12  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                IT hidmut
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">

                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                    target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
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
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: <?php echo json_encode($tugas); ?>,
          datasets: [{
              label: 'Rata-rata Nilai',
              data: <?php echo json_encode($nilai); ?>,
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>
