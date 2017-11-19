<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grafikas
 *
 * @author audri
 */
class grafikas {
    var $id;
    var $laikas_pirmad;
    var $laikas_antrad;
    var $laikas_treciad;
    var $laikas_ketvirtad;
    var $laikas_penktad;
    var $laikas_sestad;
    var $laikas_sekmad;
    var $keitimo_data;
    var $darbuotojas;
    
    public function __construct($data){
        $this->id = $data['id'];
        $this->laikas_pirmad=$data['laikas_pirmad'];
        $this->laikas_antrad=$data['laikas_antrad'];
        $this->laikas_treciad=$data['laikas_treciad'];
        $this->laikas_ketvirtad=$data['laikas_ketvirtad'];
        $this->laikas_penktad=$data['laikas_penktad'];
        $this->laikas_sestad=$data['laikas_sestad'];
        $this->laikas_sekmad=$data['laikas_sekmad'];
        $this->keitimo_data=$data['keitimo_data'];
        $this->darbuotojas=$data['fk_darbuotojas'];
    }
    
    public static function getFromDatabase($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM grafikas WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $rez=$sql->get_result();
        if(mysqli_affected_rows($dbc) > 0){
            $data= mysqli_fetch_assoc($rez);
            return new grafikas($data);
        }
        return null;
    }
    
    public function update($laikas_pirmad, $laikas_antrad, $laikas_treciad, $laikas_ketvirtad, $laikas_penktad, $laikas_sestad, $laikas_sekmad){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE grafikas SET laikas_pirmad = ?, laikas_antrad = ?, laikas_treciad = ?, laikas_ketvirtad = ?, laikas_penktad = ?, laikas_sestad = ?, laikas_sekmad = ?, keitimo_data = ? WHERE id = ?");
        $date = date('Y-m-d H:i:s');
        $sql->bind_param('ssssssssi',$laikas_pirmad, $laikas_antrad, $laikas_treciad, $laikas_ketvirtad, $laikas_penktad, $laikas_sestad, $laikas_sekmad, $date, $this->id);
        $sql->execute();
        if(mysqli_affected_rows($dbc) > 0){
            $this->laikas_pirmad=$laikas_pirmad;
            $this->laikas_antrad=$laikas_antrad;
            $this->laikas_treciad=$laikas_treciad;
            $this->laikas_ketvirtad=$laikas_ketvirtad;
            $this->laikas_penktad=$laikas_penktad;
            $this->laikas_sestad=$laikas_sestad;
            $this->laikas_sekmad=$laikas_sekmad;
            $this->keitimo_data=$date;
            return 1;
        }
        return 0;
    }
}
