<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class turizymejima {
    
   var $fk_preke;
   var $fk_prekes_zymejimas;

public function __construct($data) {
        $this->fk_preke = $data['fk_preke'];
        $this->fk_prekes_zymejimas = $data['fk_prekes_zymejimas'];
        
}

public static function getFromDatabase($id) {
        $dbc = mysqli_connect("localhost", "root", "", "newsolutions");
        $sql = $dbc->prepare("SELECT * FROM turizymejima WHERE fk_preke = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new turizymejima($data);
        }
        return NULL;
    }
   public static function deleteFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("DELETE FROM turizymejima WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        return (mysqli_affected_rows($dbc) > 0);
    }  
}