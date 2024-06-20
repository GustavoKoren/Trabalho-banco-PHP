<?php
include('../conexao.php');
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'adm') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query para deletar o filme do banco de dados
    $sql = "DELETE FROM filmes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Filme deletado com sucesso!";
    } else {
        echo "Erro ao deletar o filme: " . $conn->error;
    }
} else {
    echo "ID do filme não especificado ou método HTTP incorreto.";
}
?>
