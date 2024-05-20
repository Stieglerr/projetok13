<?php
include('conexao.php');

if(isset($_GET['search_term'])) {
    $search_term = $_GET['search_term'];

    $sql = "SELECT dados.*, endereco.*, 
        telefones.tel_comercial, telefones.tel_residencial, telefones.tel_celular AS celular
        FROM dados 
        LEFT JOIN endereco ON dados.id = endereco.dados_id 
        LEFT JOIN telefones ON dados.id = telefones.dados_id 
        WHERE dados.nome LIKE '%$search_term%'";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0){
        echo "<h2>Resultados da Pesquisa</h2>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "Nome: " . $row['nome'] . "<br>";
            if(isset($row['email'])) {
                echo "Email: " . $row['email'] . "<br>";
            }
            if(isset($row['cpf'])) {
                echo "CPF: " . $row['cpf'] . "<br>";
            }
            if(isset($row['data'])) {
                echo "Data de nascimento: " . date("d/m/y", strtotime($row['data'])) . "<br>";
            }
            if(isset($row['cep'])) {
                echo "CEP: " . $row['cep'] . "<br>";
            }
            if(isset($row['rua'])) {
                echo "Rua: " . $row['rua'] . "<br>";
            }
            if(isset($row['numero'])) {
                echo "Número: " . $row['numero'] . "<br>";
            }
            if(isset($row['bairro'])) {
                echo "Bairro: " . $row['bairro'] . "<br>";
            }
            if(isset($row['cidade'])) {
                echo "Cidade: " . $row['cidade'] . "<br>";
            }
            if(isset($row['estado'])) {
                echo "Estado: " . $row['estado'] . "<br>";
            }
            if(!empty($row['tel_comercial'])) {
                echo "Telefone Comercial: " . $row['tel_comercial'] . "<br>";
            } else {
                echo "Telefone Comercial: Não disponível<br>";
            }
            if(!empty($row['tel_residencial'])) {
                echo "Telefone Residencial: " . $row['tel_residencial'] . "<br>";
            } else {
                echo "Telefone Residencial: Não disponível<br>";
            }
            if(!empty($row['celular'])) {
                echo "Celular: " . $row['celular'] . "<br>";
            } else {
                echo "Celular: Não disponível<br>";
            }
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nenhum contato encontrado.</p>";
    }
} else {
    echo "<p>Digite um nome.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="busca.css">
    <title>Pesquisar contatos</title>
</head>
<body>
<body>
    <div class="pesquisa">
        <h1>Pesquisar Contatos</h1>
    </div>
    <div class="form">
        <form method="GET"> 
            <label for="search_term">Nome do Contato:</label>
            <input type="text" id="search_term" name="search_term">
            <button type="submit">Pesquisar</button>
        </form>
    </div>
    <div class="botao">
        <a href="dados.php">
            <button>Voltar para contatos</button>
        </a>
    </div>
</body>
</body>
</html>
