<?php

class ManutencaoEntity{
    protected $idManutencao;
    protected $dataManutencao;
    protected $nome;
    protected $detalhes;
    protected $id_Veiculo;
   
    
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['idManutencao'])) {
            $this->idManutencao = $data['idManutencao'];
        }        
        $this->dataManutencao = $data['dataManutencao'];
        $this->nome = $data['nome'];
        $this->detalhes = $data['detalhes'];
        $this->id_Veiculo = $data['id_Veiculo'];
    }

    public function getIdManutencao(){
        return $this->idManutencao;
    }

    public function getDataManutencao(){
        return $this->dataManutencao;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getDetalhes(){
        return $this->detalhes;
    }

    public function getIdVeiculo(){
        return $this->id_Veiculo;
    }
}