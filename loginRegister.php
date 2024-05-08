<?php

require("usrclass.php");

session_start();
if (isset($_SESSION['usr_obj'])){
    header("location: userpage.php");
}
else {
    
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <section class="wrapper">
        <div class="form signup">
            <header>Registrar</header>
            <form id="signupForm" action="BackCadastro.php" method="POST"> 
                <input type="text" id="name" name="name" placeholder="Nome Completo" required />                                
                <span id="nameError" class="error" style="color: #fff;"></span>                
                <input type="text" id="email" name="email" placeholder="E-mail" required />
                <span id="emailError" class="error" style="color: #fff;"></span>                
                <input type="password" id="senha" name="senha" placeholder="Senha" required />
                <span id="senhaError" class="error" style="color: #fff;"></span>                
                <div class="checkbox">
                    <input type="checkbox" id="signupCheck"/>
                    <label for="signupCheck">Concordo com todos os termos e condições</label>
                </div>
                <input type="submit" name="cadastrar" value="Registrar" />
            </form>
        </div>

        <!-- ---------------------- -->

        <div class="form login">
            <header>Login</header>
            <form method="POST" action="BackEntrar.php">                
                <input type="text" name="usremail" placeholder="E-mail" required />
                <input type="password" name="usrsenha"placeholder="Senha" required />
                <a href="#">Esqueceu a senha?</a>
                <input type="submit" name="entrar" value="Login" />
            </form>
        </div>

    
        <script>
            // INICIO TRANSIÇÃO LOGIN/REGISTRAR
            const wrapper = document.querySelector(".wrapper"),
                signupHeader = document.querySelector(".signup header"),
                LoginHeader = document.querySelector(".login header");
            
            LoginHeader.addEventListener("click", () => {
                wrapper.classList.add("active");
            });           
            signupHeader.addEventListener("click", () => {
                wrapper.classList.remove("active");
            })
            // FIM TRANSIÇÃO LOGIN/REGISTRAR

            // INICIO VALIDA EMAIL
            document.getElementById('signupForm').addEventListener('submit', function(event) {
                var emailInput = document.getElementById('email');
                var email = emailInput.value.trim();
                var emailError = document.getElementById('emailError');
            
                if (!isValidEmail(email)) {
                    emailError.textContent = 'Por favor, insira um endereço de e-mail válido.';
                    event.preventDefault(); // Impede o envio do formulário se o e-mail não for válido
                } else {
                    emailError.textContent = ''; // Limpa a mensagem de erro se o e-mail for válido
                }
            });        
            function isValidEmail(email) {
                // Expressão regular para validar o formato do e-mail
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            // FIM VALIDA EMAIL

            // INICIO RESTRINJE NOME
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');

            nameInput.addEventListener('input', () => {
            const name = nameInput.value.trim();
            if (name.length < 8 || name.length > 50) {
                nameError.textContent = 'O nome deve ter entre 8 e 50 caracteres.';
                nameInput.setCustomValidity(''); // Limpa a validação padrão do browser
                nameInput.reportValidity(); // Exibe a mensagem de erro personalizada
            } else {
                nameError.textContent = '';
                nameInput.setCustomValidity(''); // Limpa a validação personalizada se estiver correta
            }
        });
            // FIM RESTRINJE NOME

            // VALIDA SENHA
            const senhaInput = document.getElementById('senha');
            const senhaError = document.getElementById('senhaError');

            senhaInput.addEventListener('input', () => {
            const senha = senhaInput.value.trim();
            const senhaValida = validarSenha(senha);
            if (!senhaValida) {
                senhaError.textContent = 'Minimo de 8 caracteres, pelo menos 1 letra maiúscula, 1 número e 1 caractere especial.';
                senhaInput.setCustomValidity(''); // Limpa a validação padrão do browser
                senhaInput.reportValidity(); // Exibe a mensagem de erro personalizada
            } else {
                senhaError.textContent = '';
                senhaInput.setCustomValidity(''); // Limpa a validação personalizada se estiver correta
            }

            });

            function validarSenha(senha) {
            const regexSenha = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/;
            return regexSenha.test(senha);
            }
            // FIM - VALIDA SENHA

            
        </script>
    </section>
</body>

</html>
