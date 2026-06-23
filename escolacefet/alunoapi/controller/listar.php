<?php
declare(strict_types=1);
require_once "../../util/funcoes.php";
require_once "../model/funcoesBD.php";
 
$alunos = [];
$pdo = getPDO();
 
try{
 /** @var callable $listar */
 $alunos = $listar();
 
} catch (PDOException $e) {
responderJson(["erro" => "erro ao listar alunos"], 400);
 
}
 
responderJson( $alunos, 200);
/*
Conecta ao banco via PDO.
Tenta buscar todos os alunos.
Se funcionar, retorna todos os registros em JSON.
Se der erro, retorna uma mensagem de erro em JSON com código 400.
*/
 
?>