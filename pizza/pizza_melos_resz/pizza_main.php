<!DOCTYPE html>
<html>
<head>
	<title>Pizzák</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


<?php
	include '../connect.php';


	if (isset($_POST['pizza_szerkeszt'])) {

		$id = $_POST['pizza_id'];
		$sql_update = "SELECT * FROM pizzak WHERE Id = $id";
		$result =  mysqli_query($GLOBALS['conn'],$sql_update);
	
		while ($row = $result-> fetch_assoc()) {

			echo "<div class = 'container col-md-3 p-3 float-left mx-auto'>
			<div class='card bg-dark text-white'>
					<form action = 'pizza_szerkeszt.php' method = 'post' >
					  <img src='kep.jpg' class='card-img-top'>
			<div class='card-body'>
			<input type = 'hidden' value = '".$row['Id']."' name = 'pizza_szerkeszt_id' class = 'form-control'>
			<h5 class='card-title'><h6 class = 'font-weight-bold' >Név:</h6><input type = 'text' value = '".$row['Nev']."' name = 'pizza_szerkeszt_nev' class = 'form-control'></h5>
			<p class='card-text'><h6 class = 'font-weight-bold'>Leírás:</h6><input type = 'text' value = '".$row['Leiras']."' name = 'pizza_szerkeszt_leiras' class = 'form-control'></p>
			<p class='card-text'><label class = 'font-weight-bold' >Ára: </label><input type = 'text' value  ='".$row['Ar']."' name = 'pizza_szerkeszt_ar' class = 'form-control'></p>
			<input type = 'submit' value = 'Jóváhagy' name = 'edit_verify' class = 'btn btn-success'> 
			<input type = 'submit' value = 'Mégse' name = 'cancel'  class = 'btn btn-warning'>
			</form>
			</div>
			</div></div>";	


		}
	}

	if (isset($_POST['pizza_torol'])) { // Ez törli a pizzát
		$id = $_POST['pizza_id'];
		$sql_delete = "DELETE FROM pizzak WHERE Id = '$id'";
		$result =  mysqli_query($GLOBALS['conn'],$sql_delete);
		header('Location:../pizza_show.php');
	}
	$sql = "SELECT * FROM pizzak ORDER BY ID DESC "; // Lekéri az összes pizzát 
			$result =  mysqli_query($conn,$sql);

			while ($row = $result-> fetch_assoc()) {
				echo "
				<div class = 'container col-md-3 p-3 float-left mx-auto'>
				<div class='card-group'>
				  <div class='card bg-dark text-white'>
				  <form action = 'pizza_melos_resz/pizza_main.php' method = 'post'> 
				   <input type = 'hidden' value = '".$row['Id']."' name = 'pizza_id' >
				   	<img class='card-img-top' src='kep.jpg' alt='".$row['Nev']."'>
				    <div class='card-body'>
				      <h5 class='card-title text-center'><b>".$row['Nev']."</b></h5>
				      <p class='card-text'><b>Leírás:</b> <br>".$row['Leiras']."</p>
				      <p class='card-text'><label ><b>Ár:</b> ".$row['Ar']." Ft</label></p>
				      <input type = 'submit' value = 'Szerkesztés' name = 'pizza_szerkeszt' class = 'btn btn-info' id = 'edit'>
				      <input type = 'submit' value = 'Törlés' name = 'pizza_torol' class = 'btn btn-danger'>
				      </form>
				    </div>
				  </div>
				  </div></div>";
}

?>