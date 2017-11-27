<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prisijungimas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <form action="administratorius.php" method="POST">
        <button type="submit" class="btn btn-default">Pamatyti darbuotoju skaiciu</button>
    </form>
<?php   //header("administratorius.php");
        
	$dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	$sql = $dbc->prepare("SELECT COUNT(*) as total
				FROM darbuotojas
					 ");
	$sql->execute();
	$result = $sql->get_result();
        $row = $result->fetch_assoc();
        echo "darbuotojų skaičius yra ";
        echo $row['total'];
        }
?>

</body>
</html>
