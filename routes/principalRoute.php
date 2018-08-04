<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "veiculo-detalhes.html", [
        'usuarios' => $usuarios,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $response;

});