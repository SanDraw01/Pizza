<?php 
	class Vevo{
		public $teljesnev;
		public $cim;
		public $masodlagosCim;
		public $telefonszam;
		public $masodlagosTelefonszam;

		function __construct($teljesnev,$cim,$masodlagosCim,$telefonszam,$masodlagosTelefonszam){
			$this->teljesnev = $teljesnev;
			$this->cim = $cim;
			$this->masodlagosCim = $masodlagosCim;
			$this->telefonszam = $telefonszam;
			$this->masodlagosTelefonszam = $masodlagosTelefonszam;
		}
		function adatFelkuldes(){
			include 'connect.php';
			$sql = "INSERT INTO vevo(Neve,Cim,Cim2,Tszam,Tszam2) VALUES ('$this->teljesnev','$this->cim','$this->masodlagosCim','$this->telefonszam','$this->masodlagosTelefonszam')";
			mysqli_query($conn,$sql);
			$_SESSION['siker'] = 1;
			header("Location: rendeles1.php");
		}
	}

?>