<?php
    $id = $_SESSION ["id"];
    $stm = $pdo_conn->prepare("SELECT * FROM formulir_er 
                               JOIN statusapproval USING (idFormulir)
                               WHERE idPic = $id
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
        <h6 class="m-0 font-weight-bold text-primary">List Status Pengajuan ER</h6>
        <a href="?page=formPengajuan" class="btn btn-primary btn-icon-split btn-sm" id="delete">
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
                        <th>No. Form</th>
                        <th>Position</th>
                        <th>Job Type</th>
                        <th>Sum Request</th>
                        <th>Join Date</th>
                        <th>Education Requirement</th>
                        <th>Experience Requirement</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($rows as $data) { ?>
                            <tr class="text-center">
                                <td><?=$data['idFormulir']?></td>
                                <td><?=$data['position']?></td>
                                <td><?=$data['job']?></td>
                                <td><?=$data['reques']?> Orang</td>
                                <td><?=date('d F Y', strtotime($data['joinDate']) ) ?></td>
                                <td class="text-uppercase"><?=$data['education']?></td>
                                <td><?=$data['experience']?></td>
                                <td>
                                    <?php 
                                        $status = $data['status'];
                                        if ($status == 1) { ?>
                                            <span class="badge badge-info">
                                                <span class="fas fa-exclamation" role="status" aria-hidden="true"></span>
                                                Verify
                                            </span>
                                            <?php
                                        } elseif ($status == 2) { ?>
                                            <span class="badge badge-danger">
                                                <span class="fas fa-times" role="status" aria-hidden="true"></span>
                                                Reject Admin
                                            </span>
                                            <?php
                                        } elseif ($status == 3) { ?>
                                            <span class="badge badge-success">
                                                <span class="fas fa-check" role="status" aria-hidden="true"></span>
                                                Approve
                                            </span>
                                            <?php
                                        } elseif ($status == 4) { ?>
                                            <span class="badge badge-danger">
                                                <span class="fas fa-times" role="status" aria-hidden="true"></span>
                                                Reject Manager
                                            </span>
                                            <?php
                                        } elseif ($status == 5) { ?>
                                            <span class="badge badge-warning">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Pending
                                            </span>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="?page=details&id=<?=date("mYd").$data['idFormulir']?>" class="btn btn-info btn-circle btn-sm btnEdit">
                                        <i class="fas fa-eye"></i>
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
