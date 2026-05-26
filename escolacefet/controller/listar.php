<?php
declare(strict_types=1);
require_once "../../util/funcoesUtil.php";
 
$aluno = [];
$pdo = getPDO();
 
try{
 $sql = "SELECT id, nome, nota1, nota2, media, grau FROM aluno";
 $stmt = $pdo-> prepare($sql);
 $stmt -> execute();
 $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
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
