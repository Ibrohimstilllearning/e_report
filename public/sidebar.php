<div class="col-lg-3 col-md-4 pd-left-none no-pd">
								<div class="main-left-sidebar no-margin">
									<div class="user-data full-width">
										<div class="user-profile">
											<div class="username-dt">
												
												<div class="usr-pic">
												<?php
												 if (@$_SESSION["user"]) {
                                                    if ($tampil['foto'] !="") {
                                                        echo "<img src='foto/profil/" . $tampil['foto']."' width= '100' height= '100'/>";
                                                    } else {
                                                        echo "<img src='foto/profil/profil.jpg' width= '100' height= '100'/>";
                                                    }
													
												}
												?>
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<!-- <h3>John Doe</h3> -->

                                                <?php
                                                    include "../config.php";

                                                        if (@$_SESSION["user"]){
                                                            $aktif = @$_SESSION["user"]["kode"]; 
                                                            $data = $koneksi_db->query("SELECT * FROM tb_user WHERE kode = '$aktif'");
                                                            $tampil = $data->fetch_array();
                                                        } else if (@$_SESSION["admin"]) {
                                                            $aktif = @$_SESSION["admin"]["kode"]; 
                                                            $data = $koneksi_db->query("SELECT * FROM tb_admin WHERE kode = '$aktif'");
                                                            $tampil = $data->fetch_array();
                                                        }
                                                        ?>
                                                        <h3><?php if (@$_SESSION["user"]) {
                                                            echo $tampil["nama_user"]; 
                                                            } else if (@$_SESSION["admin"]) {
                                                                echo $tampil["nama_admin"]; 
                                                            } else {
                                                                echo "Tidak ada";
                                                            } ?></h3>

                                                            <br>

                                                            <span><?php if (@$_SESSION["user"]) {
																echo $tampil['pekerjaan'];
                                                         } elseif (@$_SESSION['admin']) {
														 }?></span>

                                                  <?php
                                                    //  include "../config.php";
                                                    //      if (@$_SESSION["user"]){
                                                    //          $aktif = @$_SESSION["user"]["kode"]; 
                                                    //      }
                                                    //      $data = $koneksi_db->query("SELECT * FROM tb_user WHERE kode = '$aktif'");

                                                    //      $tampil = $data->fetch_array();
                                                  ?>

											</div>
										</div><!--user-profile end-->
										<ul class="user-fw-status">
                                            <?php
                                            $akun = @$_SESSION['user']['kode'];
                                            $variable = $koneksi_db->query("SELECT * FROM tb_user_follow WHERE kode = '$akun' ");
                                            $jumlah = $variable->num_rows;                                            ?>
											<li>
												<h4>Following</h4>
												<span><?php echo $jumlah; ?></span>
											</li>
                                            <?php
                                            $akun2 = @$_SESSION['user']['kode'];
                                            $variable2 = $koneksi_db->query("SELECT * FROM tb_user_follow WHERE following = '$akun2' ");
                                            $jumlah2 = $variable2->num_rows;                                            ?>
											<li>
												<h4>Followers</h4>
												<span><?php echo $jumlah2; ?></span>
											</li>
											<li>
												<a href="#" title="">View Profile</a>
											</li>
										</ul>
									</div><!--user-data end-->
								</div><!--main-left-sidebar end-->
							</div>