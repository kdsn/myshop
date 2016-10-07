<?php

define("DBUSER",		"MyShopDB");
define("DBPASS",		"oZ2-2fX-aL4-J67-uGt-98G-gXi-BaV");

try {
	$conn = new PDO("mysql:host=localhost;dbname=MyShopDB;charset=utf8", DBUSER, DBPASS);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'beklager, der er problmer med databasen';
}

?>
