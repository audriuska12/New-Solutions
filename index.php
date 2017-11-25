<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <form action="index.php" method="POST">
    <div class="form-group">
      <label for="username">Vartotojo vardas:</label>
      <input type="username" class="form-control" id="email" placeholder="Prisijungimo vardas" name="username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="slaptažodis" name="userPass">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
<?php
	// connect to datebase
	/*$user = 'root';
	$pass = '';
	$db = 'newsolutions';
	$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");*/
	$dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
	
	$userName = $_POST["username"];
	$userPass = $_POST["userPass"];
	$isValidated = false;
	$sql = $dbc->prepare("SELECT vartotojo_vardas, COUNT(*) as total, atpazinimo_klausimas, atpazinimo_atsakymas
				FROM prisijungimo_duomenys
					WHERE `vartotojo_vardas`='{$userName}' && `slaptazodis`='{$userPass}' ");
	$sql->execute();
	$result = $sql->get_result();
	$dbAts = null;
	if($userName != "" && $userPass != "")
		while($row = $result->fetch_assoc()) {
		  if($row["total"] !== 0){
			  $isValidated = true;
			  echo "Prisijungimas sėkmingas";
		  }else {
			 echo "Neteisingai įvedete duomenis";
		  }

		}
	if(!$isValidated){
		die();
	}
	session_start();
	$_SESSION["sessionUname"] = $userName;
?>

</body>
</html>
