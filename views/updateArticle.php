<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controller/ArticleC.php';
include '../model/Article.php';

$error = "";
$article = null;
$articleC = new ArticleC();

if (isset($_POST["titrearticle"]) && isset($_POST["contenuarticle"]) && isset($_POST["datepubliarticle"])) {
    if (!empty($_POST['titrearticle']) && !empty($_POST["contenuarticle"]) && !empty($_POST["datepubliarticle"])) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        // Make sure idarticle is set, default to null if not
        $idarticle = isset($_POST['idarticle']) ? $_POST['idarticle'] : null;

        $article = new Article(
            $idarticle,
            $_POST['titrearticle'],
            $_POST['contenuarticle'],
            $_POST['datepubliarticle']
        );

        var_dump($article);

        if (!empty($idarticle)) {
            $articleC->updateArticle($article, $idarticle);
            header('Location: articlesdb.php');
            exit();
        } else {
            $error = "Missing article ID";
        }
    } else {
        $error = "Missing information";
    }
}
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
				<a class="navbar-brand" href="index2.php"><span>MED-Info </span>Admin SPACE</a>
				
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
			<li class="active"><a href="articlesdb.php"><em class="fa fa-calendar">&nbsp;</em> Articles</a></li>
			<li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
			<li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
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
    <style>
      

.container-form {
    max-width: 600px; /* Set the maximum width of the form container */
    margin: auto; /* Center the container */
    padding: 20px; /* Add some padding for better visual */
    background-color: #fff; /* Set a background color */
    border-radius: 10px; /* Add rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}
#error {
    color: #ff5555; /* Bright red color */
    font-weight: bold;
    margin-bottom: 10px;
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    animation: slideInDown 0.5s ease;
}

form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.9); /* Slightly transparent white background */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    position: relative;
    animation: fadeIn 0.5s ease;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input,
textarea,
button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input::placeholder,
textarea::placeholder {
    color: #999;
}

button {
    background-color: #4c9daf;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #1bd5ff;
}

a {
    text-decoration: none;
    color: #333;
    transition: color 0.3s ease;
}

a:hover {
    color: #4c9daf;
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #ddd;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInDown {
    from {
        transform: translateY(-100%);
    }

    to {
        transform: translateY(0);
    }
}

        .error-message {
            font-size: 14px;
            margin-top: 5px;
            color: red;
        }

        .success-message {
            font-size: 14px;
            margin-top: 5px;
            color: green;
        }
    </style>
 
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (!empty($_POST['idarticle'])) {
        $article = $articleC->showArticle($_POST['idarticle']);
    ?>
<div class="form-container">
        <form action="updateArticle.php" method="POST" onsubmit="return validateForm2();">

            <label for="titrearticle">Article Title:</label>
            <input type="text" id="titrearticle" name="titrearticle" placeholder="Enter Article Title" value="<?php echo $article["titrearticle"] ?>">
            <div id="titrearticle-error" class="error-message error-message-red"></div>

            <label for="contenuarticle">Article Contenu:</label>
            <input id="contenuarticle" name="contenuarticle" type="text" placeholder="Enter Article Content" value="<?php echo $article['contenuarticle'] ?>">
            <div id="contenuarticle-error" class="error-message error-message-red"></div>

            <label for="datepubliarticle">Date de publication:</label>
            <input type="date" id="datepubliarticle" name="datepubliarticle" placeholder="Select Date of Publication" value="<?php echo $article['datepubliarticle'] ?>">
            <div id="datepubliarticle-error" class="error-message error-message-red"></div>

            <!-- Add a hidden input for idarticle -->
            <input type="hidden" name="idarticle" value="<?php echo $_POST['idarticle']; ?>">

            <input type="submit" value="save">
            <input type="submit" value="reset">

            <div id="article-container"></div>

        </form>

    <?php
    }
    ?>
     </div>
    <script>
        function validateForm2() {
            var title = document.getElementById('titrearticle').value;
            var content = document.getElementById('contenuarticle').value;
            var date = document.getElementById('datepubliarticle').value;

            var titleRegex = /^[a-zA-Z0-9\s]+$/; // Alphanumeric characters and spaces
            var contentRegex = /^[a-zA-Z0-9\s]{1,2000}$/; // Alphanumeric characters and spaces

            var isValid = true;

            if (!title.match(titleRegex)) {
                document.getElementById('titrearticle-error').innerHTML = 'Title can only contain letters, numbers, and spaces and cant be empty';
                isValid = false;
            } else {
                document.getElementById('titrearticle-error').innerHTML = 'Done!';
            }

            if (!content.match(contentRegex)) {
                document.getElementById('contenuarticle-error').innerHTML = 'Content can only contain letters, numbers, and spaces and cant be empty';
                isValid = false;
            } else {
                document.getElementById('contenuarticle-error').innerHTML = 'Done!';
            }

            if (date.trim() === "") {
                document.getElementById('datepubliarticle-error').innerHTML = 'Date is required';
                isValid = false;
            } else {
                document.getElementById('datepubliarticle-error').innerHTML = 'Done!';
            }

            return isValid;
        }
    </script>
<a href="index.php">Go to Main page</a>			
			<div class="col-sm-12">
				<p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
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

