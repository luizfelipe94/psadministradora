<?php

namespace app\src\controllers;

class EstabelecimentoMapper extends Mapper{

    public function getEstabelecimentos(){

        $sql = "SELECT * FROM estabelecimento";
		$stmt = $this->db->query($sql);
		$results = [];

		while($row = $stmt->fetch()){
			$results[] = new EstabelecimentoEntity($row);
		}

		return $results;
    }

}