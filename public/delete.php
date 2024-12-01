<?php
include "../config.php";
$id = @$_GET['id'];
$data = $koneksi_db->query("DELETE FROM tb_pengaduan WHERE id_pengaduan = '$id'");
if ($data) {
    echo "<script>alert('Data berhasil di hapus'); location='index.php';</script>";
}
?>