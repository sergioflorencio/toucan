<?php
class sql{
	public function update($table,$campos,$where){
		include "config.php";
		$consulta="UPDATE `".$schema."`.`".$table."` SET ".$campos.", data_ultima_alteracao=Now() WHERE ".$where.";";
		$update=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		echo "
		
			<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-2 uk-container-center' data-uk-alert='' style='margin-top: 30px;width: 100%;'>
				<p>O registro foi salvo com sucesso!</p>
			</div>

			
		";
	}
	
}


if(isset($_POST['atualizar']) and $_POST['atualizar']==0 and isset($_POST['cod_pessoa'])){
//Pesquisar Cadastro
include "config.php";
		$select= "
				select 
					*
					
				from 
					".$schema.".cad_pessoas
				
				where 
					cod_pessoa=".$_POST['cod_pessoa'].";";

		$resultado=mysql_query($select,$conexao) or die ($select);
			while($row = mysql_fetch_array($resultado))
			{
						echo "
							<form class='uk-form uk-form-stacked' id='dados_contribuinte'>
                                <div class='uk-grid uk-grid-divider' >

                                    <div class='uk-width-1-1'>
										<div class='uk-panel s'>
												<h3>Dados do contribuinte</h3>
												<hr class='uk-article-divider'>		
															<div class='uk-form-row'>
																<div class='uk-grid'>
																	<div class='uk-width-1-5'>
																		<label class='uk-form-label' for='Codigo Pessoa'>Código</label>
																		<input type='text' class='caixadetexto' id='contr_cod_pessoa' disabled='' value='".$row['cod_pessoa']."' >	
																	</div>
																	<div class='uk-width-4-5'>
																		<label class='uk-form-label' for='Nome'>Nome ou Razao Social</label>
																		<input type='text' class='caixadetexto' id='contr_nome_razao_social' style='width: 100%;' value='".$row['nome_razao_social']."'>
																	</div>
																</div>
															</div>
																<div class='uk-form-row uk-width-1-1'>
																	<label class='uk-form-label' for='Endereco' >Endereço</label>
																	<input type='text' class='caixadetexto' id='contr_endereco' style='width: 100%;' value='".$row['endereco']."'>
																</div>
																<div class='uk-form-row uk-width-1-1'>
																	<div class='uk-grid'>
																		<div class='uk-width-1-5' style='min-width: 100px;'>
																			<label class='uk-form-label' for='Numero'>Número</label>
																			<input type='text' class='caixadetexto' id='contr_numero' style='width: 100%;' value='".$row['numero']."'>
																		</div>
																		<div class='uk-width-2-5' style='min-width: 100px;'>
																			<label class='uk-form-label' for='Complemento'>Complemento</label>
																			<input type='text' class='caixadetexto' id='contr_complemento' style='width: 100%;' value='".$row['complemento']."'>
																		</div>
																		<div class='uk-width-2-5' style='min-width: 100px;'>
																			<label class='uk-form-label' for='CEP'>CEP</label>
																			<input type='text' class='caixadetexto' id='contr_cep' style='width: 100%;' value='".$row['cep']."'>
																		</div>
																	</div>
																</div>
																<div class='uk-form-row uk-width-1-1'>
																	<div class='uk-grid'>
																		<div class='uk-width-4-10' style='min-width: 100px;'>
																			<label class='uk-form-label' for='bairro'>Bairro</label>
																			<input type='text' class='caixadetexto' id='contr_bairro' style='width: 100%;' value='".$row['bairro']."'>
																		</div>
																		<div class='uk-width-4-10' style='min-width: 100px;'>
																			<label class='uk-form-label' for='Cidade'>Cidade</label>
																			<input type='text' class='caixadetexto' id='contr_cidade' style='width: 100%;' value='".$row['cidade']."'>
																		</div>
																		<div class='uk-width-2-10' style='min-width: 70px;'>
																			<label class='uk-form-label' for='UF'>UF</label>
																			<input type='text' class='caixadetexto'  id='contr_uf' style='width: 100%;' value='".$row['uf']."'>
																		</div>
																	</div>
																</div>
								

																<div class='uk-grid uk-form-row'>	
																	<div class='uk-width-1-2'>
																		<label class='uk-form-label' for='Email'>E-mail</label>
																		<input type='text' class='caixadetexto' id='contr_email_1' style='width: 100%;' value='".$row['email_1']."'>
																	</div>
																	<div class='uk-width-1-2'>
																		<label class='uk-form-label' for='Email'>E-mail</label>
																		<input type='text' class='caixadetexto' id='contr_email_2'  style='width: 100%;' value='".$row['email_2']."'>
																	</div>
																</div>	
																	
																	
																	
																	<div class='uk-grid uk-form-row'>
																		<div class='uk-width-1-4' style='min-width: 100px;'>
																			<label class='uk-form-label' for='Telefone1'>Telefone 1</label>
																			<input type='text' class='caixadetexto' id='contr_telefone_1'  style='width: 100%;' value='".$row['telefone_1']."'>
																		</div>
																		<div class='uk-width-1-4' style='min-width: 100px;'>
																			<label class='uk-form-label' for='Telefone2'>Telefone 2</label>
																			<input type='text' class='caixadetexto' id='contr_telefone_2'  style='width: 100%;' value='".$row['telefone_2']."'>
																		</div>
																		<div class='uk-width-1-4' style='min-width: 100px;'>
																			<label class='uk-form-label' for='Celular1'>Celular 1</label>
																			<input type='text' class='caixadetexto' id='contr_celular_1'  style='width: 100%;'  value='".$row['celular_1']."'>
																		</div>
																		<div class='uk-width-1-4' style='min-width: 100px;'>
																			<label class='uk-form-label' for='Celular2'>Celular 2</label>
																			<input type='text' class='caixadetexto' id='contr_celular_2'  style='width: 100%;' value='".$row['celular_2']."'>
																		</div>
																	</div>
																</div>
															</div>

                                </div>
								
							</form>
							
							<hr class='uk-article-divider'>
							<div style='text-align: right;' >
								<button class='uk-button uk-button-success' type='button' onclick='salvar_contribuinte();'><i class='uk-icon-floppy-o'></i> Salvar</button>
							</div>

";
				
				
				
			}	



}
if(isset($_POST['atualizar']) and $_POST['atualizar']==1 and isset($_POST['cod_pessoa'])){
//Atualizar Cadastro
include "config.php";
		$sql=new sql;
		$table="cad_pessoas";
		$campos="
					nome_razao_social='".$_POST['nome_razao_social']."',
					endereco='".$_POST['endereco']."',
					numero='".$_POST['numero']."',
					complemento='".$_POST['complemento']."',
					cep='".$_POST['cep']."',
					bairro='".$_POST['bairro']."',
					cidade='".$_POST['cidade']."',
					uf='".$_POST['uf']."',
					email_1='".$_POST['email_1']."',
					email_2='".$_POST['email_2']."',
					telefone_1='".$_POST['telefone_1']."',
					telefone_2='".$_POST['telefone_2']."',
					celular_1='".$_POST['celular_1']."',
					celular_2='".$_POST['celular_2']."'
		";
		$where="cod_pessoa='".$_POST['cod_pessoa']."'";
		$sql->update($table,$campos,$where);

}




?>