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