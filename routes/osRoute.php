<?php

use Slim\Http\Request;
use Slim\Http\Response;
use app\classes\OsMapper;
use app\classes\UsuarioMapper;

$app->get('/os', function (Request $request, Response $response) {

    $mapper = new OsMapper($this->db);
    $os = $mapper->listAllOs();

    $response = $this->viewtwig->render($response, "os.html",[
        'username' => $_SESSION[UsuarioMapper::SESSION]['username'],
        'idUsuario' => $_SESSION[UsuarioMapper::SESSION]['idUsuario'],
        'oss' => $os
    ]);

    return $response;

})->setName('os');;