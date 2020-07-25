<?php 
	if (isset($_POST['nev']) and isset($_POST['jelszo'])) {
		$nev = $_POST['nev'];
		$jelszo = $_POST['jelszo'];

		if ($nev == "admin" and $jelszo == "admin")  {
			$_SESSION['felhasznalo_nev'] = $nev;
			header('Location: menu.php');
		}else{
			echo "Hibás bejelentkezési adatok!";
			echo "<a href= 'index.php'>Vissza</a>";
		}
	}
?>