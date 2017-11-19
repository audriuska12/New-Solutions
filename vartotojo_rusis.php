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
class vartotojo_rusis {

    var $id;
    var $pavadinimas;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->pavadinimas = $data['pavadinimas'];
    }

    public function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM vartotojo_rusis WHERE `id`=?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new vartotojo_rusis($data);
        }
        return null;
    }

    public static function addToDatabase($pavadinimas) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO vartotojo_rusis (pavadinimas) VALUES (?)");
        $sql->bind_param('s', $pavadinimas);
        $sql->execute();
        return mysqli_insert_id($dbc);
    }
    
    public static function getVartotojuRusys(){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM vartotojo_rusis");
        $sql->execute();
        $result = $sql->get_result();
        $rusys = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $rusys[] = new vartotojo_rusis($data);
            }
        }
        return $rusys;
    }

}
