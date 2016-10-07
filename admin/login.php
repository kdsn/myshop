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
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="signin">

    <!-- Begin page content -->
    <div class="container">
	    <form action="#" method="post" autocomplete="off" class="form-signin">
        <h2 class="form-signin-heading">Log ind</h2>
        <label for="inputUser" class="sr-only">Brugernavn</label>
        <input type="text" name="username" id="inputUser" class="form-control" placeholder="Brugernavn" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Adgangskode</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Adgangskode" required="">
        
        <button type="submit" class="btn btn-lg btn-primary btn-block" name="btnSubmit" >Log ind</button>
      </form>
      
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
      
    </div>	    
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>