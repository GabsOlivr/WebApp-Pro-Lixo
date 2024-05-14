<?php

require("../usrclass.php");
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

// O código a seguir é um teste, meramente um placeholder,
// isso vai ser substituido pela consulta à tabela de solicitações. 
$arrUm = array(
    'materiais' => 'Metais',
    'quantidade' => 2,
    'endereco' => 'Rua Alcantra N 12 - Guará, SP'
);

$arrDois = array(
    'materiais' => 'Plásticos e papel',
    'quantidade' => 7,
    'endereco' => 'Rua Sadia N 13 - Guará, SP'
);

$arrTres = array(
    'materiais' => 'Vidro, papelão e plásticos',
    'quantidade' => 6,
    'endereco' => 'Rua Pamplona N 14 - Guará, SP'
);

$arrayDados = array($arrUm, $arrDois, $arrTres);

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
                        <img src="../assets/images/" class="h-8 me-3" alt="" /> <!--LOGO NAVBAR -->
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-blue-700 dark:text-white">Pro-Lixo</span>
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
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Solicitações</span>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
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

    <div class="p-4 sm:ml-64 ">
        <div class="flex flex-col items-center justify-center h-auto mb-4 w-full lg:w-1/2 mx-auto"> <!-- Bloco do Maps-->
            <div class="mt-14 mb-4 w-full lg:max-w-full lg:flex justify-center text-center">
                <div class="bg-gray-100 rounded-lg p-2 shadow-xl w-full">
                    <h6 class="text-xl font-bold mb-2">Mapa de Coleta</h6>
                    <div id="map" class="map h-64 rounded-lg  border border-solid border-blue-700 mb-4">
                    </div> <!-- Placeholder do mapa -->
                    <p class="text-gray-700">Visualize as solicitações de coleta em um mapa interativo.</p>
                </div>
            </div>
        </div>


        <div class="flex flex-col items-center justify-center h-64 mb-4 py-14 w-full lg:w-1/2 mx-auto bg-gray-100 rounded-lg shadow-xl overflow-y-auto">
            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 mt-28 mb-2 pt-28 justify-center w-3/4"> <!-- Bloco dos Cards -->
                <?php
                foreach ($arrayDados as $linha) {
                    echo '<div class="flex items-center justify-center">';
                    echo '<div class="bg-white rounded-lg p-4 shadow-xl w-full">';
                    echo '<div class="grid grid-cols-3 justify-center mb-2">';
                    echo '<div class="col-span-2">';
                    echo '<p class="text-gray-700 text-sm">Materiais para a coleta:</p>';
                    echo '<h6 class="text-xl font-bold mb-2">' . $linha['materiais'] . '</h6>';
                    echo '</div>';
                    echo '<button class="mt-2 bg-gray-400 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded-pattern-1 ml-3 col-span-1">';
                    echo $linha['quantidade'] . ' Itens';
                    echo '</button>';
                    echo '</div>';
                    echo '<p class="text-gray-700">' . $linha['endereco'] . '.</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                <!-- Base dos cards -->
                <!-- <div class="flex items-center justify-center">
                    <div class="bg-gray-100 rounded-lg p-4 shadow-xl w-full">
                        <div class="grid grid-cols-3 justify-center mb-2">
                            <div class="col-span-2">
                                <p class="text-gray-700 text-sm">Materiais para a coleta:</p>
                                <h6 class="text-xl font-bold mb-2">Materiais</h6>
                            </div>
                            <button class="mt-2 bg-gray-400 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded-pattern-1 ml-3 col-span-1">
                                0 itens
                            </button>
                        </div>
                        <p class="text-gray-700">Endereço que será mostrado.</p>
                    </div>
                </div> -->

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
            const {
                Map
            } = await google.maps.importLibrary("maps");

            map = new Map(document.getElementById("map"), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8,
            });
        }

        initMap();

        // Função para buscar o endereço no mapa
        function searchAddress() {
            var address = "Rua Antônia Mateus da silva, 133, Guaratinguetá"; // Endereço pré-definido

            // Cria uma instância do geocoder do Google Maps
            var geocoder = new google.maps.Geocoder();

            // Faz a geocodificação do endereço
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    // Define a latitude e longitude no input hidden
                    document.getElementById("latitude").value = results[0].geometry.location.lat();
                    document.getElementById("longitude").value = results[0].geometry.location.lng();

                    // Centraliza o mapa na nova localização
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: results[0].geometry.location
                    });

                    // Cria uma janela de informações para exibir a latitude e longitude
                    var infoWindow = new google.maps.InfoWindow({
                        content: 'Latitude: ' + results[0].geometry.location.lat() + '<br>Longitude: ' + results[0].geometry.location.lng()
                    });

                    // Adiciona um marcador no mapa com a janela de informações
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });

                    // Abre a janela de informações ao clicar no marcador
                    marker.addListener('click', function() {
                        infoWindow.open(map, marker);
                    });
                } else {
                    alert('Endereço não encontrado: ' + status);
                }
            });
        }

        // Função para salvar dados
        function saveData() {
            var endereco = document.getElementById("endereco").value;
            var tipoLixo = document.getElementById("tipo-lixo").value;
            var quantidade = document.getElementById("quantidade").value;
            var latitude = document.getElementById("latitude").value;
            var longitude = document.getElementById("longitude").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                }
            };
            xhr.open("POST", window.location.href, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("save=1&endereco=" + endereco + "&tipo_lixo=" + tipoLixo + "&quantidade=" + quantidade + "&latitude=" + latitude + "&longitude=" + longitude);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjiJnJKpcL9tMRGfD9AGmPYZPmydig87g&callback=initMap" async defer></script>





    <!-- https://flowbite.com/docs/components/sidebar/ -->
</body>

</html>