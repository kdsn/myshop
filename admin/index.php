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
 
 
if (!isset ($_SESSION['uid']) && $_SESSION['isAdmin'] != true) {
	
	include('login.php');

} else {
	
	switch ($_GET['p']) {
	    case "product":	        
	        include('product.php');
	        break;
	    case "products":
	        include('products.php');
	        break;
	    case "orders":
	        include('orders.php');
	        break;
	    default:
	        include('dashboard.php');
	}
}

?>