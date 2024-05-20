<?php

require("../conexao.php");
require("../usrclass.php");

session_start();
if (isset($_SESSION['usr_obj'])) {
   $usu_obj = unserialize($_SESSION['usr_obj']);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $qntd = $_POST['quantidade'];
        $tipo = $_POST['tipoLixo'];
        $descricao = $_POST['descricao'];
        $conn = new conexaoBD();

        try {

            $conecta = new PDO($conn->dns, $conn->username, $conn->password);
            $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $txtum = "SELECT end_id FROM end_endereco where usr_id = '".$usu_obj->usuId."'";
            $consulta = $conecta->query($txtum);
            foreach ($consulta as $linha) {
                $enderecoId = $linha['end_id'];
            }

            $texto = "INSERT INTO slc_solicitacao VALUES (0, '".$tipo."', '".$qntd."', 0, null, '".$descricao."', '".$enderecoId."')";
            $conecta->exec($texto);
            header("location: mainSolicitante.php");

            
        } catch (PDOException $erro) {
            echo "
                    <script>
                    alert('Não consegui conectar no banco.');
                    window.location.href = 'index.php';
                    </script>
                ";
        }
    }else{
        echo "Onde foi que eu errei? 100% eu acertei, onde foi que eu errei???";
    }
} else {
    echo "
         <script>
            alert('Tá fazeno oq aqui, papai?.');
            window.location.href = 'index.php';
            </script>
        ";
}

?>