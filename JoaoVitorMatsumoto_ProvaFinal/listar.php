<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Fornecedores</title>
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
        <h1>Listar Fornecedores</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Responsável</th>
                    <th>E-mail</th>
                    <th>DDD</th>
                    <th>Telefone Celular</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexao.php';

                $sql = "SELECT * FROM prova_final";
                try {
                    $stmt = $conn->query($sql);
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                <td>" . $row["idFornecedor"] . "</td>
                                <td>" . $row["razaoSocial"] . "</td>
                                <td>" . $row["nomeFantasia"] . "</td>
                                <td>" . $row["cnpj"] . "</td>
                                <td>" . $row["responsavel"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["ddd"] . "</td>
                                <td>" . $row["telefone"] . "</td>
                                <td>
                                    <a href='editar.php?id=" . $row["idFornecedor"] . "'>Editar</a> | 
                                    <a href='excluir.php?id=" . $row["idFornecedor"] . "'>Excluir</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Nenhum fornecedor encontrado</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }

                $conn = null;
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
