<?php

use Slim\Http\Request;
use Slim\Http\Response;
use app\classes\UsuarioMapper;
use app\classes\ManutencaoMapper;

$app->get('/notificacoes', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "notificacao.html",[
        'username' => $_SESSION[UsuarioMapper::SESSION]['username'],
        'idUsuario' => $_SESSION[UsuarioMapper::SESSION]['idUsuario']
    ]);

    return $response;

})->setName('notificacoes');

$app->get('/notificacoes-pendentes', function (Request $request, Response $response) {

    $mapper = new ManutencaoMapper;

    $response = $response->withRedirect("/notificacoes");

    return $response;

})->setName('notificacoes-pendentes');