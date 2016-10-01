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


// jugada
$app->get('/jugada', function() { 
    global $db;
    $rows = $db->select("jugada","id,nombre,status",array());
    echoResponse(200, $rows);
});

$app->post('/jugada', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("jugada", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Jugada agregada satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/jugada/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("jugada", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información sobre la jugada actualizado correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/jugada/:id', function($id) { 
    global $db;
    $rows = $db->delete("jugada", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Jugada eliminado satisfactoriamente";
    echoResponse(200, $rows);
});

/*******************************************/

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
        $rows["message"] = "Información agregada satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/estadio/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("estadio", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información actualizada correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/estadio/:id', function($id) { 
    global $db;
    $rows = $db->delete("estadio", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Información eliminada satisfactoriamente";
    echoResponse(200, $rows);
});


/***********************************************************************/

// Equipo
$app->get('/equipo', function() { 
    global $db;
    $rows = $db->select("equipo","id,nombre,imagen,status",array());
    echoResponse(200, $rows);
});

$app->post('/equipo', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("equipo", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información agregada satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/equipo/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("equipo", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información sobre actualizado correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/equipo/:id', function($id) { 
    global $db;
    $rows = $db->delete("equipo", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Información eliminada satisfactoriamente";
    echoResponse(200, $rows);
});

// jugador
$app->get('/jugador', function() { 
    global $db;
  $rows = $db->select2Table("jugador","equipo","jugador.id,jugador.nombre,jugador.posicion,
  	equipo.nombre as nombreE,jugador.status",array(),"id_equipo","id");   

      echoResponse(200, $rows);
});

$app->post('/jugador', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("jugador", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Jugador agregado satisfactoriamente";
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
        $rows["message"] = "Eliminado satisfactoriamente";
    echoResponse(200, $rows);
});

// moderador
$app->get('/moderador', function() { 
    global $db;
    $rows = $db->select("moderador","id,nombre,apellido,status",array());
    echoResponse(200, $rows);
});

$app->post('/moderador', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("moderador", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información agregada satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/moderador/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("moderador", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información actualizada correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/moderador/:id', function($id) { 
    global $db;
    $rows = $db->delete("moderador", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Información eliminada satisfactoriamente";
    echoResponse(200, $rows);
});


// posicion
$app->get('/posicion', function() { 
    global $db;
  $rows = $db->select("posicion","id,loguito,jj,jg,jp,div,ave,status",array());
    echoResponse(200, $rows);
});

$app->post('/posicion', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('jj');
    global $db;
    $rows = $db->insert("posicion", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información agregada satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/posicion/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("posicion", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información actualizada correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/posicion/:id', function($id) { 
    global $db;
    $rows = $db->delete("posicion", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Información eliminada satisfactoriamente";
    echoResponse(200, $rows);
});


/*********************************/
function echoResponse($status_code, $response) {
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response,JSON_NUMERIC_CHECK);
}
/**********************************/

$app->run();
?>

