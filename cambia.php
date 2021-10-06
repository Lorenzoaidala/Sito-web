<?php
session_start();
$nameP = "cambia";
$flag=true;
$nomePizza=$_POST['nomePizza'];
$ingr=$_POST['ingredientiPizza'];
$tipo=$_POST['TipoCibo'];
$costo=$_POST['costo'];
$quantita=$_POST['quantita'];
$conn1 = mysqli_connect("localhost", "uStrong", "SuperPippo!!!", "pizzasporto");

$query1 = "SELECT id,nome,prezzo,qty FROM pizze";
$result1 = mysqli_query($conn1, $query1);
while ( $scorri= mysqli_fetch_assoc($result1)) {
   if(isset($_POST[$scorri['id']])){
     $numPizza=$_POST[$scorri['id']];
     if($scorri['qty']+$numPizza<0){
        $flag=false;
    }else{
     $query2 = "UPDATE pizze set `qty` = `qty`+ ? WHERE `id` = ?";
     $stmt = mysqli_prepare($conn1, $query2);
     mysqli_stmt_bind_param($stmt,"ii",$numPizza,$scorri['id']);
     mysqli_stmt_execute($stmt);
     mysqli_close($conn1);
    }
   }
}

$conn2 = mysqli_connect("localhost", "uStrong", "SuperPippo!!!", "pizzasporto");

$errore="";
$flagPizza=true;

if(strlen($nomePizza)==0 && strlen($ingr)==0 && strlen($costo)==0 && strlen($quantita)==0 ){
  $errore="";
  $flagPizza=false;
}else{

if(strlen($nomePizza)==0 ){
  $errore=$errore."<p>Errore nome</p>";
  $flagPizza=false;
} if(strlen($ingr)==0){
  $errore=$errore."<p>Errore ingredienti</p>";
  $flagPizza=false;
} if(strlen($costo)==0){
  $errore=$errore."<p>Errore costo Pizza</p>";
  $flagPizza=false;
} if(strlen($quantita)==0){
  $errore=$errore."<p>Errore quantita Pizza</p>";
  $flagPizza=false;
}
if($costo<0){
  $errore=$errore."<p>Errore,inserire costo positivo</p>";
  $flagPizza=false;
}if($quantita<0){
  $errore=$errore."<p>Errore,inserire quantita positiva</p>";
  $flagPizza=false;
}
}


if($flagPizza==true && isset($_POST["TipoCibo"])){
  $costo=$costo*100;
  if($_POST["TipoCibo"] == ""){
   $query4 = "INSERT into pizze (`nome`,`ingredienti`,`tipo`,`prezzo`,`qty`) VALUES (?, ?, NULL, ?, ?)";
   $stmt = mysqli_prepare($conn2, $query4);
   mysqli_stmt_bind_param($stmt,"ssii",$nomePizza, $ingr, $costo,$quantita);
   $result = mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);
   mysqli_close($conn2);
   header("Location:modifica.php");

  }else {
  $query4 = "INSERT into pizze (`nome`,`ingredienti`,`tipo`,`prezzo`,`qty`) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn2, $query4);
  mysqli_stmt_bind_param($stmt,"sssii",$nomePizza, $ingr, $tipo, $costo,$quantita);
  $result = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conn2);
  header("Location:modifica.php");
    }
}
$conn = mysqli_connect("localhost", "uStrong", "SuperPippo!!!", "pizzasporto");
$query = "SELECT id,nome,prezzo,qty FROM pizze";
$result = mysqli_query($conn, $query);
mysqli_close($conn);

?>
<!DOCTYPE html> 
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Cambia</title>
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="screen">
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="print">
  <link rel="icon" type="image/png" href="icon.png">
  <script src="cambia.js"></script>
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
      if(!$result){
        echo "<table>";
        echo "<h2>Non ci sono pizze</h2>";
        echo "<p>Torna alla HomePage</p>";
        }else{
         echo "<h3 >Aggiorna qty</h3>";
         echo "<table class=>";
         echo "<tr><th>Nome</th><th>Prezzo</th><th>Qty</th><th>Aggiorna</th></tr>";
         while($scorri= mysqli_fetch_assoc($result)){
            $identificativo=$scorri['id'];
            echo "<tr><td>$scorri[nome]</td><td>$scorri[prezzo]</td><td>$scorri[qty]</td><td><form method='POST'><input type='number' name=$identificativo step='1' value=0> <input type='submit' value='Aggiorna prodotto'></form></td></tr>"; 
          }
         echo "</table>";
         if($flag==false)
         echo "Errore quantita";
         $flag=true;
}
    ?>
     <h3>Aggiungi pizza</h3>
      <form class="form" method='POST' onSubmit="return cambia(nomePizza,ingredientiPizza,costo,quantita)">
      <table>
      <tr><th>Tipo</th><th>Inserisci</th></tr>
      <tr><td>Nome: </td><td><input type='text' name='nomePizza' ></td></tr>
      <tr><td>Ingredienti: </td><td><input type='text' name='ingredientiPizza' value=''></td></tr>
     <tr><td>Tipologia: </td><td><select name="TipoCibo">
       <option label=" "></option>
       <option>vegan</option>
       <option>veggy</option>
      </select></td></tr>
      <tr><td>Costo in €: </td><td><input type='number' name='costo' step='0.01' min='0' value=''></td></tr>
      <tr><td>Qty: </td><td><input type='number' name='quantita' min='0' step='1' value=''></td></tr>
      <tr><td></td><td><input type="submit" id="manda1" value="Aggiungi"></td></tr>
      </table>
      <?php
    echo $errore;
    ?>
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