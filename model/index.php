<?php
/*****************************/
/***DESARROLLO HIDROCALIDO****/
/*****************************/
function getConnection() {
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="beisbol";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
    $dbh -> exec("set names utf8");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$metodo     = $request->metodo; 
if( $metodo == 'obtenerEquipos' ){
  obtenerEquipos();
}


function obtenerEquipos(){
    $sql ="SELECT * FROM equipo"; 
    try {
        $db = getConnection();
        $stmt = $db->query($sql);  
        $detalle = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"equipos": ' . json_encode($detalle) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

?>