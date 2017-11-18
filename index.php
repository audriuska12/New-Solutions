<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $dbc=mysqli_connect('localhost','root','','newSolutions');
        $sql="SELECT * from grupe";
        $row=mysqli_fetch_assoc(mysqli_query($dbc, $sql));
        echo $sql;
        var_dump($row);
        ?>
    </body>
</html>
