<?php

class Crud {
    
    public function montarColunasBanco($arrayColunas){
        $colunas = $this->separarColunas($arrayColunas);
        return $colunas;
    }
    
    public function montarDadosGravar($arrayDados){
        $arrayColunas = $this->verificarTipoDado($arrayDados);
        $dados = $this->separarColunas($arrayColunas);
        return $dados;
    }
    
    private function qtdKeyArray($array){
        $qtdKeyArray = end(array_keys($array));
        return $qtdKeyArray;
    }
    
    private function separarColunas($arrayColunas){
        $colunas = '';
        $ultCampo = $this->qtdKeyArray($arrayColunas);
        foreach ($arrayColunas as $chave=>$valor){
            if($ultCampo != $chave){
                $separator = ',';
            }else{
                $separator = '';
            }
            $colunas .= $valor.$separator." ";
        }
        return $colunas;
    }
    
    private function verificarTipoDado($array){
        $arrayDados = array();
        foreach($array as $data){
            $tipo = $data[0];
            $dado = substr($data, 2);
            switch ($tipo){
                case 'P':
                    $dado = 'NULL';
                break;
                case 'I':
                    $dado = $dado;
                break;
                case 'S':
                    $dado = "'".$dado."'";
                break;
            }
            array_push($arrayDados, $dado);
        }
        return $arrayDados;
    }
    
    public function montarSql($colunasBanco, $dados, $tabela){
        $sql = "INSERT INTO ".$tabela." (".$colunasBanco.") VALUES (".$dados.")";
        return $sql;
    }
            
    
}


?>