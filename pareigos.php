<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of darbuotojo_pareigos
 *
 * @author audri
 */
class pareigos {
    var $id;
    var $pavadinimas;
    
    public function __construct($data){
        $this->id=$data['id'];
        $this->pavadinimas=$data['pavadinimas'];
    }
    
    public function getFromDatabase($id){
        $dbc=mysqli_connect('localhost', 'root', '', 'newsolutions');
        $sql=$dbc->prepare("SELECT * FROM pareigos WHERE `id`=?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new pareigos($data);
        }
        return null;
    }
}
