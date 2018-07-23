<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/dashboard', function (Request $request, Response $response) {

    $mapper = new UsuarioMapper($this->db);

    $idUsuario = (int)$_SESSION[UsuarioMapper::SESSION]['id_Perfil'];

    $precisaPerfil = $mapper->getIdUsuario($idUsuario);
/*
    $perfilExiste = $usuario->getId_Perfil();

    $precisaPerfil = isset($perfilExiste)? 1 : 0;

    $usuario = $_SESSION[UsuarioMapper::SESSION];

    */

    $response = $this->viewtwig->render($response, "dashboard.html",[
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario'],
        'precisaPerfil' => $precisaPerfil
    ]);
    return $response;

});