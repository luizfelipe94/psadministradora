<?php

namespace app\classes;

class Notificacao extends Mail{

    public function sendManutencaoPendente($email){
        
        $this->sendEmail($email);

    }
}