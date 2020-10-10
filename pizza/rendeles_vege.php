<?php 
	session_start();
	include 'minta.php';
?>

<?php 

	include 'connect.php';

	$vevoid = $_SESSION['vevoid'];
	$rendelesek_lekerese = "SELECT * FROM rendeles  INNER JOIN pizzak on rendeles.pizzaid = pizzak.id WHERE rendeles.vevoid = '$vevoid' AND rendeles.lezart = 0" // Lekéri a rendeléseket
	;
	$vevo_adatok = "SELECT * FROM vevo WHERE Id = '$vevoid'";

	$vevo_lekeres = mysqli_query($conn,$vevo_adatok);
	$felkuld = mysqli_query($conn,$rendelesek_lekerese);


	echo "<div class='container py-5 '> 
		  <div class = 'container bg-dark p-5 text-white '>";
		  while ($row = $vevo_lekeres -> fetch_assoc()) {
		  	
		 
		  echo "
		  <h3>".$row['Neve']." kosarának tartalma: </h3>";
		  }
			echo "<table class='table text-white '>
					<th>Pizza neve</th>
					<th>Pizza ára</th>
					<th>Darabszám</th>";
	$vegosszeg = 0;
	while ($row = $felkuld -> fetch_assoc()) { // Ez a rész kiírja a kosárban levő elemeket
		
		echo "
				<tr>
					<form action = 'rendeles_felvetel.php' method= 'POST'>
					<td>".$row['Nev']."</td>
					<td>".$row['Ar']."</td>
					<td><label class = 'px-2'>".$row['darab']."</label></td>
			    	</form>
			    </tr>
			";
			$osszeg = $row['darab'] * $row['Ar'];
			$vegosszeg += $osszeg;

	}

	?>
	

	</table>
		
	<form action = 'rendeles_vege.php' method = 'POST'>
	<h5>Összesen: <?php echo $vegosszeg." Ft"; ?></h5> 
	<h6>Futár hozzárendelése:
	<select name = "futarok">
		<?php 
			$sql = "SELECT Id,futarNeve from futarok";
			$eredmeny = mysqli_query($conn,$sql);
			while ($sor = $eredmeny->fetch_assoc()) {
				echo "<option value = ".$sor['Id'].">".$sor['futarNeve']."</option>";
			}
			
		?>
	</select>
</h6>
		<input type = 'submit' class = 'btn btn-success text-center' name = 'rendeles_befejezese2' value= 'Rendelés befejezése'>
		<input type = 'submit' class = 'btn btn-warning text-center' name = 'vissza' value= 'Vissza'>
	</form>
	
	</div></div>

	<?php 
	
    if (isset($_POST['rendeles_befejezese2'])) {
    	$futarId = $_POST['futarok'];

    	$lezaro = "UPDATE rendeles SET lezart = 0 , futarId = '$futarId' WHERE vevoid = '$vevoid' AND rendelesKodja = 0";
    	$felkuld = mysqli_query($conn,$lezaro);

    	$penzFeltolt = "UPDATE futarok SET nalalevoPenz = '$vegosszeg' WHERE Id = '$futarId'";
    	mysqli_query($conn,$penzFeltolt);
    	
    	header("Location: vege.php");
    }
    if (isset($_POST['vissza'])) {
    	header('Location: rendeles_felvetel.php');
    }

?>