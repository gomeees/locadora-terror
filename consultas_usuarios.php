<?php
    require_once("conexao.php");

    function exibirUsuarios($conexao) {
        $sql = "SELECT * FROM usuarios";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "ID: " . $row['id'] . " - Nome: " . $row['nome'] . " - Sobrenome: " . $row['sobrenome'] . " - Data de Nascimento: " . $row['data_nascimento'] . " - Email: " . $row['email'] . " - Criado em: " . $row['criado_em'] . "<br>";
            }
        } else {
            echo "Nenhum usuário encontrado";
        }
    }

    function buscarUsuario($conexao, $id) {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            echo "ID: " . $row['id'] . " - Nome: " . $row['nome'] . " - Sobrenome: " . $row['sobrenome'] . " - Data de Nascimento: " . $row['data_nascimento'] . " - Email: " . $row['email'] . " - Criado em: " . $row['criado_em'] . "<br>";
        } else {
            echo "Nenhum usuário encontrado";
        }
    }

    function inserirUsuario($conexao, $nome, $sobrenome, $data_nascimento, $email) {
        $sql = "INSERT INTO usuarios (nome, sobrenome, data_nascimento, email) VALUES ('$nome', '$sobrenome', '$data_nascimento', '$email')";
        $resultado = mysqli_query($conexao, $sql);
        if ($resultado) {
            echo "Usuário inserido com sucesso<br>";
        } else {
            echo "Erro ao inserir usuário<br>";
        }
    }

    function editarUsuario($conexao, $id, $nome, $sobrenome, $data_nascimento, $email) {
        $sql = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', data_nascimento = '$data_nascimento', email = '$email' WHERE id = $id";
        $resultado = mysqli_query($conexao, $sql);
        if ($resultado) {
            echo "Usuário editado com sucesso<br>";
        } else {
            echo "Erro ao editar usuário<br>";
        }
    }

    function deletarUsuario($conexao, $id) {
        $sql = "DELETE FROM usuarios WHERE id = $id";
        $resultado = mysqli_query($conexao, $sql);
        if ($resultado) {
            echo "Usuário deletado com sucesso<br>";
        } else {
            echo "Erro ao deletar usuário<br>";
        }
    }
?>