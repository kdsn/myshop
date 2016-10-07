<div class="jumbotron feautered ">
		<div class="col-md-6">
			<h2>Den helt nye iPhone 7</h2>
			<p class="md-space no-gutter">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				<span class="block text-right"><a>Læs mere...</a></span>
			</p>
		</div>
		<div class="col-md-6 relative">
			<img src="http://iphone7-s.fr/wp-content/uploads/2016/01/iPhone-7-Memoire-RAM.jpg" align="middle">
		</div>
	</div>
    
      
      <p class="lead">
	      Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	      </p>
    
	  
		<section id="products">
			<div class="row">
				
			<?php
			
			$query = $conn->query('SELECT * FROM product');
			$count = $query->rowCount();
			if($count == 0){
				echo "<div class='col-md-12'><div class='alert alert-info' role='alert'> Der blev ikke fundet nogen produkter! </div></div>";
				
			} else {
				while($r = $query->fetch(PDO::FETCH_ASSOC)) {
					?>
					
					<div class="col-md-4">
						<div class="thumbnail">
							<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $r['image'] ).'" class="sm-space" />'; ?>
							<div class="caption">
								<span class="h4 text-right block"><?php echo number_format($r['price'], 2, ',', '.');?> kr.</span>
								
								
								<h4><a href="?p=product&pid=<?php echo $r['id'];?>"><?php echo $r['name'];?></a></h4>
								<p style="overflow: hidden; max-height: 120px;">
									<?php
									if (strlen($r['description']) > 285){
										echo substr($r['description'], 0, 280) . '...';
									} else {
										echo $r['description'];
									}
									?>
								</p>
							</div>
						</div>
					</div>
					
					<?php
				}
			}
			
			?>
				
			</div>
		</section>