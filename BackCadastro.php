<?php

    require("conexao.php");
    require("usrclass.php");

    //if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
    if($_SERVER['REQUEST_METHOD']=="POST"){

        $usrnome = $_POST['name'];
        $usremail = $_POST['email'];
        $usrpass = $_POST['senha'];

        $pass = password_hash($usrpass, PASSWORD_DEFAULT);

        $conn = new conexaoBD();
        $obj = new usrclass();

        try {
            $conecta = new PDO($conn->dns, $conn->username, $conn->password);
            $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $texto = "INSERT INTO usr_usuario VALUES (0,'".$usrnome."','00000000000','".$usremail."','".$pass."','nulo',0)";
            $conecta->exec($texto);
            
            //Isso aqui tudo é pra redirecionar pra página de conclusão do perfil
            $txtdois = "SELECT * FROM usr_usuario WHERE usr_email = '".$usremail."'";
            $consulta=$conecta->query($txtdois);
            foreach($consulta as $linha){
                $obj->usuId = $linha['usr_id'];
                $obj->usuNome = $linha['usr_nome'];
                $obj->usuCell = $linha['usr_celular'];
                $obj->usuEmail = $linha['usr_email'];
                $obj->usuSenha = $linha['usr_senha'];
                $obj->usuIcone = $linha['usr_icone'];
                $obj->usuTipo = $linha['usr_tipo'];
            }                  
            session_start();
            $_SESSION['usr_obj'] = serialize($obj);
            header("location: completeRegister.php");
            //Aqui acaba o redirecionamento
        } catch (PDOException $erro) {
            echo "
                    <script>
                    alert('Não consegui conectar no banco.');
                    window.location.href = 'index.php';
                    </script>
                ";
        }
    }else{
        echo "Não deu certo kk";
    }

?>
