<?php
include "../controller/factureC.php";

$c = new factureC();
$result = $c->listFacture();


// Fetch data into an array
$tab = $result->fetchAll(PDO::FETCH_ASSOC);

// Check if a search query is provided
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Filter medications based on the search query
    $filtered_medications = array_filter($tab, function ($facture) use ($search_query) {
        // Customize this condition based on your data structure
        return strpos(strtolower($facture['descreption']), strtolower($search_query)) !== false;
    });

    // Check if any medications are found after filtering
    if (empty($filtered_medications)) {
        // No medications found for the search query
        $no_results_message = "No facture found for '$search_query'";
    }

    // Assign the filtered medications to be displayed
    $display_medications = $filtered_medications;
    $tab=$display_medications;
} else {
    // If no search query, display all medications
    $display_medications = $tab;

}
// Check if a sort option is provided
if (isset($_GET['sort_select'])) {
	$sort_option = $_GET['sort_select'];

	// Sort the $display_medications array based on fabricant name
	if ($sort_option === 'az') {
			usort($tab, function ($a, $b) {
					return strcmp($a['descreption'], $b['descreption']);
			});
	} elseif ($sort_option === 'za') {
			usort($tab, function ($a, $b) {
					return strcmp($b['descreption'], $a['descreption']);
			});
	}
}
//pagination
$items_per_page = 6;
$total_items = count($tab);
$total_pages = ceil($total_items / $items_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Get the medications for the current page
$facture_for_page = array_slice($tab, $offset, $items_per_page);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Widgets</title>
	<link href="css2/bootstrap.min.css" rel="stylesheet">
	<link href="css2/font-awesome.min.css" rel="stylesheet">
	<link href="css2/datepicker3.css" rel="stylesheet">
	<link href="css2/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="listart.css">
<link rel="stylesheet" href="displycss.css">
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
				<a class="navbar-brand" href="index2.php"><span>Med</span>Info</a>
				
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
			<li><a href="#"><em class="fa fa-calendar">&nbsp;</em> article</a></li>
			<li class="active"><a href="facture.php"><em class="fa fa-bar-chart">&nbsp;</em> factures</a></li>
			<li><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Payement</a></li>
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
				<li class="active">Widgets</li>
			</ol>
		</div><!--/.row-->
		
		<center>
    <h1>List of facture</h1>
    <h2>
        <a href="addFacture.php">Add facture</a>
    </h2>
</center>
    <form role="search" method="GET">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" class="form-control" placeholder="Search payement" style="width: 200px;" name="search_query">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>


        <?php if (isset($no_results_message)) { ?>
    <div class="alert alert-info" role="alert"><center>
        <?= $no_results_message; ?></center>

<?php 
} ?>
<?php if (!empty($tab)) { ?>
	<form id="sortForm" method="GET" style="text-align: right;">
            <label for="sort_select">Sort By facture Name:</label>
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
<br>
<table class="tab" border="1" align="center" width="70%">
    <tr>
        <th>Id Facture</th>
        <th>montant</th>
        <th>date</th>
        <th>description</th>
        
     
    </tr>


    <?php
    foreach ($facture_for_page as $facture) {
    ?>




        <tr>
            <td><?= $facture['id_facture']; ?></td>
            <td><?= $facture['montant']; ?></td>
            <td><?= $facture['date_facture']; ?></td>
            <td><?= $facture['descreption']; ?></td>
						
           
             
           
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
						
			<div class="col-sm-12">
			
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	  

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js2/bootstrap.min.js"></script>
	<script src="js2/chart.min.js"></script>
	<script src="js2/chart-data.js"></script>
	<script src="js2/easypiechart.js"></script>
	<script src="js2/easypiechart-data.js"></script>
	<script src="js2/bootstrap-datepicker.js"></script>
	<script src="js2/custom.js"></script>
	
</body>
</html>