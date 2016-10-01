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


// estadio
$app->get('/estadio', function() { 
    global $db;
    $rows = $db->select("estadio","id,nombre,lugar,status",array());
    echoResponse(200, $rows);
});

$app->post('/estadio', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("estadio", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Estadio agregado satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/estadio/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("estadio", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información sobre el estado actualizado correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/estadio/:id', function($id) { 
    global $db;
    $rows = $db->delete("estadio", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Estadio eliminado satisfactoriamente";
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

