<?php
    require_once("conexao.php");

    function exibirFilmes($conexao) {
        $sql = "SELECT * FROM filmes";
        $resultado = mysqli_query($conexao, $sql);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    function buscarFilme($conexao, $id) {
        $sql = "SELECT * FROM filmes WHERE id = $id";
        $resultado = mysqli_query($conexao, $sql);
        return mysqli_fetch_assoc($resultado);
    }

    function inserirFilme($conexao, $titulo, $ano, $diretor, $pais, $diaria, $status, $imagem_url, $imdb) {
        $sql = "INSERT INTO filmes (titulo, ano, diretor, pais, diaria, status, imagem_url, imdb) VALUES ('$titulo', $ano, '$diretor', '$pais', $diaria, '$status', '$imagem_url', '$imdb')";
        $resultado = mysqli_query($conexao, $sql);
        
        if ($resultado) {
            echo "Filme inserido com sucesso";
        } else {
            echo "Erro ao inserir filme";
        }
    }

    function editarFilme($conexao, $id, $titulo, $ano, $diretor, $pais, $diaria, $status, $imagem_url, $imdb) {
        $sql = "UPDATE filmes SET titulo = '$titulo', ano = $ano, diretor = '$diretor', pais = '$pais', diaria = $diaria, status = '$status', imagem_url = '$imagem_url', imdb = '$imdb' WHERE id = $id";
        return mysqli_query($conexao, $sql);
    }

    function deletarFilme($conexao, $id) {
        $sql = "DELETE FROM filmes WHERE id = $id";
        return mysqli_query($conexao, $sql);
    }
?>