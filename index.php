<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Sistema</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script defer src="script/php/conexao.php"></script>
    <script defer src="script/vue/app.js"></script>
    <link rel="stylesheet" type="text/css" href="css/visual.css" />
</head>

<body>

    <div class="container-fluid  d-flex justify-content-center mt-5" id="app">
        <form action="frame\login.php" method="POST" class="mt-3 form">
            <div class="mt-3 text-center">
                <img src="img/avatar.png" alt="avatar">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label mt-2">E-mail:</label>
                <input v-model="email" name="email" value="" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Ex: exemplo@email.com" autofocus="">
                <div id="emailHelp" class="form-text">{{att}}</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Senha:</label>
                <input v-model="senha" name="senha" :type="inputType" value="" class="form-control" id="exampleInputPassword1" aria-describedby="passHelp" placeholder="Ex: Senha">
                <div id="passHelp" class="form-text">{{att1}}</div>
            </div>
            <div class="mb-3 form-check">
                <input v-on:click="trocar" type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Exibir Senha</label>
            </div>
            <div class="mb-3 text-center">

                <a href="frame/newDados.php" class="newC">Não tem conta? Crie uma!</a>
            </div>
            <div class="text-center">

                <button type="submit" class="btn btn-secondary mb-3">
                    Enviar
                </button>

            </div>
        </form>



    </div>

</body>

</html>