<?php

require("conexao.php");
require("usrclass.php");
session_start();

if (!isset($_SESSION['usr_obj'])) {
    header("location: index.php");
    exit();
}

$usu_obj = unserialize($_SESSION['usr_obj']);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['end'])) {
        $numeroFormatado = filter_var($_POST['celular']);
        $usrnumber = preg_replace('/\D/', '', $numeroFormatado);
        $usrtype = filter_var($_POST['tipoUser'], FILTER_VALIDATE_INT);
        $usricon = filter_var($_POST['iconValue']);
        $usrid = $usu_obj->usuId;
        $usrend = filter_var($_POST['end']);
        $usrlat = filter_var($_POST['latcampo'], FILTER_VALIDATE_FLOAT);
        $usrlng = filter_var($_POST['lngcampo'], FILTER_VALIDATE_FLOAT);

        if ($usrtype === false || $usrlat === false || $usrlng === false) {
            header("location: completeRegister.php");
            exit();
        }
    } else {
        header("location: completeRegister.php");
        exit();
    }

    $conn = new conexaoBD();

    try {
        $conecta = new PDO($conn->dns, $conn->username, $conn->password);
        $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $updateQuery = "UPDATE usr_usuario SET usr_celular = :usrnumber, usr_icone = :usricon, usr_tipo = :usrtype WHERE usr_id = :usrid";
        $updateStmt = $conecta->prepare($updateQuery);
        $updateStmt->bindParam(':usrnumber', $usrnumber);
        $updateStmt->bindParam(':usricon', $usricon);
        $updateStmt->bindParam(':usrtype', $usrtype);
        $updateStmt->bindParam(':usrid', $usrid);
        $updateStmt->execute();

        $selectQuery = "SELECT * FROM usr_usuario WHERE usr_id = :usrid";
        $selectStmt = $conecta->prepare($selectQuery);
        $selectStmt->bindParam(':usrid', $usrid);
        $selectStmt->execute();
        $result = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $usu_obj->usuId = $result['usr_id'];
            $usu_obj->usuNome = $result['usr_nome'];
            $usu_obj->usuCell = $result['usr_celular'];
            $usu_obj->usuEmail = $result['usr_email'];
            $usu_obj->usuSenha = $result['usr_senha'];
            $usu_obj->usuIcone = $result['usr_icone'];
            $usu_obj->usuTipo = $result['usr_tipo'];
            $usu_obj->usuEnd = $usrend;
            $usu_obj->usuLat = $usrlat;
            $usu_obj->usuLng = $usrlng;
        }

        $insertQuery = "INSERT INTO end_endereco (end_completo, end_latitude, end_longitude, usr_id) VALUES (:usrend, :usrlat, :usrlng, :usrid)";
        $insertStmt = $conecta->prepare($insertQuery);
        $insertStmt->bindParam(':usrend', $usrend);
        $insertStmt->bindParam(':usrlat', $usrlat);
        $insertStmt->bindParam(':usrlng', $usrlng);
        $insertStmt->bindParam(':usrid', $usrid);
        $insertStmt->execute();

        $_SESSION['usr_obj'] = serialize($usu_obj);

        if ($usu_obj->usuTipo == 0) {
            header("location: ./userpages/mainSolicitante.php");
        } else {
            header("location: ./userpages/mainColetor.php");
        }
        exit();

    } catch (PDOException $erro) {
        echo "
            <script>
            alert('Não consegui conectar no banco.');
            window.location.href = 'index.php';
            </script>
        ";
        exit();
    }
} else {
    echo "Não funcionou paizão, e agora?";
}

?>