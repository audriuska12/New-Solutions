<?php

class pareigos {

    var $id;
    var $pavadinimas;
    var $stazas;
    var $profesionalumo_lygis;
    var $sveikatos_sutrikimai;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->pavadinimas = $data['pavadinimas'];
        $this->stazas = $data['stazas'];
        $this->profesionalumo_lygis = $data['profesionalumo_lygis'];
        $this->sveikatos_sutrikimai = $data['sveikatos_sutrikimai'];
    }

    public static function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM `pareigos` WHERE `id`=?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if ($dbc->affected_rows > 0) {
            $data = $result->fetch_assoc();
            return new pareigos($data);
        }
        return NULL;
    }
    
    public static function addToDatabase($pavadinimas, $stazas, $profesionalumo_lygis, $sveikatos_sutrikimai) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO pareigos (pavadinimas, stazas, profesionalumo_lygis, sveikatos_sutrikimai) VALUES (?, ?, ?, ?)");
        $sql->bind_param('siss', $pavadinimas, $stazas, $profesionalumo_lygis, $sveikatos_sutrikimai);
        $sql->execute();
        return (mysqli_insert_id($dbc));
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

    public static function isvalyti(){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("DELETE FROM pareigos WHERE id NOT IN (SELECT fk_pareigos from turipareigas)");
        $sql->execute();
        return (mysqli_affected_rows($dbc) > 0);
    }
}
