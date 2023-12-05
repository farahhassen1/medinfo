<?php
include "../Controller/RDVC.php";

$c = new rdvC();
$tab = $c->listRDV();

?>
<head>
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
	<style>
		table {
  width: 100%;
  border-collapse: collapse;
}

tr {
  border-bottom: 1px solid #ccc;
}

th {
  background-color: #f2f2f2;
  padding: 10px;
  text-align: left;
}

td {
  padding: 10px;
  border-radius: 12px; 
}

tr:nth-child(even) {
  background-color: #f8f8ff;
}
	</style>
	
</head>
<body>
<center>
    <h1>List of RDV</h1>
    <h2>
        <a href="addRDV.php"> New Appointment</a>
    </h2>
</center>
<div class="container-fluid">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table border="1"style="width:70%; margin-left:250px; ">
					<tr>
						<th>Id rdv</th>
						<th>date</th>
						<th>heure</th>
						<th>Commentaire</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>


					<?php
					foreach ($tab as $rdv) {
					?>
					
						<tr>
							<td><?= $rdv['idRDV']; ?></td>
							<td><?= $rdv['date']; ?></td>
							<td><?= $rdv['heure']; ?></td>
							<td><?= $rdv['commentaire']; ?></td>
							<td align="center">
								<form method="POST" action="updateRDVAdmin.php">
									<input type="submit" name="update" value="Update">
									<input type="hidden" value=<?PHP echo $rdv['idRDV']; ?> name="idRDV">
								</form>
							</td>
							<td>
								<a href="deleteRDV.php?id=<?php echo $rdv['idRDV']; ?>">Delete</a>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
</div>
	</div>
		</div>
			</div>	
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
			<li ><a href="backoffice/index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="active"><a href="listRDV.php"><em class="fa fa-calendar">&nbsp;</em> Appointement</a></li>
			<li><a href="listFeedback.php"><em class="fa fa-bar-chart">&nbsp;</em> Feedback</a></li>
			<li><a href="backoffice/elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
			<li><a href="backoffice/panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
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
</body>			