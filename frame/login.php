<?php
session_start();
include("../script/php/conexao.php");

if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('location: ../index.php');
    exit();
}

$email = mysqli_real_escape_string($con, $_POST['email']);
$senha = mysqli_real_escape_string($con, $_POST['senha']);

$query = "SELECT  `id`,nome, `email`, `adm` FROM `pessoa` WHERE email = '{$email}' and senha = md5('{$senha}')";

$result = mysqli_query($con, $query);

$row = mysqli_num_rows($result);
$tab = mysqli_fetch_array($result);
$partes = explode(' ', $tab[1]);
$primeiroNome = array_shift($partes);
$ultimoNome = array_pop($partes);
if ($row == 1) {
    $_SESSION['nome'] = $primeiroNome." ". $ultimoNome;
    $_SESSION['id'] = $tab[0];
    $_SESSION['adm'] = $tab[3];
    header('location: main.php');
    exit();
} else {
    header('location: ../index.php');
    exit();
}
