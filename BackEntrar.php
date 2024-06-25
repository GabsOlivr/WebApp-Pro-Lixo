<?php

require("conexao.php");
require("usrclass.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usremail = trim($_POST['usremail']);
    $usrpass = trim($_POST['usrsenha']);
    
    $conn = new conexaoBD();
    $obj = new usrclass();

    try {
        $conecta = new PDO($conn->dns, $conn->username, $conn->password);
        $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $texto = "SELECT usr_senha FROM usr_usuario WHERE usr_email = :email";
        $stmt = $conecta->prepare($texto);
        $stmt->execute([':email' => $usremail]);

        $hash = $stmt->fetchColumn();

        if ($hash === false) {
            echo "
                <script>
                alert('Usuário inexistente!');
                window.location.href = 'loginRegister.php';
                </script>
            ";
        } else {
            if (password_verify($usrpass, $hash)) {
                $txtdois = "SELECT usr_id, usr_nome, usr_celular, usr_email, usr_senha, usr_icone, usr_tipo, end_completo, end_latitude, end_longitude FROM usr_usuario LEFT JOIN end_endereco USING (usr_id) WHERE usr_email = :email";
                $stmt2 = $conecta->prepare($txtdois);
                $stmt2->execute([':email' => $usremail]);

                $linha = $stmt2->fetch(PDO::FETCH_ASSOC);
                if ($linha) {
                    $obj->usuId = $linha['usr_id'];
                    $obj->usuNome = $linha['usr_nome'];
                    $obj->usuCell = $linha['usr_celular'];
                    $obj->usuEmail = $linha['usr_email'];
                    $obj->usuSenha = $linha['usr_senha'];
                    $obj->usuIcone = $linha['usr_icone'];
                    $obj->usuTipo = $linha['usr_tipo'];
                    $obj->usuEnd = $linha['end_completo'];
                    $obj->usuLat = $linha['end_latitude'];
                    $obj->usuLng = $linha['end_longitude'];

                    session_start();
                    session_regenerate_id(true);
                    $_SESSION['usr_obj'] = serialize($obj);

                    if ($obj->usuCell == '00000000000') {
                        header("location: completeRegister.php");
                    } else {                  
                        if ($obj->usuTipo == 0) {
                            header("location: ./userpages/mainSolicitante.php");
                        } elseif ($obj->usuTipo == 1) {
                            header("location: ./userpages/mainColetor.php");
                        } else {
                            header("location: ./userpages/mainAdmin.php");
                        }
                    }
                    exit();
                }
            } else {
                echo "
                <script>
                alert('Senha inválida.');
                window.location.href = 'loginRegister.php';
                </script>
                ";
            }
        }
    } catch (PDOException $erro) {
        echo "
            <script>
            alert('Erro ao conectar ao banco de dados: " . htmlspecialchars($erro->getMessage()) . "');
            window.location.href = 'loginRegister.php';
            </script>
        ";
    }
} else {
    echo "Método de requisição não suportado.";
}

?>