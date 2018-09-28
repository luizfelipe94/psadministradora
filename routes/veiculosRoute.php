<?php

use Slim\Http\Request;
use Slim\Http\Response;
// use app\classes\VeiculoMapper;
// use app\classes\UsuarioMapper;
// use app\classes\ManutencaoMapper;

use app\src\controllers\VeiculoMapper;
use app\src\controllers\UsuarioMapper;
use app\src\controllers\ManutencaoMapper;

$app->get('/veiculos', function (Request $request, Response $response) {
    
    $this->logger->addInfo("Lista de Veiculos");
    $mapper = new VeiculoMapper($this->db);
    $veiculos = $mapper->getVeiculos();
    $usuario = $_SESSION[UsuarioMapper::SESSION];

    $response = $this->viewtwig->render($response, "veiculos.html", [
        'veiculos' => $veiculos,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $response;
})->setName('veiculos');

$app->get('/veiculo/novo', function(Request $req, Response $res) {
    $usuario = $_SESSION[UsuarioMapper::SESSION];
    $res = $this->viewtwig->render($res, "veiculoadd.html",[
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $res;
})->setName('veiculos-novo');

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
})->setName('veiculos-novo');

$app->get('/veiculo/{id}', function (Request $req, Response $res, $args) {
    $usuario = $_SESSION[UsuarioMapper::SESSION];
    $veiculoId = (int)$args['id'];
    $mapper = new VeiculoMapper($this->db);
    $veiculo = $mapper->getVeiculoById($veiculoId);

    $res = $this->viewtwig->render($res, "veiculoupdate.html", [
        "veiculo" => $veiculo,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
        
    ]);
    return $res;
})->setName('veiculos-id');

$app->post('/veiculo/{id}', function (Request $req, Response $res, $args){
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
})->setName('veiculos-id');

$app->get('/veiculo-detalhes/{id}', function (Request $request, Response $response, $args) {
    $usuario = $_SESSION[UsuarioMapper::SESSION];
    $veiculoId = (int)$args['id'];
    $mapper = new VeiculoMapper($this->db);
    $veiculo = $mapper->getVeiculoById($veiculoId);

    $mapperManutencao = new ManutencaoMapper($this->db);
    $manutencoes = $mapperManutencao->getManutencoesByIdVeiculo($veiculoId);

    $response = $this->viewtwig->render($response, "veiculo-detalhes.html", [
        'veiculo' => $veiculo,
        'manutencoes' => $manutencoes,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $response;

})->setName('veiculos-detalhes-id');

$app->get('/veiculo/{id}/deletar', function (Request $req, Response $res, $args) {
    $mapper = new VeiculoMapper($this->db);
    $mapper->delete((int)$args['id']);
    $res = $res->withRedirect("/veiculos");
    return $res;
})->setName('veiculos-id-deletar');
