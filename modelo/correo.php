<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="../css/main.css" rel="stylesheet">

<p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>

<div class="main col-sm-12 col-xs-12 col-lg-6 col-md-6 col-md-offset-3 white sombra"><p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>

<?php 
$texto=explode(",",$_POST['texto']);
$text=$_POST['texto'];
$num=$_POST['num'];
$pag=$_POST['pag'];
$id=$_POST['id'];
for($x=0;$x<=$num;$x++)
 $texto[$x];

/** **/

$var="c_correo";
$Tabla="correo";
// Columnas de la bd. 
$i=0;
  $cols[$i++]="id";
  $cols[$i++]="departamento";
  $cols[$i++]="correom";
/** Fin **/  
require_once("../class/class.new.php");

/* Para consultar Personas */
$datosUsu = new conSqlSelect;



if($id==""){
$usuarios_reg = $datosUsu->obtResultadoW($Tabla,'id',$texto[1]);
/* ************************/
if (!empty($usuarios_reg))
{//si el cliente esta registrado
echo "<div id='msj' class='c' align='center'>Esta Seccion ya esta Registrada  <a onClick=\"cargar('$var','$var')\">Volver</a></div>";

}
else{
   $newReg = new conSqlInsert;
   
	$registro = $newReg->new_Record($Tabla,$cols,$texto);
 
//header("location: ../vista/".$var.".php");
echo "<div id='msj' align='center' class='c'>Registrado con Exito... <a href='../vista/correo.php'>Continuar</a>";
}
}
else{

  $editReg = new conSqlUpdate;


	$registro = $editReg->update($Tabla,$cols,$texto);
// header("location: ../vista/".$var.".php");
	echo "<div id='msj' align='center' class='c'>Editado con Exito... <a href='../vista/correo.php'>Continuar</a>";


?>
<?php


}

?>
<p>&nbsp; </p>

<p>&nbsp; </p>
</div>
</body>
</html>