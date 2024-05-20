<?php
$erros = array();
$nome = '';
$cpf = '';
$email = '';
$data = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('conexao.php');

    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $data = isset($_POST['data']) ? $_POST['data'] : '';

    if (empty($nome)){
        $erros[] = "Preencha o nome";
    }
    if (empty($cpf)){
        $erros[] = "Preencha o CPF";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erros[] = "Preencha um E-mail válido";
    }
    if (empty($data)){
        $erros[] = "Preencha a Data de nascimento";
    }
    if (!empty($data)){
        $pedacos = explode('/', $data);
        if(count($pedacos) == 3 ){
            $data = implode('-',array_reverse($pedacos));
        } else {
            $erros[] = "Data de nascimento inválida";
        }
    }

    if(empty($erros)) {
        $sql_code = "INSERT INTO dados(nome, cpf, email, data) VALUES ('$nome', '$cpf', '$email', '$data')";
        if ($mysqli->query($sql_code)) {
            echo "<p><b>Cliente cadastrado com sucesso</b></p>";
            $nome = $cpf = $email = $data = '';
        } else {
            $erros[] = "Erro ao cadastrar cliente" . $mysqli->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <title>Cadastro</title>
    <div class = "cadastro"><h1>Cadastrar Contato<h1></div>
</head>
<body>
    <?php if (!empty($erros)) : ?>
        <ul>
            <?php foreach ($erros as $erro) : ?>
                <li><?php echo $erro; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class = "form">
    <form method="POST" action="">
        <div class = "form">
        <p>
            <label>Nome:</label>
            <input value="<?php echo htmlspecialchars($nome); ?>" name="nome" type="text">
        </p>
        <p>
            <label>CPF:</label>
            <input value="<?php echo htmlspecialchars($cpf); ?>" name="cpf" type="text">
        </p>
        <p>
            <label>E-mail:</label>
            <input value="<?php echo htmlspecialchars($email); ?>" name="email" type="text">
        </p>
        <p>
            <label>Data de nascimento (DD/MM/AAAA):</label>
            <input value="<?php echo htmlspecialchars($data); ?>" name="data" type="text">
        </p>
        <p>
            <button type="submit">Salvar Informações</button>
        </p>
    </form>
    </div>
    <div class="voltar">
    <a href = "dados.php">
        <button>Voltar para contatos</button>
    </a>
    </div>
</body>
</html>