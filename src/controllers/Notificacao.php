<?php

namespace app\src\controllers;

class Notificacao extends Mail{

    public function sendManutencaoPendente($email){
        
        $this->sendEmail($email);

    }
}