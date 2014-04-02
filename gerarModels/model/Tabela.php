<?php

class Tabela {
    
    private $nome;
    private $campo;
    
    public function getNome() {
        return $this->nome;
    }

    public function getCampo() {
        return $this->campo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCampo($campo) {
        $this->campo = $campo;
    }
    
    public function criarPastaModel(){
        $pasta = getcwd()."/../modelsGeradas";
        if(!file_exists($pasta)){
            $criarPasta = mkdir($pasta, 0700);
            if($criarPasta){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
    
    public function abrirArquivo($arquivo){
        return fopen($arquivo, "w+");
    }
    
    public function escreverArquivo($arquivo, $conteudo){
        return fwrite($arquivo, $conteudo);
    }
    
    public function fecharArquivo($arquivo){
        return fclose($arquivo);
    }
    
    
}