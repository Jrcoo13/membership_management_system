<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>LSC Membership Fee Management System</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/feathericon.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap-datetimepicker.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- DataTables and Buttons CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
	<style>
		a {
			text-decoration: none;
		}

		.page-title {
			text-align: center;
			font-size: 24px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<div class="main-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12 mt-5">
							<!-- ALERT MESSAGE -->
							<div class="row">
								<div class="col-sm-12 text-center"> <!-- Change col-sm-6 to col-sm-12 -->
									<?php
									if (session()->getFlashdata('status')) { ?>
										<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
											<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
												<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
											</symbol>
										</svg>
										<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mx-auto" style="max-width: 500px;" role="alert">
											<!-- Icon -->
											<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
												<use xlink:href="#exclamation-triangle-fill" />
											</svg>
											<!-- Text -->
											<div><?php echo session()->getFlashdata('status'); ?></div>
											<!-- Close Button -->
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="loginbox">
					<div class="login-left bg-primary">
						<img class="img-fluid bg-light rounded-circle" src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap text-center">
							<img style="height: 100px; width: 100px;" class="mb-3" src="<?= base_url('assets/img/logo.png') ?>" alt="">
							<h5 class="mb-4">LCS Membership Fee Management System</h5>
							<h1 class="mb-4">Login</h1>
							<form action="<?= base_url('/login') ?>" method="POST" class="row needs-validation" novalidate>
								<div class="form-group">
									<input class="form-control" type="text" name="username" placeholder="Username" required>
									<div class="invalid-feedback">
										Please enter your email.
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="password" name="password" placeholder="Password" required>
									<div class="invalid-feedback">
										Please enter your password.
									</div>
								</div>
								<div class="form-group">
									<button class="btn btn-primary btn-md btn-block mt-2" type="submit">Log in</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<!-- DataTables and Buttons JS -->
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
	<script data-cfasync="false" src="<?= base_url('../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/raphael/raphael.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/morris/morris.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/chart.morris.js') ?>"></script>
	<script src="<?= base_url('assets/js/script.js') ?>"></script>

	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.prototype.slice.call(forms)
				.forEach(function(form) {
					form.addEventListener('submit', function(event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
						}

						form.classList.add('was-validated')
					}, false)
				})
		})()
	</script>
</body>

</html>