<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of darbuotoju_rusis
 *
 * @author audri
 */
class vartotojo_rusis {
    var $id;
    var $pavadinimas;
    var $stazas;
    var $profesionalumo_lygis;
    var $sveikatos_sutrikimai;
    
    public function __construct($data){
        $this->id=$data['id'];
        $this->pavadinimas=$data['pavadinimas'];
        $this->stazas=$data['stazas'];
        $this->profesionalumo_lygis=$data['profesionalumo_lygis'];
        $this->sveikatos_sutrikimai=$data['sveikatos_sutrikimai'];
    }
    
    public static function getFromDatabase($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM `vartotojo_rusis` WHERE `id`=?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result=$sql->get_result();
        if($dbc->affected_rows >0){
            $data = $result->fetch_assoc();
            return new vartotojo_rusis($data);
        }
        return NULL;
    }
}
