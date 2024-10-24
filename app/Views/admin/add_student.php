<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Add Student</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/feathericon.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Include Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<!-- SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<style>
		a {
			text-decoration: none;
		}

		.form-control {
			cursor: pointer;
			transition: border-color 0.3s;
		}

		.form-check-input:checked+.form-control {
			border-color: #007bff;
			/* Bootstrap primary color */
			background-color: #e9f5ff;
			/* Light blue for the selected state */
		}

		.form-check-input:checked+.form-control .bi-circle {
			color: #007bff;
			/* Color for the checked state */
		}

		.bi-circle {
			color: #ccc;
			/* Default color for the radio icon */
		}

		.form-check-input:checked+.form-control .bi-circle::before {
			content: "\f192";
			/* Unicode for filled circle icon */
			font-family: "Bootstrap Icons";
		}
	</style>
</head>

<body>

	<div class="main-wrapper">
		<!-- HEADER START -->
		<?php include APPPATH . 'Views/admin/includes/header.php'; ?>
		<!-- HEADER END -->
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li> <a href="<?= base_url('admin/index') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
						<li class="list-divider"></li>
						<li class="submenu"> <a href="#"><i class="fa-solid fa-user-group"></i> <span> Students </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="<?= base_url('admin/students') ?>"> All Student </a></li>
								<li><a class="active" href="<?= base_url('admin/add_student') ?>"> Add Student </a></li>
							</ul>
						</li>
						<li> <a href="<?= base_url('/admin/membership_plans') ?>"><i class="fa-solid fa-rectangle-list"></i> <span> Membership Plans </span></a></li>
						<li class="list-divider"></li>
						<li> <a href="<?= base_url('/admin/payment_history') ?>"><i class="fa-solid fa-clock-rotate-left"></i> <span> Transaction History </span></a></li>
					</ul>
				</div>
			</div>
		</div>


		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<!-- ALERT MESSAGE -->
							<?php if (session()->getFlashdata('success')): ?>
								<script>
									document.addEventListener("DOMContentLoaded", function() {
										// Trigger the SweetAlert
										Swal.fire({
											icon: 'success',
											title: 'Success',
											text: '<?php echo session()->getFlashdata('success'); ?>',
											confirmButtonText: 'OK',
											confirmButtonColor: '#3085d6',
											timer: 3000
										});
									});
								</script>
							<?php endif; ?>
							<?php if (session()->getFlashdata('error')): ?>
								<script>
									document.addEventListener("DOMContentLoaded", function() {
										// Trigger the SweetAlert
										Swal.fire({
											icon: 'error',
											title: 'Error',
											text: '<?php echo session()->getFlashdata('error'); ?>',
											confirmButtonText: 'OK',
											confirmButtonColor: '#3085d6',
											timer: 3000 // Auto close after 3 seconds
										});
									});
								</script>
							<?php endif; ?>
							<h3 class="page-title mt-5">Add Student</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form action="<?= base_url('add_student_db') ?>" method="POST" class="row g-3 needs-validation" novalidate>
							<div class="row formtype">
								<div class="col-12 mb-3">
									<h5>Personal Information</h5>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="first_name" class="form-label">First name</label>
										<input type="text" class="form-control" name="first_name" id="first_name" required>
										<div class="invalid-feedback">
											Please enter your first name.
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="last_name">Last Name</label>
										<input class="form-control" type="text" name="last_name" id="last_name" required>
										<div class="invalid-feedback">
											Please enter your last name.
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="student_id">ID Number</label>
										<input class="form-control" type="number" name="student_id" id="student_id" required>
										<div class="invalid-feedback">
											Please enter your student id.
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="course">Course</label>
										<select class="form-select" name="course" id="course" required>
											<option>Bachelor of Science in Information Technology</option>
											<option>Bachelor of Science in Computer Science</option>
											<option>Bachelor of Science in Information System</option>
											<option>Bachelor of Science in Civil Engineering</option>
											<option>Bachelor of Science in Industrial Technology</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="section">Section</label>
										<select class="form-select" name="section" id="section" required>
											<option>A</option>
											<option>B</option>
											<option>C</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="year_level">Year Level</label>
										<select class="form-select" name="year_level" id="year_level" required>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="semester">Semester</label>
										<select class="form-select" name="semester" id="semester" required>
											<option>1</option>
											<option>2</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" id="email" required>
										<div class="invalid-feedback">
											Please provide a valid email address.
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="mobile_number">Phone Number</label>
										<input type="number" class="form-control" name="mobile_number" id="mobile_number" required>
										<div class="invalid-feedback">
											Please provide a valid mobile number.
										</div>
									</div>
								</div>
								<div class="col-12 mb-3 mt-3">
									<h5>Memberships</h5>
								</div>
								<div class="container">
									<div class="row">
										<?php foreach ($memberships as $row): ?>
											<div class="col-md-3">
												<div class="form-group position-relative">
													<!-- Hidden checkbox that will hold the actual values -->
													<input class="form-check-input position-absolute" type="checkbox" name="membership_name[]" value="<?= $row['id'] ?>" id="membership<?= $row['id'] ?>" style="display: none;">

													<!-- Div styled as a checkbox -->
													<div class="form-control d-flex align-items-center p-2 border rounded cursor-pointer" onclick="document.getElementById('membership<?= $row['id'] ?>').click();">
														<span class="me-2">
															<i class="bi bi-circle" id="icon-membership<?= $row['id'] ?>"></i>
														</span>
														<span><?= $row['membership_name'] . ' ' ?><span>&#8369;<?= $row['amount'] ?></span></span>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
									<div class="invalid-feedback">
										Please provide a valid mobile number.
									</div>
								</div>
								<div class="col-12 mb-3 mt-3">
									<h5>Payment</h5>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="total_amount" class="form-label">Total Amount</label>
										<input type="text" class="form-control" name="total_amount" id="total_amount" aria-label="Disabled input example" disabled readonly>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="amount_paid" class="form-label">Amount Paid</label>
										<input type="number" class="form-control" name="amount_paid" id="amount_paid" required>
										<div class="invalid-feedback">
											Please enter the amount paid.
										</div>
									</div>
								</div>
								<div class="col-12 text-end">
									<button type="submit" class="btn btn-primary btn-md float-right">Add Student</button>
									<a href="<?= base_url('admin/students') ?>" class="btn btn-secondary btn-md float-right mr-2">Cancel</a>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- SweetAlert2 CDN -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script data-cfasync="false" src="<?= base_url('../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/select2.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables/datatables.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/script.js') ?>"></script>
	<script>
		$(function() {
			$('#datetimepicker3').datetimepicker({
				format: 'LT'

			});
		});

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

	<script>
		function selectAllRadios() {
			const radios = document.querySelectorAll('input[type="radio"]');
			const selectAll = document.getElementById('selectAll');

			radios.forEach(radio => {
				if (selectAll.checked) {
					radio.checked = true;
				} else {
					radio.checked = false;
				}
			});
		}
	</script>

	<!-- handle the total amount membership selected  -->
	<script>
		$(document).ready(function() {
			// Function to update the total amount when a membership is selected or deselected
			$('.form-check-input').change(function() {
				var totalAmount = 0;

				// Loop through all selected checkboxes
				$('.form-check-input:checked').each(function() {
					// Get the amount from the membership label selected
					var amount = $(this).closest('.form-group').find('.form-control span:last').text().replace('₱', '').trim();
					totalAmount += parseFloat(amount);
				});

				// Update the total amount input field
				$('#total_amount').val('₱' + totalAmount.toFixed(2));
			});
		});
	</script>

	<!-- handle the payment -->
	<script>
		$(document).ready(function() {
			$('.form-check-input').change(function() {
				var totalAmount = 0;

				// Loop through all selected checkboxes
				$('.form-check-input:checked').each(function() {
					// Get the amount from the membership label selected
					var amount = $(this).closest('.form-group').find('.form-control span:last').text().replace('₱', '').trim();
					totalAmount += parseFloat(amount);
				});

				// Update the total amount input field
				$('#total_amount').val('₱' + totalAmount.toFixed(2));
			});

			// Handle form submission
			$('form').on('submit', function(event) {
				// Get the total amount from the readonly input and parse it correctly
				var totalAmount = parseFloat($('#total_amount').val().replace('₱', '').trim());
				// Get the amount paid from the input field
				var amountPaid = parseFloat($('#amount_paid').val());

				// Check if any membership is selected
				var isMembershipSelected = $('.form-check-input:checked').length > 0;

				// If no membership is selected, show SweetAlert to select a membership
				if (!isMembershipSelected) {
					event.preventDefault(); // Prevent form submission
					Swal.fire({
						icon: 'warning',
						title: 'Selection Error',
						text: 'Please select at least one membership plan!',
						timer: 3000,
						timerProgressBar: true
					});
					return; // Exit function and prevent form submission
				}

				// Check if the amount paid is entered and is a valid number
				if (isNaN(amountPaid) || amountPaid <= 0) {
					event.preventDefault(); // Prevent form submission
					Swal.fire({
						icon: 'error',
						title: 'Amount Error',
						text: 'Please enter a valid amount paid!',
						timer: 3000,
						timerProgressBar: true
					});
					return; // Exit function and prevent form submission
				}

				// Check if the amount paid is less than total amount
				if (amountPaid < totalAmount) {
					// Prevent form submission
					event.preventDefault();
					// Show SweetAlert if amount is not enough
					Swal.fire({
						icon: 'error',
						title: 'Payment Error',
						text: 'The amount paid is not enough! Please enter a valid amount.',
						timer: 3000,
						timerProgressBar: true
					});
				} else {
					event.preventDefault();
					$('form')[0].submit();
				}
			});
		});
	</script>
</body>

</html>