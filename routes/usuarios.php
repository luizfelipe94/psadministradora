<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/usuarios', function(Request $req, Response $res) {

    $res = $this->viewtwig->render($res, "usuarios.html", [
        'var' => 'tela de usuarios'
    ]);

    return $res;

});