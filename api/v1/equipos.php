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


// Equipo
$app->get('/equipos', function() { 
    global $db;
    $rows = $db->select("equipos","id,nombre,logo,status",array());
    echoResponse(200, $rows);
});

$app->post('/equipos', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("equipos", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Equipos agregado satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/equipos/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("equipos", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información sobre el equipos actualizado correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/equipos/:id', function($id) { 
    global $db;
    $rows = $db->delete("equipos", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Equipo eliminado satisfactoriamente";
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

