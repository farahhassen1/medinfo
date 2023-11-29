<!-- displayArticles.php -->
<?php
// Include necessary files and classes
include "../controller/ArticleC.php";
include '../model/Article.php';
include '../model/comment.php';
$c1 = new commentC();
$c = new ArticleC();
// Fetch articles as an array
$articles = $c->listArticle()->fetchAll(PDO::FETCH_ASSOC);
$comments = $c1->listcomment()->fetchAll(PDO::FETCH_ASSOC);
// Sort the articles by date in descending order
usort($articles, function($a, $b) {
    return strtotime($b['datepubliarticle']) - strtotime($a['datepubliarticle']);
});

$error = "";

// create client
$article = null;

// create an instance of the controller
$ArticleC = new ArticleC();
if (
    isset($_POST["titrearticle"]) &&
    isset($_POST["contenuarticle"])&&
    isset($_POST["datepubliarticle"]) 
) {
    if (
        !empty($_POST["titrearticle"]) &&
        !empty($_POST["contenuarticle"])&&
        !empty($_POST["datepubliarticle"]) 

    ) {
        $article = new article(
            null,
            $_POST['titrearticle'],
            $_POST['contenuarticle'],
            $_POST['datepubliarticle']

        );
        $ArticleC->addArticle($article);
        
        header('Location:displayArticles.php');
    } else
        $error = "You Didnt add the Article Information!";
}

usort($comments, function($a1, $b1) {
    return strtotime($b1['datepublicomment']) - strtotime($a1['datepublicomment']);
});

$error2 = "";

// create client
$comment = null;

// create an instance of the controller
$commentC = new commentC();
if (
    isset($_POST["contenucomment"])&&
    isset($_POST["datepublicomment"])&& 
	isset($_POST["idarticle"])
) {
    if (
        !empty($_POST["contenucomment"])&&
        !empty($_POST["datepublicomment"]) &&
		!empty($_POST["idarticle"])


    ) {
        $comment = new comment(
            null,
            $_POST['contenucomment'],
            $_POST['datepublicomment'],
			$_POST["idarticle"]

        );
        $commentC->addcomment($comment);
        
        header('Location:displayArticles.php');
    } else
        $error2 = "You Didnt add the comment Information!";
}


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
<link rel="stylesheet" href="addart.css">
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
    	<style>
/*Error color*/
.error-message {
            font-size: 14px;
            margin-top: 5px;
        }

        .error-message-red {
            color: red;
        }
/*End Error color*/
/*Article drop down*/
/* Style for the Add Article button */
html, body {
    margin: 0;
    padding: 0;
}
.add-article-button {
        cursor: pointer;
        background-color: #3498db;
        color: #fff;
        padding: 8px 15px; /* Adjust padding to make it smaller */
        border: none;
        border-radius: 4px;
        display: block; /* Display as block to take the full width */
        margin: 10% auto; /* Center the button both vertically and horizontally */
        max-width: 150px; /* Set a maximum width */
        text-align: center; /* Center the text */
        transition: background-color 0.3s;
    }

    .add-article-button:hover {
        background-color: #2980b9;
    }

    /* Style for the form container */
    .add-article-container {
        display: none; /* Hide the form container by default */
        margin: 5% auto; /* Center the container both vertically and horizontally */
        padding: 15px;
        border: 2px solid #3498db;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Set a maximum width */
        animation: fadeIn 0.5s ease-in-out; /* Add a fade-in animation */
    }

    /* Animation keyframes */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }


/*End Article drop down*/
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    margin-top: 0; /* Add this line to reset the top margin */
}

/* Article container styles */
.article-container {
    border: 2px solid #3498db;
    border-radius: 10px;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    position: relative;
    cursor: pointer;
    padding: 20px;
    max-width: 50%; /* Set maximum width to 50% of the screen width */
}
.article-details-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            max-width: 80%;
            max-height: 80%;
            overflow: auto;
            background-color: #fff;
            border: 2px solid #3498db;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .article-details-container h2 {
            color: #3498db;
            margin-bottom: 10px;
        }

        .comment-container {
            margin-top: 20px;
        }

        .comments-container {
            display: none;
            margin-top: 20px;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .comment {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            transition: background-color 0.3s;
        }

        .comment:hover {
            background-color: #f0f0f0;
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

/* Comment section styles */
.comments-container {
        display: none; /* Hide the comments section by default */
        margin-top: 20px; /* Add some spacing between article and comments */
    }

    .comment-button {
    cursor: pointer;
    background-color: #3498db;
    color: #fff;
    padding: 5px 8px; /* Adjust the padding to make it smaller */
    border: none;
    border-radius: 4px;
    margin-top: 10px;
    font-size: 14px; /* Adjust the font size */
    transition: background-color 0.3s;
}

.comment-button:hover {
    background-color: #2980b9;
}

.comments-container h3 {
    color: #3498db;
    margin-bottom: 15px;
}

.comment-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}



.comment-button:hover {
    background-color: #2980b9;
}

/* Responsive styling for smaller screens */
@media (max-width: 767px) {
    .article-container {
        padding: 15px;
    }

    .comments-container {
        padding: 15px;
    }
}
.back-button {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Optional: This ensures that the container takes up the full height of the viewport */
    margin: 0; /* Set margin to zero */
}

.btn {
    /* Your button styles here */
    margin: 0; /* Set margin to zero */
}
/*recentpost and recet comments container csss*/

/*END recentpost and recet comments container csss*/
        </style>

		
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
									<a href="index.php"><img src="img/medinfo.png" alt="#"></a>
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


<br>
<div class="add-article-button" onclick="toggleAddArticleForm()">Add Article</div>
<br>


<div id="error">
        <?php echo $error; ?>
    </div>

<div class="add-article-container" id="addArticleContainer">
    <form action="" method="POST" onsubmit="return validateForm()">
	<div>
            <label for="titrearticle">Article Title:</label>
            <input type="text" id="titrearticle" name="titrearticle" placeholder="Enter Article Title">
            <div id="titrearticle-error" class="error-message error-message-red"></div>

            <label for="contenuarticle">Article Contenu:</label>
            <textarea id="contenuarticle" name="contenuarticle" rows="4" cols="50" placeholder="Enter Article Content"></textarea>
            <div id="contenuarticle-error" class="error-message error-message-red"></div>

			<label for="datepubliarticle">Date de publication:</label>
<input type="text" id="datepubliarticle" name="datepubliarticle" value="<?php echo date('Y-m-d'); ?>" readonly>
<div id="datepubliarticle-error" class="error-message error-message-red"></div>

            <button type="submit">Submit Article</button>

        </div>

        <div id="article-container"></div>
    </form>
</div>


<?php foreach ($articles as $article) : ?>
    <div class="article-container <?= $articleClass ?>">
        <h2 class="article-title" onclick="showArticleDetails('article-details<?= $article['idarticle']; ?>')">
            <?= $article['titrearticle']; ?>
        </h2>
        <p class="date">Published on <?= date('F j, Y \a\t g:i A', strtotime($article['datepubliarticle'])); ?></p>

        <!-- Add a new container for article details outside of the loop -->
        <div class="article-details-container" id="article-details<?= $article['idarticle']; ?>">
            <h2><?= $article['titrearticle']; ?></h2>
            <p class="date">Published on <?= date('F j, Y \a\t g:i A', strtotime($article['datepubliarticle'])); ?></p>
            <p><?= nl2br($article['contenuarticle']); ?></p>

            <!-- Comment section for each article -->
            <div class="comment-container">
                <h3>Comments</h3>
                <div class="comments-container" id="comments<?= $article['idarticle']; ?>">
                    <?php foreach ($comments as $comment) : ?>
                        <?php if ($comment['idarticle'] == $article['idarticle']) : ?>
                            <div class="comment">
                                <p><?= nl2br($comment['contenucomment']); ?></p>
                                <p class="date">Commented on <?= date('F j, Y \a\t g:i A', strtotime($comment['datepublicomment'])); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Add your PHP code here to fetch and display comments for the article -->
                <!-- For demonstration purposes, a simple form is provided for adding comments -->
                <form action="#" method="post">
                    <input type="hidden" name="idarticle" value="<?= $article['idarticle']; ?>">
                    <textarea class="comment-input" name="contenucomment" placeholder="Add your comment..." required></textarea>
                    <label for="datepublicomment">Date de publication:</label>
                    <input type="text" id="datepublicomment" name="datepublicomment" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                    <div id="datepublicomment-error" class="error-message error-message-red"></div>
                    <input type="submit" class="comment-button" value="Add Comment">
                </form>
            </div>

            <!-- Close button for the article details container -->
            <button onclick="hideArticleDetails('article-details<?= $article['idarticle']; ?>')">Close</button>
        </div>
    </div>
<?php endforeach; ?>

<a href="articlesdb.php">Go to Admin Space</a>
    

   

<script>
    function toggleComments(commentsId) {
        var commentsContainer = document.getElementById(commentsId);
        if (commentsContainer.style.display === 'none' || commentsContainer.style.display === '') {
            commentsContainer.style.display = 'block';
        } else {
            commentsContainer.style.display = 'none';
        }
    }

    function toggleAddArticleForm() {
        var addArticleContainer = document.getElementById('addArticleContainer');
        if (addArticleContainer.style.display === 'none' || addArticleContainer.style.display === '') {
            addArticleContainer.style.display = 'block';
        } else {
            addArticleContainer.style.display = 'none';
        }
    }

    function validateForm() {
        var title = document.getElementById('titrearticle').value;
        var content = document.getElementById('contenuarticle').value;
        var date = document.getElementById('datepubliarticle').value;

        var titleRegex = /^[a-zA-Z0-9\s]+$/; // Alphanumeric characters and spaces
        var contentRegex = /^[a-zA-Z0-9\s]{1,2000}$/; // Alphanumeric characters and spaces

        var isValid = true;

        if (!title.match(titleRegex) || title.trim() === "") {
            document.getElementById('titrearticle-error').innerHTML = 'Title can only contain letters, numbers, and spaces and cannot be empty';
            isValid = false;
        } else {
            document.getElementById('titrearticle-error').innerHTML = 'Done!';
        }

        if (!content.match(contentRegex) || content.trim() === "") {
            document.getElementById('contenuarticle-error').innerHTML = 'Content can only contain letters, numbers, and spaces and cannot be empty';
            isValid = false;
        } else {
            document.getElementById('contenuarticle-error').innerHTML = 'Done!';
        }

     

        return isValid;
    }
	function showArticleDetails(articleDetailsId) {
        var articleDetailsContainer = document.getElementById(articleDetailsId);
        articleDetailsContainer.style.display = 'block';

        // Fetch and display comments for the article
        var articleId = articleDetailsId.replace('article-details', '');
        var commentsContainer = document.getElementById('comments' + articleId);
        commentsContainer.style.display = 'block';
    }

    function hideArticleDetails(articleDetailsId) {
        var articleDetailsContainer = document.getElementById(articleDetailsId);
        articleDetailsContainer.style.display = 'none';

        // Reset the form inside the article details container
        var form = articleDetailsContainer.querySelector('form');
        form.reset();
    }

    function toggleComments(commentsId) {
        var commentsContainer = document.getElementById(commentsId);
        if (commentsContainer.style.display === 'none' || commentsContainer.style.display === '') {
            commentsContainer.style.display = 'block';
        } else {
            commentsContainer.style.display = 'none';
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