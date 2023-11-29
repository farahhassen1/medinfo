<?php
include "../controller/ArticleC.php";

$c = new articleC();
$tab = $c->listArticle();
$c2 = new commentC();
$tab2 = $c2->listcomment();
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
		
		<center>
    <h1>List of Articles</h1>
    <h2>
        <a href="addArticle.php">Add Article</a>
    </h2>
    <a href="displayArticles.php" class="button">Display Articles</a>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id Article</th>
        <th>datepubliarticle</th>
        <th>titrearticle</th>
        <th>contenuarticle</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $article) {
    ?>

        <tr>
            <td><?= $article['idarticle']; ?></td>
            <td><?= $article['datepubliarticle']; ?></td>
            <td><?= $article['titrearticle']; ?></td>
            <td><?= $article['contenuarticle']; ?></td>
            <td align="center">
                <form method="POST" action="updateArticle.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $article['idarticle']; ?> name="idarticle">
                </form>
            </td>
            <td>
                <a href="deleteArticle.php?idarticle=<?php echo $article['idarticle']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<tr>
	<br>
	<br>
	<center>
    <h1>List of comments</h1>
    
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id comment</th>
		<th>Id article</th>
        <th>datepublicomment</th>
        <th>contenucomment</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab2 as $comment) {
    ?>

        <tr>
		<td><?= $comment['idcomment']; ?></td>
            <td><?= $comment['idarticle']; ?></td>
            <td><?= $comment['datepublicomment']; ?></td>
            <td><?= $comment['contenucomment']; ?></td>
			<td align="center">
                <form method="POST" action="updatecomment.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $comment['idcomment']; ?> name="idcomment">
                </form>
            </td>
            <td>
                <a href="deletecomment.php?idcomment=<?php echo $comment['idcomment']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

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
