<?php

include "darbuotoju_finansai.php";
include "vartotojo_rusis.php";
include "prisijungimo_duomenys.php";
include "pareigos.php";
include "grafikas.php";
include "pastaba.php";

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
    var $vartotojo_vardas;

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
        $this->finansai = ($data['fk_darbuotoju_finansai']);
        $this->rusis = ($data['fk_vartotojo_rusis']);
        $this->vartotojo_vardas = $data['fk_prisijungimo_duomenys'];
    }

    public static function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM darbuotojas WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new darbuotojas($data);
        }
        return NULL;
    }

    public static function addToDatabase($vardas, $pavarde, $tel_nr, $el_pastas, $adresas, $alga, $finansai, $rusis) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO darbuotojas (vardas, pavarde, tel_nr, el_pastas, adresas, dirba_nuo, alga, fk_darbuotoju_finansai, fk_vartotojo_rusis) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param('ssssssdii', $vardas, $pavarde, $tel_nr, $el_pastas, $adresas, date("Y-m-d"), $alga, $finansai, $rusis);
        $sql->execute();
        return (mysqli_insert_id($dbc));
    }

    public static function removeFromDatabase($id) {#reikalauti, kad vartotojas nebūtų grupės administratorius
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $dbc->query("START TRANSACTION");
        $sql1 = $dbc->prepare("DELETE FROM grafikas WHERE fk_darbuotojas = ?");
        $sql1->bind_param('i', $id);
        $sql1->execute();
        $sql2 = $dbc->prepare("DELETE FROM darbuotojas WHERE id = ?");
        $sql2->bind_param('i', $id);
        $sql2->execute();
        if (mysqli_affected_rows($dbc) > 0) {
            $dbc->query("COMMIT");
            return 1;
        } else {
            $dbc->query("ROLLBACK");
            return 0;
        }
    }

    public static function getKontaktai($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT tel_nr, el_pastas, adresas FROM darbuotojas WHERE id=?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $rez = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            return mysqli_fetch_assoc($rez);
        }
        return NULL;
    }

    public function updateKontaktai($tel_nr, $el_pastas, $adresas) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE darbuotojas SET tel_nr = ?, el_pastas =?, adresas =? WHERE id=?");
        $sql->bind_param('sssi', $tel_nr, $el_pastas, $adresas, $this->id);
        $this->tel_nr = $tel_nr;
        $this->el_pastas = $el_pastas;
        $this->adresas = $adresas;
        $sql->execute();
    }

    public static function getPasamdyti() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM darbuotojas WHERE atleistas=0");
        $sql->execute();
        $result = $sql->get_result();
        $darbuotojai = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $darbuotojai[] = new darbuotojas($data);
            }
        }
        return $darbuotojai;
    }

    public static function getAtleisti() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM darbuotojas WHERE atleistas=1");
        $sql->execute();
        $result = $sql->get_result();
        $darbuotojai = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $darbuotojai[] = new darbuotojas($data);
            }
        }
        return $darbuotojai;
    }

    public function atleisti() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql1 = $dbc->prepare("DELETE FROM turipareigas WHERE fk_darbuotojas = ?");
        $sql1->bind_param('i', $this->id);
        $sql1->execute();
        $sql2 = $dbc->prepare("UPDATE darbuotojas SET atleistas = 1 WHERE id=?");
        $sql2->bind_param('i', $this->id);
        $sql2->execute();
        $this->atleistas = 1;
        return (mysqli_affected_rows($dbc) > 0);
    }

    public function atsamdyti() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE darbuotojas SET atleistas = 0 WHERE id=?");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $this->atleistas = 0;
        return (mysqli_affected_rows($dbc) > 0);
    }

    public function getPareigos() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pareigos WHERE id IN (SELECT fk_pareigos FROM turipareigas WHERE fk_darbuotojas = ?)");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $result = $sql->get_result();
        $newPareigos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $newPareigos[] = new pareigos($data);
            }
        }
        return $newPareigos;
    }
    
    public function getNeturimosPareigos() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pareigos WHERE id NOT IN (SELECT fk_pareigos FROM turipareigas WHERE fk_darbuotojas = ?)");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $result = $sql->get_result();
        $newPareigos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $newPareigos[] = new pareigos($data);
            }
        }
        return $newPareigos;
    }

    public function addPareigos($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO turipareigas (`fk_darbuotojas`,`fk_pareigos`) VALUES(?, ?)");
        $sql->bind_param('ii', $this->id, $id);
        $sql->execute();
        $result = $sql->get_result();
        if ($dbc->affected_rows > 0) {
            $this->pareigos[] = pareigos::getFromDatabase($id);
        }
        return $result;
    }

    public function removePareigos($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("DELETE FROM turipareigas WHERE fk_darbuotojas =? && fk_pareigos = ?");
        $sql->bind_param('ii', $this->id, $id);
        $sql->execute();
        $result = $sql->get_result();
        if ($dbc->affected_rows > 0) {
            $length = count($this->pareigos);
            for ($i = 0; $i < $length; $i++) {
                if ($this->pareigos[$i]->id == $id) {
                    unset($this->pareigos[$i]);
                    break;
                }
            }
        }
        return $result;
    }

    public function getFinansai() {
        return darbuotoju_finansai::getFromDatabase($this->finansai);
    }

    public function setFinansai($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE darbuotojas SET fk_darbuotoju_finansai=? WHERE id=?");
        $sql->bind_param('ii', $id, $this->id);
        $sql->execute();
        $this->finansai = $id;
        return (mysqli_affected_rows($dbc) > 0);
    }
    
    public function setVartotojoVardas($vardas) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE darbuotojas SET fk_vartotojo_vardas=? WHERE id=?");
        $sql->bind_param('si', $vardas, $this->id);
        $sql->execute();
        $this->vartotojo_vardas = $vardas;
        return (mysqli_affected_rows($dbc) > 0);
    }

    public function getRusis() {
        return vartotojo_rusis::getFromDatabase($this->rusis);
    }

    public function setRusis($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE darbuotojas SET fk_vartotojo_rusis=? WHERE id=?");
        $sql->bind_param('ii', $id, $this->id);
        $sql->execute();
        $this->rusis = $id;
        return (mysqli_affected_rows($dbc) > 0);
    }

    public function getGrafikas() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM grafikas WHERE fk_darbuotojas=?");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $rez = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = mysqli_fetch_assoc($rez);
            return new grafikas($data);
        }
        return NULL;
    }

    public function getGautosPastabosViesos() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pastaba WHERE viesa=1 && fk_gavejas = ?");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $result = $sql->get_result();
        $pastabos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $pastabos[] = new pastaba($data);
            }
        }
        return $pastabos;
    }

    public function getGautosPastabosVisos() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pastaba WHERE fk_gavejas = ?");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $result = $sql->get_result();
        $pastabos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $pastabos[] = new pastaba($data);
            }
        }
        return $pastabos;
    }

    public function getRasytosPastabosViesos() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pastaba WHERE viesa=1 && fk_rasytojas = ?");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $result = $sql->get_result();
        $pastabos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $pastabos[] = new pastaba($data);
            }
        }
        return $pastabos;
    }

    public function getRasytosPastabosVisos() {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM pastaba WHERE fk_rasytojas = ?");
        $sql->bind_param('i', $this->id);
        $sql->execute();
        $result = $sql->get_result();
        $pastabos = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $pastabos[] = new pastaba($data);
            }
        }
        return $pastabos;
    }

    public function getPagalVartotojoVarda($vartotojo_vardas){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM darbuotojas WHERE fk_prisijungimo_duomenys = ?");
        $sql->bind_param('s', $vartotojo_vardas);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new darbuotojas($data);
        }
        return NULL;
    }
    
    public function paskirtiVartotojoVarda($vartotojo_vardas){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE darbuotojas SET fk_prisijungimo_duomenys=? WHERE id=?");
        $sql->bind_param('si', $vartotojo_vardas, $this->id);
        $sql->execute();
        $this->vartotojo_vardas = $vartotojo_vardas;
        return (mysqli_affected_rows($dbc) > 0);
    }
}
