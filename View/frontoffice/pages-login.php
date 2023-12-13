<?php
require_once('../../config1.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Validate and sanitize input if needed.

        // Check the database for the user with the provided email.
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User found, check password.
            if (password_verify($password, $user['password'])) {
                // Password is correct, log in the user.
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['state'] = $user['state'];
                header('Location: index.php'); // Redirect to a dashboard or home page after login.
                exit();
            } else {
                // Password is incorrect.
                $error = 'Invalid password.';
            }
        } else {
            // User not found.
            $error = 'User not found.';
        }
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>login zone</title>
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

    <main>
    <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.php" class="logo d-flex align-items-center w-auto">
                                    <span class="d-none d-lg-block">Welcome to Medinfo</span>
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">

                                <div class="card-body">

                                  <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your Email & password to login</p>
                                  </div>
                                  <form class="row g-3 needs-validation" novalidate method="post" action="">
                                    
                                  <div class="col-12">
                                      <label for="yourEmail" class="form-label">Your Email</label>
                                      <div class="input-group has-validation">
                                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                                          <input type="email" name="email" class="form-control" id="yourEmail" required value="<?php echo isset($email) ? htmlspecialchars($email, ENT_QUOTES) : ''; ?>">
                                          <div class="invalid-feedback">Please enter your email.</div>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <label for="yourPassword" class="form-label">Password</label>
                                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                                      <div class="invalid-feedback">Please enter your password!</div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            Remember Me
                                        </label>
                                    </div>
                                  </div>
                                      <div class="col-12">
                                          <button class="btn btn-primary w-100" type="submit">Login</button>
                                      </div>
                                      <div class="col-12">
                                          <p class="small mb-0">
                                              Don't have an account? <a href="registration.php">Create an account</a>
                                              | <a href="forgot_password.php">Forgot Password</a>
                                          </p>
                                      </div>
                                  </form>

                                  <?php if (isset($error)) : ?>
                                      <div class="alert alert-danger mt-3" role="alert">
                                          <?php echo $error; ?>
                                      </div>
                                  <?php endif; ?>

                                  </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

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


    

</body>

</html>
