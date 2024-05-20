<?php
$erros = array();
include('conexao.php');
$estados = array(
    "AC" => "Acre",
    "AL" => "Alagoas",
    "AP" => "Amapá",
    "AM" => "Amazonas",
    "BA" => "Bahia",
    "CE" => "Ceará",
    "DF" => "Distrito Federal",
    "ES" => "Espírito Santo",
    "GO" => "Goiás",
    "MA" => "Maranhão",
    "MT" => "Mato Grosso",
    "MS" => "Mato Grosso do Sul",
    "MG" => "Minas Gerais",
    "PA" => "Pará",
    "PB" => "Paraíba",
    "PR" => "Paraná",
    "PE" => "Pernambuco",
    "PI" => "Piauí",
    "RJ" => "Rio de Janeiro",
    "RN" => "Rio Grande do Norte",
    "RS" => "Rio Grande do Sul",
    "RO" => "Rondônia",
    "RR" => "Roraima",
    "SC" => "Santa Catarina",
    "SP" => "São Paulo",
    "SE" => "Sergipe",
    "TO" => "Tocantins"
);
if(isset($_GET['id'])) {
    $dados_id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['cep']) && isset($_POST['rua']) && isset($_POST['numero']) && isset($_POST['bairro']) && isset($_POST['cidade']) && isset($_POST['estado'])) {
            $cep = $_POST['cep'];
            $rua = $_POST['rua'];
            $numero = $_POST['numero'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];

            if (empty($cep) || empty($rua) || empty($numero) || empty($bairro) || empty($cidade) || empty($estado)) {
                $erros[] = "Preencha todos os campos";
            } else {
                if (empty($erros)) {
                    $sql_code = "INSERT INTO endereco (dados_id, cep, rua, numero, bairro, cidade, estado) VALUES ('$dados_id', '$cep', '$rua', '$numero', '$bairro', '$cidade', '$estado')";
                    if ($mysqli->query($sql_code)) {
                        echo "<p><b>Endereço cadastrado com sucesso!!!</b></p>";
                        $_POST = array(); 
                    } else {
                        $erros[] = "Erro ao cadastrar endereço: " . $mysqli->error;
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
    <link rel="stylesheet" href="endereco.css">
    <title>Cadastrar Endereço</title>
<div class = "cadastro"><h1>Cadastrar Endereço<h1></div>
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
            <label>CEP:</label>
            <input value="<?php if (isset($_POST['cep'])) echo $_POST['cep']; ?>" name="cep" type="text">
        </p>
        <p>
            <label>Rua:</label>
            <input value="<?php if (isset($_POST['rua'])) echo $_POST['rua']; ?>" name="rua" type="text">
        </p>
        <p>
            <label>Número:</label>
            <input value="<?php if (isset($_POST['numero'])) echo $_POST['numero']; ?>" name="numero" type="text">
        </p>
        <p>
            <label>Bairro:</label>
            <input value="<?php if (isset($_POST['bairro'])) echo $_POST['bairro']; ?>" name="bairro" type="text">
        </p>
        <p>
            <label>Cidade:</label>
            <input value="<?php if (isset($_POST['cidade'])) echo $_POST['cidade']; ?>" name="cidade" type="text">
        </p>
        <p>
            <label>Estado:</label>
            <select name="estado">
                <?php foreach ($estados as $sigla => $nome) : ?>
                    <option value="<?php echo $sigla; ?>"><?php echo $nome; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <div class = "botao"><button type="submit">Salvar Informações</button></div>
        </p>
    </form>
    </div>
    <div class = "voltar">
        <div class = botao>
        <a href = "dados.php">
            <button>Voltar para contatos</button>
        </a>   
    </div>
</body>
</html>
