<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processo de exclusão
    $idFornecedor = $_POST['idFornecedor'];
    
    $sql = "DELETE FROM prova_final WHERE idFornecedor=:idFornecedor";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idFornecedor', $idFornecedor);
        $stmt->execute();
        echo "Fornecedor excluído com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {

    if (isset($_GET['id'])) {
        $idFornecedor = $_GET['id'];
        $sql = "SELECT * FROM prova_final WHERE idFornecedor=:idFornecedor";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idFornecedor', $idFornecedor);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                echo "Fornecedor não encontrado.";
                exit;
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            exit;
        }
    } else {
        echo "ID do fornecedor não fornecido.";
        exit;
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Fornecedor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="listar.php">Listar</a></li>
            <li><a href="cadastrar.php">Cadastrar</a></li>

        </ul>
    </nav>
    <main>
        <h1>Excluir Fornecedor</h1>
        <?php if (isset($row)) { ?>
            <form action="excluir.php" method="post">
                <input type="hidden" name="idFornecedor" value="<?php echo $idFornecedor; ?>">
                <p>Tem certeza que deseja excluir o fornecedor <?php echo $row['razaoSocial']; ?>?</p>
                <input type="submit" value="Excluir">
            </form>
        <?php } ?>
    </main>
</body>
</html>
