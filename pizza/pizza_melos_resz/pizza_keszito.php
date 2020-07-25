<?php 
	class Pizza{
		public $nev;
		public $leiras;
		public $ar;

		function __construct($nev,$leiras,$ar){
			$this->nev = $nev;
			$this->leiras = $leiras;
			$this->ar = $ar;
		}
		function adatFelkuldes(){
			include 'connect.php';
			$sql = "INSERT INTO pizzak(Nev,Leiras,Ar) VALUES('$this->nev','$this->leiras','$this->ar')";
			$result = mysqli_query($conn,$sql);
			$_SESSION['zsa'] = true;
		}
	}

?>
