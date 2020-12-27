<?php

//RECEBE DADOS FORMULÁRIO
 $cod = $_POST['cod'];
 $nome = $_POST['nome'];
 $preco = $_POST['preco'];
 


function atualizarproduto ($cod, $nome, $preco){ //FUNÇÃO ATUALIZAR

include('conexao.php');
 $sql =  "UPDATE Produtos SET NOME = '$nome' WHERE IDPROD = '$cod'"; //QUERY SQL
 $sql2 =  "UPDATE Preco SET PRECO = '$preco' WHERE IDPROD = '$cod'";



 $resultado  =$conn->query($sql);
 $resultado2  =$conn->query($sql2);
 
    printf("PROCESSO TERMINADO. LINHAS AFETADAS: %d\n", $conn->affected_rows);
	

mysqli_close($conn);
?>
<p>
</p>
<a href="produtos.php">VOLTAR</a>
<?php
}

atualizarproduto($cod, $nome, $preco); //CHAMA FUNÇÃO

?>