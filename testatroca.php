<?php
//Note: Unserialize é uma função pra recuparar o objeto da sessão
require("usrclass.php");
session_start();
if (isset($_SESSION['usr_obj'])){
    $usu_obj = unserialize($_SESSION['usr_obj']);
    if($usu_obj->usuCell == '00000000000'){
        header("location: completeRegister.php");
    }

    if(  $usu_obj->usuTipo == 0){
        header("location: userpageSolicitante.php");
    }
}
else {
    //Esse echo agora funciona, mas pra isso o redirecionamento teve que mudar
    echo "
        <script>
        alert('Perfil não conectado, faça login novamente');
        window.location.href = 'index.php';
        </script>
    ";
    //Por enquanto esse header pode ficar comentado
    //header("location: index.php");
}

$nome = $usu_obj->primeiroNome();

?>

<!doctype html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./dist/output.css" rel="stylesheet">
</head>

<body>
   <div class="relative bg-gray-100 shadow-xl ring-1 ring-gray-900/5 mx-10 w-auto rounded-lg px-10 items-center justify-center pb-4">

      <img style="height: 150px; width: 150px;" class="mx-auto" src="<?php echo $usu_obj->usuIcone ?>" alt="Icone" >

      <div class="flex items-center justify-center w-full rounded pt-6 pb-4">
         <p class="text-2xl"> Bem vindo, <?php echo $nome;?></p>
      </div>

      <div class=" grid grid-cols-2 gap-4 w-full">
         <p class="px-6 mx-auto"> Endereço </p>
         <p class="px-6 mx-auto"> Telefone</p>
         <p class="mx-auto"> Rua Pa, N 302 - Guará </p>
         <p class="mx-auto"> <?php echo $usu_obj->usuCell; ?></p>
      </div>

      <p class="flex items-center justify-center w-40 rounded-lg bg-gray-50 pt-2 pb-2 mx-auto mt-4 shadow">
         <a href="" class="text-black hover:text-purple-400">Alterar Informações
         </a>
      </p>

   </div>

   <form method="POST" action="#">
        <input class="flex items-center justify-center w-40 rounded-lg bg-gray-800 pt-2 pb-2 mx-auto mt-4 shadow" type="submit" value="Sair" name="bt1">
    </form>

</body>

</html>

<?php
    if(isset($_POST['bt1'])){
        session_destroy();
        header("location: index.php");
    }
?>