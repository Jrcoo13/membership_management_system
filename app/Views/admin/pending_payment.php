<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Students</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/feathericon.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap-datetimepicker.min.css') ?>">
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
                        <li> <a href="<?= base_url('/admin/membership_plans') ?>"><i class="far fa-money-bill-alt"></i> <span> Membership Plans </span></a></li>
                        <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="active" href="<?= base_url('/admin/pending_payment') ?>"> Pending Payments </a></li>
                                <li><a href="<?= base_url('/admin/payment_history') ?>"> Payment History </a></li>
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
                                <!-- ALERT MESSAGE -->
                                <?php
                                if (session()->getFlashdata('status')) { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </symbol>
                                    </svg>
                                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                                        <!-- Icon -->
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                            <use xlink:href="#check-circle-fill" />
                                        </svg>
                                        <!-- Text -->
                                        <div><?php echo session()->getFlashdata('status'); ?></div>
                                        <!-- Close Button -->
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                }
                                ?>

                                <!-- DELETE MODAL -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form id="deleteStudentForm" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Delete Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="_method" value="DELETE" id="delete_user_id">
                                                    Are you sure you want to reject this student?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary">Yes, delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <h4 class="page-title float-left">Pending Payments</h4>
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
                                                <th>Student Name</th>
                                                <th>Degree Program</th>
                                                <th>Membership Fee</th>
                                                <th>Amount Paid</th>
                                                <th>Paid Date</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($pending_payment)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No pending payment yet</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($pending_payment as $row) : ?>
                                                    <tr>
                                                        <td><?= $row['student_name'] ?></td>
                                                        <td><?= $row['degree_program'] ?></td>
                                                        <td><?= $row['membership_name'] ?></td>
                                                        <td><?= $row['membership_amount'] ?></td>
                                                        <td><?= $row['paid_date'] ?></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-light btn-sm border-0 text-success bg-success-light">Approve</button>
                                                            <button class="btn btn-light btn-sm border-0 text-danger bg-danger-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Reject</button>
                                                        </td>
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
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $('#staticBackdrop').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var studentId = button.data('id'); // Get the student ID

                // Set the form action to include the student ID in the URL
                var form = $(this).find('form');
                var actionUrl = '<?= base_url("/admin/delete_membership/") ?>' + studentId;
                form.attr('action', actionUrl); // Set the action URL dynamically
            });
        });
    </script>


    <!-- Option 1: Bootstrap Bundle with Popper -->
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