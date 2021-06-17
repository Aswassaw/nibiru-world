<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Error</title>

	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/fontawesome/css/all.css">

	<style>
		body {
			background-color: rgb(26, 26, 26);
		}
	</style>
</head>

<body>
	<div class="container mt-5 mb-5">
		<div style="color:white" class="card bg-dark">
			<div class="card-body">
				<center>
					<h1 title="Tidak Ada Status" class="fas">Terjadi Kesalahan Pada Sistem Kami, Cobalah Lagi Nanti</h1>
					<hr>
					<center>
						<img src="<?= base_url('assets/img/gif/error.gif') ?>" width="250px">
					</center>
					<hr>
				</center>
			</div>
			<center>
				<?php if (session()->get('isLoggedIn')) { ?>
					<div class="row">
						<div class="col-sm">
							<h5 class="fas">Kembali ke halaman Home</h5>
							<br>
							<a href="<?= base_url('home') ?>" class="btn btn-outline-success fas fa-home">
								Home
							</a>
							<br><br>
						</div>
						<div class="col-sm">
							<h5 class="fas">Kembali ke halaman Profile</h5>
							<br>
							<a href="<?= base_url('profile') ?>" class="btn btn-outline-primary fas fa-user">
								Profile
							</a>
							<br><br>
						</div>
						<div class="col-sm">
							<h5 class="fas">Keluar dari situs sekarang</h5>
							<br>
							<a href="<?= base_url('logout') ?>" class="btn btn-outline-danger fas fa-sign-out-alt">
								Logout
							</a>
							<br><br>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="col-sm">
							<h5 class="fas">Login sekarang</h5>
							<br>
							<a href="<?= base_url('/') ?>" class="btn btn-outline-success fas fa-sign-in-alt">
								Login
							</a>
							<br><br>
						</div>
						<div class="col-sm">
							<h5 class="fas">Register sekarang</h5>
							<br>
							<a href="<?= base_url('register') ?>" class="btn btn-outline-danger fas fa-user-plus">
								Register
							</a>
							<br><br>
						</div>
					</div>
				<?php } ?>
			</center>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="/assets/bootstrap/js/bootstrap.js"></script>
	<script src="/assets/bootstrap/js/script.js"></script>

</body>

</html>