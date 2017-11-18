<?php

include "darbuotoju_finansai.php";
include "vartotojo_rusis.php";
include "prisijungimo_duomenys.php";
include "pareigos.php";

class darbuotojas {

    var $id;
    var $vardas;
    var $pavarde;
    var $tel_nr;
    var $el_pastas;
    var $adresas;
    var $dirba_nuo;
    var $atleistas;
    var $alga;
    var $finansai;
    var $rusis;
    var $prisijungimo_duomenys;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->vardas = $data['vardas'];
        $this->pavarde = $data['pavarde'];
        $this->tel_nr = $data['tel_nr'];
        $this->el_pastas = $data['el_pastas'];
        $this->adresas = $data['adresas'];
        $this->dirba_nuo = $data['dirba_nuo'];
        $this->atleistas = $data['atleistas'];
        $this->alga = $data['alga'];
        $this->finansai = darbuotoju_finansai::getFromDatabase($data['fk_darbuotoju_finansai']);
        $this->rusis = vartotojo_rusis::getFromDatabase($data['fk_vartotojo_rusis']);
        $this->prisijungimo_duomenys = prisijungimo_duomenys::getFromDatabase($data['fk_prisijungimo_duomenys']);
    }

    public function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * from darbuotojas WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new darbuotojas($data);
        }
        return NULL;
    }

    public static function getPareigos($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pareigos WHERE id IN (SELECT fk_pareigos FROM turipareigas WHERE fk_darbuotojas = ?)");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        $newPareigos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $newPareigos[]=new pareigos($data);
            }
        }
        return $newPareigos;
    }

    public function addPareigos($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO turipareigas (`fk_darbuotojas`,`fk_pareigos`) VALUES(?, ?)");
        $sql->bind_param('ii',$this->id, $id);
        $sql->execute();
        $result = $sql->get_result();
        if($dbc->affected_rows > 0){
            $this->pareigos[]= pareigos::getFromDatabase($id);
        }
        return $result;    
    }
    
    public function removePareigos($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("DELETE FROM turipareigas WHERE fk_darbuotojas =? && fk_pareigos = ?");
        $sql->bind_param('ii',$this->id, $id);
        $sql->execute();
        $result = $sql->get_result();
        if($dbc->affected_rows > 0){
            $length = count($this->pareigos);
            for($i = 0; $i<$length; $i++){
                if($this->pareigos[$i]->id==$id){
                    unset($this->pareigos[$i]);
                    break;
                }
            }
        }
        return $result;    
    }
}
