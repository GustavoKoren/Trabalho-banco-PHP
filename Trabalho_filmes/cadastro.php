<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $tipo = $_POST['tipo'];
    

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo ) VALUES ('$nome', '$email', '$senha', '$tipo')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image: url(imagens/background3.jpg);">
    <form method="post" action="cadastro.php">
        <label>Nome:</label>
        <input type="text" name="nome" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br>
        <label>Tipo de Usuário:</label>
        <select name="tipo">
            <option value="usuario">Usuário</option>
            <option value="adm">Administrador</option>
        </select><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
