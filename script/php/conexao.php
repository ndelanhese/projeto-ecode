<?php

$hostname = "localhost";
$host = "projeto_ecode";
$user = "root";
$pass = "";

$con = mysqli_connect($hostname, $user, $pass, $host);


if(!$con ){
    die("A conexão falhou: " . mysqli_connect_error());
}


