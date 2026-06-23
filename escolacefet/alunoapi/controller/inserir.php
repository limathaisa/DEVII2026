<?php
declare(strict_types=1);
require_once '../model/funcoes.php';
require_once '../model/funcoesBD.php';
require_once '../../util/funcoes.php';
 //Lê o corpo da requisição HTTP (normalmente enviada via POST em JSON).
$info = file_get_contents('php://input');
$aluno = json_decode($info, true); // json_decode(..., true) converte o JSON em array associativo.
 validar( $aluno );
//Converte as notas para float (número decimal).Calcula: media usando obterMedia() grau usando obterGrau(media)

//armazena media e grau no array de aluno
$aluno['media'] = obterMedia((float) $aluno['nota1'], (float) $aluno['nota2']);
$aluno['grau'] = obterGrau($aluno['media']); 
 
try{
 /**@var callable $inserir */
 $inserir($aluno);
} catch (PDOException $e) {
    //Captura erros do banco de dados. Dependendo do código de erro (1062, 1265, 4025), retorna uma mensagem JSON específica com HTTP status 400.
    $codErro = $e->errorInfo[1];
    if($codErro == 1062) responderJson(['erro'=> "erro de VIOLAÇÃO DE CHAVE ÚNICA para aluno"], 400);
    elseif($codErro == 1265) responderJson(['erro'=> "erro de VIOLAÇÃO DE CAMPO ENUM para aluno"], 400);
    elseif($codErro == 4025) responderJson(['erro'=> "erro de VIOLAÇÃO DE REGRA(s)  CHECK para aluno"], 400);
    else responderJson(['erro'=> "erro ao inserir aluno"], 400);
       
 
}
 //muadando a resposta de 200 para 201. 
responderJson($aluno, 201);
 
?>