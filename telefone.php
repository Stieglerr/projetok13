<?php
$erros = array();
include('conexao.php');

if(isset($_GET['id'])) {
    $dados_id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['tel_comercial']) && isset($_POST['tel_residencial']) && isset($_POST['tel_celular'])) {
            $tel_comercial = $_POST['tel_comercial'];
            $tel_residencial = $_POST['tel_residencial'];
            $tel_celular = $_POST['tel_celular'];
            if (empty($tel_comercial) && empty($tel_residencial) && empty($tel_celular)) {
                $erros[] = "Preencha pelo menos um dos campos.";
            } else {
                if (empty($erros)) {
                    $sql_check = "SELECT * FROM telefones WHERE dados_id = '$dados_id'";
                    $result_check = $mysqli->query($sql_check);

                    if($result_check->num_rows > 0) {
                        $sql_update = "UPDATE telefones SET tel_comercial='$tel_comercial', tel_residencial='$tel_residencial', tel_celular='$tel_celular' WHERE dados_id='$dados_id'";
                        if ($mysqli->query($sql_update)) {
                            echo "<p><b>Telefones atualizados com sucesso.</b></p>";
                        } else {
                            $erros[] = "Erro ao atualizar telefones" . $mysqli->error;
                        }
                    } else {
                        $sql_code = "INSERT INTO telefones (dados_id, tel_comercial, tel_residencial, tel_celular) VALUES ('$dados_id', '$tel_comercial', '$tel_residencial', '$tel_celular')";
                        if ($mysqli->query($sql_code)) {
                            echo "<p><b>Telefones cadastrados com sucesso.</b></p>";
                            $_POST = array(); 
                        } else {
                            $erros[] = "Erro ao cadastrar telefones" . $mysqli->error;
                        }
                    }
                }
            }
        }
    }   

} else {
    $erros[] = "ID dos dados não encontrado na URL";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="telefone.css">
    <div class = "cadastro"><h1>Cadastrar Telefones<h1></div>
</head>
<body>
    <?php if (!empty($erros)) : ?>
        <ul>
            <?php foreach ($erros as $erro) : ?>
                <li><?php echo $erro; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class = form>
    <form method="POST" action="">
        <input type="hidden" name="dados_id" value="<?php echo $dados_id; ?>">
        <p>
            <label>Telefone Comercial:</label>
            <input value="<?php if (isset($_POST['tel_comercial'])) echo $_POST['tel_comercial']; ?>" name="tel_comercial" type="text">
        </p>
        <p>
            <label>Telefone Residencial:</label>
            <input value="<?php if (isset($_POST['tel_residencial'])) echo $_POST['tel_residencial']; ?>" name="tel_residencial" type="text">
        </p>
        <p>
            <label>Telefone Celular:</label>
            <input value="<?php if (isset($_POST['tel_celular'])) echo $_POST['tel_celular']; ?>" name="tel_celular" type="text">
        </p>
        <p>
            <div class = "botao"><button type="submit">Salvar Telefones</button></div>
        </p>
    </form>
    </div>
    <div class ="voltar">
    <a href = "dados.php">
        <button>Voltar para contatos</button>
        </a>
    </div>
</body>
</html>

