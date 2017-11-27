<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
if (!isset($_SESSION['userID'])) {
    header("Location:accessDenied.php");
}
if (isset($_GET['id'])) {
    if (grupe::getFromDatabase($_GET['id'])->administratorius != $_SESSION['userID']) {
        header("Location:accessDenied.php");
    }
}
if (isset($_POST['administratorius'])) {

    $grupe = grupe::getFromDatabase($_POST['id']);
    if (!$grupe->administratorius == $_SESSION['userID']) {
        header("Location:accessDenied.php");
    } else {
        $grupe->changeAdministratorius($_POST['administratorius']);
        header("Location: grupesView.php");
    }
}
?>
<form action="grupeKeistiAdministratoriu.php?id=<?php echo $_GET['id']?>" method="post">
    <?php echo ("<input type=\"hidden\" name=\"id\" value=\"" . $_GET['id'] . "\"></input>"); ?>
    Pasirinkti naują administratorių:<select name="administratorius">
        <?php
        $grupe = grupe::getFromDatabase($_GET['id']);
        $nariai = $grupe->getDarbuotojaiBeAdministratoriaus();
        $count = count($nariai);
        for ($i = 0; $i < $count; $i++) {
            echo("<option value=\"" . $nariai[$i]->id . "\">" . $nariai[$i]->pavarde . " " . $nariai[$i]->vardas . "</option>");
        }
        ?>
    </select></br>
    <input type="submit" value="Patvirtinti"></input>
</form>


