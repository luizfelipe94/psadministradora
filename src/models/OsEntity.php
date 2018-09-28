<?php

namespace lfsilva\src\models;

class OsEntity{

    protected $idOs;
    protected $status;
    protected $dataInicial;
    protected $dataFinal;
    protected $valorTotal;
    protected $responsavel;

    public function __construct(array $data){
        if(isset($data['idOs'])) {
            $this->idOs = $data['idOs'];
        }
        $this->status = $data['status'];
        $this->dataInicial = $data['dataInicial'];
        $this->dataFinal = $data['dataFinal'];
        $this->valorTotal = $data['valorTotal'];
        $this->responsavel = $data['responsavel'];
    }

    public function getIdOs(){
        return $this->idOs;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getDataInicial(){
        return $this->dataInicial;
    }

    public function getDataFinal(){
        return $this->dataFinal;
    }

    public function getValorTotal(){
        return $this->valorTotal;
    }

    public function getResponsavel(){
        return $this->responsavel;
    }

}