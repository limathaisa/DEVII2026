<?php
require_once '../../util/funcoes.php';
$pdo=getPDO();

$inserir = function (array $aluno) use ($pdo):void {
    $sql="INSERT  INTO aluno(nome,nota1,nota2,media,grau) 
    VALUES(:NOME, :NOTA1, :NOTA2, :MEDIA, :GRAU)";
        $stmt= $pdo ->prepare($sql);
        $stmt -> bindValue(':NOME', $aluno['nome'], PDO::PARAM_STR);
        $stmt -> bindValue(':NOTA1', $aluno['nota1'], PDO::PARAM_STR);
        $stmt -> bindValue(':NOTA2', $aluno['nota2'], PDO::PARAM_STR);
        $stmt -> bindValue(':MEDIA', $aluno['media'], PDO::PARAM_STR);
        $stmt -> bindValue(':GRAU', $aluno['grau'], PDO::PARAM_STR);
        $stmt -> execute();
};

$listar = function() use ($pdo):array|null {
    $sql = "SELECT id, nome, nota1, nota2, media, grau FROM aluno";
    $stmt = $pdo-> prepare($sql);
    $stmt -> execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};

$obterPeloId = function(int $id) use ($pdo):array|null {
    $sql="SELECT id,nome,nota1,nota2,media,grau FROM aluno WHERE id=:ID";
    $stmt= $pdo ->prepare($sql);
    $stmt -> bindParam(":ID",$id,PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
};

$alterar = function(array $aluno) use ($pdo):void {
    $sql = <<<SQL
    UPDATE aluno
    SET nome=:NOME, nota1=:NOTA1, nota2=:NOTA2, media=:MEDIA, grau=:GRAU
    WHERE id =:ID
    SQL;
    $stmt= $pdo->prepare($sql);
    $stmt -> bindValue(':NOME', $aluno['nome'], PDO::PARAM_STR);
    $stmt -> bindValue(':NOTA1', $aluno['nota1'], PDO::PARAM_STR);
    $stmt -> bindValue(':NOTA2', $aluno['nota2'], PDO::PARAM_STR);
    $stmt -> bindValue(':MEDIA', $aluno['media'], PDO::PARAM_STR);
    $stmt -> bindValue(':GRAU', $aluno['grau'], PDO::PARAM_STR);
    $stmt -> bindParam(':ID', $aluno['id'], PDO::PARAM_INT);
    $stmt -> execute();
};

$remover = function(int $id) use ($pdo):int {
    $sql = "DELETE FROM aluno WHERE id=:ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
};

$obterPeloNome=function(string $nome) use ($pdo):array|null{
    $sql ="SELECT id, nome, nota1, nota2, media, grau FROM aluno WHERE nome LIKE :NOME";
    $stmt= $pdo->prepare($sql);
    $stmt->bindValue(":NOME","%{$nome}%",PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};

 