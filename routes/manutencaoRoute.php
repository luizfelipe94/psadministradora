<?php

use Slim\Http\Request;
use Slim\Http\Response;
use app\classes\ManutencaoMapper;
use app\classes\UsuarioMapper;
use app\classes\VeiculoMapper;

$app->get('/manutencoes', function (Request $request, Response $response) {
    
    $usuario = $_SESSION[UsuarioMapper::SESSION];

    $mapper = new ManutencaoMapper($this->db);
    $manutencoes = $mapper->getManutencoes();

    $response = $this->viewtwig->render($response, "manutencoes.html",[
        'manutencoes' => $manutencoes,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $response;

})->setName('manutencoes');

$app->get('/agendar-manutencao/{id}', function (Request $request, Response $response, $args){

    $usuario = $_SESSION[UsuarioMapper::SESSION];
    $manutencaoMapper = new ManutencaoMapper($this->db);
    $veiculoMapper = new VeiculoMapper($this->db);

    $veiculo = $veiculoMapper->getVeiculoById((int)$args['id']);


    $response = $this->viewtwig->render($response, "agendar-manutencao.html",[
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario'],
        'veiculo' => $veiculo
    ]);

    return $response;

})->setName('agendar-manutencao-id');