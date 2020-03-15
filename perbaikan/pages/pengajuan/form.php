<?php 
    $idMe = $_SESSION ["id"];
    $idDep = $_SESSION ["department"];
    $query = $pdo_conn->prepare("SELECT * FROM karyawan WHERE id_karyawan != '$idMe' ");
    $query->execute();
    $karyawan = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $query1 = $pdo_conn->prepare("SELECT * FROM budget WHERE idDepartment = '$idDep' ");
    $query1->execute();
    $budget = $query1->fetch(PDO::FETCH_ASSOC);

    echo "<script>
            localStorage.setItem('url', 'formBudget');
        </script>";
    if(isset($_SESSION['alert'])){
        $message = $_SESSION['error'];
        // print_r($message);
        if ($_SESSION['alert'] == "error") {
            foreach ($message as $key => $value) {
                if (count($value) > 0) {
                    $data = implode(',', $value); ?>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                toastError('<?=$data?>');
                            });
                        </script>
                    <?php
                }
            };
        }
        unset($_SESSION['alert']);
        unset($_SESSION['error']);
    }
?>
<div style="padding-left:100px; padding-right:100px;" >
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="card-header row">
                <h1 class="h4 text-gray-900 text-capitalize col-sm-6">Formulir Employment Requisition (ER)</h1>
                <h1 class="h6 text-gray-700 text-capitalize col-sm-6 text-right">Form Number: <?=date('dYism')?></h1>
            </div>
            <div class="row" style="margin-top: -30px">
                <div class="col-lg-12">
                    <div class="p-5">
                        <form class="user" enctype="multipart/form-data" action="../action/actionPengajuan.php?status=add" method="post">
                            <input type="hidden" value="<?=date('dYism')?>" name="idFormulir" >
                            <input type="hidden" value="<?=$budget['budget']-$budget['terpakai']?>" name="budget" >
                            <input type="hidden" value="<?=$budget['terpakai']?>" name="terpakai" >
                            
                            <div class="form-group row">
                                <div class="col-sm-6" tooltip="tooltip" title="Job Type">
                                    <select name="job" class="form-control form-control-user" >
                                        <option value="">Select One Job Type</option>
                                        <option value="permanen">Permanen</option>
                                        <option value="kontrak">Kontrak</option>
                                    </select>
                                </div>
                                <div class="col-sm-6" tooltip="tooltip" title="Open Position">
                                    <select name="position" class="form-control form-control-user" >
                                        <option value="">Select One Open Position</option>
                                        <option value="operator">Operator</option>
                                        <option value="staff">Staff</option>
                                        <option value="manager">Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6" tooltip="tooltip" title="Jumlah orang yang di ganti">
                                    <input type="number" class="form-control form-control-user" placeholder="No. of Request" name="reques" >
                                </div>
                                <div class="col-sm-6" tooltip="tooltip" title="Nama orang yang di ganti">
                                    <select id="multiple" multiple>
                                        <?php foreach ($karyawan as $data) { ?>
                                            <option value="<?=$data['id_karyawan'] ?>"><?=$data['nama'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" id="convert" name="replace" >
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0" tooltip="tooltip" title="Join Date">
                                    <input type="text" class="form-control form-control-user" placeholder="Join Date" name="joinDate" datepicker="datepicker" >
                                </div>
                                <div class="col-sm-6" tooltip="tooltip" title="Education Requirement">
                                    <select class="form-control form-control-user" name='education' >
                                        <option value="">Persyaratan Pendidikan</option>
                                        <option value="smk">SMK</option>
                                        <option value="d3/d4">D3/D4</option>
                                        <option value="sarjana">Sarjana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0" tooltip="tooltip" title="Major Function">
                                    <textarea class="form-control form-control-user" placeholder="Decription Job"  rows="1" name="major" ></textarea>
                                </div>
                                <div class="col-sm-6" tooltip="tooltip" title="Experience & Background Requirement">
                                    <input type="text" class="form-control form-control-user" placeholder="Min 1 Year For D3 to Hight" name="experience"  >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0" tooltip="tooltip" title="Supporting Document">
                                    <select class="form-control form-control-user" name='typeDocument' >
                                        <option value="">Dokumen Pendukung</option>
                                        <option value="Role Profile">Role Profile</option>
                                        <option value="Organization Chart">Organization Chart</option>
                                    </select>
                                </div>
                                <div class="col-sm-6" tooltip="tooltip" title="Upload File Supporting Document">
                                    <input type="file" class="form-control form-control-user" tooltip="tooltip" title="Foto" name="document" >
                                </div>
                            </div>
                            
                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Request</button>
                                </div>
                                <div class="col-sm-6">
                                    <a href="?page=pengajuan" class="btn btn-google btn-user btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

