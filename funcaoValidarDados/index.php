<?php
function validarTipoDado($arrayDados){
    $flag = true;
    foreach($arrayDados as $dados){

        $tipo = $dados[0];
        $dado = $dados[1];

        if($tipo != gettype($dado)){
            $flag = false;
        }

    }
    return $flag;
}

$boolean = FALSE;
$nome = '1500';
$salario = 150.50;       
$int = 1065656;

$arrayDados = array(array('boolean',$boolean), array('string',$nome), array('double',$salario), array('integer',$int));

$result = validarTipoDado($arrayDados);

if($result){
    echo 'Dados corretos';
}else{
    echo 'Dados incorretos';
}  	