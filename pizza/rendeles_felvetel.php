<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
	<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
	<title>Pizzák hozzáadása</title>
</head>
<body class="bg-secondary"><nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="menu.php">Habzsoli oldal</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="pizza_hozzaadas.php">Pizza hozzáadása</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pizza_show.php">Pizzák</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="rendeles1.php">Rendelés felvétel</a>
      </li>
    </ul>
  </div>
</nav>

<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
</body>
</html>

<?php 
	session_start();
	include 'connect.php';

	$vevoid = $_SESSION['vevoid'];

	$sql = "SELECT * FROM vevo WHERE Id = '$vevoid'"; // Lekéri a vevő adatait
	$sql_pizzak = "SELECT * FROM pizzak"; // lekéri a pizzák adatait
	$rendelesek_lekerese = "SELECT * FROM rendeles  INNER JOIN pizzak on rendeles.pizzaid = pizzak.id WHERE rendeles.vevoid = '$vevoid' AND rendeles.lezart = 0"; // Lekéri a rendeléseket
	$futar_leker = "SELECT * FROM futarok";
	

	$felkuld = mysqli_query($conn,$rendelesek_lekerese);
	$result = mysqli_query($conn,$sql);
	$pizza_result = mysqli_query($conn,$sql_pizzak);
	$futarok = mysqli_query($conn,$futar_leker);

	while ($row = $result -> fetch_assoc()) { //Kiírja a vevő adatait felülre
		echo "<div class='container'>
				<div class='card w-100 my-5'>
				<div class='card-body bg-dark text-white'>
				<div class='row'>
				<div class='col'><p>Vásárló neve: <b>".$row['Neve']."</b></p></div></div>
				<div class = 'row'>
				<div class='col'><p>Címe: <b>".$row['Cim']."</b></p></div>
					<div class = 'col'>Másodlagos címe: <b>".$row['Cim2']."</b></div>
				</div>
				<div class = 'row'>
					<div class = 'col'>Telefonszáma: <b>".$row['Tszam']."</b></div>
					<div class = 'col'>Másodlagos telefonszáma: <b>".$row['Tszam2']."</b></div>
				


				</div></div></div></div>";
	}
	echo "<div class='container '> 
		  <div class = 'container bg-dark p-3 text-white '>
		  <h3>Kosár tartalma: </h3>

				<table class='table text-white '>
					<th>Pizza neve</th>
					<th>Pizza ára</th>
					<th>Darabszám</th>";
?>

	
	<?php

	while ($row = $felkuld -> fetch_assoc()) { // Ez a rész kiírja a kosárban levő elemeket
		echo "
				<tr>
					<form action = 'rendeles_felvetel.php' method= 'POST'>

					<td>".$row['Nev']."</td>
					<td>".$row['Ar']."</td>
					<td><button type = 'submit' name = 'levon' class = 'btn btn-danger' value = ".$row['Id']." >-</button><label class = 'px-2'>".$row['darab']."</label><button type = 'submit'name = 'rendel' value = ".$row['Id']." class = 'btn btn-success'>+</button></td>
			    	</form>
			    </tr>
			";
	}
	echo "

	</table>
	<form action = 'rendeles_vege.php' method = 'POST'>
	<input type = 'submit' class = 'btn btn-success text-center' name = 'rendeles_befejezese' value= 'Rendelés befejezése'></form>
		</div></div><br><br>";
    
?>

 

<?php 
	if (isset($_POST['rendel'])) { // Ha meg lett nyomva a termék hozzáadása
		

		header("Refresh:0");
		$pizza_id =  $_POST['rendel'];
		$darab = 1;
		$datum = date("Y-m-d");

		$sql_leker = "SELECT Ar FROM pizzak WHERE Id = '$pizza_id'"; // Ez lekéri nekem a pizzák árait
		$result = mysqli_query($conn,$sql_leker);

		while ($row = $result->fetch_assoc()) {
			$ar = $row['Ar'];
		}

		

		$sql_check = "SELECT * FROM rendeles WHERE vevoid = '$vevoid' AND pizzaid = '$pizza_id' AND 
		datum = '$datum' AND lezart = 0";


		$vegrehajt = mysqli_query($conn,$sql_check);
		$checkrows = mysqli_num_rows($vegrehajt);

		if ($checkrows > 0) { // Ez megnézi, hogy van e már ilyen sor az adatbázisba
			while ($row = $vegrehajt -> fetch_assoc()) {
				$tenyleges_darab = $row['darab'];
				$id = $row['Id'];
			}
			$tenyleges_darab += 1;
			$osszeg = $tenyleges_darab * $ar;
			$frissit = "UPDATE rendeles SET darab = '$tenyleges_darab', sum = '$osszeg' WHERE Id = '$id' "; //Ez a rész le frissíti ha talál
			$frissites = mysqli_query($conn,$frissit);
		}
		else{ // Ha nem talál akkor hozzáad egy új sort a táblához
			$sum = $darab * $ar;
			$time = date('H:i:s');
			$sql_rendeles1 = "INSERT INTO rendeles(vevoid,pizzaid,datum,ar,darab,lezart,mikor,sum) VALUES ('$vevoid','$pizza_id','$datum','$ar','$darab',0,'$time','$sum')";
			$result_rendeles1 = mysqli_query($conn,$sql_rendeles1);
		}
		

	}
	if (isset($_POST['levon'])) { // Ez csinálja a levonást 
		header("Refresh:0");
		$datum = date("Y-m-d");
		$pizza_id = $_POST['levon'];
		$sql_check = "SELECT * FROM rendeles WHERE vevoid = '$vevoid' AND pizzaid = '$pizza_id' AND 
		datum = '$datum' AND lezart = 0";

		$sql_leker = "SELECT Ar FROM pizzak WHERE Id = '$pizza_id'"; // Ez lekéri nekem a pizzák árait
		$result = mysqli_query($conn,$sql_leker);

		while ($row = $result->fetch_assoc()) {
			$ar2 = $row['Ar'];
		}


		$vegrehajt = mysqli_query($conn,$sql_check);
		$checkrows=mysqli_num_rows($vegrehajt);


		if ($checkrows > 0) { // Ez megnézi, hogy van e már ilyen sor az adatbázisba
			while ($row = $vegrehajt -> fetch_assoc()) {
				$tenyleges_darab2 = $row['darab'];
				$id = $row['Id'];
				
			}

			if ($tenyleges_darab2 < 2) {
				$torol = "DELETE FROM rendeles WHERE Id = '$id'";
				mysqli_query($conn,$torol);
			}else{
				$tenyleges_darab2 -= 1;
				$osszeg2 = $tenyleges_darab2 * $ar2;
				$frissit2 = "UPDATE rendeles SET darab = '$tenyleges_darab2', sum = '$osszeg2'  WHERE Id = '$id'

				"; //Ez a rész le frissíti ha talál

				$frissites2 = mysqli_query($conn,$frissit2);

			}
			
		}


	}
			

?>
<div class="container">
	<table class="table table-dark ">
		<form action = 'rendeles_felvetel.php' method="POST">
		<th>Pizza neve</th>
		<th>Pizza ára</th>
		<th>Termék hozzáadása</th>
		
		<?php

			while($row = $pizza_result -> fetch_assoc()) {
				echo "<tr><td>".$row['Nev']."</td>";
				echo "<td>".$row['Ar']."</td>";
				echo "<td><button type = 'submit' name = 'rendel' value = ".$row['Id']." class = 'btn btn-info'>Termék hozzáadása</button></td>
				</tr>";
			}
		?>
	</form>
	</table>
</div>

