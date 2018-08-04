<?php

class ManutencaoMapper extends Mapper{

    public function getManutencoes(){

        $sql = "select * from manutencao a
		inner join veiculo b
		on a.id_Veiculo = b.idVeiculo";
		
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

	
}