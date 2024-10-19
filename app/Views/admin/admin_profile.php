<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Profile</title>
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
                        <li> <a href="<?= base_url('admin/index') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
                        <li class="list-divider"></li>
                        <li class="submenu"> <a href="<?= base_url('admin/students') ?>"><i class="fa-solid fa-user-group"></i> <span> Students </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="<?= base_url('admin/students') ?>"> All Students </a></li>
                            </ul>
                        </li>
                        <li> <a href="<?= base_url('/admin/membership_plans') ?>"><i class="far fa-money-bill-alt"></i> <span> Membership Plans </span></a></li>
                        <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
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
                <div class="page-header mt-5">
                    <div class="row">
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
                        <div class="col">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-header">
                            <div class="row align-items-center">
                                <div class="col-auto profile-image">
                                    <a href="#"> <img class="rounded-circle" alt="User Image" src="<?= base_url('assets/img/my_profile.jpeg') ?>"> </a>
                                </div>
                                <div class="col ml-md-n2 profile-user-info text-start">
                                    <h4 class="user-name mb-3"><?= session()->get('user')['first_name'] . ' ' . session()->get('user')['last_name'] ?></h4>
                                    <h6 class="text-muted mt-1"><?= session()->get('user')['role'] ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="profile-menu">
                            <ul class="nav nav-tabs nav-tabs-solid">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a> </li>
                            </ul>
                        </div>
                        <div class="tab-content profile-tab-cont">
                            <div class="tab-pane fade show active" id="per_details_tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between">
                                                    <span>Personal Information</span>
                                                    <a class="btn btn-sm bg-primary-light text-primary" data-toggle="modal" href="#edit_personal_details"><i class="fa-regular fa-pen-to-square"></i> Edit Profile</a>
                                                </h5>
                                                <div class="row mt-5">
                                                    <p class="col-sm-3 text-sm-start mb-0 mb-sm-3">Name</p>
                                                    <p class="col-sm-9"><?= session()->get('user')['first_name'] . ' ' . session()->get('user')['last_name'] ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-sm-start mb-0 mb-sm-3">Email</p>
                                                    <p class="col-sm-9"><?= session()->get('user')['email'] ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-sm-start mb-0 mb-sm-3">Mobile Number</p>
                                                    <p class="col-sm-9"><?= session()->get('user')['mobile_number'] ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-sm-start mb-0 mb-sm-3">Date of Birth</p>
                                                    <p class="col-sm-9"><?= session()->get('user')['birth_date'] ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-sm-start mb-0 mb-sm-3">Sex</p>
                                                    <p class="col-sm-9"><?= session()->get('user')['sex'] ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-sm-start mb-0">Address</p>
                                                    <p class="col-sm-9 mb-0"><?= session()->get('user')['address'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Personal Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('update_admin_data/' . session()->get('user')['id']) ?>" method="POST" class="row g-3 needs-validation" novalidate>
                                                            <div class="row form-row">
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>First Name</label>
                                                                        <input type="text" name="first_name" class="form-control" value="<?= session()->get('user')['first_name'] ?>" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter your first name.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Last Name</label>
                                                                        <input type="text" name="last_name" class="form-control" value="<?= session()->get('user')['last_name'] ?>" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter your last name.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="birth_date">Date of Birth</label>
                                                                        <input type="date" id="birth_date" name="birth_date" class="form-control datetimepicker" value="<?= session()->get('user')['birth_date'] ?>" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter your birth date.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="gender">Gender</label>
                                                                        <select class="form-control" name="sex" id="gender" required>
                                                                            <option>Male</option>
                                                                            <option>Female</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input type="email" name="email" class="form-control" value="<?= session()->get('user')['email'] ?>" required>
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid email address.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Mobile No#</label>
                                                                        <input type="text" name="mobile_number" value="<?= session()->get('user')['mobile_number'] ?>" class="form-control" required>
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid mobile number.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Address</label>
                                                                        <input type="invalid-feedback" name="address" class="form-control" value="<?= session()->get('user')['address'] ?>" required>
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid address.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="profile_picture">Profile Picture</label>
                                                                        <div class="custom-file mb-3">
                                                                            <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                                                                            <label class="custom-file-label" for="profile_picture">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                            <div class="col-12 text-end">
                                                                <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal" aria-label="Close">Cancel</button>
                                                                <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="password_tab" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Change Password</h5>
                                        <div class="row">
                                            <div class="col-md-10 col-lg-6">
                                                <form>
                                                    <div class="form-group">
                                                        <label>Old Password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
    </script>

    <script>
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