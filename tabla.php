<link href="css_tabla/style.css" rel="stylesheet" type="text/css" >
<?php 

	require('../Connections.php'); 

	require("../funciones.php"); 

?>

<div class="resultados">
<table width="100%">

<div class="tabla100">
    <div>
        <div class="celda-img">&nbsp;</div>
        <div class="celda1"><b>JJ</b></div>
        <div class="celda2"><b>JG</b></div>
        <div class="celda1"><b>JP</b></div>
        <div class="celda2"><b>DIV</b></div>
        <div class="celda1"><b>AVE</b></div>
    </div>
</div>

<?

$result=mysql_query("select * from tablabeisbol order by posicion asc"); 
			$totalregistros=mysql_num_rows($result); 
			for ($i=1;$i<=$totalregistros;$i++){
			$row=mysql_fetch_array($result);
			$posicion=$row['posicion'];
			$equipo=$row['equipo'];
			$idbeisbol=$row['idbeisbol'];
			$jjj=$row['jjj'];
			$jjp=$row['jjp'];
			$jjg=$row['jjg'];
			$jdiv=$row['jdiv'];
			$ave=$row['ave'];
			$logo=$row['logo'];
?>

<tr>
 <td>
     <div class="celda-img"><img src="../admin/imagenescontenido/<?php echo $logo;?>" /></div>
     <div class="celda1"><?php echo $jjj;?></div><div class="celda2"><?php echo $jjg;?></div><div class="celda1"><?php echo $jjp;?></div>
	 <div class="celda2"><?php echo $jdiv;?></div><div class="celda1"><?php echo $ave;?></div>
  </td>   
</tr>  

<?php
}
?>
</table> 
</div>