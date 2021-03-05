<?php
?>
<!doctype html>
<html class="no-js h-100" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Ubah Rekening Donasi</title>
	<meta name="description"
		  content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="http://terawang.co/admin/assets/css/all.css" rel="stylesheet">
	<link href="http://terawang.co/admin/assets/css/icon.css" rel="stylesheet">
	<link rel="stylesheet" href="http://terawang.co/admin/assets/css/bootstrap.min.css"
		  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" id="main-stylesheet" data-version="1.1.0"
		  href="http://terawang.co/admin/assets/css/shards-dashboards.1.1.0.min.css">
	<link rel="stylesheet" href="http://terawang.co/admin/assets/css/extras.1.1.0.min.css">
	<script async defer src="http://terawang.co/admin/assets/js/buttons.js"></script>
	<link rel="stylesheet" href="http://terawang.co/admin/assets/css/quill.snow.css">
</head>
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
							<img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
								 src="http://terawang.co/admin/assets/images/shards-dashboards-logo.svg"
								 alt="Shards Dashboard">
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
					<input class="navbar-search form-control" type="text" placeholder="Search for something..."
						   aria-label="Search"></div>
			</form>
			<?php $this->load->view('sidebar', array('current_menu' => 'donation')); ?>
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
						<span class="text-uppercase page-subtitle">Ubah Rekening Donasi</span>
						<h3 class="page-title">Ubah Rekening Donasi</h3>

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
										<div class="m-0">Atas Nama:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">person</i>
													</span>
												</span>
												<input type="text" class="form-control" id="name"
													   placeholder="Atas Nama">
											</div>
										</div>
										<div class="m-0">Bank:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<select id="bank" class="form-control">
													<option selected>Pilih bank...</option>
													<option value="bri">BRI</option>
													<option value="mandiri">MANDIRI</option>
													<option value="bca">BCA</option>
													<option value="bni">BNI</option>
													<option value="btn">BTN</option>
													<option value="cimb_niaga">CIMB NIAGA</option>
													<option value="panin">PANIN</option>
													<option value="ocbc_nisp">OCBC NISP</option>
												</select>
											</div>
										</div>
										<div class="m-0">Nomor Rekening:</div>
										<div class="input-group mb-3">
											<div class="input-group input-group-seamless">
												<span class="input-group-prepend">
                              						<span class="input-group-text">
                                						<i class="material-icons">account_balance</i>
                              						</span>
                            					</span>
												<input type="text" class="form-control" id="account-number"
													   placeholder="Nomor Rekening">
											</div>
										</div>
									</div>
								</form>
							</div>
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
											<i class="material-icons">delete</i> Buang
										</button>
										<button class="btn btn-sm btn-accent ml-auto" onclick="save()">
											<i class="material-icons">file_copy</i> Simpan
										</button>
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
<input id="donation-id" style="width: 0; height: 0; visibility: hidden;" value="<?php echo $donationID; ?>">
<script src="http://terawang.co/admin/assets/js/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="http://terawang.co/admin/assets/js/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>
<script src="http://terawang.co/admin/assets/js/bootstrap.min.js"
		integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
		crossorigin="anonymous"></script>
<script src="http://terawang.co/admin/assets/js/Chart.min.js"></script>
<script src="http://terawang.co/admin/assets/js/shards.min.js"></script>
<script src="http://terawang.co/admin/assets/js/jquery.sharrre.min.js"></script>
<script src="http://terawang.co/admin/assets/js/jquery.redirect.js"></script>
<script src="http://terawang.co/admin/assets/js/extras.1.1.0.min.js"></script>
<script src="http://terawang.co/admin/assets/js/shards-dashboards.1.1.0.min.js"></script>
<script src="http://terawang.co/admin/assets/js/app/app-blog-overview.1.1.0.js"></script>
<script src="http://terawang.co/admin/assets/js/quill.min.js"></script>
<script src="http://terawang.co/admin/js/global.js"></script>
<script src="http://terawang.co/admin/js/edit_donation.js"></script>
<script src="http://terawang.co/admin/js/moment.js"></script>
</body>
</html>
