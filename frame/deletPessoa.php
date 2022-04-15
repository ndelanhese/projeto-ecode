<?php
session_start();
include("../script/php/conexao.php");
$nome = $_SESSION['nome'];

if (!empty($_GET['id'])) {

    $id = $_GET['id'];

    $sqlS = "DELETE FROM `pessoa` WHERE id = $id";
    $query = mysqli_query($con, $sqlS);

    if ($query) {

        if ($_SESSION['id'] == $id) {
            header('location: logout.php');
        } else {

            $var = '<script>
      alert("Pessoa excluida com sucesso!");
      
        window.location.href = "listarPessoas.php";
       
        </script>';
            echo $var;
        }
    }
}
