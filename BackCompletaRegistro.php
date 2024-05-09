<?php

    require("conexao.php");
    require("usrclass.php");
    session_start();
    $usu_obj = unserialize($_SESSION['usr_obj']);

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $numeroFormatado= $_POST['celular'];
        $usrnumber = preg_replace('/\D/', '', $numeroFormatado);
        $usrtype= $_POST['tipoUser'];
        $usricon = $_POST['iconValue'];
        $usrid = $usu_obj->usuId;
        $usrend = $_POST['end'];
        //o endereço deve ser salvo na tabela end_endereco, usando os dados retornados da API e o usu_id

        $conn = new conexaoBD();

        try {
            $conecta = new PDO($conn->dns, $conn->username, $conn->password);
            $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $texto = "UPDATE usr_usuario SET `usr_celular` = '".$usrnumber."', `usr_icone` = '".$usricon."', `usr_tipo` = '".$usrtype."' WHERE (`usr_id` = '".$usrid."')";
            $conecta->exec($texto);

            $txtdois = "SELECT * FROM usr_usuario WHERE usr_id = '".$usrid."'";
            $consulta=$conecta->query($txtdois);
            foreach($consulta as $linha){
                $usu_obj->usuId = $linha['usr_id'];
                $usu_obj->usuNome = $linha['usr_nome'];
                $usu_obj->usuCell = $linha['usr_celular'];
                $usu_obj->usuEmail = $linha['usr_email'];
                $usu_obj->usuSenha = $linha['usr_senha'];
                $usu_obj->usuIcone = $linha['usr_icone'];
                $usu_obj->usuTipo = $linha['usr_tipo'];
            }
            $_SESSION['usr_obj'] = serialize($usu_obj);
            header("location: userpage.php");

        } catch (PDOException $erro) {
            echo "
                    <script>
                    alert('Não consegui conectar no banco.');
                    window.location.href = 'index.php';
                    </script>
                ";
        }
    }else{
        echo "Não funcionou paizão, e agora?";
    }

?>