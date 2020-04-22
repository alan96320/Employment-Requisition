<?php
    include "../action/config.php";
    require '../vendor/autoload.php';
    session_start();

    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'e9afb284b65046a5d995',
        '542706c8b9d3024bccb3',
        '966829',
        $options
    );

    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status == 'add') {
            $idFormulir = $_POST['idFormulir'];
            $idPic = $_SESSION ["id"];
            $job = $_POST['job'];
            $position = $_POST['position'];
            $reques = $_POST['reques'];
            $replace = $_POST['replace'];
            $joinDate = date('Y-m-d', strtotime($_POST['joinDate']));
            $education = $_POST['education'];
            $major = $_POST['major'];
            $experience = $_POST['experience'];
            $typeDocument = $_POST['typeDocument'];
            $document = $_FILES["document"]["name"];
            $budget = $_POST['budget'];
            $created = date('Y-m-d');
            $idDept = $_SESSION ["department"];
            $terpakai = $_POST['terpakai'] + $reques;
            $ext = pathinfo($document, PATHINFO_EXTENSION); // get extencen file
            $allowed = array('pdf','word'); // extencen yg di erbolehkan
            $temp = explode(".", $document); // potong file dan sisakan extencennya saja
            $rename = round(microtime(true)) . '.' . end($temp); // lalu buat anam baru dan gabungkan dengan extencen tadi
            $path ="../assets/uploadFiles/".$rename;
            $error = array(
                'job' => [],
                'position' => [],
                'reques' => [],
                'replace' => [],
                'joinDate' => [],
                'education' => [],
                'major' => [],
                'experience' => [],
                'typeDocument' => [],
                'document' => []
            );
            $statusError = false;
            if ($job == '') {
                $error['job'] = ['Job Type Wajib Di isi'];
                $statusError = true;
            }
            if($position == ''){
                $error['position'] = ['Open Position Wajib Di isi'];
                $statusError = true;
            }
            if($reques == ''){
                $error['reques'] = ['Budget Wajib Di isi'];
                $statusError = true;
            }elseif ($reques > $budget) {
                $error['reques'] = ["Sisa budget adalah ".$budget." pastikan tidak melebihi budget"];
                $statusError = true;
            }
            $r = explode(',', $replace);
            if (count($r) > $reques) {
                $error['releace'] = ["Pastikan Jumlah Replace tidak melebihi jumlah request"];
                $statusError = true;
            }
            if($joinDate == ''){
                $error['joinDate'] = ['Join Date Wajib Di isi'];
                $statusError = true;
            }
            if($education == ''){
                $error['education'] = ['Education Wajib Di isi'];
                $statusError = true;
            }
            if($major == ''){
                $error['major'] = ['Major Wajib Diisi'];
                $statusError = true;
            }
            if($experience == '' && $education !== 'smk'){
                $error['experience'] = ['Experience Wajib Diisi, Jika education lebih dari SMK'];
                $statusError = true;
            }
            if($typeDocument == ''){
                $error['typeDocument'] = ['Type Document Wajib Diisi'];
                $statusError = true;
            }
            if($document == ''){
                $error['document'] = ['Document Wajib Diisi'];
                $statusError = true;
            }else{
                if(!in_array($ext, $allowed) ) { 
                    $error['document'] = ['Document not support, pastikan type document yang anda masukan Word or PDF'];
                    $statusError = true;
                }
            }
            if($statusError == true) {
                $_SESSION['alert'] = "error";
                $_SESSION['error'] = $error;
                echo "<script>window.history.back();</script>";
                
            }else{
                move_uploaded_file( $_FILES['document'] ['tmp_name'], $path);
                $query = "INSERT INTO formulir_er (idFormulir, idPic, job, position, reques, repleace, joinDate, typeDocument, document, education, major, experience, created) 
                            VALUES ('$idFormulir','$idPic','$job','$position','$reques','$replace','$joinDate','$typeDocument','$rename','$education','$major','$experience','$created')";
                $sth = $pdo_conn->prepare($query);
                $sth->execute();
                if ($sth->rowCount() > 0) {
                    $query = "INSERT INTO statusapproval(idFormulir, status) VALUES ('$idFormulir', 5)";
                    $query1 = "UPDATE budget SET terpakai = '$terpakai' WHERE idDepartment='$idDept' ";
                    $statusForm = $pdo_conn->prepare($query);
                    $budget = $pdo_conn->prepare($query1);
                    $statusForm->execute();
                    $budget->execute();
                    $_SESSION['alert'] = "suksesAdd";
                    $data['message'] = 'Ada pengajuan data baru, silahkan reload brouwser untuk get data.';
                    $data['status'] = 5;
                    $pusher->trigger('my-channel', 'my-event', $data);
                    header('location: ../pages/home.php?page=pengajuan');
                }else{
                    unlink($path);
                    $_SESSION['alert'] = "error";
                    $_SESSION['error'] = $sth->errorInfo();
                    echo "<script>window.history.back();</script>";
                }
            }
            
        }
    }
?>