<!DOCTYPE html>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php
require_once("../class/class.new.php");
$resultado = new conSqlSelect;
/** Modificar **/
$pag="cliente";
/** Fin **/
if(isset ($_POST['id'])==""){
 /** Modificar **/
  //  Columnas de BD
  $r_cli[0]['id']="";
  $r_cli[0]['codigo']="";
  $r_cli[0]['rif']="";
  $r_cli[0]['razonsocial']="";
  $r_cli[0]['direccionfiscal']="";
  $r_cli[0]['direcciondespacho']="";
  $r_cli[0]['estado']="";
  $r_cli[0]['municipio']="";
  $r_cli[0]['parroquia']="";
  $r_cli[0]['ciudad']="";
  $r_cli[0]['telefono1']="";
  $r_cli[0]['telefono2']="";
  $r_cli[0]['telefonocel']="";
  $r_cli[0]['correo']="";
  $r_cli[0]['atendidopor']="";
  /** Fin **/
  $camp="";

   
// echo"<h2><p align='center'> Registrar Cliente</p> </h2>";
}
else {
  $camp=$_POST['id'];
//  echo"<h2><p align='center'>Editar Categoria</p> </h2>";
 
/** Modificar **/
// Tabla a Consultar
$tabla="cliente";
// Columna a Consultar
$ID="id";
/** Fin **/

$r_cli = $resultado->obtResultadoW($tabla,$ID,$camp);


}

?>


<form action="../modelo/verificar.php" method="post" name="form1">
 <input  type="hidden" class="form-control" id="campo" value="<?php echo $r_cli[0]['id']?>">
 <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</br>
  <p ><div class="r col-md-offset-4"><h3>Ingreso a pre-orden de pedido </h3></div> </p>

<div class="main col-sm-12 col-xs-12 col-lg-4 col-md-4   col-md-offset-4 white sombra" >
    <div class="table-responsive">
  <table class="table">
   
<tr>
<p>&nbsp;</p>
    <td  ><div align="right" class="te">C&oacute;digo del Cliente:</div></td>
    <td  colspan="3" ><div align="left">
      <input class="form-control" name="codigo" type="text" required="required" autofocus="autofocus" size="7" maxlength="6" value="<?php echo $r_cli[0]['codigo']?>" title="Escriba el código de 6 digitos que aparecen en cualquiera de sus facturas encima de la razón social de su empresa"/>
      &nbsp;&nbsp;&nbsp;</div>      
</td>
    </tr>
  <tr>
    <td nowrap ><div align="right" class="te">RIF:</div></td>
    <td ><div align="left">
      <input class="form-control" name="rif" placeholder="J0123456789" required="required" type="text" size="21" maxlength="30" value="<?php echo $r_cli[0]['rif']?>" title="Escriba el RIF sin guiones ni puntos" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" />
      &nbsp;</div>     </td>
    </tr>

 <tr>
          <td colspan="3"><div align="center">
            <label>
            <strong><input class="btn btn-warning"   type="submit" name="boton" value="Entrar" />
            </strong></label>
          </div></td>
         
        </tr>
      </table></div>
  </div></td>
    </tr>
</table>
</div>
</form>
</body>

</html>