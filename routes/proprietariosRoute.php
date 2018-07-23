<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/proprietarios', function (Request $req, Response $res){
    $usuario = $_SESSION[UsuarioMapper::SESSION];
    $res = $this->viewtwig->render($res, "proprietarios.html",[
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $res;
});