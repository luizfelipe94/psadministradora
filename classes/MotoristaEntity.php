<?php

class MotoristaEntity{

    protected $idMotorista;
    protected $nome;
    protected $cnh;
    protected $endereco;
    protected $uf;
    protected $telefone;
    protected $celular;

    public function __construct(array $data){
        if(isset($data['idMotorista'])) {
            $this->idMotorista = $data['idMotorista'];
        }
        $this->nome = $data['nome'];
        $this->cnh = $data['cnh'];
        $this->endereco = $data['endereco'];
        $this->uf = strtoupper($data['uf']);
        $this->telefone = $data['telefone'];
        $this->celular = $data['celular'];
    }

    public function getIdMotorista(){
        return $this->idMotorista;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCnh(){
        return $this->cnh;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function getUf(){
        return $this->uf;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getCelular(){
        return $this->celular;
    }
}