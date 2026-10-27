<?php
    require_once("conexao.php");

    function exibirFilmes($conexao) {
        $sql = "SELECT * FROM filmes";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "ID: " . $row['id'] . " - Título: " . $row['titulo'] . " - Ano: " . $row['ano'] . " - Diretor: " . $row['diretor'] . " - País: " . $row['pais'] . " - Diária: R$ " . $row['diaria'] . " - Status: " . $row['status'] . " - Imagem: " . $row['imagem_url'] . " - IMDB: " . $row['imdb'] . "<br>";
            }
        } else {
            echo "Nenhum filme encontrado";
        }
    }

    function buscarFilme($conexao, $id) {
        $sql = "SELECT * FROM filmes WHERE id = $id";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "ID: " . $row['id'] . " - Título: " . $row['titulo'] . " - Ano: " . $row['ano'] . " - Diretor: " . $row['diretor'] . " - País: " . $row['pais'] . " - Diária: R$ " . $row['diaria'] . " - Status: " . $row['status'] . " - Imagem: " . $row['imagem_url'] . " - IMDB: " . $row['imdb'] . "<br>";
            }
        } else {
            echo "Nenhum filme encontrado";
        }
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
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            echo "Filme editado com sucesso";
        } else {
            echo "Erro ao editar filme";
        }
    }

    function deletarFilme($conexao, $id) {
        $sql = "DELETE FROM filmes WHERE id = $id";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            echo "Filme deletado com sucesso";
        } else {
            echo "Erro ao deletar filme";
        }
    }
?>