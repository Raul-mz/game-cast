<?php
require '.././libs/Slim/Slim.php';
require_once 'dbHelper.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();
$db = new dbHelper();

/**
 * Database Helper Function templates
 */
/*
select(table name, where clause as associative array)
insert(table name, data as associative array, mandatory column names as array)
update(table name, column names as associative array, where clause as associative array, required columns as array)
delete(table name, where clause as array)
*/


// Equipos


// jugada
$app->get('/jugador', function() { 
    global $db;
    $rows = $db->select("jugador","id,nombre,posicion,id_equipo",array());
    echoResponse(200, $rows);
});

$app->post('/jugador', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("jugador", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Se ha gregado satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/jugador/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("jugador", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información actualizada correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/jugador/:id', function($id) { 
    global $db;
    $rows = $db->delete("jugador", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Jugador eliminado satisfactoriamente";
    echoResponse(200, $rows);
});

function echoResponse($status_code, $response) {
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response,JSON_NUMERIC_CHECK);
}



$app->run();
?>

