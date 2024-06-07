<?php

require("../usrclass.php");
session_start();
if (isset($_SESSION['usr_obj'])) {
   $usu_obj = unserialize($_SESSION['usr_obj']);
   if ($usu_obj->usuCell == '00000000000') {
      header("location: ../completeRegister.php");
   }

   if ($usu_obj->usuTipo == 1) {
      header("location: mainColetor.php");
   }elseif ($usu_obj->usuTipo == 2) {
      header("location: mainAdmin.php");
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

?>

<!doctype html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="../dist/output.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
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
               <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                     <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                     <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                  </svg>
                  <span class="ms-3">Dashboard</span>
               </a>
            </li>
            <!-- <li>
               <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                     <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                  </svg>
                  <span class="flex-1 ms-3 whitespace-nowrap">Minhas Solicitações</span>                  
               </a>
            </li> -->
            <li>
               <a href="./mainSolicitante.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
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
                        <div class="w-full lg:w-2/2 shadow rounded-lg inline-block">
                           <label for="text" class="font-bold mb-2 text-sm text-gray-900 dark:text-white">Endereço:</label>
                           <p class="italic"><?php echo $usu_obj->usuEnd; ?></p>
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

      <div class="p-4  mt-5 mb-4 "> <!-- Div blocos duplos -->
         <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2  justify-center">
            <div class="flex items-center justify-center">
               <div class="flex flex-col items-center justify-center max-w-sm p-6 bg-white rounded-lg shadow-2xl sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                  <h6 class="mb-2 text-2xl font-bold text-gray-900">Nova Solicitação de coleta</h6>
                  <p class="font-normal text-gray-700 text-justify">Solicite a coleta de resíduos sólidos em sua residência.</p>
                  <div class="flex justify-center mt-auto">
                     <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="">
                        <a href="#">
                           <svg class=" text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                              <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd" />
                           </svg>
                        </a>
                     </button>
                  </div>
               </div>
            </div>

            <!-- -------------------- MODAL -------------------- -->

            <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
               <div class="relative p-4 w-full max-w-md max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                     <!-- Modal header -->
                     <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                           Nova solicitação de coleta
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                           <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                           </svg>
                           <span class="sr-only">Close modal</span>
                        </button>
                     </div>
                     <!-- Modal body -->
                     <form method="POST" action="salvaSolicita.php" class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                           <div class="col-span-2 sm:col-span-1">
                              <label for="quantidade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade em Kg</label>
                              <input type="number" name="quantidade" id="quantidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                           </div>
                           <div class="col-span-2 sm:col-span-1">
                              <label for="tipoLixo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de resíduo:</label>
                              <select id="tipoLixo" name="tipoLixo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                 <option selected="">Selecionar tipo</option>
                                 <option value="Vidro">Vidro</option>
                                 <option value="Metal">Metal</option>
                                 <option value="Plástico">Plastico</option>
                                 <option value="Papel">Papel</option>
                                 <option value="Variados">Variados</option>
                              </select>
                           </div>
                           <div class="col-span-2">
                              <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensagem/Recado sobre a coleta:</label>
                              <textarea id="descricao" name="descricao" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Exemplo: Estarei em casa às 15:00"></textarea>
                           </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                           <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                           </svg>
                           Solicitar coleta
                        </button>
                     </form>
                  </div>
               </div>
            </div>


            <!-- -------------------- MODAL -------------------- -->

            <div class="flex items-center justify-center">
               <div class="flex flex-col items-center justify-center max-w-sm p-6 bg-white rounded-lg shadow-2xl sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                  <h6 class="mb-2 text-2xl font-bold text-gray-900">Manual e Informações</h6>
                  <p class="font-normal text-gray-700 text-justify">Veja como separar os resíduos, informações do
                     sistema, campanha e muito mais.</p><br>
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
               © 2024 <a href="https://flowbite.com/" class="hover:underline font-semibold">Pro-Lixo / Fatec Guaratinguetá</a>. Todos os direitos reservados
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

   <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

   <!-- https://flowbite.com/docs/components/sidebar/ -->
</body>

</html>