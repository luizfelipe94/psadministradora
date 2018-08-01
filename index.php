<?php
session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//use \Tuupola\Middleware\HttpBasicAuthentication\PdoAuthenticator;

require __DIR__ . '/vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "";
$config['db']['dbname'] = "uberdatamanager";


$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();


//--------------CONTAINERS-------------------
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('PSADMINISTRADORA');
    $file_handler = new \Monolog\Handler\StreamHandler('./logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};
$container['viewtwig'] = function ($container) {
    $view = new \Slim\Views\Twig('./templates');

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));
    //$view->addExtension(new Awurth\SlimValidation\ValidatorExtension($container['validator']));

    return $view;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
/*
$app->add(new \Tuupola\Middleware\HttpBasicAuthentication([
    "path" => "/",
    "realm" => "Protected",
    "ignore" => ["/login"],
    "authenticator" => new PdoAuthenticator([
        "pdo" => $container['db'],
        "table" => "usuario",
        "user" => "username",
        "hash" => "userpass"
    ]),
    "error" => function ($response, $arguments) {
        $data = [];
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response->write(json_encode($data, JSON_UNESCAPED_SLASHES));
    }
]));
*/
    
//---------------ROTAS----------------------

require __DIR__ . '../routes/principalRoute.php';

require __DIR__ . '../routes/loginRoute.php';

require __DIR__ . '../routes/dashboardRoute.php';

require __DIR__ . '../routes/veiculosRoute.php';

require __DIR__ . '../routes/motoristasRoute.php';

require __DIR__ . '../routes/usuariosRoute.php';

require __DIR__ . '../routes/proprietariosRoute.php';

require __DIR__ . '../routes/manutencaoRoute.php';



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
