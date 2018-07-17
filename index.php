<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "";
$config['db']['dbname'] = "uberdatamanager3";


$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

//-------------------------------------------------------------------------------------

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};
//--------------------------TWIG-------------------------------------------------------
$container['viewtwig'] = function ($container) {
    $view = new \Slim\Views\Twig('./templates');

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};
//--------------------------------------------------------------------------------------

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

//---------------ROTAS----------------------

$app->get('/', function (Request $request, Response $response) {

    echo "rota principal";

});

$app->get('/login', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "login.html",[]);

    return $response;

});

$app->post('/login', function (Request $req, Response $res) {

    $res = $res->withRedirect("/dashboard");
    return $res;

});

$app->get('/dashboard', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "dashboard.html",[]);

    return $response;

});

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
});

//CRIAR ROTA PARA DELETAR VEICULO

$app->get('/motoristas', function(Request $req, Response $res) {

    $res = $this->viewtwig->render($res, "motoristas.html", [
        'var' => 'tela de motoristas'
    ]);

    return $res;

});

$app->get('/usuarios', function(Request $req, Response $res) {

    $res = $this->viewtwig->render($res, "usuarios.html", [
        'var' => 'tela de usuarios'
    ]);

    return $res;

});

/*
$app->get('/ticket/{id}', function (Request $request, Response $response, $args) {
    $ticket_id = (int)$args['id'];
    $mapper = new TicketMapper($this->db);
    $ticket = $mapper->getTicketById($ticket_id);

    $response = $this->view->render($response, "ticketdetail.phtml", ["ticket" => $ticket]);
    return $response;
})->setName('ticket-detail');
*/
$app->run();
