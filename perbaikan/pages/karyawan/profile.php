<?php 
    if(isset($_GET['id'])){
        $id = str_replace(date('mYd'),'',$_GET['id']);
        $sql = $pdo_conn->prepare("SELECT * FROM karyawan JOIN departemen USING (id_dept) JOIN jabatan USING(id_jabatan) INNER JOIN marital_status ON marital_status.id_marital = karyawan.marital_status WHERE id_karyawan='$id'");
        $sql->execute();
        $getData = $sql->fetch(PDO::FETCH_ASSOC);
    }
?>

<div style="padding-left:100px; padding-right:100px;">
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="row">
                <img src="../assets/uploadImage/<?=$getData['foto']?>" class="rounded float-left col-lg-5">
                <div class="col-lg-7">
                    <div class="p-5">
                        <h1 class="text-gray-900"><?=$getData['nama']?></h1>
                        <h4 class="text-gray-700"><?=$getData['nama_dept']?>, <?=$getData['nama_jbt']?></h4>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-id-card fa-lg"></i>
                            </span>
                            <span class="text" style="color: #152aca"><?=$getData['id_karyawan']?>
                                <span class="badge badge-pill badge-info ml-2"><?=$getData['status_karyawan']?></span>
                            </span>
                        </a> <br>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-calendar-check fa-lg"></i>
                            </span>
                            <span class="text" style="color: #152aca"><?=date('D, F Y', strtotime($getData['tanggal_masuk']) ) ?> </span>
                        </a> <br>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-birthday-cake fa-lg"></i>
                            </span>
                            <span class="text" style="color: #152aca"><?=$getData['tempat_lahir'].', '.date('d F Y', strtotime($getData['tanggal_lahir']) ) ?> </span>
                        </a> <br>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-venus-mars fa-lg"></i>
                            </span>
                            <span class="text text-capitalize" style="color: #152aca"><?=$getData['jenis_kelamin']?> </span>
                        </a> <br>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-heart fa-lg"></i>
                            </span>
                            <span class="text text-capitalize" style="color: #152aca"><?=$getData['nama_marital']?> </span>
                        </a> <br>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-envelope fa-lg"></i>
                            </span>
                            <span class="text text-capitalize" style="color: #152aca"><?=$getData['email']?> </span>
                        </a> <br>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-phone fa-lg"></i>
                            </span>
                            <span class="text text-capitalize" style="color: #152aca"><?=$getData['no_telepon']?> </span>
                        </a> <br>
                        <a href="#" class="btn btn-icon-split">
                            <span class="icon text-gray-600" style="background: transparent;">
                                <i class="fas fa-map-marker-alt fa-lg"></i>
                            </span>
                            <span class="text text-capitalize" style="color: #152aca"><?=$getData['alamat']?> </span>
                        </a> <br>
                        <hr>
                        <a href="?page=formKaryawan&id=<?=date("mYd").$getData['id_karyawan']?>" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Edit</span>
                        </a>
                        <a href="?page=karyawan" class="btn btn-info btn-icon-split float-right">
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
</div>