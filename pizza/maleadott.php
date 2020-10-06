<?php 

  include 'minta.php';
?>

  <div class='container my-5 bg-light p-3'>
    
    <form>
      Add meg a dátumot : <input type="date" id="datum"  value="<?php echo date('Y-m-d'); ?>"class="form-control">
    </form>

    <div id="demo"></div>
</div>
<script type="text/javascript">
 
  $(document).ready(function(){
    

      var xhttp_onload = new XMLHttpRequest();
      xhttp_onload .onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("demo").innerHTML = this.responseText;
        }
      };
      xhttp_onload.open("POST", "pizza_melos_resz/maleadott_process.php", true);
      xhttp_onload.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp_onload.send("datum="+$("#datum").val());
    

    $("#datum").change(function(){
      var datum = document.getElementById('datum').value;

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("demo").innerHTML = this.responseText;
        }
      };
      xhttp.open("POST", "pizza_melos_resz/maleadott_process.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("datum="+datum);
    })
  });

</script>




