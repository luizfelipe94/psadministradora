<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/manutencoes', function (Request $request, Response $response) {
    
    $usuario = $_SESSION[UsuarioMapper::SESSION];

    $mapper = new ManutencaoMapper($this->db);
    $manutencoes = $mapper->getManutencoes();

    $response = $this->viewtwig->render($response, "manutencoes.html",[
        'manutencoes' => $manutencoes,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $response;

})->setName('manutencoes');