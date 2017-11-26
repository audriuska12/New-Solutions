<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class prekes_zymejimas {
    
   var $id;
   var $pavadinimas;
   var $data;
   var $laikas;

      public function __construct($data) {
        $this->id = $data['id'];
        $this->pavadinimas = $data['pavadinimas'];
        $this->data = $data['data'];
        $this->laikas = $data['laikas'];
    }
    
    public static function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM prekes_zymejimas WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new prekes_zymejimas($data);
        }
        return NULL;
    }
    
    
}