<?php
require("usrclass.php");
session_start();
if (isset($_SESSION['usr_obj'])) {
    $usu_obj = unserialize($_SESSION['usr_obj']);
} else {
    header("location: index.php");
}
//Detalhe: Isso aqui é só pra colocar o primeiro nome alí no cabeçalho, é frescura, mas é legal
$nome = $usu_obj->primeiroNome();

$icone = 'Escolha seu ícone';

if (isset($_POST['icon'])) {
    $icone = $_POST['icon'];
    if ($icone == 'Icone tipo A') {
        $caminho = 'assets\\\images\\\iconsRegister\\\iconOpt1.png';
    } else {
        if ($icone == 'Icone tipo B') {
            $caminho = 'assets\\\images\\\iconsRegister\\\iconOpt2.png';
        } else {
            if ($icone == 'Icone tipo C') {
                $caminho = 'assets\\\images\\\iconsRegister\\\iconOpt3.png';
            }
        }
    }
} else {
    $caminho = 'assets\\\images\\\iconsRegister\\\iconOptNull.png';
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Registration</title>
    <link rel="stylesheet" href="./assets/css/registerStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                    <option value="0">Para solicitar coletas</option>
                    <option value="1">Para coletar resíduos</option>
                </select>
                <label> Que tal um Ícone? </label>
                <br>
                <button type="button" id="iconeSelect" name="iconeSelect" class="btnIcon" data-bs-toggle="modal" data-bs-target="#exampleModal"> <?php echo $icone; ?> </button>
                <input type="hidden" name="iconValue" value="<?php echo $caminho; ?>">

                <!-- <select id="iconeSelect" name="iconeSelect">
                    <option value="assets\\images\\iconsRegister\\iconOpt1.png">Ícone A</option>
                    <option value="assets\\images\\iconsRegister\\iconOpt2.png">Ícone B</option>
                    <option value="assets\\images\\iconsRegister\\iconOpt3.png">Ícone C</option>
                </select> -->

                <!-- Aqui nós fazemos a checagem do endereço pela API -->
                <label> Qual o endereço ou CEP de sua residência? </label>
                <input type="text" id="end" name="end" placeholder="Endereço ou CEP">
                <input type="submit" name="bt1" value="Continuar">
            </form>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Escolha um ícone para te representar:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form id="iconType" method="POST" style="padding-left: 5%; padding-right: 5%;">
                        <button type="submit" name="icon" value="Icone tipo A" style="border: none; background: none; width: 30%; height: 30%;">
                            <img src="assets\images\iconsRegister\iconOpt1.png" alt="Icone 1" style="width: 100%; height: 100%;">
                            Opção 1
                        </button>
                        <button type="submit" name="icon" value="Icone tipo B" style="border: none; background: none; width: 30%; height: 30%;">
                            <img src="assets\images\iconsRegister\iconOpt2.png" alt="Icone 2" style="width: 100%; height: 100%;">
                            Opção 2
                        </button>
                        <button type="submit" name="icon" value="Icone tipo C" style="border: none; background: none; width: 30%; height: 30%;">
                            <img src="assets\images\iconsRegister\iconOpt3.png" alt="Icone 3" style="width: 100%; height: 100%;">
                            Opçãp 3
                        </button>
                        <!-- <input type="submit" name="icon" value="Icone tipo A">
                        <input type="submit" name="icon" value="Icone tipo B">
                        <input type="submit" name="icon" value="Icone tipo C"> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- script Google Places Autocomplete -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjiJnJKpcL9tMRGfD9AGmPYZPmydig87g&libraries=places"></script>

    <script>
        // Inicializar o autocompletar no campo de endereço
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('end'));

        // Definir o tipo de autocompletar para endereços
        autocomplete.setTypes(['address']);
    </script>

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // Function to format phone number input
        function formatPhoneNumber(event) {
            const input = event.target;
            const {
                value
            } = input;

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