<?php 

      if (isset($_POST['datum'])) {
          $datum = $_POST['datum'];
          $datum = strval($datum);
          
      }

      
      require_once 'connect.php';
      
     

      $sql = "SELECT *,SUM(sum),sum(darab) from rendeles INNER JOIN vevo on rendeles.vevoid = vevo.Id INNER JOIN pizzak on rendeles.pizzaid = pizzak.Id WHERE rendeles.datum = '$datum' GROUP BY rendelesKodja "; 
      $result = mysqli_query($conn,$sql);


      echo "<table class = 'table table-dark my-5'><th>Vevő neve</th><th>Dátum</th><th>Idő</th><th>Pizza neve</th><th>Darabszám</th>
      <th>Egység ár</th><th>Rendelés összára</th>";
      $sum = 0;
      $osszdarab = 0;
      $szamlalo = 1;

      while ($row = $result -> fetch_assoc()) {
        $sql2 = "SELECT pizzak.Nev,rendeles.darab,rendeles.ar from rendeles INNER JOIN vevo on rendeles.vevoid = vevo.Id INNER JOIN pizzak on rendeles.pizzaid = pizzak.Id WHERE rendelesKodja = $szamlalo"; 

        $eredmeny = mysqli_query($conn,$sql2);
        $eredmeny2 = mysqli_query($conn,$sql2);
        $eredmeny3 = mysqli_query($conn,$sql2);

        echo "<tr><td>".$row['Neve']."</td>";
        echo "<td>".$row['datum']."</td>";
        echo "<td>".$row['mikor']."</td>";
        echo "<td>";
          while ($sor = $eredmeny-> fetch_assoc()) {
            echo $sor['Nev']."<br>";
          }
        echo "</td>";

        echo "<td>";
          while ($sor2 = $eredmeny2-> fetch_assoc()) {
            echo $sor2['darab']."<br>";
          }
        echo "</td>";
        echo "<td>";
        while ($sor2 = $eredmeny3-> fetch_assoc()) {
            echo $sor2['ar']." Ft<br>";
          }
        echo "</td>";
        echo "<td>".$row['SUM(sum)']." Ft</td></tr>";

        $sum += $row['SUM(sum)']; // Ez kiadja az aznapi bevételt
        $osszdarab += $row['darab']; 
        $szamlalo++;
      }
      
      echo "</table>";

    ?>
    





