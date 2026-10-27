<?php
    $server = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "locadora";
    $conexao = mysqli_connect($server, $usuario, $senha, $banco);
    if (mysqli_connect_error()) {
        die("Erro de conexão com o banco de dados: " . mysqli_connect_error());
    }
    mysqli_set_charset($conexao, "utf8mb4");
?>