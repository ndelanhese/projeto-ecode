<?php
session_start();
include("../script/php/conexao.php");

mysqli_set_charset($con, 'utf8');
$sql = "SELECT * FROM estado ORDER BY nome";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
for ($i = 0; $i < $num; $i++) {
  $dados = mysqli_fetch_array($res);
  $arrEstados[$dados['id']] = $dados['sigla'] . " - " . $dados['nome'];
}

if (isset($_POST['cadastrar'])) {
  $email = $_POST['email'];

  $query = "SELECT  `id`,nome, `email` FROM `pessoa` WHERE email = '{$email}'";

  $result = mysqli_query($con, $query);
  $row = mysqli_num_rows($result);
  if ($row == 1) {
    echo '<script>alert("Não foi possível cadastrar, o email já está em uso!")
    window.location.href = "../index.php";
    </script>';
  } else {
    $senha = $_POST['senha'];
    $senha = strval($senha);
    $senha = md5($senha);
    $nomeC = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cpf = strval($cpf);
    $rg = $_POST['rg'];
    $rg = strval($rg);
    $nascimento = $_POST['nascimento'];
    $nascimento = strval($nascimento);
    $sexo = $_POST['sexo'];
    $sexo = intval($sexo);
    $celular = $_POST['celular'];
    $celular = strval($celular);
    $telefone = $_POST['telefone'];
    $telefone = strval($telefone);
    $endereco = $_POST['endereco'];
    $endereco = strval($endereco);
    $numero = $_POST['numero'];
    $numero = strval($numero);
    $bairro = $_POST['bairro'];
    $bairro = strval($bairro);
    $complemento = $_POST['complemento'];
    $complemento = strval($complemento);
    $cep = $_POST['cep'];
    $cep = strval($cep);
    $cidadeC = $_POST['cidades'];
    $cidadeC = intval($cidadeC);
    $hoje = date('d/m/Y');
    $data1 = implode("-", array_reverse(explode("/", $hoje)));
    $sql = "INSERT INTO `pessoa`
    ( `email`, `senha`, `nome`, `cpf`, `rg`, `dataNascimento`, `sexo`, `celular`, `telefone`, `endereco`, `numero`, `bairro`, `complemento`, `cep`, `cidade_id`, `data_cadastro`, `status`)
     VALUES 
     ('{$email}', '{$senha}', '{$nomeC}', '{$cpf}', '{$rg}', '{$nascimento}', '{$sexo}', '{$celular}', '{$telefone}', '{$endereco}', '{$numero}', '{$bairro}', '{$complemento}', '{$cep}', '{$cidadeC}' , '{$data1}' , 1)";

    

    $query = mysqli_query($con, $sql);
   

    if ($query == true ) {
      header('location: listarPessoas.php');
    } else {
      echo '<script>alert("Não foi possível cadastrar")</script>';
    }
  }
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
  <div class="container-fluid">
    <div class="p-4 mt-1 p-md-5 mb-4 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h2 class="display-10 fst-italic">Criar Uma Nova Conta</h2>
      </div>
    </div>
    <form method="post" class="row g-3" id="app3">
      <div class="col-md-6">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" value="" class="form-control" id="email" placeholder="Ex: email@email.com" required>
      </div>
      <div class="col-md-6">
        <label for="senha" class="form-label">Senha:</label>
        <input type="password" class="form-control" name="senha" id="senha" placeholder="Ex: Senha" require_once required>
      </div>

      <div class="col-md-6">
        <label for="nome" class="form-label">Nome Completo:</label>
        <input type="text" id="nome" name="nome" class="form-control" name="nome" placeholder="Ex: Pedro José" aria-label="First name" required>

      </div>
      <div class="col-md-3">
        <label for="cpf" class="form-label ">CPF:</label>
        <input type="text" class="form-control" maxlength="11" oninput="criaMascara('CPF')" name="cpf" id="CPFInput" placeholder="Ex: 123.456.789-10" required>
      </div>
      <div class="col-md-3">
        <label for="rg" class="form-label">RG:</label>
        <input type="text" class="form-control" id="rg" placeholder="Ex: 12.345.678-9" maxlength="12" name="rg" required>
      </div>

      <div class="col-md-3">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input type="date" class="form-control" id="nascimento" name="nascimento" placeholder="" required>
      </div>
      <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo:</label>
        <select id="sexo" class="form-select" name="sexo">
          <option value="1" selected>Masculino</option>
          <option value="2">Feminino</option>
        </select>
      </div>

      <div class="col-md-3">
        <label for="celular" class="form-label">Celular:</label>
        <input type="text" class="form-control" id="CelularInput" maxlength="11" oninput="criaMascara('Celular')" name="celular" placeholder="Ex: (12) 9 1234-5678" required>
      </div>
      <div class="col-md-3">
        <label for="telefone" class="form-label">Telefone:</label>
        <input type="text" class="form-control" id="TelefoneInput" maxlength="10" oninput="criaMascara('Telefone')" name="telefone" placeholder="Ex: (12) 1234-5678">
      </div>

      <div class="col-md-6">
        <label for="endereco" class="form-label">Endereço:</label>
        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Ex: Rua tal" required>
      </div>
      <div class="col-md-3">
        <label for="numero" class="form-label">Número:</label>
        <input type="text" class="form-control" id="numero" name="numero" placeholder="Ex: 123A" required>
      </div>
      <div class="col-md-3">
        <label for="bairro" class="form-label">Bairro:</label>
        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Ex: Centro" required>
      </div>


      <div class="col-md-3">
        <label for="complemento" class="form-label">Complemento:</label>
        <input type="text" class="form-control" id="complemento" name="completo" placeholder="Ex: Casa Marrom">
      </div>
      <div class="col-md-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" class="form-control" id="CEPInput" maxlength="8" oninput="criaMascara('CEP')" name="cep" placeholder="Ex: 81560-000" required>
      </div>

      <div class="col-md-3">
        <label for="estadp" class="form-label">Estado:</label>

        <select id="estado" name="estado" class="form-select">
          <option value="1" selected>Selecione um estado</option>
          <?php foreach ($arrEstados as $value => $name) { ?>
            <option value="<?php
                            echo $value;
                            ?>">
            <?php
            echo $name;
          }
            ?>
            </option>

        </select>
      </div>

      <div class="col-md-3">
        <label for="cidades" class="form-label">Cidade:</label>
        <select id="cidades" style="display:none" name="cidades" class="form-select">

        </select>

      </div>


      <div class="col-12 mb-3">

        <button type="submit" class="btn btn-secondary" name="cadastrar" id="cadastrar">Cadastrar</button></a>
        <a href="logout.php">
        <button type="button" class="btn btn-secondary" name="cancelar">Cancelar</button></a>
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