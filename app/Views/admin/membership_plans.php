<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Students</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png') ?>">
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
		<div class="header">
			<div class="header-left">
				<a href="<?= base_url('/admin/index') ?>" class="logo"> <img src="<?= base_url('assets/img/logo.png') ?>" width="50" height="70" alt="logo"> <span class="logoclass text-dark">LSC</span> </a>
				<a href="<?= base_url('/admin/index') ?>" class="logo logo-small">
					<img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" width="30" height="30">
				</a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn">
				<i class="fe fe-text-align-left text-dark"></i>
			</a>
			<a class="mobile_btn" id="mobile_btn">
				<i class="fas fa-bars"></i>
			</a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img"><img class="rounded-circle" src="<?= base_url('assets/img/my_profile.jpeg') ?>" width="31" alt="Soeng Souy"></span>
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm">
								<img src="<?= base_url('assets/img/my_profile.jpeg') ?>" alt="User Image" class="avatar-img rounded-circle">
							</div>
							<div class="user-text">
								<h6>Jerico Ocal</h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>
						</div>
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="<?= base_url('/') ?>">Logout</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li> <a href="<?= base_url('admin/index') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
						<li class="list-divider"></li>
						<li class="submenu"> <a href="#"><i class="fa-solid fa-user-group"></i> <span> Students </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="<?= base_url('admin/students') ?>"> All Students </a></li>
							</ul>
						</li>
                        <li> <a class="active" href="#"><i class="far fa-money-bill-alt"></i> <span> Membership Plans </span></a></li>
						<li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-customer.html"> Transaction History </a></li>
								<li><a href="edit-customer.html"> Pending Payments </a></li>
								<li><a href="add-customer.html"> Invoice and Receipts </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-calendar-alt"></i> <span> Events & Activities </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-rooms.html"> Manage Events </a></li>
								<li><a href="edit-room.html"> Event Registration </a></li>
								<li><a href="add-room.html"> Event History & Analytics </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="expense-reports.html"> Membership Analytics </a></li>
								<li><a href="invoice-reports.html"> Financial Reports </a></li>
								<li><a href="invoice-reports.html"> Activity Reports </a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>


		<div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <div class="mt-3">
                                <h4 class="page-title float-left">Membership Plans</h4> <a href="#" class="btn btn-primary btn-sm float-right">Add New Membership</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card card-table flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center">
                                        <thead>
                                            <tr>
                                                <th>Membership Name</th>
                                                <th>Price</th>
                                                <th>Creation Date</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($memberships as $row) : ?>
                                                <tr>
                                                    <td><?= $row['membership_name'] ?></td>
                                                    <td><?= $row['amount'] ?></td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-light btn-sm text-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        <button class="btn btn-light btn-sm text-dark"><i class="fa-regular fa-eye"></i></button>
                                                        <button class="btn btn-light btn-sm text-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-regular fa-trash-can"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tr>
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
	</script>
</body>

</html>