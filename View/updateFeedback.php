<?php

include '../Controller/FeedbackC.php';
include '../Model/Feedback.php';

$error = "";

// create client
$feedback= null;
// create an instance of the controller
$feedbackC = new feedbackC();

if (isset($_POST["date"])  && isset($_POST["commentaire"]))
 {
    if (!empty($_POST['date']) && !empty($_POST["commentaire"]))
     {
        /*foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }*/
        $feedback = new feedback( null, $_POST['date'], $_POST['commentaire']);
        //var_dump($rdv);
        $feedbackC->updateFeedback($feedback, $_POST['idFeedback']);
        header('Location:listFeedback.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Dashboard</title>
	<link href="backoffice/css/bootstrap.min.css" rel="stylesheet">
	<link href="backoffice/css/font-awesome.min.css" rel="stylesheet">
	<link href="backoffice/css/datepicker3.css" rel="stylesheet">
	<link href="backoffice/css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <title>User Display</title>
    <style>
   main {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-left: 250px;
            padding: 20px;
        }

        .formulaire {
            border: 1px solid black;
            width: 50%; /* Ajustez la largeur du formulaire selon vos besoins */
            padding: 30px;
            box-sizing: border-box;
        }

        img {
            width: 60%; /* Ajustez la largeur de l'image selon vos besoins */
            padding: 50px;
            
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        span.error {
            color: red;
        }

        div.buttons {
            text-align: right;
        }
</style>
    <title>User Display</title>
</head>

<body>
<div>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>MedInfo</span>Admin</a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-envelope"></em><span class="label label-danger">15</span>
					</a>
						<ul class="dropdown-menu dropdown-messages">
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">3 mins ago</small>
										<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
									<br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="#">
									<em class="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info">5</span>
					</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="#">
								<div><em class="fa fa-envelope"></em> 1 New Message
									<span class="pull-right text-muted small">3 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
</div>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idFeedback'])) {
        $feedback= $feedbackC->showFeedback($_POST['idFeedback']);  
    ?>
    <center style="width:70%; margin-left:150px;">
    <h1>You can modify the feedback</h1>
  <br>
</center>
         <main style="width:70%; margin-left:250px;" >
        <form action="" method="POST" onsubmit="return validateForm()" class="formulaire"  >
                <input type="text" id="idFeedback" name="idFeedback" value="<?php echo $_POST['idFeedback'] ?>" readonly />
                <span id="erreurIdfeedback" style="color: red"></span>
            <br>
                <label for="date">Date :</label>
                <input type="datetime" id="date" name="date" value="<?php echo $feedback['date'] ?>" readonly />
                        <span id="erreurDate" style="color: red"></span>
                <br>
                <span id="dateError" style="color: red;"></span>

                <br>
                <label for="commentaire">feedback:</label></td>
                <input type="text" id="commentaire" name="commentaire" value="<?php echo $feedback['commentaire'] ?>" />
                <span id="commentaireError" style="color: red"></span>

                <div >
                    <input type="submit" value="Save">
                    <input type="reset" value="Reset">
                </div>
		</form>
        <img src="image1.png" alt="Image Médicale">
    </main>
       
    <?php
    }
    ?>
       <script>
        function validateForm() {
			var commentaire=document.getElementById("commentaire").value;
			var commentaireError = document.getElementById("commentaireError");
			commentaireError.innerHTML = "";
            var isValid = true;
			if (!commentaire) {
                commentaireError.innerHTML = "ce champ ne peut pas être vide.";
                isValid = false;
            }

            return isValid;
        }
    </script>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li ><a href="backoffice/index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li ><a href="listRDV.php"><em class="fa fa-calendar">&nbsp;</em> Appointement</a></li>
			<li class="active"><a href="listFeedback.php"><em class="fa fa-bar-chart">&nbsp;</em> Feedback</a></li>
			<li><a href="backoffice/elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
			<li><a href="backoffice/panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li>
			<li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
</body>

</html>