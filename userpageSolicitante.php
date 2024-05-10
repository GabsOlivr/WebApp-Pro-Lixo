<?php
//Note: Unserialize é uma função pra recuparar o objeto da sessão
require("usrclass.php");
session_start();
if (isset($_SESSION['usr_obj'])){
    $usu_obj = unserialize($_SESSION['usr_obj']);
    if($usu_obj->usuCell == '00000000000'){
        header("location: completeRegister.php");
    }

    if(  $usu_obj->usuTipo == 1){
        header("location: userpageColetor.php");
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

<!DOCTYPE html>
<!-- Todo esse html é um placeholder, aqui colocaremos a página do usuário quando estiver pronta-->

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Solicitante</title>
    <link rel="stylesheet" href="./assets/css/userStyle.css">
</head>
<body>
    <br>
    <br>
    <form method="POST" action="#">
        <input type="submit" value="Sair" name="bt1">
    </form>

    <!-- <img style="width: 300px; height: 300px;" src="<?php echo $usu_obj->usuIcone ?>" alt="Icone" > -->
    
    <div class="container">
    <div class="top-div">
        <img class="icon" src="<?php echo $usu_obj->usuIcone ?>" alt="Icone" >
        <h1> Bem vindo, <?php echo $nome;?> </h1>
        <div class="title-card">
            <p style="margin: 10%;">Endereço</p>
            <p style="margin: 10%;;">Telefone</p>
        </div>
        <div class="item-card">
            <p>Endereço place holder 293</p>
            <p> <?php echo $usu_obj->usuCell; ?></p>
        </div>

        <button type="button" class="">Alterar Informações</button>
        

    </div>
    <div class="bottom-div">
        <!-- Content for the bottom div -->
    </div>
</div>


</body>
</html>

<?php
    if(isset($_POST['bt1'])){
        session_destroy();
        header("location: index.php");
    }
?>