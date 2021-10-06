<div class="grid-container">
<div class="Saldo"><?php
 
if(  $_SESSION['entrato']==true){
$cred=$_SESSION['cred']/100;

$cred=number_format($cred,2);
	echo ''.$_SESSION['username'].' '.$cred.' € ';
} else{
	echo 'Anonimo 0.00 €';;
}?>
</div>
<div class="Header">
<h1>Senti che pizza</h1>
</div>
</div>
