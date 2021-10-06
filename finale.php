<?php
session_start();
$nameP = "finale";
$conn = mysqli_connect("localhost", "uStrong", "SuperPippo!!!", "pizzasporto"); 
date_default_timezone_set('Europe/Rome');
$cur_time=date("H:i:s");
$duration='+45 minutes';
$tempoconsegna= date('H:i:s', strtotime($duration, strtotime($cur_time))); 
 $ora=$_POST["oraFinale"];
 $ind=$_POST['indirizzoConsegnaFinale'];
$regexOra = '/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/';
$regexIndirizzo = '/^[\sA-Za-z]{1,40}$/';
$err="";

if(strlen($ora)==0 || !preg_match($regexOra, $ora)){
    $err=$err."Errore ora Consegna";
  }
  if(strlen($ind)==0 || !preg_match($regexIndirizzo, $ind)){
    $err=$err."Errore indirizzo consegna";
  }
    $oraCons = date('H:i:s', strtotime($ora));
    $flagOra=true;
    if($tempoconsegna>$oraCons  ){
    $flagOra=false;
    }

  $query = "SELECT `credito` FROM `utenti` WHERE `username` = ?";
        $username=$_SESSION['username'];
        $tot = $_POST['totale1'];
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt,"s",$username);
	    mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $fetch = mysqli_fetch_assoc($result);
	    mysqli_stmt_close($stmt);
        if($fetch["credito"] >= $tot){
            $query2 = "UPDATE utenti SET `credito` = `credito` - ? WHERE `username` = ?";
            $stmt2 = mysqli_prepare($conn, $query2);
            mysqli_stmt_bind_param($stmt2,"is", $tot, $username);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            mysqli_stmt_close($stmt2);
            
            $errorec=false;
            $_SESSION["cred"] = $_SESSION["cred"] - $tot;
            $query3 = "SELECT `qty`,`id` FROM `pizze` where `qty` > 0";
            $result3 = mysqli_query($conn, $query3);
            while($var = mysqli_fetch_assoc($result3)){
            if($_POST[$var["id"]] > 0){
                $query4 = "UPDATE `pizze` SET `qty` = `qty` - ? where `id` = ?";
                $stmt4 = mysqli_prepare($conn, $query4);
                mysqli_stmt_bind_param($stmt4,"is",$_POST[$var['id']], $var['id']);
	            mysqli_stmt_execute($stmt4);
                $result4 = mysqli_stmt_get_result($stmt4);
	            mysqli_stmt_close($stmt4);
                }
            }
            mysqli_free_result($result3);
            mysqli_close($conn);

        }else{
             $errorec=true;
            mysqli_close($conn);
        }
      
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Finale</title>
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
    echo "<div class=\"Main\">";
    if($errorec){
      echo "<h1>Credito insufficiente!</h1>";
      echo "</div>";
      echo "</div>";
      echo "</body>";
      echo "</html>";
    return;
    }
    if( $flagOra==false){
      echo "<h1>Errore ora consegna!</h1>";
      echo "</div>";
      echo "</div>";
      echo "</body>";
      echo "</html>";
      return;
    }

 
   ?> 
  <h1>Grazie!</h1>
  <h2>Ordine effettuato con successo!</h2>
  </div>
  <footer class="Footer">
      <?php 
	      include('footer.php'); 
	    ?>
</footer>
</div>
</body>
</html>
