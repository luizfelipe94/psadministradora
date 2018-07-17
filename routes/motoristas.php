<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/motoristas', function(Request $req, Response $res) {

    $res = $this->viewtwig->render($res, "motoristas.html", [
        'var' => 'tela de motoristas'
    ]);

    return $res;

});