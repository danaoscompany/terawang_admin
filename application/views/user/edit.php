<?php
?>
<!doctype html>
<html class="no-js h-100" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Ubah Pengguna</title>
	<meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="http://terawang.co/admin/assets/css/all.css" rel="stylesheet">
	<link href="http://terawang.co/admin/assets/css/icon.css" rel="stylesheet">
	<link rel="stylesheet" href="http://terawang.co/admin/assets/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="http://terawang.co/admin/assets/css/shards-dashboards.1.1.0.min.css">
	<link rel="stylesheet" href="http://terawang.co/admin/assets/css/extras.1.1.0.min.css">
	<script async defer src="http://terawang.co/admin/assets/js/buttons.js"></script>
	<link rel="stylesheet" href="http://terawang.co/admin/assets/css/quill.snow.css"> </head>
</head>
<body class="h-100">
<div class="container-fluid">
	<div class="row">
		<!-- Main Sidebar -->
		<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
			<div class="main-navbar">
				<nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
					<a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
						<div class="d-table m-auto">
							<img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="http://terawang.co/admin/assets/images/shards-dashboards-logo.svg" alt="Shards Dashboard">
							<span class="d-none d-md-inline ml-1">Terawang</span>
						</div>
					</a>
					<a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
						<i class="material-icons">&#xE5C4;</i>
					</a>
				</nav>
			</div>
			<form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
				<div class="input-group input-group-seamless ml-3">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<i class="fas fa-search"></i>
						</div>
					</div>
					<input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
			</form>
			<?php $this->load->view('sidebar', array('current_menu' => 'user')); ?>
		</aside>
		<!-- End Main Sidebar -->
		<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
			<div class="main-navbar sticky-top bg-white">
				<!-- Main Navbar -->
				<?php $this->load->view('top-bar'); ?>
			</div>
			<!-- / .main-navbar -->
			<div class="main-content-container container-fluid px-4">
				<!-- Page Header -->
				<div class="page-header row no-gutters py-4">
					<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
						<span class="text-uppercase page-subtitle">Ubah Pengguna</span>
						<h3 class="page-title">Ubah Pengguna</h3>

					</div>
				</div>
				<!-- End Page Header -->
				<div class="row">
					<div class="col-lg-9 col-md-12">
						<!-- Add New Post Form -->
						<div class="card card-small mb-3">
							<div class="card-body">
								<form class="add-new-post">
									<div class="form-row">
										<div class="m-0">Foto profil:</div>
										<div class="card-header border-bottom text-center"
											 style="width: 100%;">
											<div class="mb-3 mx-auto">
												<img id="profile-picture" class="rounded-circle" src="http://terawang.co/admin/assets/images/profile_picture_placeholder.png" alt="User Avatar" width="110"> </div>
											<button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2"
													onclick="changeProfilePicture()">
												<i class="material-icons mr-1">person_add</i>Ubah</button>
										</div>
										<div class="m-0">Nama lengkap:</div>
										<div class="input-group mb-3" style="margin-top: 4px;">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">person</i>
                              						</span>
                            					</span>
												<input type="text" class="form-control" id="name"
													   placeholder="Nama"></div>
										</div>
										<div class="m-0">Email:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">mail</i>
                              						</span>
                            					</span>
												<input type="email" class="form-control" id="email"
													   placeholder="Email"></div>
										</div>
										<div class="m-0">Nomor HP:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">stay_current_portrait</i>
                              						</span>
                            					</span>
												<input type="text" class="form-control" id="phone"
													   placeholder="Email"></div>
										</div>
										<div class="m-0">Kata sandi:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">lock</i>
                              						</span>
                            					</span>
												<input type="password" class="form-control" id="password"
													   placeholder="Kata Sandi"></div>
										</div>
										<div class="m-0">Tempat lahir:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">cake</i>
                              						</span>
                            					</span>
												<input type="text" class="form-control" id="birth_place"
													   placeholder="Tempat Lahir"></div>
										</div>
										<div class="m-0">Tanggal lahir:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">calendar_today</i>
                              						</span>
                            					</span>
												<input type="date" class="form-control" id="birthday"
													   placeholder="Tenggal Lahir"></div>
										</div>
										<div class="m-0">Jenis kelamin:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">person</i>
                              						</span>
                            					</span>
												<select id="gender" class="form-control">
													<option selected>Pilih jenis kelamin...</option>
													<option>Laki-laki</option>
													<option>Perempuan</option>
												</select>
											</div>
										</div>
										<div class="m-0">Pekerjaan:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">work</i>
                              						</span>
                            					</span>
												<select id="job" class="form-control">
													<option selected>Pilih pekerjaan...</option>
													<option>Ibu Rumah Tangga</option>
													<option>Tidak Bekerja</option>
													<option>Sedang Mencari Pekerjaan</option>
													<option>Pelajar</option>
													<option>Akademisi</option>
													<option>Wiraswasta</option>
													<option>Sektor Publik</option>
													<option>Swasta</option>
													<option>Pensiun</option>
												</select>
											</div>
										</div>
										<div class="m-0">Status hubungan:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">work</i>
                              						</span>
                            					</span>
												<select id="relationship-status" class="form-control">
													<option selected>Pilih status hubungan...</option>
													<option>Single</option>
													<option>Platonis</option>
													<option>Rumit</option>
													<option>Menggoda</option>
													<option>Dalam Sebuah Hubungan</option>
													<option>Baru Saja Putus</option>
													<option>Bertunangan</option>
													<option>Sudah Menikah</option>
													<option>Janda</option>
													<option>Bercerai</option>
													<option>Hidup Terpisah</option>
												</select>
											</div>
										</div>
										<div class="m-0">Status verifikasi email:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">mark_email_read</i>
                              						</span>
                            					</span>
												<select id="email-verified" class="form-control">
													<option selected>Pilih status verifikasi email...</option>
													<option>Belum diverifikasi</option>
													<option>Sudah diverifikasi</option>
												</select>
											</div>
										</div>
										<div class="m-0">Status verifikasi nomor HP:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">smartphone</i>
                              						</span>
                            					</span>
												<select id="phone-verified" class="form-control">
													<option selected>Pilih status verifikasi nomor HP...</option>
													<option>Belum diverifikasi</option>
													<option>Sudah diverifikasi</option>
												</select>
											</div>
										</div>
										<div class="m-0">Status kelengkapan profil:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">person</i>
                              						</span>
                            					</span>
												<select id="profile-completed" class="form-control">
													<option selected>Pilih status kelengkapan profil...</option>
													<option>Belum lengkap</option>
													<option>Sudah lengkap</option>
												</select>
											</div>
										</div>
										<div class="m-0">Jumlah kredit:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">monetization_on</i>
                              						</span>
                            					</span>
												<input type="number" class="form-control" id="credits"
													   placeholder="Jumlah kredit"></div>
										</div>
										<div class="m-0">Status premium:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">check_box</i>
                              						</span>
                            					</span>
												<select id="premium" class="form-control">
													<option selected>Pilih status premium...</option>
													<option>Bukan premium</option>
													<option>Premium</option>
												</select>
											</div>
										</div>
										<div class="m-0">Bulan premium:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">calendar_today</i>
                              						</span>
                            					</span>
												<input type="number" class="form-control" id="month-premium"
													   placeholder="Bulan premium"></div>
										</div>
										<div class="m-0">Tanggal terakhir premium:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">calendar_today</i>
                              						</span>
                            					</span>
												<input type="date" class="form-control" id="last-premium-date"
													   placeholder="Tenggal terakhir premium"></div>
										</div>
									</div>
								</form></div>
						</div>
						<!-- / Add New Post Form -->
					</div>
					<div class="col-lg-3 col-md-12">
						<!-- Post Overview -->
						<div class='card card-small mb-3'>
							<div class="card-header border-bottom">
								<h6 class="m-0">Actions</h6>
							</div>
							<div class='card-body p-0'>
								<ul class="list-group list-group-flush">
									<li class="list-group-item d-flex px-3">
										<button class="btn btn-sm btn-outline-accent" onclick="cancel()">
											<i class="material-icons">delete</i> Buang</button>
										<button class="btn btn-sm btn-accent ml-auto" onclick="save()">
											<i class="material-icons">file_copy</i> Simpan</button>
									</li>
								</ul>
							</div>
						</div>
						<!-- / Post Overview -->
						<!-- Post Overview -->
						<!-- / Post Overview -->
					</div>
				</div>
			</div>
	</div>
	</main>
</div>
</div>
<input id="select-profile-picture" type="file" style="width: 0; height: 0; visibility: hidden;">
<input id="edited-user-id" type="hidden" value="<?php echo $userID; ?>">
<script src="http://terawang.co/admin/assets/js/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="http://terawang.co/admin/assets/js/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="http://terawang.co/admin/assets/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="http://terawang.co/admin/assets/js/Chart.min.js"></script>
<script src="http://terawang.co/admin/assets/js/shards.min.js"></script>
<script src="http://terawang.co/admin/assets/js/jquery.sharrre.min.js"></script>
<script src="http://terawang.co/admin/assets/js/jquery.redirect.js"></script>
<script src="http://terawang.co/admin/assets/js/extras.1.1.0.min.js"></script>
<script src="http://terawang.co/admin/assets/js/shards-dashboards.1.1.0.min.js"></script>
<script src="http://terawang.co/admin/assets/js/app/app-blog-overview.1.1.0.js"></script>
<script src="http://terawang.co/admin/assets/js/quill.min.js"></script>
<script src="http://terawang.co/admin/js/global.js"></script>
<script src="http://terawang.co/admin/js/edit_user.js"></script>
<script src="http://terawang.co/admin/js/moment.js"></script>
</body>
</html>
