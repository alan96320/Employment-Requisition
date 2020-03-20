<?php
    include "../action/config.php";
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d H:i:s');
    if (isset($_SESSION ["username"])) { 
        $hak = $_SESSION ["hak_akses"];
        if ($hak == "admin") {
            $stm = $pdo_conn->prepare("SELECT * FROM statusapproval JOIN formulir_er USING(idFormulir) INNER JOIN karyawan ON karyawan.id_karyawan = formulir_er.idPic JOIN departemen USING(id_dept) WHERE status=5 && isReadA IS NULL LIMIT 5 ");
        }elseif ($hak == "manager") {
            $stm = $pdo_conn->prepare("SELECT * FROM statusapproval JOIN formulir_er USING(idFormulir) INNER JOIN karyawan ON karyawan.id_karyawan = formulir_er.idPic JOIN departemen USING(id_dept) WHERE status=1 and isReadM IS NULL LIMIT 5 ");
        }else{
            $stm = $pdo_conn->prepare("SELECT * FROM statusapproval WHERE status !=5 && isReadP IS NULL LIMIT 5 ");
        }
        $stm->execute();
        $alert = $stm->fetchAll(PDO::FETCH_ASSOC);
        // $tes = $stm->fetch(PDO::FETCH_ASSOC);
        $count = $stm->rowCount();
//         $result = $stm->fetch(PDO::FETCH_ASSOC);
// // print_r($result);
//         $dif = date_diff(date_create($date),date_create($result['created']));
//         echo 'sekarang = '.$date.'<br>';
//         echo 'database = '.$result['created'].'<br>';
        // echo $dif->format('%y Year %m Month %d Day %h Hours %i Minute %s Seconds');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php if(isset($_SESSION ["hak_akses"])){ ?> 
        <title>SIER <?= $_SESSION ["hak_akses"] == "admin" ? "Admin" : ($_SESSION ["hak_akses"] == "pic" ? "PIC" : ($_SESSION ["hak_akses"] == "manager" ? "Manager" : "")) ?> Dashboard</title>
    <?php } ?>

    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../assets/js/custom/toast.js"></script>
    <!-- for datepicker -->
    <link rel="stylesheet" href="../assets/vendor/datepicker/datepicker.css">
    <!-- for select slime -->
    <link rel="stylesheet" href="../assets/vendor/selectslime/slimselect.css">
    <!-- for jquery toas -->
    <link rel="stylesheet" href="../assets/vendor/jqueryToast/jquery.toast.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="../assets/css/customStyle.css">

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?page=dashboard">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fab fa-asymmetrik"></i></div>
                <div class="sidebar-brand-text mx-3">
                    <?php 
                        if($_SESSION ["hak_akses"] == "admin"){
                            echo "S I E R <sup>ADMIN</sup>";
                        }else if($_SESSION ["hak_akses"] == "pic"){
                            echo "Dashboard <sup>PIC Dept.</sup>";
                        }else if($_SESSION ["hak_akses"] == "manager"){
                            echo "Dashboard <sup> Manager</sup>";
                        }
                    ?>
                </div>
            </a>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                <?= $_SESSION ["hak_akses"] == "admin" ? "Admin" : ($_SESSION ["hak_akses"] == "pic" ? "PIC" : ($_SESSION ["hak_akses"] == "manager" ? "Manager" : "")) ?>
            </div>
            <li class="nav-item active">
                <a class="nav-link" href="?page=dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
            <?php 
                if ($_SESSION ["hak_akses"] == "admin") { ?>
            <li class="nav-item">
                <a class="nav-link" href="?page=karyawan">
                <i class="fas fa-fw fa-database"></i>
                <span>Data Karyawan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=budget">
                <i class="fas fa-fw fa-database"></i>
                <span>Budget</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=verify">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>List Status Verify</span></a>
            </li>
            <?php
                }elseif ($_SESSION ["hak_akses"] == "pic") { ?>
            <li class="nav-item">
                <a class="nav-link" href="?page=pengajuan">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Pengajuan</span></a>
            </li>
            <?php
                }elseif ($_SESSION ["hak_akses"] == "manager"){?>
            <li class="nav-item">
                <a class="nav-link" href="?page=approval">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Approval</span></a>
            </li>
                <?php
                }
            ?>
            

            <hr class="sidebar-divider d-none d-md-block">
            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- // navbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <p class="font-weight-bold" style="margin-top: 10px"> SISTEM INFORMASI EMPLOYMENT REQUISITION </p>
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-counter <?=$count == 0 ? 'd-none' : '' ?> ">
                                <span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="false"></span>
                            </span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                            Alerts Center
                            </h6>
                            <?php
                            if ($count > 0) {
                                if ($hak != "pic") { 
                                    foreach ($alert as $data) {
                                        $dif = date_diff(date_create($date),date_create($data['created'])); ?>
                                        <a class="dropdown-item d-flex align-items-center" href="../action/actionAlert.php?id=<?=$data['idFormulir']?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Pengajuan baru dari Department <?=$data['nama_dept'] ?> </span>
                                                <div class="small text-gray-500">
                                                    <?php
                                                        if ($dif->format("%y") > 0) {
                                                            echo $dif->format("%y Year Ago");
                                                        }elseif ($dif->format("%m") > 0) {
                                                            echo $dif->format("%m Mount Ago");
                                                        }elseif ($dif->format("%d") > 0) {
                                                            echo $dif->format("%d Day Ago");
                                                        }elseif ($dif->format("%h") > 0) {
                                                            echo $dif->format("%h Hours Ago");
                                                        }elseif ($dif->format("%i") > 0) {
                                                            echo $dif->format("%i Minute Ago");
                                                        }elseif ($dif->format("%s") > 0) {
                                                            echo $dif->format("%s Seconds Ago");
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </a> 
                                    <?php
                                    } ?>
                                       
                                <?php
                                }else{ 
                                    foreach ($alert as $data) {
                                        if ($data['status'] == 1) {
                                            $dif = date_diff(date_create($date),date_create($data['timeVerify']));
                                            $message = "Pengajuan pada tanggal ".date('F d Y', strtotime($data['created']) ) ." disetujui oleh admin";
                                            $bg = "bg-success";
                                            $icon = "fa-check-circle";
                                        } elseif ($data['status'] == 2) {
                                            $dif = date_diff(date_create($date),date_create($data['timeVerify']));
                                            $message = "Pengajuan pada tanggal ".date('F d Y', strtotime($data['created']) ) ." tidak disetujui oleh admin";
                                            $bg = "bg-danger";
                                            $icon = "fa-times-circle";
                                        } elseif ($data['status'] == 3) {
                                            $dif = date_diff(date_create($date),date_create($data['timeApprove']));
                                            $message = "Pengajuan pada tanggal ".date('F d Y', strtotime($data['created']) ) ." disetujui oleh manager";
                                            $bg = "bg-success";
                                            $icon = "fa-check-circle";
                                        } elseif ($data['status'] == 4) {
                                            $dif = date_diff(date_create($date),date_create($data['timeApprove']));
                                            $message = "Pengajuan pada tanggal ".date('F d Y', strtotime($data['created']) ) ." tidak disetujui oleh manager";
                                            $bg = "bg-danger";
                                            $icon = "fa-times-circle";
                                        }
                                        // echo 'sekarang = '.$date.'<br>';
                                        // echo 'database = '.$data['timeApprove'].'<br>';
                                        // echo $dif->format('%y Year %m Month %d Day %h Hours %i Minute %s Seconds'); 
                                        ?>
                                        
                                        <a class="dropdown-item d-flex align-items-center" href="../action/actionAlert.php?id=<?=$data['idFormulir']?>">
                                            <div class="mr-3">
                                                <div class="icon-circle <?=$bg?>">
                                                    <i class="fas <?=$icon?> text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold"><?=$message ?> </span>
                                                <div class="small text-gray-500">
                                                    <?php
                                                        if ($dif->format("%y") > 0) {
                                                            echo $dif->format("%y Year Ago");
                                                        }elseif ($dif->format("%m") > 0) {
                                                            echo $dif->format("%m Mount Ago");
                                                        }elseif ($dif->format("%d") > 0) {
                                                            echo $dif->format("%d Day Ago");
                                                        }elseif ($dif->format("%h") > 0) {
                                                            echo $dif->format("%h Hours Ago");
                                                        }elseif ($dif->format("%i") > 0) {
                                                            echo $dif->format("%i Minute Ago");
                                                        }elseif ($dif->format("%s") > 0) {
                                                            echo $dif->format("%s Seconds Ago");
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </a>
                                        
                                    <?php
                                    } 
                                }
                            }else{ ?>
                                <div class="dropdown-item d-flex align-items-center">
                                    <div class="small text-gray-500">Maaf tidak ada informasi terbaru...</div>
                                </div>
                            <?php
                            }
                                
                            ?>
                        </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize"><?=$_SESSION ["name"]?></span>
                                <img class="img-profile rounded-circle" src="../assets/uploadImage/<?=$_SESSION ["image"]?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="?page=profileKaryawan&id=<?=date("mYd").$_SESSION["id"]?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
                                </a>
                                <a class="dropdown-item" href="../action/logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- end navbar -->
                <!-- isi atau content -->
                <div class="container-fluid">
                    <?php include "config_pages.php" ?>
                </div>
                <!-- end content -->
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistem Informasi Employment Requisition 2019</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- js for datepicker -->
    <script src="../assets/vendor/datepicker/datepicker.js"></script>
    <!-- js for select slim -->
    <script src="../assets/vendor/selectslime/slimselect.js"></script>
    <!-- js for jquery Toast -->
    <script src="../assets/vendor/jqueryToast/jquery.toast.min.js"></script>

    <!-- custom scripts -->
    <script src="../assets/js/custom/custom.js" type="text/javascript"></script>
    <script src="../assets/js/custom/customAlert.js"></script>
    <script src="../assets/js/custom/customDatepicker.js"></script>

    
    
</body>

</html>


<?php
    }else{
        header("location: ../");
    }
?>