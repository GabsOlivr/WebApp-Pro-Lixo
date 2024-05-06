<?php

    require("conexao.php");
    require("usrclass.php");

    //if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['entrar'])) {
    if($_SERVER['REQUEST_METHOD']=="POST"){

        $usremail=$_POST['usremail'];
        $usrpass=$_POST['usrsenha'];
        
        $conn = new conexaoBD();
        $obj = new usrclass();

        try{
            $conecta = new PDO($conn->dns, $conn->username, $conn->password);
            $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $texto = "SELECT usr_senha FROM usr_usuario WHERE usr_email = '".$usremail."'";
            $dados=$conecta->query($texto);
            $hash = null;
            foreach($dados as $linha){
                $hash = $linha['usr_senha'];
            }
            if (is_null($hash)) {
                //Mudei o echo pra voltar pra tela de login depois do alert,
                //mas talvez isso aqui mude, pq é client-side e etc
                echo "
                    <script>
                    alert('Usuário inexistente!');
                    window.location.href = 'loginRegister.php';
                    </script>
                ";
            }
            else {
                if (password_verify($usrpass, $hash)) {
                    
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
                    if($obj->usuCell == '00000000000'){
                        session_start();
                        $_SESSION['usr_obj'] = serialize($obj);
                        header("location: completeRegister.php");
                    }else{                  
                        session_start();
                        $_SESSION['usr_obj'] = serialize($obj);
                        header("location: userpage.php");
                    }
                    
                } else {
                    //Aqui a mesma coisa, coloquei redirecionamento, mas é client-side oq é meio pá
                    echo "
                    <script>
                    alert('Senha inválida.');
                    window.location.href = 'loginRegister.php';
                    </script>
                ";
                }
            }
            
        }
        catch(PDOException $erro){
            echo "{$erro}";
        }
    }else {
        echo "N está funcionando :(";
    }

?>