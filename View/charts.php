<?php

include '../controller/PrescriptionController.php';

$prescriptionController = new PrescriptionController();
$prescriptions = $prescriptionController->listPrescriptions();
$typepController = new typepController();
$prescriptionTypes = $typepController->listtypep();
// Check if a search query is provided
// Check if a search query is provided
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Filter prescriptions based on the search query
    $filtered_prescriptions = array_filter($prescriptionTypes, function ($prescription) use ($search_query) {
        // Customize this condition based on your data structure
        return stripos($prescription['typename'], $search_query) !== false;
    });

    // Assign the filtered prescriptions to be displayed
    $prescriptionTypes = $filtered_prescriptions;

    // Check if any prescriptions are found after filtering
    if (empty($prescriptionTypes)) {
        // No prescriptions found for the search query
        $no_results_message = "No Prescription found for '$search_query'";
    }
}




if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Filter prescriptions based on the search query
    $filtered_prescriptions = array_filter($prescriptionTypes, function ($prescription) use ($search_query) {
        // Customize this condition based on your data structure
        return stripos($prescription['typename'], $search_query) !== false;
    });

    // Check if any prescriptions are found after filtering
    if (empty($filtered_prescriptions)) {
        // No prescriptions found for the search query
        $no_results_message = "No Patient found for '$search_query'";
    } else {
        // Assign the filtered prescriptions to be displayed
        $prescriptionTypes = $filtered_prescriptions;
    }
}


// Check if a sort option is provided
if (isset($_GET['sort_select'])) {
    $sort_option = $_GET['sort_select'];

    // Sort the $prescriptionTypes array based on fabricant name
    if ($sort_option === 'az') {
        usort($prescriptionTypes, function ($a, $b) {
            return strcmp($a['typename'], $b['typename']);
        });
    } elseif ($sort_option === 'za') {
        usort($prescriptionTypes, function ($a, $b) {
            return strcmp($b['typename'], $a['typename']);
        });
    }
}
?>
<!DOCTYPE html>
<html>
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
</head>
<body>
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
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="img/slimen.jpg" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Dr.Slimen Labyedh</div>
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
		<li ><a href="medical.php"><em class="fa fa-dashboard">&nbsp;</em> Medications</a></li>
            <li ><a href="backfabricant.php"><em class="fa fa-dashboard">&nbsp;</em> Fabricant</a></li>
			<li ><a href="listRDV.php"><em class="fa fa-calendar">&nbsp;</em> Appointement</a></li>
			<li ><a href="listFeedback.php"><em class="fa fa-bar-chart">&nbsp;</em> Feedback</a></li>
			<li ><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Payement</a></li>
			<li ><a href="facture.php"><em class="fa fa-clone">&nbsp;</em> Factures</a></li>
            <li class="active"><a href="charts.php"><em class="fa fa-bar-chart">&nbsp;</em> prescription Types</a></li>
			<li ><a href="backAnis.php"><em class="fa fa-toggle-off">&nbsp;</em>prescription</a></li>
            <li ><a href="articlesdb.php"><em class="fa fa-clone">&nbsp;</em> Articles</a></li>
			<li><a href="panels.php"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
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
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Forms</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">prescription Types</h1>
			</div>
		</div><!--/.row-->
	
		
		<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include your existing CSS links here -->

    <style>
        /* Add your custom table styles here */
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db; /* Change to your preferred color */
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #3498db; /* Change to your preferred color */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <a href="addtypep.php">Add type</a>
	<form role="search" method="GET">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" class="form-control" placeholder="Search Patient Name" style="width: 200px;" name="search_query">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

	<form id="sortForm" method="GET" style="text-align: center;">
            <label for="sort_select">Sort By Type Name:</label>
            <select name="sort_select" id="sort_select" class="btn btn-primary">
                <option value="az" <?php if (isset($_GET['sort_select']) && $_GET['sort_select'] === 'az') echo 'selected'; ?>>
                    A to Z
                </option>
                <option value="za" <?php if (isset($_GET['sort_select']) && $_GET['sort_select'] === 'za') echo 'selected'; ?>>
                    Z to A
                </option>
            </select>
        </form>
        <script>
    document.getElementById('sort_select').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
    });
</script>
    <table border="1" align="center" width="70%">
        <tr>
            <th>ID</th>
            <th>Type Name</th>
            <th>Type Description</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
    foreach ($prescriptionTypes as $prescriptionTypes) {
    ?>
        <tr>
            <td><?= $prescriptionTypes['idtype']; ?></td>
            <td><?= $prescriptionTypes['typename']; ?></td>
            <td><?= $prescriptionTypes['typedescription']; ?></td>
            <td align="center">
                <form method="POST" action="updatetypep.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $prescriptionTypes['idtype']; ?> name="idtype">
                </form>
            </td>
            <td>
                <a href="deletetypep.php?idtype=<?php echo $prescriptionTypes['idtype']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
        
    </table>
	<?php if (isset($no_results_message)) { ?>
    <div class="alert alert-info" role="alert">
        <?= $no_results_message; ?>
    </div>
<?php } ?>
</body>

</html>


<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
