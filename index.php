<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//use \Tuupola\Middleware\HttpBasicAuthentication\PdoAuthenticator;

require __DIR__ . '/vendor/autoload.php';

use app\classes\UsuarioMapper;

session_start();

$config['displayErrorDetails'] = true;
$config['determineRouteBeforeAppMiddleware'] = true;
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

// Apply the middleware to every request.
$app->add(function (Request $request, Response $response, $next) {
    $route = $request->getAttribute('route');
    $routeName = $route->getName();
    $groups = $route->getGroups();
    $methods = $route->getMethods();
    $arguments = $route->getArguments();

    # Define routes that user does not have to be logged in with. All other routes, the user
    # needs to be logged in with.
    $publicRoutesArray = array(
        'login',
        'post-login',
        'register',
        'forgot-password',
        'register-post'
    );

    if (!isset($_SESSION[UsuarioMapper::SESSION]) && !in_array($routeName, $publicRoutesArray))
    {
        // redirect the user to the login page and do not proceed.
        $response = $response->withRedirect('/login');
    }
    else
    {
        // Proceed as normal...
        $response = $next($request, $response);
    }

    return $response;
});

//---------------ROTAS----------------------

require __DIR__ . '../routes/principalRoute.php';

require __DIR__ . '../routes/loginRoute.php';

require __DIR__ . '../routes/dashboardRoute.php';

require __DIR__ . '../routes/veiculosRoute.php';

require __DIR__ . '../routes/motoristasRoute.php';

require __DIR__ . '../routes/usuariosRoute.php';

require __DIR__ . '../routes/manutencaoRoute.php';

require __DIR__ . '../routes/osRoute.php';

$app->run();
