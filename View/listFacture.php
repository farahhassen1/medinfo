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

<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="frontoffice/css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="frontoffice/css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="frontoffice/css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="frontoffice/css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="frontoffice/css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="frontoffice/css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="frontoffice/css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="frontoffice/css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="frontoffice/css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="frontoffice/css/normalize.css">
        <link rel="stylesheet" href="frontoffice/style.css">
        <link rel="stylesheet" href="frontoffice/css/responsive.css">
        </head>
        <style>
            .btn1 {
	color: #fff;
	padding: 13px 25px;
	font-size: 14px;
	text-transform: capitalize;
	font-weight: 500;
	background: #d11a88;
	position: relative;
	box-shadow: none;
	display: inline-block;
	-webkit-transition: all 0.4s ease;
	-moz-transition: all 0.4s ease;
	transition: all 0.4s ease;
	-webkit-transform: perspective(1px) translateZ(0);
	transform: perspective(1px) translateZ(0);
	border: none;
	border-radius: 0;
	border-radius:4px;
}
            </style>

<body>
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
                    <li><i class="fa fa-phone"></i>+216 71 458 225</li>
                    <li><i class="fa fa-envelope"></i><a href="mailto:MedInfo@gmail.com">MedInfo@gmail.com</a></li>
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
									<a href="index.php"><img src="frontoffice/img/logo.png" alt="#"></a>
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
											<li class="active"><a href="frontoffice/index.php">Home <i class="icofont-rounded-down"></i></a>
											<li><a href="#">Doctos </a></li>
											<li><a href="#">Services </a></li>
											<li><a href="listMesRDV.php">My appointments <i class="icofont-rounded-down"></i></a>
											</li>
											<li><a href="listpayement.php">payement <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listFacture.php">facture</a></li>
											
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
								<a href="addRDV.php" class="btn">Get Appointment</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
        <br>

<div style="text-align: right;">
    <a href="form.php" target="_blank" style="display: inline-block; margin-right: 1200px;">
       <button  class="btn">Generate PDF</button>
    </a>
</div>

<form role="search" method="GET" style="width: 70%; margin: 20px;">
    <div class="form-row align-items-center justify-content-end">
        <div class="col-md-4">
            <!-- Adding label for better accessibility -->
            <label for="search_query" class="sr-only">Search Payment</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" id="search_query" placeholder="Search payment" style="width: 100%;" name="search_query">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
<center>
    <h1>List of facture</h1>
    <h2>
        <a href="addFacture.php">Add facture</a>
    </h2>
</center>
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
<table class="tab" border="1" align="center" width="40%">
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
                <form method="POST"  action="updatefacture.php">
                    <input type="submit" name="update" value="Update" class="btn1">
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
   </table>
   <div style="text-align: right;">
    <a href="form2.php" target="_blank">
       <button  class="btn"> Generate QRCODE</button>
    </a>
</div>
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
        <script>
    document.getElementById('sort_select').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
    });
</script>
        <footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>About Us</h2>
								<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut labore dolore magna.</p>
								<!-- Social -->
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
									<li><a href="#"><i class="icofont-google-plus"></i></a></li>
									<li><a href="#"><i class="icofont-twitter"></i></a></li>
									<li><a href="#"><i class="icofont-vimeo"></i></a></li>
									<li><a href="#"><i class="icofont-pinterest"></i></a></li>
								</ul>
								<!-- End Social -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Quick Links</h2>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Cases</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Other Links</a></li>	
										</ul>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Consuling</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Finance</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Testimonials</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>	
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Open Hours</h2>
								<p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.</p>
								<ul class="time-sidual">
									<li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
									<li class="day">Saturday <span>9.00-18.30</span></li>
									<li class="day">Monday - Thusday <span>9.00-15.00</span></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Newsletter</h2>
								<p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
								<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
									<input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Your email address'" ="" type="email">
									<button class="button"><i class="icofont icofont-paper-plane"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright 2021 |  All Rights Reserved by <a href="https://www.wpthemesgrid.com" target="_blank">wpthemesgrid.com</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
</body>
</html>


