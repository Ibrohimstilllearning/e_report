<?php
@session_start();
if (@$_SESSION['admin'] || @$_SESSION['user']){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<body>
<div class="wrapper">
		<?php 
		include "header.php";?>
		
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<?php include "sidebar.php";?>
							<div class="col-lg-9 col-md-8 no-pd">
								<div class="main-ws-sec">
                                        
                                    <?php
                                    if (@$_SESSION['user']) {
										$kode = @$_SESSION["user"]["kode"];
										$data = $koneksi_db ->query("SELECT * FROM tb_user WHERE kode = '$kode' ");
										$tampil= $data -> fetch_array();
										//ini tidak sama dengan (!=="") berarti gak kosong ada isinya
										if ($tampil["pekerjaan"] != ""&& $tampil["no_hp"] != ""&& $tampil["foto"] !="") {
											
										
                                        ?>
                                    <div class="posts-section">
										<div class="post-bar">
											<div class="job_descp">
                                                <h3 class="mt-3">Profil pengguna</h3>
                                                <hr>
                                                <?php
                                                $data2 = $koneksi_db->query("SELECT * FROM(tb_login LEFT JOIN tb_user ON tb_login.kode = tb_user.kode) WHERE tb_login.kode = '$kode'");
                                                $tampil2 = $data2->fetch_array();
                                                ?>
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td>Kode</td>
                                                        <td>:</td>
                                                        <td><?php echo $tampil2['kode']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama User</td>
                                                        <td>:</td>
                                                        <td><?php echo $tampil2['nama_user']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Username</td>
                                                        <td>:</td>
                                                        <td><?php echo $tampil2['username']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>:</td>
                                                        <td><?php echo $tampil2['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pekerjaan</td>
                                                        <td>:</td>
                                                        <td><?php echo $tampil2['pekerjaan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No telp</td>
                                                        <td>:</td>
                                                        <td><?php echo $tampil2['no_hp']; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
									<?php
									} else {
									
									?> 
										
                                    <div class="posts-section">
										<div class="post-bar">
											
											<div class="job_descp">
												<h3>UPDATE PROFIL</h3>
                                                <?php
                                                    
                                                    $update = $koneksi_db->query("SELECT * FROM tb_user WHERE kode = '$kode'");
                                                    $hasil = $update->fetch_array();
                                                ?>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="kode" value="<?php echo $hasil["kode"];?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="nama_user" value="<?php echo $hasil["nama_user"];?>" placeholder="Nama">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="pekerjaan" value="<?php echo $hasil["pekerjaan"];?>" placeholder="Pekerjaan">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control"  name="email" value="<?php echo $hasil["email"];?>" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="no_hp" value="<?php echo $hasil["no_hp"];?>" placeholder="No. hp">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="file"  name="foto" value="<?php echo $hasil["foto"];?>" placeholder="Foto">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary"  name="tombol" value="Update Profile">
                                                        <input type="submit" class="btn btn-primary-outline" value="Back">
                                                    </div>
                                                </form>
                                                <?php
                                                  $nama_user = @$_POST["nama_user"];
                                                  $email = @$_POST["email"];
                                                  $pekerjaan = @$_POST["pekerjaan"];
                                                  $no_hp = @$_POST["no_hp"];

                                                  $Foto = @$_FILES['foto']['name'];
                                                  $asalFoto = @$_FILES['foto']['tmp_name'];
                                                  $directory = "foto/profil/";

                                                  $tombol = @$_POST["tombol"];

                                                  if ($tombol) {
                                                    if ($nama_user == "" || $pekerjaan == "" || $email == "" || $no_hp == "" || $Foto == "" ) {
                                                        echo "<script>alert('Lengkapi data');</script>";
                                                    } else {
                                                        move_uploaded_file($asalFoto, $directory . $Foto);
                                                        $update = $koneksi_db->query("UPDATE tb_user SET nama_user='$nama_user', pekerjaan='$pekerjaan', email='$email', no_hp='$no_hp', foto='$Foto' WHERE kode='$kode'");
                                                        if ($update) {
                                                            echo "<script>alert('update berhasil');</script>";
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
											
									<?php
								}

							
							}
								?>
									
									
								</div><!--main-ws-sec end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>
       <?php
	   include "footer.php";
	   ?><!--post-project-popup end-->

	</div><!--theme-layout end-->

    



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>


    
</body>
</html>

<?php
}else{
    echo "<script>location='../login.php'</script>";    
}
?>