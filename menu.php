
<div class="menu1"><a href="home.php"><p>HOME</p></a></div>
<div class="menu2"><a href="ordina.php"><p>ORDINA</p></a></div>
<?php
    if(($_SESSION['tipo']==true ) && $_SESSION['entrato']==true){
     echo "<div class=\"menu3\"><a href=\"cambia.php\"><p>CAMBIA</p></a></div>";
    } else if(($_SESSION['gestore']==false ) || $_SESSION['entrato']==false){
     echo "<div class=\"menu3\"><p>CAMBIA</p></div>";
    }
    if( isset( $_SESSION['entrato'] )&& $_SESSION['entrato']==true) {  
        echo "<div class=\"menu4\"><p><a href=\"info2.php\">INFO</p></a></div>";
        echo "<div class=\"menu5\"><p>LOGIN</p></div>";
        echo "<div class=\"menu6\"><p><a href=\"logout.php\">LOGOUT</p></a></div>";
         echo "<div class=\"menu7\"><p>REGISTRATI</p></a></div>";
    }else{
        echo "<div class=\"menu4\"><p><a href=\"info1.php\">INFO</a></p></div>";
        echo "<div class=\"menu5\"><p><a href=\"login.php\">LOGIN</a></p></div>";
        echo "<div class=\"menu6\"><p>LOGOUT</p></div>";
        echo "<div class=\"menu7\"><p><a href=\"registrati.php\">REGISTRATI</a></p></div>";
    }
    
   
?>
	

	