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

<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Title -->
        <title>Mediplus - Free Medical and Doctor Directory HTML Template.</title>
		
		<!-- Favicon -->
        <link rel="icon" href="img/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
		
    </head>
    <body>
	
		<!-- Preloader -->

        
        <!-- End Preloader -->
		
		
	
		<!-- Header Area -->
		<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="#">About</a></li>
								<li><a href="#">Doctors</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">FAQ</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+880 1234 56789</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">support@yourmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.php"><img src="img/logo.png" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li class="active"><a href="#">Home <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="index.php">Home Page 1</a></li>
												</ul>
											</li>
											<li><a href="#">Doctos </a></li>
											<li><a href="#">Services </a></li>
											<li><a href="listpayement.php">payement <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listFacture.php">facture</a></li>
												</ul>
											</li>
											<li><a href="#">Blogs <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="blog-single.html">Blog Details</a></li>
												</ul>
											</li>
											<li><a href="contact.html">Contact Us</a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
									<a href="appointment.html" class="btn">Book Appointment</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <div style="text-align: right;">
    <a href="form.php" target="_blank" style="display: inline-block; margin-right: 1200px;">
        <img src="pdf2.png" alt="Export PDF" width="80" height="80" />
    </a>
</div>




<center>
    <h1>List of facture</h1>
    <h2>
        <a href="addFacture.php">Add facture</a>
    </h2>
</center>
<div style="display: flex; justify-content: space-between;">
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
    </div>
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
        <th>update</th>
        <th>delete</th>
       
        
    </tr>
    

    <?php
    foreach ($facture_for_page as $facture) {
    ?>




        <tr>
            <td><?= $facture['id_facture']; ?></td>
            <td><?= $facture['montant']; ?></td>
            <td><?= $facture['date_facture']; ?></td>
            <td><?= $facture['descreption']; ?></td>
           
            <td align="center">
                <form method="POST" action="updatefacture.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $facture['id_facture']; ?> name="id_facture">
                </form>
            </td>
           
           
            <td>
                <a class="btn" href="deleteFacture.php?id_facture=<?php echo $facture['id_facture']; ?>">Delete</a>
            </td>
           
           
        </tr>
        
    <?php
    }
    ?>
   
  
<!-- Pagination Links -->
<div style="text-align: center;" class="pagination">
  <!-- Your PHP pagination code here -->
</div>

</table>
<div style="text-align: right;">
    <a href="form2.php" target="_blank" style="display: inline-block; margin-right: 0px;margin-top:400px">
        <img src="download.png" alt="Export PDF" width="70" height="70" />
    </a>
</div>
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
 <div style="text-align: left; margin-top: 20px;">
  <a href="facture.php">Go to admin space</a>
  
</div>









