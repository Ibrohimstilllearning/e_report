<?php
include "../config.php";
$kode =$_GET['kode'];
$delete = $koneksi_db->query("DELETE FROM tb_user_follow WHERE following ='$kode'");

if ($delete) {
    echo "<script> location='index.php';</script>";
}
?>