<?php
include('conexao.php');
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Filmes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image: url(imagens/background3.jpg);">
    <?php include('includes/header.php'); ?>

    

    <div class="filmes-container">
        <h1>Filmes</h1>

        <form method="post" action="filmes.php">
            <label for="categoria">Selecione a Categoria de Interesse:</label>
            <select name="categoria" id="categoria" required>
                <option value="">Escolha uma categoria</option>
                <option value="Ação" <?php if ($categoria == 'Ação') echo 'selected'; ?>>Ação</option>
                <option value="Comédia" <?php if ($categoria == 'Comédia') echo 'selected'; ?>>Comédia</option>
                <option value="Drama" <?php if ($categoria == 'Drama') echo 'selected'; ?>>Drama</option>
                <option value="Ficção Científica" <?php if ($categoria == 'Ficção Científica') echo 'selected'; ?>>Ficção Científica</option>
                <option value="Romance" <?php if ($categoria == 'Romance') echo 'selected'; ?>>Romance</option>
                <!-- Adicione mais categorias conforme necessário -->
            </select>
            <button type="submit">Buscar</button>
        </form>

        <?php
        if ($categoria) {
            $sql = "SELECT * FROM filmes WHERE categoria='$categoria'";
            $result = $conn->query($sql);

            echo "<h2>Filmes da categoria: " . $categoria . "</h2>";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='filme'>";
                    echo "<h3>" . $row['titulo'] . "</h3>";
                    echo "<p>" . $row['descricao'] . "</p>";
                    echo "<a href='" . $row['url'] . "'>Assistir</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhum filme encontrado para esta categoria.</p>";
            }
        }
        ?>

    </div>


    <?php include('includes/footer.php'); ?>
</body>
</html>
