<div class="top-profiles">
											<div class="pf-hd">
												<h3>Top Profiles</h3>
												<i class="la la-ellipsis-v"></i>
											</div>
											<div class="profiles-slider">
												<?php
												$query = $koneksi_db->query("SELECT * FROM tb_user");
												while ($user = $query->fetch_array()) {
													if ($user['kode'] != @$_SESSION['user']['kode']) {
														
													
												
												?>
												<div class="user-profy">
													<?php
													if ($user['foto'] != "") {
														echo "<img src='foto/profil" . $user['foto']. "'width='57' height='57'/>";
													} else {
														echo "<img src='foto/profil/profil.jpg' width='57' height='57'/>";
													}
													?>
													<!-- <img src="http://via.placeholder.com/57x57" alt=""> -->
													<h3><?php echo $user['nama_user']; ?></h3>
													<span><?php
													if ( $user['pekerjaan'] != "") {
														echo $user['pekerjaan'];
													} else {
														echo "-";
													}
													 ?></span>
													<ul>
													
														<li><a href="#" title="" class="envlp"><img src="images/envelop.png" alt=""></a></li>
														<li><a href="#" title="" class="hire">hire</a></li>
													</ul>
													<ul>
													<?php
															$follower = @$_SESSION['user']['kode'];
															$following = $user['kode'];

															$follow_connect = $koneksi_db->query("SELECT * FROM tb_user_follow WHERE kode='$follower' AND following= '$following' ");
															$follow_count= $follow_connect->num_rows;
															?>
														<li>
															<form action="" method="post">
																<input type="hidden" name="id" value="<?php echo $following ?>">
																<?php
																if ($follow_count > 0) {
																	echo '<button><a href="unfollow.php?kode=' . $user['kode'] .'" class="followw bg-secondary">unfollow</a></button>';
																} else {
																	echo "<input type='submit' class='followw p-1 rounded text-light' style='cursor: pointer;' name='sub'value='Follow'>";
																}
																?>
															</form>
														</li>
													</ul>
													<a href="#" title="">View Profile</a>
												</div>
												<?php
												$tz = "Asia/Jakarta";
												$dt = new DateTime("now",new DateTimeZone($tz));
												$date = $dt->format("Y-m-d G:i:s");

												$id = $_POST['id'] ?? "";
												$sub = $_POST['sub'] ?? "";
												

												if ($sub) {
													$state = $koneksi_db->prepare("INSERT INTO tb_user_follow(kode, following, subscribed) VALUES (?,?,?)");
													$state->bind_param("sss", $follower, $id, $date);
													if ($state->execute()) {
														echo "<script> location='index.php'</script>";
														exit();
													}
												}
												?>
												<?php
												}
											}
												?>
											</div><!--profiles-slider end-->
										</div>