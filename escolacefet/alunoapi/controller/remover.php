<?php
declare(strict_types=1);
require_once '../../util/funcoes.php';
require_once '../model/funcoesBD.php';
require_once '../../util/funcoes.php';
//recebe dados
$id = (int) $_GET['id'];
$linhasAfetadas = 0;
try{
  /** @var callable $remover */
  $linhasAfetadas = $remover($id);
} catch(PDOException $e){
    responderJson(["erro" => "Erro ao remover aluno {$e->getMessage()}"], 400);
}
//responderJson (["$linhasAfetadas" => $linhasAfetadas], 204);
?>