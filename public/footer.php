<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post a job</h3>
				<div class="post-project-fields">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-12">
								<input type="hidden" name="user" value="<?php echo $tampil['id_user']; ?>">
							</div>
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
							</div>
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<input type="file" name="gambar">
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" name="post" value="post">Post</button></li>
									<li><a href="index.php" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
                    <?php
                    include "../config.php";
                    $user = @$_POST['user'];
                    $judUl = @$_POST['title'];
                    $deskripsi = @$_POST['description'];
					$tz = "Asia/Jakarta";
					$dt = new DateTime("now",new DateTimeZone($tz));
					$date = $dt->format("Y-m-d G:i:s");
                    $posting = @$_POST['post'];
                 // menit ditulis i karena sebelum nya sudah ada menit m //

                    $gambar = @$_FILES['gambar']['name'];
                    $asalGambar = @$_FILES['gambar']['tmp_name'];

                    $simpanGambar = "foto/";

                    if ($posting) {
                        move_uploaded_file($asalGambar, $simpanGambar . $gambar);
                       // $koneksi_db->query("INSERT INTO tb_pengaduan VALUES ('', '$user', '$judUl', '$deskripsi', '$gambar', '$date')");
					   $stmt = $koneksi_db -> prepare("INSERT INTO tb_pengaduan (id_user,judul_pengaduan,isi_pengaduan,gambar_pengaduan,tgl_pengaduan)
					   VALUES (?,?,?,?,?)");
					   $stmt -> bind_param("sssss", $user, $judUl, $deskripsi, $gambar, $date);

					   //eksekusi dan cek apakah berhasil
					   if ($stmt -> execute()) {
						echo "<script>alert('Data berhasil disimpan'); location='index.php'</script>";
					   } else {
						echo "Error saat menyimpan data:" . $stmt -> error;
					   }
					   //tutup statement
					   $stmt -> close();
                       
                    }
                    ?>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div>