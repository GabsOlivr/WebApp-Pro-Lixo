<?php

require("conexao.php");
require("usrclass.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usrnome = trim($_POST['name']);
    $usremail = trim($_POST['email']);
    $usrpass = trim($_POST['senha']);
    $pass = password_hash($usrpass, PASSWORD_DEFAULT);

    $conn = new conexaoBD();
    $obj = new usrclass();

    try {
        $conecta = new PDO($conn->dns, $conn->username, $conn->password);
        $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $texto = "INSERT INTO usr_usuario (usr_nome, usr_celular, usr_email, usr_senha, usr_icone, usr_tipo) VALUES (:nome, :celular, :email, :senha, :icone, :tipo)";
        $stmt = $conecta->prepare($texto);
        $stmt->execute([
            ':nome' => $usrnome,
            ':celular' => '00000000000',
            ':email' => $usremail,
            ':senha' => $pass,
            ':icone' => 'nulo', 
            ':tipo' => 0 
        ]);
 
        $txtdois = "SELECT * FROM usr_usuario WHERE usr_email = :email";
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

            session_start();
            session_regenerate_id(true);
            $_SESSION['usr_obj'] = serialize($obj);
            header("location: completeRegister.php");
            exit();
        } else {
            throw new Exception("Erro ao obter usuário recém-criado.");
        }
    } catch (PDOException $erro) {
        echo "
            <script>
            alert('Não consegui conectar no banco. Erro: " . htmlspecialchars($erro->getMessage()) . "');
            window.location.href = 'index.php';
            </script>
        ";
    } catch (Exception $erro) {
        echo "
            <script>
            alert('Erro: " . htmlspecialchars($erro->getMessage()) . "');
            window.location.href = 'index.php';
            </script>
        ";
    }
} else {
    echo "Método de requisição não suportado.";
}
