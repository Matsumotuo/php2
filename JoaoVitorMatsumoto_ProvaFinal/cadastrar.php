<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="listar.php">Listar</a></li>
            <li><a href="cadastrar.php">Cadastrar</a></li>
        </ul>
    </nav>
    <main>
        <h1>Cadastrar Fornecedor</h1>
        <form action="cadastrar.php" method="post" onsubmit="return">
            <label for="razaoSocial">Razão Social:</label>
            <input type="text" id="razaoSocial" name="razaoSocial" maxlength="50" ><br>
            
            <label for="nomeFantasia">Nome Fantasia:</label>
            <input type="text" id="nomeFantasia" name="nomeFantasia" maxlength="50" ><br>
            
            <label for="cnpj">CNPJ:</label>
            <input type="text" id="cnpj" name="cnpj" maxlength="18" oninput="mascararCNPJ(this)" ><br>
            
            <label for="responsavel">Responsável:</label>
            <input type="text" id="responsavel" name="responsavel" maxlength="50" ><br>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" ><br>
            
            <label for="ddd">DDD:</label>
            <input type="text" id="ddd" name="ddd" maxlength="3"  oninput="mascararDDD(this)"><br>
            
            <label for="telefone">Telefone Celular:</label>
            <input type="text" id="telefone" name="telefone" maxlength="10" oninput="mascararTelefone(this)" ><br>
            
            <input type="submit" value="Cadastrar">
        </form>
    </main>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';
    
    $razaoSocial = $_POST['razaoSocial'];
    $nomeFantasia = $_POST['nomeFantasia'];
    $cnpj = preg_replace('/\D/', '', $_POST['cnpj']);
    $responsavel = $_POST['responsavel'];
    $email = $_POST['email'];
    $ddd = $_POST['ddd'];
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);
    
    $sql = "INSERT INTO prova_final (razaoSocial, nomeFantasia, cnpj, responsavel, email, ddd, telefone) VALUES (:razaoSocial, :nomeFantasia, :cnpj, :responsavel, :email, :ddd, :telefone)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':razaoSocial', $razaoSocial);
        $stmt->bindParam(':nomeFantasia', $nomeFantasia);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':responsavel', $responsavel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':ddd', $ddd);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();
        echo "Fornecedor cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    
    $conn = null;
}
?>

