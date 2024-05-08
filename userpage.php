<?php
//Note: Unserialize é uma função pra recuparar o objeto da sessão
require("usrclass.php");
session_start();
if (isset($_SESSION['usr_obj'])){
    $usu_obj = unserialize($_SESSION['usr_obj']);
    if($usu_obj->usuCell == '00000000000')
        header("location: completeRegister.php");
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
?>

<!DOCTYPE html>
<!-- Todo esse html é um placeholder, aqui colocaremos a página do usuário quando estiver pronta-->

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Usuário</title>
</head>
<body>
    <h1>Estamos testando!</h1>
    <br>
    <br>
    <form method="POST" action="#">
        <input type="submit" value="Sair" name="bt1">
    </form>

    <img style="width: 300px; height: 300px;" src="<?php echo $usu_obj->usuIcone ?>" alt="Icone" >
    

</body>
</html>

<?php
    if(isset($_POST['bt1'])){
        session_destroy();
        header("location: index.php");
    }
?>