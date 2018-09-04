<?php

namespace app\classes;

class PerfilMapper extends Mapper{

    public function verificaPerfilExiste($idPerfil){
        
        $sql = "SELECT * FROM usuario WHERE id_Perfil = :idPerfil";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id_Perfil" => $idPerfil]);

        if($result){
            $usuario = new UsuarioEntity($stmt->fetch());
        }
    }

}