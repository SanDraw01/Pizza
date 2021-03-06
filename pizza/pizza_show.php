<!DOCTYPE html>
<html>
<head>
	<title>Pizzák</title>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
	<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
	
</head>
<body class="bg-secondary">
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="menu.php">Habzsoli oldal</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="pizza_hozzaadas.php">Pizza hozzáadása</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pizza_show.php">Pizzák</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="rendeles1.php">Rendelés felvétel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="maleadott.php">Ma leadott rendelések</a>
      </li>
        <li class='nav-item dropdown'>
    <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Futárok</a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='futar_hozzaadas.php'>Futár hozzáadása</a>
                  <a class='dropdown-item' href='futar_szerkesztes.php'>Futárok szerkesztése/törlése</a>
                <div class='dropdown-divider'></div>
             <a class='dropdown-item' href='#'>Futár követés</a>
        </div>
      </li>
      
    </ul>

  </div>
</nav>
		</div>
</div>
<div id = 'show' ></div>  
	<script type='text/javascript'>
		$(document).ready(function(){
			setInterval(function(){
				$('#show').load('pizza_melos_resz/pizza_main.php')
			},1000)
		});

	</script>
	<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
</body>
</html>