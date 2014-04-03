<?php

include_once 'persistence/Dao.php';
include_once 'persistence/CrudDao.php';
include_once 'model/Crud.php';
$crudDao = new CrudDao();


//CREATE
$arrayCols = array('COD_PRODUTO', 'PRODUTO', 'VALOR');//Nomes dos campos da tabela
/* Dados a serem gravados na tabela. 
   EX: 'TIPO_DE_DADO(P, S, I),DADO A SER GRADO'
   P=>PRIMARY KEY AUTO_INCREMENT
   S=>STRING, DATE,...
   I=>INT, FLOAT,...
 */
$arrayDados = array('P,NULL','S,TELEVISÃO','I,1000.99');
$tabela = "TB_PRODUTO";//Nome da tabela

$result = $crudDao->create($arrayCols, $arrayDados, $tabela);

if($result){
    echo "PRODUTO CRIADO COM SUCESSO!!!.";
}else{
    echo "ERRO AO CRIAR.";
}
echo "<br/><br/>";

//SELECT
$sql = "SELECT COD_PRODUTO, PRODUTO, VALOR FROM TB_PRODUTO";
$result = $crudDao->select($sql);
if($result){
    foreach ($result as $data){
        echo $data[0]." - ".$data[1]." - ".$data[2]."<br/>";
    }
}
echo "<br/><br/>";

//UPDATE
$sql = "UPDATE TB_PRODUTO SET VALOR = 1100.90 WHERE COD_PRODUTO = 15 ";
$result = $crudDao->update($sql);
if($result){
    echo "Editado com sucesso!!!";
}else{  
    echo "Erro ao editar";
}
echo "<br/><br/>";

//DELETE 
$sql = "DELETE FROM TB_PRODUTO WHERE COD_PRODUTO = 20 ";
$result = $crudDao->delete($sql);
if($result){
    echo "Apagado com sucesso!!!";
}else{  
    echo "Erro ao apagar";
}
echo "<br/><br/>";
?>
