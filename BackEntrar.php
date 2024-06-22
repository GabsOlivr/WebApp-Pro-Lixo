<?php

    require("conexao.php");
    require("usrclass.php");

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
                
                echo "
                    <script>
                    alert('Usuário inexistente!');
                    window.location.href = 'loginRegister.php';
                    </script>
                ";
            }
            else {
                if (password_verify($usrpass, $hash)) {
                    
                    $txtdois = "SELECT usr_id, usr_celular, usr_email, usr_senha, usr_icone, usr_tipo, end_completo, end_latitude, end_longitude  FROM usr_usuario LEFT JOIN end_endereco USING (usr_id) WHERE usr_email = '".$usremail."'";
                    $consulta=$conecta->query($txtdois);
                    foreach($consulta as $linha){
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

                        $txtres = "SELECT end_completo FROM end_endereco JOIN usr_usuario USING(usr_id) WHERE usr_id = '".$obj->usuId."'";
                        $consultaEnd = $conecta->query($txtres);
                        foreach($consultaEnd as $linha){
                            $obj->usuEnd = $linha['end_completo'];
                        }
                    }
                    if($obj->usuCell == '00000000000'){
                        session_start();
                        $_SESSION['usr_obj'] = serialize($obj);
                        header("location: completeRegister.php");
                    }else{                  
                        session_start();
                        $_SESSION['usr_obj'] = serialize($obj);
                        if( $obj->usuTipo == 0){
                            header("location: ./userpages/mainSolicitante.php");
                        }else{
                            if ( $obj->usuTipo == 1) {
                                header("location: ./userpages/mainColetor.php");
                            }else{
                                header("location: ./userpages/mainAdmin.php"); 
                            }
                        }
                        
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
            
        }
        catch(PDOException $erro){
            echo "{$erro}";
        }
    }else {
        echo "N está funcionando :(";
    }

?>