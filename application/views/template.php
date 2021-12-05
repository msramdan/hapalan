<!doctype html>
<html lang="en">

<head>
  <title><?= $app_setting->nama_aplikasi ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/vendor/themify-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/vendor/pace/themes/orange/pace-theme-minimal.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/css/main.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/css/skins/sidebar-nav-darkgray.css" type="text/css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/css/skins/navbar3.css" type="text/css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/css/demo.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin/assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>admin/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>admin/assets/img/favicon.png">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
</head>

<body>
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <?php if ($this->session->flashdata('message') ) : ?>
    <?php endif; ?>

    <div class="flash-data2" data-flashdata2="<?= $this->session->flashdata('error'); ?>"></div>
    <?php if ($this->session->flashdata('error') ) : ?>
    <?php endif; ?>

  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="brand">
        <a href="index.html">
          <strong style="color: white; font-size: 18px"><?= $app_setting->nama_aplikasi ?></strong>
        </a>
      </div>
      <div class="container-fluid">
        <div id="tour-fullwidth" class="navbar-btn">
          <button type="button" class="btn-toggle-fullwidth"><i class="ti-arrow-circle-left"></i></button>
        </div>
        <div id="navbar-menu">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              
              <?php if ($this->fungsi->user_login()->photo =='default.jpg') { ?>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url() ?>admin/assets/img/sal.jpg ?>" alt="">
                    <span><?= ucfirst($this->fungsi->user_login()->username) ?></span>
                  </a>
              <?php }else{ ?>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url() ?>admin/assets/img/user/<?= $this->fungsi->user_login()->photo ?>" alt="">
                    <span><?= ucfirst($this->fungsi->user_login()->username) ?></span>
                  </a>

              <?php } ?>

              <ul class="dropdown-menu logged-user-menu">
                <li><a href="<?= site_url('profile') ?>"><i class="ti-user"></i> <span>My Profile</span></a></li>
                <li><a href="<?= site_url('auth/logout') ?>"><i class="ti-power-off"></i> <span>Logout</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div id="sidebar-nav" class="sidebar">
      <nav>
        <ul class="nav" id="sidebar-nav-menu">
          <li><a href="<?= base_url() ?>home"><i class="ti-home"></i> <span class="title">Home</span></a></li>
          <li><a href="<?= base_url() ?>penilaian"><i class="ti-pencil"></i> <span class="title">Penilaian</span></a></li>
          <?php if ($this->fungsi->user_login()->level =="ADMIN") { ?>
            <li class="panel">
              <a href="#masterdata" data-toggle="collapse" data-parent="#sidebar-nav-menu" class="collapsed" aria-expanded="false"><i class="ti-list"></i> <span class="title">Master Data</span> <i class="icon-submenu ti-angle-left"></i></a>
              <div id="masterdata" class="collapse" aria-expanded="false" style="height: 0px;">
                <ul class="submenu">
                  <li><a href="<?= base_url() ?>guru">Data Guru</a></li>
                  <li><a href="<?= base_url() ?>siswa/grup">Data Siswa</a></li>
                  <li><a href="<?= base_url() ?>tingkat">Data Kelas</a></li>
                  <li><a href="<?= base_url() ?>kelompok">Data Kelompok</a></li>
                  <li><a href="<?= base_url() ?>surat">Data Surat</a></li>
                  <li><a href="<?= base_url() ?>tahun_ajaran">Data Tahun Ajar</a></li>
                </ul>
              </div>
          </li>
          <li><a href="<?= base_url() ?>user"><i class="fa fa-users"></i> <span class="title">User</span></a></li>
          <li class="panel">
              <a href="#pengaturan" data-toggle="collapse" data-parent="#sidebar-nav-menu" class="collapsed" aria-expanded="false"><i class="fa fa-cogs"></i> <span class="title">Pengaturan</span> <i class="icon-submenu ti-angle-left"></i></a>
              <div id="pengaturan" class="collapse" aria-expanded="false" style="height: 0px;">
                <ul class="submenu">
                  <li><a href="<?= base_url() ?>app_setting">Pengaturan Aplikasi</a></li>
                  <li><a href="<?= base_url() ?>history_login">History Login</a></li>
                  <li><a href="<?= base_url() ?>backup">Backup Database</a></li>
                  
                </ul>
              </div>
          </li>
          <?php } ?>
        </ul>
        <button type="button" class="btn-toggle-minified" title="Toggle Minified Menu"><i class="ti-arrows-horizontal"></i></button>
      </nav>
    </div>
    <div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="content-heading clearfix">
          <div class="heading-left">
            <h1 class="page-title">Waktu Server</h1>
            <p class="page-subtitle">
              <script type="text/javascript">
                //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
                function tampilkanwaktu() {
                  //buat object date berdasarkan waktu saat ini
                  var waktu = new Date();
                  //ambil nilai jam, 
                  //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
                  var sh = waktu.getHours() + "";
                  //ambil nilai menit
                  var sm = waktu.getMinutes() + "";
                  //ambil nilai detik
                  var ss = waktu.getSeconds() + "";
                  //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
                  document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
                }
              </script>

              <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">

                <span id="clock"></span>
                <?php
                $hari = date('l');
                /*$new = date('l, F d, Y', strtotime($Today));*/
                if ($hari == "Sunday") {
                  echo "Minggu";
                } elseif ($hari == "Monday") {
                  echo "Senin";
                } elseif ($hari == "Tuesday") {
                  echo "Selasa";
                } elseif ($hari == "Wednesday") {
                  echo "Rabu";
                } elseif ($hari == "Thursday") {
                  echo ("Kamis");
                } elseif ($hari == "Friday") {
                  echo "Jum'at";
                } elseif ($hari == "Saturday") {
                  echo "Sabtu";
                }
                ?>,
                <?php
                $tgl = date('d');
                echo $tgl;
                $bulan = date('F');
                if ($bulan == "January") {
                  echo " Januari ";
                } elseif ($bulan == "February") {
                  echo " Februari ";
                } elseif ($bulan == "March") {
                  echo " Maret ";
                } elseif ($bulan == "April") {
                  echo " April ";
                } elseif ($bulan == "May") {
                  echo " Mei ";
                } elseif ($bulan == "June") {
                  echo " Juni ";
                } elseif ($bulan == "July") {
                  echo " Juli ";
                } elseif ($bulan == "August") {
                  echo " Agustus ";
                } elseif ($bulan == "September") {
                  echo " September ";
                } elseif ($bulan == "October") {
                  echo " Oktober ";
                } elseif ($bulan == "November") {
                  echo " November ";
                } elseif ($bulan == "December") {
                  echo " Desember ";
                }
                $tahun = date('Y');
                echo $tahun;
                ?>
                </center>
            </p>
          </div>
        </div>
        <div class="container-fluid">
          <!-- OVERVIEW -->
          <div class="panel panel-headline">
            <div class="panel-body" style="overflow-x: scroll; ">
              <?php echo $contents ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
    </footer>
  </div>
  <!-- END WRAPPER -->
  <!-- Javascript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="<?= base_url() ?>admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>admin/assets/vendor/pace/pace.min.js"></script>
  <script src="<?= base_url() ?>admin/assets/scripts/klorofilpro-common.min.js"></script>
  <script src="<?= base_url() ?>admin/assets/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>admin/assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?= base_url() ?>admin/assets/js/sweetalert2.all.min.js"></script>
  <script src="<?= base_url() ?>admin/assets/js/my-script.js"></script>
  <script>
    $(document).ready(function() {
      $('#table1').DataTable()
      $('#table2').DataTable()
      $('#table3').DataTable()
    })
  </script>
</body>

</html>