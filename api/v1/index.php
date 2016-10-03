<?php
require '.././libs/Slim/Slim.php';
require_once 'dbHelper.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();
$db = new dbHelper();

/**
* git pull -> para descargar
* git commit -m "mensaje del cambio"
* git push -> sube
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
    $rows = $db->select("equipo","id,nombre,imagen,status,jj,jg,jp,dive,ave",array());
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


// Juego
$app->get('/accion', function() { 
    global $db;
  $rows = $db->selectSql("SELECT accion.id,accion.fecha,
    accion.casa,accion.visitante,estadio.nombre as nombreEstadio,moderador.nombre as nombreModerador,
    moderador.apellido as Apellido,accion.carreras,accion.hit,accion.errores 
    FROM accion,equipo,estadio,moderador 
    WHERE accion.casa=equipo.id AND
    accion.visitante=equipo.id AND
    accion.id_estadio=estadio.id AND
    accion.id_moderador=moderador.id");   
      echoResponse(200, $rows);
});

$app->post('/accion', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('id');
    global $db;
    $rows = $db->insert("accion", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Se ha agregado satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/accion/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("accion", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información actualizada correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/accion/:id', function($id) { 
    global $db;
    $rows = $db->delete("accion", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Eliminado satisfactoriamente";
    echoResponse(200, $rows);
});


//Inning
$app->get('/inning', function() { 
    global $db;
  $rows = $db->selectSql("SELECT inning.id,inning.id_accion,
    inning.id_equipos,inning.inning as nroinning,inning.id_jugador,inning.pitchet,
    inning.id_jugada,jugador.nombre as nombreJ,equipo.nombre as nombreE,jugada.nombre as nombreJugada 
    FROM inning,accion,equipo,jugador,jugada 
    WHERE inning.id_accion=accion.id AND
    inning.id_equipos=equipo.id AND
    inning.id_jugador=jugador.id AND
    inning.id_jugada=jugada.id");   
      echoResponse(200, $rows);
});

$app->post('/inning', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('id');
    global $db;
    $rows = $db->insert("inning", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Se ha agregado satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/inning/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("inning", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información actualizada correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/inning/:id', function($id) { 
    global $db;
    $rows = $db->delete("inning", array('id'=>$id));
    if($rows["status"]=="success")
        $rows["message"] = "Eliminado satisfactoriamente";
    echoResponse(200, $rows);
});

// usuario
$app->get('/usuario', function() { 
    global $db;
    $rows = $db->select("usuario","id,nombre,correo,usuario,clave,status",array());
    echoResponse(200, $rows);
});

$app->post('/usuario', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('nombre');
    global $db;
    $rows = $db->insert("usuario", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información agregada satisfactoriamente";
    echoResponse(200, $rows);
});

$app->put('/usuario/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("usuario", $data, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Información actualizada correctamente.";
    echoResponse(200, $rows);
});

$app->delete('/usuario/:id', function($id) { 
    global $db;
    $rows = $db->delete("usuario", array('id'=>$id));
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

