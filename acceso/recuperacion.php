<!DOCTYPE html>

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php
require_once("../class/class.new.php");
$resultado = new conSqlSelect;
/** Modificar **/
$pag="usuario";
/** Fin **/
if(isset ($_POST['id'])==""){
 /** Modificar **/
  //  Columnas de BD
  $r_cli[0]['id']="";
  $r_cli[0]['usuario']="";
  $r_cli[0]['clave']="";
  $r_cli[0]['correou']="";

  /** Fin **/
  $camp="";

   
// echo"<h2><p align='center'> Registrar Cliente</p> </h2>";
}
else {
  $camp=$_POST['id'];
//  echo"<h2><p align='center'>Editar Categoria</p> </h2>";
 
/** Modificar **/
// Tabla a Consultar
$tabla="usuario";

// Columna a Consultar
$ID="id";
/** Fin **/

$r_cli = $resultado->obtResultadoW($tabla,$ID,$camp);


}

?>


<form action="../modelo/verificarrecup.php" method="post" name="form1">
 <input  type="hidden" class="form-control" id="campo" value="<?php echo $r_cli[0]['id']?>">
   <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</br>
  <p ><div class="r col-md-offset-4"><h3>Recuperación de Contraseña</h3></div> </p>

<div class="main col-sm-12 col-xs-12 col-lg-4 col-md-4   col-md-offset-4 white sombra" >
    <div class="table-responsive">
  <table class="table">
<tr>
<p>&nbsp;</p>
    <td><div align="left" class="te">

<div id="mensaje"  class="t">Para recuperar la contraseña, introduce la dirección de correo electrónico que utilizaste al crear tu usuario 
<div class="input-group">
    <div class="input-group-addon">@</div><input class="form-control" name="correou" size="20" maxlength="50" value="<?php echo $r_cli[0]['correou']?>" required="required"  type="email" placeholder="name@example.com" title="Indique su correo electr&oacute;nico" /></div>
</div>
</td>
    </tr>
        <tr>
          <td><div align="center">
            <label>
            <strong><input class="btn btn-warning"   type="submit" name="boton" value="Continuar" />
            </strong></label>
          </div></td>
         
        </tr>
      </table>
  </div></td>
    </tr>
</table></div>
</div>
</form>

<script laguage="javascript">

function check(val)
{
  if (val=='s')
  document.getElementById("mensaje").style.display = "block";
   else
   document.getElementById("mensaje").style.display = "none";
}
</script>
</body>

</html>

