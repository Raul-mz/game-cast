<?php 
//



require_once("../class/class.new.php");
$resultado = new conSqlSelect;

/** Modificar **/
$pag="clientep";
/** Fin **/
$tabla="usuario";
$correou="correou";
$valorc=$_POST['correou'];
$ID="id";
/** Fin **/

$r_cli = $resultado->obtResultadoW($tabla,$correou,$valorc);

?>
 

<table align="center">
    <p>&nbsp; </p>
  <tr>

    <td><div align="right">Raz&oacute;n Social:</div></td>
    <td colspan="7" ><div align="left"><input name="clave" disabled="disabled" id="clave" type="text" size="82" maxlength="255" value="<?php echo $r_cli[0]['clave']?>" required="required" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Indique la raz&oacute;n social" />
      Rif:
      <input name="correou" id="rif" type="text" size="20" disabled="disabled" value="<?php echo $r_cli[0]['correou']?>"  maxlength="10"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Indique el Rif"/>
      </div>      
</td>
    </tr>
    <div class="n" id="n" style="display:inline;"><input onclick="activar();" type="button"  class="btn btn-warning btn-sm" name="boton"  value="Actualizar Datos" /></div>
    <div class="m" id="m" style="display:none; desactivar();"><input onclick="registrar('<?php echo $pag;?>');return false" type="submit" class="btn btn-warning btn-sm" name="boton" value="Guardar" />
    <input onclick="desactivar();" type="button" class="btn btn-warning btn-sm" name="boton" value="Cancelar" /></div></div></td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>