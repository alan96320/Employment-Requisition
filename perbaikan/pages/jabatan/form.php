<?php
$idnya = '';
if (isset($_GET['id'])) {
    $id = str_replace(date('mYd'), '', $_GET['id']);
    $status = "update";
    $sql = $pdo_conn->prepare("SELECT * FROM jabatan WHERE id_jabatan='$id'");
    $sql->execute();
    $getData = $sql->fetch(PDO::FETCH_ASSOC);
    $url = '../action/actionJabatan.php?status=' . $status . '&id=' . $_GET['id'];
} else {
    $status = "add";
    $url = '../action/actionJabatan.php?status=' . $status;
}
if (isset($_SESSION['alert'])) {
    $message = "";
    if ($_SESSION['alert'] == "gagal") {
        $a = $_SESSION['error'];
        foreach ($a as $data) {
            $message = $message . '<br>' . $data;
        }
    }
    echo "<script>
                Toast.fire({
                    icon: 'error',
                    title: `" . $message . "`
                })
            </script>";
    unset($_SESSION['alert']);
    unset($_SESSION['error']);
}
?>
<div style="padding-left:300px; padding-right:300px;">
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Form <?= $status ?> Jabatan</h6>
            </div>
            <div class="row" style="margin-top: -30px">
                <div class="col-lg-12">
                    <div class="p-5">
                        <form class="user" action="<?= $url ?>" method="post">
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-1 mb-3 mb-sm-0 text-right mt-3">
                                    <label for="namaDept">Nama Jabatan</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" placeholder="Insert Nama Jabatan" name="nama" id="namaDept" required value="<?= isset($getData['nama_jbt']) ? $getData['nama_jbt'] : '' ?>">
                                </div>
                            </div>
                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-3 offset-sm-3 mb-2 mb-sm-0 text-right">
                                    <button type="submit" class="btn btn-outline-primary"><?= $status == 'update' ? 'Save' : 'Tambah' ?></button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="?page=jabatan" class="btn btn-outline-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>