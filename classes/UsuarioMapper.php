<?php

class UsuarioMapper extends Mapper{

	const SESSION = "Usuario";

    public function getUsuarios(){

        $sql = "SELECT * FROM usuario";
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new UsuarioEntity($row);
		}

		return $results;

    }

    public function getUsuarioById($idUsuario){

		$sql = "SELECT * FROM usuario WHERE idUsuario = :idUsuario";
		$stmt = $this->db->prepare($sql);
		$result = $stmt->execute(["idUsuario" => $idUsuario]);

		if($result){
			return new UsuarioEntity($stmt->fetch());
		}

    }
    
    public function save(UsuarioEntity $usuario){

		$sql = "INSERT INTO usuario (username, userpass, tipo, id_Perfil) VALUES (:username, :userpass, :tipo, :id_Perfil)";

		$stmt = $this->db->prepare($sql);
		
		$result = $stmt->execute([
			":username" => $usuario->getUsername(),
			":userpass" => UsuarioMapper::getPasswordHash($usuario->getUserpass()),
			":tipo" => $usuario->getTipo(),
			":id_Perfil" => $usuario->getId_Perfil()
		]);

		if(!$result){
			throw new \Exception("Não foi possível salvar o Veiculo.");
			
		}

    }
    
    public function update(UsuarioEntity $usuario, $idUsuario){
		$sql = "UPDATE usuario
		SET username=:username, userpass=:userpass, tipo=:tipo, id_Perfil = :id_Perfil
		WHERE idUsuario=:idUsuario";

		$stmt = $this->db->prepare($sql);

		$result = $stmt->execute([
			":username" => $usuario->getUsername(),
			":userpass" => UsuarioMapper::getPasswordHash($usuario->getUserpass()),
            ":tipo" => $usuario->getTipo(),
            ":id_Perfil" => $usuario->getId_Perfil(),
            ":idUsuario" => $idUsuario
		]);

		if(!$result){
			throw new \Exception("Não foi possível atualizar o veículo.");
		}
    }
    
    public function delete($id){
		
		$sql = "DELETE FROM usuario WHERE idUsuario = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
    }
    
    public static function getPasswordHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
    }
    
    public function login($username, $userpass){

		//$sql = "SELECT * FROM usuario a INNER JOIN perfil b ON a.id_Perfil = b.idPerfil WHERE a.username = :username";
		
		$sql = "SELECT * FROM usuario WHERE username = :username";

        $stmt = $this->db->prepare($sql);
		$stmt->execute([":username" => $username]);

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if (count($results) === 0)
		{
			throw new \Exception("Usuário inexistente ou senha inválida. (nao retornou resultado)");
        }
        
        $data = $results[0];

        if(password_verify($userpass, $data["userpass"]) === true){

            $usuario = new UsuarioEntity($data);

			$_SESSION[UsuarioMapper::SESSION]['idUsuario'] = $usuario->getIdUsuario(); 
			$_SESSION[UsuarioMapper::SESSION]['username'] = $usuario->getUsername();
			$_SESSION[UsuarioMapper::SESSION]['tipo'] = $usuario->getTipo();
			$_SESSION[UsuarioMapper::SESSION]['id_Perfil'] = $usuario->getId_Perfil();

        }else{
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

	}
	
	public function logout(){

		$_SESSION[UsuarioMapper::SESSION] = null;
		unset($_SESSION[UsuarioMapper::SESSION]);

	}

	public function getIdUsuario($id){

		$sql = "SELECT * FROM usuario WHERE idUsuario = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$data = $stmt->execute();
	}

	public function checkLogin($tipo = "admin"):bool
	{
		if (
			!isset($_SESSION[UsuarioMapper::SESSION])
			||
			!$_SESSION[UsuarioMapper::SESSION]
			||
			!(int)$_SESSION[UsuarioMapper::SESSION]["idUsuario"] > 0
		) {
			//Não está logado
			return false;
		} else {
			if ($tipo === "admin" && (bool)$_SESSION[UsuarioMapper::SESSION]['tipo'] === "admin") {
				return true;
			} else if ($tipo !== "admin") {
				return true;
			} else {
				return false;
			}
		}
	}

	public function verifyLogin($request, $response, $tipo = "admin")
	{
		if (!UsuarioMapper::checkLogin($tipo)) {

			if ($tipo === "admin") {
			
				$response = $response->withRedirect('/dashboard');
				return $response;

			} else {
				
				$response = $response->withRedirect('/login');
				return $response;
				
			}
			
			exit;
		}
	}

	public function getTotalUsuarios(){
		$sql = "SELECT count(*) AS qte FROM usuario";
		$count = $this->db->query($sql)->fetchColumn();
		return $count;
	}

}