<?php 
//
if(!isset ($_GET['ids'])==""){
$id=$_GET['ids'];
echo "¡Datos Actualizados Correctamente!";
}else{
$id=$_SESSION['codigo'];

}


require_once("../class/class.new.php");
$resultado = new conSqlSelect;

/** Modificar **/
$pag_R="actcliente";
/** Fin **/
 $tabla="cliente";
$ID="codigo";
/** Fin **/

$r_cli = $resultado->obtResultadoW($tabla,$ID,$id);
    $e_Obt[0]['id_estado']="";
$e_Obt[0]['estado']="";
$tablae="estados";
$e_Obt = $resultado->obtResultado($tablae);

?>


<script type="text/javascript">
function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
  
else{ alert('Solo se permiten numeros');
input.value = input.value.replace(/[^\d\.]*/g,'');
}
}
</script>


<form  onsubmit="../registrar/pedido.php" method="post" name="form1">
 <input  type="hidden" class="form-control" id="campo" value="<?php echo $r_cli[0]['id']?>">

 <div class="table-responsive">
  <table class="table">
<tr>
<td><p>&nbsp; </p>
<td><p>&nbsp; </p>
<td><p>&nbsp; </p>
<td><p>&nbsp; </p>
<td><p>&nbsp; </p>
<td><p>&nbsp; </p>
    <td><div align="right">C&oacute;digo:</div></td>
        <td ><div align="left"><input name="codigo"  readonly="readonly" type="tel" class="form-control input-sm" pattern="[0-9]{7}" size="20%" maxlength="7" required title="Indique el Código"  value="<?php echo $r_cli[0]['codigo']?>" />
    </div>    </td>
      </tr>
  <tr>
    <td width="100" ><div align="right" >Raz&oacute;n Social:</div></td>
    <td colspan="5"><div align="left"><input class="form-control input-sm" id="razonsocial" autofocus="autofocus" readonly="readonly" name="razonsocial" type="text" size="100%" maxlength="255" value="<?php echo $r_cli[0]['razonsocial']?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Indique la raz&oacute;n social" /></div></td>
     <td><div align="right" >RIF:</div>
      <td><div align="left"><input name="rif" id="rif"  type="text" readonly="readonly" class="form-control" size="20%" value="<?php echo $r_cli[0]['rif']?>" placeholder="J0123456789" required="required" maxlength="10" pattern="[J,V,E,G]{1}[0-9]{9}" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Indique el RIF sin guión ni punto"/></div></td>

    </tr>
  <tr>
    <td><div align="right">Tel&eacute;fono Fijo:</div></td>
    <td><div align="left"><input class="form-control" name="telefono1" id="telefono1" readonly="readonly" id="telefono1" title="Escriba sólo números e indique el c&oacute;digo de &aacute;rea" onKeyPress="telf('this.value')"  type="tel" size="20%" maxlength="13" value="<?php echo $r_cli[0]['telefono1']?>" placeholder="00001111111" required="required" pattern="(?: \ (\ d {4} \) | \ d {3})?? [-] \ d {3} [-] \ d {4}"/></td>      
    <td width="15"><div align="right">Otro:</div></td>
     <td><div align="left"><input class="form-control" name="telefono2" id="telefono2" readonly="readonly"  value="<?php echo $r_cli[0]['telefono2']?>" id="telefono2" title="Escriba sólo números e indique el c&oacute;digo de &aacute;rea" onKeyPress="telf2('this.value')"  type="tel" size="20%" maxlength="13" placeholder="00001111111" required="required" pattern="(?: \ (\ d {4} \) | \ d {3})?? [-] \ d {3} [-] \ d {4}" /></div></td>
     <td width="25"><div align="right">Celular:</div></td> 
      <td><div align="left"><input class="form-control" name="telefonocel" id="telefonocel" readonly="readonly" value="<?php echo $r_cli[0]['telefonocel']?>" id="telefonocel" title="Escriba sólo números e indique el c&oacute;digo de &aacute;rea" onKeyPress="telf3('this.value')"  type="tel" size="20" maxlength="13" placeholder="00001111111" required="required" pattern="(?: \ (\ d {4} \) | \ d {3})?? [-] \ d {3} [-] \ d {4}" /></div></td>
     <td ><div align="right">Correo:</div></td>
      <td width="200">
      <div align="left"><input class="form-control" name="correo" size="20" id="correo" readonly="readonly" maxlength="50" value="<?php echo $r_cli[0]['correo']?>" required="required"  type="email" placeholder="nombre@ejemplo.com" title="Indique su correo electr&oacute;nico" />
      </div> </td>
    </tr>
   <tr>
    <td><div align="right">Direcci&oacute;n Fiscal:</div></td>
    <td colspan="7"><div align="left"><input class="form-control input-sm" readonly="readonly"  name="direccionfiscal" id="direccionfiscal" type="text" size="100%" maxlength="255" value="<?php echo $r_cli[0]['direccionfiscal']?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Indique la dirección fiscal" /></div></td>
  </tr>
   <tr>
    <td><div align="right">Direcci&oacute;n de Despacho:</div></td>
    <td colspan="7"><div align="left"><input class="form-control input-sm" readonly="readonly" id="direcciondespacho" name="direcciondespacho" type="text" size="100%" maxlength="255" value="<?php echo $r_cli[0]['direcciondespacho']?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Indique la dirección de despacho" /></div></td>
  </tr>
   <tr>
    <td ><div align="right">Estado:</div></td>
    <td><div align="left"><select class="form-control" name="estado" id="estado" required  onchange="loadm(this.value); loadc(this.value)" > 
    <option  value="">{Seleccione}</option>
        <?php for ($i=0; $i< count($e_Obt); $i++){   ?>
        
            <option <?php if($e_Obt[$i]['id_estado'] == $r_cli[0]['estado']) {echo 'selected="selected" '; $aux=$i; };
            $q=$r_cli[0]['estado'];?>
            value="<?php echo $e_Obt[$i]['id_estado']?>" title="Seleccione estado" 
            required="required"><?php echo $e_Obt[$i]['estado']?></option> 
        <?php
                                      }
                                    ?>
        </select></div></td> 
         
      <td width="4%" ><div align="right">Municipio</div></td>
      <td><div align="left" id="municipio"> <?php include('../vista/municipio.php');?></div></td>
      <td width="4%"><div align="right" >Parroquia:</div></td>
      <td><div align="left" id="parroquia"> <?php include('../vista/parroquia.php');?></div></td>
      <td width="4%"><div align="right">Ciudad:</div></td>
      <td><div align="left" id="ciudad"><?php include('../vista/ciudad.php');?></div></td>
      </td>
    </tr>
  <tr>
    <td nowrap><div align="right">Atendido por:</div></th>
    <td colspan="7"><div align="left"><input readonly="readonly" class="form-control input-sm" name="atendidopor" id="atendidopor" type="text" size="100" maxlength="30" value="<?php echo $r_cli[0]['atendidopor']?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Indique el nombre de quien lo atiende"/></td>
    </tr>
    <tr>
<td colspan="8">
    <div class="n" id="n" style="display:inline;">
    <input onclick="activar();" type="button"  class="btn btn-warning btn-sm" name="boton"  value="Actualizar Datos" /></div>
    <div class="m" id="m" style="display:none; desactivar();">
    <input onclick="registrar('<?php echo $pag;?>');return false" type="submit" class="btn btn-warning btn-sm" name="boton" value="Guardar" /></div>
     
    <div class="c" id="c" style="display:none;">
    <input onclick="guardar();" type="button" class="btn btn-warning btn-sm" name="boton" value="Guardar" /></div>
    <div class="cancelar" id="cancelar" style="display:none;"><input onclick="desactivar();" type="button" class="btn btn-warning btn-sm" name="boton" value="Cancelar" /></div></td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>