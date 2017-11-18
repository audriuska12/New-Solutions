<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of darbuotoju_finansai
 *
 * @author audri
 */
class darbuotoju_finansai {
    //put your code here
    
    public function __construct($data) {
    }
    
    public static function getFromDatabase($id){
        $data = "";
        return new darbuotoju_finansai($data);
    }
}
