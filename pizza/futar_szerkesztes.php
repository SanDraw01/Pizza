<?php 
	include 'connect.php';
	include 'minta.php';
	include 'pizza_melos_resz/futar.php';

?>
<div class="container my-5">
<table class="table table-dark">
	<form action = 'futar_szerkesztes.php' method="POST">
	<th>Azonosítója</th>
	<th>Futár neve</th>
	<th>Telefonszáma</th>
	<th>Szerkesztés</th>
	<th>Törlés</th>
<?php 
	$sql = "SELECT * FROM futarok";
	$eredmeny = mysqli_query($conn,$sql);

	while ($sor = $eredmeny -> fetch_assoc()) {
		$input1 = 'nev'.$sor['Id'];
		$input2 = 'tszam'.$sor['Id'];
		echo "<tr>
					  <td class= 'text-center'>".$sor['Id']."</td> 
					  <td><input type = 'text' class = 'form-control' value = ".$sor['futarNeve']." name = ".$input1."></td>
					  <td><input type = 'number' class = 'form-control' value = ".$sor['futarTelefonszam']." name = ".$input2."></td>
					  <td><button type = 'submit' class ='btn btn-success'  name = 'szerkeszt' value = ".$sor['Id']." >Futár szerkesztés</button>
					  </td>
					  <td><button type = 'submit' class ='btn btn-danger' name = 'torles' value = ".$sor['Id']." >Futár törlése</button></td>
					</tr>
					
				";
	}
	echo "</form>";

	if (isset($_POST['szerkeszt'])) {
		$futarneve = $_POST["nev".$_POST['szerkeszt']];
		$telefonszam = $_POST["tszam".$_POST['szerkeszt']];
		
		$futar = new Futar($futarneve,$telefonszam);
		$futar->futarSzerkeszt($_POST['szerkeszt']);

	}
	if (isset($_POST['torles'])) {
		$futarneve = $_POST["nev".$_POST['torles']];
		$telefonszam = $_POST["tszam".$_POST['torles']];
		
		$futar = new Futar($futarneve,$telefonszam);
		$futar->futarTorol($_POST['torles']);
	}
	
?>
