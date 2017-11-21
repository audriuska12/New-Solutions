<?php


class darbuotoju_finansai {
    //put your code here
    var $id;
    public function __construct($data) {
        $this->id = $data['id'];
    }
    
    public static function getFromDatabase($id){
        $data = "";
        return new darbuotoju_finansai($data);
    }
    
    public static function getDarbuotojuFinansai(){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("SELECT * FROM darbuotoju_finansai");
        $sql->execute();
        $result = $sql->get_result();
        $finansai = [];
        if ($dbc->affected_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $finansai[] = new darbuotoju_finansai($data);
            }
        }
        return $finansai;
    }
}
