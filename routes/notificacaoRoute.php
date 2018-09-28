<?php

use Slim\Http\Request;
use Slim\Http\Response;
// use app\classes\UsuarioMapper;
// use app\classes\Notificacao;

use app\src\controllers\UsuarioMapper;
use app\src\controllers\Notificacao;

$app->get('/notificacoes', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "notificacao.html",[
        'username' => $_SESSION[UsuarioMapper::SESSION]['username'],
        'idUsuario' => $_SESSION[UsuarioMapper::SESSION]['idUsuario']
    ]);

    return $response;

})->setName('notificacoes');

$app->post('/notificacoes-pendentes', function (Request $request, Response $response) {

    $notificacao = new Notificacao;

    $notificacao->sendManutencaoPendente('luizlipefs@hotmail.com');

    $response = $response->withRedirect("/notificacoes");

    return $response;

})->setName('notificacoes-pendentes');
