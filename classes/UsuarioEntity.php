<?php

class UsuarioEntity{

    protected $idUsuario;
    protected $username;
    protected $userpass;
    protected $tipo;
    protected $id_Perfil;

    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['idUsuario'])) {
            $this->idUsuario = $data['idUsuario'];
        }

        $this->username = $data['username'];
        $this->userpass = $data['userpass'];
        $this->tipo = $data['tipo'];
        $this->id_Perfil = $data['id_Perfil'];
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getUserpass(){
        return $this->userpass;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getId_Perfil(){
        return $this->id_Perfil;
    }

}