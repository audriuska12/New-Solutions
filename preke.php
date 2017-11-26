<?php


class preke {
    
   var $id;
   var $pavadinimas;
   var $kaina;
   var $kiekis;
   var $gavimo_data;
   var $galiojimo_data;
   var $pardavimo_data;
   var $garantija;
   var $duztanti;
//   var $fk_pridejimas_Id;
//   var $fk_prekiu_apskaita;
   var $fk_prekes_kategorija;
//   var $fk_uzsakymas;
   
    public function __construct($data) {
        $this->id = $data['id'];
        $this->pavadinimas = $data['pavadinimas'];
        $this->kaina = $data['kaina'];
        $this->kiekis = $data['kiekis'];
        $this->gavimo_data = $data['gavimo_data'];
        $this->galiojimo_data = $data['galiojimo_data'];
        $this->pardavimo_data = $data['pardavimo_data'];
        $this->garantija = $data['garantija'];
        $this->duztanti = $data['duztanti'];
//        $this->fk_pridejimas_Id = ($data['fk_pridejimas_Id']);
//        $this->fk_prekiu_apskaita = ($data['fk_prekiu_apskaita']);
//        $this->fk_prekes_kategorija = $data['fk_prekes_kategorija'];
//        $this->fk_uzsakymas = $data['fk_uzsakymas'];
    }
    
    public static function getFromDatabase($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM preke WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        if (mysqli_affected_rows($dbc) > 0) {
            $data = $result->fetch_assoc();
            return new preke($data);
        }
        return NULL;
    }
    
    public static function addToDatabase($id, $pavadinimas, $kaina, $kiekis, $gavimo_data, $galiojimo_data, $pardavimo_data, $garantija, $duztanti) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("INSERT INTO preke (id, pavadinimas, kaina, kiekis, gavimo_data, galiojimo_data, pardavimo_data, garantija, duztanti, fk_pridejimas_Id, fk_prekiu_apskaita, fk_prekes_kategorija, fk_uzsakymas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param('ssssssdii', $id, $pavadinimas, $kaina, $kiekis, $gavimo_data, date("Y-m-d"), $galiojimo_data, date("Y-m-d"), $pardavimo_data, date("Y-m-d"), $garantija, $duztanti);
        $sql->execute();
        return (mysqli_insert_id($dbc));
    }
    
    public static function changeQuantity($id, $kiekis){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE preke SET kiekis=? WHERE id=?");
        $sql->bind_param('ii', $kiekis, $this->id);
        $sql->execute();
        $this->kiekis = $kiekis;
        return (mysqli_affected_rows($dbc) > 0);
    }
    
    
    
}
?>
</body>
</html>


