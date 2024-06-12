<?php

require("../usrclass.php");
require("../conexao.php");
session_start();
if (isset($_SESSION['usr_obj'])) {
    $usu_obj = unserialize($_SESSION['usr_obj']);
    if ($usu_obj->usuCell == '00000000000') {
        header("location: ../completeRegister.php");
    }

    if ($usu_obj->usuTipo == 0) {
        header("location: mainSolicitante.php");
    }
} else {
    echo "
        <script>
        alert('Perfil não conectado, faça login novamente');
        window.location.href = '../index.php';
        </script>
    ";
    //Por enquanto esse header pode ficar comentado
    //header("location: index.php");
}

$nome = $usu_obj->primeiroNome();

$cellFormatado = $usu_obj->formataCell();

$conn = new conexaoBD();

$usulat = $usu_obj->usuLat;
$usulng = $usu_obj->usuLng;

try {
    $conecta = new PDO($conn->dns, $conn->username, $conn->password);
    $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $txtdois = "SELECT slc_id, slc_materiais, slc_quantidade, slc_status, end_completo FROM slc_solicitacao join end_endereco using (end_id)";
    $consulta = $conecta->query($txtdois);
} catch (PDOException $erro) {
    echo "
                    <script>
                    alert('Não consegui conectar no banco.');
                    window.location.href = 'index.php';
                    </script>
                ";
}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</head>

<body>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-blue-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm  rounded-lg sm:hidden  focus:outline-none focus:ring-2 focus:ring-blue-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6 text-blue-700" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>

                    </button>
                    <a href="#" class="flex ms-2 md:me-24">
                  <img src="../assets/images/Logo-Pro-Lixo-Azul-Crop.png" class="h-8 me-3" alt="Logo" />
               </a>
                </div>

            </div>
        </div>
    </nav>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-blue-700 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="mainColetor.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                        <span class="ms-3">Voltar</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./mainColetor.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sair</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <form>
        <input type="hidden" id="usulat" name="usulat" value="<?php echo htmlspecialchars($usulat); ?>">
        <input type="hidden" id="usulng" name="usulng" value="<?php echo htmlspecialchars($usulng); ?>">
        <input type="hidden" id="endercoteste" name="endercoteste" value="<?php echo htmlspecialchars($usu_obj->usuEnd); ?>">
    </form>

    <div class="p-4 sm:ml-64 ">
        <div class="flex flex-col items-center justify-center h-auto mb-4 w-full lg:w-1/2 mx-auto"> <!-- Bloco do Maps-->
            <div class="mt-14 mb-4 w-full lg:max-w-full lg:flex justify-center text-center">
                <div class="bg-gray-100 rounded-lg p-2 shadow-xl w-full">
                    <h6 class="text-xl font-bold mb-2">Mapa de Coleta</h6>
                    <div id="map" class="map h-64 rounded-lg mb-4">
                    </div> <!-- Placeholder do mapa -->
                    <p class="text-gray-700">Visualize as solicitações de coleta em um mapa interativo.</p>
                </div>
            </div>
        </div>




<div class="flex flex-col items-center justify-start h-64 mb-4 w-full lg:w-1/2 mx-auto bg-gray-100 rounded-lg shadow-xl overflow-y-auto">
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-28 mt-2 mb-2 pt-2 justify-center w-3/4 "> <!-- Bloco dos Cards -->
        <?php
        // Verificação se $consulta não está vazia
        if (!empty($consulta)) {
            foreach ($consulta as $linha) {
                echo '<div class="flex items-center justify-center mb-4">'; // Adicionei "mb-4" para espaçamento entre itens
                echo '<div class="bg-white rounded-lg p-4 shadow-xl w-full">';
                echo '<div class="grid grid-cols-3 justify-center mb-2">';
                echo '<div class="col-span-2">';
                echo '<p class="text-gray-700 text-sm">Materiais para a coleta:</p>';
                echo '<h6 class="text-xl font-bold mb-2">' . htmlspecialchars($linha['slc_materiais'], ENT_QUOTES, 'UTF-8') . '</h6>'; // Usando htmlspecialchars para segurança
                echo '</div>';
                echo '<button class="mt-2 bg-gray-400 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded-pattern-1 ml-3 col-span-1">';
                echo htmlspecialchars($linha['slc_quantidade'], ENT_QUOTES, 'UTF-8') . ' Itens'; // Usando htmlspecialchars para segurança
                echo '</button>';
                echo '</div>';
                echo '<p class="text-gray-700">' . htmlspecialchars($linha['end_completo'], ENT_QUOTES, 'UTF-8') . '.</p>'; // Usando htmlspecialchars para segurança
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-gray-700">Nenhum dado encontrado.</p>';
        }
        ?>
    </div>
</div>



        <footer class="bg-white border border-solid border-gray-400 items-center justify-center rounded-lg shadow m-4 dark:bg-bl-800 text-center">
            <div class="w-full mx-auto max-w-screen-xl p-4  lg:items-center md:flex md:items-center">
                <span class="text-sm text-black dark:text-gray-400 text-center font-semibold">
                    © 2024 <a href="#" class="hover:underline font-semibold">Pro-Lixo / Fatec Guaratinguetá</a>. Todos os direitos reservados
                </span>
            </div>
        </footer>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.querySelector('[data-drawer-toggle="logo-sidebar"]');
            const sidebar = document.getElementById('logo-sidebar');

            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    </script>

    <script>
        let map;

        async function initMap() {
            var usrlat = parseFloat(document.getElementById('usulat').value);
            var usrlng = parseFloat(document.getElementById('usulng').value);
            const {
                Map
            } = await google.maps.importLibrary("maps");

            map = new Map(document.getElementById("map"), {
                center: {
                    lat: usrlat,
                    lng: usrlng
                    // Lembra-te: Lat e lng recebem a longitude a e latitude do endereço do coletor por padrão 
                },
                zoom: 18,
            });
        }

        initMap();

        function GetLatlong() {
            var geocoder = new google.maps.Geocoder();
            var address = document.getElementById('endercoteste').value;

            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                }
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjiJnJKpcL9tMRGfD9AGmPYZPmydig87g&callback=initMap" async defer></script>





    <!-- https://flowbite.com/docs/components/sidebar/ -->
</body>

</html>