<link href="css_tabla/style.css" rel="stylesheet" type="text/css" >

<html> 
<body> 
  
<?php 
$link = mysql_connect("localhost", "root", ""); 
mysql_select_db("beisbol", $link); 

?> 
  
<div class="resultados">
<table width="100%">

<div class="tabla100">
    <div>
        <div class="celda-img">&nbsp;</div>
        <div class="celda1"><b>JJ</b></div>
        <div class="celda2"><b>JG</b></div>
        <div class="celda1"><b>JP</b></div>
        <div class="celda2"><b>DIF</b></div>
        <div class="celda1"><b>AVE</b></div>
    </div>
</div>

<?php

$result=mysql_query("select * from equipo order by jg desc"); 
		if ($row = mysql_fetch_array($result)){ 
   do { 
      echo "<tr><td>

      <div class='celda-img'><img src='loguitos/".$row["imagen"]."'></div>
      <div class='celda1'>".$row["jj"]."</div>
	  <div class='celda2'>".$row["jg"]."</div>
	  <div class='celda1'>".$row["jp"]."</div>
	  <div class='celda2'>".$row["dive"]."</div>
	  <div class='celda1'>".$row["ave"]."</div>
      </td></tr>"; 
   } while ($row = mysql_fetch_array($result)); 
    
} else { 
echo "¡ No se ha encontrado ningún registro !"; 
} 
			
?>

			