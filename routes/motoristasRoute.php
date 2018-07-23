<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/motoristas', function(Request $req, Response $res) {

    $mapper = new MotoristaMapper($this->db);
    $motoristas = $mapper->getMotoristas();
    $usuario = $_SESSION[UsuarioMapper::SESSION];

    $res = $this->viewtwig->render($res, "motoristas.html", [
        'motoristas' => $motoristas,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);

    return $res;

});

