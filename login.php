<?php
session_start(); 
$nameP = "login";
$username = $_POST["username"];
$password = $_POST["password"];
$trovato=0;
$flag=0;
$regexPassword = '/^[\W\w\d]{6,12}$/';
$regexUsername='/^[a-zA-Z][a-zA-Z0-9-_]{2,8}$/';
  if(strlen($username)==0 || strlen($password)==0 ){
     $flag=1;
   }else if(!preg_match($regexPassword, $password) || !(preg_match('/([0-9].*[0-9])/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/([\W].*[\W])/', $password)))
    $flag=1;
    else if(!preg_match($regexUsername, $username)){
        $flag=1;
      }
      if($flag==0){
        $conn1 = mysqli_connect("localhost", "uWeak", "posso_leggere?", "pizzasporto");
     $query1 = "SELECT username, pwd,credito,gestore,indirizzo FROM utenti WHERE username = ?";
     $stmt = mysqli_prepare($conn1, $query1);
     mysqli_stmt_bind_param($stmt,"s",$username);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
     $fetch = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn1);
    $cred=$fetch["credito"];
    $tipo=$fetch["gestore"];
    if($fetch != null ||($password) == ($fetch["pwd"])){
        $trovato=0;
        $_SESSION['entrato']=true;
		$_SESSION['username']=$username;
        $_SESSION['cred']=$cred;
        $_SESSION['indirizzoTotale']=$fetch["indirizzo"];
        if($tipo==1)
          $_SESSION['tipo']=true;
        else
          $_SESSION['tipo']=false;
        setcookie('old',$username, (time() + (3600*72)) );
        header("Location: info2.php");
    }else{
  $trovato=1;
      }
    }
		?>

<!doctype html>
<html lang="it">
<head>
  <meta charset=utf-8>
  <meta name="Author" content="Andrea Della Croce">
  <title>Login | ExtraPizza</title>
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="screen">
  <link rel="stylesheet"  type="text/css"  href="stile.css" media="print">
  <link rel="icon" type="image/png" href="icon.png">
  <script src="confermaLogin.js"></script>
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
      <h2>Login</h2>
       <form class="form" method="POST" onsubmit="return confermaLogin(username, password)">
        <table class="tabellaLogin">
          <tr>
           <td>Username: </td>
           <td><input type="text" name="username" <?php
               if( isset( $_COOKIE['old'] ))
	                {echo $_COOKIE['old'];}?>></td>
           </tr>
          <tr>
            <td>Password: </td>
           <td><input type="password"  name="password"></td>
          </tr>
          </table>
        <input type="submit" id="invia" name="invia" value="Invia">
        <input type="reset" id="reset" name="reset" value="reset">
        </form>
    <?php
    if($flag &&  isset($username)){
    echo "Errore formato credenziali";
    $flag=0;
    }
     if($trovato)
    echo "Credenziali errate";
    $trovato=0;
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

    