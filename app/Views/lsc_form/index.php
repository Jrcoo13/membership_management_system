<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LSC Membership Fee Form</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
  <!-- custom css file link  -->
  <link rel="stylesheet" href="<?= base_url('assets/css/fill_up_form.css') ?>">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Include Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
  <div class="container">
    <form action="<?= base_url('/submit_form') ?>" method="POST" class="row g-3 needs-validation" novalidate>
      <div class="row">
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
                timer: 5000
              });
            });
          </script>
        <?php endif; ?>
        <div class="col">
          <h3 class="page-title text-center mb-5">LSC Membership Fee Form</h3>
          <h3 class="title">Personal Information</h3>
          <div class="inputBox form-group">
            <label for="email">Email Address :</label>
            <input type="email" class="form-control" name="email" id="email" required>
            <div class="invalid-feedback">
              Please provide a valid email address.
            </div>
          </div>
          <div class="flex">
            <div class="inputBox form-group">
              <label for="first_name">First name :</label>
              <input type="text" class="form-control" name="first_name" id="first_name" required>
              <div class="invalid-feedback">
                Please enter your first name.
              </div>
            </div>
            <div class="inputBox">
              <label for="last_name">Last name :</label>
              <input type="text" class="form-control" name="last_name" id="last_name" required>
              <div class="invalid-feedback">
                Please enter your last name.
              </div>
            </div>
          </div>
          <div class="flex">
            <div class="inputBox form-group">
              <label for="student_id">Student ID :</label>
              <input type="number" class="form-control" name="student_id" id="student_id" required>
              <div class="invalid-feedback">
                Please enter your student id.
              </div>
            </div>
            <div class="inputBox">
              <label for="mobile_number">Mobile Number :</label>
              <input type="number" class="form-control" name="mobile_number" id="mobile_number" required>
              <div class="invalid-feedback">
                Please provide a valid mobile number.
              </div>
            </div>
          </div>
          <div class="flex">
            <div class="inputBox form-group">
              <label for="course">Degree Program</label>
              <select class="form-select" name="course" id="course" required>
                <option>Bachelor of Science in Information Technology</option>
                <option>Bachelor of Science in Computer Science</option>
                <option>Bachelor of Science in Information System</option>
                <option>Bachelor of Science in Civil Engineering</option>
                <option>Bachelor of Science in Industrial Technology</option>
              </select>
            </div>
            <div class="inputBox form-group">
              <label for="year_level">Year Level :</label>
              <input type="number" class="form-control" name="year_level" id="year_level" required>
              <div class="invalid-feedback">
                Please enter your year level.
              </div>
            </div>
          </div>
          <div class="col mt-3">
            <h3 class="title">Payment</h3>
            <div class="inputBox">
              <div class="flex">
                <div class="payment-container">
                  <img src="<?= base_url('assets/img/paypal.png') ?>" alt="">
                </div>
                <div class="payment-container">
                  <img src="<?= base_url('assets/img/paypal.png') ?>" alt="">
                </div>
                <div class="payment-container">
                  <img src="<?= base_url('assets/img/paypal.png') ?>" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
          </div>

        </div>
    </form>

  </div>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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