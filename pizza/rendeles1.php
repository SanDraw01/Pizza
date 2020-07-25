<?php 
  session_start();
	include 'connect.php';
  include 'minta.php';
?>
	<div class="container">
        <!-- Első sor -->
        <div class="row my-4">
            <div class="col-mb-12  m-auto">
                <div class="card-deck">
                    <div class="card bg-dark text-white" style="width: 17rem;">
                        <img  class="card-img-top" src="logo.png" alt="kep">
                        <div class="card-body">
                            <h5 class="card-title">Vevők keresése</h5>
                                <div class="card-text">
                                    <p>Itt a már meglévő vevők közül lehet választani</p>
                                </div>
  
                                <a href="vevok_keresese.php" class="btn btn-danger">Vevő keresése</a>    
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-mb-12  m-auto">
                <div class="card-deck">
                    <div class="card bg-dark text-white" style="width: 17rem;">
                        <img  class="card-img-top" src="logo.png" alt="kep">
                        <div class="card-body">
                            <h5 class="card-title">Új vevő hozzáadása</h5>
                                <div class="card-text">
                                    <p>Ide kattintva új vásárlót adhat hozzá az adatbázishoz</p>
                                </div>
  
                                <a href="vevok_hozzaadasa.php" class="btn btn-danger">Vevő hozzáadaása</a>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
          <?php 
          if (isset($_SESSION['siker'])) {
            if ($_SESSION['siker'] == 1) {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>Vevő sikeresen hozzáadva!</strong> Rendelés felvételéhez keresse ki a vevők között!
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
                unset($_SESSION['siker']);
            }
          }
        ?></div>
     </div>

