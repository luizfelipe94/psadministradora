<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/dashboard', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "dashboard.html",[]);

    return $response;

});