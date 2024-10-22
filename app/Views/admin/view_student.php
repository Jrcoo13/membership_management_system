<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Students - View</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/feathericon.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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
                                <li><a href="<?= base_url('admin/add_student') ?>"> Add Student </a></li>
                            </ul>
                        </li>
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
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title mt-5">View Student</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?= base_url('/admin/update_user/' . $student['id']) ?>" method="POST" class="row g-3 needs-validation" novalidate>
                            <div class="row formtype">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="full_name">Student Name</label>
                                        <input class="form-control" type="text" name="full_name" id="full_name" value="<?= $student['student_name'] ?>" disabled readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="student_id">ID Number</label>
                                        <input class="form-control" type="number" name="student_id" id="student_id" value="<?= $student['student_id'] ?>" disabled readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <input type="text" class="form-control" name="section" id="section" disabled readonly
                                            value="<?php
                                                    if ($student['section'] == 'A') {
                                                        echo 'A';
                                                    }
                                                    if ($student['section'] == 'B') {
                                                        echo 'B';
                                                    }
                                                    if ($student['section'] == 'C') {
                                                        echo 'C';
                                                    }
                                                    ?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="course">Degree Program</label>
                                        <input class="form-control" type="text" id="course" name="course" disabled readonly
                                            value="<?php
                                                    if ($student['degree_program'] == 'Bachelor of Science in Information Technology') {
                                                        echo 'Bachelor of Science in Information Technology';
                                                    }
                                                    if ($student['degree_program'] == 'Bachelor of Science in Computer Science') {
                                                        echo 'Bachelor of Science in Computer Science';
                                                    }
                                                    if ($student['degree_program'] == 'Bachelor of Science in Information System') {
                                                        echo 'Bachelor of Science in Information System';
                                                    }
                                                    if ($student['degree_program'] == 'Bachelor of Science in Civil Engineering') {
                                                        echo 'Bachelor of Science in Civil Engineering';
                                                    }
                                                    if ($student['degree_program'] == 'Bachelor of Science in Industrial Technology') {
                                                        echo 'Bachelor of Science in Industrial Technology';
                                                    }
                                                    ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year_level">Year Level</label>
                                        <input type="number" class="form-control" name="year_level" id="year_level" disabled readonly
                                            value="<?php
                                                    if ($student['year_level'] == '1') {
                                                        echo '1';
                                                    }
                                                    if ($student['year_level'] == '2') {
                                                        echo '2';
                                                    }
                                                    if ($student['year_level'] == '3') {
                                                        echo '3';
                                                    }
                                                    if ($student['year_level'] == '4') {
                                                        echo '4';
                                                    }
                                                    ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <input type="number" class="form-control" name="semester" id="semester" disabled readonly
                                            value="<?php
                                                    if ($student['semester'] == '1') {
                                                        echo '1';
                                                    }
                                                    if ($student['semester'] == '2') {
                                                        echo '2';
                                                    }
                                                    ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?= $student['email'] ?>" disabled readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="number" class="form-control" name="mobile_number" id="mobile_number" value="<?= $student['mobile_number'] ?>" disabled readonly>
                                    </div>
                                </div>
                                <!-- Membership Plans Display -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="membership_plans">Memberships Paid</label>
                                        <div class="row">
                                            <?php foreach ($memberships as $row): ?>
                                                <?php if (in_array($row['id'], $selectedMembershipIds)): ?>
                                                    <div class="col-md-3">
                                                        <div class="form-group position-relative">
                                                            <!-- Hidden checkbox that holds the actual values -->
                                                            <input
                                                                class="form-check-input position-absolute"
                                                                type="checkbox"
                                                                name="membership_name[]"
                                                                value="<?= $row['id'] ?>"
                                                                id="membership<?= $row['id'] ?>"
                                                                style="display: none;"
                                                                <?php if (in_array($row['id'], $selectedMembershipIds)) echo 'checked'; ?>
                                                                disabled>

                                                            <!-- Div styled as a checkbox -->
                                                            <div
                                                                class="form-control d-flex align-items-center p-2 border rounded cursor-not-allowed"
                                                                style="background-color: #f8f9fa;">
                                                                <span class="me-2">
                                                                    <i class="bi bi-circle" id="icon-membership<?= $row['id'] ?>"></i>
                                                                </span>
                                                                <span><?= $row['membership_name'] . ' ' ?><span>&#8369;<?= $row['amount'] ?></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input class="form-control" type="number" name="amount_paid" id="amount_paid" value="<?= $student['amount_paid'] ?>" disabled readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <a href="<?= base_url('/admin/students') ?>" class="btn btn-secondary btn-md float-right mr-2">Back</a>
                            </div>
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