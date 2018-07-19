<?php

class MotoristaMapper extends Mapper{

	public function getMotoristas(){

		$sql = "SELECT * FROM motorista";
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new MotoristaEntity($row);
		}

		return $results;
    }
    
}