<?php
    $stm = $pdo_conn->prepare("SELECT * FROM budget 
                               INNER JOIN departemen on departemen.id_dept = budget.idDepartment
                             ");
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
        <h6 class="m-0 font-weight-bold text-primary">Data Budget PT. CIBA VISION Batam</h6>
        <a href="?page=formBudget" class="btn btn-primary btn-icon-split btn-sm" id="delete">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Periode</th>
                        <th>Department</th>
                        <th>Budget</th>
                        <th>Terpakai</th>
                        <th>Balance</th>
                        <th style="width: 130px" >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($rows as $data) { ?>
                            <tr>
                                <td class="text-center"><?=$data['periode']?></td>
                                <td><?=$data['nama_dept']?></td>
                                <td class="text-center"><?=$data['budget']?></td>
                                <td class="text-center"><?=$data['terpakai']?></td>
                                <td class="text-center"><?=$data['budget']-$data['terpakai']?></td>
                                <td class="text-center">
                                    <a href="?page=formBudget&id=<?=date("mYd").$data['idBudget']?>" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-eye-dropper"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-circle btn-sm btnDelete" id="<?=$data['idBudget']?>" page="<?=$_GET['page']?>" >
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
