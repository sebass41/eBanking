<?php

class Respuesta{
    public $sucess;
    public $msj;
    public $data;

    function __construct($sucess, $msj, $data){
        $this->sucess = $sucess;
        $this->msj = $msj;
        $this->data = $data;
    }
    
}
?>