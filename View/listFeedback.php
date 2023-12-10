<?php
include "../Controller/FeedbackC.php";

$c=new feedbackC();
$tab=$c->listFeedback();
?>
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
	<style>
    /* Add the CSS styles here */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #edf5fc; /* Light Blue Background Color */
    }
    th,td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #b3d9f2; /* Light Blue Border Color */
    }

    th {
        background-color: #b3d9f2; /* Dark Green Header Background Color */
        color: #fff;
    }

    tr:hover {
        background-color: #d9edf7; /* Slightly Darker Blue on Hover */
    }

    .update-button,
    .delete-button {
        display: inline-block;
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .update-button {
        background-color: #2aabd2; /* Light Blue for Update Button */
        color: #fff;
    }

    .delete-button {
        background-color: #e74c3c; /* Light Red for Delete Button */
        color: #fff;
    }

    .update-button:hover,
    .delete-button:hover {
        background-color: #1d7ea6; /* Slightly Darker Blue on Hover */
    }

    /* Add this to include Font Awesome icons */
    .fa {
        margin-right: 5px;
    }
        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 20px 0;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 5px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #333;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: #f5f5f5;
        }

        .pagination .active {
            background-color: #337ab7;
            color: #fff;
        }

        .pagination-ellipsis {
            padding: 8px 12px;
            margin: 0 5px;
            color: #777;
        
        }
    /* Updated CSS styles for the select dropdown and button */
form {
    display: flex;
    align-items: center;
    justify-content: center; /* Center the form horizontally */
    margin-bottom: 20px;
    text-align: center; /* Center the text within the form */
}

label {
    margin-right: 10px;
}

select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: border-color 0.3s;
}

select:hover,
select:focus {
    border-color: #337ab7;
}

button {
    background-color: #337ab7;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

button:hover {
    background-color: #23527c;
}
	</style>	
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
<div style="width:100%; margin-left:60px;margin-bottom:50px;">
<center>
<h1>List of feedback</h1>
  <br>
</center>
<table border="1"style="width:70%; margin-left:250px; ">
    <tr>
        <th>Id feedback</th>
        <th>date</th>
        <th>Commentaire</th>
		<th>IdRDV</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $feedback) {
    ?>

        <tr>
            <td><?= $feedback['idFeedback']; ?></td>
            <td><?= $feedback['date']; ?></td>
            <td><?= $feedback['commentaire']; ?></td>
			<td><?= $feedback['rdv']; ?></td>
            <td align="center">
                <form method="POST" action="updateFeedback.php" class="update-button">
				<button type="submit" class="update-button" name="update">
                            <i class="fa fa-pencil"></i> Update
                        </button>
                    <input type="hidden" value=<?PHP echo $feedback['idFeedback']; ?> name="idFeedback">
                </form>
            </td>
            <td>
                <a class="delete-button" href="deleteFeedback.php?id=<?php echo $feedback['idFeedback']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
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
			<li><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Payement</a></li>
			<li ><a href="facture.php"><em class="fa fa-clone">&nbsp;</em> Factures</a></li>
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