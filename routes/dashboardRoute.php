<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/dashboard', function (Request $request, Response $response) {

    $mapper = new UsuarioMapper($this->db);
    $mapperManutencao = new ManutencaoMapper($this->db);

    $idUsuario = (int)$_SESSION[UsuarioMapper::SESSION]['id_Perfil'];

    $precisaPerfil = $mapper->getIdUsuario($idUsuario);

    $veiculoMapper = new VeiculoMapper($this->db);
    $totalVeiculos = $veiculoMapper->getTotalVeiculos();
    $totalUsuarios = $mapper->getTotalUsuarios();
    $totalManutencoes = $mapperManutencao->getTotalManutencoes();

    $response = $this->viewtwig->render($response, "dashboard.html",[
        'username' => $_SESSION[UsuarioMapper::SESSION]['username'],
        'idUsuario' => $_SESSION[UsuarioMapper::SESSION]['idUsuario'],
        'precisaPerfil' => $precisaPerfil,
        'totalVeiculos' => $totalVeiculos,
        'totalUsuarios' => $totalUsuarios,
        'totalManutencoes' => $totalManutencoes
    ]);
    return $response;

})->setName('dashboard');;