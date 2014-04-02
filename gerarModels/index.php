<?php

include_once 'persistence/Dao.php';
include_once 'persistence/TabelaDao.php';
include_once 'model/Tabela.php';

$tabelaDao = new TabelaDao();
$tabela = new Tabela();

$lista = $tabelaDao->listarTabelas();

if($lista){
    $i = 0;
    echo "<form action='controller/controllerModel.php' method='post'>";
        echo "<table>";        
            echo "<tr>";
                echo "<th></th>";
                echo "<th>Nome do modelo</th>";
                echo "<th>Nome da tabela</th>";
            echo "</tr>";
        foreach ($lista as $tabela){
            echo "<tr>";
                echo "<td> <input type='checkbox' name=tabela[".$i."]' value='".$tabela->getNome()."'/> </td>";
                echo "<td> <input type='input' name='nomeModelo[".$i."]' /> </td>";
                echo "<td> ".$tabela->getNome()." </td>";
            echo "</tr>";
            $i++;
        }
        echo "</table>";
        echo "<input type='submit' value='Gerar models'/>";
    echo '</form>'; 
}




?>