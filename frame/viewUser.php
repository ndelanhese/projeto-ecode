<?php
session_start();
include("../script/php/conexao.php");
$nome = $_SESSION['nome'];
mysqli_set_charset($con, 'utf8');
$sql = "SELECT * FROM estado ORDER BY nome";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
for ($i = 0; $i < $num; $i++) {
    $dados = mysqli_fetch_array($res);
    $arrEstados[$dados['id']] = $dados['sigla'] . " - " . $dados['nome'];
}


if (!empty($_GET['id'])) {

    $id = $_GET['id'];



    $sqlS = "SELECT * FROM `pessoa` WHERE id = $id";
    $query = mysqli_query($con, $sqlS);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        while ($user_data = mysqli_fetch_assoc($query)) {
            $email = $user_data['email'];
            $senha = $user_data['senha'];
            $nomeC = $user_data['nome'];
            $adm = $user_data['adm'];
            $situacao = $user_data['status'];
        }
    }
}

if (isset($_POST['atualizar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha = md5($senha);
    $nomeC = $_POST['nome'];
    $adm = $_POST['adm'];
    $adm = intval($adm);
    $situacao = $_POST['situacao'];
    $situacao = intval($situacao);

    $sqlU = "UPDATE `pessoa` SET `nome`='{$nomeC}',`email`='{$email}',`senha`='{$senha}',`adm`='{$adm}',`status`='{$situacao}' WHERE id = '{$id}'";
    $queryU = mysqli_query($con, $sqlU);

    if ($queryU) {

        $var = '<script>
       var a = confirm("Dados atualizados com sucesso! \nDeseja ir para a página de login?");
       if(a){
        window.location.href = "logout.php";
       }else{
        window.location.href = "listarUsuario.php";
       }
        </script>';
        echo $var;
    }
}


?>





<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../script/php/jquery.js" type="text/javascript"></script>
    <script defer src="../script/vue/app4.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/visual.css" />

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Olá, <?php echo $_SESSION['nome'] ?>!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="main.php">Início</a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                <div class="d-grid gap-2 d-md-block">
                    <a href="listarUsuario.php">
                        <button class="btn btn-secondary" type="button">Voltar</button></a>
                    <a href="logout.php">
                        <button class="btn btn-secondary" type="button">Sair</button></a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container-fluid " id="app4">

        <div class="p-4 mt-1 p-md-5 mb-2 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h2 class="display-10 fst-italic">Visualizar - Usuário</h2>
            </div>
        </div>

        <div class="container">

            <form method="POST" class="row g-3" id="app3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" value="<?php echo $email ?>" class="form-control" id="email" placeholder="Ex: email@email.com" disabled>
                </div>
                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" class="form-control" name="senha" id="senha" value="" placeholder="Ex: Senha" require_once disabled>
                </div>

                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $nomeC ?>" placeholder="Ex: Pedro José" aria-label="First name" disabled>

                </div>
                <div class="col-md-3">
                    <label for="adm" class="form-label">Nível:</label>
                    <select id="adm" name="adm" class="form-select" disabled>
                        <option value="1" <?php echo ($adm == '1') ? 'selected' : ''  ?>>Administrador</option>
                        <option value="2" <?php echo ($adm == '2') ? 'selected' : ''  ?>>Comum</option>
                    </select>
                </div>



                <div class="col-md-3">
                    <label for="situacao" class="form-label">Situação:</label>
                    <div class="col-auto">
                        <label class="visually-hidden" for="situacao">Preference</label>
                        <select name="situacao" class="form-select" id="situacao" value="<?php echo $status ?>" disabled>

                            <option value=1 <?php echo ($situacao == '1') ? 'selected' : ''  ?>>Ativo</option>
                            <option value=2 <?php echo ($situacao == '2') ? 'selected' : ''  ?>>Inativo</option>

                        </select>
                    </div>

                </div>


                <div class="col-12 mb-3 mt-3">

                    
                    <a href="listarUsuario.php">
                        <button type="button" class="btn btn-secondary" name="cancelar">Voltar</button></a>

                </div>

            </form>
        </div>

    </div>

</body>

</html>

<script>
    $("#estado").on("change", function() {
        var idEstado = $("#estado").val();
        $.ajax({
            url: '../script/php/pegaCidades.php',
            type: 'POST',
            data: {
                id: idEstado
            },
            beforeSend: function() {
                $("#cidades").css({
                    'display': 'block'
                });
                $("#cidades").html("Carregando...");
            },
            success: function(data) {
                $("#cidades").css({
                    'display': 'block'
                });
                $("#cidades").html(data);
            },
            error: function(data) {
                $("#cidades").css({
                    'display': 'block'
                });
                $("#cidades").html("Erro ao carregar");
            }
        })
    });
</script>