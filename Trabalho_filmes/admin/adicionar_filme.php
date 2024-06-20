<?php
include('../conexao.php');


session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'adm') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $url = $_POST['url'];

    $sql = "INSERT INTO filmes (titulo, descricao, categoria, url) VALUES ('$titulo', '$descricao', '$categoria', '$url')";
    
    if ($conn->query($sql) === TRUE) {
        header("Refresh:1; url=http://localhost/Trabalho_filmes/admin/filmes.php", true, 303);
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Filme</title>
    <link rel="stylesheet" href="../css/style.css"> 

    <style>

        

        /* Estilos para o corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            
        }

        /* Estilos para o cabeçalho */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #b22222;
        }

        /* Estilos para o formulário */
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        form input[type=text], 
        form input[type=url] {
            width: calc(100% - 22px); /* Considera a largura do padding e da borda */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        form textarea {
            width: calc(100% - 22px); /* Considera a largura do padding e da borda */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            resize: vertical; /* Permite redimensionamento vertical */
        }

        form button[type=submit] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form button[type=submit]:hover {
            background-color: #0056b3;
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            form {
                width: 100%;
            }
        }

        header {
        background-color: #333;
        color: white;
        padding: 10px 0;
        text-align: center;
        }

        footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        }

    </style>
    
</head>

<body style="background-image: url(../admin/_background3.jpg);">

    <header>
            <nav>
                <ul>
                    
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'adm'): ?>
                        <li><a href="/Trabalho_filmes/admin/adicionar_filme.php">Adicionar Filme</a></li>
                    <?php endif; ?>
                    <li><a href="/Trabalho_filmes/admin/filmes.php">Filmes</a></li>
                    <?php if (isset($_SESSION['id'])): ?>
                        <li><a href="/Trabalho_filmes/login.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/Trabalho_filmes/login.php">Login</a></li>
                        <li><a href="/Trabalho_filmes/cadastro.php">Cadastro</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

    

    <br>
    <h1>Adicionar Novo Filme</h1>
    <form method="post" action="adicionar_filme.php">
        <label>Título:</label>
        <input type="text" name="titulo" required><br>
        <label>Descrição:</label>
        <textarea name="descricao" required></textarea><br>
        <label>Categoria:</label>
        <input type="text" name="categoria" required><br>
        <label>URL:</label>
        <input type="url" name="url" required><br>
        <button type="submit">Adicionar</button>
    </form>

    <footer>
        <p>&copy; 2024 Plataforma de Filmes. Todos os direitos reservados.</p>
    </footer>
</body>
</html>



