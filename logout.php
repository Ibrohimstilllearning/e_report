<?php

include 'config.php';
@session_start();

if (@$_SESSION['admin']){
    $aktif = $_SESSION['admin']["id_login"];
    $koneksi_db->query("UPDATE tb_login SET status = 'offline' WHERE id_login = '$aktif'");
    session_destroy();
    echo "<script>location='login.php';</script>";

}else if (@$_SESSION['user']){
    $aktif = $_SESSION['user']["id_login"];
    $koneksi_db->query("UPDATE tb_login SET status = 'offline' WHERE id_login = '$aktif'");
    session_destroy();
    echo "<script>location='login.php';</script>";
}