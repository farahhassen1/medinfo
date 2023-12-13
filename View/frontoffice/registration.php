<?php
require_once('../../config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>User Registration | PHP</title>
	<link rel="stylesheet" type="text/css" href="myassets/css/bootstrap.min.css">

	<meta content="" name="description">
	<meta content="" name="keywords">

    <!-- window logo -->
	<link href="img/download.png" rel="icon">
	<link href="img/download.png" rel="apple-touch-icon">
	
	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="myassets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="myassets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="myassets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="myassets/assets/vendor/quill/quill.snow.css" rel="stylesheet">
	<link href="myassets/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
	<link href="myassets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="myassets/assets/vendor/simple-datatables/style.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="myassets/assets/css/style.css" rel="stylesheet">

</head>
<body>

		<div>
			<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

						<div class="d-flex justify-content-center py-4">
							<a href="index.php" class="logo d-flex align-items-center w-auto">

								<span class="d-none d-lg-block">Registration Form</span>
							</a>
						</div>

						<div class="card mb-3">

							<div class="card-body">

								<div class="pt-4 pb-2">
									<h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
									<p class="text-center small">Enter your personal details to create account</p>
								</div>

								<form class="row g-3 needs-validation" novalidate>
									<div class="col-12">
										<label for="name" class="form-label">Your Name</label>
										<input type="text" name="name" class="form-control" id="name" required>
										
										<div class="invalid-feedback">Please, enter your name!</div>
									</div>
									
									<div class="col-12">
										<label for="username" class="form-label">Username</label>
										<div class="input-group has-validation">
											<input type="text" name="username" class="form-control" id="username" required>
											<div class="invalid-feedback">Please choose a username.</div>
										</div>
									</div>

									<div class="col-12">
										<label for="email" class="form-label">Your Email</label>
										<input type="email" name="email" class="form-control" id="email" required>
										<div class="invalid-feedback">Please enter a valid Email adddress!</div>
									</div>

									<div class="col-12">
										<label for="password" class="form-label">Password</label>
										<input type="password" name="password" class="form-control" id="password" required>
										<div class="invalid-feedback">Please enter your password!</div>
									</div>

									<div class="col-12">
									<input class="btn btn-primary w-100" type="submit" id="register" name="create" value="Sign Up">
									</div>
									<div class="col-12">
										<p class="small mb-0">Already have an account? <a href="pages-login.php">Log in</a></p>
									</div>
								</form>
							</div>
						</div>
				</div>
			</div>
	

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="myassets/assets/vendor/apexcharts/apexcharts.min.js"></script>
	<script src="myassets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="myassets/assets/vendor/chart.js/chart.umd.js"></script>
	<script src="myassets/assets/vendor/echarts/echarts.min.js"></script>
	<script src="myassets/assets/vendor/quill/quill.min.js"></script>
	<script src="myassets/assets/vendor/simple-datatables/simple-datatables.js"></script>
	<script src="myassets/assets/vendor/tinymce/tinymce.min.js"></script>
	<script src="myassets/assets/vendor/php-email-form/validate.js"></script>

	<!-- Template Main JS File -->
	<script src="myassets/assets/js/main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script type="text/javascript">
    $(function () {
        $('#register').click(function (e) {
            var valid = this.form.checkValidity();

            if (valid) {
                var name = $('#name').val();
                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val();

                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'process.php',
                    data: { name: name, username: username, email: email, password: password },
                    success: function (data) {
                        Swal.fire({
                            'title': 'Successful',
                            'text': data,
                            'type': 'success'
                        });

                        // Redirect to pages-login.php with a 2-second delay
                        setTimeout(function () {
                            window.location.href = 'pages-login.php';
                        }, 2000); // 2000 milliseconds = 2 seconds
                    },
                    error: function (data) {
                        Swal.fire({
                            'title': 'Errors',
                            'text': 'There were errors while saving the data.',
                            'type': 'error'
                        });
                    }
                });
            } else {
                // Handle invalid form data if needed
            }
        });
    });
</script>
</body>
</html>