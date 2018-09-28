<?php  

use Slim\Http\Request;
use Slim\Http\Response;
// use app\classes\UsuarioMapper;
// use app\classes\UsuarioEntity;

use app\src\controllers\UsuarioMapper;
use app\src\models\UsuarioEntity;

$app->get('/usuarios', function(Request $req, Response $res) {

    $mapper = new UsuarioMapper($this->db);
    $usuarios = $mapper->getUsuarios();
    $usuario = $_SESSION[UsuarioMapper::SESSION];
    $res = $this->viewtwig->render($res, "usuarios.html", [
        'usuarios' => $usuarios,
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
    return $res;

})->setName('usuarios');

$app->get('/usuario/novo', function(Request $req, Response $res) {

    $usuario = $_SESSION[UsuarioMapper::SESSION];

    $res = $this->viewtwig->render($res, "usuarioadd.html",[
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);

    return $res;
    
})->setName('usuarios-novo');

$app->post('/usuario/novo', function(Request $req, Response $res) {

    /*$this->validator->validate($request, [
        'username' => V::length(6, 25)->alnum('_')->noWhitespace(),
        'userpass' => V::length(6, 25),
        'confirme_userpass' => V::equals($request->getParam('userpass'))
    ]);

    if ($this->validator->isValid()) {
            
        $data = $req->getParsedBody();
        $usuarioData = [];
        $usuarioData['username'] = filter_var($data['username'], FILTER_SANITIZE_STRING);
        $usuarioData['userpass'] = filter_var($data['userpass'], FILTER_SANITIZE_STRING);
        $usuarioData['tipo'] = filter_var($data['tipo'], FILTER_SANITIZE_STRING);

        $usuario = new UsuarioEntity($usuarioData);
        $usuarioMapper = new UsuarioMapper($this->db);
        $usuarioMapper->save($usuario);

        return $res->withRedirect("/usuarios");
    }

    return $this->viewtwig->render($res, "usuarioadd.html",[
        'username' => $usuario['username'],
        'idUsuario' => $usuario['idUsuario']
    ]);
*/
    $data = $req->getParsedBody();
    $usuarioData = [];
    $usuarioData['username'] = filter_var($data['username'], FILTER_SANITIZE_STRING);
    $usuarioData['userpass'] = filter_var($data['userpass'], FILTER_SANITIZE_STRING);
    $usuarioData['tipo'] = filter_var($data['tipo'], FILTER_SANITIZE_STRING);

    $usuario = new UsuarioEntity($usuarioData);
    $usuarioMapper = new UsuarioMapper($this->db);
    $usuarioMapper->save($usuario);

    $res = $res->withRedirect("/usuarios");
    return $res;

})->setName('usuarios-novo');

$app->get('/usuario/{id}', function (Request $req, Response $res, $args) {
    $usuarioS = $_SESSION[UsuarioMapper::SESSION];
    $idUsuario = (int)$args['id'];
    $mapper = new UsuarioMapper($this->db);
    $usuario = $mapper->getUsuariobyId($idUsuario);

    $res = $this->viewtwig->render($res, "usuario-detalhes.html", [
        "usuario" => $usuario,
        'username' => $usuarioS['username'],
        'idUsuario' => $usuarioS['idUsuario']
    ]);
    return $res;
})->setName('usuarios-id');

$app->post('/usuario/{id}', function (Request $req, Response $res, $args){
    $data = $req->getParsedBody();
    $usuarioData = [];
    $usuarioData['username'] = filter_var($data['username'], FILTER_SANITIZE_STRING);
    $usuarioData['userpass'] = $data['userpass'];
    $usuarioData['tipo'] = $data['tipo'];

    $usuario = new UsuarioEntity($usuarioData);
    $usuarioMapper = new UsuarioMapper($this->db);
    $usuarioMapper->update($usuario, (int)$args['id']);

    $res = $res->withRedirect("/usuarios");
    return $res;
})->setName('usuarios-id');

$app->get('/usuario/{id}/deletar', function (Request $req, Response $res, $args) {
    $mapper = new UsuarioMapper($this->db);
    $mapper->delete((int)$args['id']);
    $res = $res->withRedirect("/usuarios");
    return $res;
})->setName('usuarios-deletar');

$app->get('/perfil/{id}', function(Request $req, Response $res, $args) {
    
    
});
