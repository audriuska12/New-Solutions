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

    public function __construct($data) {
        $this->id = $data['id'];
        $this->pavadinimas = $data['pavadinimas'];
    }

    public function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pareigos WHERE `id`=?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new pareigos($data);
        }
        return null;
    }

    public static function addToDatabase($pavadinimas) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO pareigos (pavadinimas) VALUES (?)");
        $sql->bind_param('s', $pavadinimas);
        $sql->execute();
        return mysqli_insert_id($dbc);
    }

    public static function removeFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql1 = $dbc->prepare("DELETE FROM turipareigas WHERE fk_pareigos=?");
        $sql1->bind_param('i', $id);
        $sql1->execute();
        $sql2 = $dbc->prepare("DELETE FROM pareigos WHERE id=?");
        $sql2->bind_param('i', $id);
        $sql2->execute();
        return (mysqli_affected_rows($dbc) > 0);
    }

}
