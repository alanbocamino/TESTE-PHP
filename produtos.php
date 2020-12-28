<html>
    <meta charset="UTF-8"/>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="script.js"></script>   
	<link rel="stylesheet" type="text/css" href="style.css">
<head>
</head>
<body>

<?php

//CONEXÃO AO BD

include('conexao.php');

//TABELA
$filtrocor = '%';
 ?> 
 
 
 <!-- MENU -->
 
 <div id="menu">  
		<ul>
			<li><a href="produtos.php">INÍCIO</a></li>
			<li><a href="inserir.html">INSERIR PRODUTO</a></li>
			<li><a href="atualizar.html">ATUALIZAR PRODUTOS</a></li>
			<li><a href="remover.html">REMOVER PRODUTO</a></li>
				</ul>
	</div>
	
	<form action="#">
<select style="width:474px;
    padding:10px" name="select" method="post">
<option value="%">TODAS AS CORES</option>
  <option value="1">VERMELHO</option>
  <option value="2">AMARELO</option>
  <option value="3">AZUL</option>
</select>

<input type='submit' value="FILTRAR" name="FILTRAR"/>
</form>

<?php

	//SELECIONA A COR PARA O FILTRO
	
IF($_GET['select']==NULL){
$filtrocor = '%';};
IF($_GET['select']!=NULL){
$filtrocor = $_GET['select'];}



$sql_query = "SELECT * FROM Produtos, Preco WHERE Produtos.IDPROD = Preco.IDPROD and Produtos.cor LIKE '$filtrocor'";
$resulta = $conn->query($sql_query);

if ($resulta->num_rows > -1){
	
	//ESTILO TABELA CSS
	?>
	
	<style>
	
	body{
    font-family:Verdana;
}
	#tabela{
    width:100%;
    border:solid 1px;
    text-align:left;
    border-collapse:collapse;
}
 
#tabela tbody tr{
    border:solid 1px;
    height:30px;
    cursor:pointer;
}
 
#tabela thead{
    background:beige;
}
 
#tabela thead th:nth-child(1){
    width:100px;
}
 
#tabela input{
    color:navy;
    width:100%;
}
	</style>
	
	<!-- SCRIPT FILTRO DA TABELA !-->
	<script>
	$(function(){
    $("#tabela input").keyup(function(){        
        var index = $(this).parent().index();
        var nth = "#tabela td:nth-child("+(index+1).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#tabela tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });
 
    $("#tabela input").blur(function(){
        $(this).val("");
    }); 
});

	</script>
	
<table border=1 id="tabela">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Preço Normal</th>
					<th>Preço Promocional</th>
                </tr>
                <tr>
                    <th><input type="text" id="txtColuna1"/></th>
                    <th><input type="text" id="txtColuna2"/></th>
                    <th><input type="text" id="txtColuna3"/></th>
					<th><input type="text" id="txtColuna4"/></th>
                </tr>            
            </thead>



<?php

 // TABELA COM FUNDO DE ACORDO COM A COR DO PRODUTO
    while ( $row = $resulta->fetch_assoc()){   
		$preconormal = $row['PRECO'];
	
		if($row['COR'] == 1){
			$preconormal = number_format($preconormal, 2, ',', '');
			if($row['PRECO']>50){
			
			
			$precopromocao = $row['PRECO'] * 0.95;}
			else{$precopromocao = $row['PRECO']* 0.80;};
			$precopromocao = number_format($precopromocao, 2, ',', ''); //FORMATAR NUMERO COM 2 CASAS DECIMAIS
        echo '<tr bgcolor="RED">';
        echo '<td width="101" height="40">'. $row['IDPROD'] .'</td>';
        echo '<td width="101" height="40">'. $row['NOME'] .'</td>';
		echo '<td width="101" height="40">R$:'.$preconormal.'</td>';
		echo '<td width="101" height="40">R$:'. $precopromocao.'</td>';
		echo '</tr>';
		}	
		if($row['COR'] == 2){
		
			$preconormal = number_format($preconormal, 2, ',', '');
			$precopromocao = $row['PRECO'] * 0.90;
			$precopromocao = number_format($precopromocao, 2, ',', '');
        echo '<tr bgcolor="YELLOW">';
        echo '<td width="101" height="40">'. $row['IDPROD'] .'</td>';
        echo '<td width="101" height="40">'. $row['NOME'] .'</td>';
		echo '<td width="101" height="40">R$:'. $preconormal .'</td>';
		echo '<td width="101" height="40">R$:'. $precopromocao.'</td>';
		echo '</tr>';
		}
		if($row['COR'] == 3){
			
			$preconormal = number_format($preconormal, 2, ',', '');
			$precopromocao = $row['PRECO']* 0.8;
			$precopromocao = number_format($precopromocao, 2, ',', '');
        echo '<tr bgcolor="BLUE">';
        echo '<td width="101" height="40">'. $row['IDPROD'] .'</td>';
        echo '<td width="101" height="40">'. $row['NOME'] .'</td>';
		echo '<td width="101" height="40">R$:'. $preconormal .'</td>';
		echo '<td width="101" height="40">R$:'. $precopromocao.'</td>';
		echo '</tr>';
		}
    }
	echo '</table>';
	?>
	<p></p>
	 <a>Produtos das cores </a><a style="background-color: black; color:blue" >AZUL </a>e <a style="background-color: black;color:red" >VERMELHO</a>, Tem um desconto de 20%.</a><p></p>
	<a style="background-color: black; color:yellow" >Produtos das cores AMARELO, tem um desconto de 10%.</a><p></p>
	
	<a style="background-color: black; color:red" >Produtos de cor VERMELHO e com VALOR MAIOR que R$ 50.00.  Será aplicado um desconto de 5%.</a>
	
	<?php
	
}

?>
