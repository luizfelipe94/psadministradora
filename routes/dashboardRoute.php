<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/dashboard', function (Request $request, Response $response) {

    $mapper = new UsuarioMapper($this->db);

    $idUsuario = (int)$_SESSION[UsuarioMapper::SESSION]['id_Perfil'];

    $precisaPerfil = $mapper->getIdUsuario($idUsuario);

    $response = $this->viewtwig->render($response, "dashboard.html",[
        'username' => $_SESSION[UsuarioMapper::SESSION]['username'],
        'idUsuario' => $_SESSION[UsuarioMapper::SESSION]['idUsuario'],
        'precisaPerfil' => $precisaPerfil
    ]);
    return $response;

});