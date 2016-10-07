<?php
require '../core/connect.php';
	
$activ_nav = "produkter";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['btnAdd'])) {
		
		$name 			= $_REQUEST['name'];
		$description	= $_REQUEST['description'];
		$price			= $_REQUEST['price'];
		if (!is_numeric ( $price )) {			
			$_SESSION['danger'] = "Prisen skal være et tal!";
			
			header('location: /admin/?p=product&add=1');
			exit;
		}
		$image			= addslashes(file_get_contents($_FILES['img']['tmp_name']));
		
		if (isset($image)){
			$sql = "
		    	INSERT INTO product 
		    		(name, description, price, image)
		    	VALUES
		    		('$name','$description',$price,'{$image}')
		    ";
		} else {
			$sql = "
		    	INSERT INTO product 
		    		(name, description, price)
		    	VALUES
		    		('$name','$description',$price)
		    ";
		}
		
		$conn->exec($sql);
		header('location: /admin/?p=products');
    }
    if (isset($_POST['btnEdit'])) {
	    
	    $pid = $_GET['edit'];
	    
		$name 			= $_REQUEST['name'];
		$description	= $_REQUEST['description'];
		$price			= $_REQUEST['price'];
		if (!is_numeric ( $price )) {			
			$_SESSION['danger'] = "Prisen skal være et tal!";
			
			header('location: /admin/?p=product&edit='.$_GET['edit']);
			exit;
		}
		$image			= addslashes(file_get_contents($_FILES['img']['tmp_name']));
		
		if (isset($image) && $image != ""){
			$sql = $conn->query("
				UPDATE product SET 
					name 		= '$name',
					description = '$description',
					price 		= '$price',
					image 		= '$image'
				WHERE 
					id = '$pid'
		    ");
			
		} else {
			$sql = $conn->query("
				UPDATE product SET 
					name 		= '$name',
					description = '$description',
					price 		= '$price'
				WHERE 
					id = '$pid'
		    ");
		}			
			
		
		
		
		$conn->exec($sql);
		header('location: /admin/?p=products');
    }

}	
if(isset($_GET[del])){
	$sql = $conn->query(" DELETE FROM product WHERE id = '$_GET[del]' ");
						
	$conn->exec($sql);
	header('location: /admin/?p=products');
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
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Begin page content -->
    <!-- Heading -->
    <div class="row admin-header">
	    <div class="col-md-3 text-center">
		    <h1 class="admin-logo"><i class="fa fa-tag" aria-hidden="true"></i> My<span class="primary">Shop</span></h1>
	    </div>
	    
	    <div class="col-md-9">
		    <h4 class="admin-loc">Produkter</h4>
		    <a href="?logout=true" class="logout">Log ud</a>
	    </div>
    </div>
    <!-- main -->
    <div class="row">
	    <?php
		    include 'nav.php';
	    ?>
	    
	    <div class="col-md-9">
			<div class="col-md-12 lg-space">
				
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
					
					if(isset($_GET[add])){
						
						?>
						<form action="#" enctype="multipart/form-data" method="post">
							<div class="form-group">
							    <label for="name">Navn</label>
							    <input type="text" class="form-control" id="name" name="name" placeholder="Skriv varens navn">
							</div>
							  
							<div class="form-group">
							    <label for="description">Beskrivelse</label>
								<textarea class="form-control" rows="3" name="description" placeholder="Skrive en beskrivelse af varen"></textarea>
							</div>
				
							<div class="form-group">
								<label for="price">Pris</label>
								<input type="text" class="form-control" id="price" name="price" placeholder="Varens pris">
							</div>
								  
							<div class="col-md-6 no-gutter-l">
								<div class="form-group">
									<label for="billede">Billede</label>
									<input type="file" class="form-control" id="img" name="img">
								</div>
							</div>
							<div class="col-md-6 no-gutter-r">
								<div class="form-group lg-space">
								</div>
							</div>
							<input class="btn btn-default" type="submit" name="btnAdd" value="Gem">
						</form>
						<?php
						
					}
					if(isset($_GET[edit])){
						$query = $conn->query('SELECT * FROM product WHERE id = "'. $_GET['edit'] .'"');
						while($u = $query->fetch(PDO::FETCH_ASSOC)) {
						
							?>
							<form action="#" enctype="multipart/form-data" method="post">
								<div class="form-group">
								    <label for="name">Navn</label>
								    <input type="text" class="form-control" name="name" id="name" value="<?php echo $u['name']?>">
								</div>
								  
								<div class="form-group">
								    <label for="description">Beskrivelse</label>
									<textarea class="form-control" id="description" name="description" rows="3"><?php echo $u['description']?> </textarea>
								</div>
					
								<div class="form-group">
									<label for="price">Pris</label>
									<input type="text" class="form-control" id="price" name="price" value="<?php echo $u['price']; ?>">
								</div>
									  
								<div class="col-md-6 no-gutter-l">
									<div class="form-group">
										<label for="billede">Billede</label>
										<input type="file" class="form-control" id="billede" name="img">
									</div>
								</div>
								<div class="col-md-6 no-gutter-r">
									<div class="form-group">
										<?php
										echo '<img src="data:image/jpeg;base64,'.base64_encode( $u['image'] ).'"  class="product-img" />';
										?>
									</div>
								</div>
								<input class="btn btn-default" type="submit" name="btnEdit" value="Opdater">
							</form>
							<?php
						}
					}
				?>
				
		    </div>
	    </div>
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