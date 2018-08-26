<?php

class ErrorHandler{

    const ERROR = "Error";

    public static function setError($msg){

        $_SESSION[ErrorHandler::ERROR] = $msg;

    }

    public static function getError(){

        $msg = (isset($_SESSION[ErrorHandler::ERROR]) && $_SESSION[ErrorHandler::ERROR]) ? $_SESSION[ErrorHandler::ERROR] : '';
        ErrorHandler::clearError();
        return $msg;
    }

    public static function clearError(){
        $_SESSION[ErrorHandler::ERROR] = NULL;
    }

}