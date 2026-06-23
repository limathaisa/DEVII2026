<?php
function obterMedia(float $n1, float $n2):float{
    return (($n1+$n2)/2);
}

function obterGrau(float $med):string{
    if( $med> 8 )
        return "A";
    elseif( $med>= 6 )
        return "B";
    elseif( $med >= 4)
        return "C";
    elseif( $med > 2)
        return "D";
    else
        return "E";
}

function validar(array $aluno):void{
if(!$aluno)
    responderJson(["erro" => "problemas de conversão com JSON.", 400]);
if(!isset($aluno['nome'],$aluno['nota1'],$aluno['nota2']))
    responderJson(["erro" => "Nem todos os dados vieram.", 400]);
if($aluno['nome'] === "")
    responderJson(["erro" => "O nome precisa ser preenchido", 400]);
if(!(Is_numeric($aluno['nota1']) && is_numeric($aluno['nota2'])))
    responderJson(["erro" => "As notas precisam ter valores numéricos", 400]);
$nota1 = (float) $aluno['nota1'];
$nota2 = (float) $aluno['nota2'];
if($nota1<0 || $nota1>10 || $nota2<0 || $nota2>10)
    responderJson(["erro" => "As notas precisam conter valores entre 0 e 10", 400]);
}

function validarId(string $id ):int{
    if(!isset($id) || (!(is_numeric($id)) || ((int) $id)<0 ) )
        responderJson(["erro" => "Precisa haver um id maior que zero", 400]);
      return (int) $id;
    
}
