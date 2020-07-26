<?php
	include 'connect.php';

	if (isset($_POST['futarid'])) {
		$futarid = $_POST['futarid'];
		$sql = "SELECT * FROM futarok WHERE Id = '$futarid'";
		$eredmeny = mysqli_query($conn,$sql);

		echo "<table class = 'table table-dark'><th>Futár neve:</th><th>Futár telefonszáma</th>
		<th>Ennyi pénz van nála</th>";
		while ($sor = $eredmeny -> fetch_assoc()) {
			echo "<tr><td>".$sor['futarNeve']."</td><td>".$sor['futarTelefonszam']."</td>
			<td>".$sor['nalalevoPenz']." Ft</tr>";
		}
		echo "</table>";
	}	

?>