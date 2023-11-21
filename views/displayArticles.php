<!-- displayArticles.php -->
<?php
// Include necessary files and classes
include "../controller/ArticleC.php";

$c = new ArticleC();
// Fetch articles as an array
$articles = $c->listArticle()->fetchAll(PDO::FETCH_ASSOC);
// Sort the articles by date in descending order
usort($articles, function($a, $b) {
    return strtotime($b['datepubliarticle']) - strtotime($a['datepubliarticle']);
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="displayart.css"> <!-- Create a new CSS file for styling the display -->
    <title>Display Articles</title>
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
    <style>


.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

.article-container {
    border: 2px solid #3498db;
    border-radius: 10px;
    margin: 20px 0; /* Adjusted margin to separate articles */
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    max-width: calc(100% - 40px); /* Adjusted max-width */
    min-height: 250px; /* Adjusted min-height */
}

.article-container h2 {
    color: #3498db;
    margin: 10px 0;
}

.article-container .date {
    color: #555;
    font-size: 14px;
    margin-bottom: 10px;
}

.article-container p {
    margin: 0 0 15px;
}

.back-button {
    text-align: center;
    margin-top: 20px;
}



.button:hover {
    background-color: #c0392b;
}

.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    z-index: 1;
}

.popup-container {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    z-index: 2;
    max-width: 80%;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
    color: #333;
}

#popup-title {
    color: #333;
    margin-bottom: 10px;
}

#popup-content {
    color: #555;
    margin-bottom: 15px;
}

#comment-input {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    resize: vertical;
}

#comment-input:focus {
    outline: none;
    border-color: #3498db;
}

#submit-comment {
    display: block;
    width: 100%;
    padding: 12px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    color: #fff;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

#submit-comment:hover {
    background-color: #2980b9;
}
.right-bar {
        position: fixed;
        top: 0;
        right: -300px;
        width: 300px;
        height: 100%;
        background-color: #3498db;
        border-radius: 0 10px 10px 0;
        transition: right 0.3s ease-in-out;
        z-index: 3;
        display: flex;
        flex-direction: column;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

        .right-bar:hover {
            right: 0;
        }

        .right-bar-title {
            color: #fff;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .right-bar-title2 {
            color: #fff;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            resize: vertical;
        }

        .right-bar-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            color: #fff;
            cursor: pointer;
        }

        .right-bar-icon:hover {
            color: #ccc;
        }
        .show-right-bar {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background-color: #3498db;
        border-radius: 0 10px 10px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .show-right-bar:hover {
        background-color: #2980b9;
    }
    </style>
</head>

<body>
    	

		
		<!-- Get Pro Button -->
	
	
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
											<li><a href="#">Pages <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="404.html">404 Error</a></li>
												</ul>
											</li>
											<li><a href="#">Articles <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="blog-single.html">Article details</a></li>
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
									<a href="#" class="btn">Login</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
		
		<!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Articles</h2>
							<ul class="bread-list">
								<li><a href="index.html">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Articles</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->








<div class="right-bar">
        <div class="right-bar-icon" onclick="toggleArticles()">☰</div>
        <div class="right-bar-title">MedInfo Articles</div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="right-bar-title2">Search For Articles</div>
        <input type="text" id="searchInput" class="search-bar" placeholder="Search...">
        <div class="show-right-bar" onclick="toggleArticles('show')">&lt;</div>
        <!-- Other content or options can be added here -->
    </div>
    

    <?php foreach ($articles as $article) : ?>
        <?php
        // Determine if the article has a long text
        $articleClass = (strlen($article['contenuarticle']) > 500) ? 'long-article' : '';
        ?>
        <div class="article-container <?= $articleClass ?>" onclick="showPopup('<?= $article['titrearticle']; ?>', '<?= $article['contenuarticle']; ?>')">
            <h2><?= $article['titrearticle']; ?></h2>
            <p class="date">Published on <?= date('F j, Y \a\t g:i A', strtotime($article['datepubliarticle'])); ?></p>
            <p><?= nl2br($article['contenuarticle']); ?></p>
        </div>
    <?php endforeach; ?>

    <div class="back-button">
        <a href="addArticle.php" class="btn">Submit Article</a>
    </div>

    <!-- Popup Overlay -->
    <div class="popup-overlay" onclick="closePopup()"></div>

    <!-- Popup Container -->
    <div id="popup-container" class="popup-container">
        <span class="close-button" onclick="closePopup()">&times;</span>
        <h2 id="popup-title"></h2>
        <p id="popup-content"></p>
        <textarea id="comment-input" placeholder="Add your comment"></textarea>
        <button id="submit-comment" onclick="submitComment()">Submit Comment</button>
    </div>

    <script>
        let currentArticle;

        function showPopup(title, content) {
            currentArticle = { title, content };

            document.getElementById('popup-title').innerText = title;
            document.getElementById('popup-content').innerText = content;
            document.querySelector('.popup-overlay').classList.add('active');
            document.getElementById('popup-container').style.display = 'block';
        }

        function closePopup() {
            document.querySelector('.popup-overlay').classList.remove('active');
            document.getElementById('popup-container').style.display = 'none';
        }

        function submitComment() {
            // Add your logic to submit comments
            alert('Comment submitted for article: ' + currentArticle.title);
        }
        function toggleArticles(action) {
            const rightBar = document.querySelector('.right-bar');
            const showRightBar = document.querySelector('.show-right-bar');

            if (action === 'show') {
                rightBar.style.right = '0';
                showRightBar.style.left = 'calc(100% - 40px)';
                showRightBar.setAttribute('onclick', 'toggleArticles("hide")');
            } else {
                rightBar.style.right = '-300px';
                showRightBar.style.left = '0';
                showRightBar.setAttribute('onclick', 'toggleArticles("show")');
            }
        }
    </script>
    <!-- Footer Area -->
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
			
										
										</ul>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
								
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
								<p>© Copyright 2023  |  All Rights Reserved by <a href="https://www.wpthemesgrid.com" target="_blank">wpthemesgrid.com</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
		<!--/ End Footer Area -->
		
		<!-- jquery Min JS -->
        <script src="js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="js/easing.js"></script>
		<!-- Color JS -->
		<script src="js/colors.js"></script>
		<!-- Popper JS -->
		<script src="js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="js/steller.js"></script>
		<!-- Wow JS -->
		<script src="js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="js/main.js"></script>
</body>

</html>