<?php 

	class Futar{
		public $futarNeve;
		public $futarTelefonszama;
		function __construct($futarNeve,$futarTelefonszama){
			$this->futarNeve = $futarNeve;
			$this->futarTelefonszama = $futarTelefonszama;
		}

		function futarHozzaadas(){
			include 'connect.php';
			$sql = "INSERT INTO futarok(futarNeve,futarTelefonszam,nalalevoPenz) VALUES ('$this->futarNeve','$this->futarTelefonszama',0)";
			mysqli_query($conn,$sql);

			
		}

		function futarSzerkeszt($id){
			include 'connect.php';
			$sql = "UPDATE futarok SET futarNeve = '$this->futarNeve',futarTelefonszam = '$this->futarTelefonszama' WHERE Id = '$id'";
			mysqli_query($conn,$sql); 
			header("Refresh:0");


		}
		function futarTorol($id){
			include 'connect.php';
			$sql = "DELETE FROM futarok WHERE Id = '$id'";
			mysqli_query($conn,$sql); 
			header("Refresh:0");
			
		}

	}

?>