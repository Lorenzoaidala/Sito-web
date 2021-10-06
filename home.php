<?php
      session_start(); 
  $nameP = "home";
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Home</title>
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="screen">
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="print">
  <link rel="icon" type="image/png" href="icon.png">
</head>
<body>
  <header>
    <?php 
	  include('header.php');
	?>
  </header>
  <div class="grid-container">
  <?php 
  include('menu.php');
?>
  <div class="Main">
  <img class="immagine" src="PizzaHome.png" alt=immaginepizza>
  </div>
    <footer class="Footer">
      <?php 
	      include('footer.php'); 
	    ?>
</footer>
</div>
</body>
</html>
