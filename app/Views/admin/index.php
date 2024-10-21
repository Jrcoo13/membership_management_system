<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Dashboard</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/feathericon.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		a {
			text-decoration: none;
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
						<li class="active"> <a href="<?= base_url('admin/index') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
						<li class="list-divider"></li>
						<li> <a href="<?= base_url('admin/students') ?>"><i class="fa-solid fa-user-group"></i> <span> Students </span></a></li>
						<li> <a href="<?= base_url('/admin/membership_plans') ?>"><i class="fa-solid fa-rectangle-list"></i> <span> Membership Plans </span></a></li>
						<li class="list-divider"></li>
						<li> <a href="<?= base_url('/admin/pending_payment') ?>"><i class="fa-solid fa-user-clock"></i> <span> Pending Payment </span></a></li>
						<li> <a href="<?= base_url('/admin/payment_history') ?>"><i class="fa-solid fa-clock-rotate-left"></i> <span> Transaction History </span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12 mt-5">
							<h3 class="page-title mt-3">Dashboard</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-sm-6 col-12">
						<div class="card fill rounded-sm">
							<div class="card-body">
								<div class="dash-widget-header">
									<div>
										<h3 class="card_widget_header"><?= esc($total_students); ?></h3>
										<h6>Active Students</h6>
									</div>
									<div class="ml-auto mt-md-3 mt-lg-0">
										<i class="fas fa-user fa-2x text-primary"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12">
						<div class="card fill rounded-sm">
							<div class="card-body">
								<div class="dash-widget-header">
									<div>
										<h3 class="card_widget_header"><?= esc($total_students); ?></h3>
										<h6>Recent Payments</h6>
									</div>
									<div class="ml-auto mt-md-3 mt-lg-0">
										<i class="far fa-money-bill-alt fa-2x text-primary"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12">
						<div class="card fill rounded-sm">
							<div class="card-body">
								<div class="dash-widget-header">
									<div>
										<h3 class="card_widget_header">
											<?php if ($monthly_revenue > 0): ?>
												<?= '₱' . number_format($monthly_revenue, 2); ?>
											<?php else: ?>
												₱0.00
											<?php endif; ?>
										</h3>
										<h6>Monthly Revenue</h6>
									</div>
									<div class="ml-auto mt-md-3 mt-lg-0">
										<i class="fas fa-calendar-alt fa-2x text-primary"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12">
						<div class="card fill rounded-sm">
							<div class="card-body">
								<div class="dash-widget-header">
									<div>
										<h3 class="card_widget_header">100%</h3>
										<h6>Payment Success</h6>
									</div>
									<div class="ml-auto mt-md-3 mt-lg-0">
										<i class="fas fa-user-check fa-2x text-primary"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 d-flex">
						<div class="card card-table flex-fill">
							<div class="card-header">
								<h3 class="card-title float-left mt-2">Recently Added Students</h3>
								<a href="<?= base_url('/admin/students') ?>" class="btn text-primary float-right">View All</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover table-center">
										<thead>
											<tr>
												<th>Student ID</th>
												<th>Name</th>
												<th>Course & Year</th>
												<th>Transaction Date</th>
											</tr>
										</thead>
										<?php if (empty($student)): ?>
											<tr>
												<td colspan="6" class="text-center">No student added yet</td>
											</tr>
										<?php else: ?>
											<?php foreach ($student as $row) : ?>
												<tr>
													<td><?= $row['student_id'] ?></td>
													<td><?= $row['student_name'] ?></td>
													<td><?= $row['degree_program'] ?></td>
													<td><?= $row['transaction_date'] ?></td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script data-cfasync="false" src="<?= base_url('../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/raphael/raphael.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/morris/morris.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/chart.morris.js') ?>"></script>
	<script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>