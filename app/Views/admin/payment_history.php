<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Transaction History</title>
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
								<li><a href="<?= base_url('admin/add_student') ?>"> Add Student </a></li>
							</ul>
						</li>
                        <li> <a href="<?= base_url('/admin/membership_plans') ?>"><i class="fa-solid fa-rectangle-list"></i> <span> Membership Plans </span></a></li>
                        <li class="list-divider"></li>
                        <li> <a href="<?= base_url('/admin/pending_payment') ?>"><i class="fa-solid fa-user-clock"></i> <span> Pending Payment </span></a></li>
						<li class="active"> <a href="<?= base_url('/admin/payment_history') ?>"><i class="fa-solid fa-clock-rotate-left"></i> <span> Transaction History </span></a></li>
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
                                                    Are you sure you want to delete this student?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary">Yes, delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <h4 class="page-title float-left">Transaction History</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="export-buttons"></div>
                    <div class="col-md-12 d-flex">
                        <div class="card card-table flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center display responsive nowrap" id="table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Student Name</th>
                                                <th>Degree Program</th>
                                                <th>Transaction Date</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($past_transaction)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No past transaction yet</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($past_transaction as $row) : ?>
                                                    <tr>
                                                        <td><?= $row['student_id'] ?></td>
                                                        <td><?= $row['student_name'] ?></td>
                                                        <td><?= $row['degree_program']. ' ' .$row['year_level'] ?></td>
                                                        <td><?= $row['transaction_date'] ?></td>
                                                        <td class="text-center">
                                                            <?php if($row['status'] == 'Approved') : ?>
                                                            <span class="btn btn-light btn-sm border-0 text-success bg-success-light">
                                                                <?= $row['status'] ?>
                                                            </span>
                                                            <?php else : ?>
                                                                <span class="btn btn-light btn-sm border-0 text-danger bg-danger-light">
                                                                <?= $row['status'] ?>
                                                                </span>
                                                            <?php endif; ?>
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
                dom: 'Bfrtip', // Add buttons to the top of the table
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
                paging: false, // Disable pagination (no "Previous", "Next", page numbers)
                info: false,
                // pagingType: "simple_numbers", // Use simple pagination
                // pageLength: 10 
            });

            table.buttons().container()
                .appendTo('.export-buttons');
        });
    </script>
</body>

</html>