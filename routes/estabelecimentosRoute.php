<?php

use Slim\Http\Request;
use Slim\Http\Response;
// use app\classes\ManutencaoMapper;
// use app\classes\UsuarioMapper;
// use app\classes\VeiculoMapper;
// use app\classes\EstabelecimentoMapper;

use app\src\controllers\ManutencaoMapper;
use app\src\controllers\UsuarioMapper;
use app\src\controllers\VeiculoMapper;
use app\src\controllers\EstabelecimentoMapper;

$app->get('/estabelecimentos', function (Request $request, Response $response) {
    
    $usuario = $_SESSION[UsuarioMapper::SESSION];

    $mapper = new EstabelecimentoMapper($this->db);
    $estabelecimentos = $mapper->getEstabelecimentos();

    $response = $this->viewtwig->render($response, "estabelecimentos.html",[
        'estabelecimentos' => $estabelecimentos,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    
    return $response;

})->setName('estabelecimentos');

