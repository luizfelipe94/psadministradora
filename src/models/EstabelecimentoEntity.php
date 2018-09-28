<?php

namespace app\src\models;

class EstabelecimentoEntity{

    protected $idEstabelecimento;
    protected $nome;
    protected $endereco;

    public function __construct(array $data){

        if(isset($data['idEstabelecimento'])){
            $this->idEstabelecimento = $data['idEstabelecimento'];
        }
        $this->nome = $data['nome'];
        $this->endereco = $data['endereco'];
    }

    public function getIdEstabelecimento(){
        return $this->idEstabelecimento;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEndereco(){
        return $this->endereco;
    }
}