<?php

namespace app\classes;

class VeiculoEntity
{
    protected $idVeiculo;
    protected $modelo;
    protected $ano;
    protected $cor;
    protected $placa;
    protected $km;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['idVeiculo'])) {
            $this->idVeiculo = $data['idVeiculo'];
        }

        $this->modelo = $data['modelo'];
        $this->ano = $data['ano'];
        $this->cor = $data['cor'];
        $this->placa = strtoupper($data['placa']);
        $this->km = $data['km'];
    }

    public function getIdVeiculo() {
        return $this->idVeiculo;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getCor() {
        return $this->cor;
    }

    public function getPlaca() {
        return $this->placa;
    }

    public function getKm(){
        return $this->km;
    }

}
