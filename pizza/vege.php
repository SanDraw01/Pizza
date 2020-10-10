<?php 
	session_start();
	include 'minta.php';
	include 'connect.php';

	$vevoid = $_SESSION['vevoid'];
	$rendelesek_lekerese = "SELECT * FROM rendeles INNER JOIN pizzak on rendeles.pizzaid = pizzak.id INNER JOIN futarok on rendeles.futarId = futarok.Id WHERE rendeles.vevoid = '$vevoid' AND rendeles.lezart = 0"; // Lekéri a rendeléseket;
	$vevo_adatok = "SELECT * FROM vevo WHERE Id = '$vevoid'";

	$vevo_lekeres = mysqli_query($conn,$vevo_adatok);
	$felkuld = mysqli_query($conn,$rendelesek_lekerese);

	

?>
<form action = "vege.php" method = "POST">
<div class="container bg-light my-5 p-3">
	<div id="printableArea">
		<h3 class= "text-center">Habzsoli rendelés</h3>
	<?php 
		
		while ($row = $vevo_lekeres -> fetch_assoc()) {
			

			echo "
			
			<h6 class= 'text-center'>Vevő neve: ".$row['Neve']."</h6>
			<h6 class= 'text-center'>Vevő címe: ".$row['Cim']."</h6>
			<h6 class= 'text-center'>Vevő másodlagos címe: ".$row['Cim']."</h6>
			<h6 class= 'text-center'>Vevő telefonszáma: ".$row['Tszam']."</h6>
			<h6 class= 'text-center'>Vevő másodlagos telefonszáma: ".$row['Tszam2']."</h6>";
			}
			
		$vegosszeg = 0;
		echo "<table class = 'w-100'><th class = 'w-25'>Pizza neve</th><th class = 'w-25'>Darabszám</th><th class = 'w-25'>Egység ár</th>";
		while ($row = $felkuld -> fetch_assoc()) { // Ez a rész kiírja a kosárban levő elemeket

			$kiviszi = "<h6><b>Futár akinek szállítania kell: ".$row['futarNeve']."</b></h6><br><br>";
			
			echo "
					<tr>
					
						<form action = 'rendeles_felvetel.php' method= 'POST'>
						<td >".$row['Nev']."</td>
						<td >".$row['darab']." db</td>
						<td ><label class = 'px-2'>".$row['Ar']." Ft </label></td>
						</form>
					</tr>
					";
				$osszeg = $row['darab'] * $row['Ar'];
				$vegosszeg += $osszeg;
			
		}
		echo "</table>";
		echo "<br>".$kiviszi;
		echo "<b>Végösszeg: ".$vegosszeg." Ft</b>";
		
		

	?>
	
      
	</div>

	<input type="button" onclick="printDiv('printableArea')" value="Nyomtatás" >
	<input type="submit" name="vege" >


</form>
<br><br>
<?php 
	if(isset($_POST['vege'])){
		$rendelesKod_sql = "SELECT rendelesKodja FROM rendeles ORDER BY rendelesKodja DESC LIMIT 1";
		
		$eredmeny_rendelesKod = mysqli_query($conn,$rendelesKod_sql);

		while ($sor = $eredmeny_rendelesKod -> fetch_assoc()) {
				$kod = $sor['rendelesKodja'];
				$kod = intval($kod)+1;
		}


		$sql = "UPDATE rendeles SET lezart = 1,rendelesKodja = '$kod' WHERE vevoid = '$vevoid' AND lezart = 0";
		mysqli_query($conn,$sql);
		echo "
		<div class='alert alert-success alert-dismissible fade show' role='alert'>
		<strong>Rendelés leadva!</strong>Térj vissza a <a href='menu.php' class='alert-link'>kezdőlapra</a>.
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		  <span aria-hidden='true'>&times;</span>
		</button>
	  </div>

		";
	}
?>
</div>
<script type = "text/javascript">
function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
</script>
