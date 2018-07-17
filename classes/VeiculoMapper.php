<?php

class VeiculoMapper extends Mapper{

	public function getVeiculos(){

		$sql = "SELECT * FROM veiculos";
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new VeiculoEntity($row);
		}

		return $results;
	}

	public function getVeiculoById($idVeiculo){

		$sql = "SELECT * FROM veiculos WHERE idVeiculo = :idVeiculo";
		$stmt = $this->db->prepare($sql);
		$result = $stmt->execute(["idVeiculo" => $idVeiculo]);

		if($result){
			return new VeiculoEntity($stmt->fetch());
		}

	}

	public function save(VeiculoEntity $veiculo){

		$sql = "INSERT INTO veiculos (modelo, ano, cor, placa, km, dataVistoria) VALUES (:modelo, :ano, :cor, :placa, :km, :dataVistoria)";

		$stmt = $this->db->prepare($sql);
		
		$result = $stmt->execute([
			"modelo" => $veiculo->getModelo(),
			"ano" => $veiculo->getAno(),
			"cor" => $veiculo->getCor(),
			"placa" => $veiculo->getPlaca(),
			"km" => $veiculo->getKm(),
			"dataVistoria" => $veiculo->getDataVistoria(),
		]);

		if(!$result){
			throw new Exception("Não foi possível salvar o Veiculo.");
			
		}

	}
	
	public function update(VeiculoEntity $veiculo, $idVeiculo){
		$sql = "UPDATE veiculos 
		SET modelo=:modelo, ano=:ano, cor=:cor, placa=:placa, km=:km, dataVistoria=:dataVistoria
		WHERE idVeiculo=:idVeiculo";

		$stmt = $this->db->prepare($sql);

		$result = $stmt->execute([
			"modelo" => $veiculo->getModelo(),
			"ano" => $veiculo->getAno(),
			"cor" => $veiculo->getCor(),
			"placa" => $veiculo->getPlaca(),
			"km" => $veiculo->getKm(),
			"dataVistoria" => $veiculo->getDataVistoria(),
			"idVeiculo" => $idVeiculo
		]);

		if(!$result){
			throw new Exception("Não foi possível atualizar o veículo.");
		}
	}

}