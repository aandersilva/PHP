<?php

class TabelaDao extends Dao{
    
    public function listarTabelas(){
        $lista = array();
        $con = $this->open();
        $stmt = $con->prepare("SHOW TABLES");        
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                while($linha = $stmt->fetch(PDO::FETCH_NUM)){
                    $tabela = new Tabela();
                    $tabela->setNome($linha[0]);
                    array_push($lista, $tabela);
                }
            }
        }
        return $lista;
        $this->close();
    }
    
    public function detalheTabela($tabela){
        $lista = array();
        $con = $this->open();
        $stmt = $con->prepare("DESC ".$tabela);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){                
                while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                    $tabela = new Tabela();
                    $tabela->setCampo($row->Field);
                    array_push($lista, $tabela);
                }
            }
        }
        return $lista;
        $this->close();
    }
    
}
