<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

$id = isset($_GET['id']) ? $_GET['id'] : '';

$stm2 = $pdo_conn->query(
                  "SELECT `id_karyawan`, `username`, `nama`, `jabatan`, `marital_status`, `tanggal_masuk`,     `jenis_kelamin`, `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`,    `no_telepon`, departemen.nama_dept
                  FROM `karyawan` 
                  LEFT JOIN departemen ON karyawan.id_dept = departemen.id_dept 
                  WHERE karyawan.id_karyawan = '$id'");

$stmDep = $pdo_conn->prepare("SELECT * FROM `departemen`");
$stmDep->execute();
$rowsDepartemen = $stmDep->fetchAll(PDO::FETCH_ASSOC);

$stmJab = $pdo_conn->prepare("SELECT * FROM `jabatan`");
$stmJab->execute();
$rowsJabatan = $stmJab->fetchAll(PDO::FETCH_ASSOC);

$stmMar = $pdo_conn->prepare("SELECT * FROM `marital_status`");
$stmMar->execute();
$rowsMarital = $stmMar->fetchAll(PDO::FETCH_ASSOC);


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

  <title>SIER : Detail Karyawan </title>
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
        <center>
          <h2 style="margin-left: 20px" <p class="text-primary">Halaman Detail Karyawan</h2>
        </center>
        <div class="container-fluid" style=" display: flex; justify-content: center; align-items: center; ">
          <!-- <img src="../img/CVB.jpg" style="width: 300px; height: 400px; "> -->

          <?php
          while ($row = $stm2->fetch()) {
          ?>

            <form style=" flex-grow: 1; margin-left: 49px;" method="post" action="../actions/update-karyawan-action-copy.php?id=">
              <div class=" form-group">
                <label for="id_karyawan" required>NIK</label>
                <input type="text" class="form-control" value="<?= $row['id_karyawan'] ?>">
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" value="<?= $row['nama'] ?>">
              </div>
              <div class="form-group">
                <label for="departemen">Departemen</label>
                <select class="form-control" name='departemen'>
                  <option>Pilih Departemen</option>
                  <!-- <input type="text" class="form-control" value="<?= $row['nama_dept'] ?>"> -->

                  <?php
                  foreach ($rowsDepartemen as $rowDepartemen) {
                    echo ('<option value="' . $rowDepartemen["id_dept"] . '">' . $rowDepartemen["nama_dept"] . ' - ' . $rowDepartemen["cost_center"]  . '</option>');
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <!-- <input type="text" class="form-control" value="<?= $row['jabatan'] ?>"> -->
                <select class="form-control" name='jabatan'>
                  <option>Pilih Jabatan</option>

                  <?php
                  foreach ($rowsJabatan as $rowJabatan) {
                    echo ('<option value="' . $rowJabatan["id_jabatan"] . '">' . $rowJabatan["nama"] . '</option>');
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="tanggal_masuk" required>Tanggal Masuk</label>
                <input type="date" class="form-control" value="<?= $row['tanggal_masuk'] ?>">
              </div>
              <div class="form-group">
                <label for="marital_status">Marital Status</label>
                <!-- <input type="text" class="form-control" value="<?= $row['marital_status'] ?>"> -->

                <select class="form-control" name='status'>
                  <option>Pilih Marital Status</option>

                  <?php
                  foreach ($rowsMarital as $rowMarital) {
                    echo ('<option values="' . $rowMarital["id_marital"] . '">' . $rowMarital["nama"] . '</option>');
                  }
                  ?>

                </select>

              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

          <?php
          }
          ?>

        </div>

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
  <!-- End of Scroll to Top Button-->

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
        <!-- <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> -->
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../actions/logoutaction.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Logout Modal -->

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