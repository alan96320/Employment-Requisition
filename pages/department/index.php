<?php
    $stm = $pdo_conn->prepare("SELECT * FROM departemen ");
    $stm->execute();
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC); 
    if(isset($_SESSION['alert'])){
        $message = "";
        if ($_SESSION['alert'] === "suksesDelete") {
            $message = "Berhasil Mengahpus Data";
        }elseif ($_SESSION['alert'] === "suksesEdit") {
            $message = "Berhasil Merubah Data";
        }elseif ($_SESSION['alert'] === "suksesAdd") {
            $message = "Berhasil Menambahkan Data";
        }
        echo "<script>
                Toast.fire({
                    icon: 'success',
                    title: `".$message."`
                })
            </script>";
        unset($_SESSION['alert']);
    }
    
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data department PT. CIBA VISION Batam</h6>
        <a href="?page=formDepartment" class="btn btn-primary btn-icon-split btn-sm" id="delete">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th style="width: 50px">No.</th>
                        <th>Nama Departemen</th>
                        <th>Cost Center</th>
                        <th style="width: 130px" >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($rows as $no => $data) { ?>
                            <tr class="text-center">
                                <td><?=$no+1?></td>
                                <td><?=$data['nama_dept']?></td>
                                <td><?=$data['cost_center']?></td>
                                <td>
                                    <a href="?page=formDepartment&id=<?=date("mYd").$data['id_dept']?>" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-eye-dropper"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-circle btn-sm btnDelete" id="<?=$data['id_dept']?>" page="<?=$_GET['page']?>" >
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
