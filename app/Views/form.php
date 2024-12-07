<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>LSC Online Registration Form</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/feathericon.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/form.css') ?>">
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
			background-color: #6c757d;
			color: #fff;
			/* Light blue for the selected state */
		}

		.form-check-input:checked+.form-control .bi-circle {
			color: #007bff;
		}
	</style>
</head>

<body>
	<section class="booking">
		<div class="container">
			<form action="<?= base_url('/submit') ?>" method="POST" class="row g-3 needs-validation book-form" id="membership-form" novalidate>
				<div class="row">
					<!-- <div class="row formtype"> -->
					<div class="col">
						<h3 style="text-align: center;" class="title">LSC Online Membership Registration Form</h3>
						<div class="col-md-12">
							<div class="form-group">
								<label for="fullname" class="form-label">Full Name</label>
								<input type="text" class="form-control" name="fullname" id="fullname" required>
								<div class="invalid-feedback">
									Please enter your first name.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" id="email" required>
								<div class="invalid-feedback">
									Please provide a valid email address.
								</div>
							</div>
						</div>
						<div class="col-md-12">
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
						<div class="col-md-12">
							<div class="form-group">
								<label for="student_id">ID Number</label>
								<input type="text" class="form-control" name="student_id" id="student_id" maxlength="7" pattern="\d{7}" required
									oninput="this.value = this.value.replace(/[^0-9]/g, '')">
								<div class="invalid-feedback">
									Please enter your student ID.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="mobile_number">Phone Number</label>
								<input type="text" class="form-control" name="mobile_number" id="mobile_number" maxlength="11" pattern="\d{11}" required
									oninput="this.value = this.value.replace(/[^0-9]/g, '')">
								<div class="invalid-feedback">
									Please provide a valid mobile number.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="section">Section</label>
								<select class="form-select" name="section" id="section" required>
									<option>A</option>
									<option>B</option>
									<option>C</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
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
						<div class="col-md-12">
							<div class="form-group">
								<label for="semester">Semester</label>
								<select class="form-select" name="semester" id="semester" required>
									<option>1</option>
									<option>2</option>
								</select>
							</div>
						</div>

						<div class="col">
							<h3 style="text-align: center; margin-top: 3rem;" class="title">memberships</h3>
							<div class="row">
								<?php foreach ($memberships as $row): ?>
									<div class="col-md-3">
										<div class="form-group position-relative">
											<!-- Hidden checkbox that will hold the actual values -->
											<input class="form-check-input position-absolute" type="checkbox" name="membership_name[]" value="<?= $row['id'] ?>" id="membership<?= $row['id'] ?>" style="display: none;">

											<!-- Div styled as a checkbox -->
											<div class="form-control d-flex align-items-center p-2 border rounded cursor-pointer" onclick="document.getElementById('membership<?= $row['id'] ?>').click();">
												<span class="me-2">
													<i class="" id="icon-membership<?= $row['id'] ?>"></i>
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

						<div class="col">

							<h3 style="text-align: center; margin-top: 3rem;" class="title">payment method</h3>
							<div class="inputBox">
								<img src="<?= base_url('assets/img/paypal.png') ?>" alt="">
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="amount_paid">Total:</label>
									<input type="hidden" name="amount_paid">
									<input type="text" name="total_amount" readonly class="form-control-plaintext" id="total_amount">
								</div>
							</div>
							<div id="paypal-button-container" class="mt-3"></div>
							<button style="background-color: #0d6efd;" type="submit" id="submit-button" class="btn btn-primary btn-md mt-5">Submit</button>
						</div>
					</div>
				</div>
		</div>
		</div>
		</form>
		</div>
	</section>
	<!-- Paypal Payment Method Implementation -->
	<script
		src="https://www.paypal.com/sdk/js?client-id=AYaq8OLUzVLqfhxIfTNicWi6gkyDfiO2g7y2kvamH7pX89qaWmBc60GRwLe9WUOziBobmRHef0M3sY3Y&currency=PHP">
	</script>
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
				$('#total_amount').val(totalAmount.toFixed(2));
			});
		});
	</script>
	<script>
		var isPaid = false; // Tracks PayPal payment status
		var isFormSubmitted = false; // Tracks form submission status

		// Define validation regex
		const nameRegex = /^[A-Za-z\s]{2,}$/; // Name: at least 2 letters
		const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/; // Gmail only

		// Function to validate form fields
		function validateForm() {
			const name = $('#fullname').val().trim();
			const email = $('#email').val().trim();
			const studentId = $('#student_id').val().trim();
			const course = $('#course').val().trim();
			const mobileNumber = $('#mobile_number').val().trim();
			const section = $('#section').val().trim();
			const yearLevel = $('#year_level').val().trim();
			const semester = $('#semester').val().trim();
			const totalAmount = $('#total_amount').val().replace('₱', '').trim();

			// Validate each field with detailed feedback
			if (!name || !nameRegex.test(name)) {
				Swal.fire({
					icon: 'warning',
					title: 'Invalid Name',
					text: 'Please enter a valid full name.',
					timer: 3000,
					timerProgressBar: true,
				});
				return false;
			}

			if (!email || !emailRegex.test(email)) {
				Swal.fire({
					icon: 'warning',
					title: 'Invalid Email',
					text: 'Please enter a valid Gmail address.',
					timer: 3000,
					timerProgressBar: true,
				});
				return false;
			}

			if (!studentId || !course || !mobileNumber || !section || !yearLevel || !semester) {
				Swal.fire({
					icon: 'warning',
					title: 'Incomplete Details',
					text: 'Please fill out all required fields.',
					timer: 3000,
					timerProgressBar: true,
				});
				return false;
			}

			if (!totalAmount || isNaN(totalAmount) || parseFloat(totalAmount) <= 0) {
				Swal.fire({
					icon: 'warning',
					title: 'No Membership Selected',
					text: 'Please select a membership before proceeding.',
					timer: 3000,
					timerProgressBar: true,
				});
				return false;
			}

			return true; // All validations passed
		}

		// Submit button click handler
		$('#submit-button').on('click', function(e) {
			e.preventDefault(); // Prevent default form submission

			// Validate form fields
			if (!validateForm()) {
				return; // Stop further actions if validation fails
			}

			// Check if payment is completed
			if (!isPaid) {
				Swal.fire({
					icon: 'warning',
					title: 'Payment Pending',
					text: 'Please complete the payment on PayPal before submitting.',
					timer: 3000,
					timerProgressBar: true,
				});
				return;
			}

			if (!isFormSubmitted && isPaid) {
				Swal.fire({
					icon: 'success',
					title: 'Submitting...',
					text: 'Your registration is being processed.',
					timer: 3000,
					timerProgressBar: true,
				}).then(() => {
					isFormSubmitted = true;

					// Display success message
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: 'Form has been successfully submitted.',
						confirmButtonText: 'OK',
						timer: 3000
					});
					$('#membership-form')[0].submit();
				});
			}
		});


		paypal.Buttons({
			createOrder: function(data, actions) {
				return actions.order.create({
					purchase_units: [{
						amount: {
							value: $('#total_amount').val() // Total amount from selected memberships
						}
					}]
				});
			},
			onApprove: function(data, actions) {
				return actions.order.capture().then(function(details) {
					// Successful transaction
					const amountPaid = details.purchase_units[0].amount.value;
					const payerName = details.payer.name.given_name;
					// Update the hidden input with the paid amount
					const totalAmount = parseFloat($('#total_amount').val()) || 0;
					$('input[name="amount_paid"]').val(totalAmount.toFixed(2));

					// Display success message
					Swal.fire({
						icon: 'success',
						title: 'Payment Successful',
						text: `Thank you, ${payerName}! Payment of ₱${amountPaid} received.`,
						confirmButtonText: 'OK',
						timer: 3000
					});

					// Mark payment as completed
					isPaid = true;

					// Enable the submit button after payment
					$('#submit-button').prop('disabled', false);
				});
			},
			onCancel: function(data) {
				Swal.fire({
					icon: 'info',
					title: 'Payment Cancelled',
					text: 'You cancelled the payment. Please try again if required.',
					confirmButtonText: 'OK',

				});
			},
			onError: function(err) {
				Swal.fire({
					icon: 'warning',
					title: 'Payment Error',
					text: 'Please fill all the required fields or select a membership. And try again.',
					confirmButtonText: 'OK',
				});
			}
		}).render('#paypal-button-container');
	</script>
</body>

</html>