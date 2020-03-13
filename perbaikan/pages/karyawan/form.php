<?php 
    $stmDep = $pdo_conn->prepare("SELECT * FROM `departemen`");
    $stmDep->execute();
    $rowsDepartemen = $stmDep->fetchAll(PDO::FETCH_ASSOC);

    $stmMar = $pdo_conn->prepare("SELECT * FROM `marital_status`");
    $stmMar->execute();
    $rowsMarital = $stmMar->fetchAll(PDO::FETCH_ASSOC);

    $stmJab = $pdo_conn->prepare("SELECT * FROM `jabatan`");
    $stmJab->execute();
    $rowsJabatan = $stmJab->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET['id'])){
        $status = "update";
        $id = str_replace(date('mYd'),'',$_GET['id']);
        $sql = $pdo_conn->prepare("SELECT * FROM karyawan WHERE id_karyawan='$id'");
        $sql->execute();
        $getData = $sql->fetch(PDO::FETCH_ASSOC);
    }else{
        $status = "add";
    }
    if(isset($_SESSION['alert'])){
        $message = "";
        if ($_SESSION['alert'] == "gagalUpload") {
            $message = "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
        }elseif ($_SESSION['alert'] == "gagal") {
            $a = $_SESSION['error'];
            foreach ($a as $data) {
                $message = $message.'<br>'.$data;
            }
        }
        echo "<script>
                Toast.fire({
                    icon: 'error',
                    title: `".$message."`
                })
            </script>";
        unset($_SESSION['alert']);
        unset($_SESSION['error']);
    }
?>
<div style="padding-left:100px; padding-right:100px;" >
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="card-header">
                <h1 class="h4 text-gray-900">Form Tambah Karyawan</h1>
            </div>
            <div class="row" style="margin-top: -30px">
                <div class="col-lg-12">
                    <div class="p-5">
                        <form class="user" enctype="multipart/form-data" action="../action/actionKaryawan.php?status=<?=$status?>" method="post">
                        <input type="text" value="<?=isset($getData['username']) ? $getData['username'] : '' ?>" name="username" class="d-none">
                        <input type="text" value="<?=isset($getData['password']) ? $getData['password'] : '' ?>" name="password" class="d-none">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user form-control-sm" placeholder="Nama" tooltip="tooltip" title="Nama" name="nama" required
                                    value="<?=isset($getData['nama']) ? $getData['nama'] : '' ?>">
                                </div>
                                <div class="col-sm-6" tooltip="tooltip" title="<?=$status=='update' ? 'NIK Not Udate' : 'NIK' ?>">
                                    <input type="text" class="form-control form-control-user" placeholder="NIK" name="nik" required
                                    value="<?=isset($getData['id_karyawan']) ? $getData['id_karyawan'] : '' ?>" <?=$status=='update' ? 'readonly' : '' ?> >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" placeholder="Tanggal Lahir" datepicker="datepicker" tooltip="tooltip" title="Tanggal Lahir" name="ttl" required value="<?=isset($getData['tanggal_lahir']) ? date('d/m/Y', strtotime($getData['tanggal_lahir'])) : '' ?>">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" placeholder="Tanggal Masuk" datepicker="datepicker" tooltip="tooltip" title="Tanggal Masuk" name="ttm" required value="<?=isset($getData['tanggal_masuk']) ? date('d/m/Y', strtotime($getData['tanggal_masuk'])) : '' ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" placeholder="Tempat Lahir" tooltip="tooltip" title="Tempat Lahir" name="tl" required value="<?=isset($getData['tempat_lahir']) ? $getData['tempat_lahir'] : '' ?>">
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-user" name='departemen' required>
                                        <option value="">Pilih Departemen</option>
                                            <?php foreach ($rowsDepartemen as $rowDepartemen) { ?>
                                                <option value="<?=$rowDepartemen["id_dept"]?>" <?=isset($getData['id_dept']) ? $getData['id_dept'] == $rowDepartemen["id_dept"] ? 'selected'  : ''  : '' ?> >
                                                    <?=$rowDepartemen["nama_dept"].'-'.$rowDepartemen["cost_center"]?>
                                                </option>
                                            <?php
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select name="jk" class="form-control form-control-user" required>
                                        <option value="">Jenis Kelamin</option>
                                        <option value="laki-laki" <?=isset($getData['jenis_kelamin']) ? $getData['jenis_kelamin'] == 'laki-laki' ? 'selected'  : ''  : '' ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?=isset($getData['jenis_kelamin']) ? $getData['jenis_kelamin'] == 'Perempuan' ? 'selected'  : ''  : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-user" name='jabatan' required>
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($rowsJabatan as $rowJabatan) { ?>
                                            <option value="<?=$rowJabatan["id_jabatan"]?>" <?=isset($getData['id_jabatan']) ? $getData['id_jabatan'] == $rowJabatan["id_jabatan"] ? 'selected'  : ''  : '' ?> >
                                                <?=$rowJabatan["nama_jbt"]?>
                                            </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select class="form-control form-control-user" name='marital' required>
                                        <option value="">Pilih Marital Status</option>
                                        <?php foreach ($rowsMarital as $rowsMarital) { ?>
                                            <option value="<?=$rowsMarital["id_marital"]?>" <?=isset($getData['marital_status']) ? $getData['marital_status'] == $rowsMarital["id_marital"] ? 'selected'  : ''  : '' ?> >
                                                <?=$rowsMarital["nama_marital"]?>
                                            </option>
                                        <?php
                                            }
                                        ?>
                                </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="sk" class="form-control form-control-user" required>
                                        <option value="" selected="selected">Status Karyawan</option>
                                        <option value="permanen" <?=isset($getData['status_karyawan']) ? $getData['status_karyawan'] == 'permanen' ? 'selected'  : ''  : '' ?> >Permanen</option>
                                        <option value="kontrak" <?=isset($getData['status_karyawan']) ? $getData['status_karyawan'] == 'kontrak' ? 'selected'  : ''  : '' ?> >Kontrak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" class="form-control form-control-user" placeholder="name@gmail.com" tooltip="tooltip" title="Email" name="email"
                                    value="<?=isset($getData['email']) ? $getData['email'] : '' ?>">
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" placeholder="0812xxxxx" tooltip="tooltip" title="Nomor Telepon" name="nomor" 
                                    value="<?=isset($getData['no_telepon']) ? $getData['no_telepon'] : '' ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="file" class="form-control form-control-user" tooltip="tooltip" title="Foto" name="foto">
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0" tooltip="tooltip" title="<?=isset($_SESSION['hak_akses']) ? $_SESSION['hak_akses'] !== 'admin' ? 'Not Akses Edit Here...'  : 'NIK'  : '' ?>">
                                    <select name="hak" class="form-control form-control-user" <?=isset($_SESSION['hak_akses']) ? $_SESSION['hak_akses'] !== 'admin' ? 'readonly'  : ''  : '' ?> >
                                        <option value="" selected="selected">Hak Akses</option>
                                        <option value="karyawan" <?=isset($getData['hak_akses']) ? $getData['hak_akses'] == 'karyawan' ? 'selected'  : ''  : '' ?> >Karyawan</option>
                                        <option value="admin"<?=isset($getData['hak_akses']) ? $getData['hak_akses'] == 'admin' ? 'selected'  : ''  : '' ?> >Admin</option>
                                        <option value="pic" <?=isset($getData['hak_akses']) ? $getData['hak_akses'] == 'pic' ? 'selected'  : ''  : '' ?> >PIC</option>
                                        <option value="manager" <?=isset($getData['hak_akses']) ? $getData['hak_akses'] == 'manager' ? 'selected'  : ''  : '' ?> >Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <textarea class="form-control form-control-user" placeholder="Alamat" tooltip="tooltip" title="Alamat" rows="1" name="alamat"><?=isset($getData['alamat']) ? $getData['alamat'] : '' ?></textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <button type="submit" class="btn btn-primary btn-user btn-block"><?=$status=='update' ? 'Save' : 'Tambah Karyawan' ?></button>
                                </div>
                                <div class="col-sm-6">
                                    <a href="?page=karyawan" class="btn btn-google btn-user btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>