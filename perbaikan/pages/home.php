<?php
    session_start();
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
            <li class="nav-item">
                <a class="nav-link" href="?page=karyawan">
                <i class="fas fa-fw fa-database"></i>
                <span>Data Karyawan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=pengajuan">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Pengajuan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=persetujuan">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Emp. Requisition</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=requisition">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Persetujuan</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <p class="font-weight-bold" style="margin-top: 10px"> SISTEM INFORMASI EMPLOYMENT REQUISITION </p>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize"><?=$_SESSION ["username"]?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/<?=$_SESSION ["image"]?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
                                </a>
                                <a class="dropdown-item" href="../action/logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <?php include "config_pages.php" ?>
                </div>
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
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
