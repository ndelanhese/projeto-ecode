var vue = new Vue({
    el: '#app',
    data: {
        att: '', att1: '', att2: '', email: '', senha: '', senhaC: '', inputType: 'password'
    },
    methods: {


        trocar() {
            if (this.inputType == 'password') {
                this.inputType = 'text'
            } else {
                this.inputType = 'password'
            }

        },
        confirmar() {

        }

    },
    computed: {
        enviar() {
            if (this.email == "") {
                this.att = "Preencha o e-mail"
                return false
            }
            if (this.email != "") {
                this.att = ""

            }
            if (this.senha == "" || this.senhaC == "") {
                this.att1 = "Preencha a senha"
                return false
            }
            if (this.senha != "") {
                this.att1 = ""

            }
            if (this.senha != "") {
                this.att1 = ""

            }
            if (this.senhaC !== this.senha) {
                this.att2 = "As senhas não são idênticas"
                return false
            }

            return true

        }
    }

})
