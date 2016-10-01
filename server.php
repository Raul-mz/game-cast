<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
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

$time = date('r');
 $d=" The server time is: {$time}\n\n";

    $sql ="SELECT nombre FROM equipos"; 
    try {
        $db = getConnection();
        $stmt = $db->query($sql);  
        $detalle = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo "data: " .json_encode($detalle).$d ;
    } catch(PDOException $e) {
        echo '{"error":{"text":}}'; 
    }
flush();
?>