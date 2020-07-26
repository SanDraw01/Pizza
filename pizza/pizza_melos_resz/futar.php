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
			echo "
			<div class = 'container'>
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
			  <strong>Siker!</strong> Futár sikeresen hozzáadva az adatbázishoz!
			  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			    <span aria-hidden='true'>&times;</span>
			  </button>
			</div></div>";
		}
		function futarSzerkeszt($id){
			include 'connect.php';
			$sql = "UPDATE futarok SET futarNeve = '$this->futarNeve',futarTelefonszam = '$this->futarTelefonszama' WHERE Id = '$id'";
			mysqli_query($conn,$sql); 
			echo("<meta http-equiv='refresh' content='0'>");
		}
		function futarTorol($id){
			include 'connect.php';
			$sql = "DELETE FROM futarok WHERE Id = '$id'";
			mysqli_query($conn,$sql); 
			echo("<meta http-equiv='refresh' content='0'>");
			
		}

	}

?>