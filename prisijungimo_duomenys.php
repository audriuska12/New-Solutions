<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prisijungimo_duomenys
 *
 * @author audri
 */
class prisijungimo_duomenys {
    var $vartotojo_vardas;
    var $slaptazodis;
    var $atpazinimo_klausimas;
    var $atpazinimo_atsakymas;
    
    public function __construct($data){
        
    }
    
    public static function getFromDatabase($vartotojo_vardas){
        $data='';
        return new prisijungimo_duomenys($data);
    }
}
