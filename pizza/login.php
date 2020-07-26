<?php 
	session_start();
	if (isset($_POST['nev']) and isset($_POST['jelszo'])) {
		$nev = $_POST['nev'];
		$jelszo = $_POST['jelszo'];

		if ($nev == "admin" and $jelszo == "admin")  {
			$_SESSION['felhasznalo_nev'] = $nev;
			header('Location: menu.php');
		}else{
			$_SESSION['hiba'] = 1;
			header('Location: index.php');
		}
	}
?>