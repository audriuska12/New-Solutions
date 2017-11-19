<?php

class prisijungimo_duomenys {

    var $vartotojo_vardas;
    var $slaptazodis;
    var $atpazinimo_klausimas;
    var $atpazinimo_atsakymas;

    public function __construct($data) {
        
    }

    public static function getFromDatabase($vartotojo_vardas) {
        $data = '';
        return new prisijungimo_duomenys($data);
    }

}
