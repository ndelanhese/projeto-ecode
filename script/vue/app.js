var vue = new Vue({
    el: '#app',
    data: {
        att: '', att1: '', att2: '', email: '', senha: '', senha1: '', inputType: 'password'
    },
    methods: {
        enviar: function () {
            if (this.email == "") {
                this.att = "Preencha o e-mail"
            }
            if (this.email != "") {
                this.att = ""
            }
            if (this.senha == "") {
                this.att1 = "Preencha a senha"
            }
            if (this.senha != "") {
                this.att1 = ""
            }
            if (this.senhaC !== this.senha) {
                this.att2 = "As senhas não são idênticas"
            }



        },

        trocar() {
            if (this.inputType == 'password') {
                this.inputType = 'text'
            } else {
                this.inputType = 'password'
            }

        }

    }


})
