<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Membership Plans</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/feathericon.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap-datetimepicker.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                        <li><a href="<?= base_url('admin/index') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="submenu"><a href="#"><i class="fa-solid fa-user-group"></i> <span> Students </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="<?= base_url('admin/students') ?>"> All Students </a></li>
                            </ul>
                        </li>
                        <li class="active"><a href="<?= base_url('/admin/membership_plans') ?>"><i class="far fa-money-bill-alt"></i> <span> Membership Plans </span></a></li>
                        <li class="submenu"><a href="#"><i class="far fa-money-bill-alt"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="<?= base_url('/admin/pending_payment') ?>"> Pending Payments </a></li>
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
                                <?php if (session()->getFlashdata('status')): ?>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            // Trigger the SweetAlert
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: '<?php echo session()->getFlashdata('status'); ?>',
                                                confirmButtonText: 'OK',
                                                confirmButtonColor: '#3085d6',
                                                timer: 3000
                                            });
                                        });
                                    </script>
                                <?php endif; ?>

                                <h4 class="page-title float-left">Membership Plans</h4>
                                <a href="<?= base_url('/admin/add_new_membership') ?>" class="btn btn-primary btn-md float-right">Add New Membership</a>
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
                                                <th>Amount</th>
                                                <th>Partial Payment</th>
                                                <th>Creation Date</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($memberships)): ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No membership added yet</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($memberships as $row): ?>
                                                    <tr>
                                                        <td><?= $row['membership_name'] ?></td>
                                                        <td><?= $row['amount'] ?></td>
                                                        <td><?= $row['partial_payment'] ?></td>
                                                        <td><?= $row['created_at'] ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('/admin/edit_membership/' . $row['id']); ?>" class="btn btn-light btn-sm border-0 text-primary bg-primary-light"><i class="fa-regular fa-pen-to-square"></i></a>
                                                            <button class="btn btn-light btn-sm border-0 text-danger bg-danger-light" onclick="confirmDelete(<?= $row['id'] ?>)">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
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

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <script>
        function confirmDelete(userId) {
            const csrfToken = '<?= csrf_hash() ?>'; // Get CSRF token
            const csrfName = '<?= csrf_token() ?>'; // Get CSRF token name

            // Show SweetAlert with warning icon
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete this membership fee?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, delete',
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX DELETE request
                    $.ajax({
                        url: '<?= base_url("/admin/delete_membership/") ?>' + userId,
                        type: 'DELETE',
                        data: {
                            [csrfName]: csrfToken
                        }, // Send CSRF token
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Membership fee has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete membership fee. Please try again.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Failed to delete membership fee. Please try again.',
                                'error'
                            );
                        }
                    });

                }
            });
        }
    </script>
</body>

</html>