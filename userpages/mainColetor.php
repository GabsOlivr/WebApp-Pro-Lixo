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
   } elseif ($usu_obj->usuTipo == 2) {
      header("location: mainAdmin.php");
   }
} else {
   echo "
        <script>
        alert('Perfil não conectado, faça login novamente');
        window.location.href = '../index.php';
        </script>
    ";
}

$nome = $usu_obj->primeiroNome();

$cellFormatado = $usu_obj->formataCell();

?>

<!doctype html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="../dist/output.css" rel="stylesheet">
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjiJnJKpcL9tMRGfD9AGmPYZPmydig87g&libraries=places"></script>
   <title>Pro-Lixo</title>
   
   <script>
      if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
         document.documentElement.classList.add('dark');
      } else {
         document.documentElement.classList.remove('dark')
      }
   </script>

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
               <button data-modal-target="profile-modal" data-modal-toggle="profile-modal" type="button">
                  <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                     <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Perfil</span>
                  </a>
               </button>
            </li>
            <li>
               <button>
                  <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                     <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Sair</span>
                  </a>
               </button>
            </li>
         </ul>
      </div>
   </aside>

   <div class="p-4 sm:ml-64">
      <div class="flex flex-col items-center justify-center h-auto mb-4 w-full lg:w-1/2 mx-auto"> <!-- Div Card Perfil -->
         <div class="mt-14 mb-4 max-w-lg w-full lg:max-w-full lg:flex justify-center text-center">
            <div class="card shadow-2xl bg-white rounded-lg overflow-hidden">
               <div class="p-4 flex flex-col justify-between leading-normal">

                  <div class="text-gray-900 font-bold text-xl mb-2">Bem vindo, <?php echo $nome; ?></div>
                  <div class="idade flex items-center justify-center lg:justify-center rounded-lg w-1/2 mx-auto">
                     <img class="w-1/2 h-1/2" src="<?php echo "../" . $usu_obj->usuIcone ?>" alt="Sua foto de Perfil">
                  </div>

                  <div class="mb-8 mt-5">
                     <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="w-full lg:w-2/2 h-20  shadow rounded-lg">
                           <label for="text" class=" font-bold mb-2 text-sm  text-gray-900 dark:text-white">Endereço:</label>
                           <p class="italic"> <?php echo $usu_obj->usuEnd;  ?> </p>
                        </div>
                        <div class="w-full lg:w-2/2 h-20 shadow rounded-lg">
                           <label for="text" class="font-bold mb-2 text-sm  dark:text-white">Telefone:</label>
                           <p class="italic"><?php echo $cellFormatado; ?></p>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </div>

      </div>



      <div class="p-4  mt-5 mb-4 ">
         <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2  justify-center">
            <div class="flex items-center justify-center">
               <div class="flex flex-col items-center justify-center max-w-sm p-6 bg-white rounded-lg shadow-2xl sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                  <h6 class="mb-2 text-2xl font-bold text-gray-900">Ver Solicitações</h6>
                  <p class="font-normal text-gray-700 text-justify">Vejas as solicitações de coleta de materiais
                     recicláveis pelo mapa de sua cidade.</p>
                  <div class="flex justify-center mt-4">
                     <button type="button" class="">
                        <a href="./mapColetor.php">
                           <svg class="flex-shrink-0  text-gray-800 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="45" height="45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                           </svg>
                        </a>
                     </button>
                  </div>
               </div>
            </div>

            <div id="profile-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
               <div class="relative p-4 w-full max-w-2xl max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                     <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="flex items-center justify-center">
               <div class="flex flex-col items-center justify-center max-w-sm p-6 bg-white rounded-lg shadow-2xl sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                  <h6 class="mb-2 text-2xl font-bold text-gray-900">Manual e Informações</h6>
                  <p class="font-normal text-gray-700 text-justify">Veja como usar esta aplicação, onde entregar sua
                     coleta e mais.</p><br>
                  <div class="flex justify-center mt-auto">
                     <button type="button" class="">
                        <a href="#">
                           <svg class=" text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" viewBox="0 0 24 24">
                              <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd" />
                           </svg>
                        </a>
                     </button>
                  </div>
               </div>
            </div>
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
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjiJnJKpcL9tMRGfD9AGmPYZPmydig87g&libraries=places"></script>

   <script>
      var autocomplete = new google.maps.places.Autocomplete(document.getElementById('end'));
      autocomplete.setTypes(['address']);
      autocomplete.addListener('place_changed', GetLatlong);

      document.getElementById('completaRegistr0').addEventListener('submit', function(event) {
         event.preventDefault();
         GetLatlong();
         this.submit();
      });

      function GetLatlong() {
         var geocoder = new google.maps.Geocoder();
         var address = document.getElementById('end').value;

         geocoder.geocode({
            'address': address
         }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
               var latitude = results[0].geometry.location.lat();
               var longitude = results[0].geometry.location.lng();
               document.getElementById('latcampo').value = latitude;
               document.getElementById('lngcampo').value = longitude;
            } else {
               console.error('Geocodificação falhou com status: ' + status);
            }
         });
      }
   </script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>