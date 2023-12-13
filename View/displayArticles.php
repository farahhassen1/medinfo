<!-- displayArticles.php -->
<?php
// Include necessary files and classes
include "../Controller/ArticleC.php";
include '../Model/Article.php';
include '../Model/comment.php';
include '../Model/user.php';
include "../Controller/userC.php";
require '../config1.php';


session_start();
$int = $_SESSION['user_id'];



$c1 = new commentC();
$c = new ArticleC();
// Fetch articles as an array
$searchInput = isset($_POST['searchInput']) ? $_POST['searchInput'] : '';
$articles = $c->listArticle()->fetchAll(PDO::FETCH_ASSOC);
$comments = $c1->listcomment()->fetchAll(PDO::FETCH_ASSOC);
if (!empty($searchInput)) {
    $filteredArticles = array_filter($articles, function ($article) use ($searchInput) {
        return stripos($article['titrearticle'], $searchInput) !== false;
    });
    $articles = $filteredArticles;
}
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
            $_POST['datepubliarticle'],
            $int
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
    isset($_POST["datepublicomment"])&& 
    isset($_POST["contenucomment"])&&

	isset($_POST["idarticle"])
) {
    if (
        !empty($_POST["datepublicomment"]) &&
        !empty($_POST["contenucomment"])&&

		!empty($_POST["idarticle"])


    ) {
        $comment = new comment(
            null,
            $_POST['datepublicomment'],
            $_POST['contenucomment'],

			$_POST["idarticle"],

        

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

<link rel="stylesheet" href="displayart.css"> <!-- Create a new CSS file for styling the display -->
<link rel="stylesheet" href="addart.css">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="your-medical-info-website/css/style.css"> <!-- Adjust this line to match your actual CSS path -->

    <!-- Add FullCalendar CSS and JS files -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
    <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
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

<body>
    	<style>
            .article-details-container button.close-button {
    background-color: #007bff;
    border: 1px solid #007bff;
    color: #fff;
    padding: 5px 10px;
    cursor: pointer;
}

.article-details-container button.close-button:hover {
    background-color: #2980b9;
}
            label {
                color: #007bff;
            }
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
        background-color: #007bff;
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
        padding: 20px;
        border: 2px solid #007bff;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 1000px; /* Set a maximum width */
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
    margin-bottom: 20px; /* Add space between each article */
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    position: relative;
    cursor: pointer;
    padding: 20px;
    max-width: 50%;
    margin: 0 auto; /* Center the container horizontally */
    display: flex;
    flex-direction: column; /* Align child elements vertically */
    align-items: center; /* Center child elements horizontally */
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
            border: 2px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .article-details-container h2 {
            color: #007bff;
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
    color: #007bff;
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

    color: #007bff;
    padding: 5px 8px; /* Adjust the padding to make it smaller */
    border: none;
    border-radius: 4px;
    margin-top: 10px;
    font-size: 14px; /* Adjust the font size */
    transition: background-color 0.3s;
}

.comment-button:hover {
    background-color: #007bff;
}

.comments-container h3 {
    color: #007bff;
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
    background-color: #007bff;
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
/* CSS styles for heart button */
.like-container {
    margin-top: 10px;
  }

  .heart-button {
    cursor: pointer;
    background-color: transparent;
    border: none;
    font-size: 24px;
    transition: color 0.3s;
    color: #007bff; /* Set the color to #007bff */
  }

  .heart-button.liked {
    color: red;
  }

  .like-count {
    margin-left: 5px;
    font-size: 14px;
  }

  .like-count-container {
    display: flex;
    align-items: center;
  }

  .like-icon {
    margin-right: 5px;
    font-size: 18px;
    color: red; /* You can customize the color */
  }

  .like-count {
    font-size: 14px;
    color: #555; /* You can customize the color */
  }
.custom-search-bar {
        margin: 20px 0;
        text-align: center;
    }

    .search-input {
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 5px;
        width: 300px; /* Adjust the width as needed */
    }

    .search-button {
        padding: 8px;
        font-size: 14px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 80px; /* Adjust the width as needed */
    }

    .search-button:hover {
        background-color: #2980b9;
    }

    /* Additional styling for the article containers */
    .article-container {
        transition: transform 0.3s;
    }
        /* Add this CSS for delete and edit buttons */
     /* Add this CSS for the three-dot menu and dropdown */
     .comment-options {
        display: none;
        position: absolute;
        margin: 5px;
    }

    .comment-options button {
        display: block;
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
    }

    .comment-options {
        display: none;
        position: absolute;
        margin: 5px;
    }

    .comment-options button {
        display: block;
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
        color: #007bff;
    }

    .comment-options {
        display: none;
        position: relative;
        margin: 5px;
    }

    .comment-options {
        display: none;
        position: relative;
        margin: 5px;
    }

    .comment-options {
        display: none;
        position: relative;
        margin: 5px;
    }

    .ellipsis {
        font-size: 20px;
        cursor: pointer;
    }

    .dropdown2 {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 120px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown2 a {
        padding: 12px 16px;
        display: block;
        text-decoration: none;
        cursor: pointer;
        color: black;
    }

    .dropdown2 a:hover {
        background-color: #007bff;
    }

    .close-article-button {
    background-color: #007bff;
    border: 1px solid #007bff;
    color: #fff;
    padding: 5px 10px;
    cursor: pointer;
}

.close-article-button:hover {
    background-color: #2980b9;
}
.add-comment-button {
    background-color: #007bff;
    border: 1px solid #007bff;
    color: #fff;
    padding: 5px 10px;
    cursor: pointer;
}

.add-comment-button:hover {
    background-color: #2980b9;
}
.custom-button {
    position: relative;
    overflow: hidden;
    
    border: 1px solid #18181a;
    color: #18181a;
    display: inline-block;
    font-size: 15px;
    line-height: 15px;
    padding: 20px 40px 20px; /* Adjusted padding for width */
    text-decoration: none;
    cursor: pointer;
    background: #fff;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
}

.custom-button span:first-child {
    position: relative;
    transition: color 600ms cubic-bezier(0.48, 0, 0.12, 1);
    z-index: 10;
}

.custom-button span:last-child {
    color: white;
    display: block;
    position: absolute;
    bottom: 0;
    transition: all 500ms cubic-bezier(0.48, 0, 0.12, 1);
    z-index: 100;
    opacity: 0;
    top: 50%;
    left: 50%;
    transform: translateY(225%) translateX(-50%);
    height: 14px;
    line-height: 13px;
}

.custom-button:after {
    content: "";
    position: absolute;
    bottom: -50%;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #007bff; /* Change color to #007bff */
    transform-origin: bottom center;
    transition: transform 600ms cubic-bezier(0.48, 0, 0.12, 1);
    transform: skewY(9.3deg) scaleY(0);
    z-index: 50;
}

.custom-button:hover:after {
    transform-origin: bottom center;
    transform: skewY(9.3deg) scaleY(2);
}

.custom-button:hover span:last-child {
    transform: translateX(-50%) translateY(-100%);
    opacity: 1;
    transition: all 900ms cubic-bezier(0.48, 0, 0.12, 1);
}

.custom-button.clicked:after {
    transform-origin: bottom center;
    transform: skewY(9.3deg) scaleY(2);
}

.custom-button.clicked span:last-child {
    transform: translateX(-50%) translateY(-100%);
    opacity: 1;
    transition: all 900ms cubic-bezier(0.48, 0, 0.12, 1);
}
.comment-form {
    display: inline-block; /* Keep buttons in the same line */
}

.update-button,
.delete-button {
    text-decoration: none; /* Remove default link underline */
    cursor: pointer; /* Change cursor to pointer on hover */
    margin-right: 10px; /* Adjust spacing between buttons */
}

.update-button i,
.delete-button i {
    margin-right: 5px; /* Add space between icon and text */
}

.update-button:hover {
    background-color: #007bff; /* Change background color on hover */
    color: #fff; /* Change text color on hover */
}

.delete-button:hover {
    background-color: #dc3545; /* Change background color on hover */
    color: #fff; /* Change text color on hover */
}
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
								<li><i class="fa fa-phone"></i>+216 71 800 000</li>
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
                                <a href="index.php"><img  style="width: 100px; height: auto;"src="medinfo.jpg" alt="#"></a>
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
											<li><a href="addprescription.php">Prescriptions<i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
													<li><a href="MyprescriptionsC.php">My Prescriptions(Client)</a></li>
													<li><a href="MyprescriptionsM.php">My Prescriptions(doctor)</a></li>
												</ul>
											</li>
											<li><a href="listMesRDV.php">My appointments </i></a>
											</li>
											<li><a href="listpayement.php">payement <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listFacture.php">facture</a></li>
													</ul>
                                            </li>
											<li><a href="#">Pages <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listMedicament.php">Medicals</a></li>
													<li><a href="listfabricant.php">Fabricants</a></li>
												</ul>
											</li>
                                            <li><a href="displayArticles.php">Articles <i class="icofont-rounded-down"></i></a></li>
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


<?php
if (isset($_SESSION["user_id"])) {
    if ($_SESSION["state"] == "Admin") {
        echo '<div>
               
            </div>';
    } elseif ($_SESSION["state"] == "Doctor") {
        // Add content specific to doctors here
        echo '<div class="custom-button" onclick="toggleAddArticleForm()">
                <span class="text">Add</span><span>Article</span>
              </div>';
    } elseif ($_SESSION["state"] == "Patient") {
        // Add content specific to patients here
        echo '<div >
                
            </div>';
    }
}
?>

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

            <button class="close-article-button" type="submit">Submit Article</button>

        </div>

        <div id="article-container"></div>
    </form>
</div>

<div class="custom-search-bar">
    <input type="text" id="searchInput" class="search-input" placeholder="Search articles by title">
    <button onclick="searchArticles()" class="search-button">Search</button>
</div>
<?php foreach ($articles as $article) : 
    $name=$ArticleC->name($article['id_user']) ; ?>
    
    <div class="article-container <?= $articleClass ?>">
        <h2 class="article-title" onclick="showArticleDetails('article-details<?= $article['idarticle']; ?>')">
            <?= $article['titrearticle']; ?>
        </h2>
        <p>Posted By: <?=($name['username'])?></p>
        <p class="date">Published on <?= date('F j, Y \a\t g:i A', strtotime($article['datepubliarticle'])); ?></p>
        <!-- Add a new container for article details outside of the loop -->
        <div class="article-details-container" id="article-details<?= $article['idarticle']; ?>">
            <h2><?= $article['titrearticle']; ?></h2>
            <p>Posted By: <?=($name['username'])?></p>
            <p class="date">Published on <?= date('F j, Y \a\t g:i A', strtotime($article['datepubliarticle'])); ?></p>
            <p><?= nl2br($article['contenuarticle']); ?></p>
            <div class="like-container">
    <button class="heart-button like-button" onclick="toggleLikeArticle(<?= $article['idarticle']; ?>)">👍</button>
    <button class="heart-button dislike-button" onclick="toggleDislikeArticle(<?= $article['idarticle']; ?>)">👎</button>
    <div class="like-count-container">
        <span class="like-icon">👍</span>
        <span class="like-count" id="likeCount<?= $article['idarticle']; ?>">0</span>
    </div>
    <div class="like-count-container">
        <span class="like-icon">👎</span>
        <span class="like-count" id="dislikeCount<?= $article['idarticle']; ?>">0</span>
    </div>
</div>
            <!-- Comment section for each article -->
            <div class="comment-container">
            <h3>Comments</h3>
            <div class="comments-container" id="comments<?= $article['idarticle']; ?>">
                <?php foreach ($comments as $comment) :
                     ?>
                    <?php if ($comment['idarticle'] == $article['idarticle']) : ?>
                        <div class="comment">
                            <!-- Add ellipsis menu and dropdown -->
                            <p>Posted By: <?=($name['username'])?></p>
                            <p><?= nl2br($comment['contenucomment']); ?></p>
                            <p class="date">Commented on <?= date('F j, Y \a\t g:i A', strtotime($comment['datepublicomment'])); ?></p>
                            <div class="ellipsis" onclick="toggleDropdown(this)">&#8942;</div>
                            <div class="dropdown2">
                            <form method="POST" action="updatecomment.php" class="comment-form">
    <button type="submit" class="update-button" name="update">
        <i class="fa fa-pencil"></i> Update
    </button>
    <input type="hidden" value="<?= $comment['idcomment']; ?>" name="idcomment">
    <a href="deletecomment2.php?idcomment=<?= $comment['idcomment']; ?>" class="delete-button">
        <i class="fa fa-times"></i> Delete
    </a>
</form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
                <!-- Add your PHP code here to fetch and display comments for the article -->
                <!-- For demonstration purposes, a simple form is provided for adding comments -->
                <form action="displayArticles.php" method="post" onsubmit="return validateComment()">

    <input type="hidden" name="idarticle" value="<?= $article['idarticle']; ?>">
    <textarea class="comment-input" name="contenucomment" id="contenucomment" placeholder="Add your comment..."></textarea>
    <label for="datepublicomment">Date de publication:</label>
    <input type="text" id="datepublicomment" name="datepublicomment" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
    <div id="datepublicomment-error" class="error-message error-message-red"></div>
    <input type="submit" class="add-comment-button" value="Add Comment">
</form>
            </div>

            <!-- Close button for the article details container -->
            <button class="close-article-button" onclick="hideArticleDetails('article-details<?= $article['idarticle']; ?>')">Close</button>
        </div>
    </div>
<?php endforeach; ?>

<?php
if (isset($_SESSION["user_id"])) {
    if ($_SESSION["state"] == "Admin") {
        echo '<div>
               
            </div>';
    } elseif ($_SESSION["state"] == "Doctor") {
        // Add content specific to doctors here
        echo '<div class="custom-button" onclick="navigateToArticledb()">
        <span class="text">Go To</span><span>Admin Space</span>
    </div>';
    } elseif ($_SESSION["state"] == "Patient") {
        // Add content specific to patients here
        echo '<div >
                
            </div>';
    }
}
?>


<br>
<br>
<br>
<br>
    

   

<script>
       // Use the window.onload event to ensure the DOM is fully loaded before executing the script
    window.onload = function() {
        // Iterate through each article to initialize like and dislike counts from cookies
        <?php foreach ($articles as $article) : ?>
            initializeLikeDislikeCount(<?= $article['idarticle']; ?>);
        <?php endforeach; ?>
    };

    function initializeLikeDislikeCount(articleId) {
        var likeCount = getCookie('likeCount_' + articleId);
        var dislikeCount = getCookie('dislikeCount_' + articleId);

        if (likeCount !== null) {
            document.getElementById('likeCount' + articleId).innerText = likeCount;
        }

        if (dislikeCount !== null) {
            document.getElementById('dislikeCount' + articleId).innerText = dislikeCount;
        }
    }

    function toggleLikeArticle(articleId) {
        if (getCookie('userChoice_' + articleId) === 'like') {
            // User wants to remove the like
            decrementLikeCount(articleId);
            document.querySelector('.like-button[onclick="toggleLikeArticle(' + articleId + ')"]').disabled = false;
            setCookie('userChoice_' + articleId, '', -1); // Delete the cookie
        } else {
            // Check if the user has already disliked the article
            if (getCookie('userChoice_' + articleId) === 'dislike') {
                // User wants to toggle from dislike to like
                incrementLikeCount(articleId);
                decrementDislikeCount(articleId);
            } else {
                // User wants to like the article
                incrementLikeCount(articleId);
            }
            // Disable the like button and enable the dislike button
            document.querySelector('.like-button[onclick="toggleLikeArticle(' + articleId + ')"]').disabled = true;
            document.querySelector('.dislike-button[onclick="toggleDislikeArticle(' + articleId + ')"]').disabled = false;
            setCookie('userChoice_' + articleId, 'like', 365); // Set the cookie to expire in 365 days
        }
    }

    function toggleDislikeArticle(articleId) {
        if (getCookie('userChoice_' + articleId) === 'dislike') {
            // User wants to remove the dislike
            decrementDislikeCount(articleId);
            document.querySelector('.dislike-button[onclick="toggleDislikeArticle(' + articleId + ')"]').disabled = false;
            setCookie('userChoice_' + articleId, '', -1); // Delete the cookie
        } else {
            // Check if the user has already liked the article
            if (getCookie('userChoice_' + articleId) === 'like') {
                // User wants to toggle from like to dislike
                incrementDislikeCount(articleId);
                decrementLikeCount(articleId);
            } else {
                // User wants to dislike the article
                incrementDislikeCount(articleId);
            }
            // Disable the dislike button and enable the like button
            document.querySelector('.dislike-button[onclick="toggleDislikeArticle(' + articleId + ')"]').disabled = true;
            document.querySelector('.like-button[onclick="toggleLikeArticle(' + articleId + ')"]').disabled = false;
            setCookie('userChoice_' + articleId, 'dislike', 365); // Set the cookie to expire in 365 days
        }
    }

    function incrementLikeCount(articleId) {
        var likeCountElement = document.getElementById('likeCount' + articleId);
        var newCount = parseInt(likeCountElement.innerText) + 1;
        likeCountElement.innerText = newCount;
        setCookie('likeCount_' + articleId, newCount, 365); // Update like count in cookie
    }

    function decrementLikeCount(articleId) {
        var likeCountElement = document.getElementById('likeCount' + articleId);
        var newCount = Math.max(parseInt(likeCountElement.innerText) - 1, 0);
        likeCountElement.innerText = newCount;
        setCookie('likeCount_' + articleId, newCount, 365); // Update like count in cookie
    }

    function incrementDislikeCount(articleId) {
        var dislikeCountElement = document.getElementById('dislikeCount' + articleId);
        var newCount = parseInt(dislikeCountElement.innerText) + 1;
        dislikeCountElement.innerText = newCount;
        setCookie('dislikeCount_' + articleId, newCount, 365); // Update dislike count in cookie
    }

    function decrementDislikeCount(articleId) {
        var dislikeCountElement = document.getElementById('dislikeCount' + articleId);
        var newCount = Math.max(parseInt(dislikeCountElement.innerText) - 1, 0);
        dislikeCountElement.innerText = newCount;
        setCookie('dislikeCount_' + articleId, newCount, 365); // Update dislike count in cookie
    }

    function setCookie(name, value, days) {
        var expires = '';
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + value + expires + '; path=/';
    }

    function getCookie(name) {
        var nameEQ = name + '=';
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

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
        performButtonClickAnimation();
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
	


function searchArticles() {
    var searchInput = document.getElementById('searchInput').value.toLowerCase();

    // Get all article containers
    var articleContainers = document.querySelectorAll('.article-container');

    // Hide all article containers
    articleContainers.forEach(function (container) {
        container.style.display = 'none';
    });

    // Show only the containers that match the search input
    articleContainers.forEach(function (container) {
        var articleTitle = container.querySelector('.article-title').innerText.toLowerCase();
        if (articleTitle.includes(searchInput)) {
            container.style.display = 'block';
        }
    });
}
function validateComment(event) {
    var commentInput = document.getElementById('contenucomment');
    var commentError = document.getElementById('datepublicomment-error');

    if (commentInput.value.trim() === '') {
        commentError.textContent = 'Comment cannot be empty';
        commentError.style.display = 'block';
        commentInput.style.borderColor = 'red';
        event.preventDefault(); // prevent form submission
        return false;
    } else {
        commentError.textContent = ''; // clear error message
        commentError.style.display = 'none';
        commentInput.style.borderColor = ''; // clear red border
        return true; // allow form submission
    }
}
function toggleDropdown(ellipsis) {
        var options = ellipsis.parentElement.querySelector('.dropdown2');
        options.style.display = options.style.display === 'block' ? 'none' : 'block';
    }
    function navigateToArticledb() {
        // Perform the button click animation
        performButtonClickAnimation();

        // Navigate to the articledb.php page
        window.location.href = 'articlesdb.php';
    }

    function performButtonClickAnimation() {
        var customButton = document.querySelector('.custom-button');
        customButton.classList.add('clicked');

        setTimeout(function () {
            customButton.classList.remove('clicked');
        }, 500); // Adjust the timeout value as needed
    }
    function navigateToDoctordb() {
        // Perform the button click animation
        performButtonClickAnimation();

        // Navigate to the articledb.php page
        window.location.href = 'doctordb.php';
    }

    function performButtonClickAnimation() {
        var customButton = document.querySelector('.custom-button');
        customButton.classList.add('clicked');

        setTimeout(function () {
            customButton.classList.remove('clicked');
        }, 500); // Adjust the timeout value as needed
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