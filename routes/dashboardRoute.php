<?php

use Slim\Http\Request;
use Slim\Http\Response;
use app\classes\UsuarioMapper;
use app\classes\ManutencaoMapper;
use app\classes\VeiculoMapper;

$app->get('/dashboard', function (Request $request, Response $response) {

    $mapper = new UsuarioMapper($this->db);
    $mapperManutencao = new ManutencaoMapper($this->db);

    $idUsuario = (int)$_SESSION[UsuarioMapper::SESSION]['idUsuario'];

    $veiculoMapper = new VeiculoMapper($this->db);
    $totalVeiculos = $veiculoMapper->getTotalVeiculos();
    $totalUsuarios = $mapper->getTotalUsuarios();
    $totalManutencoes = $mapperManutencao->getTotalManutencoes();
    $totalManutencoesConcluidas = $mapperManutencao->getManutencoesConcluidas();
    $totalManutencoesPendentes = $mapperManutencao->getManutencoesPendentes();
    $totalManutencoesCanceladas = $mapperManutencao->getManutencoesCanceladas();

    $response = $this->viewtwig->render($response, "dashboard.html",[
        'username' => $_SESSION[UsuarioMapper::SESSION]['username'],
        'idUsuario' => $_SESSION[UsuarioMapper::SESSION]['idUsuario'],
        'totalVeiculos' => $totalVeiculos,
        'totalUsuarios' => $totalUsuarios,
        'totalManutencoes' => $totalManutencoes,
        'totalManutencoesConcluidas' => $totalManutencoesConcluidas,
        'totalManutencoesPendentes' => $totalManutencoesPendentes,
        'totalManutencoesCanceladas' => $totalManutencoesCanceladas        
    ]);
    return $response;

})->setName('dashboard');;