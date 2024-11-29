<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Students - Edit</title>
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
                        <li class="submenu"> <a href="#"><i class="fa-solid fa-user-group"></i> <span> Students </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="<?= base_url('admin/students') ?>"> All Student </a></li>
								<li><a href="<?= base_url('admin/add_student') ?>"> Add Student </a></li>
							</ul>
						</li>
                        <li> <a href="<?= base_url('/admin/membership_plans') ?>"><i class="fa-solid fa-rectangle-list"></i> <span> Membership Plans </span></a></li>
                        <li class="list-divider"></li>
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
                            <h3 class="page-title mt-5">Edit Student</h3>
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
                                        <input class="form-control" type="text" name="full_name" id="full_name" value="<?= $student['student_name'] ?>" required>
                                        <div class="invalid-feedback">
											Please enter your name.
										</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="student_id">ID Number</label>
                                        <input class="form-control" type="tel" name="student_id" id="student_id" value="<?= $student['student_id'] ?>" maxlength="7" pattern="\d{7}" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <div class="invalid-feedback">
											Please provide a valid student id.
										</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course">Degree Program</label>
                                        <select class="form-select" id="course" name="course" required>
                                            <option <?php if ($student['degree_program'] == "Bachelor of Science in Information Technology") echo "selected"; ?>>
                                                Bachelor of Science in Information Technology
                                            </option>
                                            <option <?php if ($student['degree_program'] == "Bachelor of Science in Computer Science") echo "selected"; ?>>
                                                Bachelor of Science in Computer Science
                                            </option>
                                            <option <?php if ($student['degree_program'] == "Bachelor of Science in Information System") echo "selected"; ?>>
                                                Bachelor of Science in Information System
                                            </option>
                                            <option <?php if ($student['degree_program'] == "Bachelor of Science in Civil Engineering") echo "selected"; ?>>
                                                Bachelor of Science in Civil Engineering
                                            </option>
                                            <option <?php if ($student['degree_program'] == "Bachelor of Science in Industrial Technology") echo "selected"; ?>>
                                                Bachelor of Science in Industrial Technology
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
									<div class="form-group">
										<label for="year_level">Year Level</label>
										<select class="form-select" name="year_level" id="year_level" required>
											<option <?php if($student['year_level'] == '1') echo 'selected'?>>1</option>
											<option <?php if($student['year_level'] == '2') echo 'selected'?>>2</option>
                                            <option <?php if($student['year_level'] == '3') echo 'selected'?>>3</option>
											<option <?php if($student['year_level'] == '4') echo 'selected'?>>4</option>
										</select>
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label for="section">Section</label>
										<select class="form-select" name="section" id="section" required>
											<option <?php if($student['section'] == 'A') echo 'selected'?>>A</option>
											<option <?php if($student['section'] == 'B') echo 'selected'?>>B</option>
                                            <option <?php if($student['section'] == 'C') echo 'selected'?>>C</option>
										</select>
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label for="semester">Semester</label>
										<select class="form-select" name="semester" id="semester" required>
											<option <?php if($student['semester'] == '1') echo 'selected'?>>1</option>
											<option <?php if($student['semester'] == '2') echo 'selected'?>>2</option>
										</select>
									</div>
								</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?= $student['email'] ?>" required>
                                        <div class="invalid-feedback">
											Please provide a valid email address.
										</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="tel" class="form-control" name="mobile_number" id="mobile_number" value="<?= 0 .$student['mobile_number'] ?>" maxlength="11" pattern="\d{11}" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <div class="invalid-feedback">
											Please provide a valid mobile number.
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary btn-md float-right">Save Changes</button>
                            <a href="<?= base_url('/admin/students') ?>" class="btn btn-secondary btn-md float-right mr-2">Cancel</a>
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