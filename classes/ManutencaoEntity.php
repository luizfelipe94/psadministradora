<?php

class ManutencaoEntity{
    protected $idManutencao;
    protected $dataManutencao;
    protected $estabelecimento;
    protected $detalhes;
    protected $id_Veiculo;
    protected $tipoServico;
    protected $descricao;
    protected $status;
   
    
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['idManutencao'])) {
            $this->idManutencao = $data['idManutencao'];
        }        
        $this->dataManutencao = $data['dataManutencao'];
        $this->estabelecimento = $data['estabelecimento'];
        $this->detalhes = $data['detalhes'];
        $this->id_Veiculo = $data['id_Veiculo'];
        $this->tipoServico = $data['tipoServico'];
        $this->descricao = $data['descricao'];
        $this->status = $data['status'];
    }

    public function getIdManutencao(){
        return $this->idManutencao;
    }

    public function getDataManutencao(){
        return $this->dataManutencao;
    }

    public function getEstabelecimento(){
        return $this->estabelecimento;
    }

    public function getDetalhes(){
        return $this->detalhes;
    }

    public function getIdVeiculo(){
        return $this->id_Veiculo;
    }

    public function getTipoServico(){
        return $this->tipoServico;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getStatus(){
        return $this->status;
    }
}