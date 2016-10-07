<?php

class Access {
	
	public $user;
	public $pass;
	
	public function login(){
		
		if(!empty($this->user) && $this->user != "" && !empty($this->pass) && $this->pass != ""){
		
		
			try {
			    $conn = new PDO("mysql:host=localhost;dbname=MyShopDB;charset=utf8", DBUSER, DBPASS);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    
			    $query = $conn->query('SELECT * FROM user WHERE username = "' . $this->user . '"');
				$count = $query->rowCount();
				
				if($count == 1){
					
					while($r = $query->fetch(PDO::FETCH_ASSOC)) {
						
						$half = (int) ( (strlen($this->pass) / 2) );
						$pw[1] = substr($this->pass, 0, $half);
						$pw[2] = substr($this->pass, $half);
									
						$salted_pw = $pw[1] . $r['salt'] . $pw[2];
						$hashed_pw = hash('whirlpool', $salted_pw);

						if($hashed_pw === $r['password']){
				
							$_SESSION['ui'] = $r['username'];
							$_SESSION['success'] = 'Du er nu logget ind, velkommen...';
							
							$q_admin = $conn->query('SELECT * FROM staff WHERE user_id = "' . $r['user_id'] . '"');
							$adminCount = $q_admin->rowCount();
							
							if ($adminCount == 1){
								$_SESSION['isAdmin'] = true;
								
								$_SESSION['success'] = 'Du er nu logget ind som admin';
								
								header('location: /admin');
							}
							
						} else {
							$_SESSION['danger'] = 'Brugernavn og adgangskode matcher ikke!';
						}
						
					}
					
				} else {
					$_SESSION['danger'] = 'Vi kan ikke finde det brugernavn. Har du registreret dig?';
				}

			} catch(PDOException $e) {
			    echo 'beklager, der er problmer med databasen';
			}
			
		} else {
			$_SESSION['danger'] = 'Både brugernavn og adgangskode skal udfyldes';
		}
	}
	
	public function logout(){
		unset($_SESSION['ui']);
		unset($_SESSION['isAdmin']);
		header('location: /');
	}
	
}
?>