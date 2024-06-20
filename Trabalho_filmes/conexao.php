<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "plataforma_filmes";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
