<?php

namespace lfsilva\src\controllers;

class OsMapper extends Mapper{

    public function listAllOs(){

        $sql = "SELECT * FROM os";
        $stmt = $this->db->query($sql);
        $results = [];
    
        while($row = $stmt->fetch()){
            $results[] = new OsEntity($row);
        }

        return $results;
    }
    

}