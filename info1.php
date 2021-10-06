<?php
      session_start(); 
$conn1 = mysqli_connect("localhost", "uWeak", "posso_leggere?", "pizzasporto");
$nameP = "info1";
$query1 = "SELECT nome,ingredienti,tipo,prezzo FROM pizze where qty > 0";
$result = mysqli_query($conn1,$query1);
mysqli_close($conn1);
?>
<!doctype html>
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Info</title>
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
    <table class="tabellaInfo">
      <tr><th>Nome</th><th>Ingredienti</th><th>Tipo</th><th>Prezzo</th></tr>
      <?php
      while($ok= mysqli_fetch_assoc($result)){
      $p=$ok['prezzo']/100;
      $p=number_format($p,2).'€';
      echo "<tr><td>$ok[nome]</td><td>$ok[ingredienti]</td><td>$ok[tipo]</td><td>$p</td></tr>";
      }
      ?>
      </table>
       </div>
       <footer class="Footer">
      <?php 
	      include('footer.php'); 
	    ?>
</footer>
</div>
</body>
</html>
