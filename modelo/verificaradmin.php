<?php 
session_start();
/** **/

$campo1="usuario";
$campo2="clave";
$Tabla="usuario";
$valor1=$_POST['usuario'];
$valor2=$_POST['clave'];


$_SESSION['usuario']=$valor1;
$_SESSION['clave']=$valor2;
// Columnas de la bd. 
$i=0;
  $cols[$i++]="id";
  $cols[$i++]="departamento";
  $cols[$i++]="correo";
/** Fin **/  
require_once("../class/class.new.php");

/* Para consultar Personas */
$datosUsu = new conSqlSelect;



$usuarios_reg = $datosUsu->acceso($Tabla,$campo1,$valor1,$campo2,$valor2);
/* ************************/
if (!empty($usuarios_reg))
{//si el usuario esta registrado
header('location: ../menu/index.php');

}
else{
   
header('location: ../vista/acceso2.php');
}

?>

</body>
</html>