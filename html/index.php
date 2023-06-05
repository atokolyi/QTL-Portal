<!doctype html>
<html lang="en">
  <head>

	  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23bb6ee7%22></rect><path d=%22M65.17 79.32L65.17 82.72L34.83 82.72L34.83 79.32Q37.72 79.24 39.46 78.77Q41.20 78.30 42.14 77.03Q43.07 75.75 43.41 73.42Q43.75 71.08 43.75 67.08L43.75 67.08L43.75 32.91Q43.75 29.34 43.45 27.01Q43.16 24.67 42.31 23.31Q41.46 21.95 39.89 21.40Q38.31 20.84 35.68 20.67L35.68 20.67L35.68 17.27L64.32 17.27L64.32 20.67Q61.69 20.84 60.12 21.40Q58.54 21.95 57.69 23.31Q56.84 24.67 56.55 27.01Q56.25 29.34 56.25 32.91L56.25 32.91L56.25 67.08Q56.25 71.08 56.55 73.42Q56.84 75.75 57.82 77.03Q58.80 78.30 60.54 78.77Q62.28 79.24 65.17 79.32L65.17 79.32Z%22 fill=%22%23fff%22></path></svg>" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INTERVAL QTL portal</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src='https://cdn.plot.ly/plotly-2.9.0.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.11.4/features/scrollResize/dataTables.scrollResize.min.js"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locuszoom@0.13.4/dist/locuszoom.css" type="text/css" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/d3@^5.16.0" type="application/javascript"></script>
    <script src="/locuszoom.app.min.js" type="application/javascript"></script>


    <!-- Custom styles for this template -->
    <link href="/css/sticky-footer-navbar.css" rel="stylesheet">

    <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>

  </head>

  <body>

<nav class="navbar navbar-inverse">
	  <div class="container-fluid" style="padding-left: 0px">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a href="/" class="navbar-left"><img height=48 style="padding-left: 2px; padding-top: 2px; padding-right: 2px;" src="/images/INTERVAL_rna_portal_logo.svg"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
<?php
	$servername = "mysql-server";
	$username = "root";
	$password = "test";
	$dbname = "interval";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = 'SELECT * FROM projects';
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
      			echo '<li><a href="/browse/?id='.$row['code_name'].'">'.$row['nice_name'].'</a></li>';
		}
	}
?>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">    
  <div class="row content">
  </div>
</div>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">Developed by <a href="https://alextokolyi.com/" target="_blank">Alex Tokolyi</a> as part of the INTERVAL consortium, 2021.</span>
      </div>
    </footer>

  </body>
</html>

