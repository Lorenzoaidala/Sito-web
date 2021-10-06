<?php
$nameP="registrati";
   session_start(); 
$nomePagina = "registrati";
$regexusername = '/^[a-zA-Z][a-zA-Z0-9-_]{2,8}$/';
$regexpassword = '/^[\W\w\d]{6,12}$/';
$regexcognome = '/^[\sA-Za-z]{2,30}$/';
$regexindirizzo = '/^[\sA-Za-z]{1,40}$/';
$regexname = '/^[\sA-Za-z]{2,25}$/';
$regexpData = '/^\d{4}\-\d{1,2}\-\d{1,2}$/';
$regexpGiorno = '/^(0?[1-9]|[12][0-9]|3[01])$/';
$regexpMese = '/^(0?[1-9]|1[012])$/';
$regexpAnno = '/^\d{4}$/';
$dataArr = explode("-",$data);
$meseInt = intVal($dataArr[1]);
$annoInt = intVal($dataArr[0]);
$giornoInt = intVal($dataArr[2]);
$nickname = $_POST["username"];
$password = $_POST["password"];
$name=$_POST["name"];
$cognome=$_POST["cognome"];
$indirizzo=$_POST["indirizzo"];
$data=$_POST["nascita"];
$civico=$_POST["civico"];
$credito=$_POST["credito"]*100;
$tipologia=$_POST["tipologia"];
$tempo = date('Y-m-d', strtotime($data));
$oggi = date("Y-m-d");
 $errore="";
 $flag=true;
    if( !preg_match($regexname, $name) && isset($_POST["name"]) ){
       $errore=$errore."<p>Errore nome</p>";  
       $flag=false; 
    }
    if(!preg_match($regexcognome, $cognome) && isset($_POST["cognome"]) ){
      $errore = $errore."<p>Errore cognome</p>";
      $flag=false;
    }
    if((!preg_match($regexindirizzo, $indirizzo) || strlen($indirizzo)==0) && isset($_POST["indirizzo"]) ){
      $errore =  $errore."<p>Errore indirizzo</p>";
      $flag=false;
    }
    if(($civico<1 || $civico>9999) && isset($_POST["civico"])){
      $errore =  $errore."<p>Errore civico</p>";
      $flag=false;}
    if($credito<0.01){
      $errore = $errore."<p>Errore credito</p>";
      $flag=false;
      }

    if( !preg_match($regexusername, $nickname) && isset($_POST["username"])){
      $errore= $errore."<p>Errore username</p>";
      $flag=false;
    }
    if(preg_match($regexusername, $nickname)){
      $conn1 = mysqli_connect("localhost", "uWeak", "posso_leggere?", "pizzasporto");
      $query1 = "SELECT username FROM utenti WHERE username = ?";
    $stmt = mysqli_prepare($conn1, $query1);
    mysqli_stmt_bind_param($stmt,"s",$nickname);
	  mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $fetch = mysqli_fetch_assoc($result);
	  mysqli_stmt_close($stmt);
    mysqli_close($conn1);
    if($result && $fetch != null){
      $errore = $errore. "Username esistente"; 
      $flag = false;
    } 
    }

    if( !preg_match($regexpassword, $password)){
      $errore= $errore."<p>Errore password</p>";
      $flag=false;
      
    }
    if(preg_match($regexpData, $data)){
      if($tempo>$oggi){
        $errore= $errore."Errore data";
        $flag=false;
      
    }
    if((($meseInt == 11 || $meseInt == 4 || $meseInt == 6 || $meseInt == 9) && $giornoInt > 30) ){
            $errore= $errore." Errore data ";
            $flag=false;
          
    } 
    if((($meseInt == 1 || $meseInt == 3 || $meseInt == 5 || $meseInt == 7 ||  $meseInt == 8 ||  $meseInt == 10 ||  $meseInt ==12) &&  $giornoInt > 31)){
          $errore= $errore." Errore data ";
          $flag=false;
          
      }
    if($meseInt == 2){
        if((($annoInt % 4) ==0) && $giornoInt>29){
           $errore= $errore." Errore data ";
           $flag=false;
          }
        if(((($annoInt % 4) > 0) && $giornoInt>28)){
          $errore= $errore." Errore data ";
          $flag=false;
          }
    }
        if($meseInt > 12 || $meseInt < 1){
        $errore= $errore." Errore data ";
      }
    } else{
      $errore= $errore." Errore data ";
    }
    if(!(isset($_POST["name"]) && isset($_POST["credito"]) && isset($_POST["civico"]) && isset($_POST["cognome"]) && isset($_POST["nascita"]) && isset($_POST["indirizzo"]) && isset($_POST["username"]) && isset($_POST["password"]))){
      $errore="";
      $flag=false;
    }
      if($flag==true){
        $conn1 = mysqli_connect("localhost", "uStrong", "SuperPippo!!!", "pizzasporto");
        $gestore=0;
        $creditocentesimi=$credito;
        $indirizzoTotale=$tipologia." ".$indirizzo." ".$civico;
        $query1 = "INSERT INTO utenti(nome,cognome,data,indirizzo,username,pwd,credito,gestore) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn1, $query1);
        mysqli_stmt_bind_param($stmt,"ssssssii",$name,$cognome,$data,$indirizzoTotale,$nickname,$password,$creditocentesimi,$gestore);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn1);
        header("Location: login.php");
      }

?>
 <!DOCTYPE html>
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Home</title>
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="screen">
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="print">
  <script src="Registra.js"></script>
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
<form class="form" method="POST" name="form" onsubmit="return Registra(name, cognome, nascita, indirizzo, civico,credito,username, password)">
  <table class="tabellaRegistrati">
  <tr>
  <td>Nome: </td>
  <td><input type="text" name="name" value=""></td>
  </tr>
  <tr>
  <td>Cognome: </td>
  <td><input type="text" name="cognome" value=""></td>
  </tr>
  <tr>
  <td>Data nascita:</td>
  <td><input type="text" name="nascita" placeholder=" Formato: aaaa-mm-gg" maxlength="10"></td>
  </tr>
  <tr>
  <td>Indirizzo domicilio: </td>
  <td>
  <select name="tipologia" >
  <option>Corso</option>
  <option>Largo</option>
  <option>Via</option>   
  <option>Vicolo</option>
  <option>Piazza</option>
  </select>
  <input type="text" name="indirizzo" placeholder="indirizzo" >
  <input type="number" name="civico" placeholder="civico" min="0" max="9999" >
  </td>
  </tr>
  <tr>
  <td>Credito in €: </td>
  <td><input type="number" name="credito" step="0.01" value="0.00" min="0" ></td>
  </tr>
  <tr>
  <td>Username: </td>
  <td><input type="text" name="username" value="" ></td>
  </tr>
  <tr>
  <td>Password: </td>
  <td><input type="password" name="password" value="" ></td>
  </tr>
  <tr>
  <td><input type="reset" id="Cancella" value="Cancella"></td>
  <td><input type="submit" id="Invia" value="Invia"></td>
  </tr>
  </table>
  </form>
  <p><?php
  echo $errore;
  ?></p>
</div>
</div>
<footer class="Footer">
      <?php 
	      include('footer.php'); 
	    ?>
</footer>
</body>
</html>

