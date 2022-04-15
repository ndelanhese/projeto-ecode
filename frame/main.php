<?php
session_start();
include("../script/php/conexao.php");
include("../frame/verifica_fraude.php");
$nivel = $_SESSION['adm'];
$dis = "";
if ($nivel == 1) {
    $nivel = " Administrador";
} else {
    $nivel = "";
    $dis = "disabled";
}




?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script defer src="../script/vue/app4.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/visual.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Olá<?php echo $nivel . ', ' .  $_SESSION['nome'] ?>!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="main.php">Início</a>

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle <?php echo $dis ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastrar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <form action="pessoa.php" method="post">
                                <li><a class="dropdown-item" href="pessoa.php">Pessoa</a></li>
                            </form>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Listar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="listarPessoas.php">Pessoa</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="listarUsuario.php">Usuário</a></li>
                        </ul>
                    </li>
                </ul>
                <form action="logout.php" method="POST" class="d-flex">

                    <button class="btn btn-secondary" type="submit" style="float: right;">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-2">
    <div class="card bg-dark text-white" style="width: 1149px; height: 270px;">
  <img class="card-img" src="../img/imagem.png" style="height: 270px; object-fit: cover;" alt="Imagem do card">
  <div class="card-img-overlay" >
    <h5 class="card-title" >Sistema de Cadastro</h5>
    <p class="card-text" >Este é um sistema para demonstração de conhecimento do desenvolvedor!</p>
    <p class="card-text">É a junção das seguintes ferramentas:</p>
    <p class="card-text">- HTML 5 & CSS 3</p>
    <p class="card-text">- JavaScript & PHP</p>
    <p class="card-text">- E muitas horas programadas</p>
  </div>
</div>
    </div>


</body>

</html>