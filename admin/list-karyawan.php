<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

$stm = $pdo_conn->prepare(
  "SELECT `id_karyawan`, `username`, karyawan.`nama`, jabatan.nama as `jabatan`, `tanggal_masuk`, `jenis_kelamin`, `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_telepon`, departemen.nama_dept , marital_status.nama as marital_status
     FROM `karyawan` 
     JOIN departemen ON karyawan.id_dept = departemen.id_dept
     JOIN jabatan ON karyawan.jabatan = jabatan.id_jabatan
     JOIN marital_status ON karyawan.marital_status = marital_status.id_marital"
);

$stm->execute();
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

//print_r($rows);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIER : Data Karyawan </title>
  <!-- Favicon-->
  <link rel="icon" href="../img/alcr.jpg" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

      <?php
      include "../components/sidebar.php";
      ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

      <?php
      include "../components/navbar.php";
      ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="tambah-karyawan.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas  fa-user-plus fa-sm text-white-50"></i> Tambah Karyawan </a>
  </div>

  <!-- Data Tables  -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Karyawan PT. CIBA VISION Batam</h6>
    </div>
      <div class="card-body">
        <div class="table table-hover table-responsive">
          <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="10">

      <thead class="thead-dark">
        <div class="row justify-content-md-center">
          <tr role="row">
            <th>ID#</th>
            <th>Nama</th>
            <th>Departemen</th>
            <th>Jabatan</th>
            <th>Marital Status</th>
            <th>Tanggal Masuk</th>
            <th>Jenis Kelamin</th>
            <th>Status Karyawan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th class="" colspan="2" style="width: 157px;">Aksi</th>         
          </tr>
        </thead>
          
          <tbody>
            <?php
            foreach ($rows as $row) {
            echo ('
            <tr>
            <td>' . $row['id_karyawan'] . '</td>
            <td>' . $row['nama'] . '</td>
            <td>' . $row["nama_dept"] . '</td>
            <td>' . $row["jabatan"] . '</td>
            <td>' . $row["marital_status"] . '</td>
            <td>' . $row["tanggal_masuk"] . '</td>
            <td>' . $row["jenis_kelamin"] . '</td>
            <td>' . $row["status_karyawan"] . '</td>
            <td>' . $row["tempat_lahir"] . '</td>
            <td>' . $row["tanggal_lahir"] . '</td>
            <td>' . $row["alamat"] . '</td>
            <td> <a class="btn btn-outline-primary btn-sm" href="./detail-karyawan.php?id=' . 
                    $row["id_karyawan"] . '">EDIT</a></td>
            <td> <a class="btn btn-outline-danger btn-sm" href="../actions/delete-karyawan-action.php?id_karyawan=
                ' . $row["id_karyawan"] . '">HAPUS</Tambah></td>
            </tr> ');
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  </div>
  <!-- End of Container Fluid -->

  </div>
  <!-- End of Main Content -->

  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Sistem Informasi Employment Requisition 2019</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Admin ready to Log Out?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../actions/logoutaction.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Logout Modal-->

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="../assets/vendor/chart.js/Chart.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="../assets/js/demo/chart-area-demo.js"></script>
  <script src="../assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>