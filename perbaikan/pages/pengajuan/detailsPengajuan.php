<?php 
    if(isset($_GET['id'])){
        $id = str_replace(date('mYd'),'',$_GET['id']);
        $sql = $pdo_conn->prepare("SELECT * FROM formulir_er WHERE idFormulir='$id'");
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
        }elseif($hak == "pic"){
            $back == "pengajuan";
        }elseif($hak == "manager"){
            $back = "approval";
        }
    }
?>
<div style="padding-left:300px; padding-right:300px;">
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="row p-4" style="font-family: times new roman; font-size: 16px;">
                <div class="col-sm-2">Number Formulir</div>
                <div class="col-sm-4">: <span class="badge badge-light" style="font-size: 16px;"><?=$getData['idFormulir'] ?></span></div>
                <div class="col-sm-6 text-right"><?=date('d F Y', strtotime($getData['created']) ) ?></div>
                <br><br><br>
                <div class="col-sm-2">Open Position</div>
                <div class="col-sm-2 text-capitalize">: <?=$getData['position'] ?></div>
                <div class="col-sm-2 text-right">Job Type</div>
                <div class="col-sm-2 text-capitalize">: <?=$getData['job'] ?></div>
                <div class="col-sm-2">No. Of Request</div>
                <div class="col-sm-2">: <?=$getData['reques'] ?> Orang</div>
                <div class="w-100 mt-2"><hr></div>
                <div class="col-sm-2">To replace</div>
                <div class="col-sm-10">:
                    <?php 
                        foreach ($nameRepleace as $data) { ?>
                            <a href="#" class="badge badge-primary"><?=$data?></a>
                        <?php
                        }
                    ?>
                </div>
                <div class="w-100"><hr></div>
                <div class="col-sm-2">Join Date</div>
                <div class="col-sm-10">: <?=date('d F Y', strtotime($getData['joinDate']) ) ?></div>
                <div class="w-100"><hr></div>
                <div class="col-sm-2">Major Function</div>
                <div class="col-sm-10">: <?=$getData['major'] ?></div>
                <div class="w-100"><hr></div>
                <div class="col-sm-3">Support Document</div>
                <div class="col-sm-9">: <?=$getData['typeDocument'] ?></div> 
                <div class="w-100"><hr></div>
                <div class="col-sm-3">Education Requirement</div>
                <div class="col-sm-9 text-uppercase">: <?=$getData['education'] ?></div>
                <div class="w-100"><hr></div>
                <div class="col-sm-4">Experience & Background Requirement</div>
                <div class="col-sm-8">: <?=$getData['experience'] ?></div>
                <div class="w-100"><hr></div>
                <div class="col-sm-12">
                    <embed src="../assets/uploadFiles/<?=$getData['document'] ?>" type="application/pdf" width="100%" height="200px" />
                </div>
                <div class=" col-sm-12">
                    <a href="?page=<?=$back?>" class="btn btn-info btn-icon-split float-right">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>