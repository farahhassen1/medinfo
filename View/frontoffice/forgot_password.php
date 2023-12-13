
<?php
$message="";
$valid='true';
include("../../config1.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email_reg = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $query = "SELECT name, email FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email_reg, PDO::PARAM_STR);
    $stmt->execute();
    $details = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($details) {
      //if the given email is in database, ie. registered
        $message_success=" Please check your email inbox or spam folder and follow the steps";
        //generating the random key
        $key=md5(time()+123456789% rand(4000, 55000000));
        //insert this temporary key into database
        $query = "INSERT INTO forget_password (email, temp_key) VALUES (:email, :key)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email_reg, PDO::PARAM_STR);
        $stmt->bindParam(':key', $key, PDO::PARAM_STR);
        $stmt->execute();

        //sending email about update
        $to      = $email_reg;
        $subject = 'Changing password DEMO- psuresh.com.np';
        $msg = "Please copy the link and paste in your browser address bar". "\r\n"."www.psuresh.com.np/misc/forgot-password-php/forgot_password_reset.php?key=".$key."&email=".$email_reg;
        $headers = 'From:Gentle Heart Foundation' . "\r\n";
        mail($to, $subject, $msg, $headers);
    }
    else{
        $message="Sorry! no account associated with this email";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>password reset</title>
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
                            <div class="card mb-3">

                                <div class="card-body">

                                  <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Password reset</h5>
                                    <p class="text-center small">Please enter your email to recover your password</p>
                                  </div>
                                  <form class="row g-3 needs-validation" novalidate method="post" action="">
                                    
                                  <div class="col-12">
                                      <input class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email" required>
                                      <div class="invalid-feedback">Please enter your email.</div>
                                  </div>

                                  <?php if (isset($error)) : ?>
                                        <div class="col-12">
                                          <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span><?php echo $error; ?>
                                          </div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if ($message <> "") : ?>
                                        <div class="col-12">
                                          <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span><?php echo $message; ?>
                                          </div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (isset($message_success)) : ?>
                                        <div class="col-12">
                                          <div class="alert alert-success" role="alert">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span><?php echo $message_success; ?>
                                          </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12">
                                          <button type="submit" class="btn btn-primary pull-right" name="submit"
                                            style="display: block; width: 100%;">Send Email</button>
                                        </div>
                                        <br><br>
                                        <div class="col-12 text-center">
                                          <a href="pages-login.php">Back to Login</a>
                                        </div>
                                      </form>

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
