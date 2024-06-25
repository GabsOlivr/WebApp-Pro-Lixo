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

        if (empty($qntd) || empty($tipo) || empty($descricao)) {
            echo "
                <script>
                alert('Todos os campos são obrigatórios.');
                window.location.href = 'mainSolicitante.php';
                </script>
            ";
            exit();
        }

        $conn = new conexaoBD();

        try {
            $conecta = new PDO($conn->dns, $conn->username, $conn->password);
            $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $txtum = "SELECT end_id FROM end_endereco WHERE usr_id = :usr_id";
            $stmt = $conecta->prepare($txtum);
            $stmt->bindParam(':usr_id', $usu_obj->usuId);
            $stmt->execute();
            $enderecoId = $stmt->fetchColumn();

            if (!$enderecoId) {
                echo "
                    <script>
                    alert('Endereço não encontrado.');
                    window.location.href = 'mainSolicitante.php';
                    </script>
                ";
                exit();
            }

            $texto = "INSERT INTO slc_solicitacao (slc_id, tipo, quantidade, status, descricao, end_id) VALUES (0, :tipo, :quantidade, 0, null, :descricao, :enderecoId)";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':quantidade', $qntd);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':enderecoId', $enderecoId);
            $stmt->execute();

            header("location: mainSolicitante.php");
            exit();
        } catch (PDOException $erro) {
            echo "
                <script>
                alert('Erro ao conectar no banco: {$erro->getMessage()}');
                window.location.href = 'index.php';
                </script>
            ";
            exit();
        }
    } else {
        echo "
            <script>
            alert('Método de requisição inválido.');
            window.location.href = 'mainSolicitante.php';
            </script>
        ";
        exit();
    }
} else {
    echo "
        <script>
        alert('Sessão não iniciada.');
        window.location.href = 'index.php';
        </script>
    ";
    exit();
}
?>