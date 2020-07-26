<?php
	include 'connect.php';

	if (isset($_POST['futarid'])) {
		$futarid = $_POST['futarid'];
		$sql = "SELECT * FROM rendeles WHERE futarId = '$futarid'";
		$eredmeny = mysqli_query($conn,$sql);

		echo "<table>";
		while ($sor = $eredmeny -> fetch_assoc()) {
			echo "<tr><td>".$sor['Id']."</td><td>".$sor['vevoid']."</td></tr>";
		}
		echo "</table>";
	}	

?>