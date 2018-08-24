<?php

class ManutencaoMapper extends Mapper{

    public function getManutencoes(){

        $sql = "select * from manutencao a
		inner join veiculo b
		on a.id_Veiculo = b.idVeiculo ORDER BY a.idManutencao";
		
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new ManutencaoEntity($row);
		}

		return $results;

    }

	public function getManutencaoById($idManutencao){

		$sql = "SELECT * FROM manutencao a INNERR JOIN veiculo b ON a.id_Veiculo = b.idVeiculo 
		WHERE a.idManutencao = :idManutencao";

		$stmt = $this->db->prepare($sql);
		$result = $stmt->execute(['idManutencao' => $idManutencao]);

		if($result){
			return new ManutencaoEntity($stmt->fetch());
		}
	}

	public function getManutencoesByIdVeiculo($idVeiculo){
		
		$sql = "SELECT * FROM manutencao WHERE id_Veiculo = :idVeiculo";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':idVeiculo', $idVeiculo);
		$stmt->execute();

		$results = $stmt->fetchAll();

		return $results;

	}

	public function getTotalManutencoes(){
		$sql = "SELECT count(*) AS qte FROM manutencao";
		$count = $this->db->query($sql)->fetchColumn();
		return $count;
	}

	public function save(){

	}

	public function delete(){

	}

	public function update(){
		
	}


	public function getManutencoesConcluidas(){
		$sql = "select * from manutencao WHERE status = 'OK' ORDER BY idManutencao limit 10";
		
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new ManutencaoEntity($row);
		}

		return $results;
	}

	public function getManutencoesPendentes(){
		$sql = "select * from manutencao WHERE status = 'PE' ORDER BY idManutencao limit 10";
		
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new ManutencaoEntity($row);
		}

		return $results;
	}

	public function getManutencoesCanceladas(){
		$sql = "select * from manutencao WHERE status = 'CA' ORDER BY idManutencao limit 10";
		
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new ManutencaoEntity($row);
		}

		return $results;
	}

	
}