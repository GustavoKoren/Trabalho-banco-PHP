<?php
include('../conexao.php');
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'adm') {
    header("Location: ../login.php");
    exit();
}

// Verifica se um filme foi selecionado para edição
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query para obter os dados do filme pelo ID
    $sql = "SELECT * FROM filmes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $titulo = $row['titulo'];
        $descricao = $row['descricao'];
        $categoria = $row['categoria'];
        $url = $row['url'];
    } else {
        echo "Filme não encontrado.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Se for um POST, significa que o formulário de edição foi enviado

    $id = $_POST['id']; // Captura o ID do filme a ser editado

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $url = $_POST['url'];

    // Query para atualizar o filme no banco de dados usando Prepared Statement
    $sql_update = "UPDATE filmes SET titulo=?, descricao=?, categoria=?, url=? WHERE id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssssi", $titulo, $descricao, $categoria, $url, $id);

    if ($stmt->execute()) {
        echo "Filme atualizado com sucesso!";
        header("Location: filmes.php");
        exit();
    } else {
        echo "Erro ao atualizar o filme: " . $stmt->error;
    }
}

// Query para obter todos os filmes (para exibição na lista de seleção)
$sql_filmes = "SELECT id, titulo FROM filmes";
$result_filmes = $conn->query($sql_filmes);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Filme</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
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

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"], input[type="url"], textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
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

    <div class="container">
        <h1>Editar Filme</h1>
        <form method="get">
            <label>Selecione o filme para editar:</label>
            <select name="id">
                <?php while ($row_filme = $result_filmes->fetch_assoc()): ?>
                    <option value="<?php echo $row_filme['id']; ?>"><?php echo htmlspecialchars($row_filme['titulo']); ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Editar</button>
        </form>

        <?php if (isset($id)): ?>
            <h2>Detalhes do Filme Selecionado:</h2>
            <form method="post" action="editar_filme.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <label>Título:</label>
                <input type="text" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required><br>
                <label>Descrição:</label>
                <textarea name="descricao" required><?php echo htmlspecialchars($descricao); ?></textarea><br>
                <label>Categoria:</label>
                <input type="text" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>" required><br>
                <label>URL:</label>
                <input type="url" name="url" value="<?php echo htmlspecialchars($url); ?>" required><br>
                <button type="submit">Atualizar</button>
            </form>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 Plataforma de Filmes. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
