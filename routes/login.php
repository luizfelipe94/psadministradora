<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/login', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "login.html",[]);

    return $response;

});

$app->post('/login', function (Request $req, Response $res) {

    $mapper = new UsuarioMapper($this->db);
    $data = [];
    $data = $req->getParsedBody();
    $mapper->login($data['username'], $data['userpass']);

    $res = $res->withRedirect("/dashboard");
    return $res;

});

$app->get('/logout', function (Request $request, Response $response) {

    $mapper = new UsuarioMapper($this->db);
    $mapper->logout();
    $response = $response->withRedirect("/login");
    return $response;

});