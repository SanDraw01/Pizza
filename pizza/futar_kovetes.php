<?php 
	include 'minta.php';
	include 'connect.php';
?>
<div class="container bg-light my-5">
	<h1 class="text-center p-2">Futár követés</h1>
	<form>
		Válaszd ki, hogy melyik futárt szeretnéd megtekinteni : 
		<select id = "futarok">
			<?php 
			$sql = "SELECT Id,futarNeve from futarok";
			$eredmeny = mysqli_query($conn,$sql);
			while ($sor = $eredmeny->fetch_assoc()) {
				echo "<option value = ".$sor['Id'].">".$sor['futarNeve']."</option>";
			}
		?>
		</select>
	</form>
	<div id="demo"></div>
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