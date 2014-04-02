<?php

include_once '../persistence/Dao.php';
include_once '../persistence/TabelaDao.php';
include_once '../model/Tabela.php';

$tabelaDao = new TabelaDao();
$tabela = new Tabela();



if(isset($_POST['tabela'])){
    $pastaModelsGeradas = "../modelsGeradas/";
    $criarPasta = $tabela->criarPastaModel();
    if($criarPasta){
        $arrayTabelas = $_POST['tabela'];
        $arrayModelo = $_POST['nomeModelo'];
        $arrayModelFinal = array();
        $thiss = '$this';
        
        foreach ($arrayTabelas as $numArray => $valor){
            
            $nomeTabela = $valor;
            $nomeModel = $arrayModelo[$numArray];
            array_push($arrayModelFinal, $nomeModel);            
            $lista = $tabelaDao->detalheTabela($nomeTabela);
            if($lista){
                
                $coluna = array();
                $conteudo = "<?php
                             \r class ".$nomeModel."{\n\n";
                foreach($lista as $tabela){
                    //Field Type Null Key Default Extra
                    $conteudo .= "\t public $".$tabela->getCampo().";\n";
                    array_push($coluna, strtoupper($tabela->getCampo()));
                }
                $conteudo .= "\n";
                foreach ($coluna as $set){
                    $conteudo .=    "\t public function set".$set."($".$set."){
                                            \r\t\t".$thiss."->".$set." = ".$set.";
                                     \r\t} \n";
                }
                $conteudo .= "\n\n\n\n";
                foreach ($coluna as $get){
                    $conteudo .=    "\t public function get".$get."(){
                                            \r\t\t return ".$thiss."->".$get.";
                                     \r\t} \n";
                }
                $conteudo .= "
                              \r }
                              \r?>";
                $arquivo = $tabela->abrirArquivo($pastaModelsGeradas.$nomeModel.".php");
                $tabela->escreverArquivo($arquivo, $conteudo);
                $tabela->fecharArquivo($arquivo);
                
            }

        }
        $nomeArqModel = $pastaModelsGeradas.'modelos.php';
        $arquivoM = $tabela->abrirArquivo($nomeArqModel);
        $conteudoM = "<?php \n";
        foreach ($arrayModelFinal as $modelFinal){
            $conteudoM .= "$".strtolower($modelFinal)." = new ".$modelFinal."();\n";
        }
        $conteudoM .= "\n?>";
        $tabela->escreverArquivo($arquivoM, $conteudoM);
        $tabela->fecharArquivo($arquivoM);        
        chdir('../modelsGeradas/');
        $pasta = getcwd();
        echo "Arquivos gerados com sucesso, verifique a pasta <a href='".$pasta."'>modelsGeradas</a> na raiz da pasta do framework <br/>";
    }else{
        echo 'Pasta não pode ser criada';
    }
}else{
    echo 'Escolha uma tabela';
}
echo "<a href='../index.php'>Voltar</a>";
?>