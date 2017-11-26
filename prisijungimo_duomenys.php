<?php

class prisijungimo_duomenys {

    var $vartotojo_vardas;
    var $slaptazodis;
    var $atpazinimo_klausimas;
    var $atpazinimo_atsakymas;

    public function __construct($data) {
        $this->vartotojo_vardas = $data['vartotojo_vardas'];
        $this->slaptazodis = $data['slaptazodis'];
        $this->$atpazinimo_klausimas = $data['$atpazinimo_klausimas'];
        $this->$atpazinimo_atsakymas = $data['$atpazinimo_atsakymas'];
    }

    public static function getFromDatabase($vartotojo_vardas) {
        $data = '';
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT vartotojo_vardas, slaptazodis, atpazinimo_klausimas, atpazinimo_atsakymas
				FROM prisijungimo_duomenys
					WHERE `vartotojo_vardas`='{$vartotojo_vardas}'");
        $sql->bind_param('i', $vartotojo_vardas);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new darbuotojas($data);
        }
        return NULL;
       // return new prisijungimo_duomenys($data);
    }

}
