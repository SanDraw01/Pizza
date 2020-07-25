<?php 
	include '../connect.php';
	if (isset($_POST['edit_verify'])) { // Itt csinálja meg a szerkesztést
			    $id = $_POST['pizza_szerkeszt_id'];
			    $nev = $_POST['pizza_szerkeszt_nev'];
			    $leiras = $_POST['pizza_szerkeszt_leiras'];
			    $ar = $_POST['pizza_szerkeszt_ar'];
			    $update = "UPDATE pizzak SET Nev = '$nev' , Leiras = '$leiras', Ar = '$ar' WHERE Id = '$id'";
			    $result2 =  mysqli_query($GLOBALS['conn'],$update);
			    header('Location: ../pizza_show.php ');			
	}
	if (isset($_POST['cancel'])) {
		header('Location: ../pizza_show.php');
	}
?>