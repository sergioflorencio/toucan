<?php

class salvar{
	function doacoes_avulsas(){
		$sql=new sql;
		
		$table='cad_cartas';
			
		$campos ="cod_contribuinte,";
		$campos.="cod_colaborador,";
		$campos.="cod_ctrreceita,";
		$campos.="carta_valor_moeda,";
		$campos.="carta_data_inicio,";
		$campos.="carta_dia_debito,";
		$campos.="carta_data_fim,";
		$campos.="carta_moeda,";
		$campos.="carta_qtd_moeda,";
		$campos.="carta_aberta,";
		$campos.="periodicidade,";
		$campos.="carta_forma_pagamento";
		
		//salvar novo
		if(
			isset($_POST['cod_carta']) and 
			isset($_POST['cod_pessoa']) and 
			isset($_POST['cod_colaborador']) and 
			isset($_POST['cod_ctrreceita']) and 
			isset($_POST['cod_moeda']) and 
			isset($_POST['carta_qtd_moeda']) and 
			isset($_POST['carta_valor_moeda']) and 
			isset($_POST['carta_data_inicio']) and 
			($_POST['cod_carta']=='')
		){
			$cod_pessoa=$_POST['cod_pessoa'];
			$cod_colaborador=$_POST['cod_colaborador'];
			$cod_ctrreceita=$_POST['cod_ctrreceita'];
			$carta_valor_moeda=$_POST['carta_valor_moeda'];				
			$carta_data_inicio=data($_POST['carta_data_inicio']);
			$dia_debito=substr($_POST['carta_data_inicio'],0,2);	
			$carta_data_fim=$carta_data_inicio;
			$cod_moeda=1;
			$carta_qtd_moeda=$carta_valor_moeda;
			$carta_aberta='avulso';
			$periodicidade='1';
			$tipo_convenio='recibo';
			
			$values="'".$cod_pessoa."',";	
			$values.="'".$cod_colaborador."',";	
			$values.="'".$cod_ctrreceita."',";	
			$values.="'".$carta_valor_moeda."',";	
			$values.="'".$carta_data_inicio."',";	
			$values.="'".$dia_debito."',";	
			$values.="'".$carta_data_fim."',";	
			$values.="'".$cod_moeda."',";	
			$values.="'".$carta_qtd_moeda."',";	
			$values.="'".$carta_aberta."',";	
			$values.="'".$periodicidade."',";	
			$values.="'".$tipo_convenio."'";	

			$sql->insert($table,$campos,$values);
			
		}
		
		
		include "php/config.php";		
		
		//gerar captações
		$consulta="CALL `vepinho`.`gerar_captacoes`();";
		$consulta=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		
		
		//atualizar status
		$consulta="CALL `vepinho`.`atualizar_status_captacao_cartas`();";
		$consulta=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		
		$consulta="CALL `vepinho`.`atualizar_status_carta`();";
		$consulta=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		
			
	}
	function cad_pessoas(){
				
		include "php/config.php";		
			
		if(
			isset($_POST['cod_pessoa']) and
			isset($_POST['nome_razao_social']) and
			isset($_POST['pessoa_juridica_fisica']) and
			isset($_POST['cpf']) and
			isset($_POST['cnpj']) and
			isset($_POST['endereco']) and
			isset($_POST['numero']) and
			isset($_POST['complemento']) and
			isset($_POST['cep']) and
			isset($_POST['bairro']) and
			isset($_POST['cidade']) and
			isset($_POST['uf']) and
			isset($_POST['email_1']) and
			isset($_POST['email_2']) and
			isset($_POST['telefone_1']) and
			isset($_POST['telefone_2']) and
			isset($_POST['celular_1']) and
			isset($_POST['celular_2']) and
			isset($_POST['manter_contato']) and
			isset($_POST['mandar_newsletter']) and
			($_POST['cod_pessoa']!='')
		){
			$table='cad_pessoas';

			$campos="nome_razao_social= '".$_POST['nome_razao_social']."',";
			$campos.="pessoa_juridica_fisica= '".$_POST['pessoa_juridica_fisica']."',";
			$campos.="cpf= '".$_POST['cpf']."',";
			$campos.="cnpj= '".$_POST['cnpj']."',";
			$campos.="endereco= '".$_POST['endereco']."',";
			$campos.="numero= '".$_POST['numero']."',";
			$campos.="complemento= '".$_POST['complemento']."',";
			$campos.="cep= '".$_POST['cep']."',";
			$campos.="bairro= '".$_POST['bairro']."',";
			$campos.="cidade= '".$_POST['cidade']."',";
			$campos.="uf= '".$_POST['uf']."',";
			$campos.="email_1= '".$_POST['email_1']."',";
			$campos.="email_2= '".$_POST['email_2']."',";
			$campos.="telefone_1= '".$_POST['telefone_1']."',";
			$campos.="telefone_2= '".$_POST['telefone_2']."',";
			$campos.="celular_1= '".$_POST['celular_1']."',";
			$campos.="celular_2= '".$_POST['celular_2']."',";
			$campos.="manter_contato= '".$_POST['manter_contato']."',";
			$campos.="mandar_newsletter= '".$_POST['mandar_newsletter']."'";

			$where=" cod_pessoa=".$_POST['cod_pessoa']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);
		}

		//salvar novo
		if(
			isset($_POST['cod_pessoa']) and
			isset($_POST['nome_razao_social']) and
			isset($_POST['pessoa_juridica_fisica']) and
			isset($_POST['cpf']) and
			isset($_POST['cnpj']) and
			isset($_POST['endereco']) and
			isset($_POST['numero']) and
			isset($_POST['complemento']) and
			isset($_POST['cep']) and
			isset($_POST['bairro']) and
			isset($_POST['cidade']) and
			isset($_POST['uf']) and
			isset($_POST['email_1']) and
			isset($_POST['email_2']) and
			isset($_POST['telefone_1']) and
			isset($_POST['telefone_2']) and
			isset($_POST['celular_1']) and
			isset($_POST['celular_2']) and
			isset($_POST['manter_contato']) and
			isset($_POST['mandar_newsletter']) and
			($_POST['cod_pessoa']=='')
		){
			$table='cad_pessoas';

			$campos="nome_razao_social,";
			$campos.="pessoa_juridica_fisica,";
			$campos.="cpf,";
			$campos.="cnpj,";
			$campos.="endereco,";
			$campos.="numero,";
			$campos.="complemento,";
			$campos.="cep,";
			$campos.="bairro,";
			$campos.="cidade,";
			$campos.="uf,";
			$campos.="email_1,";
			$campos.="email_2,";
			$campos.="telefone_1,";
			$campos.="telefone_2,";
			$campos.="celular_1,";
			$campos.="celular_2,";
			$campos.="manter_contato,";
			$campos.="mandar_newsletter";


			$values="'".$_POST['nome_razao_social']."', ";
			$values.="'".$_POST['pessoa_juridica_fisica']."', ";
			$values.="'".$_POST['cpf']."', ";
			$values.="'".$_POST['cnpj']."', ";
			$values.="'".$_POST['endereco']."', ";
			$values.="'".$_POST['numero']."', ";
			$values.="'".$_POST['complemento']."', ";
			$values.="'".$_POST['cep']."', ";
			$values.="'".$_POST['bairro']."', ";
			$values.="'".$_POST['cidade']."', ";
			$values.="'".$_POST['uf']."', ";
			$values.="'".$_POST['email_1']."', ";
			$values.="'".$_POST['email_2']."', ";
			$values.="'".$_POST['telefone_1']."', ";
			$values.="'".$_POST['telefone_2']."', ";
			$values.="'".$_POST['celular_1']."', ";
			$values.="'".$_POST['celular_2']."', ";
			$values.="'".$_POST['manter_contato']."', ";
			$values.="'".$_POST['mandar_newsletter']."' ";

			$sql=new sql;
			$sql->insert($table,$campos,$values);

		}

	
	}
	function cad_campanhas(){
		include "php/config.php";	


		//atualizar
		if(
			isset($_POST['cod_campanha']) and
			isset($_POST['nome_campanha']) and
			isset($_POST['data_inicio']) and
			isset($_POST['data_fim']) and
			isset($_POST['observacao']) and
			($_POST['cod_campanha']!='')
		){
			$table='cad_campanhas';

			$campos="nome_campanha='".$_POST['nome_campanha']."',";
			$campos.="data_inicio='".data($_POST['data_inicio'])."',";
			$campos.="data_fim='".data($_POST['data_fim'])."',";
			$campos.="observacao='".$_POST['observacao']."'";

			$where=" cod_campanha=".$_POST['cod_campanha']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);

		}

		//salvar novo
		if(
			isset($_POST['cod_campanha']) and
			isset($_POST['nome_campanha']) and
			isset($_POST['data_inicio']) and
			isset($_POST['data_fim']) and
			isset($_POST['observacao']) and
			($_POST['cod_campanha']=='')
		){
			$table='cad_campanhas';

			$campos ="nome_campanha,";
			$campos.="data_inicio,";
			$campos.="data_fim,";
			$campos.="observacao";

			$values="'".$_POST['nome_campanha']."',";
			$values.="'".data($_POST['data_inicio'])."',";
			$values.="'".data($_POST['data_fim'])."',";
			$values.="'".$_POST['observacao']."' ";

			$sql=new sql;
			$sql->insert($table,$campos,$values);

		}
		
	}
	function cad_centros(){
		include "php/config.php";		
			
		//atualizar
		if(
			isset($_POST['cod_centro']) and
			isset($_POST['nome_centro']) and
			isset($_POST['telefone_1']) and
			isset($_POST['telefone_2']) and
			isset($_POST['abreviatura_centro']) and
			($_POST['cod_centro']!='')
		){
			$table='cad_centros';

			$campos="nome_centro='".$_POST['nome_centro']."',";
			$campos.="abreviatura_centro='".$_POST['abreviatura_centro']."',";
			$campos.="telefone_1='".$_POST['telefone_1']."',";
			$campos.="telefone_2='".$_POST['telefone_2']."'";

			$where=" cod_centro=".$_POST['cod_centro']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);

		}

		//salvar novo
		if(
			isset($_POST['cod_centro']) and
			isset($_POST['nome_centro']) and
			isset($_POST['telefone_1']) and
			isset($_POST['telefone_2']) and
			isset($_POST['abreviatura_centro']) and
			($_POST['cod_centro']=='')
		){
			$table='cad_centros';

			$campos ="nome_centro,";
			$campos.="abreviatura_centro,";
			$campos.="telefone_1,";
			$campos.="telefone_2";

			$values="'".$_POST['nome_centro']."',";
			$values.="'".$_POST['abreviatura_centro']."',";
			$values.="'".$_POST['telefone_1']."',";
			$values.="'".$_POST['telefone_2']."'";

			$sql=new sql;
			$sql->insert($table,$campos,$values);


		}
		
	}
	function cad_convenios(){
		include "php/config.php";		
			
		//atualizar
		if(
			isset($_POST['cod_convenio']) and
			isset($_POST['codigo_convenio']) and
			isset($_POST['cod_banco']) and
			isset($_POST['agencia']) and
			isset($_POST['conta']) and
			isset($_POST['ultimo_lote']) and
			isset($_POST['cod_carteira']) and
			isset($_POST['tipo_convenio']) and
			($_POST['cod_convenio']!='')
		){
			$table='cad_convenios';

			$campos="codigo_convenio='".$_POST['codigo_convenio']."',";
			$campos.="cod_do_banco='".$_POST['cod_banco']."',";
			$campos.="agencia='".$_POST['agencia']."',";
			$campos.="conta='".$_POST['conta']."',";
			$campos.="ultimo_lote='".$_POST['ultimo_lote']."',";
			$campos.="cod_carteira='".$_POST['cod_carteira']."',";
			$campos.="tipo_convenio='".$_POST['tipo_convenio']."'";

			$where=" cod_convenio=".$_POST['cod_convenio']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);

		}

		//salvar novo
		if(
			isset($_POST['cod_convenio']) and
			isset($_POST['codigo_convenio']) and
			isset($_POST['cod_banco']) and
			isset($_POST['agencia']) and
			isset($_POST['conta']) and
			isset($_POST['ultimo_lote']) and
			isset($_POST['cod_carteira']) and
			isset($_POST['tipo_convenio']) and
			($_POST['cod_convenio']=='')
		){
			$table='cad_convenios';

			$campos="codigo_convenio,";
			$campos.="cod_do_banco,";
			$campos.="agencia,";
			$campos.="conta,";
			$campos.="ultimo_lote,";
			$campos.="cod_carteira,";
			$campos.="tipo_convenio";


			$values="'".$_POST['codigo_convenio']."', ";
			$values.="'".$_POST['cod_banco']."', ";
			$values.="'".$_POST['agencia']."', ";
			$values.="'".$_POST['conta']."', ";
			$values.="'".$_POST['ultimo_lote']."', ";
			$values.="'".$_POST['cod_carteira']."', ";
			$values.="'".$_POST['tipo_convenio']."' ";

			$sql=new sql;
			$sql->insert($table,$campos,$values);


		}

		
	}
	function cad_grupos(){
		include "php/config.php";	



		//atualizar
		if(
			isset($_POST['cod_grupo']) and
			isset($_POST['nome_grupo']) and
			isset($_POST['cod_campanha']) and
			isset($_POST['cod_centro']) and
			($_POST['cod_grupo']!='')
		){
			$table='cad_grupos';

			$campos="nome_grupo='".$_POST['nome_grupo']."',";
			$campos.="cod_campanha='".$_POST['cod_campanha']."',";
			$campos.="cod_centro='".$_POST['cod_centro']."'";

			$where=" cod_grupo=".$_POST['cod_grupo']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);

		}

		//salvar novo
		if(
			isset($_POST['cod_grupo']) and
			isset($_POST['nome_grupo']) and
			isset($_POST['cod_campanha']) and
			isset($_POST['cod_centro']) and
			($_POST['cod_grupo']=='')
		){

			$table='cad_grupos';

			$campos ="nome_grupo,";
			$campos.="cod_campanha,";
			$campos.="cod_centro";

			$values="'".$_POST['nome_grupo']."',";
			$values.="'".$_POST['cod_campanha']."',";
			$values.="'".$_POST['cod_centro']."'";

			$sql=new sql;
			$sql->insert($table,$campos,$values);
			

		}
		
	}
	function cad_colaboradores(){
		include "php/config.php";		
			
		//atualizar
		if(
			isset($_POST['cod_colaborador']) and
			isset($_POST['cod_pessoa']) and
			isset($_POST['cod_grupo']) and
			($_POST['cod_colaborador']!='')
		){
			$table='cad_colaboradores';

			$campos="cod_pessoa='".$_POST['cod_pessoa']."',";
			$campos.="cod_grupo='".$_POST['cod_grupo']."'";

			$where=" cod_colaborador=".$_POST['cod_colaborador']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);

		}

		//salvar novo
		if(
			isset($_POST['cod_colaborador']) and
			isset($_POST['cod_pessoa']) and
			isset($_POST['cod_grupo']) and
			($_POST['cod_colaborador']=='')
		){
			$table='cad_colaboradores';

			$campos ="cod_pessoa,";
			$campos.="cod_grupo";

			$values="'".$_POST['cod_pessoa']."',";
			$values.="'".$_POST['cod_grupo']."'";

			$sql=new sql;
			$sql->insert($table,$campos,$values);

		}

		
		
		
	}
	function cad_carteiras(){
		include "php/config.php";		
					
		//atualizar
		if(
			isset($_POST['cod_carteira']) and
			isset($_POST['nome_carteira'])and
			($_POST['cod_carteira']!='')
		){
			$table='cad_carteiras';

			$campos="nome_carteira='".$_POST['nome_carteira']."'";

			$where=" cod_carteira=".$_POST['cod_carteira']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);
				
		}

		//salvar novo
		if(
			isset($_POST['cod_carteira']) and
			isset($_POST['nome_carteira']) and
			($_POST['cod_carteira']=='')
		){
			$table='cad_carteiras';

			$campos ="nome_carteira";

			$values="'".$_POST['nome_carteira']."'";
			
			$sql=new sql;
			$sql->insert($table,$campos,$values);


		}
		
		
		
	}
	function cad_moedas(){
		include "php/config.php";		
		//atualizar
		if(
			isset($_POST['cod_moeda']) and
			isset($_POST['moeda']) and
			($_POST['cod_moeda']!='')
		){
			$table='cad_moedas';

			$campos="moeda='".$_POST['moeda']."'";

			$where=" cod_moeda=".$_POST['cod_moeda']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);

		}

		//salvar novo
		if(
			isset($_POST['cod_moeda']) and
			isset($_POST['moeda']) and
			($_POST['cod_moeda']=='')
		){
			$table='cad_moedas';

			$campos ="moeda";

			$values="'".$_POST['moeda']."'";

			$sql=new sql;
			$sql->insert($table,$campos,$values);

		}
		
		//incluir valor de moeda
		if(
			isset($_POST['novo_cod_moeda']) and
			isset($_POST['novo_moeda_data']) and
			isset($_POST['novo_moeda_valor']) 
		){
				$select= "INSERT INTO `".$schema."`.`cad_moedas_valores` (`cod_moeda` ,`data_inicio` ,`valor`)VALUES ( '".$_POST['novo_cod_moeda']."', '".data($_POST['novo_moeda_data'])."', '".$_POST['novo_moeda_valor']."');";
				$resultado=mysql_query($select,$conexao) or die ($select);



		}
		
		
	}
	function ctrreceita(){
		include "php/config.php";		
			
		//salvar novo
		if(
			isset($_POST['analitico_sintetico']) and
			isset($_POST['nivel_pai']) and
			isset($_POST['nome'])
		){

			$table='cad_ctrreceitas';

			$campos ="analitico_sintetico,";
			$campos.="nivel_pai,";
			$campos.="nome";

			$values="'".$_POST['analitico_sintetico']."',";
			$values.="'".$_POST['nivel_pai']."',";
			$values.="'".$_POST['nome']."'";

			$sql=new sql;
			$sql->insert($table,$campos,$values);
			

		}		
	
	}
	function cad_cartas(){
		include "php/config.php";		

		//atualizar
		if(
			isset($_POST['cod_carta']) and 
			isset($_POST['cod_pessoa']) and 
			isset($_POST['cod_colaborador']) and 
			isset($_POST['cod_ctrreceita']) and 
			isset($_POST['cod_moeda']) and 
			isset($_POST['carta_qtd_moeda']) and 
			isset($_POST['carta_valor_moeda']) and 
			isset($_POST['carta_aberta']) and 
			isset($_POST['carta_data_inicio']) and 
			isset($_POST['carta_data_fim']) and 
			isset($_POST['periodicidade']) and 
			isset($_POST['dia_debito']) and 
			isset($_POST['tipo_convenio']) and 
			isset($_POST['cod_banco']) and 
			isset($_POST['debito_numero_agencia']) and 
			isset($_POST['debito_numero_conta']) and 
			isset($_POST['debito_digito_conta']) and 
			isset($_POST['boleto_modo_envio']) and 
			isset($_POST['debito_digito_agencia']) and 
			($_POST['cod_carta']!='')
		){
			$table='cad_cartas';

			$campos="cod_contribuinte='".$_POST['cod_pessoa']."',";
			$campos.="cod_colaborador='".$_POST['cod_colaborador']."',";
			$campos.="cod_ctrreceita='".$_POST['cod_ctrreceita']."',";
			$campos.="carta_moeda='".$_POST['cod_moeda']."',";
			$campos.="carta_qtd_moeda='".$_POST['carta_qtd_moeda']."',";
			$campos.="carta_valor_moeda='".$_POST['carta_valor_moeda']."',";
			$campos.="carta_aberta='".$_POST['carta_aberta']."',";
			$campos.="carta_data_inicio='".data($_POST['carta_data_inicio'])."',";
			$campos.="carta_data_fim='".data($_POST['carta_data_fim'])."',";
			$campos.="periodicidade='".$_POST['periodicidade']."',";
			$campos.="carta_dia_debito='".$_POST['dia_debito']."',";
			$campos.="carta_forma_pagamento='".$_POST['tipo_convenio']."',";
			$campos.="debito_banco='".$_POST['cod_banco']."',";
			$campos.="debito_numero_agencia='".$_POST['debito_numero_agencia']."',";
			$campos.="debito_numero_conta='".$_POST['debito_numero_conta']."',";
			$campos.="debito_digito_conta='".$_POST['debito_digito_conta']."',";
			$campos.="boleto_modo_envio='".$_POST['boleto_modo_envio']."',";
			$campos.="debito_digito_agencia='".$_POST['debito_digito_agencia']."' ";

			$where=" cod_carta=".$_POST['cod_carta']."";

			$sql=new sql;
			$sql->update($table,$campos,$where);

		}


		//salvar novo
		if(
			isset($_POST['cod_carta']) and 
			isset($_POST['cod_pessoa']) and 
			isset($_POST['cod_colaborador']) and 
			isset($_POST['cod_ctrreceita']) and 
			isset($_POST['cod_moeda']) and 
			isset($_POST['carta_qtd_moeda']) and 
			isset($_POST['carta_valor_moeda']) and 
			isset($_POST['carta_aberta']) and 
			isset($_POST['carta_data_inicio']) and 
			isset($_POST['carta_data_fim']) and 
			isset($_POST['periodicidade']) and 
			isset($_POST['dia_debito']) and 
			isset($_POST['tipo_convenio']) and 
			isset($_POST['cod_banco']) and 
			isset($_POST['debito_numero_agencia']) and 
			isset($_POST['debito_numero_conta']) and 
			isset($_POST['debito_digito_conta']) and 
			isset($_POST['boleto_modo_envio']) and 
			isset($_POST['debito_digito_agencia']) and 
			($_POST['cod_carta']=='')
		){

			$table='cad_cartas';

			$campos ="cod_contribuinte,";
			$campos.="cod_colaborador,";
			$campos.="cod_ctrreceita,";
			$campos.="carta_moeda,";
			$campos.="carta_qtd_moeda,";
			$campos.="carta_valor_moeda,";
			$campos.="carta_aberta,";
			$campos.="carta_data_inicio,";
			$campos.="carta_data_fim,";
			$campos.="periodicidade,";
			$campos.="carta_dia_debito,";
			$campos.="carta_forma_pagamento,";
			$campos.="debito_banco,";
			$campos.="debito_numero_agencia,";
			$campos.="debito_numero_conta,";
			$campos.="debito_digito_conta,";
			$campos.="boleto_modo_envio,";
			$campos.="debito_digito_agencia";

			$values="'".$_POST['cod_pessoa']."',";
			$values.="'".$_POST['cod_colaborador']."',";
			$values.="'".$_POST['cod_ctrreceita']."',";
			$values.="'".$_POST['cod_moeda']."',";
			$values.="'".$_POST['carta_qtd_moeda']."',";
			$values.="'".$_POST['carta_valor_moeda']."',";
			$values.="'".$_POST['carta_aberta']."',";
			$values.="'".data($_POST['carta_data_inicio'])."',";
			$values.="'".data($_POST['carta_data_fim'])."',";
			$values.="'".$_POST['periodicidade']."',";
			$values.="'".$_POST['dia_debito']."',";
			$values.="'".$_POST['tipo_convenio']."',";
			$values.="'".$_POST['cod_banco']."',";
			$values.="'".$_POST['debito_numero_agencia']."',";
			$values.="'".$_POST['debito_numero_conta']."',";
			$values.="'".$_POST['debito_digito_conta']."',";
			$values.="'".$_POST['boleto_modo_envio']."',";
			$values.="'".$_POST['debito_digito_agencia']."' ";



			$sql=new sql;
			$sql->insert($table,$campos,$values);

		}		
		
		//gerar captações
		$consulta="CALL `vepinho`.`gerar_captacoes`();";
		$consulta=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		
		
		//atualizar status
		$consulta="CALL `vepinho`.`atualizar_status_captacao_cartas`();";
		$consulta=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		
		$consulta="CALL `vepinho`.`atualizar_status_carta`();";
		$consulta=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		
		
		
		

		
		
		
		
	}
	
	
}

class selects {
	function select_bancos($cod_banco){
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_bancos
							
							group by 
								`nome_banco`
							order by 
								`nome_banco`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Banco</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_banco' name='cod_banco' style='width: 100%;'>
								<option value=''></option>";
								while($row_option = mysql_fetch_array($resultado_option))
								{
								
								if(isset($cod_banco) and $row_option['cod_banco']==$cod_banco){
										echo "<option value='".$row_option['cod_banco']."' selected >".$row_option['nome_banco']."</option>";
									}else{
										echo "<option value='".$row_option['cod_banco']."'>".$row_option['nome_banco']."</option>";
									}
								}	
						echo "</select>
							</div></div>";

	
	}
	function select_campanhas($cod_campanha){
		include "config.php";
					$select_cad_campanhas= "
							select 
								* 
								
							from 
								".$schema.".cad_campanhas
							where
								cod_empresa=".$_SESSION['cod_empresa']."
							
							group by 
								`nome_campanha`
							order by 
								`nome_campanha`
								
								;";
								
					$resultado_cad_campanhas=mysql_query($select_cad_campanhas,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Campanhas</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small'id='cod_campanha' name='cod_campanha' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_cad_campanhas = mysql_fetch_array($resultado_cad_campanhas))
						{
						
						if(isset($cod_campanha) and $row_cad_campanhas['cod_campanha']==$cod_campanha){
								echo "<option value='".$row_cad_campanhas['cod_campanha']."' selected >".$row_cad_campanhas['nome_campanha']."</option>";
							}else{
								echo "<option value='".$row_cad_campanhas['cod_campanha']."'>".$row_cad_campanhas['nome_campanha']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_carteiras($cod_carteira){
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_carteiras
							where
								cod_empresa=".$_SESSION['cod_empresa']."
							
							group by 
								`nome_carteira`
							order by 
								`nome_carteira`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Carteiras</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_carteira' name='cod_carteira' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_carteira) and $row_option['cod_carteira']==$cod_carteira){
								echo "<option value='".$row_option['cod_carteira']."' selected >".$row_option['nome_carteira']."</option>";
							}else{
								echo "<option value='".$row_option['cod_carteira']."'>".$row_option['nome_carteira']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_carteiras2($id){
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_carteiras
							where
								cod_empresa=".$_SESSION['cod_empresa']."
							
							group by 
								`nome_carteira`
							order by 
								`nome_carteira`
								
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Carteiras</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='".$id."' name='".$id."' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
								echo "<option value='".$row_option['cod_carteira']."'>".$row_option['nome_carteira']."</option>";
						}	
					echo "</select></div></div>";
	}
	function select_centros($cod_centro){
		include "config.php";
					$select_cad_centros= "
							select 
								* 
								
							from 
								".$schema.".cad_centros
							where
								cod_empresa=".$_SESSION['cod_empresa']."
							
							group by 
								`nome_centro`
							order by 
								`nome_centro`
								
								;";
								
					$resultado_cad_centros=mysql_query($select_cad_centros,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Centros</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_centro' name='cod_centro' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_cad_centros = mysql_fetch_array($resultado_cad_centros))
						{
						
						if(isset($cod_centro) and $row_cad_centros['cod_centro']==$cod_centro){
								echo "<option value='".$row_cad_centros['cod_centro']."' selected >".$row_cad_centros['nome_centro']."</option>";
							}else{
								echo "<option value='".$row_cad_centros['cod_centro']."'>".$row_cad_centros['nome_centro']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_colaborador($cod_colaborador){
		include "config.php";
		if($cod_colaborador!=''){$filtro="and cod_colaborador='".$cod_colaborador."'";}else{$filtro="";}
					$select_option= "
							select 
								cad_colaboradores.cod_colaborador,
								cad_pessoas.nome_razao_social
								
							from 
								".$schema.".cad_colaboradores,
								".$schema.".cad_pessoas
								
							where
								cad_colaboradores.cod_empresa=".$_SESSION['cod_empresa']." and 
								".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_colaboradores.cod_pessoa and							
								cad_pessoas.status=1 and
								".$schema.".cad_colaboradores.status=1
							".$filtro."
								
							order by 
								`nome_razao_social`;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Colaborador</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_colaborador' name='cod_colaborador' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_colaborador) and $row_option['cod_colaborador']==$cod_colaborador){
								echo "<option value='".$row_option['cod_colaborador']."' selected >".$row_option['nome_razao_social']."</option>";
							}else{
								echo "<option value='".$row_option['cod_colaborador']."'>".$row_option['nome_razao_social']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_ctrreceita($cod_ctrreceita){
		if(isset($_GET['id']) and $_GET['id']=="novo"){$disabled="";}else{$disabled=" ";}if(isset($_GET['id']) and $_GET['id']!="novo"){$disabled="disabled ";}
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_ctrreceitas
								
							where
								cad_ctrreceitas.cod_empresa=".$_SESSION['cod_empresa']." and 
								analitico_sintetico='analitico' and 
								status=1 
								
							order by 
								`nome`;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Centro de receita</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_ctrreceita' name='cod_ctrreceita' style='width: 100%;'  ".$disabled.">";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_ctrreceita) and $row_option['cod_ctrreceita']==$cod_ctrreceita){
								echo "<option value='".$row_option['cod_ctrreceita']."' selected >".$row_option['nome']."</option>";
							}else{
								echo "<option value='".$row_option['cod_ctrreceita']."'>".$row_option['nome']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_ctrreceita_campo_pai(){
		include "config.php";
		echo "<select id='nivel_pai' name='nivel_pai'  class='uk-form-small'>
				<option value=''></option>";
		$select="SELECT * FROM ".$schema.".cad_ctrreceitas where analitico_sintetico='sintetico' and status=1;";	
		$resultado=mysql_query($select,$conexao) or die ("nao foi possivel conectar");
		while($row = mysql_fetch_assoc($resultado)){
			echo "<option value='".$row['cod_ctrreceita']."'>".$row['nome']."</option>";
		  }	
	
		echo "</select>";
		
		
	}
	function select_data_cancelamento(){
		include "config.php";
		echo "
		<div class='uk-form-row'>
			<div class='uk-grid'>
				<div class='uk-width-1-1'>
					<label class='uk-form-label'>Data de cancelamento</label>
				</div>			
				<div class='uk-width-1-2'>
					<input class='uk-form-small' data-uk-datepicker={format:'DD/MM/YYYY'} type='text' name='data_cancelamento_de' id='data_cancelamento_de' value='01/01/1900' placeholder='00/00/0000'>	
				</div>
				<div class='uk-width-1-2'>
					<input class='uk-form-small' data-uk-datepicker={format:'DD/MM/YYYY'} type='text' name='data_cancelamento_ate' id='data_cancelamento_ate' value='31/12/9999' placeholder='31/12/9999'>
				</div>
			</div>
		</div>";
	}
	function select_data_fim(){
		include "config.php";
		echo "
		<div class='uk-form-row'>
			<div class='uk-grid'>
				<div class='uk-width-1-1'>
					<label class='uk-form-label'>Data de fim</label>
				</div>			
				<div class='uk-width-1-2'>
					<input class='uk-form-small' data-uk-datepicker={format:'DD/MM/YYYY'} type='text' name='data_fim_de' id='data_fim_de' value='01/01/1900' placeholder='00/00/0000' onkeyup='javascript:formatar_data(this);'>	
				</div>
				<div class='uk-width-1-2'>
					<input class='uk-form-small' data-uk-datepicker={format:'DD/MM/YYYY'} type='text' name='data_fim_ate' id='data_fim_ate' value='31/12/9999' placeholder='31/12/9999' onkeyup='javascript:formatar_data(this);'>
				</div>
			</div>
		</div>";
	}
	function select_data_inicio(){
		include "config.php";
		echo "
		<div class='uk-form-row'>
			<div class='uk-grid uk-form-row'>
				<div class='uk-width-1-1'>
					<label class='uk-form-label'>Data de inicio</label>
				</div>
				<div class='uk-width-1-2'>
					<input class='uk-form-small' data-uk-datepicker={format:'DD/MM/YYYY'} type='text' name='data_inicio_de' id='data_inicio_de' value='01/01/1900' placeholder='00/00/0000' onkeyup='javascript:formatar_data(this);'>	
				</div>
				<div class='uk-width-1-2'>
					<input class='uk-form-small' data-uk-datepicker={format:'DD/MM/YYYY'} type='text' name='data_inicio_ate' id='data_inicio_ate' value='31/12/9999' placeholder='31/12/9999' onkeyup='javascript:formatar_data(this);'>
				</div>
			</div>
		</div>";
	}
	function select_dia_debito($dia_debito){
		if(isset($_GET['id']) and $_GET['id']=="novo"){$disabled="";}else{$disabled=" ";}if(isset($_GET['id']) and $_GET['id']!="novo"){$disabled="disabled ";}
		include "config.php";
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Dia</label>
							<div class='uk-form-controls'>
							<select id='dia_debito' name='dia_debito'  class='uk-form-small' style='width: 100%;' ".$disabled.">
								";
					if(isset($dia_debito)){
						echo "<option value='".$dia_debito."' selected >".$dia_debito."</option>";
					}			
					echo		"<option  value=''></option>
								<option  value='1'>1</option>
								<option  value='2'>2</option>
								<option  value='3'>3</option>
								<option  value='4'>4</option>
								<option  value='5'>5</option>
								<option  value='6'>6</option>
								<option  value='7'>7</option>
								<option  value='8'>8</option>
								<option  value='9'>9</option>
								<option  value='10'>10</option>
								<option  value='11'>11</option>
								<option  value='12'>12</option>
								<option  value='13'>13</option>
								<option  value='14'>14</option>
								<option  value='15'>15</option>
								<option  value='16'>16</option>
								<option  value='17'>17</option>
								<option  value='18'>18</option>
								<option  value='19'>19</option>
								<option  value='20'>20</option>
								<option  value='21'>21</option>
								<option  value='22'>22</option>
								<option  value='23'>23</option>
								<option  value='24'>24</option>
								<option  value='25'>25</option>
								<option  value='26'>26</option>
								<option  value='27'>27</option>
								<option  value='28'>28</option>
					</select></div></div>

				
				";
	}
	function select_grupos($cod_grupo){
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_grupos
								
							where
								cad_grupos.cod_empresa=".$_SESSION['cod_empresa']." 
								
							group by 
								`nome_grupo`
							order by 
								`nome_grupo`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Grupo</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_grupo' name='cod_grupo' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_grupo) and $row_option['cod_grupo']==$cod_grupo){
								echo "<option value='".$row_option['cod_grupo']."' selected >".$row_option['nome_grupo']."</option>";
							}else{
								echo "<option value='".$row_option['cod_grupo']."'>".$row_option['nome_grupo']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_periodicidade($periodicidade){
		if(isset($_GET['id']) and $_GET['id']=="novo"){$disabled="";}else{$disabled=" ";}if(isset($_GET['id']) and $_GET['id']!="novo"){$disabled="disabled ";}
		include "config.php";
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Periodicidade</label>
							<div class='uk-form-controls'>
								<select id='periodicidade' name='periodicidade'  class='uk-form-small' style='width: 100%;' ".$disabled.">
								";
					if(isset($periodicidade)){	
							if($periodicidade==''){$descricao='';}
							if($periodicidade=='1'){$descricao='Mensal';}
							if($periodicidade=='2'){$descricao='Bimestral';}
							if($periodicidade=='3'){$descricao='Trimestral';}
							if($periodicidade=='6'){$descricao='Semestral';}
							if($periodicidade=='12'){$descricao='Anual';}
				
						echo "<option value='".$periodicidade."' selected >".$descricao."</option>";
					}			
					echo		"<option value=''></option>
								<option value='1'>Mensal</option>
								<option value='2'>Bimestral</option>
								<option value='3'>Trimestral</option>
								<option value='6'>Semestral</option>
								<option value='12'>Anual</option>
							</select></div></div>
					
					";
	}
	function select_pessoas($cod_pessoa){
		include "config.php";
		if($cod_pessoa!=''){$filtro="and  cod_pessoa='".$cod_pessoa."'";}else{$filtro="";}
					$select_cad_pessoas= "
							select 
								* 
								
							from 
								".$schema.".cad_pessoas
									
							where
								cad_pessoas.cod_empresa=".$_SESSION['cod_empresa']." 
								".$filtro."
								
							group by 
								`nome_razao_social`
							order by 
								`nome_razao_social`
								
								;";
								
					$resultado_cad_pessoas=mysql_query($select_cad_pessoas,$conexao) or die (mysql_error());
					echo "<div class=''>
							<label class='uk-form-label' for='xxx'>Pessoa</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_pessoa' name='cod_pessoa' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_cad_pessoas = mysql_fetch_array($resultado_cad_pessoas))
						{
						
						if(isset($cod_pessoa) and $row_cad_pessoas['cod_pessoa']==$cod_pessoa){
								echo "<option value='".$row_cad_pessoas['cod_pessoa']."' selected >".$row_cad_pessoas['nome_razao_social']."</option>";
							}else{
								echo "<option value='".$row_cad_pessoas['cod_pessoa']."'>".$row_cad_pessoas['nome_razao_social']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_status_captacao($cod_status){
		include "config.php";
					$select_option= "
							SELECT 
								cod_status,
								concat(status_resumido,' - ',descricao) as descricao

							FROM 
								".$schema.".cad_status

							WHERE
								tabela='captacao_cartas_cod_retorno'

							ORDER BY
								cod_status

							;
							";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class=''>
							<label class='uk-form-label' for='xxx'>Status captação</label>
							<select class='uk-form-small' id='captacao_cartas_cod_retorno' name='captacao_cartas_cod_retorno' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_status) and $row_option['cod_status']==$cod_status){
								echo "<option value='".$row_option['cod_status']."' selected >".$row_option['descricao']."</option>";
							}else{
								echo "<option value='".$row_option['cod_status']."'>".$row_option['descricao']."</option>";
							}
						}	
					echo "</select></div>";
	}
	function select_status_carta($cod_status){
		include "config.php";
					$select_option= "
							SELECT 
								cod_status,
								descricao

							FROM 
								".$schema.".cad_status

							WHERE
								tabela='cad_cartas_status_carta'

							ORDER BY
								cod_status

							;
							";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Status carta</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='status_carta' name='status_carta' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_status) and $row_option['cod_status']==$cod_status){
								echo "<option value='".$row_option['cod_status']."' selected >".$row_option['descricao']."</option>";
							}else{
								echo "<option value='".$row_option['cod_status']."'>".$row_option['descricao']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_status_captacoes($cod_status){
		include "config.php";
					$select_option= "
							SELECT 
								cod_status,
								descricao

							FROM 
								".$schema.".cad_status

							WHERE
								tabela='cad_cartas_status_captacao'

							ORDER BY
								cod_status

							;
							";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Status captações</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='status_captacoes' name='status_captacoes' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_status) and $row_option['cod_status']==$cod_status){
								echo "<option value='".$row_option['cod_status']."' selected >".$row_option['descricao']."</option>";
							}else{
								echo "<option value='".$row_option['cod_status']."'>".$row_option['descricao']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_status_captacao_resumido($status_resumido){
		include "config.php";
					$select_option= "
								SELECT 
									status_resumido

								FROM 
									".$schema.".cad_status

								WHERE
									tabela='captacao_cartas_cod_retorno'

								group by
									status_resumido

								;
							";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Status captacao resumido</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='status_captacao_resumido' name='status_captacao_resumido' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($status_resumido) and $row_option['status_resumido']==$status_resumido){
								echo "<option value='".$row_option['status_resumido']."' selected >".$row_option['status_resumido']."</option>";
							}else{
								echo "<option value='".$row_option['status_resumido']."'>".$row_option['status_resumido']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_tipo_convenios($tipo_convenio){
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_tipo_convenio
								
							
							group by 
								`tipo_convenio`
							order by 
								`tipo_convenio`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Convênio</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='tipo_convenio' name='tipo_convenio' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($tipo_convenio) and $row_option['tipo_convenio']==$tipo_convenio){
								echo "<option value='".$row_option['tipo_convenio']."' selected >".$row_option['tipo_convenio']."</option>";
							}else{
								echo "<option value='".$row_option['tipo_convenio']."'>".$row_option['tipo_convenio']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_valor_intervalo(){
		include "config.php";
		echo "<div class='uk-grid'>
				<div class='uk-width-1-2'>
					<label class='uk-form-label' for='xxx'>Valor de </label>
					<input class='uk-form-small' type='text' name='valor_moeda_de' id='valor_moeda_de' value='0.00' placeholder='0.00' onkeyup='formatar_decimal(this);'>	
				</div>
				<div class='uk-width-1-2'>
					<label class='uk-form-label' for='xxx'>Valor até</label>
					<input class='uk-form-small' type='text' name='valor_moeda_ate' id='valor_moeda_ate' value='999999999.99' placeholder='999999.99' onkeyup='formatar_decimal(this);'>
				</div>
			</div>
		";
	}
	function select_carta_aberta($carta_aberta){
	if(isset($_GET['id']) and $_GET['id']=="novo"){$disabled="";}else{$disabled=" ";}if(isset($_GET['id']) and $_GET['id']!="novo"){$disabled="disabled ";}
		include "config.php";
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Carta aberta</label>
							<div class='uk-form-controls'>
								<select id='carta_aberta' name='carta_aberta'  class='uk-form-small' style='width: 100%;' ".$disabled." >
								";
					if(isset($carta_aberta)){
						echo "<option value='".$carta_aberta."' selected >".$carta_aberta."</option>";
					}			
					echo		"<option  value=''></option>
								<option value='aberta'>Aberta</option>
								<option value='fechada'>Fechada</option>
								<option value='avulso'>Avulso</option>
							</select></div></div>

					";
	}
	function select_moeda($cod_moeda){
		if(isset($_GET['id']) and $_GET['id']=="novo"){$disabled="";}else{$disabled=" ";}if(isset($_GET['id']) and $_GET['id']!="novo"){$disabled="disabled ";}
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_moedas
								
							where
								cad_moedas.cod_empresa=".$_SESSION['cod_empresa']." 
								
							group by 
								`moeda`
							order by 
								`moeda`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Moeda</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_moeda' name='cod_moeda' style='width: 100%;' onchange=javascript:calculartotalcarta();  ".$disabled.">";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_moeda) and $row_option['cod_moeda']==$cod_moeda){
								echo "<option value='".$row_option['cod_moeda']."' selected >".$row_option['moeda']."</option>";
							}else{
								echo "<option value='".$row_option['cod_moeda']."'>".$row_option['moeda']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_moeda_($id_select_moeda){
		if(isset($_GET['id']) and $_GET['id']=="novo"){$disabled="";}else{$disabled=" ";}if(isset($_GET['id']) and $_GET['id']!="novo"){$disabled="disabled ";}
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_moedas
								
							where
								cad_moedas.cod_empresa=".$_SESSION['cod_empresa']." 
							
							group by 
								`moeda`
							order by 
								`moeda`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Moeda</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='".$id_select_moeda."' name='".$id_select_moeda."' style='width: 100px;' ".$disabled.">";
					echo "<option value=''></option>";
					while($row_option = mysql_fetch_array($resultado_option))
						{
								echo "<option value='".$row_option['cod_moeda']."'>".$row_option['moeda']."</option>";
						}	
					echo "</select></div></div>";
	}
	function select_boleto_modo_envio($boleto_modo_envio){
		include "config.php";
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Envio</label>
							<div class='uk-form-controls'>
								<select id='boleto_modo_envio' name='boleto_modo_envio'  class='uk-form-small' style='width: 100%;'>
								";
					if(isset($boleto_modo_envio)){
						echo "<option value='".$boleto_modo_envio."' selected >".$boleto_modo_envio."</option>";
					}			
					echo		"<option  value=''></option>
								<option value='email'>E-mail</option>
								<option value='correio'>Correio</option>
								<option value='noa_entregar'>Não Entregar</option>
							</select></div></div>

					";
	}
	function select_motivo_cancelamento($cod_motivo_cancelamento){
		include "config.php";
					$select_option= "SELECT * FROM ".$schema.".cad_motivo_cancelamento;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Motivo de cancelamento</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_motivo_cancelamento' name='cod_motivo_cancelamento' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_motivo_cancelamento) and $row_option['cod_motivo_cancelamento']==$cod_motivo_cancelamento){
								echo "<option value='".$row_option['cod_motivo_cancelamento']."' selected >".$row_option['motivo_cancelamento']."</option>";
							}else{
								echo "<option value='".$row_option['cod_motivo_cancelamento']."'>".$row_option['motivo_cancelamento']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_convenios($cod_convenio){
		include "config.php";
					$select_option= "
					
						SELECT 
							* 
						
						FROM 
							".$schema.".cad_convenios
							
						where
								cad_convenios.cod_empresa=".$_SESSION['cod_empresa']." 
							;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Convenio</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_convenio' name='cod_convenio' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_convenio) and $row_option['cod_convenio']==$cod_convenio){
								echo "<option value='".$row_option['codigo_convenio']."' selected >".$row_option['tipo_convenio']." - banco:".$row_option['nome_abreviatura']." - ag:".$row_option['agencia']." - cc:".$row_option['conta']." - conv:".$row_option['codigo_convenio']."</option>";
							}else{
								echo "<option value='".$row_option['codigo_convenio']."'>".$row_option['tipo_convenio']." - banco:".$row_option['nome_abreviatura']." - ag:".$row_option['agencia']." - cc:".$row_option['conta']." - conv:".$row_option['codigo_convenio']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_status_arquivo($cod_status){
		include "config.php";
					$select_option= "
							SELECT 
								cod_status,
								descricao

							FROM 
								".$schema.".cad_status

							WHERE
								tabela='cad_arquivos_bancarios'

							ORDER BY
								cod_status

							;
							";
								
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Status arquivo</label>
							<div class='uk-form-controls'>
							<select class='uk-form-small' id='cod_status' name='cod_status' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_status) and $row_option['cod_status']==$cod_status){
								echo "<option value='".$row_option['cod_status']."' selected >".$row_option['descricao']."</option>";
							}else{
								echo "<option value='".$row_option['cod_status']."'>".$row_option['descricao']."</option>";
							}
						}	
					echo "</select></div></div>";
	}
	function select_pessoa_juridica_fisica($pessoa_juridica_fisica){
		include "config.php";
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Tipo Pessoa:</label>
							<div class='uk-form-controls'>
								<select class='uk-form-small' id='pessoa_juridica_fisica' name='pessoa_juridica_fisica' style='width: 100%;'>
								";
					if(isset($pessoa_juridica_fisica)){	
							if($pessoa_juridica_fisica==''){$descricao='';}
							if($pessoa_juridica_fisica=='PJ'){$descricao='Pessoa Juridica';}
							if($pessoa_juridica_fisica=='PF'){$descricao='Pessoa Fisica';}
				
						echo "<option value='".$pessoa_juridica_fisica."' selected >".$descricao."</option>";
					}			
					echo		"<option value=''></option>
								<option value='PJ'>Pessoa Juridica</option>
								<option value='PF'>Pessoa Fisica</option>
							</select></div></div>
					
					";
			
	}
	function select_manter_contato($manter_contato){
		include "config.php";
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Manter Contato?</label>
							<div class='uk-form-controls'>
								<select id='manter_contato' name='manter_contato'  class='uk-form-small' style='width: 100%;'>
								";
					if(isset($manter_contato)){	
							if($manter_contato==''){$descricao='';}
							if($manter_contato=='sim'){$descricao='Sim';}
							if($manter_contato=='nao'){$descricao='Não';}
				
						echo "<option value='".$manter_contato."' selected >".$descricao."</option>";
					}			
					echo		"<option value=''></option>
								<option value='sim'>Sim</option>
								<option value='nao'>Não</option>
							</select></div></div>
					
					";
	}
	function select_mandar_newsletter($mandar_newsletter){
		include "config.php";
					echo "<div class='uk-form-row'>
							<label class='uk-form-label' for='xxx'>Manter Contato?</label>
							<div class='uk-form-controls'>
								<select id='mandar_newsletter' name='mandar_newsletter'  class='uk-form-small' style='width: 100%;'>
								";
					if(isset($mandar_newsletter)){	
							if($mandar_newsletter==''){$descricao='';}
							if($mandar_newsletter=='sim'){$descricao='Sim';}
							if($mandar_newsletter=='nao'){$descricao='Não';}
				
						echo "<option value='".$mandar_newsletter."' selected >".$descricao."</option>";
					}			
					echo		"<option value=''></option>
								<option value='sim'>Sim</option>
								<option value='nao'>Não</option>
							</select></div></div>
					
					";
	}
	function select_relatorios(){
		echo "<ul class='uk-nav uk-nav-parent-icon'>";
			echo "<li class=uk-nav-header>Relatórios de cartas</li>";
			echo "<li data-uk-tooltip={pos:'right'} title='Filtros aplicáveis:</br>cod_centro</br>cod_grupo</br>cod_colaborador</br>status_carta</br>tipo_convenio</br>cod_campanha</br>carta_aberta</br>'><a><label><input name='relatorio' type='radio' value='listagem_cartas_por_colaborador'> Listagem de cartas por colaborador </label></a></li>";
//			echo "<li><a><label><input name='relatorio' type='radio' value='demonstrativo_anual_doacoes'> Demonstrativo anual de doações </label></a></li>";
			echo "<li data-uk-tooltip={pos:'right'} title='Filtros aplicáveis:</br>Cod Carta'><a><label><input name='relatorio' type='radio' value='resumo_carta_doacao'> Resumo de carta de doação </label></a></li>";
			echo "<li data-uk-tooltip={pos:'right'} title='Filtros aplicáveis:</br>Pessoa</br>Data de inicio'><a><label><input name='relatorio' type='radio' value='comprovante_doacoes'> Comprovante de doações </label></a></li>";

			echo "<li class=uk-nav-header>Relatórios de captações</li>";
			echo "<li data-uk-tooltip={pos:'right'} title='Filtros aplicáveis:</br>Data de inicio'><a><label><input name='relatorio' type='radio' value='captacoes_cod_status'> Captações por status de captação </label></a></li>";
			echo "<li data-uk-tooltip={pos:'right'} title='Filtros aplicáveis:</br>Data de inicio'><a><label><input name='relatorio' type='radio' value='captacoes_carteira'> Captações por carteira </label></a></li>";

			echo "<li class=uk-nav-header>Relatórios de campanhas</li>";
			echo "<li data-uk-tooltip={pos:'right'} title='Filtros aplicáveis:</br>Data de inicio</br>Campanha'><a><label><input name='relatorio' type='radio' value='resumo_campanha'> Resumo da campanha </label></a></li>";
		echo "</ul>";
		
		
		
	}

}
class inputs{
	function input_form_row($valor,$id,$label,$placeholder,$atributo){
	echo "
		<div class='uk-form-row'>
			<label class='uk-form-label' for='xxx'>".$label."</label>
			<div class='uk-form-controls'>
				<input class='uk-form-small' placeholder='".$placeholder."'type='text' ".$atributo." style='width:100%;text-align: right;' name='".$id."' id='".$id."' value=".$valor." >
			</div>
		</div>	
	";
	
	
	
	}


}
class button{
	function cancelar_carta($cod_carta,$callback){
		include "config.php";
					$select_option= " SELECT * FROM ".$schema.".cad_motivo_cancelamento;";
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					$opcoes='';
						while($row_option = mysql_fetch_array($resultado_option))
						{

								$opcoes.="<li><a href='php/cancelar_carta.php?cod_carta=".$cod_carta."&cod_motivo_cancelamento=".$row_option['cod_motivo_cancelamento']."&callback=".$callback."'>".$row_option['motivo_cancelamento']."</a></li>";
							
						}
		echo "
									<div class='uk-button-dropdown' data-uk-dropdown={mode:'click'}>
										<a href='#' class='uk-button uk-button-danger uk-button-small' data-uk-tooltip={pos:'left'} title='Cancelar carta' style='padding-top: 7px; padding-bottom: 7px;'><i class='uk-icon-trash' ></i></a>
										<div class='uk-dropdown uk-dropdown-small'>
											<ul class='uk-nav uk-nav-dropdown'>
											".$opcoes."
											</ul>
										</div>
									</div>		
		";
	
	
	}
	function renovar_carta($cod_carta){
		include "config.php";
					$select_option= " SELECT * FROM ".$schema.".cad_status where status_resumido='carta_vencida';";
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					$opcoes='';
						while($row_option = mysql_fetch_array($resultado_option))
						{

								$opcoes.="<li><a href='php/status_vencimento.php?cod_carta=".$cod_carta."&cod_status=".$row_option['cod_status']."'>".$row_option['descricao']."</a></li>";
							
						}
		echo "
									<div class='uk-button-dropdown' data-uk-dropdown={mode:'click'}>
										<a href='#' class='uk-button uk-button-danger uk-button-small'  data-uk-tooltip={pos:'left'} title='Status vencimento' style='padding-top: 7px; padding-bottom: 7px;'><i class='uk-icon-star'></i></a>
										<div class='uk-dropdown uk-dropdown-small'>
											<ul class='uk-nav uk-nav-dropdown'>
											".$opcoes."
											</ul>
										</div>
									</div>		
		";
	
	
	}
	function boletos(){
		include "config.php";
					$select_option= "
							select 
								* 
								
							from 
								".$schema.".cad_convenios,
								".$schema.".cad_bancos
								
							where 
								cad_convenios.`tipo_convenio`='boleto' and 
								cad_convenios.cod_do_banco=cad_bancos.cod_banco and
								cad_convenios.cod_empresa=".$_SESSION['cod_empresa']." 								

							order by 
								cad_bancos.`nome_banco`;";
					$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
					$opcoes='';
						while($row_option = mysql_fetch_array($resultado_option))
						{

								$opcoes.="<li onclick=listar_boletos_recibos('boleto','".$row_option['codigo_convenio']."','1') ><a href='#' >".$row_option['nome_banco']." Ag".$row_option['agencia']." CC".$row_option['conta']."</a></li>";
							
						}
		echo "
									<div class='uk-button-dropdown' data-uk-dropdown>
										<a href='#' class='uk-button uk-button-small' ><i class='uk-icon-barcode'></i> Boletos <i class='uk-icon-caret-down'></i></a>
										<div class='uk-dropdown uk-dropdown-small'>
											<ul class='uk-nav uk-nav-dropdown'>
											".$opcoes."
											</ul>
										</div>
									</div>		
		";
	
	
	}
	function recibos(){
		echo "
		
			<div class='uk-button-dropdown' data-uk-dropdown=''>
				<a href='#' class='uk-button uk-button-small'><i class='uk-icon-ticket'></i> Recibos <i class='uk-icon-caret-down'></i></a>
					<div class='uk-dropdown uk-dropdown-small'>
						<ul class='uk-nav uk-nav-dropdown'>
						<li onclick=listar_boletos_recibos('recibo','','1') ><a href='#'>Modelo 1</a></li>
						<li onclick=listar_boletos_recibos('recibo','','2') ><a href='#'>Modelo 2</a></li>
						<li onclick=listar_boletos_recibos('recibo','','3') ><a href='#'>Modelo 3</a></li>
					</ul>
					</div>
			</div>
		
		";
	
	
	
	
	}

}
class filtros{
	function cartas(){

		$selects=new selects; 
		echo "
		<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form'>	
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
			<hr class='uk-article-divider'>
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>Carta</label>
				<input class='uk-form-small' type='text' name='cod_carta' id='cod_carta' value=''>
			</div>
			<script src='php/autocomplete.php?tb=pessoas'></script>
			<div class='uk-form-row'>
				<div class='uk-autocomplete uk-form' style='width: 100%;' data-uk-autocomplete={source:filtro_pessoas}>
					<label class='uk-form-label' for='xxx'>Pessoa</label>
					<input class='uk-form-small' type='text' name='cod_pessoa' id='cod_pessoa' value='' style='width: 100%;'>
				</div>
			</div>
			";
			$selects->select_status_carta('');
			$selects->select_valor_intervalo('');
			$selects->select_data_inicio('');
			$selects->select_data_fim('');
echo "<hr class='uk-article-divider'>
			<div class='uk-form-row'>
			
				<ul class='uk-nav uk-nav-parent-icon' data-uk-nav>
			
					<li class='uk-parent '>
				<a href='#' style='padding: 0px;'>pesquisa avançada...</a>
				
				<ul class='uk-nav-sub' style='padding: 0px;'>
				
				";
				
		echo			"<li>";
							$selects->select_colaborador('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_data_cancelamento('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_bancos('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_campanhas('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_carteiras('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_centros('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_grupos('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_tipo_convenios('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_boleto_modo_envio('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_ctrreceita('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_periodicidade('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_dia_debito('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_moeda('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_carta_aberta('');
		echo			"</li>";

		echo		"
				</ul>
				</li>
				</ul>
</div>
		</form>";
	
	
	}
	function doacoes_avulsas(){

		$selects=new selects; 
		echo "
		<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form'>	
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
			<hr class='uk-article-divider'>
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>Carta</label>
				<input class='uk-form-small' type='text' name='cod_carta' id='cod_carta' value=''>
			</div>
			<script src='php/autocomplete.php?tb=pessoas'></script>
			<div class='uk-form-row'>
				<div class='uk-autocomplete uk-form' style='width: 100%;' data-uk-autocomplete={source:filtro_pessoas}>
					<label class='uk-form-label' for='xxx'>Pessoa</label>
					<input class='uk-form-small' type='text' name='cod_pessoa' id='cod_pessoa' value='' style='width: 100%;'>
				</div>
			</div>
			";
			$selects->select_valor_intervalo('');
			$selects->select_data_inicio('');
			$selects->select_status_carta('');			
echo "<hr class='uk-article-divider'>
			<div class='uk-form-row'>
			
				<ul class='uk-nav uk-nav-parent-icon' data-uk-nav>
			
					<li class='uk-parent '>
				<a href='#' style='padding: 0px;'>pesquisa avançada...</a>
				
				<ul class='uk-nav-sub' style='padding: 0px;'>
				
				";
				
		echo			"<li>";
							$selects->select_colaborador('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_campanhas('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_centros('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_grupos('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_ctrreceita('');
		echo			"</li>";		

		echo		"
				</ul>
				</li>
				</ul>
</div>
		</form>";
	
	
	}
	function captacoes(){
		$selects=new selects; 
		echo "
		<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form'>	
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
			<hr class='uk-article-divider'>
			<div class='uk-grid'>
				<div class='uk-width-1-2'>
					<div class='uk-form-row'>
						<label class='uk-form-label' for='xxx'>Cod Carta</label>
						<input class='uk-form-small' type='text' name='cod_carta' id='cod_carta' value=''>
					</div>
				</div>
				<div class='uk-width-1-2'>
					<div class='uk-form-row'>
						<label class='uk-form-label' for='xxx'>Cod Captação</label>
						<input class='uk-form-small' type='text' name='cod_captacao' id='cod_captacao' value=''>
					</div>
				</div>
			</div>	
			<script src='php/autocomplete.php?tb=pessoas'></script>
			<div class='uk-form-row uk-autocomplete uk-form' style='width: 100%;' data-uk-autocomplete={source:filtro_pessoas}>
				<label class='uk-form-label' for='xxx'>Pessoa</label>
				<input class='uk-form-small' type='text' name='cod_pessoa' id='cod_pessoa' value='' style='width: 100%;'>
			</div>
			";
			$selects->select_data_inicio('');
			$selects->select_valor_intervalo('');
			$selects->select_status_captacao_resumido('');
			$selects->select_status_captacao('');





echo "<hr class='uk-article-divider'>
			<div class='uk-form-row'>
			
				<ul class='uk-nav uk-nav-parent-icon' data-uk-nav>
			
					<li class='uk-parent '>
				<a href='#' style='padding: 0px;'>pesquisa avançada...</a>
				
				<ul class='uk-nav-sub' style='padding: 0px;'>
				
				";
				
		
		echo			"<li>
							<div class='uk-form-row'>
								<label class='uk-form-label' for='xxx'>Lote de Envio</label>
								<input class='uk-form-small' type='text' name='lote_envio' id='lote_envio' value=''>
							</div>
						</li>";		
		echo			"<li>";
			$selects->select_colaborador('');
		echo			"</li>";		
		echo			"<li>";
			$selects->select_ctrreceita('');
		echo			"</li>";		
		echo			"<li>";
			$selects->select_centros('');
		echo			"</li>";		
		echo			"<li>";
			$selects->select_grupos('');
		echo			"</li>";		
		echo			"<li>";
			$selects->select_bancos('');
		echo			"</li>";
		echo			"<li>";
			$selects->select_carteiras('');
		echo			"</li>";
		echo			"<li>";
			$selects->select_tipo_convenios('');
		echo			"</li>";
		echo			"<li>";
			$selects->select_boleto_modo_envio('');
		echo			"</li>";
		echo			"<li>";
			$selects->select_carta_aberta('');
		echo			"</li>";
		echo		"
				</ul>
				</li>
				</ul>
</div>
		</form>";
	
	
	
	
	
	
	
	
	
	
	
	}
	function relatorios(){
		$selects=new selects; 
		echo "
		<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form'>	
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
			<hr class='uk-article-divider'>
			<div class='uk-grid'>
				<div class='uk-width-1-1'>
					<div class='uk-form-row' style='margin-bottom: 50px;'>";
			$selects->select_relatorios();
		echo		"</div>
					<hr class='uk-article-divider'>
				</div>
				<div class='uk-width-1-2'>
					<div class='uk-form-row'>
						<label class='uk-form-label' for='xxx'>Cod Carta</label>
						<input class='uk-form-small' type='text' name='cod_carta' id='cod_carta' value=''>
					</div>
				</div>
				<div class='uk-width-1-2'>
					<div class='uk-form-row'>
						<label class='uk-form-label' for='xxx'>Cod Captação</label>
						<input class='uk-form-small' type='text' name='cod_captacao' id='cod_captacao' value=''>
					</div>
				</div>
			</div>	
			<script src='php/autocomplete.php?tb=pessoas'></script>
			<div class='uk-form-row'>
				<div class='uk-autocomplete uk-form' style='width: 100%;' data-uk-autocomplete={source:filtro_pessoas}>
					<label class='uk-form-label' for='xxx'>Pessoa</label>
					<input class='uk-form-small' type='text' name='cod_pessoa' id='cod_pessoa' value='' style='width: 100%;'>
				</div>
			</div>			
			";
			$selects->select_data_inicio('');
			$selects->select_valor_intervalo('');
			$selects->select_status_carta('');			
			$selects->select_status_captacao_resumido('');
			$selects->select_status_captacao('');





echo "<hr class='uk-article-divider'>
			<div class='uk-form-row'>
			
				<ul class='uk-nav uk-nav-parent-icon' data-uk-nav>
			
					<li class='uk-parent '>
				<a href='#' style='padding: 0px;'>pesquisa avançada...</a>
				
				<ul class='uk-nav-sub' style='padding: 0px;'>
				
				";
				
		
		echo			"<li>
							<div class='uk-form-row'>
								<label class='uk-form-label' for='xxx'>Lote de Envio</label>
								<input class='uk-form-small' type='text' name='lote_envio' id='lote_envio' value=''>
							</div>
						</li>";		
		echo			"<li>";
							$selects->select_colaborador('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_ctrreceita('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_centros('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_grupos('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_bancos('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_carteiras('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_tipo_convenios('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_boleto_modo_envio('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_data_cancelamento('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_campanhas('');
		echo			"</li>";		
		echo			"<li>";
							$selects->select_periodicidade('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_dia_debito('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_moeda('');
		echo			"</li>";
		echo			"<li>";
							$selects->select_carta_aberta('');
		echo			"</li>";

		echo		"
				</ul>
				</li>
				</ul>
</div>
		</form>";
	
	


	
	
	
	
	
	
	
	
	
	
	
	}
	function carteiras(){
		$selects=new selects; 
		echo "
		<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form'>	
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
			

			";
			$selects->select_data_inicio('');
			$selects->select_valor_intervalo('');			
			$selects->select_carteiras('');
			$selects->select_pessoas('');
		echo "
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>lote_envio</label>
				<input class='uk-form-small' type='text' name='lote_envio' id='lote_envio' value=''>
			</div>
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>lote_retorno</label>
				<input class='uk-form-small' type='text' name='lote_retorno' id='lote_retorno' value=''>
			</div>
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>cod_carta</label>
				<input class='uk-form-small' type='text' name='cod_carta' id='cod_carta' value=''>
			</div>
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>cod_captacao</label>
				<input class='uk-form-small' type='text' name='cod_captacao' id='cod_captacao' value=''>
			</div>
		
		";



			

		echo	"		
		</form>


		

			";
	
	
	
	
	
	
	
	
	
	
	
	}
	function conciliacao(){
		$selects=new selects; 
		echo "
		<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form'>	


			";
			$selects->select_data_inicio('');
			$selects->select_valor_intervalo('');
			$selects->select_carteiras('');
		echo "
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>Conciliado</label>
				<select id='conciliado' name='conciliado'>
					<option value=''></option>
					<option value='N'>Não</option>
					<option value='S'>Sim</option>
				</select>
			</div>
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>cod_conciliacao</label>
				<input class='uk-form-small' type='text' name='cod_conciliacao' id='cod_conciliacao' value=''>
			</div>
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
			
		</form>";
	
	
	
	
	
	
	
	
	
	
	
	}
	function arquivo_retorno(){
		$selects=new selects; 
		echo "<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form' action='arquivo_retorno.php#'>";
		echo "
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>Lote</label>
				<input class='uk-form-small' type='text' name='lote' id='lote' value=''>
			</div>		
		";
			$selects->select_data_inicio('');
			$selects->select_bancos('');
			$selects->select_convenios('');
			$selects->select_status_arquivo('');
			
		echo "
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
		</form>
		
		";
	
	
	
	
	
	
	
	
	
	
	
	}
	function arquivo_envio(){
		$selects=new selects; 
		echo "<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form' action='arquivo_envio.php#'>";
		echo "
			<div class='uk-form-row'>
				<label class='uk-form-label' for='xxx'>Lote</label>
				<input class='uk-form-small' type='text' name='lote' id='lote' value=''>
			</div>		
		";
			$selects->select_data_inicio('');
			$selects->select_bancos('');
			$selects->select_convenios('');
			$selects->select_status_arquivo('');
			
		echo "
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'>Pesquisar  <i class='uk-icon-search'></i></button>
			</div>	
		</form>
		
		";
	
	
	
	
	
	
	
	
	
	
	
	}
	function gerar_arquivo_envio(){
		$selects=new selects; 
		echo "<form class='uk-form uk-form-stacked  uk-panel-box' method='post' id='form' action='arquivo_envio.php#'>
			<div class='uk-form-row'>
				<div class='uk-grid'>
					<div class='uk-width-1-1'>
						<label class='uk-form-label'>Data de fim</label>
					</div>			
					<div class='uk-width-1-2'>
						<input class='uk-form-small' type='text' name='data_fim_de' id='data_fim_de' value='00/00/0000' placeholder='00/00/0000' onkeyup='javascript:formatar_data(this);'>	
					</div>
					<div class='uk-width-1-2'>
						<input class='uk-form-small' type='text' name='data_fim_ate' id='data_fim_ate' value='00/00/0000' placeholder='00/00/0000' onkeyup='javascript:formatar_data(this);'>
					</div>
				</div>
			</div>		
		";
			$selects->select_convenios('');
		echo "
			<div class='uk-form-row'>
				<button class='uk-button uk-button-small uk-button-primary'><i class='uk-icon-file-code-o'></i>  Gerar</button>
			</div>	
		</form>
		
		";
	
	
	
	
	
	
	
	
	
	
	
	}

}
class tabelas{
	function listar_captacoes_carta_(){
		include "config.php";
	
		if(isset($_GET["id"])){$cod_carta=$_GET["id"];}else{$cod_carta="";}
		if(isset($_GET["data_inicio"])){$data_inicio=$_GET["data_inicio"];}else{$data_inicio="";}
		if(isset($_GET["data_fim"])){$data_fim=$_GET["data_fim"];}else{$data_fim="";}
		if($data_inicio==""){$data_inicio='1900-01-01';}else{ $data_inicio=data($data_inicio);}
		if($data_fim==""){$data_fim='9999-12-31';}else{ $data_fim=data($data_fim);}
		
					$select= "SELECT
								captacao_cartas.cod_captacao_cartas,
								captacao_cartas.cod_carta as carta,
								captacao_cartas.numero_lote,
								captacao_cartas.data_vencimento,
								captacao_cartas.status,
								cad_status.status_resumido,
								cad_status.descricao,
								cad_cartas.cod_contribuinte as cod_contribuinte,
								cad_pessoas.nome_razao_social as nomecontribuinte,
								captacao_cartas.valor as valor,
								IFNULL(".$schema.".captacao_cartas_baixas.historico,'-') as historico,
								IFNULL(".$schema.".captacao_cartas_baixas.cod_carteira,0) as cod_carteira,
								IFNULL(max(captacao_cartas_baixas.data_baixa),'0000-00-00') as data_recebimento,
								IFNULL(sum(captacao_cartas_baixas.valor_baixa),0) as somabaixas,
								(captacao_cartas.valor-IFNULL(sum(captacao_cartas_baixas.valor_baixa),0)) as saldocaptacao
								
							FROM 
								".$schema.".captacao_cartas

							LEFT JOIN ".$schema.".cad_cartas ON
								".$schema.".cad_cartas.cod_carta=".$schema.".captacao_cartas.cod_carta

							LEFT JOIN ".$schema.".captacao_cartas_baixas ON 
								".$schema.".captacao_cartas_baixas.cod_captacao_cartas=".$schema.".captacao_cartas.cod_captacao_cartas

							LEFT JOIN ".$schema.".cad_pessoas ON
								".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_cartas.cod_contribuinte

							LEFT JOIN ".$schema.".cad_status ON
								cad_status.cod_status=captacao_cartas.status
								
							WHERE 
								captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
								captacao_cartas.cod_carta='".$cod_carta."' and
								(captacao_cartas.data_vencimento between '".$data_inicio."' and '".$data_fim."' )

							GROUP BY 	
								".$schema.".captacao_cartas.cod_captacao_cartas
							
							LIMIT 1000
								
								;";	
							
	

	
					$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);
					
						$tabela= "<div class='' style='overflow-x: scroll;'><table class='uk-table uk-table-hover uk-table-condensed uk-text-nowrap uk-panel-box' style='font-size: 11px;max-width: 100%;'>";
						$tabela.=  
							"<tr>
							<th></th>
							<th></th>
							<th>Histórico</th>
							<th>Vcto.Cap.</th>
							<th>Dt.Receb.</th>
							<th>Capt.(R$)</th>
							<th>Receb.(R$)</th>
							<th>Saldo (R$)</th>

							</tr>";						
						$n=1;
						
						while($row = mysql_fetch_array($resultado))
						{
						$tabela.=  
							"<tr>
							<th>
								<a href='cadastro_captacoes.php?id=".$row['cod_captacao_cartas']."'  target='_blank'>
									<div class='uk-button uk-button-mini uk-button-primary' style='width: 100%;'><i class='uk-icon-edit'></i>  Editar</div>
								</a>							
							</th>
							<td>".$row['status_resumido']."</td>
							<td>".$row['historico']."</td>
							<td>".data($row['data_vencimento'])."</td>
							<td>".data($row['data_recebimento'])."</td>
							<td style='text-align: right;'>".number_format($row['valor'], 2, ',', '.')."</td>
							<td style='text-align: right;'>".number_format($row['somabaixas'], 2, ',', '.')."</td>
							<td style='text-align: right;'>".number_format($row['saldocaptacao'], 2, ',', '.')."</td>
							</tr>";
						$n=$n+1;
						}	
						$campos_inputs=new inputs;
						$tabela.= "</table></div>";
						echo "<div class=' uk-width-1-1'>
								<h3><i class='uk-icon-tags'></i> Captações da carta</h3>
								<form method='get' class='uk-form'>
								<div class='uk-grid'>
									<div class='uk-width-1-3' style=''>";
									
										//carta_data_inicio
											$campos_inputs->input_form_row('','_data_inicio','Inicio','00/00/0000',"data-uk-datepicker={format:'DD/MM/YYYY'} onkeyup=javascript:formatar_data(this);");
								
							echo "	</div>
									<div class='uk-width-1-3' style=''>";
									
										//carta_data_fim
											$campos_inputs->input_form_row('','_data_fim','Fim','00/00/0000',"data-uk-datepicker={format:'DD/MM/YYYY'} onkeyup=javascript:formatar_data(this);");
									
							echo "	</div>
									<div class='uk-width-1-3' style=''><br>
										<button class='uk-button uk-button-primary uk-button-small'><i class='uk-icon-filter'></i>  Filtrar</button>
									</div>
										<input type='text' readonly='' name='id' id='id' value='".$cod_carta."' style='visibility: hidden;width: 0px;'>

								</div>
								</form>
								".$tabela."
								
								
								
							</div>";
						
						
						



	}
	function listar_captacoes_carta($cod_carta,$data_inicio,$data_fim){
	include "config.php";
	if($data_inicio==""){$data_inicio='1900-01-01';}else{ $data_inicio=data($data_inicio);}
	if($data_fim==""){$data_fim='9999-12-31';}else{ $data_fim=data($data_fim);}
					$select= "SELECT
								captacao_cartas.cod_captacao_cartas,
								captacao_cartas.cod_carta as carta,
								captacao_cartas.numero_lote,
								captacao_cartas.data_vencimento,
								captacao_cartas.status,
								cad_status.status_resumido,
								cad_status.descricao,
								cad_cartas.cod_contribuinte as cod_contribuinte,
								cad_pessoas.nome_razao_social as nomecontribuinte,
								captacao_cartas.valor as valor,
								IFNULL(".$schema.".captacao_cartas_baixas.historico,'-') as historico,
								IFNULL(".$schema.".captacao_cartas_baixas.cod_carteira,0) as cod_carteira,
								IFNULL(max(captacao_cartas_baixas.data_baixa),'0000-00-00') as data_recebimento,
								IFNULL(sum(captacao_cartas_baixas.valor_baixa),0) as somabaixas,
								(captacao_cartas.valor-IFNULL(sum(captacao_cartas_baixas.valor_baixa),0)) as saldocaptacao
								
							FROM 
								".$schema.".captacao_cartas

							LEFT JOIN ".$schema.".cad_cartas ON
								".$schema.".cad_cartas.cod_carta=".$schema.".captacao_cartas.cod_carta

							LEFT JOIN ".$schema.".captacao_cartas_baixas ON 
								".$schema.".captacao_cartas_baixas.cod_captacao_cartas=".$schema.".captacao_cartas.cod_captacao_cartas

							LEFT JOIN ".$schema.".cad_pessoas ON
								".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_cartas.cod_contribuinte

							LEFT JOIN ".$schema.".cad_status ON
								cad_status.cod_status=captacao_cartas.status
								
							WHERE 
								captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
								captacao_cartas.cod_carta='".$cod_carta."' and
								(captacao_cartas.data_vencimento between '".$data_inicio."' and '".$data_fim."' )

							GROUP BY 	
								".$schema.".captacao_cartas.cod_captacao_cartas
							
							LIMIT 1000
								
								;";	
							
	

	
					$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);
					
						$tabela= "<div class='' style='overflow-x: scroll; margin-left: -10px;'><table class='uk-table uk-table-hover uk-table-condensed uk-text-nowrap uk-panel-box' style='font-size: 11px;max-width: 100%;'>";
						$tabela.=  
							"<tr>
							<th></th>
							<th></th>
							<th></th>
							<th>Histórico</th>
							<th>Vcto.Cap.</th>
							<th>Dt.Receb.</th>
							<th>Capt.(R$)</th>
							<th>Receb.(R$)</th>
							<th>Saldo (R$)</th>

							</tr>";						
						$n=1;
						
						while($row = mysql_fetch_array($resultado))
						{
						$tabela.=  
							"<tr>
							<th>".$n."</th>
							<th>
								<a href='cadastro_captacoes.php?id=".$row['cod_captacao_cartas']."'  target='_blank'>
									<div class='uk-button uk-button-mini uk-button-primary' style='width: 100%;'><i class='uk-icon-edit'></i>  Editar</div>
								</a>							
							</th>
							<td>".$row['status_resumido']."</td>
							<td>".$row['historico']."</td>
							<td>".data($row['data_vencimento'])."</td>
							<td>".data($row['data_recebimento'])."</td>
							<td style='text-align: right;'>".number_format($row['valor'], 2, ',', '.')."</td>
							<td style='text-align: right;'>".number_format($row['somabaixas'], 2, ',', '.')."</td>
							<td style='text-align: right;'>".number_format($row['saldocaptacao'], 2, ',', '.')."</td>
							</tr>";
						$n=$n+1;
						}	
						$campos_inputs=new inputs;
						$tabela.= "</table></div>";
						echo "<div class=' uk-width-1-1'>
								<h3><i class='uk-icon-tags'></i> Captações da carta</h3>
								<form method='get' class='uk-form'>
								<div class='uk-grid'>
									<div class='uk-width-1-3' style=''>";
									
										//carta_data_inicio
											$campos_inputs->input_form_row('','_data_inicio','Inicio','00/00/0000',"data-uk-datepicker={format:'DD/MM/YYYY'} onkeyup=javascript:formatar_data(this);");
								
							echo "	</div>
									<div class='uk-width-1-3' style=''>";
									
										//carta_data_fim
											$campos_inputs->input_form_row('','_data_fim','Fim','00/00/0000',"data-uk-datepicker={format:'DD/MM/YYYY'} onkeyup=javascript:formatar_data(this);");
									
							echo "	</div>
									<div class='uk-width-1-3' style=''><br>
										<button class='uk-button uk-button-primary uk-button-small'><i class='uk-icon-filter'></i>  Filtrar</button>
									</div>
										<input type='text' readonly='' name='id' id='id' value='".$cod_carta."' style='visibility: hidden;width: 0px;'>

								</div>
								</form>
								".$tabela."
								
								
								
							</div>";
						
						
						



	}
	function listar_cartas($cod_banco,$cod_campanha,$cod_carteira,$cod_centro,$cod_grupo,$cod_pessoa,$tipo_convenio,$cod_colaborador,$cod_ctrreceita,$status_carta,$valor_moeda_de,$valor_moeda_ate,$data_inicio_de,$data_inicio_ate,$data_fim_de,$data_fim_ate,$data_cancelamento_de,$data_cancelamento_ate,$periodicidade,$dia_debito,$cod_moeda,$carta_aberta,$cod_carta,$boleto_modo_envio){
		include "config.php";
					$select= "
								select 
									cad_cartas.cod_carta,
									cad_cartas.cod_contribuinte,
									cad_pessoas.nome_razao_social,
									cad_cartas.cod_colaborador,
									colaborador,
									tb_colaboradores.cod_grupo,
									cad_grupos.cod_centro,
									cad_moedas.moeda,
									cad_cartas.carta_valor_moeda,
									cad_cartas.carta_data_inicio,
									cad_cartas.carta_data_fim,
									DATE_FORMAT(cad_cartas.data_cancelamento,'%d/%m/%Y') as data_cancelamento,
									cad_cartas.carta_forma_pagamento,
									cad_cartas.debito_banco as debito_banco,
									cad_cartas.boleto_modo_envio as boleto_modo_envio,
									cad_status.*

								from 
									`".$schema."`.`cad_status`,
									`".$schema."`.`cad_cartas`
									
								left join ".$schema.".cad_pessoas on
									`".$schema."`.`cad_pessoas`.`cod_pessoa`=`".$schema."`.`cad_cartas`.`cod_contribuinte`
								left join ".$schema.".cad_moedas on
									`".$schema."`.`cad_moedas`.`cod_moeda`=`".$schema."`.`cad_cartas`.`carta_moeda` 
								left join (select ".$schema.".cad_pessoas.nome_razao_social as colaborador, ".$schema.".cad_colaboradores.cod_colaborador, ".$schema.".cad_colaboradores.cod_grupo from ".$schema.".cad_pessoas, ".$schema.".cad_colaboradores where ".$schema.".cad_colaboradores.cod_pessoa=".$schema.".cad_pessoas.cod_pessoa) as tb_colaboradores on
									tb_colaboradores.cod_colaborador=cad_cartas.cod_colaborador
								left join ".$schema.".cad_grupos on
									tb_colaboradores.cod_grupo=cad_grupos.cod_grupo
								
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								(
									`".$schema."`.`cad_cartas`.`carta_aberta`!='avulso' and								
									`".$schema."`.`cad_status`.`cod_status`=`".$schema."`.`cad_cartas`.`status_carta` and
									(`".$schema."`.`cad_cartas`.`carta_valor_moeda` between '".decimal($valor_moeda_de)."' and '".decimal($valor_moeda_ate)."') and 
									(`".$schema."`.`cad_cartas`.`carta_data_inicio` between '".data($data_inicio_de)."' and '".data($data_inicio_ate)."') and 
									(`".$schema."`.`cad_cartas`.`carta_data_fim` between '".data($data_fim_de)."' and '".data($data_fim_ate)."') ";
									if ($cod_carta!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`cod_carta` = '".$cod_carta."' ";}
									if ($status_carta!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`status_carta` = '".$status_carta."'";}
									if ($cod_pessoa!=""){ $select=$select. "and (`".$schema."`.`cad_cartas`.`cod_contribuinte` like '%".$cod_pessoa."%' or `".$schema."`.cad_pessoas.nome_razao_social like '%".$cod_pessoa."%') ";}
									if ($cod_ctrreceita!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`cod_ctrreceita` = '".$cod_ctrreceita."'";}
									if ($cod_campanha!=""){ $select=$select. "and `".$schema."`.`cad_grupos`.`cod_campanha` = '".$cod_campanha."'";}
									if ($cod_centro!=""){ $select=$select. "and `".$schema."`.`cad_grupos`.`cod_centro` = '".$cod_centro."'";}
									if ($cod_grupo!=""){ $select=$select. "and `".$schema."`.`tb_colaboradores`.`cod_grupo` = '".$cod_grupo."'";}
									if ($cod_colaborador!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`cod_colaborador` = '".$cod_colaborador."'";}
									if ($cod_moeda!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`carta_moeda` = '".$cod_moeda."'";}
									if ($carta_aberta!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`carta_aberta` = '".$carta_aberta."'";}
									if ($periodicidade!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`periodicidade` = '".$periodicidade."'";}
									if ($tipo_convenio!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`carta_forma_pagamento` = '".$tipo_convenio."'";}
									if ($dia_debito!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`carta_dia_debito` = '".$dia_debito."'";}
									if ($cod_banco!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`debito_banco` = '".$cod_banco."'";}
									if ($boleto_modo_envio!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`boleto_modo_envio` = '".$boleto_modo_envio."'";}
									if ($data_cancelamento_de!="01/01/1900" || $data_cancelamento_ate!="31/12/9999"){ $select=$select. "and (`".$schema."`.`cad_cartas`.`data_cancelamento` between '".data($data_cancelamento_de)."' and '".data($data_cancelamento_ate)."')";}
				
									$select=$select."
								)
										order by 
												cad_cartas.carta_data_inicio,
												cad_pessoas.nome_razao_social,
												cad_cartas.debito_banco
												
												";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;max-width: 100%;'>
					<tr>
						<th style='width: 20px;'>Status</th>
						<th style='width: 50px;'>Editar</th>
						<th style='width: 50px;'>Carta</th>
						<th >Colaborador</th>
						<th >Contribuinte</th>
						<th style='width: 50px;'>Pmto</th>
						<th style='width: 50px;'>Banco</th>
						<th style='width: 50px;'>Inicio</th>
						<th style='width: 50px;'>Fim</th>
						<th style='width: 50px;'>Cancel.</th>
						<th style='width: 30px;'>Moeda</th>
						<th style='width: 50px;'>Valor</th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
				if($row['cod_status']==1){$status="<div class='uk-badge uk-badge-success' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='ativa'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>ativa</div>";}
				if($row['cod_status']==9){$status="<div class='uk-badge uk-badge-danger' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='cancelada'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>cancelada</div>";}
				if($row['cod_status']==8){$status="<div class='uk-badge' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='renovada'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>renovada</div>";}
				if($row['cod_status']==2||$row['cod_status']==4||$row['cod_status']==5){$status="<div class='uk-badge uk-badge-warning' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='vencida'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>vencida</div>";}
				if($row['cod_status']==3){$status="<div class='uk-badge uk-badge-danger' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='inadimplente'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>inadimplente</div>";}
			
			
			$tabela.=
				"<tr>
					<td>".$status."</td>
					<td><a href='?id=".$row['cod_carta']."' target='_blank'><div class='uk-button uk-button-mini uk-button-primary' style='width: 100%;'><i class='uk-icon-edit'></i>Editar</div></a></td>
					<td>".$row['cod_carta']."</td>
					<td ><div style='' class='uk-text-truncate'>".$row['colaborador']."</div></td>
					<td ><div style='' class='uk-text-truncate'>".$row['nome_razao_social']."</div></td>
					<td>".$row['carta_forma_pagamento']."</td>
					<td>".$row['debito_banco']."</td>
					<td>".data($row['carta_data_inicio'])."</td>
					<td>".data($row['carta_data_fim'])."</td>
					<td>".$row['data_cancelamento']."</td>
					<td style='width: 30px !important;'><div style='width: 30px !important;' class='uk-text-truncate'>".$row['moeda']."</div></td>
					<td style='text-align:right;'>R$ ".number_format($row['carta_valor_moeda'], 2, ',', '.')."</td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo "<h3> Resultado da pesquisa</h3>";
			echo $tabela;


	}
	function listar_cartas_($cod_pessoa){
		include "config.php";
					$select= "
								select 
									cad_cartas.cod_carta,
									cad_cartas.cod_contribuinte,
									cad_pessoas.nome_razao_social,
									cad_cartas.cod_colaborador,
									colaborador,
									tb_colaboradores.cod_grupo,
									cad_grupos.cod_centro,
									cad_moedas.moeda,
									cad_cartas.carta_valor_moeda,
									cad_cartas.carta_data_inicio,
									cad_cartas.carta_data_fim,
									DATE_FORMAT(cad_cartas.data_cancelamento,'%d/%m/%Y') as data_cancelamento,
									cad_cartas.carta_forma_pagamento,
									cad_cartas.debito_banco as debito_banco,
									cad_cartas.boleto_modo_envio as boleto_modo_envio,
									cad_status.*

								from 
									`".$schema."`.`cad_status`,
									`".$schema."`.`cad_cartas`
									
								left join ".$schema.".cad_pessoas on
									`".$schema."`.`cad_pessoas`.`cod_pessoa`=`".$schema."`.`cad_cartas`.`cod_contribuinte`
								left join ".$schema.".cad_moedas on
									`".$schema."`.`cad_moedas`.`cod_moeda`=`".$schema."`.`cad_cartas`.`carta_moeda` 
								left join (select ".$schema.".cad_pessoas.nome_razao_social as colaborador, ".$schema.".cad_colaboradores.cod_colaborador, ".$schema.".cad_colaboradores.cod_grupo from ".$schema.".cad_pessoas, ".$schema.".cad_colaboradores where ".$schema.".cad_colaboradores.cod_pessoa=".$schema.".cad_pessoas.cod_pessoa) as tb_colaboradores on
									tb_colaboradores.cod_colaborador=cad_cartas.cod_colaborador
								left join ".$schema.".cad_grupos on
									tb_colaboradores.cod_grupo=cad_grupos.cod_grupo
								
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								(
									`".$schema."`.`cad_status`.`cod_status`=`".$schema."`.`cad_cartas`.`status_carta`
									and (`".$schema."`.`cad_cartas`.`cod_contribuinte` like '%".$cod_pessoa."%' or `".$schema."`.cad_pessoas.nome_razao_social like '%".$cod_pessoa."%') and
									`".$schema."`.`cad_cartas`.`cod_ctrreceita`=4
								)
							order by 
								cad_cartas.carta_data_inicio,
								cad_pessoas.nome_razao_social,
								cad_cartas.debito_banco
							limit 0,20
								";

		$resultado=mysql_query($select,$conexao) or die ($select);
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed ' style='font-size: 10px;width: 100%;'>
					<tr>
						<th style='text-align:center;'>Status</th>
						<th style='text-align:center;width: 50px;'>Carta</th>
						<th style='text-align:center;width: 100px;'>Colaborador</th>
						<th style='text-align:center;width: 100px;'>Contribuinte</th>
						<th style='text-align:center;'>Pmto</th>
						<th style='text-align:center;'>Banco</th>
						<th style='text-align:center;'>Inicio</th>
						<th style='text-align:center;'>Fim</th>
						<th style='text-align:center;'>Cancel.</th>
						<th style='text-align:center;width: 30px;'>Moeda</th>
						<th style='text-align:center;'>Valor</th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
				if($row['cod_status']==1){$status="<div class='uk-badge uk-badge-success' style='width: 100%;padding: 1px;'>ativa</div>";}
				if($row['cod_status']==9){$status="<div class='uk-badge uk-badge-danger' style='width: 100%;padding: 1px;'>cancelada</div>";}
				if($row['cod_status']==8){$status="<div class='uk-badge' style='width: 100%;padding: 1px;'>renovada</div>";}
				if($row['cod_status']==2){$status="<div class='uk-badge uk-badge-warning' style='width: 100%;padding: 1px;'>vencida</div>";}
				if($row['cod_status']==3){$status="<div class='uk-badge uk-badge-danger' style='width: 100%;padding: 1px;'>Inadimplente</div>";}
			
			
			$tabela.=
				"<tr>
					<td>".$status."</td>
					<td style='text-align: right;'>".$row['cod_carta']."</td>
					<td style='width: 100px !important;'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['colaborador']."</div></td>
					<td style='width: 100px !important;'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['nome_razao_social']."</div></td>
					<td>".$row['carta_forma_pagamento']."</td>
					<td>".$row['debito_banco']."</td>
					<td>".data($row['carta_data_inicio'])."</td>
					<td>".data($row['carta_data_fim'])."</td>
					<td>".$row['data_cancelamento']."</td>
					<td style='width: 30px !important;'><div style='width: 30px !important;' class='uk-text-truncate'>".$row['moeda']."</div></td>
					<td style='text-align:right;'>R$ ".number_format($row['carta_valor_moeda'], 2, ',', '.')."</td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;


	}
	function listar_cartas_avulsa(){
		include "config.php";
					$select= "
								select 
									cad_cartas.cod_carta,
									cad_cartas.cod_contribuinte,
									cad_pessoas.nome_razao_social,
									cad_cartas.cod_colaborador,
									colaborador,
									tb_colaboradores.cod_grupo,
									cad_grupos.cod_centro,
									cad_moedas.moeda,
									cad_cartas.carta_valor_moeda,
									cad_cartas.carta_data_inicio,
									cad_cartas.carta_data_fim,
									DATE_FORMAT(cad_cartas.data_cancelamento,'%d/%m/%Y') as data_cancelamento,
									cad_cartas.carta_forma_pagamento,
									cad_cartas.debito_banco as debito_banco,
									cad_cartas.boleto_modo_envio as boleto_modo_envio,
									cad_status.*

								from 
									`".$schema."`.`cad_status`,
									`".$schema."`.`cad_cartas`
									
								left join ".$schema.".cad_pessoas on
									`".$schema."`.`cad_pessoas`.`cod_pessoa`=`".$schema."`.`cad_cartas`.`cod_contribuinte`
								left join ".$schema.".cad_moedas on
									`".$schema."`.`cad_moedas`.`cod_moeda`=`".$schema."`.`cad_cartas`.`carta_moeda` 
								left join (select ".$schema.".cad_pessoas.nome_razao_social as colaborador, ".$schema.".cad_colaboradores.cod_colaborador, ".$schema.".cad_colaboradores.cod_grupo from ".$schema.".cad_pessoas, ".$schema.".cad_colaboradores where ".$schema.".cad_colaboradores.cod_pessoa=".$schema.".cad_pessoas.cod_pessoa) as tb_colaboradores on
									tb_colaboradores.cod_colaborador=cad_cartas.cod_colaborador
								left join ".$schema.".cad_grupos on
									tb_colaboradores.cod_grupo=cad_grupos.cod_grupo
								
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								(
									`".$schema."`.`cad_status`.`cod_status`=`".$schema."`.`cad_cartas`.`status_carta` and
									`".$schema."`.`cad_cartas`.`carta_aberta`='avulso' and
									(`".$schema."`.`cad_cartas`.`carta_valor_moeda` between '".decimal($_POST['valor_moeda_de'])."' and '".decimal($_POST['valor_moeda_ate'])."') and 
									(`".$schema."`.`cad_cartas`.`carta_data_inicio` between '".data($_POST['data_inicio_de'])."' and '".data($_POST['data_inicio_ate'])."') ";
									if ($_POST['cod_carta']!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`cod_carta` = '".$_POST['cod_carta']."' ";}
									if ($_POST['cod_pessoa']!=""){ $select=$select. "and (`".$schema."`.`cad_cartas`.`cod_contribuinte` like '%".$_POST['cod_pessoa']."%' or `".$schema."`.cad_pessoas.nome_razao_social like '%".$_POST['cod_pessoa']."%') ";}
									if ($_POST['cod_ctrreceita']!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`cod_ctrreceita` = '".$_POST['cod_ctrreceita']."'";}
									if ($_POST['cod_campanha']!=""){ $select=$select. "and `".$schema."`.`cad_grupos`.`cod_campanha` = '".$_POST['cod_campanha']."'";}
									if ($_POST['cod_centro']!=""){ $select=$select. "and `".$schema."`.`cad_grupos`.`cod_centro` = '".$_POST['cod_centro']."'";}
									if ($_POST['cod_grupo']!=""){ $select=$select. "and `".$schema."`.`tb_colaboradores`.`cod_grupo` = '".$_POST['cod_grupo']."'";}
									if ($_POST['cod_colaborador']!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`cod_colaborador` = '".$_POST['cod_colaborador']."'";}
									if ($_POST['status_carta']!=""){ $select=$select. "and `".$schema."`.`cad_cartas`.`status_carta` = '".$_POST['status_carta']."'";}
				
									$select=$select."
								)
										order by 
												cad_cartas.carta_data_inicio,
												cad_pessoas.nome_razao_social,
												cad_cartas.debito_banco
												
												";
						
							
		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "<div style='overflow-x: scroll;'>
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;max-width: 100%;'>
					<tr>
						<th style='width: 20px;'>Status</th>
						<th style='width: 50px;'>Editar</th>
						<th style='width: 50px;'>Carta</th>
						<th >Colaborador</th>
						<th >Contribuinte</th>
						<th style='width: 40px;'>Data</th>
						<th style='width: 40px;'>Cancel.</th>
						<th style='width: 30px;'>Moeda</th>
						<th style='width: 40px;'>Valor</th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
				if($row['cod_status']==1){$status="<div class='uk-badge uk-badge-success' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='ativa'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>ativa</div>";}
				if($row['cod_status']==9){$status="<div class='uk-badge uk-badge-danger' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='cancelada'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>cancelada</div>";}
				if($row['cod_status']==8){$status="<div class='uk-badge' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='renovada'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>renovada</div>";}
				if($row['cod_status']==2||$row['cod_status']==4||$row['cod_status']==5){$status="<div class='uk-badge uk-badge-warning' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='vencida'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>vencida</div>";}
				if($row['cod_status']==3){$status="<div class='uk-badge uk-badge-danger' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='inadimplente'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>inadimplente</div>";}
			
			
			$tabela.=
				"<tr>
					<td>".$status."</td>
					<td><a href='?id=".$row['cod_carta']."' target='_blank'><div class='uk-button uk-button-mini uk-button-primary' style='width: 100%;'><i class='uk-icon-edit'></i>Editar</div></a></td>
					<td>".$row['cod_carta']."</td>
					<td><div style='' class='uk-text-truncate'>".$row['colaborador']."</div></td>
					<td><div style='' class='uk-text-truncate'>".$row['nome_razao_social']."</div></td>
					<td>".data($row['carta_data_inicio'])."</td>
					<td>".$row['data_cancelamento']."</td>
					<td style='width: 30px !important;'><div style='width: 30px !important;' class='uk-text-truncate'>".$row['moeda']."</div></td>
					<td style='text-align:right;'>R$ ".number_format($row['carta_valor_moeda'], 2, ',', '.')."</td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table></div>";
			echo "<h3> Resultado da pesquisa</h3>";
			echo $tabela;
		
		
	}

	function listar_anexos_carta($cod_carta){
	include "config.php";
						
					$select= "
							select 
								*
								
							from 
								".$schema.".cad_anexos 
								
							where 
								cad_anexos.cod_empresa=".$_SESSION['cod_empresa']." and								
								origem_tabela='cad_cartas' and
								origem_campo_id='cod_carta' and
								origem_cod_id='".$cod_carta."'
								";
								
					$resultado=mysql_query($select,$conexao) or die ($select);
					$tabela= "<table class='uk-table uk-table-hover uk-table-condensed' style='font-size: 11px;'>

							";
					$n=1;
					while($row = mysql_fetch_array($resultado))
					{
					$tabela.= "
							<tr>
								<td><a href='php/delete_file.php?cod_anexo=". $row['cod_anexo']."&cod_carta=". $row['origem_cod_id']."' class='uk-button uk-button-small uk-button-danger' style='width: 100%;padding: 0px;'><i class='uk-icon-trash' ></i> Excluir</a></td>
								<td><a href='". $row['caminho_arquivo']."' download='". $row['nome_arquivo']."'  class='uk-button uk-button-small uk-button-success' style='width: 100%;padding: 0px;'><i class='uk-icon-download'></i> Download</a></td>
								<td><div style='width: 100px !important;' class='uk-text-truncate'>". $row['nome_arquivo']."</div></td>
								<td>". $row['tamanho_arquivo']."kb</td>
								<td>". $row['extensao']."</td>
								<td>". $row['data_inclusao']."</td>
							</tr>";
							$n=$n+1;
					}	
					$tabela.= "</table>";
	
	
	
	
	
	
	echo "
<div id='div_anexos' name='div_anexos' class='uk-width-1-1' >
			<h3><i class='uk-icon-cloud-upload'></i> Lista de Anexos</h3>
			<form id='form_anexos' action='php/upload_file.php' method='POST' enctype='multipart/form-data'>
				<span class='uk-button uk-button-small uk-button-primary uk-navbar-flip' style='margin-right: 20px;' onclick='getFile();'><i class='uk-icon-cloud-upload'></i> Fazer o upload de arquivos</span>
				<input type='file'  name='file' id='file' style='visibility: hidden;'  onchange=javascript:document.getElementById('form_anexos').submit();><br>
				<input type='text' id='origem_tabela' name='origem_tabela' value='cad_cartas' style=' width: 1px;  visibility: hidden;'>
				<input type='text' id='origem_campo_id' name='origem_campo_id' value='cod_carta' style=' width: 1px;  visibility: hidden;'>
				<input type='text' id='origem_cod_id' name='origem_cod_id' value='".$cod_carta."' style=' width: 1px;  visibility: hidden;'>
			</form>
			<div id='anexos' name='anexos' class='anexos'>".$tabela."</div>
</div>	
	
	";
	
	
	}
	function listar_pessoas($pesquisa){
	include "config.php";
		$select= "
				select 
					*
					
				from 
					".$schema.".cad_pessoas
				
				where 
					cad_pessoas.cod_empresa=".$_SESSION['cod_empresa']." and
					(
						cod_pessoa like '%".$_GET['pesquisa']."%' or
						nome_razao_social like '%".$_GET['pesquisa']."%'
					);";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;' id='grid'>
					<thead>
						<tr>
							<th style='width: 50px !important;'>Editar</th>
							<th style='width: 50px !important;'>Código</th>
							<th style='width: 150px !important;'>Nome ou Razão Social</th>
							<th>Telefone</th>
							<th>Telefone</th>
							<th style='width: 100px !important;'>Email</th>
							<th style='width: 100px !important;'>Email</th>
							<th style='width: 150px !important;'>Endereço</th>
							<th style='width: 30px !important;'>CEP</th>
							<th style='width: 50px !important;'>Cidade</th>
							<th style='width: 20px !important;'>UF</th>
						</tr>
					</thead>
					<tbody>
					";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=  
				"<tr>
					<td><a href='?id=".$row['cod_pessoa']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td>".$row['cod_pessoa']."</td>
					<td style='width: 150px !important;'><div style='width: 150px !important;' class='uk-text-truncate'>".$row['nome_razao_social']."</div></td>
					<td>".$row['telefone_1']."</td>
					<td>".$row['celular_1']."</td>
					<td style='width: 100px !important;'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['email_1']."</div></td>
					<td style='width: 100px !important;'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['email_2']."</div></td>
					<td style='width: 150px !important;'><div style='width: 150px !important;' class='uk-text-truncate'>".$row['endereco'].", ".$row['numero']."".$row['complemento']."</div></td>
					<td style='width: 30px !important;'><div style='width: 30px !important;' class='uk-text-truncate'>".$row['cep']."</div></td>
					<td style='width: 50px !important;'><div style='width: 50px !important;' class='uk-text-truncate'>".$row['cidade']."</div></td>
					<td style='width: 20px !important;'><div style='width: 20px !important;' class='uk-text-truncate'>".$row['uf']."</div></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</tbody></table>";
			echo $tabela;
	
	
	}
	function listar_campanhas($pesquisa){
	include "config.php";
		
		$select= "
					select 
						cod_campanha,
						nome_campanha,
						DATE_FORMAT(data_inicio,'%d/%m/%Y') as data_inicio,
						DATE_FORMAT(data_fim,'%d/%m/%Y') as data_fim
						
					from 
						".$schema.".cad_campanhas 
						
					where 
						cad_campanhas.cod_empresa=".$_SESSION['cod_empresa']." and	
						(
							cod_campanha like '%".$pesquisa."%' or
							nome_campanha like '%".$pesquisa."%'
						)						;";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;'>
					<tr>
						<th style='width: 50px !important;'></th>
						<th style='width: 50px !important;'>Código</th>
						<th style='width: 250px !important;'>Nome da Campanha</th>
						<th style='width: 100px !important;'>Data Inicio</th>
						<th style='width: 100px !important;'>Data Fim</th>
						<th></th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td style='width: 50px !important;'><a href='?id=".$row['cod_campanha']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td style='width: 50px !important;'>".$row['cod_campanha']."</td>
					<td style='width: 250px !important;'>".$row['nome_campanha']."</td>
					<td style='width: 100px !important;'>".$row['data_inicio']."</td>
					<td style='width: 100px !important;'>".$row['data_fim']."</td>
					<td></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;
	
	}
	function listar_carteiras($pesquisa){
	include "config.php";
		
	$select= "
					select 
						cod_carteira,
						nome_carteira
						
					from 
						".$schema.".cad_carteiras 
						
					where 
						cad_carteiras.cod_empresa=".$_SESSION['cod_empresa']." and	
						(
							cod_carteira like '%".$pesquisa."%' or
							nome_carteira like '%".$pesquisa."%'
						)
						;";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;'>
					<tr style='width:100%;'>
						<th style='width: 50px !important;'></th>
						<th style='width: 50px !important;'>Código</th>
						<th style='width: 250px !important;'>Nome da carteira</th>
						<th></th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td style='width: 50px !important;'><a href='?id=".$row['cod_carteira']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td style='width: 50px !important;'>".$row['cod_carteira']."</td>
					<td style='width: 250px !important;'>".$row['nome_carteira']."</td>
					<td></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;
	
	}
	function listar_centros($pesquisa){
	include "config.php";
		
		$select= "
					select 
						cod_centro,
						nome_centro,
						abreviatura_centro,
						telefone_1,
						telefone_2

						
					from 
						".$schema.".cad_centros 
						
					where 
						cad_centros.cod_empresa=".$_SESSION['cod_empresa']." and
						(
							cod_centro like '%".$pesquisa."%' or
							nome_centro like '%".$pesquisa."%' or
							abreviatura_centro like '%".$pesquisa."%'						
						)
						";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;'>
					<tr style='width:100%;'>
						<th style='width: 50px !important;'></th>
						<th style='width: 50px !important;'>Código</th>
						<th style='width: 250px !important;'>Nome do Centro</th>
						<th style='width: 100px !important;'>Abreviatura</th>
						<th style='width: 150px !important;'>Telefone 1</th>
						<th style='width: 150px !important;'>Telefone 2</th>
						<th></th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td style='width: 50px !important;'><a href='?id=".$row['cod_centro']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td style='width: 50px !important;'>".$row['cod_centro']."</td>
					<td style='width: 250px !important;'>".$row['nome_centro']."</td>
					<td style='width: 100px !important;'>".$row['abreviatura_centro']."</td>
					<td style='width: 150px !important;'>".$row['telefone_1']."</td>
					<td style='width: 150px !important;'>".$row['telefone_2']."</td>
					<td></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;
	
	}
	function listar_colaboradores($pesquisa){
	include "config.php";
		
		$select= "
				select 
					cad_colaboradores.cod_colaborador,
					cad_grupos.nome_grupo,
					`cad_centros`.`nome_centro`,
					`cad_campanhas`.`nome_campanha`,
					cad_pessoas.nome_razao_social,
					cad_pessoas.email_1,
					cad_pessoas.email_2,
					cad_colaboradores.cod_pessoa,
					cad_colaboradores.cod_grupo,
					cad_colaboradores.data_inclusao
					
				from 
					`".$schema."`.`cad_grupos`,
					`".$schema."`.`cad_colaboradores`,
					`".$schema."`.`cad_pessoas`,
					`".$schema."`.`cad_centros`,
					`".$schema."`.`cad_campanhas`

				where 
					cad_colaboradores.cod_empresa=".$_SESSION['cod_empresa']." and	
					(
						`".$schema."`.`cad_grupos`.cod_centro= `".$schema."`.`cad_centros`.cod_centro and
						`".$schema."`.`cad_grupos`.cod_campanha=`".$schema."`.`cad_campanhas`.cod_campanha and
						`cad_grupos`.cod_grupo=`cad_colaboradores`.cod_grupo and
						cad_colaboradores.cod_pessoa=cad_pessoas.cod_pessoa and
						(`cad_grupos`.cod_grupo like '%".$_GET['pesquisa']."%' or
						`cad_centros`.`nome_centro` like '%".$_GET['pesquisa']."%' or
						`cad_campanhas`.`nome_campanha` like '%".$_GET['pesquisa']."%' or
						nome_razao_social like '%".$_GET['pesquisa']."%' or
						`cad_grupos`.nome_grupo like '%".$_GET['pesquisa']."%')
					)
				
				order by
					nome_campanha,
					nome_centro,
					nome_grupo,
					nome_razao_social;";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;'>
					<tr style='width:100%;'>
						<th style='width: 50px !important;'></th>
						<th style='width: 100px !important;'></th>
						<th style='width: 50px !important;'>Código</th>
						<th style='width: 150px !important;'>Campanha</th>
						<th style='width: 150px !important;'>Centro</th>
						<th style='width: 150px !important;'>Nome do Grupo</th>
						<th style='width: 150px !important;'>Colaborador</th>
						<th style='width: 100px !important;'>Email</th>
						<th style='width: 100px !important;'>Email</th>
						<th></th>

					</tr>";						
			$n=1;

			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td style='width: 50px !important;'><a href='?id=".$row['cod_colaborador']."' class='uk-button uk-button-mini uk-button-primary'><i class='uk-icon-edit'></i>  Editar</a></td>
					<td style='width: 100px !important;'><button class='uk-button uk-button-mini uk-button-primary' onclick='enviar_dados_acesso_colaborador(".$row['cod_colaborador'].");'><i class='uk-icon-link'></i>  Enviar dados de acesso </button></td>
					<td style='width: 50px !important;'>".$row['cod_colaborador']."</td>
					<td style='width: 150px !important;'><div style='width: 120px !important;' class='uk-text-truncate'>".$row['nome_campanha']."</div></td>
					<td style='width: 150px !important;'><div style='width: 120px !important;' class='uk-text-truncate'>".$row['nome_centro']."</div></td>
					<td style='width: 150px !important;'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['nome_grupo']."</div></td>
					<td style='width: 150px !important;'><div style='width: 120px !important;' class='uk-text-truncate'>".$row['nome_razao_social']."</div></td>
					<td style='width: 100px !important;'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['email_1']."</div></td>
					<td style='width: 100px !important;'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['email_2']."</div></td>
					<td></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;
	
	}
	function listar_convenios($pesquisa){
	include "config.php";
		
		$select= "
						select 
							cad_convenios.*,
							cad_bancos.nome_banco
							
						from 
							".$schema.".cad_convenios,
							".$schema.".cad_bancos
						
						where 
							cad_convenios.cod_empresa=".$_SESSION['cod_empresa']." and		
							(
								cad_convenios.cod_do_banco=cad_bancos.cod_banco and 
								(cod_convenio like '%".$pesquisa."%' or
								tipo_convenio like '%".$pesquisa."%' or
								codigo_convenio like '%".$pesquisa."%' or
								nome_banco like '%".$pesquisa."%')
							)

							
							";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;'>
					<tr style='width:100%;'>
						<th style='width: 50px !important;'></th>
						<th style='width: 50px !important;'>Código</th>
						<th style='width: 50px !important;'>Tipo</th>
						<th style='width: 150px !important;'>Número do Convênio</th>
						<th style='width: 50px !important;'>Banco</th>
						<th style='width: 150px !important;'>Nome do Banco</th>
						<th style='width: 50px !important;'>Agencia</th>
						<th style='width: 100px !important;'>Conta</th>
						<th style='width: 50px !important;'>Último Lote</th>
						<th style='width: 50px !important;'>Cod carteira</th>
						<th ></th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td style='width: 50px !important;'><a href='?id=".$row['cod_convenio']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td style='width: 50px !important;'>".$row['cod_convenio']."</td>
					<td style='width: 50px !important;'>".$row['tipo_convenio']."</td>
					<td style='width: 150px !important;'>".$row['codigo_convenio']."</td>
					<td style='width: 50px !important;'>".$row['cod_do_banco']."</td>
					<td style='width: 150px !important;'>".$row['nome_banco']."</td>
					<td style='width: 50px !important;'>".$row['agencia']."</td>
					<td style='width: 100px !important;'>".$row['conta']."</td>
					<td style='width: 50px !important;'>".$row['ultimo_lote']."</td>
					<td style='width: 50px !important;'>".$row['cod_carteira']."</td>
					<td ></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;

}
	function listar_grupos($pesquisa){
	include "config.php";
		
		$select= "
				select 
					* 
					
				from 
					`".$schema."`.`cad_grupos`,
					`".$schema."`.`cad_centros`,
					`".$schema."`.`cad_campanhas`

				where 
					cad_grupos.cod_empresa=".$_SESSION['cod_empresa']." and		
					(
						`".$schema."`.`cad_grupos`.cod_centro= `".$schema."`.`cad_centros`.cod_centro and
						`".$schema."`.`cad_grupos`.cod_campanha=`".$schema."`.`cad_campanhas`.cod_campanha and					
						(cod_grupo like '%".$pesquisa."%' or
						`".$schema."`.`cad_centros`.`nome_centro` like '%".$pesquisa."%' or
						`".$schema."`.`cad_campanhas`.`nome_campanha` like '%".$pesquisa."%' or
						nome_grupo like '%".$pesquisa."%')
					)

				
				order by
					nome_campanha,
					nome_centro,
					nome_grupo;";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;'>
					<tr style='width:100%;'>
						<th style='width: 50px !important;'></th>
						<th style='width: 50px !important;'>Código</th>
						<th style='width: 150px !important;'>Campanha</th>
						<th style='width: 250px !important;'>Centro</th>
						<th style='width: 150px !important;'>Nome do Grupo</th>
						<th></th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td style='width: 50px !important;'><a href='?id=".$row['cod_grupo']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td style='width: 50px !important;'>".$row['cod_grupo']."</td>
					<td style='width: 150px !important;'>".$row['nome_campanha']."</td>
					<td style='width: 250px !important;'>".$row['nome_centro']."</td>
					<td style='width: 150px !important;'>".$row['nome_grupo']."</td>
					<td></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;

}
	function listar_moedas($pesquisa){
	include "config.php";
		
		$select= "
					select 
						cod_moeda,
						moeda
						
					from 
						".$schema.".cad_moedas 
						
					where 
						cad_moedas.cod_empresa=".$_SESSION['cod_empresa']." and		
						(
							cod_moeda like '%".$pesquisa."%' or
							moeda like '%".$pesquisa."%'
						)

						;";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed  uk-text-nowrap uk-panel-box' style='font-size: 11px;margin-top: -5px;'>
					<tr style='width:100%;'>
						<th style='width: 50px !important;'></th>
						<th style='width: 50px !important;'>Código</th>
						<th style='width: 250px !important;'>Nome da moeda</th>
						<th ></th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td style='width: 50px !important;'><a href='?id=".$row['cod_moeda']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td style='width: 50px !important;'>".$row['cod_moeda']."</td>
					<td style='width: 250px !important;'>".$row['moeda']."</td>
					<td></td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;

}
	function listar_captacoes($cod_carta,$cod_captacao,$lote_envio,$data_inicio_de,$data_inicio_ate,$status_captacao_resumido, $captacao_cartas_cod_retorno,$valor_moeda_de,$valor_moeda_ate,$cod_pessoa,$cod_colaborador,$cod_ctrreceita,$cod_centro,$cod_grupo,$cod_banco,$cod_carteira,$tipo_convenio,$boleto_modo_envio,$carta_aberta ){
	
	include "config.php";
	if($data_inicio_de==""){$data_inicio_de="0000-01-01";}else{ $data_inicio_de=data($data_inicio_de);}
	if($data_inicio_ate==""){$data_inicio_ate="9999-12-31";}else{ $data_inicio_ate=data($data_inicio_ate);}
	if($valor_moeda_de==""){$valor_moeda_de=0;}else{ $valor_moeda_de=$valor_moeda_de;}
	if($valor_moeda_ate==""){$valor_moeda_ate=99999999999999;}else{ $valor_moeda_de=$valor_moeda_de;}

					
					$select= "SELECT
								captacao_cartas.cod_captacao_cartas,
								captacao_cartas.cod_carta as carta,
								captacao_cartas.numero_lote,
								captacao_cartas.data_vencimento,
								captacao_cartas.status,
								cad_convenios.cod_do_banco,								
								cad_bancos.nome_banco,
								cad_status.cod_status,
								cad_status.status_resumido,
								cad_status.descricao,
								cad_cartas.cod_contribuinte as cod_contribuinte,
								cad_cartas.carta_forma_pagamento as carta_forma_pagamento,
								cad_cartas.cod_motivo_cancelamento as cod_motivo_cancelamento,
								cad_motivo_cancelamento.motivo_cancelamento,
								cad_pessoas.nome_razao_social as nomecontribuinte,
								captacao_cartas.valor as Vl_Captacao,
								IFNULL(max(captacao_cartas_baixas.data_baixa),'0000-00-00') as data_baixa,
								IFNULL(sum(captacao_cartas_baixas.valor_baixa),0) as Vl_Recebido,
								(captacao_cartas.valor-IFNULL(sum(captacao_cartas_baixas.valor_baixa),0)) as Saldo
								
							FROM 
								".$schema.".captacao_cartas

							LEFT JOIN ".$schema.".cad_cartas ON
								".$schema.".cad_cartas.cod_carta=".$schema.".captacao_cartas.cod_carta 
							
							LEFT JOIN ".$schema.".cad_convenios ON
								".$schema.".cad_cartas.debito_banco=".$schema.".cad_convenios.cod_do_banco and
								".$schema.".cad_cartas.carta_forma_pagamento=".$schema.".cad_convenios.tipo_convenio

							LEFT JOIN ".$schema.".cad_bancos ON
								".$schema.".cad_bancos.cod_banco=".$schema.".cad_convenios.cod_do_banco
								
							LEFT JOIN ".$schema.".captacao_cartas_baixas ON 
								".$schema.".captacao_cartas_baixas.cod_captacao_cartas=".$schema.".captacao_cartas.cod_captacao_cartas
						
							LEFT JOIN ".$schema.".cad_motivo_cancelamento ON 
								".$schema.".cad_motivo_cancelamento.cod_motivo_cancelamento=".$schema.".cad_cartas.cod_motivo_cancelamento

							LEFT JOIN ".$schema.".cad_pessoas ON
								".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_cartas.cod_contribuinte
							
							LEFT JOIN ".$schema.".cad_status ON
								cad_status.cod_status=captacao_cartas.status
								
							LEFT JOIN ".$schema.".cad_colaboradores ON
								cad_colaboradores.cod_colaborador=cad_cartas.cod_colaborador
								
							LEFT JOIN ".$schema.".cad_grupos ON
								cad_grupos.cod_grupo=cad_colaboradores.cod_grupo
							
							WHERE
								captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
								(
									(captacao_cartas.data_vencimento between '".$data_inicio_de."' and '".$data_inicio_ate."') and 
									(captacao_cartas.valor between ".$valor_moeda_de." and ".$valor_moeda_ate." )";							
								
									//if($cod_pessoa !=""){$select=$select." and cad_cartas.cod_contribuinte = '".$cod_pessoa."'";}
									if($status_captacao_resumido !=""){$select=$select." and cad_status.status_resumido = '".$status_captacao_resumido."'";}
									if($captacao_cartas_cod_retorno !=""){$select=$select." and cad_status.cod_status = '".$captacao_cartas_cod_retorno."'";}
									if($cod_captacao !=""){$select=$select." and captacao_cartas.cod_captacao_cartas = '".$cod_captacao."'";}
									if($cod_carta !=""){$select=$select." and captacao_cartas.cod_carta = '".$cod_carta."'";}
									if($cod_banco !=""){$select=$select." and cad_cartas.debito_banco = '".$cod_banco."'";}
									if($tipo_convenio !=""){$select=$select." and cad_cartas.carta_forma_pagamento = '".$tipo_convenio."'";}
									if($boleto_modo_envio !=""){$select=$select." and cad_cartas.boleto_modo_envio = '".$boleto_modo_envio."'";}
									if($cod_pessoa!=""){ $select=$select. "and (cad_pessoas.nome_razao_social like '%".$cod_pessoa."%') ";}

									if($cod_colaborador !=""){$select=$select." and cad_cartas.cod_colaborador = '".$cod_colaborador."'";}
									if($carta_aberta !=""){$select=$select." and cad_cartas.carta_aberta = '".$carta_aberta."'";}
									if($cod_ctrreceita !=""){$select=$select." and cad_cartas.cod_ctrreceita = '".$cod_ctrreceita."'";}
									if($cod_centro !=""){$select=$select." and cad_grupos.cod_centro = '".$cod_centro."'";}
									if($cod_grupo !=""){$select=$select." and cad_colaboradores.cod_grupo = '".$cod_grupo."'";}
									
										
									$select=$select."
								)
							GROUP BY 	

								".$schema.".captacao_cartas.data_vencimento,
								".$schema.".captacao_cartas.cod_captacao_cartas,
								captacao_cartas_baixas.data_baixa;";

					$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);
						
						echo "<h3> Resultado da pesquisa</h3>";
						echo "<table class='uk-table uk-table-hover uk-table-condensed uk-text-nowrap uk-panel-box' style='font-size: 11px;max-width: 100%;'>";
						echo  
							"<tr>
							<th class='cabecalho'></th>
							<th class='cabecalho'>Selecionar</th>
							<th class='cabecalho'>Editar</th>
							<th class='cabecalho'>Status</th>
							<th class='cabecalho'>M.Canc.</th>
							<th class='cabecalho'>Captacao</th>
							<th class='cabecalho'>Carta</th>
							<th class='cabecalho'>Banco</th>
							<th class='cabecalho'>Pmto</th>
							<th class='cabecalho'>Contribuinte</th>
							<th class='cabecalho'>Data Vcto.</th>
							<th class='cabecalho'>Data Receb.</th>
							<th class='cabecalho'>Capt. (R$)</th>
							<th class='cabecalho'>Receb. (R$)</th>
							<th class='cabecalho'>Saldo (R$)</th>
							</tr>";						
						
						$n=1;
						$total_captacao=0;
						$total_recebido=0;
						$total_saldo=0;
						$status="";
						while($row = mysql_fetch_array($resultado))
						{
			
							if($row['status_resumido']=='captacao_recebida'){$status="<div class='uk-badge uk-badge-success' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='".$row['status_resumido']."'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>".$row['status_resumido']."</div>";}
							if($row['status_resumido']=='cancelado'){$status="<div class='uk-badge uk-badge-danger' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='".$row['status_resumido']."'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>".$row['status_resumido']."</div>";}
							if($row['status_resumido']=='arquivo_gerado'||$row['status_resumido']=='captacao_gerada'){$status="<div class='uk-badge' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='".$row['status_resumido']."'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>".$row['status_resumido']."</div>";}
							if($row['status_resumido']=='recebimento_suspenso'){$status="<div class='uk-badge uk-badge-warning' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='".$row['status_resumido']."'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>".$row['status_resumido']."</div>";}
							if($row['status_resumido']=='baixa_parcial'){$status="<div class='uk-badge uk-badge-warning' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='".$row['status_resumido']."'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>".$row['status_resumido']."</div>";}
							if($row['status_resumido']=='inadimplente'){$status="<div class='uk-badge uk-badge-danger' style='text-align: center; vertical-align: middle; padding-top: 4px; padding-bottom: 5px; width: 20px;' data-uk-tooltip title='".$row['status_resumido']."'><i class='uk-icon-flag-checkered'></i></div><div style='visibility: hidden; height: 0px; width: 0px ! important;'>".$row['status_resumido']."</div>";}
						
								
						
						echo  
							"<tr>
								<td>".$n."</td>
								<td style='text-align: center;vertical-align: middle;'>
									<input type='checkbox' class='checkbox_selecionar' valor_captacao='".$row['Vl_Captacao']."' id='".$row['cod_captacao_cartas']."'>
								</td>
								<td>
									<a href='?id=".$row['cod_captacao_cartas']."' target='_blank'>
										<div class='uk-button uk-button-mini uk-button-primary' style='width: 100%;'><i class='uk-icon-edit'></i>Editar</div>
									</a>
								</td>
								<td>
									".$status."
								</td>
								<td style='text-align: center;'>
									<span style='width: 15px !important;' class='uk-badge uk-badge-success uk-text-truncate' data-uk-tooltip={pos:'right'} title='".$row['cod_motivo_cancelamento']." - ".$row['motivo_cancelamento']."'>".$row['cod_motivo_cancelamento']."</span>
								</td>
								<td style='text-align: center;'>".$row['cod_captacao_cartas']."</td>
								<td style='text-align: center;'>".$row['carta']."</td>
								<td class='nome'>".$row['cod_do_banco']."</td>
								<td>".$row['carta_forma_pagamento']."</td>
								<td class='nome'><div style='width: 100px !important;' class='uk-text-truncate'>".$row['nomecontribuinte']."</div></td>
								<td>".data($row['data_vencimento'])."</td>
								<td>".data($row['data_baixa'])."</td>
								<td style='text-align:right;'>".number_format($row['Vl_Captacao'], 2, ',', '.')."</td>
								<td style='text-align:right;'>".number_format($row['Vl_Recebido'], 2, ',', '.')."</td>
								<td style='text-align:right;'>".number_format($row['Saldo'], 2, ',', '.')."</td>
							</tr>";
							$n=$n+1;
							$total_captacao=$total_captacao+$row['Vl_Captacao'];
							$total_recebido=$total_recebido+$row['Vl_Recebido'];
							$total_saldo=$total_saldo+$row['Saldo'];
						}
						
						//echo
						$xxxx=  
							"<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td style='text-align:right;'>".number_format($total_captacao, 2, ',', '.')."</td>
								<td style='text-align:right;'>".number_format($total_recebido, 2, ',', '.')."</td>
								<td style='text-align:right;'>".number_format($total_saldo, 2, ',', '.')."</td>
							</tr>";						
						echo "</table>";



	}
	function listar_baixas_captacao($cod_captacao_cartas){
	include "config.php";
		
		$select= "
				select 
					captacao_cartas_baixas.cod_captacao_cartas_baixas,
					DATE_FORMAT(captacao_cartas_baixas.data_baixa,'%d/%m/%Y') as data_baixa,
					captacao_cartas_baixas.valor_baixa,
					captacao_cartas_baixas.historico,
					captacao_cartas_baixas.cod_carteira,
					captacao_cartas_baixas.cod_captacao_cartas,
					cad_carteiras.nome_carteira
					
					
				from 
					".$schema.".captacao_cartas_baixas,
					".$schema.".cad_carteiras
				
				where 
					captacao_cartas_baixas.cod_carteira=cad_carteiras.cod_carteira and
					captacao_cartas_baixas.cod_captacao_cartas= ".$cod_captacao_cartas.";";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			echo "<table class='uk-table uk-table-hover uk-table-condensed uk-table-striped uk-text-nowrap uk-panel-box' style='width: 100%;font-size: 12px;'>
				<tr>
					<th  style='width:5%;'></th>
					<th  style='width:5%;'></th>
					<th  style='width:30%;'>carteira</th>
					<th  style='width:30%;'>Histórico</th>
					<th  style='width:10%;'>Data</th>
					<th  style='width:15%;'>Valor</th>
				</tr>";
			$n=1;
		
			while($row = mysql_fetch_array($resultado))
			{
				echo "	<tr id='".$row['cod_captacao_cartas_baixas']."' class='tr_sem_foco' ;='' onmouseover='TR_onMouseOver(this)' onmouseout='TR_onMouseOut(this)' onclick='TR_onClick(this)'>
							<td style='text-align:center;'>".$n."</td>
							<td>
								<a href='php/excluir_baixa.php?baixa=".$row['cod_captacao_cartas_baixas']."&cod_captacao=".$row['cod_captacao_cartas']."'>
									<div class='uk-button uk-button-mini uk-button-danger' style='width: 100%;' data-uk-tooltip={pos:'right'} title='Excluir baixa' data-cached-title='Excluir baixa'><i class='uk-icon-trash-o'></i> Excluir</div>
								</a>
							</td>
							<td>".$row['nome_carteira']."</td>
							<td>".$row['historico']."</td>
							<td>".$row['data_baixa']."</td>
							<td style='text-align:right;'>".$row['valor_baixa']."</td>

						</tr>";
						
				$n=$n+1;
			}
			echo "</table>";	
	
	
	}
	function listar_extrato_carteira($cod_carta,$cod_captacao,$lote_envio,$data_inicio_de,$data_inicio_ate,$lote_retorno,$valor_moeda_de,$valor_moeda_ate,$cod_pessoa,$cod_carteira){
		include "config.php";
		$select= "
				select 
					captacao_cartas.cod_carta,
					captacao_cartas.cod_captacao_cartas,
					captacao_cartas_baixas.cod_captacao_cartas_baixas,
					
					cad_cartas.cod_contribuinte,
					contribuinte.contribuinte,
					
					cad_cartas.cod_colaborador,
					colaborador.colaborador,
					
					cad_cartas.cod_ctrreceita,
					cad_ctrreceitas.nome as ctrreceitas,
					
					DATE_FORMAT(captacao_cartas.data_vencimento,'%d/%m/%Y') as data_vencimento,
					DATE_FORMAT(captacao_cartas_baixas.data_baixa,'%d/%m/%Y') as data_baixa,
					
					ROUND(captacao_cartas.valor,2) as valor,
					ROUND(captacao_cartas_baixas.valor_baixa,2) as valor_baixa,

					captacao_cartas_baixas.historico,
					cad_cartas.carta_forma_pagamento as forma_pagamento,
					
					captacao_cartas_baixas.cod_carteira,
					cad_carteiras.nome_carteira

				from 
					".$schema.".captacao_cartas_baixas

				left join ".$schema.".cad_carteiras on 
						captacao_cartas_baixas.cod_carteira=cad_carteiras.cod_carteira

				left join ".$schema.".captacao_cartas on
						captacao_cartas_baixas.cod_captacao_cartas=captacao_cartas.cod_captacao_cartas

				left join ".$schema.".cad_cartas on
						captacao_cartas.cod_carta=cad_cartas.cod_carta

				left join ".$schema.".cad_ctrreceitas on
						cad_cartas.cod_ctrreceita=cad_ctrreceitas.cod_ctrreceita

				left join (select cod_pessoa, nome_razao_social as contribuinte from ".$schema.".cad_pessoas) as contribuinte on
						contribuinte.cod_pessoa=cad_cartas.cod_contribuinte

				left join (select cod_colaborador, nome_razao_social as colaborador from ".$schema.".cad_pessoas,".$schema.".cad_colaboradores where cad_pessoas.cod_pessoa=cad_colaboradores.cod_pessoa) as colaborador on
						colaborador.cod_colaborador=cad_cartas.cod_colaborador

				where
					cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
						(
							captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
							(captacao_cartas_baixas.data_baixa between '".data($data_inicio_de)."' and '".data($data_inicio_ate)."') ";
								
							if ($valor_moeda_de!="0.00" or $valor_moeda_ate!="999999999.99"){ $select=$select. "and (captacao_cartas_baixas.valor_baixa between ".$valor_moeda_de." and ".$valor_moeda_ate." )";}
							if ($cod_pessoa!=""){ $select=$select. "and cod_contribuinte='".$cod_pessoa."'";}
							if ($lote_envio!=""){ $select=$select. "and captacao_cartas.numero_lote='".$lote_envio."'";}
							if ($lote_retorno!=""){ $select=$select. "and captacao_cartas_baixas.lote='".$lote_retorno."'";}
							if ($cod_carta!=""){ $select=$select. "and captacao_cartas.cod_carta='".$cod_carta."'";}
							if ($cod_captacao!=""){ $select=$select.  "and captacao_cartas.cod_captacao_cartas='".$cod_captacao."'";}
							if ($cod_carteira!=""){ $select=$select.  "and captacao_cartas_baixas.cod_carteira='".$cod_carteira."'";}					
							$select=$select." 
						)
					order by data_baixa limit 0,9999999999";

			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			$json="";

			while($row = mysql_fetch_array($resultado))
			{
				$json.="{";
				$keys=array_keys($row);
				for($c=0;$c<count($keys);$c++){
					if(is_numeric($keys[$c])){}else{
						if($row[$keys[$c]]==null){$valor='-';}else{$valor=$row[$keys[$c]];}
						$json.='"'.$keys[$c].'":"'.$valor.'",';									
					}
				}
				$json.="}";					
			}
			
			echo "<div id='grid'></div>";
			$column= "";
			if(isset($keys) and count($keys)>0){
				for($c=0;$c<count($keys);$c++){
					if(is_numeric($keys[$c])){}else{
						$column.= "{headerText: '".$keys[$c]."', key: '".$keys[$c]."',dataType: 'string'},";
					}
				}
				$column=str_replace("}{","},{",$column);
				
				$json=str_replace("}{","},{",$json);	
				$json="[".$json."]";				
				
				$tabela="";
				
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
				
			}

					
	}
	function listar_conciliacao($data_inicio_de,$data_inicio_ate,$valor_moeda_de,$valor_moeda_ate,$cod_carteira,$cod_conciliacao,$conciliado){
	include "config.php";
	$data_inicio=data($data_inicio_de);
	$data_fim=data($data_inicio_ate);
	$n=1;
	$carteira="NDA";

	
	$tb_arquivo= "
				<table id='tb_arquivo' class='uk-table uk-table-hover uk-table-condensed uk-text-nowrap uk-panel-box' style='font-size: 11px;min-width: 300px;margin-top: 0px;'>
					<tr style='height: 40px;'>
						<th class='' style=''></th>
						<th class='' style='min-width: 50px;'>Data</th>
						<th class='' style='min-width: 50px;'>Número</th>
						<th class='' style='min-width: 150px;'>Histórico</th>
						<th class='' style='min-width: 30px;'>Valor</th>
						<th class='' style='min-width: 30px;'>Concliado</th>
					</tr>";
		$select= "
				select 
					cod_arquivo_ofx_lancamentos,
					DATE_FORMAT(DTPOSTED,'%d/%m/%Y') as data_baixa,
					TRNAMT as valor_baixa,
					MEMO as historico,
					arquivo_ofx_lancamentos.cod_carteira,
					cad_carteiras.nome_carteira,
					arquivo_ofx_lancamentos.cod_conciliacao
					
					
				from 
					".$schema.".arquivo_ofx_lancamentos,
					".$schema.".cad_carteiras
				
				where 

						arquivo_ofx_lancamentos.cod_carteira=cad_carteiras.cod_carteira
						and (DTPOSTED between '".$data_inicio."' and '".$data_fim."' )
						and (TRNAMT between '".$valor_moeda_de."' and '".$valor_moeda_ate."' )
						and arquivo_ofx_lancamentos.cod_carteira= '".$cod_carteira."' ";
						if($cod_conciliacao!='' || $cod_conciliacao!=""){$select.=" and arquivo_ofx_lancamentos.cod_conciliacao='".$cod_conciliacao."'";}
						if($conciliado=='N'){$select.=" and (arquivo_ofx_lancamentos.cod_conciliacao=0)";}
						if($conciliado=='S'){$select.=" and (arquivo_ofx_lancamentos.cod_conciliacao>0)";}
						$select=$select." 
					
				order by 
					DTPOSTED";
		$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br>".$select);
		while($row = mysql_fetch_array($resultado))
		{
			$carteira=$row['nome_carteira'];
			if($row['cod_conciliacao']==0){$icone="<a href='#' data-uk-tooltip title='não conciliado'><i class='uk-icon-circle-o'></i></a>";}else{$icone="<a href='#' data-uk-tooltip title='conciliado'><i class='uk-icon-check-circle-o'></i></a>";}
			
			$tb_arquivo.= 
				"<tr style='height: 40px;' id='arquivo_".$n."'>
					<td style='text-align: center;min-width: 20px;padding: 3px 10px;vertical-align: middle;'>
						<input type='checkbox' class='checkbox_selecionar' id='tr_arquivo_".$row['cod_arquivo_ofx_lancamentos']."' onclick='calcular_conciliacao();' valor_baixa='".$row['valor_baixa']."'>
					</td>
					<td style='text-align: center;min-width: 50px;padding: 3px 10px;'>".$row['data_baixa']."</td>
					<td style='text-align: center;min-width: 50px;padding: 3px 10px;'>".$row['cod_arquivo_ofx_lancamentos']."</td>
					<td style='min-width: 120px;padding: 3px 10px;'><div style='width: 100% !important;' class='uk-text-truncate'>".$row['historico']."</div></td>
					<td style='text-align:right;min-width: 50px;padding: 3px 10px;'>".$row['valor_baixa']."</td>
					<td style='font-size: 15px;vertical-align: middle;text-align:right;min-width: 20px;padding: 3px 10px;'>".$icone."</td>
				</tr>";
			$n++;
		}

	$tb_arquivo.= "</table></div></div>";

	$tb_sistema= "
				<table id='tb_sistema' class='uk-table uk-table-hover uk-table-condensed uk-text-nowrap uk-panel-box' style='font-size: 11px;min-width: 300px;margin-top: 0px;'>
					<tr style='height: 40px;'>
						<th class='' style=''></th>
						<th class='' style='min-width: 50px;'>Data</th>
						<th class='' style='min-width: 50px;'>Número</th>
						<th class='' style='min-width: 150px;'>Histórico</th>
						<th class='' style='min-width: 30px;'>Valor</th>
						<th class='' style='min-width: 30px;'>Concliado</th>
					</tr>";
		$select= "
				select 
					captacao_cartas_baixas.cod_captacao_cartas_baixas,
					DATE_FORMAT(captacao_cartas_baixas.data_baixa,'%d/%m/%Y') as data_baixa,
					captacao_cartas_baixas.valor_baixa,
					captacao_cartas_baixas.historico,
					captacao_cartas_baixas.cod_carteira,
					cad_carteiras.nome_carteira,
					cad_cartas.carta_forma_pagamento,
					cad_cartas.cod_carta,
					captacao_cartas.cod_captacao_cartas,
					LEFT(cad_pessoas.nome_razao_social,35) as nome_razao_social,
					captacao_cartas_baixas.cod_conciliacao					
					
				from 
					".$schema.".captacao_cartas_baixas,
					".$schema.".cad_carteiras,
					".$schema.".captacao_cartas,
					".$schema.".cad_cartas,
					".$schema.".cad_pessoas
		
				where 

						
							captacao_cartas_baixas.cod_carteira=cad_carteiras.cod_carteira and
							captacao_cartas.cod_carta=cad_cartas.cod_carta and
							cad_cartas.cod_contribuinte=cad_pessoas.cod_pessoa and
							captacao_cartas.cod_captacao_cartas=captacao_cartas_baixas.cod_captacao_cartas 
							
							and (data_baixa between '".$data_inicio."' and '".$data_fim."' )
							and (valor_baixa between '".$valor_moeda_de."' and '".$valor_moeda_ate."' )
							and captacao_cartas_baixas.cod_carteira= '".$cod_carteira."' ";
							if($cod_conciliacao!=null || $cod_conciliacao!=""){$select.=" and captacao_cartas_baixas.cod_conciliacao='".$cod_conciliacao."'";}
							if($conciliado=='N'){$select.=" and (captacao_cartas_baixas.cod_conciliacao=0)";}
							if($conciliado=='S'){$select.=" and (captacao_cartas_baixas.cod_conciliacao>0)";}
							
							$select=$select."
						
				order by 
					captacao_cartas_baixas.data_baixa";

		$n=1;
		$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br>".$select);
		while($row = mysql_fetch_array($resultado))
		{
			$carteira=$row['nome_carteira'];
			if($row['cod_conciliacao']==0){$icone="<a href='#' data-uk-tooltip title='não conciliado'><i class='uk-icon-circle-o'></i></a>";}else{$icone="<a href='#' data-uk-tooltip title='conciliado'><i class='uk-icon-check-circle-o'></i></a>";}
			
			$tb_sistema.= 
				"<tr style='height: 40px;' id='sistema_".$n."'>
					<td style='text-align: center;padding: 3px 10px;vertical-align: middle;'>
						<input type='checkbox' class='checkbox_selecionar' id='tr_sitema_".$row['cod_captacao_cartas_baixas']."' onclick='calcular_conciliacao();' valor_baixa='".$row['valor_baixa']."'>
					</td>
					<td style='text-align: center;padding: 3px 10px;'>".$row['data_baixa']."</td>
					<td style='text-align: center;padding: 3px 10px;'>".$row['cod_captacao_cartas_baixas']."</td>
					<td style='min-width: 150px;padding: 3px 10px;'><div style='width: 130px !important;' class='uk-text-truncate'>".$row['carta_forma_pagamento']." - carta:".$row['cod_carta']." - captação:".$row['cod_captacao_cartas']."<br/>".$row['nome_razao_social']."</div></td>
					<td style='text-align:right;min-width: 30px;padding: 3px 10px;'>".$row['valor_baixa']."</td>
					<td style='font-size: 15px;vertical-align: middle;text-align:right;min-width: 20px;padding: 3px 10px;'>".$icone."</td>
				</tr>";
			$n++;
		}
		
	$tb_sistema.=  "</table>";

///
//	if(isset($carteira)){echo "<h3>".$carteira."</h3>";}
	echo "

		<div class='uk-grid' style='margin-right: -10px; bottom: 0px; top: 135px; position: absolute; left: 20px; right: 20px; margin-top: 20px;'>
			<div class='uk-width-1-1'>
				<h3>".$carteira."</h3>
			</div>
			
			<div class='uk-width-1-1'>
				<div class='uk-grid'>
					<div class='uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2'>
						<div class='uk-form-row'>
							<label class='uk-form-label'>Históricos do Sistema: </label>
							<input class='uk-form-small' id='historico_sistema' type='text'style='width: 100%;' onchange=marcar_conciliar_historico();>
						</div>
						<div class='uk-form-row' style='text-align: right;'>
							<label class='uk-form-label'>Total Sistema:</label>
							<input class='uk-form-small' id='total_sistema' type='text'  style='width: 100px;text-align: right;' disabled>
						</div>

					</div>
					<div class='uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2'>
						<div class='uk-form-row'>
							<label class='uk-form-label'>Históricos do Arquivo: </label>
							<input class='uk-form-small' id='historico_arquivo' type='text' style='width: 100%;' onchange=marcar_conciliar_historico();>
						</div>
						<div class='uk-form-row' style='text-align: right;'>
							<label class='uk-form-label'>Total Arquivo:</label>
							<input class='uk-form-small' id='total_arquivo' type='text'  style='width: 100px;text-align: right;' disabled>
						</div>
					</div>
				</div>
			</div>
			<div class='uk-width-1-1' style='text-align: right; padding: 5px 5px 5px 0px; border-bottom: 1px solid rgb(204, 204, 204); margin-left: 5px;'>	
					<label class='uk-form-label'>Total Diferença:</label>
					<input class='uk-form-small' id='diferenca' type='text' onkeyup='' style='width: 100px;text-align: right;' disabled>
			</div>
			<div class='uk-width-1-1' style='bottom: 10px !important; height: 300px;padding: 15px 0px;resize: vertical;overflow: auto;'>	
				<div class='uk-grid' style='margin-left: 5px;'>
					<div class='uk-width-medium-1-2' style='border: 1px solid #ccc;padding-left: 0px;'>
					".$tb_sistema."
					</div>
					<div class='uk-width-medium-1-2' style='border: 1px solid #ccc;padding-left: 0px;padding-top: 0px;'>
					".$tb_arquivo."			
					</div>
				</div>
			</div>

		

		</div>



	
	
	
	";
	
	
	
	
	
	
	}
	function listar_arquivos_retorno($data_inicio_de,$data_inicio_ate,$cod_banco,$cod_convenio,$cod_status,$lote){
	include "config.php";
	$conexao=mysql_connect($servidor,$usuario,$senha) or die(mysql_error());
	$select= "
			SELECT 
				`cad_arquivos_bancarios`.* ,
				DATE_FORMAT(`cad_arquivos_bancarios`.data_geracao,'%d/%m/%Y') as data_geracao,
				`cad_convenios`.*,
				`cad_status`.*,
				cad_bancos.nome_banco
			FROM 
				`".$schema."`.`cad_arquivos_bancarios`,
				`".$schema."`.`cad_convenios`,
				`".$schema."`.`cad_bancos`,
				`".$schema."`.`cad_status`
			WHERE 
				cad_arquivos_bancarios.cod_empresa=".$_SESSION['cod_empresa']." and	
					(
						`cad_convenios`.`cod_do_banco`=`cad_bancos`.`cod_banco` and 
						`cad_arquivos_bancarios`.`cod_convenio`=`cad_convenios`.`codigo_convenio` and 
						`cad_arquivos_bancarios`.`status_arquivo`=`cad_status`.`cod_status` and 
						(`cad_arquivos_bancarios`.`data_geracao` between '".data($data_inicio_de)."' and '".data($data_inicio_ate)."' ) and
						`cad_arquivos_bancarios`.`tipo_arquivo` != 'envio' ";
						if ($cod_status!=""){$select=$select." and `cad_arquivos_bancarios`.`status_arquivo` = '".$cod_status."'";}
						if ($cod_banco!=""){$select=$select." and `cad_arquivos_bancarios`.`cod_banco` = '".$cod_banco."'";}
						if ($cod_convenio!=""){$select=$select." and `cad_convenios`.`codigo_convenio` = '".$cod_convenio."'";}
						if ($lote!=""){$select=$select." and `cad_arquivos_bancarios`.`lote` = '".$lote."'";}
						$select=$select."
					)	
				ORDER BY cad_arquivos_bancarios.lote";
	$resultado=mysql_query($select,$conexao) or die ($select);
		echo "<h3>Arquivos de retorno</h3>";
		echo "<table class='uk-table uk-table-hover uk-table-condensed uk-text-nowrap uk-panel-box' style='font-size: 11px;'>";
		echo "
		<tr>
			<th>Status</th>
			<th>Data Geração</th>
			<th>Descrição</th>
			<th>Tipo Arquivo</th>
			<th>Status</th>
			<th>Banco</th>
			<th>Convênio</th>
			<th>Lote</th>
			<th>Registros</th>
			<th>Downloads</th>
			<th>Valor R$</th>
			<th></th>
			<th></th>
			<th></th>			
		</tr>
		";

		while($row = mysql_fetch_array($resultado))
		{
		
		echo "
		<tr>
			<td style='width: 50px; text-align: center;vertical-align: middle;'>
				<a href='#'  class='uk-button uk-button-mini uk-button-primary' data-uk-tooltip={pos:'right'} title='".$row['status_resumido']."'   style=''>
					".$row['status_arquivo']."	
				</a>
			</td>
			<td style='width: 50px; text-align: center;'>".$row['data_geracao']."</td>
			<td>".$row['tipo_convenio']."<br>
				".$row['nome_arquivo']."
			</td>
			<td>".$row['tipo_arquivo']."</td>
			<td>".$row['status_resumido']."</td>
			<td>".$row['nome_banco']."</td>
			<td style='width: 50px; text-align: center;'>".$row['codigo_convenio']."</td>
			<td style='width: 50px; text-align: center;'>".$row['lote']."</td>
			<td style='width: 50px; text-align: center;'>".$row['quantidade_registros']."</td>
			<td style='width: 50px; text-align: center;'>".$row['numero_downloads']."</td>
			<td style='width: 50px; text-align: right;'>".number_format($row['total_lote'], 2, ',', '.')."</td>
			<td style='width: 50px; text-align: center;vertical-align: middle;'>
				<a class='uk-button uk-button-mini uk-button-primary' target='_blank' style=' ' href='?id_arquivo=".$row['id_arquivo']."&status_arquivo=".$row['status_arquivo']."' onclick=processar_arquivo_retorno('".$row['id_arquivo']."','".$row['cod_arquivo_bancario']."','".$row['status_arquivo']."');>
					<i class='uk-icon-folder-open-o'></i> Abrir
				</a>
			</td>
			<td style='width: 50px; text-align: center;vertical-align: middle;'>
				<a class='uk-button uk-button-mini uk-button-primary' target='_blank' style=' '  href='arquivos_bancarios/".str_replace("_boleto","",$row['tipo_arquivo'])."/".$row['id_arquivo']."' download='".$row['nome_arquivo']."' onclick=contar_download('".$row['cod_arquivo_bancario']."');>
					<i class='uk-icon-cloud-download'></i> Download
				</a>
			</td>
			<td style='width: 50px; text-align: center;vertical-align: middle;'>
			";
		

			  
		if ($row['status_arquivo']!='AP' and $row['tipo_arquivo']=='retorno'){
			echo "<a class='uk-button uk-button-mini uk-button-danger' target='_blank' style='' href='#' onclick=excluir_arquivo_retorno('".$row['cod_arquivo_bancario']."');>
					<i class='uk-icon-trash-o'></i> Excluir
				</a>";	
				}
				
				
		echo "
			</td>			
		</tr>
		";
		}
		echo "</table>";
		
}	
	function listar_arquivos_envio($data_inicio_de,$data_inicio_ate,$cod_banco,$cod_convenio,$cod_status,$lote){
	include "config.php";
	$conexao=mysql_connect($servidor,$usuario,$senha) or die(mysql_error());
	$select= "
			SELECT 
				`cad_arquivos_bancarios`.* ,
				DATE_FORMAT(`cad_arquivos_bancarios`.data_geracao,'%d/%m/%Y') as data_geracao,
				`cad_convenios`.*,
				`cod_bancos`.nome_banco,
				`cad_status`.*
			FROM 
				`".$schema."`.`cad_arquivos_bancarios`,
				`".$schema."`.`cad_convenios`,
				`".$schema."`.`cad_status`
			WHERE 
				cad_arquivos_bancarios.cod_empresa=".$_SESSION['cod_empresa']." and
					(
						`cad_bancos`.`cod_banco`=`cad_convenios`.`cod_do_banco` and 
						`cad_arquivos_bancarios`.`cod_convenio`=`cad_convenios`.`codigo_convenio` and 
						`cad_arquivos_bancarios`.`status_arquivo`=`cad_status`.`cod_status` and 
						(`cad_arquivos_bancarios`.`data_geracao` between '".data($data_inicio_de)."' and '".data($data_inicio_ate)."' ) and
						`cad_arquivos_bancarios`.`tipo_arquivo` = 'envio' ";
						if ($cod_status!=""){$select=$select." and `cad_arquivos_bancarios`.`status_arquivo` = '".$cod_status."'";}
						if ($cod_banco!=""){$select=$select." and `cad_arquivos_bancarios`.`cod_banco` = '".$cod_banco."'";}
						if ($cod_convenio!=""){$select=$select." and `cad_convenios`.`codigo_convenio` = '".$cod_convenio."'";}
						if ($lote!=""){$select=$select." and `cad_arquivos_bancarios`.`lote` = '".$lote."'";}
						$select=$select."
					) 
			ORDER BY 
				cad_arquivos_bancarios.lote";
	$resultado=mysql_query($select,$conexao) or die ($select);
		echo "<h3>Arquivos de envio</h3>";
		echo "<table class='uk-table uk-table-hover uk-table-condensed uk-text-nowrap uk-panel-box' style='font-size: 11px;'>";
		echo "
		<tr>
			<th>Status</th>		
			<th>Data Geração</th>
			<th>Descrição</th>
			<th>Tipo Arquivo</th>
			<th>Status</th>
			<th>Banco</th>
			<th>Convênio</th>
			<th>Lote</th>
			<th>Registros</th>
			<th>Downloads</th>
			<th>Valor R$</th>
			<th></th>
			<th></th>			
		</tr>
		";

		while($row = mysql_fetch_array($resultado))
		{
		
		echo "
		<tr>
			<td style='width: 50px; text-align: center;vertical-align: middle;'>
				<a href='#' class='uk-button uk-button-mini uk-button-primary' data-uk-tooltip={pos:'left'} title='".$row['status_resumido']."' style='height: 100%; padding-top: 2px; padding-bottom: 2px;'>
				".$row['status_arquivo']."
				</a>
			</td>		
			<td style='width: 50px; text-align: center;'>".$row['data_geracao']."</td>
			<td>".$row['tipo_convenio']."<br>
				".$row['nome_arquivo']."
			</td>
			<td style='width: 50px; text-align: center;'>".$row['tipo_arquivo']."</td>
			<td>".$row['status_resumido']."</td>
			<td>".$row['nome_banco']."</td>
			<td style='width: 50px; text-align: center;'>".$row['codigo_convenio']."</td>
			<td style='width: 50px; text-align: center;'>".$row['lote']."</td>
			<td style='width: 50px; text-align: center;'>".$row['quantidade_registros']."</td>
			<td style='width: 50px; text-align: center;'>".$row['numero_downloads']."</td>
			<td style='width: 50px; text-align: right;'>".number_format($row['total_lote'], 2, ',', '.')."</td>
			<td style='width: 50px; text-align: center;vertical-align: middle;'>
				<a href='arquivos_bancarios/".str_replace("_boleto","",$row['tipo_arquivo'])."/".$row['id_arquivo']."' download='".$row['nome_arquivo']."' onclick=contar_download('".$row['cod_arquivo_bancario']."');     class='uk-button uk-button-mini uk-button-primary'  style=''>
					<i class='uk-icon-cloud-download'></i> Download
				</a>
			</td>
			<td style='width: 50px; text-align: center;vertical-align: middle;'>
				<a href='?lote=".$row['lote']."&banco=".$row['cod_banco']."'  class='uk-button uk-button-mini uk-button-danger'   style=' '>
					<i class='uk-icon-trash-o'></i> Excluir
				</a>
			</td>			
		</tr>
		";
		}
		echo "</table>";
		
}	
	function listar_usuarios($pesquisa){
	include "config.php";
		
	$select= "
					select 
						*
						
					from 
						".$schema.".cad_usuarios 
						
					where 
						cod_usuario like '%".$pesquisa."%' or
						nome like '%".$pesquisa."%';
						;";

		$resultado=mysql_query($select,$conexao) or die ($select);
		
			$tabela= "
				<table class='uk-table uk-table-hover uk-table-condensed uk-table-striped uk-text-nowrap uk-panel-box' style='font-size: 11px;'>
					<tr>
						<th></th>
						<th>Código</th>
						<th>Nome</th>
					</tr>";						
			$n=1;
			
			while($row = mysql_fetch_array($resultado))
			{
			$tabela.=
				"<tr>
					<td><a href='?id=".$row['cod_usuario']."' class='uk-button uk-button-mini uk-button-primary'>Editar</a></td>
					<td>".$row['cod_usuario']."</td>
					<td>".$row['nome']."</td>
				</tr>";
				$n=$n+1;
			}	
			$tabela.= "</table>";
			echo $tabela;
	
	}
	function historico_carta($cod_carta){
		include "config.php";
			date_default_timezone_set('America/Sao_Paulo');
			setlocale(LC_ALL, 'pt_BR');
			$select= "
					SELECT 
						cad_historico_carta.*
					FROM 
						".$schema.".cad_historico_carta 
					where 
						cod_carta='".$cod_carta."';";

			$resultado=mysql_query($select,$conexao) or die ($select);
				while($row = mysql_fetch_array($resultado))
				{
					echo "
						<div >
							<p class='uk-article-meta'>".strftime("%e de %B de %Y",strtotime($row['data_inclusao']))."</p>
							<p>".$row['nota']."</p>
							<hr class='uk-article-divider'>
						</div>				
					";
				}	
	}
	function listar_itens_baixa_em_lote($cod_captacao_cartas){
		include "config.php";
		$select= "SELECT
		
					cad_pessoas.nome_razao_social as nomecontribuinte,
					captacao_cartas.cod_captacao_cartas,
					captacao_cartas.cod_carta ,
					captacao_cartas.data_vencimento,
					captacao_cartas.valor as valor

					
				FROM 
					".$schema.".captacao_cartas,
					".$schema.".cad_cartas
					
				LEFT JOIN ".$schema.".cad_pessoas ON
					".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_cartas.cod_contribuinte

				
				WHERE 
					captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
					cad_cartas.cod_carta=".$schema.".captacao_cartas.cod_carta and
					captacao_cartas.cod_captacao_cartas='".$cod_captacao_cartas."' 

					
					;";	
		$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);
			while($row = mysql_fetch_array($resultado))
			{
			echo  
				"
				<div class='uk-grid uk-width-1-1 ' style='margin-top: -15px; margin-left: 0px; margin-right: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px;'>
					<div class='uk-width-1-5'>".$row['cod_captacao_cartas']."</div>
					<div class='uk-width-3-5'>".$row['nomecontribuinte']."</div>
					<div class='uk-width-1-5' style='text-align: right; padding-right: 15px;'>".$row['valor']."</div>
				</div>
				";
			}	
	}

}
class igniteui{
	function igrid($base,$column,$tabela){
	echo 
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
" 
<script>
            $( '#grid' ).igGrid( {
                autoGenerateColumns: false,
                dataSource: ".$base.",
                dataSourceType: 'json',
				columns:[".$column."],
                width: '100%',
                height: '100%',
                virtualizationMode: 'fixed',
                avgRowHeight: '30px',
                tabIndex: 1,
                features: [
                    {
                        name: 'Selection',
                        mode: 'row'
                    },
					{
						name: 'Hiding'
					},
                    {
                        name: 'Paging',
                        type: 'local',
                        pageSize: 15
                    },					
                    {
                        name: 'Filtering',
                        type: 'local'

                    },	
					{
						name: 'Resizing'
					},						
                   

                ]
            } );
	//Initialize
	$('#grid').igGrid({
		cellClick: function(evt, ui) { window.location.assign('?act=cadastros&mod=".$tabela."&id='+$('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));}
	});			
</script>
";
	///alert($('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	function igrid_movimento($base,$column,$tabela){
	echo 
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
" 
<script>
            $( '#grid_movimento' ).igGrid( {
                autoGenerateColumns: false,
                dataSource: ".$base.",
                dataSourceType: 'json',
				columns:[".$column."],
                width: '100%',
                height: '100%',
                virtualizationMode: 'fixed',
                avgRowHeight: '30px',
                tabIndex: 1,
                features: [
                    {
                        name: 'Selection',
                        mode: 'row'
                    },
                    {
                        name: 'Paging',
                        type: 'local',
                        pageSize: 15
                    },					
                   {
                        name: 'Filtering',
                        type: 'local'
                    },	
					{
						name: 'Resizing'
					}					
                   

                ]
            } );
		
</script>
";
	///alert($('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	function igrid_relatorios($base,$column,$groupby){
	echo 
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
" 
<script>
            $( '#grid_relatorio' ).igGrid( {
                autoGenerateColumns: false,
                dataSource: ".$base.",
                dataSourceType: 'json',
				columns:[".$column."],
                width: '100%',
                height: '100%',
                virtualizationMode: 'fixed',
                tabIndex: 1,
                features: [
                    {
                        name: 'Selection',
                        mode: 'row'
                    },
                    {
                        name: 'Paging',
                        type: 'local',
                        pageSize: 15
                    },						
                   {
                        name: 'Filtering',
                        type: 'local'
                    },	
					{
						name: 'Resizing'
					},						
                    {
                        name: 'MultiColumnHeaders'
                    },					
                    {
                        name: 'GroupBy',
                        columnSettings: [
						".$groupby."
                        ]
                    }
				]
  
            } );
		
</script>
";
	///alert($('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	function igrid_editavel($base,$column,$column_editavel){
	

	echo 

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
" 
<script>

            $( '#grid_relatorio' ).igGrid( {
                autoGenerateColumns: false,
                dataSource: ".$base.",
                dataSourceType: 'json',
				columns:[".$column."],
                width: '100%',
                height: '80%',
                primaryKey: 'id',				
                virtualizationMode: 'fixed',
                tabIndex: 1,
                features: [
                    {
                        name: 'Selection',
                        mode: 'row'
                    },
                    {
                        name: 'MultiColumnHeaders'
                    },
					{
						name: 'Hiding'
					},
                    {
                        name: 'Paging',
                        type: 'local',
                        pageSize: 15
                    },					
                    {
                        name: 'Filtering',
                        type: 'local'

                    },						
                    {
                        name: 'Updating',
                        enableAddRow: false,
                        editMode: 'row',
                        enableDeleteRow: false,
                        rowEditDialogContainment: 'owner',
                        showReadonlyEditors: false,
                        enableDataDirtyException: false,
                        columnSettings: [".$column_editavel."]
                    }
				]
  
            } );
		
</script>
";
	}

}

class JSON{
	function pessoas(){
		session_start();
		include "config.php";
			$select= "
				select 
					cod_pessoa,
					nome_razao_social
				from 
					".$schema.".cad_pessoas
				where
					cad_pessoas.cod_empresa=".$_SESSION['cod_empresa']."
					
					;";

			$resultado=mysql_query($select,$conexao) or die ($select);
			$json='';
			while($row = mysql_fetch_array($resultado))
			{
				$json.="{value:'".$row['nome_razao_social']."',id:'".$row['cod_pessoa']."',}";			
			}	
			$json= "var filtro_pessoas=[".str_replace("}{","},{",$json)."]";
			echo $json;

	

	
	}
	function colaboradores(){
		session_start();
		include "config.php";
			$select= "
							select 
								cad_colaboradores.cod_colaborador,
								cad_pessoas.nome_razao_social as colaborador
								
							from 
								".$schema.".cad_colaboradores,
								".$schema.".cad_pessoas
								
							where 
								cad_pessoas.cod_empresa=".$_SESSION['cod_empresa']." and								
								cad_pessoas.cod_pessoa=".$schema.".cad_colaboradores.cod_pessoa and							
								cad_pessoas.status=1 and
								cad_colaboradores.status=1
								
							order by 
								`colaborador`;";

			$resultado=mysql_query($select,$conexao) or die ($select);
			$json='';
			while($row = mysql_fetch_array($resultado))
			{
				$json.="{value:'".$row['colaborador']."',id:'".$row['cod_colaborador']."',}";			
			}	
			$json= "var filtro_colaboradores=[".str_replace("}{","},{",$json)."]";
			echo $json;

	

	
	}
	function ctrreceitas(){
		session_start();
		include "config.php";
			$select= "
							select 
								* 
								
							from 
								".$schema.".cad_ctrreceitas
								
							where
								cad_ctrreceitas.cod_empresa=".$_SESSION['cod_empresa']." and 
								analitico_sintetico='analitico' and 
								status=1 
								
							order by 
								`nome`;";

			$resultado=mysql_query($select,$conexao) or die ($select);
			$json='';
			while($row = mysql_fetch_array($resultado))
			{
				$json.="{value:'".$row['nome']."',id:'".$row['cod_ctrreceita']."',}";			
			}	
			$json= "var filtro_ctrreceita=[".str_replace("}{","},{",$json)."]";
			echo $json;

	

	
	}

	
}
class sql{
	public function update($table,$campos,$where){
		include "config.php";
	//	var_dump($_SESSION);
		if(isset($_SESSION['cod_usuario']['cod_usuario'])){$uid=$_SESSION['cod_usuario']['cod_usuario'];$username=$_SESSION['user'];}else{$uid=0;$username='';}
		$consulta="UPDATE `".$schema."`.`".$table."` SET ".$campos.", cod_empresa='".$_SESSION['cod_empresa']."', data_ultima_alteracao=Now(),usuario_ultima_alteracao=".$_SESSION['cod_usuario']['cod_usuario']." WHERE ".$where.";";
		$update=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
				echo "
		
			<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert=''>
				<a href='' class='uk-alert-close uk-close'></a>
				<p>O registro foi salvo com sucesso!</p>
			</div>

			
		";//echo $consulta;
	}
	public function insert($table,$campos,$values){
		//session_start();
		include "config.php";
		if(isset($_SESSION['cod_usuario']['cod_usuario'])){$uid=$_SESSION['cod_usuario']['cod_usuario'];$username=$_SESSION['user'];}else{$uid=0;$username='';}
		$consulta="INSERT INTO `".$schema."`.".$table." (".$campos.",`cod_empresa`,`usuario_inclusao`)  VALUES (".$values.",'".$_SESSION['cod_empresa']."','".$_SESSION['cod_usuario']['cod_usuario']."');"; 
		$insert=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	

				echo "
		
			<div class='uk-alert uk-alert-success tm-main  uk-container-center' data-uk-alert=''>
				<a href='' class='uk-alert-close uk-close'></a>
				<p>O registro foi salvo com sucesso!</p>
			</div>

			
		";
	}
	public function delete($table,$where){
		//session_start();
		include "config.php";
		$consulta="DELETE FROM `".$schema."`.".$table." WHERE ".$where.";";
		$delete=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	
				echo "
			<div class='uk-alert uk-alert-success tm-main uk-container-center' data-uk-alert=''>
				<a href='' class='uk-alert-close uk-close'></a>
				<p>O registro foi salvo com sucesso!</p>
			</div>
		";

	}
	public function baixar_captacao($cod_retorno,$data_recebimento,$valor_recebido,$cod_captacao,$convenio,$nome_arquivo,$lote,$tipo_baixa){
			include "config.php";
			
			
			if($cod_retorno=="00" and $cod_captacao!="" and $data_recebimento!="" and $valor_recebido!=""){
				$table='captacao_cartas_baixas';
				
				$campos='cod_captacao_cartas,';
				$campos.='data_baixa,';
				$campos.='valor_baixa,';
				$campos.='cod_carteira,';
				$campos.='lote,';
				$campos.='historico';
				
				$values="'".$cod_captacao."', ";
				$values.="'".data($data_recebimento)."',";
				$values.="'".$valor_recebido."',";
				$values.="'".$convenio."',";
				$values.="'".$lote."', ";
				$values.="'".$tipo_baixa."'";
			$sql=new sql;
			$sql->insert($table,$campos,$values);

			
			}
			//BAIXA AUTOMATICA
		//	$select= "UPDATE `".$schema."`.`captacao_cartas` SET `status` = '".$cod_retorno."' WHERE `captacao_cartas`.`cod_captacao_cartas` ='".$cod_captacao."';";
		//	$resultado=mysql_query($select,$conexao) or die (mysql_error());
	}
	
	
}
class conciliacao{
	function upload(){

		include "config.php";

		$data = file_get_contents($_FILES['my_uploaded_file']['tmp_name']); //read the file
		$matriz = explode("\n", $data);
		$tabela= "
		<div class='box_arquivo_conciliacao'>
				<table id='tb_sistema' class='uk-table uk-table-hover uk-table-condensed uk-table-striped uk-text-nowrap uk-panel-box' style='font-size: 11px;max-width: 100%;'>
				<th>TRNTYPE</th>
				<th>DTPOSTED</th>
				<th>TRNAMT</th>
				<th>FITID</th>
				<th>CHECKNUM</th>
				<th class='uk-text-truncate'>MEMO</th>
			
				";
		
		for ($i=1;$i<count($matriz)-2;$i++)  
		{
						$valor=$matriz[$i];
						$valor=substr($valor,strpos($valor,'<'),strlen($valor)-strpos($valor,'<'));
						
						if(strpos($valor,'BANKID') ==1){$BANKID =str_replace(" ","",str_replace("<BANKID>","<td>",$valor));}
						if(strpos($valor,'ACCTID') ==1){$ACCTID =str_replace(" ","",str_replace("<ACCTID>","<td>",$valor));}
						
						if(strpos($valor,'TRNTYPE') ==1){$tabela.= str_replace(" ","",str_replace("<TRNTYPE>","<td>",$valor))."</td>";}
						if(strpos($valor,'DTPOSTED') ==1){$tabela.= str_replace(" ","",SubStr(str_replace("<DTPOSTED>","<td>",$valor),0,12))."</td>";}
						if(strpos($valor,'TRNAMT') ==1){$tabela.= "<td>".str_replace(" ","",str_replace(',','.',str_replace("<TRNAMT>","",$valor)))."</td>";}
						if(strpos($valor,'FITID') ==1){$tabela.= "<td>".str_replace(" ","",str_replace("<FITID>","",$valor))."</td>";}
						if(strpos($valor,'CHECKNUM') ==1){$tabela.= "<td>".str_replace(" ","",str_replace("<CHECKNUM>","",$valor))."</td>";}
						if(strpos($valor,'MEMO') ==1){$tabela.= "<td>".str_replace("<MEMO>","",$valor)."</td>";}
						if(strpos($valor,'STMTTRN') ==1){$tabela.= "<tr>";}
						if(strpos($valor,'/STMTTRN') ==1){$tabela.= "</tr>";}
		}
		$tabela.= "</table></div>";

		
		echo "<h3>Conta: ".$BANKID." - ".$ACCTID."</h3>" ;
		
		echo $tabela;
		
		$selects=new selects;
		$selects->select_carteiras2('carteira');
		
		echo "<div class='uk-form-row'><button onclick='gravar_arquivo_conciliacao();' class='uk-button uk-button-small'><i class='uk-icon-save'></i> Gravar</button></div>";		
	
	
	}
	function inserir_arquivo_ofx_lancamentos($tb,$data_inicio,$data_fim,$carteira){
		include "config.php";
		
		$sql=new sql;
		
		$table="arquivo_ofx_lancamentos";
		$where="cod_carteira='".$carteira."' and (DTPOSTED between '".$data_inicio."' and '".$data_fim."')";
		$sql->delete($table,$where);
		
		$table="captacao_cartas_baixas";
		$campos="cod_conciliacao=0";
		$where="cod_carteira='".$carteira."' and (data_baixa between '".$data_inicio."' and '".$data_fim."')";
		$sql->update($table,$campos,$where);
		
		$table="arquivo_ofx_lancamentos";
		$campos="`cod_carteira`,`TRNTYPE`,`DTPOSTED`,`TRNAMT`,`FITID`,`CHECKNUM`,`MEMO`";
		$values=$tb;
		$sql->insert($table,$campos,$values);
		
	}
	function conciliar($arquivo,$sistema){
		include "config.php";
		$cod_conciliacao=time();
		
		$select= "
				update ".$schema.".arquivo_ofx_lancamentos
				set cod_conciliacao='".$cod_conciliacao."'
				where ".$arquivo." cod_arquivo_ofx_lancamentos=0;";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());	

	
		$select= "
				update ".$schema.".captacao_cartas_baixas
				set cod_conciliacao='".$cod_conciliacao."'
				where ".$sistema." cod_captacao_cartas_baixas=0;";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());	
	
		echo "Salvo com sucesso!";
	
	}
	
	
}
class menus{
	function menu(){
	$html= new html;
	echo "<div ><nav class='uk-navbar'  >
				<ul class='uk-navbar-nav'>
					<li class='uk-parent'>
						<img src='http://osuc.org.br/wp-content/uploads/2012/02/osuc.png' alt='OSUC' style='margin:10px ;width: 145px;' border='0'>
					</li>
					<li class='uk-parent' data-uk-dropdown={mode:'click'}>
						<a href='../index.php' data-uk-tooltip={pos:'right'} title='Home'  style='padding-top: 20px;'><i class='uk-icon-home'></i> </a>
					</li>
					<li class='uk-parent' data-uk-dropdown={mode:'click'}>
						<a href='#' data-uk-tooltip={pos:'right'} title='Cadastros' style='padding-top: 20px;'><i class='uk-icon-male'></i></a>
						<div class='uk-dropdown uk-dropdown-navbar'>
							<ul class='uk-nav uk-nav-navbar'>
								<li class='uk-nav-header'>Básico</li>
								<li><a href='cadastro_pessoas.php'>Pessoas</a></li>
								<li><a href='cadastro_campanhas.php'>Campanhas</a></li>
								<li><a href='cadastro_centros.php'>Centros</a></li>
								<li><a href='cadastro_grupos.php'>Grupos</a></li>
								<li><a href='cadastro_colaboradores.php'>Colaboradores</a></li>
								<li><a href='cadastro_centro_receita.php'>Centro de receita</a></li>
								<li class='uk-nav-header'>Financeiro</li>
								<li><a href='cadastro_carteiras.php'>Carteiras</a></li>
								<li><a href='cadastro_convenios.php'>Convênios</a></li>
								<li><a href='cadastro_moedas.php'>Moedas</a></li>
								<li class='uk-nav-header'>Sistema</li>
								<li><a href='cadastro_usuarios.php'>Usuários</a></li>
							</ul>
						</div>

					</li>
					<li class='uk-parent' data-uk-dropdown={mode:'click'}>
						<a href='#' data-uk-tooltip={pos:'right'} title='Lançamentos'  style='padding-top: 20px;'><i class='uk-icon-dollar'></i></a>
						<div class='uk-dropdown uk-dropdown-navbar'>
							<ul class='uk-nav uk-nav-navbar'>
								<li><a href='cadastro_cartas.php'><i class='uk-icon-file-text'></i> Cartas</a></li>
								<li><a href='cadastro_captacoes.php'><i class='uk-icon-list-ol'></i> Captações</a></li>
							</ul>
						</div>

					</li>
					<li class='uk-parent' data-uk-dropdown={mode:'click'}>
						<a href='#' data-uk-tooltip={pos:'right'} title='Arquivos bancários'  style='padding-top: 20px;'><i class='uk-icon-bank' ></i> </a>
						<div class='uk-dropdown uk-dropdown-navbar'>
							<ul class='uk-nav uk-nav-navbar'>
								<li><a href='arquivo_envio.php'><i class='uk-icon-arrow-right'></i> Envio</a></li>
								<li><a href='arquivo_retorno.php'><i class='uk-icon-arrow-left'></i> Retorno</a></li>
							</ul>
						</div>

					</li>
					<li class='uk-parent' data-uk-dropdown={mode:'click'}>
						<a href='#' data-uk-tooltip={pos:'right'} title='Conciliação' style='padding-top: 20px;'><i class='uk-icon-check-square-o'></i> </a>
						<div class='uk-dropdown uk-dropdown-navbar'>
							<ul class='uk-nav uk-nav-navbar'>
								<li><a href='concliacao_bancaria.php'><i class='uk-icon-bank'></i> Conciliação bancária</a></li>
								<li><a href='extrato_carteira.php'><i class='uk-icon-file-text-o'></i> Extrato de lançamentos</a></li>
							</ul>
						</div>

					</li>
					<li class=''><a href='relatorios/index.php' data-uk-tooltip={pos:'right'} title='Relatórios' style='padding-top: 20px;'><i class='uk-icon-line-chart'></i> </a></li>
					<li class=''><a href='areadocolaborador/index.php' data-uk-tooltip={pos:'right'} title='Área do Colaborador' style='padding-top: 20px;'><i class='uk-icon-users'></i> </a></li>
				</ul>
				<div class='uk-navbar-flip'>

					<ul class='uk-navbar-nav'>
						<li data-uk-dropdown={mode:'click'}   ><a href='#'  data-uk-tooltip={pos:'left'} title='Alertas' style='padding-top: 0px; padding-left: 10px; padding-right: 10px;' id='alertas' click='alertas();' onmouseover='alertas();'><i class='uk-icon-exclamation-circle uk-icon-button'></i> <div class='uk-badge uk-badge-danger' id='cad_alertas_numero'>".$html->cad_alertas_numero('ANV')."</div></a> <div class='uk-dropdown uk-dropdown-scrollable' style='width:450px;max-height: 500px !important;'><a href='alertas.php'>Visualizar todos os alertas</a><div  id='div_alertas' style='width:400px;'></div></div></li>
						<li><a href='login/logout.php'  data-uk-tooltip={pos:'left'} title='Sair' style='padding-top: 20px;'><i class='uk-icon-sign-out'></i> </a></li>
					</ul>
				</div>
			</nav></div>";
	
	
	}
	function menu_alertas(){
		
		$menu_alertas="<div class='uk-button-group' style='margin-left: 30px;' >";
		$menu_alertas.="<a href='?status_alerta=ANV' class='uk-button uk-button-mini'  data-uk-tooltip={pos:'bottom'} title='Alerta não visualizado'><i class='uk-icon-eye-slash' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i>Alerta não visualizado</a>";
		$menu_alertas.="<a href='?status_alerta=AV' class='uk-button uk-button-mini'  data-uk-tooltip={pos:'bottom'} title='Alerta visualizado'><i class='uk-icon-eye' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i>Alerta visualizado</a>";
		$menu_alertas.="<a href='?status_alerta=AA' class='uk-button uk-button-mini'  data-uk-tooltip={pos:'bottom'} title='Alerta adiado'><i class='uk-icon-clock-o' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i>Alerta adiado</a>";
		$menu_alertas.="<a href='?status_alerta=AC' class='uk-button uk-button-mini'  data-uk-tooltip={pos:'bottom'} title='Alerta concluido'><i class='uk-icon-check' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i>Alerta concluido</a>";
		$menu_alertas.="</div>";	
		echo $menu_alertas;
	
	}
}
class html{
	function description_list($titulo,$texto,$status,$descricao,$cod_alerta,$data){
		//return "<dt>".$dt."</dt><dd>".$dd."</dd>";

		//ANV <li><i class="uk-icon-eye-slash"></i> eye</li>
		//AV <li><i class="uk-icon-eye"></i> eye</li>
		//AA <li><i class="uk-icon-clock-o"></i> eye</li>
		//AC <li><i class="uk-icon-check"></i> eye</li>
		
			$class_bt_1='';
			$class_bt_2='';
			$class_bt_3='';
			$class_bt_4='';
			
			switch ($status) {
			case 'ANV':
				$class_bt_1='uk-button-danger';
			break;
			case 'AV':
				$class_bt_2='uk-button-primary';
			break;
			case 'AA':
				$class_bt_3='uk-button-primary';
			break;
			case 'AC':
				$class_bt_4='uk-button-success';
			break;


			} 
		
		$icones="<div class='uk-button-group'>";
		$icones.="<span class='uk-button uk-button-mini ".$class_bt_1."' cod_alerta='".$cod_alerta."' status_alerta='ANV' onclick='acao_alerta(this);' data-uk-tooltip={pos:'bottom'} title='Alerta não visualizado'><i class='uk-icon-eye-slash' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i></span>";
		$icones.="<span class='uk-button uk-button-mini ".$class_bt_2."' cod_alerta='".$cod_alerta."' status_alerta='AV' onclick='acao_alerta(this);' data-uk-tooltip={pos:'bottom'} title='Alerta visualizado'><i class='uk-icon-eye' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i></span>";
		$icones.="<span class='uk-button uk-button-mini ".$class_bt_3."' cod_alerta='".$cod_alerta."' status_alerta='AA' onclick='acao_alerta(this);' data-uk-tooltip={pos:'bottom'} title='Alerta adiado'><i class='uk-icon-clock-o' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i></span>";
		$icones.="<span class='uk-button uk-button-mini ".$class_bt_4."' cod_alerta='".$cod_alerta."' status_alerta='AC' onclick='acao_alerta(this);' data-uk-tooltip={pos:'bottom'} title='Alerta concluido'><i class='uk-icon-check' style='padding-top: 3px; padding-right: 3px; padding-left: 2px;'></i></span>";
		$icones.="</div>";
		
		
		$menu_status="<span style='right: 20px; position: absolute;'>".$icones."</span>";
		
		
		return "<tr><td><span class='uk-article-meta'>".$data."".$menu_status."</span></br><b>".$titulo."</b></br>".$texto."</td></tr>";
	}
	function cad_alertas($status){

		include "config.php";
		$html= new html;
		$select="
				SELECT 
					* 

				FROM 
					".$schema.".cad_alertas, 
					".$schema.".cad_status 
				
				WHERE 
					cad_alertas.cod_empresa=".$_SESSION['cod_empresa']." and					
					cad_alertas.status=cad_status.cod_status and
					cad_alertas.status='".$status."' 
				
				ORDER BY
					cad_alertas.data	
					";
				
		$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);
		echo "<table class='uk-table'><tbody>";
			while($row = mysql_fetch_array($resultado))
			{
				echo $html->description_list($row['titulo'],$row['texto'],$row['cod_status'],$row['descricao'],$row['cod_alerta'],$row['data']);
			}
		echo "</tbody></table>";
	}
	function cad_alertas_numero($status){
		include "config.php";
		$html= new html;
		$select="
				SELECT 
					count(cod_alerta) as numero

				FROM 
					".$schema.".cad_alertas
				
				WHERE 
					cad_alertas.cod_empresa=".$_SESSION['cod_empresa']." and	
					cad_alertas.status='".$status."' 

					";
				
		$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);
			while($row = mysql_fetch_array($resultado))
			{
				return $row['numero'];
			}
	}
	
}
//Processar arquivo de retorno

Class arquivo_retorno{


	//Processar
	Public Function processar($pasta,$id_arquivo,$status_arquivo,$baixar){
		include "config.php";	
			$select="
					SELECT 
						cad_arquivos_bancarios.cod_arquivo_bancario,
						cad_arquivos_bancarios.id_arquivo, 
						cad_arquivos_bancarios.cod_convenio,
						cad_arquivos_bancarios.cod_banco,
						cad_arquivos_bancarios.status_arquivo,
						cad_arquivos_bancarios.tipo_arquivo,
						cad_convenios.*

					FROM 
						".$schema.".cad_arquivos_bancarios,
						".$schema.".cad_convenios 

					where 
						cad_arquivos_bancarios.cod_empresa=".$_SESSION['cod_empresa']." and					
						cad_arquivos_bancarios.cod_convenio=cad_convenios.codigo_convenio and
						cad_arquivos_bancarios.id_arquivo='".$id_arquivo."';";
		
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			$json="";
			
			while($row = mysql_fetch_array($resultado)){
				for($i=0;$i<mysql_num_fields($resultado);$i++){
					$campo=mysql_field_name($resultado,$i);
					$$campo=$row[$campo];
				}
			}
		
		
		$select="
				SELECT 
					cad_arquivos_bancarios.lote,
					cad_convenios.cod_carteira
				FROM 
					".$schema.".cad_arquivos_bancarios,
					".$schema.".cad_convenios
					
				where 
					cad_arquivos_bancarios.cod_empresa=".$_SESSION['cod_empresa']." and					
					cad_arquivos_bancarios.cod_convenio=cad_convenios.codigo_convenio and
					id_arquivo='".$id_arquivo."'; ";
						
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		while($row = mysql_fetch_array($resultado))
		{
			$cod_carteira=$row['cod_carteira'];
			$lote=$row['lote'];
		}		
		
		$arquivo_retorno=new arquivo_retorno;
		
		if($tipo_convenio=='boleto'){
			///Informações do Arquivo
			$arquivo_retorno->header_boleto($id_arquivo,$status_arquivo,$pasta);
			
			///Registros do Arquivo
			$arquivo_retorno->body_boleto($id_arquivo,$status_arquivo,$cod_banco,$cod_carteira,$lote,$baixar,$pasta);
		}
		if($tipo_convenio=='debito'){
			///Informações do Arquivo
			$arquivo_retorno->header_debito($id_arquivo,$status_arquivo,$pasta);
			
			///Registros do Arquivo
			$arquivo_retorno->body_debito($id_arquivo,$status_arquivo,$cod_banco,$cod_carteira,$lote,$baixar,$pasta);
		}
	}

	///Header	
	Public Function header_boleto($id_arquivo,$status_arquivo,$pasta){
		$data = file_get_contents($pasta.$id_arquivo); //read the file
		$matriz = explode("\n", $data);		
	
		$A01=SubStr($matriz[0],0,2);
		$A02=SubStr($matriz[0],26,12);
		$A03=SubStr($matriz[0],46,30);
		$A04=SubStr($matriz[0],76,3);
		$A05=SubStr($matriz[0],79,15);
		$A06=SubStr($matriz[0],94,6);
		$A07=SubStr($matriz[0],109,4);
		$A08=SubStr($matriz[0],11,8);
		
		echo "
			<h3>Informações do Arquivo</h3>
			<table class='uk-table uk-table-condensed' style='font-size: 11px;'>";
				echo "<tr><td width='150'>Tipo de Arquivo:</td><td>".$A01."</td></tr>";
				echo "<tr><td width='150'>Codigo Convêncio:</td><td>".$A02."</td></tr>";
				echo "<tr><td width='150'>Nome Empresa:</td><td>".$A03."</td></tr>";
				echo "<tr><td width='150'>Codigo do Banco:</td><td>".$A04."</td></tr>";
				echo "<tr><td width='150'>Nome Banco:</td><td>".$A05."</td></tr>";
				echo "<tr><td width='150'>Data Geração:</td><td>".$A06."</td></tr>";
				echo "<tr><td width='150'>Numero Lote:</td><td>".$A07."</td></tr>";
				echo "<tr><td width='150'>Descrição Serviço:</td><td>".$A08."</td></tr>";
				echo "<tr><td width='150'>Total Registros:</td><td>".number_format(SubStr($matriz[count($matriz)-2],212,8), 0, ',', '.')."</td></tr>";
				echo "<tr><td width='150'>Total R$:</td><td>".number_format(SubStr($matriz[count($matriz)-2],220,14)/100, 2, ',', '.')."</td></tr>";
			echo "</table>"	;	

		
	}
	Public Function header_debito($id_arquivo,$status_arquivo,$pasta){
		$data = file_get_contents($pasta.$id_arquivo); //read the file
		$matriz = explode("\n", $data);				
		
		$A01=SubStr($matriz[0],0,2);
		$A02=SubStr($matriz[0],2,20);
		$A03=SubStr($matriz[0],22,20);
		$A04=SubStr($matriz[0],42,3);
		$A05=SubStr($matriz[0],45,20);
		$A06=SubStr($matriz[0],65,8);
		$A07=SubStr($matriz[0],74,7);
		$A08=SubStr($matriz[0],81,30);
		
		echo "
			<h3>Informações do Arquivo</h3>
			<table class='uk-table uk-table-condensed' style='font-size: 11px;'>";
				echo "<tr><td width='150'>Tipo de Arquivo:</td><td>".$A01."</td></tr>";
				echo "<tr><td width='150'>Codigo Convêncio:</td><td>".$A02."</td></tr>";
				echo "<tr><td width='150'>Nome Empresa:</td><td>".$A03."</td></tr>";
				echo "<tr><td width='150'>Codigo do Banco:</td><td>".$A04."</td></tr>";
				echo "<tr><td width='150'>Nome Banco:</td><td>".$A05."</td></tr>";
				echo "<tr><td width='150'>Data Geração:</td><td>".$A06."</td></tr>";
				echo "<tr><td width='150'>Numero Lote:</td><td>".$A07."</td></tr>";
				echo "<tr><td width='150'>Descrição Serviço:</td><td>".$A08."</td></tr>";
				echo "<tr><td width='150'>Total Registros:</td><td>".SubStr($matriz[count($matriz)-2],1,6)."</td></tr>";
				echo "<tr><td width='150'>Total R$:</td><td>".number_format(SubStr($matriz[count($matriz)-2],7,17)/100, 2, ',', '.')."</td></tr>";
			echo "</table>"	;	
		
		
	}

	///Body
	Public Function body_boleto($id_arquivo,$status_arquivo,$cod_banco,$cod_carteira,$lote,$baixar,$pasta){

		$arquivo_retorno = new arquivo_retorno();
		
		$data = file_get_contents($pasta.$id_arquivo); //read the file
		$matriz = explode("\n", $data);

		echo "
			<h3>Dados do Arquivo</h3>
			<div class='uk-overflow-container'>
				<table class='uk-table uk-table-hover uk-table-condensed uk-table-striped uk-text-nowrap uk-panel-box uk-overflow-container' style='font-size: 11px;'>
					<tr>
						<th>Dta.Débito</th>
						<th>Valor</th>
						<th>Multa e juros</th>
						<th>Cod.Captacao</th>
						<th>Dta. Vencimento</th>
						<th>Cod.Contribuinte</th>
						<th>Contribuinte</th>
						<th>Status</th>
					</tr>";
				for ($i=1;$i<count($matriz)-2;$i++)  
				{
					$arquivo_retorno -> registro($matriz[$i],'boleto',$cod_banco,$cod_carteira,$lote,$baixar);
				}
			echo "
				</table>
			</div>
			";		
		if($baixar=='sim'){$arquivo_retorno->update_status_arquivo($id_arquivo,'AP');}
		
	}
	Public Function body_debito($id_arquivo,$status_arquivo,$cod_banco,$cod_carteira,$lote,$baixar,$pasta){
		
		$arquivo_retorno = new arquivo_retorno();
		
		$data = file_get_contents($pasta.$id_arquivo); //read the file
		$matriz = explode("\n", $data);

		echo "
			<h3>Dados do Arquivo</h3>
			<div class='uk-overflow-container'>
				<table class='uk-table uk-table-hover uk-table-condensed uk-table-striped uk-text-nowrap uk-panel-box uk-overflow-container' style='font-size: 11px;'>
					<tr>
						<th>Cod.Registro</th>
						<th>Cod.Cliente</th>
						<th>Agencia</th>
						<th>N.Conta</th>
						<th>Dta.Débito</th>
						<th>Valor</th>
						<th>Cod.Retorno</th>
						<th>Nome</th>
						<th>Cod.Captacao</th>
						<th>Cod.Movimento</th>
						<th>Cod.Movimento</th>
					</tr>";
				for ($i=1;$i<count($matriz)-2;$i++)  
				{
					$arquivo_retorno -> registro($matriz[$i],'debito',$cod_banco,$cod_carteira,$lote,$baixar);
				}
			echo "
				</table>
			</div>
			";		
		if($baixar=='sim'){$arquivo_retorno->update_status_arquivo($id_arquivo,'AP');}
		
	}
	Public function registro($registro,$tipo_convenio,$banco,$cod_carteira,$lote,$baixar){
			$arquivo_retorno=new arquivo_retorno;
			if($tipo_convenio=='debito'){
				switch ($banco)
				{
				case "1": ///B. Brasil
					$E0=SubStr($registro,0,1);				//Cod.Registro
					$E1=SubStr($registro,1,25);				//Cod.Cliente
					$E2=SubStr($registro,26,4);				//Agencia
					$E3=SubStr($registro,30,14);			//N.Conta
					$E4=SubStr($registro,44,8);				//Dta.Débito
					$E5=SubStr($registro,52,15);			//Valor
					$E6=SubStr($registro,67,2);				//Cod.Retorno
					$E7=SubStr($registro,69,50);			//Nome
					$E8=SubStr($registro,119,10);			//Cod.Captacao
					$E9=SubStr($registro,129,20);			//Cod.Movimento
					$E10=SubStr($registro,149,1);			//Cod.Movimento
				break;
				case "399": ///B. HSBC
					$E0=SubStr($registro,0,1);				//Cod.Registro
					$E1=SubStr($registro,1,25);				//Cod.Cliente
					$E2=SubStr($registro,26,4);				//Agencia
					$E3=SubStr($registro,30,14);			//N.Conta
					$E4=SubStr($registro,44,6)+20000000;	//Dta.Débito
					$E5=SubStr($registro,50,15);			//Valor
					$E6=SubStr($registro,65,2);				//Cod.Retorno
					$E7=SubStr($registro,67,50);			//Nome
					$E8=SubStr($registro,117,12);			//Cod.Captacao
					$E9=SubStr($registro,129,20);			//Cod.Movimento
					$E10=SubStr($registro,149,1);			//Cod.Movimento
				break;
				case "341": ///B. Itau
					$E0=SubStr($registro,0,1);				//Cod.Registro
					$E1=SubStr($registro,1,25);				//Cod.Cliente
					$E2=SubStr($registro,26,4);				//Agencia
					$E3=SubStr($registro,30,14);			//N.Conta
					$E4=SubStr($registro,44,8);				//Dta.Débito
					$E5=SubStr($registro,52,15);			//Valor
					$E6=SubStr($registro,67,2);				//Cod.Retorno
					$E7=SubStr($registro,69,50);			//Nome
					$E8=SubStr($registro,129,20);			//Cod.Captacao
					$E9=SubStr($registro,119,10);			//Cod.Movimento
					$E10=SubStr($registro,149,1);			//Cod.Movimento
				break;
				case "237": ///B. Bradesco
					$E0=SubStr($registro,0,1);				//Cod.Registro
					$E1=SubStr($registro,1,25);				//Cod.Cliente
					$E2=SubStr($registro,26,4);				//Agencia
					$E3=SubStr($registro,30,14);			//N.Conta
					$E4=SubStr($registro,44,8);				//Dta.Débito
					$E5=SubStr($registro,52,15);			//Valor
					$E6=SubStr($registro,67,2);				//Cod.Retorno
					$E7=SubStr($registro,69,50);			//Nome
					$E8=SubStr($registro,119,10);			//Cod.Captacao
					$E9=SubStr($registro,129,20);			//Cod.Movimento
					$E10=SubStr($registro,149,1);			//Cod.Movimento
				break;
				case "356": ///B. Real
					$E0=SubStr($registro,0,1);				//Cod.Registro
					$E1=SubStr($registro,1,25);				//Cod.Cliente
					$E2=SubStr($registro,26,4);				//Agencia
					$E3=SubStr($registro,30,14);			//N.Conta
					$E4=SubStr($registro,44,8);				//Dta.Débito
					$E5=SubStr($registro,52,15);			//Valor
					$E6=SubStr($registro,67,2);				//Cod.Retorno
					$E7=SubStr($registro,69,50);			//Nome
					$E8=SubStr($registro,119,10);			//Cod.Captacao
					$E9=SubStr($registro,129,20);			//Cod.Movimento
					$E10=SubStr($registro,149,1);			//Cod.Movimento
				break;
				case "33": ///B. Banespa
					$E0=SubStr($registro,0,1);				//Cod.Registro
					$E1=SubStr($registro,1,25);				//Cod.Cliente
					$E2=SubStr($registro,26,4);				//Agencia
					$E3=SubStr($registro,30,14);			//N.Conta
					$E4=SubStr($registro,44,8);				//Dta.Débito
					$E5=SubStr($registro,52,15);			//Valor
					$E6=SubStr($registro,67,2);				//Cod.Retorno
					$E7=SubStr($registro,69,50);			//Nome
					$E8=SubStr($registro,119,10);			//Cod.Captacao
					$E9=SubStr($registro,129,20);			//Cod.Movimento
					$E10=SubStr($registro,149,1);			//Cod.Movimento
				break;
				default:
					$E0=SubStr($registro,0,1);				//Cod.Registro
					$E1=SubStr($registro,1,25);				//Cod.Cliente
					$E2=SubStr($registro,26,4);				//Agencia
					$E3=SubStr($registro,30,14);			//N.Conta
					$E4=SubStr($registro,44,8);				//Dta.Débito
					$E5=SubStr($registro,52,15);			//Valor
					$E6=SubStr($registro,67,2);				//Cod.Retorno
					$E7=SubStr($registro,69,50);			//Nome
					$E8=SubStr($registro,119,10);			//Cod.Captacao
					$E9=SubStr($registro,129,20);			//Cod.Movimento
					$E10=SubStr($registro,149,1);			//Cod.Movimento
				}
				
				$arquivo_retorno = new arquivo_retorno();
				if($baixar=='sim'){
				//	$arquivo_retorno -> baixar_captacao($E6,$E4,$E5,$E8,$convenio,$nome_arquivo,$lote);
					$arquivo_retorno -> baixar_captacao($E8,$E6,$E4,$E5,$cod_carteira,$lote,'BAIXA AUTOMATICA');
				}
					echo "<tr id='".$E8.$E5."' class='tr_sem_foco' onclick='TR_onClick(this)' onmouseout='TR_onMouseOut(this)' onmouseover='TR_onMouseOver(this)'>";	
						echo	"<td>".$E0."</td>";
						echo "<td>".$E1."</td>";
						echo "<td>".$E2."</td>";
						echo	"<td>".$E3."</td>";
						echo "<td>".SubStr($E4,6,2)."/".SubStr($E4,4,2)."/".SubStr($E4,0,4)."</td>";
						echo "<td>".number_format($E5/100, 2, ',', '.')."</td>";
						echo "<td>".$E6."</td>";
						echo "<td>".$E7."</td>";
						echo "<td>".$E8."</td>";
						echo "<td>".$E9."</td>";
						echo "<td>".$E10."</td>";
					echo "</tr>";
				
			}
			if($tipo_convenio=='boleto'){
				switch ($banco)
				{
				case "1": ///B. Brasil

				break;
				case "399": ///B. HSBC

				break;
				case "341": ///B. Itau
					$E4=(SubStr($registro,114,2)+2000).SubStr($registro,112,2).SubStr($registro,110,2);		    //Dta.Débito 
					$E5=SubStr($registro,146,19);			//Valor
					$E5_=SubStr($registro,266,13);			//Multa e juros 
					$E8=SubStr($registro,127,8);			//Cod.Captacao

				break;
				case "237": ///B. Bradesco

				break;
				case "356": ///B. Real

				break;
				case "33": ///B. Banespa

				break;
				default:
					$E4=(SubStr($registro,114,2)+2000).SubStr($registro,112,2).SubStr($registro,110,2);		    //Dta.Débito 
					$E5=SubStr($registro,146,19);			//Valor
					$E5_=SubStr($registro,266,13);			//Multa e juros 
					$E8=SubStr($registro,127,8);			//Cod.Captacao
				}
				
				$arquivo_retorno = new arquivo_retorno();
				if($baixar=='sim'){
											//baixar_captacao($cod_captacao,$cod_retorno,$data_recebimento,$valor_recebido,$cod_carteira,$lote,$historico)
						$arquivo_retorno -> baixar_captacao($E8,'00',$E4,$E5,$cod_carteira,$lote,'BAIXA AUTOMATICA');
					if($E5_>0){
						$arquivo_retorno -> baixar_captacao($E8,'00',$E4,$E5_,$cod_carteira,$lote,'JUROS E MULTA');
					}
				}
					echo "<tr>";	
						//echo "<td>".SubStr($E4,6,2)."/".SubStr($E4,4,2)."/".SubStr($E4,0,4)."</td>";
						echo "<td>".SubStr($E4,6,2)."/".SubStr($E4,4,2)."/".SubStr($E4,0,4)."</td>";
						echo "<td>".number_format($E5/100, 2, ',', '.')."</td>";
						echo "<td>".number_format($E5_/100, 2, ',', '.')."</td>";
						echo "<td>".$E8."</td>";
						$arquivo_retorno->detalhe_captacao($E8);
						
					echo "</tr>";
				
			}


		}

	///Funções de captação
	Public Function detalhe_captacao($cod_captacao){
		include "config.php";
		$select="
					select
						captacao_cartas.cod_captacao_cartas,
						captacao_cartas.data_vencimento,
						concat(captacao_cartas.status,' - ',cad_status.descricao) as status_captacao,
						cad_cartas.cod_contribuinte,
						cad_pessoas.nome_razao_social
					from 
						".$schema.".captacao_cartas,
						".$schema.".cad_cartas,
						".$schema.".cad_pessoas,
						".$schema.".cad_status
						
					where 
						captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and						
						captacao_cartas.cod_carta=cad_cartas.cod_carta and 
						cad_cartas.cod_contribuinte=cad_pessoas.cod_pessoa and
						captacao_cartas.status=cad_status.cod_status and
						captacao_cartas.cod_captacao_cartas=".$cod_captacao."; ";
						
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		while($row = mysql_fetch_array($resultado))
		{
			echo "<td>".data($row['data_vencimento'])."</td>";
			echo "<td>".$row['cod_contribuinte']."</td>";
			echo "<td>".$row['nome_razao_social']."</td>";
			echo "<td>".$row['status_captacao']."</td>";
		}

	}
	Public function baixar_captacao($cod_captacao,$cod_retorno,$data_recebimento,$valor_recebido,$cod_carteira,$lote,$historico){
		include "config.php";
		if($cod_retorno=="00" and $cod_captacao!="" and $data_recebimento!="" and $valor_recebido!=""){
		$select= "INSERT INTO 
						`".$schema."`.`captacao_cartas_baixas` (
								`cod_captacao_cartas` ,
								`data_baixa` ,
								`valor_baixa`,
								`cod_carteira`,
								`lote`,
								`historico`) 
						VALUES ( 
								'".$cod_captacao."',
								'".(SubStr($data_recebimento,0,4)."-".SubStr($data_recebimento,4,2)."-".SubStr($data_recebimento,6,2))."',
								'".($valor_recebido/100)."',
								'".$cod_carteira."',
								'".$lote."',
								'".$historico."')
						ON DUPLICATE KEY UPDATE
								`cod_captacao_cartas`='".$cod_captacao."' ,
								`data_baixa`='".(SubStr($data_recebimento,0,4)."-".SubStr($data_recebimento,4,2)."-".SubStr($data_recebimento,6,2))."' ,
								`valor_baixa`='".($valor_recebido/100)."',
								`cod_carteira`='".$cod_carteira."',
								`lote`='".$lote."',
								`historico`='".$historico."';";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		}
		
		$select= "UPDATE `".$schema."`.`captacao_cartas` SET `status` = '".$cod_retorno."',`data_ultima_alteracao`='".date("Y-m-d H:i:s")."' WHERE `captacao_cartas`.`cod_captacao_cartas` ='".$cod_captacao."';";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		


		}

	///Funções de arquivo	
	Public function update_status_arquivo($id_arquivo,$status){
			include "config.php";
			$select= "UPDATE `".$schema."`.`cad_arquivos_bancarios` SET `status_arquivo` = '".$status."' WHERE `cad_arquivos_bancarios`.`id_arquivo`='".$id_arquivo."';";
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			
		}	
	Public Function excluir($nome_arquivo){
	
	
		include "config.php";
		
		$select= "DELETE FROM `".$schema."`.`cad_arquivos_bancarios` WHERE `cad_arquivos_bancarios`.`cod_arquivo_bancario` =".$nome_arquivo;
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
	
	
	}
	Public Function contar_download($id,$status){
	
	
		include "config.php";
		
		$select= "UPDATE `".$schema."`.`cad_arquivos_bancarios` SET `status_arquivo`='AB', `numero_downloads` = `numero_downloads`+1 WHERE `cad_arquivos_bancarios`.`tipo_arquivo`='envio' and `cad_arquivos_bancarios`.`cod_arquivo_bancario`=".$id;
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
	
	
	}

}

//Arquivos de envio
Class arquivo_envio_debito{
	Public Function gerar($data_inicio,$data_fim,$convenio){
	include "config.php";
		
		$data_base=mysql_select_db('".$schema."',$conexao);
		$select= "call gerar_arquivo('".data($data_inicio)."','".data($data_fim)."','".$convenio."');";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());

		$select="
			SELECT 
				cad_arquivos_bancarios.cod_convenio,
				cad_convenios.ultimo_lote
				
			FROM 
				".$schema.".cad_arquivos_bancarios,
				".$schema.".cad_convenios

			where
				cad_convenios.cod_empresa=".$_SESSION['cod_empresa']." and				
				cad_convenios.codigo_convenio=cad_arquivos_bancarios.cod_convenio and
				cad_convenios.ultimo_lote=cad_arquivos_bancarios.lote and
				cad_arquivos_bancarios.cod_convenio=".$convenio."  ;
			";	
					$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);
	
						while($row = mysql_fetch_array($resultado))
						{
							$tabelas=new tabelas;
							$tabelas->listar_arquivos_envio('01/01/1900','31/12/9999','',$row['cod_convenio'],'',$row['ultimo_lote']);
						}	
		
		
	}
	Public Function excluir($lote,$banco){
	include "config.php";
		
		//Update captações para captação gerada codigo "-02"
		$select= "
				update 
					".$schema.".captacao_cartas,
					(select 
						captacao_cartas.cod_captacao_cartas as captacao,
						captacao_cartas.cod_carta as carta,
						captacao_cartas.numero_lote as lote,
						cad_cartas.debito_banco as banco

					 from  

						".$schema.".captacao_cartas ,
						".$schema.".cad_cartas

					where
					captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
					captacao_cartas.cod_carta=cad_cartas.cod_carta
					) as x

				set 
					captacao_cartas.`status`='-02' 

				where
					captacao_cartas.cod_captacao_cartas=x.captacao and
					x.lote=".$lote." and x.banco=".$banco.";";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());

		
//		Deleta arquivo da pasta
				$select= "
				select *
				
				From
					`".$schema."`.`cad_arquivos_bancarios` 
				where
					cad_arquivos_bancarios.cod_empresa=".$_SESSION['cod_empresa']." and					
					cad_arquivos_bancarios.cod_banco=".$banco." and 
					cad_arquivos_bancarios.lote=".$lote.";";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		while($row = mysql_fetch_array($resultado))
		{
			unlink("arquivos_bancarios/envio/".$row['id_arquivo']);
		}
		
		
		
		//Exclusão de cad_arquivo de envio
		$sql=new sql;
		$sql->delete('cad_arquivos_bancarios',"cad_arquivos_bancarios.cod_banco=".$banco." and cad_arquivos_bancarios.lote=".$lote."");

	}
}

//emails
Class email{
	function enviar_senha($destinatario,$usuario,$senha){


	  // Check if the "from" input field is filled out
	// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.$destinatario.'>' . "\r\n";
		$headers .= 'Reply-To: captacao@osuc.org.br' . "\r\n";
		$subject = 'Envio de senha';
		$messagem =
		"<div >
			<div>
				<img src='' border='0' class='CToWUd'>
			</div>
			<div>
				<p>
					Caro(a) usuário(a) ,<br><br><br>Bem vindo!
				</p>
				<p>
					Os seus dados para acesso ao <a href='http://sistema.osuc.org.br/' target='_blank'>sistema.osuc.org.br</a> são:
				</p>
			</div>
			<div>
				<p>
					Usuário: <b>".$usuario."</b><br>
					Senha</span>: <b>".$senha."</b>
				</p>

		</div>";
		// send mail
		mail($destinatario,$subject,str_replace("\n.", "\n..", "<html><body>".$messagem."</body></html>"),$headers)or die(error());


	}


}

Class cadastros{
	function pesquisa($select,$tabela){
		include "config.php";
		
			$sql=new sql;
			$menus=new menus;
			$pesquisa=new pesquisa;
			$inputs=new inputs;
			$selects=new selects;
			$campos_inputs=new inputs;		
			$campos_select=new selects;		
				
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			$row = mysql_fetch_array($resultado);
			for($i=0;$i<mysql_num_fields($resultado);$i++){
				$campo=mysql_field_name($resultado,$i);
				$$campo=$row[$campo];
			}
			include "includes/".$tabela.".php";


	}
	
	function cad_cartas_avulsa($cod_carta){
		include "config.php";		
					$select= "
						select
							cad_status.descricao as descricao_status_carta,
							cad_status.status_resumido as status_resumido,						
							cad_cartas.cod_carta,
							cad_cartas.cod_contribuinte as cod_pessoa,
							cad_cartas.cod_colaborador,
							cad_cartas.carta_moeda,
							cad_cartas.carta_qtd_moeda,
							cad_cartas.carta_valor_moeda,
							cad_cartas.carta_aberta,
							DATE_FORMAT(cad_cartas.carta_data_inicio,'%d/%m/%Y') as carta_data_inicio,
							DATE_FORMAT(cad_cartas.carta_data_fim,'%d/%m/%Y') as carta_data_fim,
							cad_cartas.periodicidade,
							cad_cartas.carta_forma_pagamento,
							cad_cartas.carta_dia_debito,
							cad_cartas.carta_reajuste,
							cad_cartas.debito_banco,
							cad_cartas.debito_numero_agencia,
							cad_cartas.debito_digito_agencia,
							cad_cartas.debito_numero_conta,
							cad_cartas.debito_digito_conta,
							cad_cartas.credito_bandeira,
							cad_cartas.credito_tolken,
							cad_cartas.boleto_modo_envio,
							cad_cartas.status_carta,
							cad_cartas.status_captacoes,
							cad_cartas.cod_motivo_cancelamento,
							cad_pessoas.nome_razao_social as contribuinte,
							tb_colaboradores.colaborador as colaborador,
							cad_ctrreceitas.nome as ctrreceita,
							cad_ctrreceitas.cod_ctrreceita as cod_ctrreceita
							
						from
							".$schema.".cad_ctrreceitas,
							".$schema.".cad_status,
							".$schema.".cad_cartas,
							".$schema.".cad_pessoas,
							(select
								".$schema.".cad_pessoas.nome_razao_social as colaborador,
								".$schema.".cad_colaboradores.cod_colaborador
							from
								".$schema.".cad_pessoas,
								".$schema.".cad_colaboradores
							where
								".$schema.".cad_colaboradores.cod_pessoa=".$schema.".cad_pessoas.cod_pessoa) as tb_colaboradores
							
						where
							cad_cartas.cod_carta='".$cod_carta."' and
							cad_cartas.cod_contribuinte=cad_pessoas.cod_pessoa and
							cad_cartas.cod_colaborador=tb_colaboradores.cod_colaborador and
							cad_cartas.status_carta=cad_status.cod_status and
							cad_ctrreceitas.cod_ctrreceita=cad_cartas.cod_ctrreceita;";
					$tabela="cad_cartas_avulsa";
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);

	}
	function cad_pessoas($cod_pessoa){
		include "config.php";		
					$select= "
							select 
								* 
								
							from 
								".$schema.".cad_pessoas 
								
							where  
								`cad_pessoas`.`cod_pessoa` = '".$cod_pessoa."' and 
								cad_pessoas.status=1;";
					$tabela="cad_pessoas";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);

	}
	function cad_campanhas($cod_campanha){
		include "config.php";		
					$select= "
							select 
								cod_campanha,
								nome_campanha,
								observacao,
								DATE_FORMAT(data_inicio,'%d/%m/%Y') as data_inicio,
								DATE_FORMAT(data_fim,'%d/%m/%Y') as data_fim							
								
							from 
								".$schema.".cad_campanhas 
								
							where  
								`cad_campanhas`.`cod_campanha` = '".$cod_campanha."';";
					$tabela="cad_campanhas";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);

	}
	function cad_centros($cod_centro){
		include "config.php";		
					$select= "
							select 
								*
								
							from 
								".$schema.".cad_centros 
								
							where  
								`cad_centros`.`cod_centro` = '".$cod_centro."';";
					$tabela="cad_centros";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);

	}
	function cad_convenios($cod_convenio){
		include "config.php";		
					$select= "
							select 
								`cod_convenio`,								`cod_empresa`,								`codigo_convenio`,								`tipo_convenio`,								`cod_do_banco` as cod_banco,								`agencia`,								`conta`,								`cod_carteira`,								`ultimo_lote`
								
							from 
								".$schema.".cad_convenios 
								
							where  
								`cad_convenios`.`cod_convenio` = '".$cod_convenio."';";
					$tabela="cad_convenios";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);

	}
	function cad_grupos($cod_grupo){
		include "config.php";		
					$select= "
							select 
								`".$schema."`.`cad_grupos`.*,
								`".$schema."`.`cad_centros`.`nome_centro` as centro,
								`".$schema."`.`cad_campanhas`.`nome_campanha` as campanha
								
							from 
								`".$schema."`.`cad_grupos`,
								`".$schema."`.`cad_centros`,
								`".$schema."`.`cad_campanhas`

							where 
								`".$schema."`.`cad_grupos`.cod_centro= `".$schema."`.`cad_centros`.cod_centro and
								`".$schema."`.`cad_grupos`.cod_campanha=`".$schema."`.`cad_campanhas`.cod_campanha and	
								`cad_grupos`.`cod_grupo`='".$cod_grupo."' and 
								`cad_grupos`.`status`=1;";
					$tabela="cad_grupos";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);

	}
	function cad_colaboradores($cod_colaborador){
		include "config.php";		
					$select= "
						select 
							*
							
						from 
							".$schema.".cad_colaboradores
							
						where 
							cad_colaboradores.cod_colaborador='".$cod_colaborador."';";
					$tabela="cad_colaboradores";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);
		
		
		
	}
	function cad_carteiras($cod_carteira){
		include "config.php";		
					$select= "
							select 
								cod_carteira,
								nome_carteira
								
							from 
								".$schema.".cad_carteiras 
								
							where  
								`cad_carteiras`.`cod_carteira` = '".$cod_carteira."';";
					$tabela="cad_carteiras";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);
		
		
		
	}
	function cad_moedas($cod_moeda){
		include "config.php";		
					$select= "
							select 
								cod_moeda,
								moeda
								
							from 
								".$schema.".cad_moedas 
								
							where  
								`cad_moedas`.`cod_moeda` = ".$cod_moeda.";";
					$tabela="cad_moedas";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);
		
		
		
	}
	function cad_cartas($cod_carta){
		include "config.php";		
					$select= "
						select
							cad_status.descricao as descricao_status_carta,
							cad_status.status_resumido as status_resumido,						
							cad_cartas.cod_carta,
							cad_cartas.cod_contribuinte as cod_pessoa,
							cad_cartas.cod_colaborador,
							cad_cartas.carta_moeda as cod_moeda,
							cad_cartas.carta_qtd_moeda,
							cad_cartas.carta_valor_moeda,
							cad_cartas.carta_aberta,
							DATE_FORMAT(cad_cartas.carta_data_inicio,'%d/%m/%Y') as carta_data_inicio,
							DATE_FORMAT(cad_cartas.carta_data_fim,'%d/%m/%Y') as carta_data_fim,
							cad_cartas.periodicidade,
							cad_cartas.carta_forma_pagamento as tipo_convenio,
							cad_cartas.carta_dia_debito,
							cad_cartas.carta_reajuste,
							cad_cartas.debito_banco as cod_banco,
							cad_cartas.debito_numero_agencia,
							cad_cartas.debito_digito_agencia,
							cad_cartas.debito_numero_conta,
							cad_cartas.debito_digito_conta,
							cad_cartas.credito_bandeira,
							cad_cartas.credito_tolken,
							cad_cartas.boleto_modo_envio,
							cad_cartas.status_carta,
							cad_cartas.status_captacoes,
							cad_cartas.cod_motivo_cancelamento,
							cad_pessoas.nome_razao_social as contribuinte,
							tb_colaboradores.colaborador as colaborador,
							cad_ctrreceitas.nome as ctrreceita,
							cad_ctrreceitas.cod_ctrreceita as cod_ctrreceita
							
						from
							".$schema.".cad_ctrreceitas,
							".$schema.".cad_status,
							".$schema.".cad_cartas,
							".$schema.".cad_pessoas,
							(select
								".$schema.".cad_pessoas.nome_razao_social as colaborador,
								".$schema.".cad_colaboradores.cod_colaborador
							from
								".$schema.".cad_pessoas,
								".$schema.".cad_colaboradores
							where
								".$schema.".cad_colaboradores.cod_pessoa=".$schema.".cad_pessoas.cod_pessoa) as tb_colaboradores
							
						where
							cad_cartas.cod_carta='".$cod_carta."' and
							cad_cartas.cod_contribuinte=cad_pessoas.cod_pessoa and
							cad_cartas.cod_colaborador=tb_colaboradores.cod_colaborador and
							cad_cartas.status_carta=cad_status.cod_status and
							cad_ctrreceitas.cod_ctrreceita=cad_cartas.cod_ctrreceita;";
					$tabela="cad_cartas";								
		$cadastros=new cadastros;
		$cadastros->pesquisa($select,$tabela);
		
		
		
	}
	
}

Class pesquisa{
	function cad_cartas($cod_carta){
		include "config.php";
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			  {
					$keys=array_keys($row);
					var_dump($keys);
					for($n=0;$n<count($keys);$n++){
						$$keys[$n]=$row[$keys[$n]];
					}

			  }		
		
		
	}
	
	
}














	function adddate($vardate,$added){
	$data = explode("-", $vardate);
	$date = new DateTime();            
	$date->setDate($data[0], $data[1], 1);
	$date->modify("".$added."");
	$day= $date->format("Y-m-d");
	return $day;    
	}
	function data($data){

		if(strpos($data,"-")!==false){
			$dat = explode ("-",$data,3);
			return $dat[2]."/".$dat[1]."/".$dat[0];
		}else{
			$dat = explode ("/",$data,3);
			return $dat[2]."-".$dat[1]."-".$dat[0];
		}

	}
	function decimal($valor){
		if(strpos($valor,",")!== false){
			$valor=str_replace(".","",$valor);
			return str_replace(',','.',$valor);
		}else{
			return str_replace('.',',',$valor);
		}
}
?>