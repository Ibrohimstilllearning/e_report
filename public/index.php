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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
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
							<div class="col-lg-9 col-md-8 no-pd">
								<div class="main-ws-sec">
                                        
                                    <?php
                                    if (@$_SESSION['user']) {
										$kode = @$_SESSION["user"]["kode"];
										$data = $koneksi_db ->query("SELECT * FROM tb_user WHERE kode = '$kode' ");
										$tampil= $data -> fetch_array();
										//ini tidak sama dengan (!=="") berarti gak kosong ada isinya
										if ($tampil["pekerjaan"] != ""&& $tampil["no_hp"] != "") {
											
										
                                        ?>

                                      

									<div class="post-topbar">
										<div class="user-picy">
										<?php
												 if (@$_SESSION["user"]) {
													echo "<img src='foto/profil/" . $tampil['foto']."' width= '100' height= '50'/>";
												}
												?>
										</div>
										<div class="post-st">
											<ul>
												<li><a class="post-jb active" href="#" title="">Post a Job</a></li>
											</ul>
										</div><!--post-st end-->
                                      
									</div><!--post-topbar end-->
									
										<div class="alert alert-danger" role="alert">
										
									  </div>
									<?php
									} else {
									
									?>
										<div class="alert alert-danger" role="alert">
 											 <h1 class="alert-heading">
												Welcome to E-report
												<?php
												if (@$_SESSION["user"]) {
													echo $tampil["nama_user"]; 
													}
												?>
											 </h1>
											 <p>untuk memberikan laporan silahkan isi profil dahulu <a href="profil.php?=<?php echo $kode; ?>" class="alert-link">Profil</a></p>
											</div>
									<?php
								}

							
							}
								?>
									
									<div class="posts-section">
										
										<?php include "slider.php";?>
										<?php
														  include "time.php";
														  if (@$_SESSION['user']) {
															$id_user = @$_SESSION["user"]["id_user"];
														  }
														  $a = $koneksi_db->query("SELECT * FROM (tb_login LEFT JOIN tb_user ON tb_login.kode = tb_user.kode) LEFT JOIN tb_pengaduan ON tb_pengaduan.id_user = tb_user.id_user WHERE tb_login.kode='$kode' ORDER BY tgl_pengaduan DESC;");
													
														$num = $a->num_rows;
														if ($num > 0) {
															while ($tampil_report = $a->fetch_array()) { 
														?>
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<?php	if (@$_SESSION["user"]) {
														echo "<img src='foto/profil/" . $tampil['foto']."' width= '50' height= '50'/>";
													}?>
													<div class="usy-name">
														<h3><?php
														  if (@$_SESSION["user"]) {
															  echo $tampil["nama_user"]; }
															  ?></h3>
														<span>
															<img src="images/clock.png" alt="">
															<?php
															$date=$tampil_report['tgl_pengaduan'];
															echo TimeAgo($date, date("Y-m-d H:i:s"))

															//string to time?>
															
														</span>
													</div>
												</div>
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a href="edit.php?id=<?php echo $tampil_report['id_pengaduan'];?>" title="">Edit Post</a></li>
														<li><a href="delete.php?id=<?php echo $tampil_report['id_pengaduan']; ?>">Delete</a></li>
													</ul>
												</div>
											</div>
											<div class="job_descp">
												<h3><?php echo $tampil_report['judul_pengaduan'] ?></h3>
												<?php
												if ($tampil_report['gambar_pengaduan'] != "") {
													echo "<img class='mb-3 img-thumbnail col-lg-12' src='foto/".$tampil_report['gambar_pengaduan']."'/>";
												} else {
													echo "";
												}
												?>
												<p><?php echo $tampil_report['isi_pengaduan'] ?><a href="#" title="">view more</a></p>
												
											</div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a href="#"><i class="la la-heart"></i> Like</a>
														<img src="images/liked-img.png" alt="">
														<span>25</span>
													</li> 
													<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
												</ul>
												<a><i class="la la-eye"></i>Views 50</a>
											</div>
										</div>
										<!--post-bar end-->
										<?php	}
														}else {
															"";
														}	?>
										<div class="process-comm">
											<div class="spinner">
												<div class="bounce1"></div>
												<div class="bounce2"></div>
												<div class="bounce3"></div>
											</div>
										</div><!--process-comm end-->
									</div><!--posts-section end-->
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