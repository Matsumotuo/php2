<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idFornecedor = $_POST['idFornecedor'];
    $razaoSocial = $_POST['razaoSocial'];
    $nomeFantasia = $_POST['nomeFantasia'];
    $cnpj = preg_replace('/\D/', '', $_POST['cnpj']);
    $responsavel = $_POST['responsavel'];
    $email = $_POST['email'];
    $ddd = $_POST['ddd'];
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);

    $sql = "UPDATE prova_final SET razaoSocial=:razaoSocial, nomeFantasia=:nomeFantasia, cnpj=:cnpj, responsavel=:responsavel, email=:email, ddd=:ddd, telefone=:telefone WHERE idFornecedor=:idFornecedor";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':razaoSocial', $razaoSocial);
        $stmt->bindParam(':nomeFantasia', $nomeFantasia);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':responsavel', $responsavel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':ddd', $ddd);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':idFornecedor', $idFornecedor);
        $stmt->execute();
        echo "Fornecedor atualizado com sucesso!";
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
    <title>Editar Fornecedor</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="listar.php">Listar</a></li>
            <li><a href="cadastrar.php">Cadastrar</a></li>
        </ul>
    </nav>
    <main>
        <h1>Editar Fornecedor</h1>
        <form action="editar.php" method="post">
            <input type="hidden" name="idFornecedor" value="<?php echo $row['idFornecedor']; ?>">
            <label for="razaoSocial">Razão Social:</label>
            <input type="text" id="razaoSocial" name="razaoSocial" maxlength="50" value="<?php echo $row['razaoSocial']; ?>" ><br>
            
            <label for="nomeFantasia">Nome Fantasia:</label>
            <input type="text" id="nomeFantasia" name="nomeFantasia" maxlength="50" value="<?php echo $row['nomeFantasia']; ?>" ><br>
            
            <label for="cnpj">CNPJ:</label>
            <input type="text" id="cnpj" name="cnpj" maxlength="11"  value="<?php echo $row['cnpj']; ?>" ><br>
            
            <label for="responsavel">Responsável:</label>
            <input type="text" id="responsavel" name="responsavel" maxlength="50" value="<?php echo $row['responsavel']; ?>" ><br>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" ><br>
            
            <label for="ddd">DDD:</label>
            <input type="text" id="ddd" name="ddd" maxlength="3" oninput="mascararDDD(this)" value="<?php echo $row['ddd']; ?>" ><br>
            
            <label for="telefone">Telefone Celular:</label>
            <input type="text" id="telefone" name="telefone" maxlength="10" oninput="mascararTelefone(this)" value="<?php echo $row['telefone']; ?>" ><br>
            
            <input type="submit" value="Atualizar">
        </form>
    </main>
</body>
</html>
