<?php

use Slim\Http\Request;
use Slim\Http\Response;
use \classes\Mapper;
//use \classes\ErrorHandler; pq nao funciona com o autoload do composer???

require 'classes/ErrorHandler.php';

$app->get('/login', function (Request $request, Response $response) {

    $response = $this->viewtwig->render($response, "login.html",[
        "errorLogin" => ErrorHandler::getError()
    ]);

    return $response;

})->setName('login');

$app->post('/login', function (Request $req, Response $res) {

    $mapper = new UsuarioMapper($this->db);
    $data = [];
    $data = $req->getParsedBody();
    $logado = $mapper->login($data['username'], $data['userpass']);
   

    if($logado){
        $res = $res->withRedirect("/dashboard");
    }else{
        $res = $res->withRedirect("/login");
        ErrorHandler::setError("Usuário ou senha inválidos.");
    }
    if(isset($_SESSION[UsuarioMapper::SESSION]))
        $this->logger->addInfo("Usuario ".$_SESSION[UsuarioMapper::SESSION]['username']." fez login");

    return $res;

})->setName('login');

$app->get('/logout', function (Request $request, Response $response) {
    $this->logger->addInfo("Usuario ".$_SESSION[UsuarioMapper::SESSION]['username']." fez logoff");
    $mapper = new UsuarioMapper($this->db);
    $mapper->logout();
    $response = $response->withRedirect("/login");
    return $response;

})->setName('logout');