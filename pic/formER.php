<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

$stm = $pdo_conn->prepare("SELECT `id_karyawan`, `username`, `nama`, `jabatan`, `marital_status`, `tanggal_masuk`, `jenis_kelamin`, `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_telepon`, departemen.nama_dept 
                           FROM `karyawan` 
                           INNER JOIN departemen ON karyawan.id_dept = departemen.id_dept");

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

  <title>SIER : Formulir ER </title>
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
      include "../components/sidebar-pic.php";
      ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

      <?php
      include "../components/navbar-pic.php";
      ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="#" class="d-none d-sm-inline-block shadow-sm">
      <i></i>
  </div>

<!-- Form  -->
<form class="form-horizontal-sm"> 
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Formulir Employment Requisition</h6>
    </div>
  </div>

  <!-- Page container Formulir ER -->
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-3">
        <div class="form">
          <label>No. Formulir</label>
          <input type="number" name="id_formulir" class="form-control" required>
        </div>
      </div>
      <div class="col-3">
        <label>Date</label>
        <input type="date" name="date" class="form-control" required>
      </div>
    </div> 
<hr>
  <div class="form-row">
      <div class="col-3">
        <div class="form">
          <label>Requester</label>
          <input type="text" name="id_karyawan" class="form-control">
        </div>
      </div>
      <div class="col-3">
        <label>ID#</label>
        <input type="number" name="id_karyawan" class="form-control" required>
      </div>
      <div class="col-3">
        <label>Departemen</label>
        <input type="text" name="id_karyawan" class="form-control">
      </div>
      <div class="col-3">
        <label>Job Type</label>
        <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck1">
        <label class="custom-control-label" for="customCheck1">Permanen</label></br>
        <input type="checkbox" class="custom-control-input" id="customCheck2">
        <label class="custom-control-label" for="customCheck2">Kontrak</label>
      </div>
      </div>
    </div>
<hr>
  <div class="row">
    <div class="col-3">
      <div class="form-group">
        <label>Open Position</label>
          <select class="custom-select">
            <option selected>Open Position</option>
            <option value="1">Operator</option>
            <option value="2">Staff</option>
            <option value="3">Manager</option>
          </select>
      </div>
    </div>
    <div class="col-3">
      <div class="form">
        <label>No. of Request</label>
          <input type="number" name="id_karyawan" class="form-control" required>
      </div>
    </div>
     <div class="col-3">
      <div class="form">
        <label>To Replace</label>
          <input type="text" name="id_karyawan" class="form-control" aria-describedby="addon-wrapping" required>
      </div>
    </div>
    <div class="col-3">
      <div class="form">
        <label>Join Date</label>
          <input type="date" name="id_karyawan" class="form-control" required>
      </div>
    </div>    
</div>
<hr>
  <div class="row">  
      <div class="col">
          <label>Supporting Document</label>
          <input type="text" name="id_karyawan" placeholder="Role Profile" class="input form-control" required>
      </div>
       <div class="col">
          <label>Supporting Document1</label>
          <input type="text" name="id_karyawan" placeholder="Org. Chart" class="input form-control" required>
      </div>
      <div class="col">
          <label>Supporting Document2</label>
          <input type="text" name="id_karyawan" placeholder="Upload File" class="input form-control" required>
      </div>
  </div>
<hr>
  <div class="row">
    <div class="col">
      <div class="form">
        <label>Education Requirement</label>
        <input type="text" name="id_karyawan" class="form-control" required>
    </div>
<hr>
  <div class="row">
    <div class="col">
      <div class="form">
        <label>Major Function</label>
        <input type="" name="id_karyawan" class="form-control" required>
    </div>
<hr>
    <div class="row">
      <div class="col">
        <div class="form">
          <label>Experience & Background Requirement</label>
          <input type="" name="id_karyawan" class="form-control">
      </div>
<hr>
  <div class="row">
      <div class="col-3">
        <div class="form">
          <label>Verified by</label>
            <input type="text" name="id_karyawan" class="form-control" required>
        </div>
      </div>
      <div class="col-3">
        <div class="form">
          <label>Approved by</label>
            <input type="text" name="id_karyawan" class="form-control" required>
        </div>
      </div>
      <div class="col-2">
        <div class="form">
          <label>PIC HRD</label>
            <input type="text" name="id_karyawan" class="form-control">
        </div>
      </div>
        <div class="col-3">
          <input type="button" class="btn btn-info" value="Edit">
        </div>
      </div>
       <div class="col-3">
            <input type="button" class="btn btn-info" value="Submit">
        </div>
      </div>
  </div>
</br>

</div>
    </div>
      </div>
      </div>
    </div>     
  </form>    
</div>
</div>

<!--   Footer -->
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
          <h5 class="modal-title" id="exampleModalLabel">PIC ready to Log Out?</h5>
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