<?php 
    $env = parse_ini_file(__DIR__ . '/../.env');

    $db = mysqli_connect($env["DB_HOST"],$env["DB_USER"],$env["DB_PASS"],$env["DB_NAME"]);

    if(!$db){
        die("Connection failed " . mysqli_connection_error());
    }
?>