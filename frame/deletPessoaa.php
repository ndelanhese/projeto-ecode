<script>
var url_atual = window.location.href;
var a = confirm("Você realmente deseja excluir a pessoa?")
if (a) {

    
    var b =url_atual.replace(/[^0-9]/g,'')
       window.location.href = "deletPessoa.php?id=" + b
}else{
    window.location.href = "listarPessoas.php"
}

</script>