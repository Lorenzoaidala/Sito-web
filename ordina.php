<?php
 session_start();
$nameP = "Ordina";
$conn = mysqli_connect("localhost", "uWeak", "posso_leggere?", "pizzasporto");
$query = "SELECT id,nome,prezzo,qty FROM pizze WHERE qty>0";
$result = mysqli_query($conn, $query);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Ordina</title>
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
    <?php
      if( $_SESSION['entrato']==false){  
      echo "<h1>Attenzione! Questa pagina &egrave; accessibile solo previa autenticazione.</h1>";
      echo "</div>";
      echo "</div>";
      echo "</body>";
      echo"</html>";
      return;
      }
        echo "<table class=\"OrdinaTabella\" >";
        echo "<form method='POST' action=\"conferma.php\" >";
        echo "<tr><th>Nome</th><th>Prezzo</th><th>Quantit&agrave</th></tr>";
        while ($scorri= mysqli_fetch_assoc($result)){
           $prezzo=$scorri['prezzo']/100;
           $prezzo=number_format($prezzo,2).' €';
           $id=$scorri['id'];
           echo "<tr><td>$scorri[nome]</td><td>$prezzo</td><td><select name=$id>";
           for($i=0;$i<$scorri['qty'];$i++)
              echo "<option>$i</option>";
           echo "</select></td></tr>";
          }
        echo "<tr><td><input type=\"submit\" name=\"Invio\" value=\"Aggiungi\"></td>";
        echo "<td><input type=\"reset\" name=\"Pulisci\" value=\"Cancella\"></td></tr>";
        echo "</form>";
        echo "</table>";

  ?>
</div>
<footer class="Footer">
<?php 
include('footer.php'); 
?>
</footer>
</div>
</body>
</html>

     
