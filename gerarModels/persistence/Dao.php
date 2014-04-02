<?php

abstract class Dao {
    
    protected $con = null;    
    
    public function open(){
        try{
            $this->con = new PDO("mysql:host=CAMINHO_DA_BASE;dbname=NOME_DO_BANCO", "USUARIO", "SENHA",
                                  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //$this->con = new PDO("mysql:host=localhost;dbname=aspenpharma", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            if(!$this->con){
                throw new Exception("Erro ao conexao!");
            }
            return $this->con;
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function close(){
        if($this->con != null)
            $this->con = null;
    }        
    
}

?>