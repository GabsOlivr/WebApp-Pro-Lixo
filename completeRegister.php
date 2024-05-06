<?php
require("usrclass.php");
session_start();
if (isset($_SESSION['usr_obj'])){
    $usu_obj = unserialize($_SESSION['usr_obj']);
}
else {
    header("location: index.php");
}
//Detalhe: Isso aqui é só pra colocar o primeiro nome alí no cabeçalho, é frescura, mas é legal
$nome = $usu_obj->primeiroNome();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Registration</title>
    <link rel="stylesheet" href="./assets/css/registerStyle.css">
</head>

<body>
    <section class="wrapper">
        <div class="form complete-registration">
            <header> <?php echo $nome; ?>, Conte mais sobre você</header>
            <form id="completaRegistr0" action="BackCompletaRegistro.php" method="POST">
            <label> Qual seu número de celular</label>
                <input type="text" id="celular" name="celular" placeholder="(xx) xxxxx-xxxx" required pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}">
                <label> Como pretende usar este sistema? </label>
                <select id="tipoUser" name="tipoUser">
                    <option value="0">Para solcitar coletas</option>
                    <option value="1">Para coletar resíduos</option>
                </select>
                <label> Que tal um Ícone? </label>
                <select id="iconeSelect" name="iconeSelect">
                    <option value="optionA">Ícone A</option>
                    <option value="optionB">Ícone B</option>
                    <option value="optionC">Ícone C</option>
                </select>
                <!-- Aqui nós fazemos a checagem do endereço pela API -->
                <label> Qual o endereço ou CEP de sua residência? </label>
                <input type="text" id="end" name="end" placeholder="Endereço ou CEP">
                <!-- Podemos colocar um mapa pra mostrar o endereço em tempo real, mas eu acho bobagem -->
                <!-- <div class="placeholder-mapa"></div> -->
                <input type="submit" name="bt1" value="Continuar">
            </form>
        </div>
    </section>

    <script>
        // Function to format phone number input
        function formatPhoneNumber(event) {
            const input = event.target;
            const { value } = input;

            // Remove all non-numeric characters
            const phoneNumber = value.replace(/\D/g, '');

            // Check if the phoneNumber is not empty
            if (phoneNumber.length > 0) {
                // Apply phone number formatting
                let formattedPhoneNumber = '(' + phoneNumber.substring(0, 2) + ') ' +
                                            phoneNumber.substring(2, 7) + '-' +
                                            phoneNumber.substring(7, 11);

                // Update input value with formatted phone number
                input.value = formattedPhoneNumber;
            }
        }

        // Get the phone number input element
        const phoneNumberInput = document.getElementById('celular');

        // Listen for input events (e.g., keypress, paste) to format phone number
        phoneNumberInput.addEventListener('input', formatPhoneNumber);
    </script>

</body>

</html>
