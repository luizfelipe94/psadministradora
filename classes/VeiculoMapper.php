<?php

namespace app\classes;

class VeiculoMapper extends Mapper{

	public function getVeiculos(){

		$sql = "SELECT * FROM veiculo";
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new VeiculoEntity($row);
		}

		return $results;
	}

	public function getVeiculoById($idVeiculo){

		$sql = "SELECT * FROM veiculo WHERE idVeiculo = :idVeiculo";
		$stmt = $this->db->prepare($sql);
		$result = $stmt->execute(["idVeiculo" => $idVeiculo]);

		if($result){
			return new VeiculoEntity($stmt->fetch());
		}

	}

	public function save(VeiculoEntity $veiculo){

		$sql = "INSERT INTO veiculo (modelo, ano, cor, placa, km) VALUES (:modelo, :ano, :cor, :placa, :km)";

		$stmt = $this->db->prepare($sql);
		
		$result = $stmt->execute([
			":modelo" => $veiculo->getModelo(),
			":ano" => $veiculo->getAno(),
			":cor" => $veiculo->getCor(),
			":placa" => $veiculo->getPlaca(),
			":km" => $veiculo->getKm()
		]);

		if(!$result){
			throw new Exception("Não foi possível salvar o Veiculo.");
			
		}

	}
	
	public function update(VeiculoEntity $veiculo, $idVeiculo){
		$sql = "UPDATE veiculo
		SET modelo=:modelo, ano=:ano, cor=:cor, placa=:placa, km=:km
		WHERE idVeiculo=:idVeiculo";

		$stmt = $this->db->prepare($sql);

		$result = $stmt->execute([
			":modelo" => $veiculo->getModelo(),
			":ano" => $veiculo->getAno(),
			":cor" => $veiculo->getCor(),
			":placa" => $veiculo->getPlaca(),
			":km" => $veiculo->getKm(),
			":idVeiculo" => $idVeiculo
		]);

		if(!$result){
			throw new Exception("Não foi possível atualizar o veículo.");
		}
	}

	public function delete($id){
		
		$sql = "DELETE FROM veiculo WHERE idVeiculo = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
	}

	public function getTotalVeiculos(){
		$sql = "SELECT count(*) AS qte FROM veiculo";
		$count = $this->db->query($sql)->fetchColumn();
		return $count;
	}

}