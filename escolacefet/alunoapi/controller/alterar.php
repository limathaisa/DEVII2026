<?php
declare(strict_types=1);
require_once '../model/funcoes.php';
require_once '../../util/funcoes.php';
require_once '../model/funcoesBD.php';
 
//recebe dados
$info = file_get_contents('php://input');
$aluno = json_decode($info, true); // json_decode(..., true) converte o JSON em array associativo.
 
$aluno['id'] = validarId( $aluno['id']);
validar( $aluno );

$aluno['media'] = obterMedia((float)$aluno['nota1'], (float)$aluno['nota2']);
$aluno['grau'] = obterGrau( $aluno['media']); 
 
 
try{
/** @var  calleble $alterar */
$alterar( $aluno );
} catch (PDOException $e) {
    //Captura erros do banco de dados. Dependendo do código de erro (1062, 1265, 4025), retorna uma mensagem JSON específica com HTTP status 400.
    $codErro = $e->errorInfo[1];
    if($codErro == 1062)
         responderJson(['erro'=> "erro de VIOLAÇÃO DE CHAVE ÚNICA para aluno"], 400);
    elseif($codErro == 1265) 
        responderJson(['erro'=> "erro de VIOLAÇÃO DE CAMPO ENUM para aluno"], 400);
    elseif($codErro == 4025) 
        responderJson(['erro'=> "erro de VIOLAÇÃO DE REGRA(s)  CHECK para aluno"], 400);
    else 
        responderJson(['erro'=> "erro ao inserir aluno {$e->getMessage()}"], 400);
       
 
}
 //muadando a resposta de 200 para 201. 
responderJson($aluno, 200);