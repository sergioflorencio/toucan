<?php
	include "config.php";
	session_start();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		
	
if(isset($_POST['valor_moeda'])){
		$select= "
				select 
					cad_moedas_valores.valor,
					cad_moedas_valores.data_inicio
					
				from 
					".$schema.".cad_moedas_valores,
					(select max(data_inicio) as data_inicio,cod_moeda
					from ".$schema.".cad_moedas_valores
					where cod_moeda= ".$_POST['valor_moeda']." ) as maior
				
				where 
					cad_moedas_valores.cod_moeda= ".$_POST['valor_moeda']." and
					cad_moedas_valores.data_inicio=maior.data_inicio;";

		$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			{
			echo $row['valor'];
			}	


}

if(isset($_POST['nome_razao_social'])){
		$select= "
				select 
					cad_pessoas.cod_pessoa,
					cad_pessoas.nome_razao_social
					
				from 
					".$schema.".cad_pessoas
					
				where 
					cad_pessoas.nome_razao_social= '".$_POST['nome_razao_social']."'
				
				limit 0,1
	
					
					";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			{
			echo $row['cod_pessoa'];
			}	


}
if(isset($_POST['colaborador'])){
		$select= "
							select 
								cad_colaboradores.cod_colaborador,
								cad_pessoas.nome_razao_social
								
							from 
								".$schema.".cad_colaboradores,
								".$schema.".cad_pessoas
								
							where
								cad_colaboradores.cod_empresa=".$_SESSION['cod_empresa']." and 
								cad_pessoas.cod_pessoa=".$schema.".cad_colaboradores.cod_pessoa and							
								cad_pessoas.nome_razao_social= '".$_POST['colaborador']."'
							
							limit 0,1
	
					
					";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			{
			echo $row['cod_colaborador'];
			}	


}
if(isset($_POST['ctrreceita'])){
		$select= "
							select 
								* 
								
							from 
								".$schema.".cad_ctrreceitas
								
							where
								cad_ctrreceitas.cod_empresa=".$_SESSION['cod_empresa']." and 
								analitico_sintetico='analitico' and 
								cad_ctrreceitas.nome= '".$_POST['ctrreceita']."'
								
							order by 
								`nome`
								
							limit 0,1
								;
					
					
	
					
					";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			{
			echo $row['cod_ctrreceita'];
			}	


}
		
		
	}




?>