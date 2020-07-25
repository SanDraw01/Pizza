<?php 
	session_start();
	include 'minta.php';
	include 'pizza_melos_resz/pizza_keszito.php';
?>
<div class="row my-4">
            <div class="col-mb-12 bg-danger m-auto">
                    <!-- Pizza készítés kártya -->
                    <div class="card bg-dark text-white" style="width: 25rem;">
                        <img  class="card-img-top" src="logo.png" alt="kep">
                        <div class="card-body">
                            <h5 class="card-title">Új pizza Hozzáadás</h5>
                                <div class="card-text">
									<form action = "pizza_hozzaadas.php" method = "POST" >
									<div class="form-group">
										Pizza neve: <input type="text" name="nev" class="form-control">
										</div>
										<div class="form-group">
										Ár: <input type="number" name="ar" class="form-control">
										</div>
										<div class="form-group">
										Leírása: <textarea name="leiras" class="form-control"></textarea>
										</div>
										<input type="submit" name="okes" value="Hozzáadás" class="btn btn-success ">
										<input type="button" value="Vissza a menübe" onclick="vissza()" class="btn btn-warning">
										</form>
										
											
										
										
                                	</div>
                                </div>
               				 </div>                   
            			</div>
         			</div>    
    			</div>



	<?php 

	if (isset($_POST['nev']) and isset($_POST['leiras']) and isset($_POST['ar'])) {
		$pizza_nev = $_POST['nev'];
		$pizza_leiras = $_POST['leiras'];
		$pizza_ar = $_POST['ar'];
	
		$pizza = new Pizza($pizza_nev,$pizza_leiras,$pizza_ar);
		$pizza->adatFelkuldes();
	}
	
	if(isset($_SESSION['zsa'])){
		if ($_SESSION['zsa'] == true) {
			echo "<div class='alert alert-success alert-dismissible my-3 p-3'>
		  <button type='button' class='close' data-dismiss='alert'>&times;</button>
		  <strong>Siker!</strong> Pizza hozzáadva! A pizzák megnézéséhez kattints <a href = 'pizza_show.php'>IDE</a>
		</div>";
		unset($_SESSION['zsa']);
		}
	}
		

	?>
	</div>
	<script type="text/javascript">
	function vissza(){
		window.location.href = "menu.php";
	}
</script>
