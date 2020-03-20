<?php 
    if(isset($_GET['id'])){
        $id = str_replace(date('mYd'),'',$_GET['id']);
        $sql = $pdo_conn->prepare("SELECT * FROM formulir_er
                                   INNER JOIN karyawan ON karyawan.id_karyawan = formulir_er.idPic
                                   INNER JOIN budget ON budget.idDepartment = karyawan.id_dept
                                   JOIN departemen USING(id_dept)
                                   JOIN statusapproval USING(idFormulir)
                                   WHERE idFormulir='$id' ");
        $sql->execute();
        $getData = $sql->fetch(PDO::FETCH_ASSOC);
        $name = explode(',',$getData['repleace']);
        $nameRepleace = [];
        foreach ($name as $value) {
            $query = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan = '$value' ") ;
            $row = mysqli_fetch_assoc($query);
            array_push($nameRepleace,$row['nama']);
        }
        $hak = $_SESSION ["hak_akses"];
        $back = "";
        if ($hak == "admin") {
            $back = "verify";
        }if($hak == "pic"){
            $back = "pengajuan";
        }elseif($hak == "manager"){
            $back = "approval";
        }
        if(isset($_SESSION['alert'])){
            $message = $_SESSION['error'];
            if ($_SESSION['alert'] == "error") {
                echo '
                    <script type="text/javascript">
                                $(document).ready(function () {
                                    toastError("'.$message.'");
                                });
                            </script>
                ';
            }
            unset($_SESSION['alert']);
            unset($_SESSION['error']);
        }
    }
?>

<div style="padding-left:100px; padding-right:100px;">
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body">
            <a href="?page=<?=$back?>" class="btn btn-info btn-icon-split btn-sm float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a> <br><br>
            <div style="padding-left:100px; padding-right:100px;" class="border">
                <p class="font-weight-bold text-center" style="margin-top: 10px">EMPLOYMENT REQUISITION FORM</p>
                <b>NO : <?=$getData['idFormulir'] ?></b>
                <b class="float-right">DATE : <?=date('d F Y', strtotime($getData['created']) ) ?></b>
                <div class="mt-1" style="font-family: times new roman; font-size: 16px;">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <td >Dept : <?=$getData['nama_dept'] ?></td>
                            <td >Cost Centre : <?=$getData['cost_center'] ?></td>
                            <td >Hiring PIC : <?=$getData['nama'] ?></td>
                            <td rowspan="2">Job Type :
                                <div class="form-check ml-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" <?=$getData['job'] == "permanen" ? "checked" : "" ?> disabled >
                                    <label class="form-check-label" for="exampleCheck1">Permanen</label>
                                </div>
                                <div class="form-check ml-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" <?=$getData['job'] == "kontrak" ? "checked" : "" ?> disabled>
                                    <label class="form-check-label" for="exampleCheck2">Kontrak</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-capitalize" >Open Position : <?=$getData['position'] ?></td>
                            <td>Number Of Request : <?=$getData['reques'] ?> Orang</td>
                            <td>ID PIC : <?=$getData['idPic'] ?></td>
                        </tr>
                        <tr>
                            <td>Budget : <?=$getData['budget'] ?> Orang</td>
                            <td colspan="2">Replace Name : 
                                <?php 
                                    foreach ($nameRepleace as $data) { ?>
                                        <a href="#" class="badge badge-primary"><?=$data?></a>
                                    <?php
                                    }
                                ?>
                            </td>
                            <td>Join Date : <?=date('d F Y', strtotime($getData['joinDate']) ) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">Education Requirement : <?=$getData['education'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">Experience and Background Requirement : <?=$getData['experience'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">Major Function : <?=$getData['major'] ?></td>
                        </tr>
                        <tr>
                            <td colspan=4> Supporting Document : <br>
                                <div class="row">
                                    <div class="form-check col" style="margin-left: 150px">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" <?=$getData['typeDocument'] == "Role Profile" ? "checked" : "" ?> disabled >
                                        <label class="form-check-label" for="exampleCheck1">Role Profile</label>
                                    </div>
                                    <div class="form-check col">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2" <?=$getData['typeDocument'] == "Organization Chart" ? "checked" : "" ?> disabled>
                                        <label class="form-check-label" for="exampleCheck2">Organization Chart</label>
                                    </div>
                                
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <embed src="../assets/uploadFiles/<?=$getData['document'] ?>" type="application/pdf" width="100%" height="200px" />
                            </td>
                        </tr>
                        <?php 
                            $hide = 0;
                            if ($_SESSION ["hak_akses"] == "manager") {
                                $hide = 1;
                            }elseif ($_SESSION ["hak_akses"] == "admin") {
                                $hide = 5;
                            }
                        ?>
                        <tr class="<?= $getData['status'] == $hide ? "d-none" : "" ?>">
                            <td colspan="4" >
                                <p><b>Komentar by admin : </b> <?=$getData['komentarA'] ?> </p>
                                <p><b>Komentar by manager : </b> <?=$getData['komentarM'] ?> </p> 
                            </td>
                        </tr>
                        <tr style="height: 80px; border-bottom: 0px">
                            <td class="text-center align-middle" colspan="4" style="border-bottom: 0px">
                                <div class="row">
                                    <div class="col">
                                        <span class="text-success"><i class="fas fa-check fa-lg"></i></span>
                                    </div>
                                    <div class="col">
                                        <?php 
                                            if ($getData['status'] == 5 ) { 
                                                if ($_SESSION ["hak_akses"] == "admin") { ?>
                                                    <a href="javascript:void(0)" class="text-success action" id="verify" idForm="<?=$getData['idFormulir'] ?>">
                                                        <i class="fas fa-check fa-lg"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="text-danger action" id="notVerify" idForm="<?=$getData['idFormulir'] ?>">
                                                        <i class="fas fa-times fa-lg"></i>
                                                    </a>    
                                                <?php
                                                }
                                            }elseif ($getData['status'] == 1 || $_SESSION ["hak_akses"] == "manager" || $getData['status'] == 3 || $getData['status'] == 4) {?>
                                                <span class="text-success"><i class="fas fa-check fa-lg"></i></span>
                                            <?php
                                            }elseif ($getData['status'] == 2 || $getData['status'] == 3 || $getData['status'] == 4) { ?>
                                                <span class="text-danger"><i class="fas fa-times fa-lg"></i></span>
                                            <?php
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="col">
                                        <?php 
                                            if ($getData['status'] == 1 ) {
                                                if ($_SESSION ["hak_akses"] == "manager") { ?>
                                                    <a href="javascript:void(0)" class="text-success action" id="approve" idForm="<?=$getData['idFormulir'] ?>">
                                                        <i class="fas fa-check fa-lg"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="text-danger action" id="notApprove"  idForm="<?=$getData['idFormulir'] ?>">
                                                        <i class="fas fa-times fa-lg"></i>
                                                    </a>
                                                <?php
                                                } 
                                            ?>
                                                
                                            <?php
                                            }elseif ( $getData['status'] == 3 ) { ?>
                                                <span class="text-success"><i class="fas fa-check fa-lg"></i></span>
                                            <?php
                                            }elseif ( $getData['status'] == 4 ) { ?>
                                                <span class="text-danger"><i class="fas fa-times fa-lg"></i></span>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr  >
                            <td class="text-center align-middle" colspan="4" style="border-top: 0px">
                                <div class="row">
                                    <div class="col">
                                        <b>Requester</b>
                                    </div>
                                    <div class="col">
                                        <b>Verify By</b>
                                    </div>
                                    <div class="col">
                                        <b>Approved By</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <?=$getData['nama'] ?>
                                    </div>
                                    <div class="col">
                                        Admin
                                    </div>
                                    <div class="col">
                                        Manager
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>








