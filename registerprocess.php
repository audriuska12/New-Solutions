<?php
include "darbuotojas.php";
darbuotojas::addToDatabase($_POST['vardas'], $_POST['pavarde'], $_POST['tel_nr'], $_POST['el_pastas'], $_POST['adresas'], $_POST['alga'], $_POST['finansai'], $_POST['rusis']);
header("Location:darbuotoju_sarasas.php");

