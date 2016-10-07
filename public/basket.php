<?php
require '../core/connect.php';
	
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
	echo "<div class='alert alert-warning' role='alert'> Kurven er tom! </div>";
} else {
?>

<div class="stepwizard">
    <div class="stepwizard-row">
	    
        <div class="stepwizard-step">
            <button type="button" class="btn btn-primary btn-circle">1</button>
            <p>Kurv</p>
        </div>
         <div class="stepwizard-step">
            <button type="button" class="btn btn-default btn-circle" >2</button>
            <p>Fragt</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
            <p>Betaling</p>
        </div>
         
    </div>
</div>

<div class="row">
	<div class="col-md-12 lg-space">
		<table class="table table-hover">
			<thead> 
				<tr> 
					<th width="50px">#</th> <th style="text-align: left;">Vare</th> <th width="125px">Pris</th> <th  width="75px">Antal</th> <th  width="125px">Ialt</th> 
				</tr> 
			</thead>
			<tbody> 
				
<?php
	
	
	$_SESSION['cart_total'] = null;
	
	foreach ($_SESSION['cart'] as $item) {
		
		$q_item = $conn->query('SELECT * FROM product WHERE id = "' . $item['item_id'] . '"');
		
		while ($u = $q_item->fetch(PDO::FETCH_ASSOC)) {
			
			if (isset ($_SESSION['cart_total'])) {
				$_SESSION['cart_total'] = $_SESSION['cart_total'] + $u['price'] * $item['quantity'];
			} else {
				$_SESSION['cart_total'] = $u['price'] * $item['quantity'];
			}
			
			?>
				<tr> 
					<td class="vm-tr"><?php echo $u['id'];?></td> 
					<td class="vm"><?php echo $u['name'];?></td> 
					<td class="vm-tr"><?php echo number_format($u['price'], 2, ',', '.');?> kr.</td> 
					<td class="vm-tr"><input type="number" class="form-control" value="<?php echo $item['quantity'];?>"></td> 
					<td class="vm-tr"> <?php echo number_format($u['price'] * $item['quantity'], 2, ',', '.');?> kr.</td>
				</tr>
			<?php
			
		}
	}
?>
			</tbody>
			<tfoot>
				<tr> 
					<td colspan="3"></td> <th class="vm">I alt:</th> <th class="vm-tr"> <?php echo number_format($_SESSION['cart_total'], 2, ',', '.');?> kr.</th>
				</tr> 
			</tfoot>
		</table>
	</div>
</div>
<?php
}
?>