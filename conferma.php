<?php
session_start();
$nameP = "conferma";
$conn2 = mysqli_connect("localhost", "uStrong", "SuperPippo!!!", "pizzasporto");
    $query2 = "SELECT id,nome,prezzo,qty FROM pizze WHERE qty>0";
    $result2 = mysqli_query($conn2, $query2);
    $result3 = mysqli_query($conn2, $query2);
    if(isset($_SESSION['indirizzoTotale'])){
        $vettore = explode(" ",$_SESSION["indirizzoTotale"]);
        $lunghezza = count($vettore) - 1;
        $tipo = $vettore[0];
        $ind = "";
        for($i=1; $i < ($lunghezza - 1); $i++){
            $ind .= $vettore[$i]." ";
        }
        $ind .= $vettore[$lunghezza-1];
        $civico = $vettore[$lunghezza];
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Conferma</title>
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="screen">
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="print">
  <link rel="icon" type="image/png" href="icon.png">
  <script src="ora.js"></script>
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
 <form method='POST' action='finale.php' onsubmit= 'return ora(oraFinale,indirizzoConsegnaFinale,civico)' >
  <?php
   $totale1=0;
   while ( $scorri= mysqli_fetch_assoc($result2)) {
    $quantita=$_POST[$scorri['id']];
    $totaleOrdine=$_POST[$scorri['id']]*$scorri['prezzo'];
    $totale1=$totale1+ $totaleOrdine;
  
   }  
   if( $totale1===0){
       echo "<h2>Nessuna pizza selezionata</h2>";
       echo "</form>";
       echo "</div>";
       echo "</div>";
       echo"</body>";
       echo"</html>";
       return;
   }
     echo "<table class=\"tabellaInfo\" >";
     echo "<tr><th>Nome</th><th>Quantit&agrave</th></tr>";
     $totale1=0;
    while ( $scorri= mysqli_fetch_assoc($result3)) {
         $quantita=$_POST[$scorri['id']];
         $totaleOrdine=$_POST[$scorri['id']]*$scorri['prezzo'];
         $totale1=$totale1+ $totaleOrdine;
         if(isset($_POST[$scorri['id']]) && $_POST[$scorri['id']]>0){
             $prezzo=$scorri['prezzo']/100;
             $prezzo=number_format($prezzo,2).' €';
             $totaleOrdine=$totaleOrdine/100;
             $totaleOrdine=number_format($totaleOrdine,2).' €';
             echo "<tr><td>$scorri[nome]</td><td>$quantita</td></tr>";  
             echo "<input type='hidden' name='$scorri[id]' value='$quantita'>";
    }
}
        $prezzoTotale2=$totale1/100;
        $prezzoTotale2=number_format($prezzoTotale2,2).' €';
    echo "<tr><td>Totale ordine:</td><td> </td><td> </td><td>$prezzoTotale2</td></tr>";
    ?>
        <input type="hidden" name="totale1" value="<?php echo $totale1; ?>">
        <table class="tabellaInfo">
            <tr><td>Delivery Address</td>
            <td><select name="tipoIndirizzo">
                <option <?php if($tipo == "Via")
                    echo "selected "; ?>
                    value="Via">Via</option>
                <option <?php if($tipo == "Corso")
                    echo "selected "; ?>
                    value="Corso">Corso</option>
                <option <?php if($tipo == "Largo")
                    echo "selected "; ?>
                    value="Largo">Largo</option>
                <option <?php if($tipo == "Piazza")
                    echo "selected "; ?>
                    value="Piazza">Piazza</option>
                <option <?php if($tipo == "Via")
                    echo "selected "; ?>
                    value="Vicolo">Vicolo</option>
            </select>
             <input type="text" name="indirizzoConsegnaFinale" value="<?php echo $ind; ?>">
             <input type="number" name="civico" step="1" min="1" max="9999" value="<?php echo $civico; ?>"></tr>
             <tr><td>Ora Consegna</td><td><input type="text" name="oraFinale" placeholder="Formato hh:mm"></td></tr>
             <tr><td><a href="home.php"><input type="button" value="Annulla" /></a></td><td><input type=submit name=Invio value=Ok></td></tr>
             </table>
            </form>
            
        

  </div>
 
<footer class="Footer">
     <?php 
	   include('footer.php'); 
	   ?>
</footer> 
</div>


</body>

</html>