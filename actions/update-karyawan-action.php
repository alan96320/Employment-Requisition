<?php
include "../config/conn.php";

// check if form was submitted
/*print_r($_POST);
exit;*/

if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE karyawan 
                  SET nama=:nama, jabatan=:jabatan, id_dept=:departemen, 
                      tanggal_masuk=:tanggal_masuk, marital_status=:marital_status
                  WHERE id_karyawan = :id";
 
        // prepare query for excecution
        $stmt = $pdo_conn->prepare($query);
 
        // echo var_dump($_POST);
        // die();

        // posted values
        $name           =htmlspecialchars(strip_tags($_POST['nama']));
        $jabatan        =htmlspecialchars(strip_tags($_POST['jabatan']));
        $nik            =htmlspecialchars(strip_tags($_POST['nik']));
        $departemen     =htmlspecialchars(strip_tags($_POST['departemen']));
        $marital_status =htmlspecialchars(strip_tags($_POST['status']));
        $tgl_masuk      =htmlspecialchars(strip_tags($_POST['tgl_masuk']));
 

        // bind the parameters
        $stmt->bindParam(':nama', $name);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':tanggal_masuk', $tgl_masuk);
        $stmt->bindParam(':departemen', $departemen);
        $stmt->bindParam(':marital_status', $marital_status);
        $stmt->bindParam(':id', $nik);

                 
        // Execute the query
        if($stmt->execute()){
            echo "<script> alert('Record was updated'); 
                    window.location = '../admin/list-karyawan.php'</script>";
        }else{
            echo "<script> alert('Unable to update record. Please try again.'); history.back()
                   </script>";
        }
        // echo $stmt->debugDumpParams();
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>