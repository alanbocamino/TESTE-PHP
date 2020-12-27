<?php

 $cod = $_POST['cod'];



function removerproduto ($cod){ //FUNÇÃO REMOVER PRODUTO

include('conexao.php');

 $sql =  "DELETE FROM Produtos WHERE IDPROD='$cod'";
 $sql2 = "DELETE FROM Preco WHERE IDPROD='$cod'";



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
removerproduto ($cod);
?>