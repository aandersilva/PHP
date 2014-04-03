<?php

class CrudDao extends Dao{
    
    public function create($arrayColunasBanco, $arrayDadosGravar, $tabela){
        $crud = new Crud();
        $colunasBanco = $crud->montarColunasBanco($arrayColunasBanco);
        $dadosGravar = $crud->montarDadosGravar($arrayDadosGravar);
        $sql = $crud->montarSql($colunasBanco, $dadosGravar, $tabela);
        
        $con = $this->open();
        $stmt = $con->prepare($sql);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        $this->close();
    }
    
    public function select($sql){
        $arrayResult = array();
        $con = $this->open();
        $stmt = $con->prepare($sql);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_NUM)){
                    array_push($arrayResult, $row);
                }
            }
        }
        return $arrayResult;
        $this->close();
    }
    
    public function update($sql){
        $con = $this->open();
        $stmt = $con->prepare($sql);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        $this->close();
    }
    
    public function delete($sql){
        $con = $this->open();
        $stmt = $con->prepare($sql);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        $this->close();
    }

}