<?php 
	session_start();
	include 'connect.php';
	include 'minta.php';
	include 'pizza_melos_resz/vevo.php';

	if (isset($_POST['create'])) {
		$teljesnev = $_POST['teljes_nev'];
		$cim = $_POST['cim'];
		$masodlagosCim = $_POST['cim2'];
		$telefonszam = $_POST['telefonszam'];
		$masodlagosTelefonszam = $_POST['telefonszam2'];

		$vevo = new Vevo($teljesnev,$cim,$masodlagosCim,$telefonszam,$masodlagosTelefonszam);
		$vevo->adatFelkuldes();
		
	}

?>

	<div class="container w-50 mx-a my-5 ">
	<div class="card mx-auto bg-dark text-white" style="width: 30rem;">
  <div class="card-body">
    <h5 class="card-title mx-auto">Vevő Felvétele</h5>
    <p class="card-text">
	<form action="vevok_hozzaadasa.php" method = "POST" > 
		<div class="form-group">
			Teljesnév: <input type="text" name="teljes_nev" class="form-control" required>
		</div>
		<div class="form-group">
			Cím : <input type="text" name="cim" class="form-control" required>
		</div>
		<div class="form-group">
			Cím 2 : <input type="text" name="cim2" class="form-control">
		</div>
		<div class="form-group">
			Telefonszám : <input type="number" name="telefonszam" class="form-control" required>
		</div>
		<div class="form-group">
			Telefonszám 2 : <input type="number" name="telefonszam2" class="form-control">
		</div>
		<input type="submit" name="create" value = "Személy hozzáadása" class = "btn btn-success" class="form-control">
		<input type="button" id="back" value = "Vissza" onclick="vissza()" class = "btn btn-warning" class="form-control">
	</p>
  </div>
</div>
	
</div>
<script type="text/javascript">
	function vissza(){
		window.location.href = "rendeles1.php";
	}
</script>
