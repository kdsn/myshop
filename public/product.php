<?php

require '../core/connect.php';
		
// Henter produktet fra databasen.
$query = $conn->query('SELECT * FROM product WHERE id = "'. $_GET['pid'] .'"');
while($u = $query->fetch(PDO::FETCH_ASSOC)) {
?>
<section>
	<div class="row">
		<div class="col-md-4">
			<?php
				// Udskriver billedet fra databasen til skærmen (base64_encode laver blobben om til billede).
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $u['image'] ).'" width="100%" />';
			?>
			
			 
		</div>
		<div class="col-md-8">
			<h2><?php echo $u['name'] ?></h2>
			<span class="h4 text-right block">
				<?php 
					// Fromatere prisen fra databasen i forhold til antal decimaler, decimal seperator og tusindtals seperator.
					echo number_format($u['price'], 2, ',', '.');
				?> kr.
			</span>
			
			<hr>
			
			<div class="form-group md-space">
				<form action="product_exe.php" method="post">
					<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>">
					<table class="shop-item-selections" align="center">
						<tbody>
						<tr>
							<td><b>Antal:</b></td>
							<td><input type="number" class="form-control" name="quantity" value="1"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">								
						        <button type="submit" class="btn btn-success margin-top" name="btnAdd">Tilføj til kurv</button>
						    </td>
						</tr>
						</tbody>
					</table>
				</form>
			</div>

			<hr>
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingOne">
				    	<h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Produkt beskrivelse
					        </a>
				      	</h4>
				    </div>
				    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				    	<div class="panel-body">
				        	<?php echo $u['description']?>
						</div>
				    </div>
				</div>
				<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingTwo">
				    	<h4 class="panel-title">
				        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Specifikationer
				        	</a>
				    	</h4>
				    </div>
				    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				    	<div class="panel-body">
				        	3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
				        </div>
				    </div>
				</div>
				<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingThree">
				      	<h4 class="panel-title">
				        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Betømmelser
				        	</a>
				      	</h4>
				    </div>
				    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				      	<div class="panel-body">
				        	Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.				      				</div>
				    </div>
				</div>
			</div>
		
		</div>
	</div>
</section>
<?php	
}
?>

	 
