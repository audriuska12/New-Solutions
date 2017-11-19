<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pastaba
 *
 * @author audri
 */
class pastaba {
    var $id;
    var $viesa;
    var $tekstas;
    var $rasymo_data;
    var $rasytojas;
    var $gavejas;
    
    public function __construct($data){
        $this->id=$data['id'];
        $this->viesa=$data['viesa'];
        $this->tekstas=$data['tekstas'];
        $this->rasymo_data=$data['rasymo_data'];
        $this->rasytojas=$data['fk_rasytojas'];
        $this->gavejas=$data['fk_gavejas'];
    }
    
    public static function getFromDatabase($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pastaba WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new pastaba($data);
        }
        return NULL;
    }
    
    public static function deleteFromDatabase($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("FELETE FROM pastaba WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        return (mysqli_affected_rows($dbc)>0);
    }
    
    public static function getViesosPastabos(){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pastaba WHERE viesa=1");
        $sql->execute();
        $result = $sql->get_result();
        $pastabos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $pastabos[]=new pastaba($data);
            }
        }
        return $pastabos;
    }
}