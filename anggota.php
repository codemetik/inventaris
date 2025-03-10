<?php 
session_start();
include "koneksi.php";
if (!isset($_SESSION['agent']) && !isset($_SESSION['id_user'])) {
  echo "<script>document.location.href = 'login.php';</script>";
}

$query = mysqli_query($koneksi, "select * from user_agent x inner join tb_user y on y.id_user = x.id_user 
inner join dompet_user z on z.id_user = y.id_user where name_user_agent = '".$_SESSION['agent']."' and x.id_user = '".$_SESSION['id_user']."' group by x.id_user asc");
$user = mysqli_fetch_array($query);

if ($user['id_level'] != '2') {
  echo "<script>document.location.href = 'logout.php';</script>";
}

function rupiah($angka){
  $hasil_rupiah = "Rp. " . number_format($angka, 2 ,',','.');
  return $hasil_rupiah;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Inventaris</title>
  <link rel="icon" href="dist/img/logoinventaris.jpg">

  <link rel="stylesheet" type="text/css" href="dist/css/style.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">

  <!-- Add the evo-calendar.css for styling -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/css/evo-calendar.min.css"/>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<style type="text/css">
  .bg-nav{
    background-image: linear-gradient(#6495ED, #6495ED);
  }
  .bg-radian{
    background-image: linear-gradient(white, #6495ED);
  }
  .bg-foot{
    background-image: linear-gradient(#6495ED, #6495ED)
  }
  .bg-abu{
    background-color: #6495ED;
  }
  .text-abu{
    color: #6495ED;
  }
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" onload="myFunction()" style="margin: 0;">
<div id="loader"></div>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-nav navbar-primary elevation-1">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="btn bg-white elevation-1 img-circle" data-widget="pushmenu">
          <i class="fas fa-wallet text-abu"></i> <!-- <h6 class="text-primary">Saldo</h6> -->
        </a>
      </li>
      <li class="nav-item d-lg-inline-block">
        <h4><a href="anggota.php?page=profile" class="nav-link text-bold text-white"><?= $user['user']; ?></a></h4>
      </li>
    </ul>

    <!-- SEARCH FORM -->


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar bg-radian text-bold text-white elevation-1">
    <!-- Brand Logo -->
    <a href="?page=home" class="brand-link">
      <img src="dist/img/logoinventaris.jpg" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8;" width="120" height="40">
      <span class="brand-text bold text-dark">Inventaris</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="?page=message<file sudah dihapus>" class="nav-link active">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Message
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="logout.php" class="nav-link text-dark">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
        <div class="row">
          <div class="col-md-12 col-sm-6 col-12">
            <a href="use_chatgroup.php" class="text-dark">
            <div class="info-box callout callout-grey">
              <span class="info-box-icon text-orange elevation-1"><i class="far fa-comments"></i></span>

              <div class="info-box-content">
                <div class="direct-chat-msg">
                  <div class="direct-chat text-sm text-left" id="showone">
                    <!-- show limit 1 -->
                  </div>  
                </div>  
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Chat group
                </span> 
              </div>
             </div>
            <!-- /.info-box -->
          </a>
          </div>
          <!-- /.col -->
        </div>
      </nav>
      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content pt-4 pb-3 mb-5">
      <div class="container-fluid">
          <?php 
            if (isset($_GET['page'])) {
              $page = $_GET['page'];
              switch ($page) {
                case 'home':
                  include 'anggota/home.php';
                  break;
                case 'tiket_wadompet':
                  include 'anggota/tiket_wadompet.php';
                  break;
                case 'riwayat_trx':
                  include "anggota/riwayat_trx.php";
                  break;
                case 'riwayat_pinjam';
                  include "anggota/riwayat_pinjam.php";
                  break;
                case 'profile':
                  include "anggota/profile_anggota.php";
                  break;
                case 'daftar_tiket':
                  include 'anggota/daftar_tiket.php';
                  break;
                case 'dompet':
                  include "anggota/dompet.php";
                  break;
                  case 'tariktunai':
                  include "anggota/tariktunai.php";
                  break;
                case 'sendsaldo':
                  include "anggota/sendsaldo.php";
                  break;
                case 'kas_user':
                  include "anggota/kas_user.php";
                  break;
                  
                default:
                  include 'anggota/home.php';
                  break;
              }
            }else{
              include 'anggota/home.php';
            }

            if (isset($_GET['page']) == 'home') {
              if ($_GET['page'] != 'home') {
                $bgh = 'bg-white';
              }else{
                $bgh = 'bg-dark';
              }
            }
            if (isset($_GET['page']) == 'riwayat_trx') {
              if ($_GET['page'] != 'riwayat_trx') {
                $bgr = 'bg-white';
              }else{
                $bgr = 'bg-dark';
              }
            }

            if (isset($_GET['page']) == 'riwayat_pinjam') {
              if ($_GET['page'] != 'riwayat_pinjam') {
                $bgrp = 'bg-white';
              }else{
                $bgrp = 'bg-dark';
              }
            }

            if (isset($_GET['page']) == 'daftar_tiket') {
              if ($_GET['page'] != 'daftar_tiket') {
                $bgd = 'bg-white';
              }else{
                $bgd = 'bg-dark';
              }
            }
            if (isset($_GET['page']) == 'profile') {
              if ($_GET['page'] != 'profile') {
                $bgp = 'bg-white';
              }else{
                $bgp = 'bg-dark';
              }
            }

            ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer bg-abu">
    <div class="row">
      <div class="col-3"><a href="?page=home" title="Home">
        <div class="info-box <?= $bgh; ?>">
          <span class="info-box-icon text-orange"><i class="fas fa-home"></i></span>
        </div>
        <!-- /.info-box -->
      </a>
      </div>
      <!-- /.col -->
      <div class="col-3"><a href="?page=riwayat_trx" title="Tiket Pinjam">
        <div class="info-box <?= $bgr; ?>">
          <span class="info-box-icon text-orange"><i class="fas fa-table"></i></span>
        </div>
        <!-- /.info-box -->
      </a>
      </div>
      <!-- /.col -->

      <div class="col-3"><a href="?page=riwayat_pinjam" title="Riwayat Pinjam">
        <div class="info-box <?= $bgrp; ?>">
          <span class="info-box-icon text-orange"><i class="fas fa-table"></i></span>
        </div>
        <!-- /.info-box -->
      </a>
      </div>
      <!-- /.col -->
      
      <div class="col-3"><a href="?page=profile">
        <div class="info-box <?= $bgp; ?>" title="Profile">
          <span class="info-box-icon text-orange"><i class="fas fa-user"></i></span>
        </div>
        <!-- /.info-box -->
      </a>
      </div>
      <!-- /.col -->
    </div>
  </footer>
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>

<!-- Add jQuery library (required) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

<!-- Add the evo-calendar.js for.. obviously, functionality! -->
<!-- <script src="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/js/evo-calendar.min.js"></script>
<script>
  $('#calendar').evoCalendar({
    theme: 'Royal Navy'
});
</script> -->
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $("#example3").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>

<script type="text/javascript">
  var myVar;
  function myFunction(){
    myVar = setTimeout(showPage, 1000);
  }

  function showPage(){
    document.getElementById('loader').style.display = "none";
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){   
    $('.form-checkbox').click(function(){
      if($(this).is(':checked')){
        $('.check').attr('type','text');
      }else{
        $('.check').attr('type','password');
      }
    });
  });
</script>

<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 3000
    });
<?php 
if (isset($_GET['editprofile']) == 'sukses') { ?>
    $(function() {
          Toast.fire({
            type: 'success',
            title: 'Perubahan data telah disimpan.'
          })
        });
<?php }else if (isset($_GET['tiket']) == 'sukses'){ ?>
    $(function() {
          Toast.fire({
            type: 'success',
            title: 'Request tiket anda telah terkirim.'
          })
        });
<?php }
?>  
});

</script>
<script type="text/javascript">
  $(document).ready(function(){
    function show() {
      $("#showone").load("chat/widgets.php");
    }
    show();
    setInterval(show,1);
    function notifcat() {
      $("#notifcat").load("chat/notifcat.php");
    }
    notifcat();
    setInterval(notifcat,1);
  });
</script>
</body>
</html>
