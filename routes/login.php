<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/login', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "login.html",[]);

    return $response;

});

$app->post('/login', function (Request $req, Response $res) {

    $res = $res->withRedirect("/dashboard");
    return $res;

});