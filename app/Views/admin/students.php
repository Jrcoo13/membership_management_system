<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Students</title>
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
                        <li> <a href="<?= base_url('admin/index') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
                        <li class="list-divider"></li>
                        <li class="active"> <a href="<?= base_url('admin/students') ?>"><i class="fa-solid fa-user-group"></i> <span> Students </span></a></li>
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
                                                timer: 3000 // Auto close after 3 seconds
                                            });
                                        });
                                    </script>
                                <?php endif; ?>
                                <h4 class="page-title float-left">All Students</h4><a href="<?= base_url('admin/add_student') ?>" class="btn btn-primary btn-md float-right">Add Student</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card card-table flex-fill">
                            <div class="card-body">
                                <!-- <div class="export-buttons">
                                </div> -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center" id="table">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Student Name</th>
                                                <th>Course & Year</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($student)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No student added yet</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($student as $row) : ?>
                                                    <tr>
                                                        <td><?= $row['student_id'] ?></td>
                                                        <td><?= $row['student_name'] ?></td>
                                                        <td><?= $row['degree_program'] . ' '. $row['year_level'] ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('/admin/edit_student/' . $row['id']); ?>" class="btn btn-light btn-sm border-0 text-primary bg-primary-light"><i class="fa-regular fa-pen-to-square"></i></a>
                                                            <button class="btn btn-light btn-sm border-0 text-dark"><i class="fa-regular fa-eye"></i></button>
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
    <!-- Bootstrap Bundle with Popper -->
    <script data-cfasync="false" src="<?= base_url('../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/raphael/raphael.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/morris/morris.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/chart.morris.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                dom: 'Bfrtip', 
                // buttons: [
                //     // 'copy', 
                //     // 'csv', 
                //     'excel', 
                //     'pdf', 
                //     'print'
                // ],
                buttons: [
                    // {
                    //     extend: 'copy',
                    //     className: 'btn-copy',
                    //     text: '<i class="fa fa-copy"></i> Copy'
                    // },
                    // {
                    //     extend: 'csv',
                    //     className: 'btn-csv',
                    //     text: '<i class="fa fa-file-csv"></i> CSV'
                    // },
                    {
                        extend: 'excel',
                        className: 'btn-excel',
                        text: '<i class="fa fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF'
                    },
                    {
                        extend: 'print',
                        className: 'btn-print',
                        text: '<i class="fa fa-print"></i> Print'
                    }
                ],
                paging: false,
                info: false,
            });

            table.buttons().container()
                .appendTo('.export-buttons');
        });
    </script>

<script>
        function confirmDelete(userId) {
            const csrfToken = '<?= csrf_hash() ?>'; // Get CSRF token
            const csrfName = '<?= csrf_token() ?>'; // Get CSRF token name

            // Show SweetAlert with warning icon
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete this student?',
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
                        url: '<?= base_url("/admin/delete_student/") ?>' + userId,
                        type: 'DELETE',
                        data: {
                            [csrfName]: csrfToken
                        }, // Send CSRF token
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Student has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete student. Please try again.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Failed to delete student. Please try again.',
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