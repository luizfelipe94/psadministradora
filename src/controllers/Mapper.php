<?php

namespace lfsilva\src\controllers;

abstract class Mapper {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

}
