<script>
var url_atual = window.location.href;
var a = confirm("Você realmente deseja excluir o usuário?")
if (a) {

    
    var b =url_atual.replace(/[^0-9]/g,'')
       window.location.href = "deletPessoa.php?id=" + b
}else{
    window.location.href = "listarUsuario.php"
}

</script>