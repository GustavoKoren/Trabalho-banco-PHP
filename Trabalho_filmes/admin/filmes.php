<?php
include('../conexao.php');
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'adm') {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM filmes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Filmes - Administração</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>


        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
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

        .container {
            max-width: 800px;
            margin: 20px auto; 
            background-color: #fff;
            padding: 20px; 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table td {
            background-color: #fff;
        }

        table td a {
            color: #007bff;
            text-decoration: none;
        }

        table td a:hover {
            text-decoration: underline;
        }

        header {
        background-color: #333;
        color: white;
        padding: 10px 0;
        text-align: center;
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

        <footer>
        <p>&copy; 2024 Plataforma de Filmes. Todos os direitos reservados.</p>
        </footer>

    <div class="container">
        <h1>Lista de Filmes - Administração</h1>
        <table>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>URL</th>
                <th>Ações</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['titulo'] . "</td>";
                    echo "<td>" . $row['descricao'] . "</td>";
                    echo "<td>" . $row['categoria'] . "</td>";
                    echo "<td><a href='" . $row['url'] . "' target='_blank'>Assistir</a></td>";
                    echo "<td><a href='editar_filme.php?id=" . $row['id'] . "'>Editar</a> | <a href='excluir_filme.php?id=" . $row['id'] . "'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum filme encontrado.</td></tr>";
            }
            ?>
        </table>

        
    </div>

    
</body>
</html>
