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
}