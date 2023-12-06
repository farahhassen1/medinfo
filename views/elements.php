<?php


include "../controller/medicament_functions.php";
$c = new fabricantc();
$result = $c->listFabricant(); // Assuming this returns a PDOStatement object

// Fetch data into an array
$tab = $result->fetchAll(PDO::FETCH_ASSOC);

// Check if a search query is provided
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Filter medications based on the search query
    $filtered_medications = array_filter($tab, function ($fabricant) use ($search_query) {
        // Customize this condition based on your data structure
        return strpos(strtolower($fabricant['nom_fabricant']), strtolower($search_query)) !== false;
    });

    // Check if any medications are found after filtering
    if (empty($filtered_medications)) {
        // No medications found for the search query
        $no_results_message = "No Fabricant found for '$search_query'";
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
            return strcmp($a['nom_fabricant'], $b['nom_fabricant']);
        });
    } elseif ($sort_option === 'za') {
        usort($display_medications, function ($a, $b) {
            return strcmp($b['nom_fabricant'], $a['nom_fabricant']);
        });
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino UI Elements</title>
	<link href="css2/bootstrap.min.css" rel="stylesheet">
	<link href="css2/font-awesome.min.css" rel="stylesheet">
	<link href="css2/datepicker3.css" rel="stylesheet">
	<link href="css2/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="listmed.css">
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
			<li><a href="index2.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
			<li><a href="medical.php"><em class="fa fa-bar-chart">&nbsp;</em> Medications</a></li>
			<li class="active"><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Fabricants</a></li>
			<li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
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
<!-- ... (previous HTML code) ... -->


<center>
    <h1>Fabricant List</h1>
    
	<h2>
		
	<a href="addfabricant.php">Add a Fabricant</a>
</h2>
</center>
<br><br>

<!--<div style="display: flex; justify-content: space-between;">!-->
<form role="search" method="GET" style="text-align: center;">
    <div class="form-row align-items-center">
        <div class="col-auto">
            <input type="text" class="form-control" placeholder="Search Fabricant" style="width: 200px; display: inline-block;" name="search_query">
            <button type="submit" class="btn btn-primary" style="vertical-align: top;">Search</button>
        </div>
    </div>
</form>


		<?php if (isset($no_results_message)) { ?>
    <div class="alert alert-info" role="alert"><center>
        <?= $no_results_message; ?></center>
    </div>
<?php } ?>
<?php if (!empty($display_medications)) { ?>
	<br><br><br>
	<form id="sortForm" method="GET" style="text-align: center;">
            <label for="sort_select">Sort By Fabricant Name:</label>
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
<?php
// ... (Previous code remains unchanged)

// Pagination configuration
$results_per_page = 6; // Number of fabricants per page

// Calculate total number of pages
$total_results = count($display_medications);
$total_pages = ceil($total_results / $results_per_page);

// Determine current page number (default to 1)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting fabricant index for the current page
$start_index = ($current_page - 1) * $results_per_page;

// Display fabricants for the current page
?>


</div>
    <table border="1" align="center" width="70%" class="styled-table" style="margin: 0 auto; margin-right: 100px;">
        <tr>
            <th>Fabricant ID</th>
            <th>Fabricant Name</th>
            <th>Adress</th>
            <th>Contact</th>
			<th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
$start_index = ($current_page - 1) * $results_per_page;
$end_index = $start_index + $results_per_page;
$display_fabricants = array_slice($display_medications, $start_index, $results_per_page);

foreach ($display_fabricants as $fabricants) { ?>
    <tr>
        <td><?= $fabricants['id_fabricant']; ?></td>
        <td><?= $fabricants['nom_fabricant']; ?></td>
        <td><?= $fabricants['adress_fabricant']; ?></td>
        <td><?= $fabricants['contact']; ?></td>
        <td align="center">
            <form method="POST" action="updatefabricant.php">
                <input type="submit" name="update" value="Update">
                <input type="hidden" value=<?= $fabricants['id_fabricant']; ?> name="id_fabricant">
            </form>
        </td>
        <td>
            <a href="dropfabricant.php?id_fabricant=<?= $fabricants['id_fabricant']; ?>">Delete</a>
        </td>
    </tr>
<?php } ?>

    </table>
	<!-- Display Pagination Links -->
<div style="text-align: center;">
    <?php for ($page = 1; $page <= $total_pages; $page++) { ?>
        <a href="?page=<?= $page ?>" <?php if ($page == $current_page) echo 'style="font-weight:bold;"'; ?>>
            <?= $page ?>
        </a>
    <?php } ?>
<?php } ?>
	</div>
   <center>
<a href="index.php">Go Back to Client's space</a><br><br><br></center>
<!-- ... (rest of the HTML code) ... -->

</body>
</html>
