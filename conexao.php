<?php
$host = "localhost";
$db = "agendak13";
$user = "root";
$pass= "";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli->connect_errno){
    die("Falha na conexao do banco de dados");
}