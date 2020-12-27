<?php

//RECEBE DADOS FORMULÁRIO
 $cod = $_POST['cod'];
 $nome = $_POST['nome'];
 $preco = $_POST['preco'];
 $cor = $_POST['cor'];



function inserirproduto ($cod, $nome, $cor, $preco){	//FUNÇÃO INSERIR PRODUTO
include('conexao.php');

 $sql =  "INSERT INTO Produtos(IDPROD, NOME, COR) VALUE ('$cod', '$nome', '$cor')";
 $sql2 =  "INSERT INTO Preco(IDPROD, PRECO) VALUE ('$cod', '$preco')";

 $resultado  =$conn->query($sql);
 $resultado2  =$conn->query($sql2);
 
if (!$resultado) {
   printf("Errormessage: %s\n", $mysqli->error);
}
if (!$resultado2) {
   printf("Errormessage: %s\n", $mysqli->error);
}
 
  printf("PROCESSO TERMINADO. LINHAS AFETADAS: %d\n", $conn->affected_rows);

mysqli_close($conn);
?>
<p>
</p>
<a href="produtos.php">VOLTAR</a>
	<?php
	
}

inserirproduto($cod, $nome, $cor, $preco); //CHAMA FUNÇÃO INSERIR


?>