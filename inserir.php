<?php
declare(strict_types=1);
require_once '../model/funcoesAluno.php';
require_once '../util/funcoesUtil.php';

 //Lê o corpo da requisição HTTP (normalmente enviada via POST em JSON).
$info = file_get_contents('php://input');
$aluno = json_decode($info, true); // json_decode(..., true) converte o JSON em array associativo.
 
//Converte as notas para float (número decimal).Calcula: media usando obterMedia() grau usando obterGrau(media)
$nota1 = (float) $aluno['nota1']; $nota2 = (float) $aluno['nota2'];
$media = obterMedia( $nota1, $nota2);
$grau = obterGrau($media);
//armazena media e grau no array de aluno
$aluno['media'] = $media;
$aluno['grau'] = $grau;
$pdp = getPDO(); //Cria uma conexão PDO com o banco de dados. getPDO() deve estar definido em funcoesUtil.php.
 

try{
    $sql = "";
    $stmt = $pdp->prepare($sql);
    $stmt -> bindValue(':NOME', $aluno['nome'], PDO::PARAM_STR);
    $stmt -> bindValue(':NOTA1', $aluno['nota1'], PDO::PARAM_STR);
    $stmt -> bindValue(':NOTA2', $aluno['nota2'], PDO::PARAM_STR);
    $stmt -> bindValue(':MEDIA', $aluno['media'], PDO::PARAM_STR);
    $stmt -> bindValue(':GRAU', $aluno['grau'], PDO::PARAM_STR);
    $stmt -> execute();
} catch (PDOException $e) {
    $codErro = $e->errorInfo[1];
    if($codErro == 1062) responderJson(['erro'=> "erro de VIOLAÇÃO DE CHAVE ÚNICA para aluno"], 400);
    elseif($codErro == 1265) responderJson(['erro'=> "erro de VIOLAÇÃO DE CAMPO ENUM para aluno"], 400);
    elseif($codErro == 4025) responderJson(['erro'=> "erro de VIOLAÇÃO DE REGRA(s)  CHECK para aluno"], 400);
    else responderJson(['erro'=> "erro ao inserir aluno"], 400);
       
 
}
 
responderJson($aluno, 200);
 
?>
    