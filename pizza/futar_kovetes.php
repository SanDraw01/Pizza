<?php 
	include 'minta.php';
	include 'connect.php';
?>
<div class="container my-5 p-4">
	<h1 class="text-center p-2 text-light">Futár követés</h1>
	<form>
		<div class="form-group">
			<p class="text-light"><b>Válaszd ki, hogy melyik futárt szeretnéd megtekinteni :</b></p>
		<select id = "futarok" class="form-control">
			<option selected disabled>Válassz futárt!</option>
			<?php 
			$sql = "SELECT Id,futarNeve from futarok";
			$eredmeny = mysqli_query($conn,$sql);
			while ($sor = $eredmeny->fetch_assoc()) {
				echo "<option value = ".$sor['Id'].">".$sor['futarNeve']."</option>";
			}
		?>
		</select>
		</div>
		
	</form>
	<div id="demo" class="my-5"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#futarok").change(function(){
			var melyikFutar = document.getElementById('futarok').value;
			

			var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("demo").innerHTML = this.responseText;
	            }
            };
            xhttp.open("POST", "pizza_melos_resz/futar_kovet.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("futarid="+melyikFutar);
		})
	});
</script>