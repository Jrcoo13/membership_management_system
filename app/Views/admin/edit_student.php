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
                                <li><a class="active" href="<?= base_url('admin/students') ?>"> All Students </a></li>
                            </ul>
                        </li>
                        <li> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Membership Plans </span></a></li>
                        <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="#"> Transaction History </a></li>
                                <li><a href="#"> Pending Payments </a></li>
                                <li><a href="#"> Invoice and Receipts </a></li>
                            </ul>
                        </li>
                        <li class="submenu"> <a href="#"><i class="fas fa-calendar-alt"></i> <span> Events & Activities </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="#"> Manage Events </a></li>
                                <li><a href="#"> Event Registration </a></li>
                                <li><a href="#"> Event History & Analytics </a></li>
                            </ul>
                        </li>
                        <li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="#"> Membership Analytics </a></li>
                                <li><a href="#"> Financial Reports </a></li>
                                <li><a href="#"> Activity Reports </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title mt-5">Edit Student</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?= base_url('/admin/update_user/'.$student['id']) ?>" method="POST">
                            <div class="row formtype">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="full_name">Full Name</label>
                                        <input class="form-control" type="text" name="full_name" id="full_name" value="<?= $student['name'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="student_id">ID Number</label>
                                        <input class="form-control" type="tel" name="student_id" id="student_id" value="<?= $student['student_id'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course">Course</label>
                                        <select class="form-control" id="course" name="course">
                                            <option <?php if ($student['course'] == "Bachelor of Science in Information Technology") echo "selected"; ?>>
                                                Bachelor of Science in Information Technology
                                            </option>
                                            <option <?php if ($student['course'] == "Bachelor of Science in Computer Science") echo "selected"; ?>>
                                                Bachelor of Science in Computer Science
                                            </option>
                                            <option <?php if ($student['course'] == "Bachelor of Science in Information System") echo "selected"; ?>>
                                                Bachelor of Science in Information System
                                            </option>
                                            <option <?php if ($student['course'] == "Bachelor of Science in Civil Engineering") echo "selected"; ?>>
                                                Bachelor of Science in Civil Engineering
                                            </option>
                                            <option <?php if ($student['course'] == "Bachelor of Science in Industrial Technology") echo "selected"; ?>>
                                                Bachelor of Science in Industrial Technology
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year_level">Year Level</label>
                                        <input class="form-control" type="tel" name="year_level" id="year_level" value="<?= $student['year_level'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sex">Sex</label>
                                        <select class="form-control" id="sex" name="sex">
                                            <option <?php if ($student['sex'] == "Male") echo "selected"; ?>>
                                                Male
                                            </option>
                                            <option <?php if ($student['sex'] == "Female") echo "selected"; ?>>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?= $student['email'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_number">Phone Number</label>
                                        <input type="tel" class="form-control" name="mobile_number" id="mobile_number" value="<?= $student['mobile_number'] ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Save Changes</button>
                            <a href="<?= base_url('/admin/students') ?>" class="btn btn-secondary btn-sm float-right mr-2">Cancel</a>
                        </form>
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