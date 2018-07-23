<?php

class PerfilEntity {

    protected $idPerfil;
    protected $nome;
    protected $cpf;
    protected $rg;
    protected $cnh;
    protected $email;
    protected $profissao;
    protected $educacao;
    protected $sobreMim;


    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['idPerfil'])) {
            $this->idPerfil = $data['idPerfil'];
        }

        $this->nome = $data['nome'];
        $this->cpf = $data['cpf'];
        $this->rg = $data['rg'];
        $this->cnh = strtoupper($data['cnh']);
        $this->email = $data['email'];
        $this->profissao = $data['profissao'];
        $this->educacao = $data['educacao'];
        $this->sobreMim = $data['sobreMim'];
        
    }

    public function getIdPerfil(){
        return $this->idPerfil;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getRg(){
        return $this->rg;
    }

    public function getCnh(){
        return $this->cnh;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getProfisao(){
        return $this->profissao;
    }

    public function getEducacao(){
        return $this->educacao;
    }

    public function getSobreMim(){
        return $this->sobreMim;
    }
}