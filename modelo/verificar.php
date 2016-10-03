<?php 
session_start();
/** **/

$campo1="codigo";
$campo2="rif";
$Tabla="cliente";
$valor1=$_POST['codigo'];
$valor2=$_POST['rif'];


$_SESSION['codigo']=$valor1;
$_SESSION['rif']=$valor2;
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
{//si el cliente esta registrado
header('location: ../registro/pedido.php');

}
else{
   
header('location: ../vista/acceso1.php');
}

?>

</body>
</html>