<?php
    $stm = $pdo_conn->prepare("SELECT * FROM karyawan 
                               JOIN departemen USING (id_dept)
                               JOIN jabatan USING(id_jabatan)
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
        <h6 class="m-0 font-weight-bold text-primary">Data Karyawan PT. CIBA VISION Batam</h6>
        <a href="?page=formKaryawan" class="btn btn-primary btn-icon-split btn-sm" id="delete">
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
                        <th>ID#</th>
                        <th>Nama</th>
                        <th>Department</th>
                        <th>Jabatan</th>
                        <th>Hak Akses</th>
                        <th style="width: 130px" >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($rows as $data) { ?>
                            <tr>
                                <td class="text-center"><?=$data['id_karyawan']?></td>
                                <td><?=$data['nama']?></td>
                                <td><?=$data['nama_dept']?></td>
                                <td><?=$data['nama_jbt']?></td>
                                <td><?=$data['hak_akses']?></td>
                                <td class="text-center">
                                    <a href="?page=profileKaryawan&id=<?=date("mYd").$data['id_karyawan']?>" class="btn btn-info btn-circle btn-sm btnEdit">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="?page=formKaryawan&id=<?=date("mYd").$data['id_karyawan']?>" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-eye-dropper"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-circle btn-sm btnDelete" id="<?=$data['id_karyawan']?>" >
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
