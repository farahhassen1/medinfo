<?php
include "../controller/factureC.php";
$c2 = new payementC();
$result = $c2->listPayement(); // Assuming this returns a PDOStatement object

// Fetch data into an array
$tab2 = $result->fetchAll(PDO::FETCH_ASSOC);

// Check if a search query is provided
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Filter medications based on the search query
    $filtered_medications = array_filter($tab2, function ($payement) use ($search_query) {
        // Customize this condition based on your data structure
        return strpos(strtolower($payement['descreption']), strtolower($search_query)) !== false;
    });

    // Check if any medications are found after filtering
    if (empty($filtered_medications)) {
        // No medications found for the search query
        $no_results_message = "No payement found for '$search_query'";
    }

    // Assign the filtered medications to be displayed
    $display_medications = $filtered_medications;
    $tab2=$display_medications;
} else {
    // If no search query, display all medications
    $display_medications = $tab2;

}
// Check if a sort option is provided
if (isset($_GET['sort_select'])) {
	$sort_option = $_GET['sort_select'];

	// Sort the $display_medications array based on fabricant name
	if ($sort_option === 'az') {
			usort($tab2, function ($a, $b) {
					return strcmp($a['descreption'], $b['descreption']);
			});
	} elseif ($sort_option === 'za') {
			usort($tab2, function ($a, $b) {
					return strcmp($b['descreption'], $a['descreption']);
			});
	}
}
//pagination
$items_per_page = 6;
$total_items = count($tab2);
$total_pages = ceil($total_items / $items_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Get the medications for the current page
$payement_for_page = array_slice($tab2, $offset, $items_per_page);
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
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
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
			<li><a href="backoffice/index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li ><a href="listRDV.php"><em class="fa fa-calendar">&nbsp;</em> Appointement</a></li>
			<li ><a href="listFeedback.php"><em class="fa fa-bar-chart">&nbsp;</em> Feedback</a></li>
			<li class="active"><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Payement</a></li>
			<li ><a href="facture.php"><em class="fa fa-clone">&nbsp;</em> Factures</a></li>
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
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Payment</li>
			</ol>
		</div><!--/.row-->

		<div class="container"> <!-- This container is optional and depends on your overall layout structure -->
    <div class="row justify-content-end">
        <div class="col-md-4"> <!-- Adjust the column size based on your needs -->
            <form role="search" method="GET">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="text" class="form-control" placeholder="Search payment" name="search_query">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

	<center>
    <h1>List of payement</h1>
    <h2>
        <a href="addpayement.php">Add payement</a>
    </h2>
</center>

        <?php if (isset($no_results_message)) { ?>
    <div class="alert alert-info" role="alert"><center>
        <?= $no_results_message; ?></center>
    
<?php 
} ?>
<?php if (!empty($tab2)) { ?>
	<form id="sortForm" method="GET" style="text-align: right;">
            <label for="sort_select">Sort By payement Name:</label>
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
<table class="tab" border="1" align="center" width="70%" class="styled-table" style="margin: 0 auto; margin-right: 100px;">
    <tr>
        <th>Id payement</th>
        <th>date_payement</th>
        <th>description</th>
        <th>image_mp</th>
				<th>id_facture</th>
       
     
    </tr>


    <?php
    foreach ($payement_for_page as $payement) {
    ?>




        <tr>
            <td><?= $payement['id_payement']; ?></td>
            <td><?= $payement['date_payement']; ?></td>
            <td><?= $payement['descreption']; ?></td>
            <td><?= $payement['image_mp']; ?></td>
						<td><?= $payement['id_facture']; ?></td>
           
           
           
           
            
        </tr>
    <?php
    }
    ?>
</table>
<!-- Pagination Links -->
<div style="text-align: center;"  class="pagination">
<?php
// Show the current page number above the pagination links
echo '<p>Page: ' . $current_page . '</p>';

// Calculate the start and end page numbers
$start = max($current_page - 2, 1);
$end = min($current_page + 2, $total_pages);

// Show the first page link
if ($total_pages > 4 && $current_page > 2 && $start != 1) {
    echo '<a href="?page=1">1</a>';
}

// Display ellipsis before the pages if needed
if ($total_pages > 4 && $current_page > 3 && $start > 2) {
    echo '<a class="pagination-ellipsis">...</a>';
}

// Display the page links
for ($i = $start; $i <= $end; $i++) {
    if ($i == $current_page) {
        echo '<span class="active">' . $i . '<sup>*</sup></span>'; // Adding a superscript asterisk for the current page
    } else {
        echo '<a href="?page=' . $i . '" style="margin: 0 10px;">' . $i . '</a>';
    }
}

// Display ellipsis after the pages if needed
if ($total_pages > 4 && $current_page < $total_pages - 2 && $end < $total_pages - 1) {
    echo '<a class="pagination-ellipsis">...</a>';
}

// Show the last page link
if ($total_pages > 4 && $current_page < $total_pages - 1 && $end != $total_pages) {
    echo '<a href="?page=' . $total_pages . '">' . $total_pages . '</a>';
}
}?>

<a href="index.php">front office</a>
				
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
