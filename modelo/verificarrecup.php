<!DOCTYPE html>

<?php include("../partes/headerc.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php 
//session_start();
/** **/

$campoc="correou";
$Tabla="usuario";
$valorc=$_POST['correou'];


error_reporting(0); 
//$_SESSION['usuario']=$valor1;
//$_SESSION['clave']=$valor2;
// Columnas de la bd. 
$i=0;
  $cols[$i++]="id";
  $cols[$i++]="departamento";
  $cols[$i++]="correou";
/** Fin **/  
require_once("../class/class.new.php");

/* Para consultar Personas */
$datosUsu = new conSqlSelect;



$usuarios_reg = $datosUsu->recuperar($Tabla,$campoc,$valorc);
/* ************************/

//si el usuario esta registrado
$header = 'From: ' . $mail . ", Recuperación de contraseña VESSPORT" ; 

$header .= "X-Mailer: PHP/" . phpversion() . " \r\n"; 
$header .= "Mime-Version: 1.0 \r\n"; 
$header .= "Content-Type: text/html"; 

$clave = $usuarios_reg[0]['clave'];
$correou = $usuarios_reg[0]['correou'];
$mensaje = "Su contraseña para acceder al Sistema de VESSPORT es: ".$clave;


$para = $correou; 
$asunto = "Recuperación de Contraseña, Enviado el " . date("d/m/Y", time());

mail($para, $asunto, utf8_decode($mensaje), $header);
?>
<p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>

<div class="main col-md-6 col-md-offset-3 white sombra">
<p>&nbsp;</p>
<p>&nbsp; </p>

<?php
if (!empty($usuarios_reg)) {

echo "<div class='c' align='center' >Su contraseña fue enviada con éxito... <a href='../vista/accesoadmin.php'>Continuar</a></div>"; 

}
else{
echo "<div class='c' align='center' >La dirección del correo electrónico no coincide con la ingresada al sistema, por favor intente de nuevo... <a href='../vista/recuperacion.php'>Continuar</a></div>"; 
}



?>
<p>&nbsp;</p>
<p>&nbsp; </p>
</div>

</body>
</html>