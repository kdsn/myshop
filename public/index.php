<?php 
session_start();
require '../core/Access.php';
	
$access = new Access;
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['btnSubmit'])) {
	    	    
	    $access->user = $_REQUEST['username'];
		$access->pass = $_REQUEST['password'];
	    
		$access->login();
	    
    }

}
if (isset($_GET['logout'])) {
	    
    	$access->logout();
    	
 }	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>MyShop</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<!-- font-awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

	

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Begin page content -->
    <div class="container">
	        
	    <header>
		    <div class="row">
			    <div class="col-md-4 col-sm-12">
				    <h1 class="logo"><i class="fa fa-tag" aria-hidden="true"></i> My<span class="primary">Shop</span></h1>
				    <p class="subtext">Lorem ipsum dolor sit amet.</p>
			    </div>
			    <div class="col-md-8 col-sm-12 text-right">
				    
				    <!-- Trigger the modal with a button -->
					<a href="/?p=basket" class="action-icons"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										
					<?php if (isset($_SESSION['ui'])) {	?>
					<a href="#" class="action-icons"><i class="fa fa-user" aria-hidden="true"></i></a>
					<a href="?logout=true" class="action-icons"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
					<?php } else { ?>	
					
				    <!-- Trigger the modal with a button -->
					<button class="action-icons" data-toggle="modal" data-target="#myModal"><i class="fa fa-sign-in" aria-hidden="true"></i></button>
					
					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">
					
					  	<form action="#" method="post" autocomplete="off">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header text-left">
							      <span class="h4">Log ind</span>
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						      </div>
						      <div class="modal-body text-left lg-space">						      
							      <div class="form-group md-space">
								      <label class="col-md-4 no-gutter">Brugernavn: </label>
								      <input class="col-md-8" type="text" name="username">
							      </div>
							      <div class="form-group md-space">
								      <label class="col-md-4 no-gutter">Kodeord: </label>
								      <input class="col-md-8" type="password" name="password">
							      </div>
						      </div>
						      <div class="modal-footer">
						        <button type="submit" class="btn" name="btnSubmit" >Log ind</button>
						      </div>
						    </div>
						</form>
					  </div>
					</div>
					<?php } ?>
				    
			    </div>
		    </div>
      	</header>
	    
	    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Forside</a></li>
              <li><a href="#">Nyhedder</a></li>
              <li><a href="#">Tilbud</a></li>
              <li><a href="#">Kontakt</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <form class="navbar-form">
	              <div class="form-group">
		              <input type="text" class="form-control" placeholder="Søg...">
	              </div>
	              <button type="submit" class="btn btn-default">Søg</button>
              </form>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
	    
	<?php
		if (isset ($_SESSION['danger'])) {
			echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['danger'] . "</div>";
			unset($_SESSION['danger']);
		}
		if (isset ($_SESSION['warning'])) {
			echo "<div class='alert alert-warning' role='alert'>" . $_SESSION['warning'] . "</div>";
			unset($_SESSION['warning']);
		}
		if (isset ($_SESSION['info'])) {
			echo "<div class='alert alert-info' role='alert'>" . $_SESSION['info'] . "</div>";
			unset($_SESSION['info']);
		}
		if (isset ($_SESSION['success'])) {
			echo "<div class='alert alert-success' role='alert'>" . $_SESSION['success'] . "</div>";
			unset($_SESSION['success']);
		}
	?>	
	
	<?php
	if (isset($_GET['p'])){	
		switch ($_GET['p']) {
		    case "product":	        
		        include('product.php');
		        break;
		    case "profile":
		        include('profile.php');
		        break;
		    case "basket":
		        include('basket.php');
		        break;
		    default:
		        include('frontpage.php');
		}
	} else {
		include('frontpage.php');
	}
		
	?>
    
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>