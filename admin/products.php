<?php
	require '../core/connect.php';
	
	$activ_nav = "produkter";
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
				    <div class="text-right">
					    <a href="/admin/?p=product&add=1"><h2 class="padd"><i class="fa fa-trash admin-loc" aria-hidden="true"></i> Tilføj nyt produkt</h2></a>
				    </div>
				    <?php
					$query = $conn->query('SELECT * FROM product');
					$count = $query->rowCount();
					if($count == 0){
						echo "<div class='col-md-12'><div class='alert alert-info' role='alert'> Der blev ikke fundet nogen produkter! </div></div>";
					} else {
					?>
					<table class="table table-hover">
				    <thead> 
					    <tr> 
					    	<th width="50px" class="text-center">#</th> <th class="text-left">Navn</th> <th width="125px">Pris</th> <th width="125px">Handling</th>
					    </tr> 
					</thead>
					<tbody>
					<?php
						while($r = $query->fetch(PDO::FETCH_ASSOC)) {
						?>
						<tr>
							<td><?php echo $r['id'];?></td>
							<td><?php echo $r['name'];?></td>
							<td class="text-right"><?php echo number_format($r['price'], 2, ',', '.');?> kr.</td>
							<td class="text-center"><a href="/admin/?p=product&edit=<?php echo $r['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp; <a href="/admin/?p=product&del=<?php echo $r['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
						</tr>
						
						<?php
						}
					?>
					</tbody>
					</table>	
					<?php
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