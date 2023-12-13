<?php
include "../controller/ArticleC.php";

$c = new articleC();
$result = $c->listArticle();
$tab = $result->fetchAll(PDO::FETCH_ASSOC);

$c2 = new commentC();
$result2 = $c2->listcomment();
$tab2 = $result2->fetchAll(PDO::FETCH_ASSOC);

// Pagination for articles
$items_per_page = 6;
$total_items = count($tab);
$total_pages = ceil($total_items / $items_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;
$medications_for_page = array_slice($tab, $offset, $items_per_page);
$tab = $medications_for_page;

// Pagination for comments
$items_per_page2 = 6;
$total_items2 = count($tab2);
$total_pages2 = ceil($total_items2 / $items_per_page2);

$current_page2 = isset($_GET['page2']) ? $_GET['page2'] : 1;
$offset2 = ($current_page2 - 1) * $items_per_page2;
$medications_for_page2 = array_slice($tab2, $offset2, $items_per_page2);
$tab2 = $medications_for_page2;
?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="displycss.css">
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
</head>
<body>
<style>
    /* Add the CSS styles here */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #edf5fc; /* Light Blue Background Color */
    }

    th, td {
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
				<div class="profile-usertitle-name">Admin</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li ><a href="backoffice/useredit.php"><em class="fa fa-calendar">&nbsp;</em> User Edit</a></li>
			<li ><a href="medical.php"><em class="fa fa-dashboard">&nbsp;</em> Medications</a></li>
			<li ><a href="backfabricant.php"><em class="fa fa-dashboard">&nbsp;</em> Fabricant</a></li>
			<li><a href="listRDV.php"><em class="fa fa-calendar">&nbsp;</em> Appointement</a></li>
			<li ><a href="listFeedback.php"><em class="fa fa-bar-chart">&nbsp;</em> Feedback</a></li>
			<li><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Payement</a></li>
			<li ><a href="facture.php"><em class="fa fa-clone">&nbsp;</em> Factures</a></li>
			<li class="active" ><a  href="articlesdb.php"><em class="fa fa-clone">&nbsp;</em> Articles</a></li>
			<li ><a href="backanis.php"><em class="fa fa-clone">&nbsp;</em> Prescriptions</a></li>
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
<br>
<br>
<form method="GET" action="">
    <label for="article_id">Sort by Article ID:</label>
    <select name="article_id" id="article_id">
        <option value="" <?php echo empty($_GET['article_id']) ? 'selected' : ''; ?>>-- Reset --</option>
        <?php
        // Populate the dropdown with unique article IDs
        $uniqueArticleIds = array_unique(array_column($tab, 'idarticle'));
        foreach ($uniqueArticleIds as $id) {
            echo '<option value="' . $id . '" ' . (isset($_GET['article_id']) && $_GET['article_id'] == $id ? 'selected' : '') . '>' . $id . '</option>';
        }
        ?>
    </select>
    <button type="submit">Apply</button>
</form>
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
        // Check if the selected article ID matches
        if (empty($_GET['article_id']) || $_GET['article_id'] == $article['idarticle']) {
            ?>
            <tr>
                <td><?= $article['idarticle']; ?></td>
                <td><?= $article['datepubliarticle']; ?></td>
                <td><?= $article['titrearticle']; ?></td>
                <td><?= $article['contenuarticle']; ?></td>
                <td align="center">
                    <form method="POST" action="updateArticle.php">
                        <button type="submit" class="update-button" name="update">
                            <i class="fa fa-pencil"></i> Update
                        </button>
                        <input type="hidden" value=<?= $article['idarticle']; ?> name="idarticle">
                    </form>
                </td>
                <td>
                    <a href="deleteArticle.php?idarticle=<?= $article['idarticle']; ?>" class="delete-button">
                        <i class="fa fa-times"></i> Delete
                    </a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>

<!-- Pagination for Articles -->
<div class="pagination">
    <?php
    echo '<span>Page ' . $current_page . ' of ' . $total_pages . '</span>';
    $start = max($current_page - 2, 1);
    $end = min($current_page + 2, $total_pages);

    // First page link
    if ($total_pages > 1 && $current_page > 2 && $start != 1) {
        echo '<a href="?page=1">1</a>';
    }

    // Display ellipsis before the pages if needed
    if ($total_pages > 4 && $current_page > 3 && $start > 2) {
        echo '<span class="pagination-ellipsis">...</span>';
    }

    // Display the page links
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $current_page) {
            echo '<span class="active">' . $i . '</span>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }

    // Display ellipsis after the pages if needed
    if ($total_pages > 4 && $current_page < $total_pages - 2 && $end < $total_pages - 1) {
        echo '<span class="pagination-ellipsis">...</span>';
    }

    // Last page link
    if ($total_pages > 1 && $current_page < $total_pages - 1 && $end != $total_pages) {
        echo '<a href="?page=' . $total_pages . '">' . $total_pages . '</a>';
    }
    ?>
</div>
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
			// Check if the selected article ID matches
			if (empty($_GET['article_id']) || $_GET['article_id'] == $comment['idarticle']) {
				?>
				<tr>
					<td><?= $comment['idcomment']; ?></td>
					<td><?= $comment['idarticle']; ?></td>
					<td><?= $comment['datepublicomment']; ?></td>
					<td><?= $comment['contenucomment']; ?></td>
					<td align="center">
						<form method="POST" action="updatecomment.php">
							<button type="submit" class="update-button" name="update">
								<i class="fa fa-pencil"></i> Update
							</button>
							<input type="hidden" value=<?= $comment['idcomment']; ?> name="idcomment">
						</form>
					</td>
					<td>
						<a href="deletecomment.php?idcomment=<?= $comment['idcomment']; ?>" class="delete-button">
							<i class="fa fa-times"></i> Delete
						</a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</table>
	
	<!-- Pagination for Comments -->
	<div class="pagination">
		<?php
		echo '<span>Page ' . $current_page2 . ' of ' . $total_pages2 . '</span>';
		$start2 = max($current_page2 - 2, 1);
		$end2 = min($current_page2 + 2, $total_pages2);

    // First page link
    if ($total_pages2 > 1 && $current_page2 > 2 && $start2 != 1) {
        echo '<a href="?page2=1">1</a>';
    }

    // Display ellipsis before the pages if needed
    if ($total_pages2 > 4 && $current_page2 > 3 && $start2 > 2) {
        echo '<span class="pagination-ellipsis">...</span>';
    }

    // Display the page links
    for ($i2 = $start2; $i2 <= $end2; $i2++) {
        if ($i2 == $current_page2) {
            echo '<span class="active">' . $i2 . '</span>';
        } else {
            echo '<a href="?page2=' . $i2 . '">' . $i2 . '</a>';
        }
    }

    // Display ellipsis after the pages if needed
    if ($total_pages2 > 4 && $current_page2 < $total_pages2 - 2 && $end2 < $total_pages2 - 1) {
        echo '<span class="pagination-ellipsis">...</span>';
    }

    // Last page link
    if ($total_pages2 > 1 && $current_page2 < $total_pages2 - 1 && $end2 != $total_pages2) {
        echo '<a href="?page2=' . $total_pages2 . '">' . $total_pages2 . '</a>';
    }
    ?>
</div>
<br>
<br>
<br>
<a href="frontoffice/index.php">Go to Main page</a>			
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
