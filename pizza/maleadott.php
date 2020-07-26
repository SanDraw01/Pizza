<?php 

  include 'minta.php';
?>

  <div class='container my-5 bg-light p-3'>
    
    <form>
      Add meg a dátumot : <input type="date" id="datum" class="form-control">
    </form>

    <div id="demo"></div>
</div>
<script type="text/javascript">

  $(document).ready(function(){
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




