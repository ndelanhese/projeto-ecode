<?php
session_start();
include("../script/php/conexao.php");

mysqli_set_charset($con, 'utf8');
$sql = "SELECT * FROM estado ORDER BY nome";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
$idE = "";
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
      $cpf = $user_data['cpf'];
      $rg = $user_data['rg'];
      $nascimento = $user_data['dataNascimento'];
      $sexo = $user_data['sexo'];
      $celular = $user_data['celular'];
      $telefone = $user_data['telefone'];
      $endereco = $user_data['endereco'];
      $numero = $user_data['numero'];
      $bairro = $user_data['bairro'];
      $complemento = $user_data['complemento'];
      $cep = $user_data['cep'];
      $situacao = $user_data['status'];
      $idCidade = $user_data["cidade_id"];
      $sqlC = "select * from cidade where id = '{$idCidade}'";
      $query1 = mysqli_query($con, $sqlC);
      $nomeCidade = "";
      $idEstado = "";
      while ($_POST_cidade = mysqli_fetch_assoc($query1)) {
        $nomeCidade = $_POST_cidade['nome'];
        $idEstado = $_POST_cidade['id_estado'];
      }

      $sqlE = "select * from estado where id = {$idEstado}";
      $query2 = mysqli_query($con, $sqlE);

      $nomeEstado = "";
      $siglaEstado = "";
      while ($_POST_estado = mysqli_fetch_assoc($query2)) {
        $nomeEstado = $_POST_estado['nome'];
        $siglaEstado = $_POST_estado['sigla'];
      }
      $nomeEstado = $siglaEstado . " - " . $nomeEstado;
    }
  }
}

if (isset($_POST['atualizar'])) {
  $emailU = $_POST['email'];
  $senhaU = $_POST['senha'];
  $senhaU = strval($senhaU);
  $senhaU = md5($senhaU);
  $nomeCU = $_POST['nome'];
  $cpfU = $_POST['cpf'];
  $cpfU = strval($cpfU);
  $rgU = $_POST['rg'];
  $rgU = strval($rgU);
  $nascimentoU = $_POST['nascimento'];
  $nascimentoU = strval($nascimentoU);
  $sexoU = $_POST['sexo'];
  $sexoU = intval($sexoU);
  $celularU = $_POST['celular'];
  $celularU = strval($celularU);
  $telefoneU = $_POST['telefone'];
  $telefoneU = strval($telefoneU);
  $enderecoU = $_POST['endereco'];
  $enderecoU = strval($enderecoU);
  $numeroU = $_POST['numero'];
  $numeroU = strval($numeroU);
  $bairroU = $_POST['bairro'];
  $bairroU = strval($bairroU);
  $complementoU = $_POST['complemento'];
  $complementoU = strval($complementoU);
  $cepU = $_POST['cep'];
  $cepU = strval($cepU);
  $cidadeCU = $_POST['cidades'];
  $cidadeCU = intval($cidadeCU);
  $situacaoU = $_POST['situacao'];
  $situacaoU = intval($situacaoU);
  if ($situacao == "1") {
    $situacao = 1;
  } else {
    $situacao = 2;
  }

  $sqlU = "UPDATE `pessoa` SET `email`='{$emailU}',`senha`='{$senhaU}',`nome`='{$nomeCU}',`cpf`='{$cpfU}',`rg`='{$rgU}',`dataNascimento`='{$nascimentoU}',`sexo`='{$sexoU}',`celular`='{$celularU}',`telefone`='{$telefoneU}',`endereco`='{$enderecoU}',`numero`='{$numeroU}',`bairro`='{$bairroU}',`complemento`='{$complementoU}',`cep`='{$cepU}',`cidade_id`='{$cidadeCU}',`status`='{$situacaoU}' WHERE id = $id";

  $queryU = mysqli_query($con, $sqlU);


  if ($queryU) {
    $var5 = '<script>
    alert("Dados atualizados com sucesso!");
        window.location.href = "listarPessoas.php";
         </script>';
    echo $var5;
  } else {
    $var5 = '<script>
    var a = alert("Erro ao atualizar!");
        </script>';
    echo $var5;
  }
}

$sql = "SELECT * FROM cidade where id_estado = $idEstado  ORDER BY nome";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
for ($i = 0; $i < $num; $i++) {
  $dados = mysqli_fetch_array($res);
  $arrCidades[$dados['id']] = $dados['nome'];
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

  <script src="../script/php/jquery.js" type="text/javascript"></script>
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
                    <a href="listarPessoas.php">
                    <button class="btn btn-secondary" type="button">Voltar</button></a>
                    <a href="logout.php">
                    <button class="btn btn-secondary" type="button">Sair</button></a>
                </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="p-4 mt-1 p-md-5 mb-4 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h2 class="display-10 fst-italic">Editar - Pessoa</h2>
      </div>
    </div>
    <form method="POST" class="row g-3" id="app3">
      <div class="col-md-6">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" id="email" value="<?php echo $email ?>" placeholder="Ex: email@email.com" required>
      </div>
      <div class="col-md-6">
        <label for="senha" class="form-label">Senha:</label>
        <input type="password" class="form-control" name="senha" id="senha" value="" placeholder="Ex: Senha" require_once required>
      </div>

      <div class="col-md-6">
        <label for="nome" class="form-label">Nome Completo:</label>
        <input type="text" id="nome" name="nome" class="form-control" name="nome" value="<?php echo $nomeC ?>" placeholder="Ex: Pedro José" aria-label="First name" required>

      </div>
      <div class="col-md-3">
        <label for="cpf" class="form-label">CPF:</label>
        <input type="text" class="form-control" maxlength="11" oninput="criaMascara('CPF')" name="cpf" id="CPFInput" placeholder="Ex: 123.456.789-10" value="<?php echo $cpf ?>" name="cpf" required>
      </div>
      <div class="col-md-3">
        <label for="rg" class="form-label">RG:</label>
        <input type="text" class="form-control" id="rg" placeholder="Ex: 12.345.678-9" name="rg" maxlength="12" value="<?php echo $rg ?>" required>
      </div>

      <div class="col-md-3">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input type="date" class="form-control" id="nascimento" name="nascimento" placeholder="" value="<?php echo $nascimento ?>" required>
      </div>
      <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo:</label>
        <select id="sexo" class="form-select" name="sexo">
          <option value="1" <?php echo ($sexo == '1') ? 'selected' : '' ?>>Masculino</option>
          <option value="2" <?php echo ($sexo == '2') ? 'selected' : '' ?>>Feminino</option>
        </select>
      </div>

      <div class="col-md-3">
        <label for="celular" class="form-label">Celular:</label>
        <input type="text" class="form-control" id="CelularInput" maxlength="11" oninput="criaMascara('Celular')" name="celular" value="<?php echo $celular ?>" placeholder="Ex: (12) 9 1234-5678" required>
      </div>
      <div class="col-md-3">
        <label for="telefone" class="form-label">Telefone:</label>
        <input type="text" class="form-control" id="TelefoneInput" maxlength="10" oninput="criaMascara('Telefone')" name="telefone" value="<?php echo $telefone ?>" placeholder="Ex: (12) 1234-5678">
      </div>

      <div class="col-md-6">
        <label for="endereco" class="form-label">Endereço:</label>
        <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $endereco ?>" placeholder="Ex: Rua tal" required>
      </div>
      <div class="col-md-3">
        <label for="numero" class="form-label">Número:</label>
        <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $numero ?>" placeholder="Ex: 123A" required>
      </div>
      <div class="col-md-3">
        <label for="bairro" class="form-label">Bairro:</label>
        <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $bairro ?>" placeholder="Ex: Centro" required>
      </div>


      <div class="col-md-3">
        <label for="complemento" class="form-label">Complemento:</label>
        <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo $complemento ?>" placeholder="Ex: Casa Marrom">
      </div>
      <div class="col-md-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" class="form-control" id="CEPInput" maxlength="8" oninput="criaMascara('CEP')" name="cep" value="<?php echo $cep ?>" placeholder="Ex: 81560-000" required>
      </div>

      <div class="col-md-3">
        <label for="estadp" class="form-label">Estado:</label>

        <select id="estado" name="estado" class="form-select">
          <option value="1" selected>Selecione um estado</option>
          <?php foreach ($arrEstados as $value => $name) { ?>
            <option value="<?php
                            echo $value;
                            ?>" <?php echo ($nomeEstado == $name) ? 'selected' : '' ?>>
            <?php
            echo $name;
          }

            ?>

            </option>

        </select>
      </div>

      <div class="col-md-3">
        <label for="cidades" class="form-label">Cidade:</label>
        <select id="cidades" name="cidades" class="form-select">
          <?php foreach ($arrCidades as $value4 => $name4) { ?>
            <option value="<?php
                            echo $value4;
                            ?>" <?php echo ($nomeCidade == $name4) ? 'selected' : '' ?>>
            <?php

            echo $name4;
          }
            ?>

            </option>
        </select>

      </div>

      <div class="col-md-2">
        <label for="situacao" class="form-label">Situação:</label>
        <div class="col-auto">
          <label class="visually-hidden" for="situacao">Preference</label>
          <select class="form-select" id="situacao" name="situacao">

            <option value="1" <?php echo ($situacao == '1') ? 'selected' : '' ?>>Ativo</option>
            <option value="2" <?php echo ($situacao == '2') ? 'selected' : '' ?>>Inativo</option>

          </select>
        </div>

      </div>
      <div class="col-12 mb-3 ml-3">

        <button type="submit" class="btn btn-secondary" name="atualizar">Atualizar</button>
        <a href="listarPessoas.php">
        <button type="button" class="btn btn-secondary" name="cancelar">Cancelar</button></a>
      </div>

    </form>
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

  function criaMascara(mascaraInput) {
    const maximoInput = document.getElementById(`${mascaraInput}Input`).maxLength;
    let valorInput = document.getElementById(`${mascaraInput}Input`).value;
    let valorSemPonto = document.getElementById(`${mascaraInput}Input`).value.replace(/([^0-9])+/g, "");
    const mascaras = {
      CPF: valorInput.replace(/[^\d]/g, "").replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4"),
      Celular: valorInput.replace(/[^\d]/g, "").replace(/^(\d{2})(\d{1})(\d{4})(\d{4})/, "($1) $2 $3-$4"),
      Telefone: valorInput.replace(/[^\d]/g, "").replace(/^(\d{2})(\d{4})(\d{4})/, "($1) $2-$3"),
      CEP: valorInput.replace(/[^\d]/g, "").replace(/(\d{5})(\d{3})/, "$1-$2"),
      CNJ: valorInput.replace(/[^\d]/g, "").replace(/(\d{7})(\d{2})(\d{4})(\d{1})(\d{2})(\d{4})/, "$1-$2.$3.$4.$5.$6"),
    };

    valorInput.length === maximoInput ? document.getElementById(`${mascaraInput}Input`).value = mascaras[mascaraInput] :
      document.getElementById(`${mascaraInput}Input`).value = valorSemPonto;
  };
</script>