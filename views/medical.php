<?php
include "../controller/medicament_functions.php";
$c = new medicamentC();
$c2 = new fabricantc();
$tab = $c->listMedicament();
$tab2 = $c2->listFabricant();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Charts</title>
	<link href="css2/bootstrap.min.css" rel="stylesheet">
	<link href="css2/font-awesome.min.css" rel="stylesheet">
	<link href="css2/datepicker3.css" rel="stylesheet">
	<link href="css2/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="listmed.css">
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
				<a class="navbar-brand" href="#"><span>Med-info </span>Admin space</a>
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
			<li><a href="index2.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
			<li class="active"><a href="medical.php"><em class="fa fa-bar-chart">&nbsp;</em> Medications & Fabricants</a></li>
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
	<center>
    <h1>Medication List</h1>
    
    <h2>
		
	<a href="addmedicament.php">Add a Medication</a>
</h2>
</center>
</div>
      
    </div>
  </div>
  
</div>
    <br><br>

<table border="1" align="center" width="70%" class="styled-table" style="margin: 0 auto; margin-right: 100px;">
    <tr>
		
        <th>Medication ID</th>
        <th>Medication Name</th>
        <th>Fabricant ID</th>
        <th>Expiration Date</th>
        <th>Update</th>
        <th>Delete</th>

    </tr>
    <?php
    foreach ($tab as $medicament) {
    ?>
        <tr>
            <td><?= $medicament['id_medicament']; ?></td>
            <td><?= $medicament['nom_medicament']; ?></td>
            <td><?= $medicament['id_fabricant']; ?></td>
            <td><?= $medicament['date_prescription']; ?></td>
            <td align="center">
                <form method="POST" action="updatemedicament.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $medicament['id_medicament']; ?> name="id_medicament">
                </form>
            </td>
            <td>
			
                <a href="dropmedicament.php?id_medicament=<?php echo $medicament['id_medicament']; ?>">Delete</a>
				
            </td>
        </tr>
    <?php
    }
    ?>


</table>
<br>
<hr style="border-width: 50%px; border-color: black;"/>
<center>
    <h1>Fabricant List</h1>
    
    <h2>
		
	<a href="addfabricant.php">Add a Fabricant</a>
</h2>
</center>


    <br><br>

<table border="1" align="center" width="70%" class="styled-table" style="margin: 0 auto; margin-right: 100px;">
    <tr>
        <th>Fabricant ID</th>
        <th>Fabricant Name</th>
        <th>Adress Fabricant</th>
        <th>Contact</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php
    foreach ($tab2 as $fabricant) {
    ?>
        <tr>
			<td><?= $fabricant['id_fabricant']; ?></td>
            <td><?= $fabricant['nom_fabricant']; ?></td>
            <td><?= $fabricant['adress_fabricant']; ?></td>
            <td><?= $fabricant['contact']; ?></td>
			<td align="center">
                <form method="POST" action="updatefabricant.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $fabricant['id_fabricant']; ?> name="id_fabricant">
                </form>
            </td>
			<td>
			
                <a href="dropfabricant.php?id_fabricant=<?php echo $fabricant['id_fabricant']; ?>">Delete</a>
				
            </td>
        </tr>
    <?php
    }
    ?>


</table>






<center>
<a href="index.php">Go back to client's space</a></center>
<br><br><br>

			
		</div><!--/.row-->
	</div>	<!--/.main-->
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
	window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart5 = document.getElementById("radar-chart").getContext("2d");
	window.myRadarChart = new Chart(chart5).Radar(radarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.05)",
	angleLineColor: "rgba(0,0,0,.2)"
	});
	var chart6 = document.getElementById("polar-area-chart").getContext("2d");
	window.myPolarAreaChart = new Chart(chart6).PolarArea(polarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	segmentShowStroke: false
	});
};
	</script>	
</body>
</html>
