<?php
include("conexao.php");

$pegaCidades = $con;
$sql = "SELECT * FROM cidade where id_estado ='" . $_POST['id'] . "' ORDER BY nome";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
for ($i = 0; $i < $num; $i++) {
    $dados = mysqli_fetch_array($res);
    $arrEstados[$dados['id']] = $dados['nome'];
}


foreach ($arrEstados as $value => $name) {
    echo "<option value=" . $value . ">" . $name. "</option>";
}
