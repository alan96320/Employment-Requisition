<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

$user_id = $_SESSION['id'];
$stm = $pdo_conn->prepare("SELECT * FROM users as u JOIN departemen as d ON u.departemen = d.id_dept  WHERE user_id=$user_id");

$stm->execute();
$data_user = $stm->fetch(PDO::FETCH_ASSOC);
//lihat($data_user);

$stm = $pdo_conn->prepare("SELECT max(id_formulir) as maxid FROM formulir");

$stm->execute();
$data_max = $stm->fetch(PDO::FETCH_ASSOC);
//lihat($data_max);
$idx = $data_max['maxid'] + 1;

$stm = $pdo_conn->prepare("SELECT `id_pic`, `id_formulir`, `id_departemen`, `requester`, `job_type`, 
                            `status_verif`, `status_approved`, `approved_by`, `verif_by`, `open_position`, 
                            `join_date`, `budget`, `education_req`, `major_function`, `experience_backgrnd` 
                         FROM `formulir`");

$stm->execute();
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
// lihat($rows);

// print_r($rows);

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include "../components/sidebar-pic.php"; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
            <?php include "../components/navbar-pic.php"; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            Formulir Employment Requisition (ER)
                        </h1>
                    </div>

                    <!-- Form  -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- <form class="form-horizontal-sm"> -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Formulir ER</h6>
                            </div>
                            <!-- </div> -->
                            <!-- Page container Formulir ER -->
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-3">
                                        <div class="form">
                                            <label>Form. No.</label>
                                            <input type="number" readonly="" name="id_formulir" value="<?= $idx; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control" required value="<?=date('Y-m-d')?>" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>ID# PIC</label>
                                            <input readonly="" value="<?= $data_user['user_id']; ?>" type="text"
                                                name="id_karyawan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label>Requester</label>
                                        <input type="text" readonly="" value="<?= $data_user['nama']; ?>"
                                            name="id_karyawan" class="form-control" required>
                                    </div>
                                    <div class="col-3">
                                        <label>Departemen</label>
                                        <input type="text" readonly="" value="<?= $data_user['nama_dept']; ?>"
                                            class="form-control">
                                        <input hidden="" type="text" name="id_dept" readonly=""
                                            value="<?= $data_user['departemen']; ?>" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Job Type</label>
                                            <div class="form-group" style="padding-left: 0px;">
                                                <input type="checkbox" name="checked" value="permanen" class=" "
                                                    style="transform: scale(1.3);">
                                                <label class="">Permanen</label></br>
                                                <input type="checkbox" name="job_type" value="kontrak" class=" "
                                                    style="transform: scale(1.3);">
                                                <label class=" ">Kontrak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Open Position</label>
                                            <select class="custom-select" required>
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
                                            <input type="number" name="id_karyawan"
                                                placeholder="jumlah orang yang diganti" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form">
                                            <label>To Replace</label>
                                            <input type="text" name="id_karyawan" placeholder="masukkan nama pengganti"
                                                class="form-control" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form">
                                            <label>Join Date</label>
                                            <input type="date" name="id_karyawan" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Supporting Document</label>
                                            <select name="" class="custom-select" required>
                                                <option selected>Dokumen Pendukung</option>
                                                <option value="1">Role Profile</option>
                                                <option value="2">Organization Chart</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Upload File Supporting Document</label>
                                        <input type="file" name="image" placeholder="" class="" required>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Education Requirement</label>
                                            <select class="custom-select" required>
                                                <option selected>Persyaratan Pendidikan</option>
                                                <option value="1">SMK</option>
                                                <option value="2">D3/D4</option>
                                                <option value="3">Sarjana</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="form">
                                            <label>Major Function</label>
                                            <input type="text" name="majorfunction" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="form">
                                            <label>Experience & Background Requirement</label>
                                            <input type="text" name="experiece" class="form-control" required>
                                        </div><br>
                                        <center><a class='btn btn-success' value="submit"
                                                href='../pic/statusform.php'>Simpan</a></center>
                                    </div>
                                </div>
                                <hr>
                            </div>
                    </form>
                </div>
                </form>
            </div>


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

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

    <!-- Bootstrap core JavaScript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages -->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>