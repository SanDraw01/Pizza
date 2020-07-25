<?php 
	include 'minta.php';
	include 'pizza_melos_resz/futar.php';
?>
<div class="container w-50 mx-a my-5 ">
	<div class="card mx-auto bg-dark text-white" style="width: 30rem;">
  <div class="card-body">
    <h5 class="card-title mx-auto">Futár hozzáadása</h5>
    <p class="card-text">

	<form action="futar_hozzaadas.php" method = "POST" > 
		<div class="form-group">
			Futár neve: <input type="text" name="fnev" class="form-control" required>
		</div>
		<div class="form-group">
			Nála levő telefon száma: <input type="number" name="tszam" class="form-control" required>
		</div>
		<input type="submit" name="create" value = "Személy hozzáadása" class = "btn btn-success" class="form-control">
		<input type="button" id="back" value = "Vissza" onclick="vissza()" class = "btn btn-warning" class="form-control">
	</p>
  </div>
</div>
	
</div>
<script type="text/javascript">
	function vissza(){
		window.location.href = "menu.php";
	}
</script>
<?php 

	if (isset($_POST['create'])) {
		$teljesNev = $_POST['fnev'];
		$telefonszam = $_POST['tszam'];

		$futar = new Futar($teljesNev,$telefonszam);
		echo $futar->futarHozzaadas();
	}

?>