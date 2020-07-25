<?php 
	include 'connect.php';
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
	<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
	<title>Vásárlók keresése</title>
	
</head>
<body class="bg-secondary text-white">
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
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
      <li class="nav-item">
        <a class="nav-link" href="maleadott.php">Ma leadott rendelések</a>
      </li>
      <li class='nav-item dropdown'>
    <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Futárok</a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='futar_hozzaadas.php'>Futár hozzáadása</a>
                  <a class='dropdown-item' href='futar_szerkesztes.php'>Futárok szerkesztése/törlése</a>
                <div class='dropdown-divider'></div>
             <a class='dropdown-item' href='#'>Futár követés</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container w-50 my-5 bg-dark p-3">
	<form method="POST" action="vevok_keresese.php">
  <div class="form-group">
    <label for="telefonszam">Telefonszám: </label>
    <input type="number" class="form-control" id="telefonszam" aria-describedby="telefon" placeholder="Írja be az ügyfél telefonszámát" name = 'telefonszam' >
  </div>
  <input type="submit" class="btn btn-info" value = "Keresés "id="kereses" name="kereses">
  <input type="submit" class="btn btn-warning" value = "Eltüntet "id="clear" name="clear">
</form>
</div>
<div class="container my-5">
<table class="table table-dark">
	<th>Vevő neve</th>
	<th>Telefonszám</th>
	<th>Másodlagos telefonszám</th>
	<th>Elsődleges Cím</th>
	<th>Másodlagos cím</th>
	<th>Folytatás</th>
<?php 
	if (isset($_POST['telefonszam']) and isset($_POST['kereses'])) {
		$telefonszam = $_POST['telefonszam'];
		$sql = "SELECT * FROM vevo WHERE Tszam LIKE '%$telefonszam%' OR Tszam2 LIKE '%$telefonszam%'";
		$res = mysqli_query($conn,$sql);
?>
<form action = "vevok_keresese.php" method = "POST"> 
<?php
	while ($row = $res ->fetch_assoc()) {
			echo "<tr>
					  <td>".$row['Neve']."</td>
					  <td>".$row['Tszam']."</td>
					  <td>".$row['Tszam2']."</td>
					  <td>".$row['Cim']."</td>
					  <td>".$row['Cim2']."</td>
					  <td><button type = 'submit' class ='btn btn-success' name = 'tovabb' value = ".$row['Id']." >Rendelés felvétel</button>
					  </td>
					</tr>
				";
		}
	}
	if (isset($_POST['tovabb'])) {
		$_SESSION['vevoid'] =  $_POST['tovabb'];
		header("Location: rendeles_felvetel.php");
	}
?>
</form>
</table>
</div>
	<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
</body>
</html>