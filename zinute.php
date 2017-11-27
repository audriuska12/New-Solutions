<?php

class zinute {
    
    var $id = "id";
    var $tekstas = "Tekstas";
    var $siuntimo_data = "data";
    var $gavimo_data = "data";
    var $vardas = "vardas";
    var $pavarde = "pavarde";
    
    public function __construct($data) {
        if(isset($data['id']))
            $this->id = $data['id'];
        if(isset($data['tekstas']))
            $this->tekstas = $data['tekstas'];
        if(isset($data['gavimo_data']))
            $this->gavimo_data = $data['gavimo_data'];
        if(isset($data['gavimo_data']))
            $this->gavimo_data = $data['gavimo_data'];
        if(isset($data['vardas']))
            $this->vardas = $data['vardas'];
        if(isset($data['pavarde']))
            $this->pavarde = $data['pavarde'];
    }


    public static function issiustiZinute($id, $recipients, $text) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $date1 = "2002-02-02";
        $sql = $dbc->prepare("INSERT INTO zinute (tekstas, siuntimo_data, gavimo_data, fk_siuntejas)
                                                    VALUES ($text, $date1, $date1, $id)");
        // $sql->bind_param('s', $vartotojo_vardas);
        //var_dump($sql);
        $sql->execute();
        /*  $result = $sql->get_result();
          if (mysqli_affected_rows($dbc) > 0) {
          $data = $result->fetch_assoc();
          return new darbuotojas($data);
          }
          return NULL;
          } */
    }

    public static function gautiGautasZinutes($id) {
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT zinute.* , darbuotojas.vardas, darbuotojas.pavarde
                                FROM zinute
                                    LEFT JOIN darbuotojas ON zinute.fk_siuntejas = darbuotojas.id ");
      //  $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        $messages = [];
        while ($row = $result->fetch_assoc()) {
              array_push($messages, new zinute ($row));
        }
        //var_dump($messages);
        return $messages;
    }
    public static function gautiIssiustasZinutes($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT zinute.* , darbuotojas.vardas, darbuotojas.pavarde
                                FROM zinute
                                    LEFT JOIN darbuotojas ON zinute.fk_siuntejas = darbuotojas.id 
                                    AND `fk_siuntejas`='{$id}'");
      //  $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        $messages = [];
        while ($row = $result->fetch_assoc()) {
              if($row['vardas'] !== null)
                array_push($messages, new zinute ($row));
        }
        return $messages;
    }
    public static function getFromDatabase($id){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT id, tekstas
                                FROM zinute
                                    WHERE `id`='{$id}'");
      //  $sql->bind_param('i', $id);
        $sql->execute();
        $result = $sql->get_result();
        $messages = [];
        $row = $result->fetch_assoc();
        return new zinute($data);
    }

}
?>