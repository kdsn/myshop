<?php
session_start();
// Kontrollere om der er trykket på en knap.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Kontrollere om knappen "Tilføj til kurv" er blevet aktiveret.
    if (isset($_POST['btnAdd'])) {
	    
		// Sætter variabler fra formularen.
	    $pid = $_REQUEST['pid'];
	    $quantity = $_REQUEST['quantity'];
	    // Sætter variable til senere brug.
	    $wasFound = false;
	    $i = 0;

		if (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
			// Køres hvis sessions variablen "cart" ikke findes eller er tom.
			// Tilføjer produkt til kurven.
			$_SESSION['cart'] = array(0 => array("item_id" => $pid, "quantity" => $quantity));
		} else {
			// Køres hvis sessions variablen "cart" indeholder mindst en ting.
			// Gennemløber ting i kurven
			foreach ($_SESSION['cart'] as $each_item) {
				// Gennemsøger "høstakken" for "nålen" (gennemløber arrayet og undersøger om der er nogen item_id  med værdien fra $pid).
				while (list($key, $value) = each($each_item)) {
					if ($key == "item_id" && $value == $pid) {
						// Opdaterer antal for det fundne produkt.
						array_splice($_SESSION['cart'], $i, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + $quantity)));
						
						$wasFound = true;
					}
				}
				
				$i++;
			}
			// Køre hvis denne vare type ikke blev fundet i kurven.
			if ($wasFound == false) {
				// Tilføjer nyt produkt til kurven.
				array_push($_SESSION['cart'], array("item_id" => $pid, "quantity" => $quantity));
			}
		}
    }
    $_SESSION['info'] = "Produktet blev tilføjet din kurv!";
    header('location: /?p=product&pid='.$pid);
    
} else {
	header('location: /');
}
?>