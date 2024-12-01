<?php
@session_start();
if (@$_SESSION['admin'] || @$_SESSION['user']){

?>
<!DOCTYPE html>
<html lang="en">

<?php 
		include "head.php";?>
<body>
    <div class="wrapper">
		<?php 
		include "header.php";?> <!--meskipun terpisah file nya, index nya tetap satu-->
		
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<?php include "sidebar.php"?>
							<div class="col-lg-9 col-md-4 pd-left-none no-pd">
								<div class="main-ws-sec">
                                <div class="posts-section">
										<div class="post-bar">
											
											<div class="job_descp">
                                                <?php
                                                    $id = @$_GET['id'];
                                                    $update = $koneksi_db->query("SELECT * FROM tb_pengaduan WHERE id_pengaduan = '$id'");
                                                    $hasil = $update->fetch_array();
                                                ?>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <h3>Update post</h3>

                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="judul_post" value="<?php echo $hasil["judul_pengaduan"];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control"  name="isi_post"> <?php echo $hasil["isi_pengaduan"];?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                        if ($hasil['gambar_pengaduan'] !="") {
                                                            echo "<img class='mb-3 img-thumbnail col-lg-12' src='foto/".$hasil['gambar_pengaduan']."'/>";
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?>
                                                        <input type="file"  name="foto" placeholder="Foto">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary"  name="tombol" value="Update Post">
                                                        <input type="submit" class="btn btn-primary-outline" value="Back">
                                                    </div>
                                                </form>
                                                <?php
                                                  $judul_post = @$_POST["judul_post"];
                                                  $isi_post = @$_POST["isi_post"];

                                                  $Foto = @$_FILES['foto']['name'];
                                                  $asalFoto = @$_FILES['foto']['tmp_name'];
                                                  $directory = "foto/";
                                                
                                                  $tombol = @$_POST["tombol"];

                                                  if ($tombol) {
                                                    if ($hasil['gambar_pengaduan'] !="") {
                                                        move_uploaded_file($asalFoto,$directory.$Foto);
                                                        $update = $koneksi_db->query("UPDATE tb_pengaduan SET judul_pengaduan='$judul_post', isi_pengaduan='$isi_post', gambar_pengaduan='$Foto' WHERE id_pengaduan='$id'");
                                                        if ($update) {
                                                            unlink("foto/" . $hasil['gambar_pengaduan']);
                                                            echo "<script>alert('update post berhasil'); location='index.php';</script>";

                                                        }else {
                                                            echo "<script>alert('update gagal');</script>";
                                                        }
                                                      } else {
                                                        move_uploaded_file($asalFoto,$directory.$Foto);
                                                        $update = $koneksi_db->query("UPDATE tb_pengaduan SET judul_pengaduan='$judul_post', isi_pengaduan='$isi_post', gambar_pengaduan='$Foto' WHERE id_pengaduan='$id'");
                                                        if ($update) {
                                                            echo "<script>alert('update post berhasil'); location='index.php';</script>";

                                                        }else {
                                                            echo "<script>alert('update gagal');</script>";
                                                        }
                                                      }
                                                    }
                                                  
                                                ?>
											</div>
										</div><!--post-bar end-->
										</div><!--process-comm end-->
									</div><!--posts-section end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>

<?php
}else{
    echo "<script>location='../login.php'</script>";    
}
?>
</html>