<!DOCTYPE html>
<html ng-app="myApp">
<body ng-cloak="">
  <title>Administrador de Juegos</title>
  <meta charset="UTF-8"> 
  <meta name="Description" content="Administrador Beisbol">
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="css/custom.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <div class="col-md-10 col-md-offset-1 ">
                    <img src="images/logo.png">
                    <img src="images/logo-cardenales.png">
                    <img src="images/Logo_peq_Aguilas.png">
                    <img src="images/Logo_peq_Bravos.png">
                    <img src="images/Logo_peq_Caribes.png">
                    <img src="images/Logo_peq_Leones.png">
                    <img src="images/Logo_peq_Navegantes.png">
                    <img src="images/Logo_peq_Tiburones.png">
                    <img src="images/Logo_peq_Tigres.png">  
                    </div>

  <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          
       
          
        </nav>
      </div>
    </div>

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


<form action="../modelo/verificaradmin.php" method="post" name="form1">
 <input  type="hidden" class="form-control" id="campo" value="<?php echo $r_cli[0]['id']?>">
   <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</br>
  <p ><div class="r col-md-offset-4"><h2></h2></div> </p>

<div class="main col-sm-12 col-xs-12 col-lg-4 col-md-4   col-md-offset-4 white sombra" >
    <div class="table-responsive">
  <table class="table">
<tr>
<p>&nbsp;</p>
    <td ><div align="right" class="te">Usuario:</div></td>
    <td colspan="3" ><div align="left">
      <input class="form-control" name="usuario" autofocus="autofocus" type="text" size="21" maxlength="30" value="<?php echo $r_cli[0]['usuario']?>" /></div>  

</td>
    </tr>
  <tr>
    <td ><div align="right" class="te">Contraseña:</div></td>
    <td ><div align="left" >
      <input class="form-control" name="clave" type="password" size="21" maxlength="30" value="<?php echo $r_cli[0]['clave']?>" /></div>   </td>
    </tr>
        <tr>
          <td colspan="3"><div align="center">
            <label>
            <strong><input class="btn btn-warning"   type="submit" name="boton" value="Entrar" />
            </strong></label>
          </div></td>
          </tr>
          <tr>
<td colspan="3"><div align='center' class='te'> <a href='../vista/recuperacion.php'>¿Has olvidado la contraseña?...</a></div>
         
        </tr>
      </table>
  </div></td>
    </tr>
</table></div>
</div>
</form>
</body>

</html>