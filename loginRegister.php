<?php

require("usrclass.php");

session_start();
if (isset($_SESSION['usr_obj'])) {
    $usu_obj = unserialize($_SESSION['usr_obj']);
    if ($usu_obj->usuTipo == 0) {
        header("location: ./userpages/mainSolicitante.php");
    } else {
        header("location: ./userpages/mainColetor.php");
    }
} else {
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Lixo</title>
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
                    <input type="checkbox" id="revelpassword" />
                    <label for="revelpassword">Ver senha</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="signupCheck" required />
                    <label for="signupCheck">Concordo com todos os <a href="./docs/Termos e Condições de Uso.pdf" download onclick="window.open(this.href, '_blank'); return false;" style="color:#fff;"> termos e condições</a></label>

                </div>
                <input type="submit" name="cadastrar" value="Registrar" />
            </form>
        </div>

        <script>
            document.getElementById('revelpassword').addEventListener('change', function() {
                var senhaInput = document.getElementById('senha');
                if (this.checked) {
                    senhaInput.type = 'text';
                } else {
                    senhaInput.type = 'password';
                }
            });
        </script>

        <div class="form login">
            <header>Login</header>
            <form method="POST" action="BackEntrar.php">
                <input type="text" name="usremail" placeholder="E-mail" required />
                <input type="password" id="senhalogin" name="usrsenha" placeholder="Senha" required />
                <div class="checkbox">
                    <input type="checkbox" id="revelpasswordlogin" />
                    <label for="revelpasswordlogin" style="color: black;">Ver senha</label>
                </div>
                <a href="#">Esqueceu a senha?</a>
                <input type="submit" name="entrar" value="Login" />
            </form>
        </div>
        <script>
            document.getElementById('revelpasswordlogin').addEventListener('change', function() {
                var senhaInput = document.getElementById('senhalogin');
                if (this.checked) {
                    senhaInput.type = 'text';
                } else {
                    senhaInput.type = 'password';
                }
            });
        </script>

        <script>
            const wrapper = document.querySelector(".wrapper"),
                signupHeader = document.querySelector(".signup header"),
                LoginHeader = document.querySelector(".login header");

            LoginHeader.addEventListener("click", () => {
                wrapper.classList.add("active");
            });
            signupHeader.addEventListener("click", () => {
                wrapper.classList.remove("active");
            })

            document.getElementById('signupForm').addEventListener('submit', function(event) {
                var emailInput = document.getElementById('email');
                var email = emailInput.value.trim();
                var emailError = document.getElementById('emailError');

                if (!isValidEmail(email)) {
                    emailError.textContent = 'Por favor, insira um endereço de e-mail válido.';
                    event.preventDefault();
                } else {
                    emailError.textContent = '';
                }
            });

            function isValidEmail(email) {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');

            nameInput.addEventListener('input', () => {
                const name = nameInput.value.trim();
                if (name.length < 8 || name.length > 50) {
                    nameError.textContent = 'O nome deve ter entre 8 e 50 caracteres.';
                    nameInput.setCustomValidity('');
                    nameInput.reportValidity();
                } else {
                    nameError.textContent = '';
                    nameInput.setCustomValidity('');
                }
            });


            const senhaInput = document.getElementById('senha');
            const senhaError = document.getElementById('senhaError');

            senhaInput.addEventListener('input', () => {
                const senha = senhaInput.value.trim();
                const senhaValida = validarSenha(senha);
                if (!senhaValida) {
                    senhaError.textContent = 'Minimo de 8 caracteres, pelo menos 1 letra maiúscula, 1 número e 1 caractere especial.';
                    senhaInput.setCustomValidity('');
                    senhaInput.reportValidity();
                } else {
                    senhaError.textContent = '';
                    senhaInput.setCustomValidity('');
                }

            });

            function validarSenha(senha) {
                const regexSenha = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/;
                return regexSenha.test(senha);
            }
        </script>
    </section>
</body>

</html>