<?php

include "darbuotojas.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grupe
 *
 * @author audri
 */
class grupe {

    var $id;
    var $pavadinimas;
    var $sukurimo_data;
    var $administratorius;
    var $matomumas;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->pavadinimas = $data['pavadinimas'];
        $this->sukurimo_data = $data['sukurimo_data'];
        $this->administratorius = $data['fk_administratorius'];
        $this->matomumas = $data['matomumas'];
    }

    public static function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM grupe WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new grupe($data);
        }
        return NULL;
    }
    
    public static function addToDatabase($pavadinimas, $sukurimo_data, $administratorius, $matomumas){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO grupe (pavadinimas, sukurimo_data, fk_administratorius, matomumas) VALUES (?, ?, ?, ?)");
        $sql->bind_param('ssii', $pavadinimas, $sukurimo_data, $administratorius, $matomumas);
        $sql->execute();
        return (mysqli_affected_rows($dbc) > 0);
    }
    
    public static function deleteFromDatabase($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql1 = $dbc->prepare("DELETE FROM darbuotojas_priklauso_grupe WHERE fk_grupe=?");
        $sql1->bind_param('i', $id);
        $sql1->execute();
        $sql2 = $dbc->prepare("DELETE FROM grupe WHERE id=?");
        $sql2->bind_param('i', $id);
        $sql2->execute();
        return (mysqli_affected_rows($dbc) > 0);
    }

    public function getAdministratorius(){
        return darbuotojas::getFromDatabase($this->administratorius);
    }
    
    public function getDarbuotojai(){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM darbuotojas WHERE id = ? OR id IN (SELECT fk_darbuotojas FROM darbuotojas_priklauso_grupe WHERE fk_grupe = ? )");
        $sql->bind_param('ii', $this->administratorius, $this->id);
        $sql->execute();
        $result = $sql->get_result();
        $darbuotojai = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $darbuotojai[]=new darbuotojas($data);
            }
        }
        return $darbuotojai;
    }
    
    public static function getViesosGrupes(){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM grupe WHERE matomumas=1");
        $sql->execute();
        $result = $sql->get_result();
        $grupes = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $grupes[]=new grupe($data);
            }
        }
        return $grupes;
    }
    
    public function addDarbuotojas($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO darbuotojas_priklauso_grupe (fk_grupe, fk_darbuotojas) VALUES (?, ?)");
        $sql->bind_param('ii', $this->id, $id);
        $sql->execute();
        return (mysqli_affected_rows($dbc) > 0);
    }
    
    public function removeDarbuotojas($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("DELETE FROM darbuotojas_priklauso_grupe WHERE fk_darbuotojas = ? && fk_grupe = ?");
        $sql->bind_param('ii', $id, $this->id);
        $sql->execute();
        return (mysqli_affected_rows($dbc) > 0);
    }
    
    public function changeAdministratorius($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $this->addDarbuotojas($this->administratorius);
        $this->removeDarbuotojas($id);
        $sql = $dbc->prepare("UPDATE grupe SET fk_administratorius = ? WHERE id = ?");
        $sql->bind_param('ii', $id, $this->id);
        $sql->execute();
        $this->administratorius=$id;
        return (mysqli_affected_rows($dbc) > 0);
    }
}
