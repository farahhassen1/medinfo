<?php
include "../controller/medicament_functions.php";
$c = new medicamentC();
$result = $c->listMedicament(); // Assuming this returns a PDOStatement object

// Fetch data into an array
$tab = $result->fetchAll(PDO::FETCH_ASSOC);
$c2 = new fabricantc();
$stmt = $c2->listFabricant(); // Assuming this returns a PDOStatement object
$tab2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Check if a search query is provided
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Filter medications based on the search query
    $filtered_medications = array_filter($tab, function ($medicament) use ($search_query) {
        // Customize this condition based on your data structure
        return strpos(strtolower($medicament['nom_medicament']), strtolower($search_query)) !== false;
    });

    // Check if any medications are found after filtering
    if (empty($filtered_medications)) {
        // No medications found for the search query
        $no_results_message = "No medications found for '$search_query'";
    }

    // Assign the filtered medications to be displayed
    $display_medications = $filtered_medications;
} else {
    // If no search query, display all medications
    $display_medications = $tab;
}


// Check if a sort option is provided
if (isset($_GET['sort_select'])) {
    $sort_option = $_GET['sort_select'];

    // Sort the $display_medications array based on fabricant name
    if ($sort_option === 'az') {
        usort($display_medications, function ($a, $b) {
            return strcmp($a['nom_medicament'], $b['nom_medicament']);
        });
    } elseif ($sort_option === 'za') {
        usort($display_medications, function ($a, $b) {
            return strcmp($b['nom_medicament'], $a['nom_medicament']);
        });
    }
}


?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="update.css"><link rel="stylesheet" href="listmed.css">
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Dashboard</title>
	<link href="backoffice/css/bootstrap.min.css" rel="stylesheet">
	<link href="backoffice/css/font-awesome.min.css" rel="stylesheet">
	<link href="backoffice/css/datepicker3.css" rel="stylesheet">
	<link href="backoffice/css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="pp.css">
	
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
				<a class="navbar-brand" href="#"><span>Med-info </span>Admin space</a>
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
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Admin</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="backoffice/useredit.php"><em class="fa fa-calendar">&nbsp;</em> User Edit</a></li>
			<li class="active"><a href="medical.php"><em class="fa fa-dashboard">&nbsp;</em> Medications</a></li>
			<li ><a href="backfabricant.php"><em class="fa fa-dashboard">&nbsp;</em> Fabricant</a></li>
			<li ><a href="listRDV.php"><em class="fa fa-calendar">&nbsp;</em> Appointement</a></li>
			<li ><a href="listFeedback.php"><em class="fa fa-bar-chart">&nbsp;</em> Feedback</a></li>
			<li><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Payement</a></li>
			<li ><a href="facture.php"><em class="fa fa-clone">&nbsp;</em> Factures</a></li>
			<li ><a href="articlesdb.php"><em class="fa fa-clone">&nbsp;</em> Articles</a></li>
			<li><a  href="backanis.php"><em class="fa fa-clone">&nbsp;</em> Prescriptions</a></li>
			<li><a href="backoffice/login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
	
        <!-- ... (rest of the sidebar content) ... -->
    </div><!--/.sidebar-->

    <div class="main">
        <!-- ... (other content) ... -->
        <center>
            <h1>Medication List</h1>
						<a href="addmedicament.php">
			<button class="health-theme-button">Add Medication</button>
		</a>
        </center>
		<br><br>
		<form role="search" method="GET" style="text-align: center;">
    <div class="form-row align-items-center">
        <div class="col-auto">
            <input type="text" class="form-control" placeholder="Search Medicament" style="width: 200px; display: inline-block;" name="search_query">
            <button type="submit" class="btn btn-primary" style="vertical-align: top;">Search</button>
        </div>
    </div>
</form>

<br><br><br>
		<?php if (isset($no_results_message)) { ?>
    <div class="alert alert-info" role="alert"><center>
        <?= $no_results_message; ?></center>
    </div>
<?php } ?>
<?php if (!empty($display_medications)) { ?>
	<form id="sortForm" method="GET" style="text-align: center;">
            <label for="sort_select">Sort By Medication Name:</label>
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

    <table border="1" align="center" width="70%" class="styled-table" style="margin: 0 auto; margin-right: 100px;">
        <tr>
            <th>Medication ID</th>
            <th>Medication Name</th>
            <th>Fabricant Name</th>
            <th >Expiration Date</th>
			<th>Rating</th>
            <th>Update</th>
			<th>Delete</th>
			
        </tr>
        <?php foreach ($display_medications as $medicaments) { ?>
            <tr>
                <td><?= $medicaments['id_medicament']; ?></td>
                <td><?= $medicaments['nom_medicament']; ?></td>
                <?php
        $fabricantId = $medicaments['id_fabricant'];
        $fabricantName = 'Unknown'; // Default value if not found

        // Check if fabricantId exists in tab2 array and retrieve the name
        $found = false; // Flag to check if found

        foreach ($tab2 as $fabricants) {
            if ($fabricantId == $fabricants['id_fabricant']) {
                $fabricantName = $fabricants['nom_fabricant'];
                $found = true;
                break; // Stop the loop once found
            }
        }

        if (!$found) {
            echo "Medicament ID: " . $medicaments['id_medicament'] . " | Fabricant ID $fabricantId not found in tab2 array!<br>";
            // Check the contents of $tab2 array for debugging purposes
            var_dump($tab2);
            // You can add additional debugging information here
        }
        ?>
        <td><?= $fabricantName; ?></td>
                <td><?= $medicaments['date_prescription']; ?></td>
				<td>
    <div class="rating" data-medication-id="<?= $medicaments['id_medicament']; ?>">
        <span class="star" data-value="1">☆</span>
        <span class="star" data-value="2">☆</span>
        <span class="star" data-value="3">☆</span>
        <span class="star" data-value="4">☆</span>
        <span class="star" data-value="5">☆</span>

    </div>
</td>

                <td align="center">
                    <form method="POST" action="updatemedicament.php">
					<center>
					<div class="wrapper1">
						<button  class="delete-link" type="submit" >Update
						</button></div></center>
                        <input type="hidden" value=<?= $medicaments['id_medicament']; ?> name="id_medicament">
                    </form>
                </td>
                <td>
				<div class="wrapper2"><center>
                    <a href="dropmedicament.php?id_medicament=<?= $medicaments['id_medicament']; ?>" class="delete-link"><span>Delete</span></a>
	</center></div></td>
            </tr>
        <?php }} ?>
		
		
	</center>
	
    </table>
	
        <center><a href="index.php">Go back to client's space</a></center>
        <br><br><br>
    </div><!--/.main-->

<br><br><br>

			
		</div><!--/.row-->
	</div>	<!--/.main-->
	  
	<script src="rating.js"></script>
	<script src="js2/jquery-1.11.1.min.js"></script>
	<script src="js2/bootstrap.min.js"></script>
	<script src="js2/chart.min.js"></script>
	<script src="js2/chart-data.js"></script>
	<script src="js2/easypiechart.js"></script>
	<script src="js2/easypiechart-data.js"></script>
	<script src="js2/bootstrap-datepicker.js"></script>
	<script src="js2/custom.js"></script>
	<script>
	window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart5 = document.getElementById("radar-chart").getContext("2d");
	window.myRadarChart = new Chart(chart5).Radar(radarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.05)",
	angleLineColor: "rgba(0,0,0,.2)"
	});
	var chart6 = document.getElementById("polar-area-chart").getContext("2d");
	window.myPolarAreaChart = new Chart(chart6).PolarArea(polarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	segmentShowStroke: false
	});
};
	</script>	
</body>
</html>
