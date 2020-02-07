<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

// $sql= "UPDATE karyawan SET (`id_karyawan`, `nama`, `id_dept`, `jabatan`, `tanggal_masuk`, `marital_status`, `username`, `password`, `jenis_kelamin`, 
//                         `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_telepon`, `hak_akses`) 
//        SET (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

// $id = $_GET['id'];
$sql = "UPDATE karyawan SET nama=? WHERE id=?";
if (!$sql) {
  die("Connection failed: " . mysqli_connect_error());
} else
  echo "Connection Sucess";

// if (mysqli_query($conn, $sql)) {
//   echo "Record updated successfully";
// } else {
//   echo "Error updating record: " . mysqli_error($conn);
// }
// $stm = $pdo_conn->prepare($sql); //prepare statement
// $stm->execute([$nama, $username, $id]);
// $stm->execute();
// echo $stm->rowCount() . "data berhasil di update";

// header('location: ../admin/list-karyawan.php?id=' . $id);
// mysqli_close($conn);
// print_r($rows);
mysqli_close("");
?>