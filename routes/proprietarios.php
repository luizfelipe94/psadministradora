<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/proprietarios', function (Request $req, Response $res){
    $res = $this->viewtwig->render($res, "proprietarios.html",[
        
    ]);
    return $res;
});