<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/veiculos', function (Request $request, Response $response) {
    $this->logger->addInfo("Lista de Veiculos");
    $mapper = new VeiculoMapper($this->db);
    $veiculos = $mapper->getVeiculos();

    $response = $this->viewtwig->render($response, "veiculos.html", [
        'veiculos' => $veiculos,
        'teste' => 'teste'
    ]);
    return $response;
});

$app->get('/veiculo/novo', function(Request $req, Response $res) {
    $res = $this->viewtwig->render($res, "veiculoadd.html");
    return $res;
});

$app->post('/veiculo/novo', function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $veiculoData = [];
    $veiculoData['modelo'] = filter_var($data['modelo'], FILTER_SANITIZE_STRING);
    $veiculoData['ano'] = filter_var($data['ano'], FILTER_SANITIZE_STRING);
    $veiculoData['cor'] = filter_var($data['cor'], FILTER_SANITIZE_STRING);
    $veiculoData['placa'] = filter_var($data['placa'], FILTER_SANITIZE_STRING);
    $veiculoData['km'] = filter_var($data['km'], FILTER_SANITIZE_STRING);
    $veiculoData['dataVistoria'] = filter_var($data['dataVistoria'], FILTER_SANITIZE_STRING);

    $veiculo = new VeiculoEntity($veiculoData);
    $veiculoMapper = new VeiculoMapper($this->db);
    $veiculoMapper->save($veiculo);

    $res = $res->withRedirect("/veiculos");
    return $res;
});

$app->get('/veiculo/{id}', function (Request $req, Response $res, $args) {
    $veiculoId = (int)$args['id'];
    $mapper = new VeiculoMapper($this->db);
    $veiculo = $mapper->getVeiculoById($veiculoId);

    $res = $this->viewtwig->render($res, "veiculo-detalhes.html", ["veiculo" => $veiculo]);
    return $res;
});

//CRIAR ROTA PARA EDITAR VEICULO

//FIX: testar
$app->put('/veiculo/{id}', function (Request $req, Response $res, $args){
    $data = $req->getParsedBody();
    $veiculoData = [];
    $veiculoData['modelo'] = filter_var($data['modelo'], FILTER_SANITIZE_STRING);
    $veiculoData['ano'] = filter_var($data['ano'], FILTER_SANITIZE_STRING);
    $veiculoData['cor'] = filter_var($data['cor'], FILTER_SANITIZE_STRING);
    $veiculoData['placa'] = filter_var($data['placa'], FILTER_SANITIZE_STRING);
    $veiculoData['km'] = filter_var($data['km'], FILTER_SANITIZE_STRING);
    $veiculoData['dataVistoria'] = filter_var($data['dataVistoria'], FILTER_SANITIZE_STRING);

    $veiculo = new VeiculoEntity($veiculoData);
    $veiculoMapper = new VeiculoMapper($this->db);
    $veiculoMapper->update($veiculo, (int)$args['id']);

    $res = $res->withRedirect("/veiculos");
    return $res;
});