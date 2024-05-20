<?php include('conexao.php');
$sql_dados = "SELECT * FROM dados";
$query_dados = $mysqli->query($sql_dados) or die($mysqli->error);
$num_dados = $query_dados->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dados.css">
    <title>Dados</title>
</head>
<body>
    <div class="lista"><h1>Lista de Contatos</h1></div>
    
    <div class="tabela">
        <table border="1" cellpadding="10">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Nascimento</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <?php
                while ($dados = $query_dados->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $dados['id']; ?></td>
                    <td><?php echo $dados['nome']; ?></td>
                    <td><?php echo $dados['cpf']; ?></td>
                    <td><?php echo $dados['email']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($dados['data'])); ?></td>
                    <td>
                        <a href="endereco.php?id=<?php echo $dados['id'];?>">Endereço</a>
                        <a href="telefone.php?id=<?php echo $dados['id'];?>">Telefone</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <div class="cadastro">
        <a href="cadastro.php">
            <button>Ir para o Cadastro</button>
        </a>
    </div>
    <br>
    <div class="busca">
        <a href="busca.php">
            <button>Ir para Busca</button>
        </a>
    </div>
</body>
</html>
