<?php
					$select_colaborador= 
						"select
							cad_pessoas.*,
							cad_colaboradores.cod_colaborador as cod_colaborador
						from
							".$schema.".cad_colaboradores,
							".$schema.".cad_pessoas
						where
							cad_pessoas.cod_pessoa=cad_colaboradores.cod_pessoa and
							cod_colaborador=".$_POST['cod_colaborador'].";";
					
					$resultado_colaborador=mysql_query($select_colaborador,$conexao) or die ("<div class='uk-alert uk-alert-danger' data-uk-alert=''><p>".mysql_error()."</p></div>");
					$n=1;
						while($row_colaborador = mysql_fetch_array($resultado_colaborador))
						{
						$nome=$row_colaborador['nome_razao_social'];
						$email=$row_colaborador['email_1'];

						$dados_colaborador="
							<form class='uk-form uk-form-stacked' id='dados_colaborador'>
									<div class='uk-width-1-1 uk-panel' style='margin-bottom: 15px;'>
												<div class='uk-button-group'>
													<button class='uk-button uk-button-primary' type='button'   data-uk-modal={target:'#email'} onclick=''><i class='uk-icon-envelope'></i> Entrar em contato</button>
													<button class='uk-button uk-button-primary' type='button'  data-uk-modal={target:'#dados_contribuinte'} onclick='salvar_colaborador(".$row_colaborador['cod_pessoa'].");'><i class='uk-icon-floppy-o'></i> Salvar</button>
													<a href='?cod_colaborador=' class='uk-button uk-button-danger'><i class='uk-icon-sign-out'></i> Sair</a>
												</div>

												
									</div>
							<h3>Dados do Colaborador</h3>
							<hr class='uk-article-divider' style='margin: 10px;'>
                                <div class='uk-grid uk-grid-divider' >

                                    <div class='uk-width-2-3'>
										<div class='uk-panel'>
															<div class='uk-form-row'>
																<div class='uk-grid'>
																	<div class='uk-width-1-5'>
																		<label class='uk-form-label' for='cod_colaborador'>Colaborador</label>
																		<input type='text' class='caixadetexto form-small' id='cod_colaborador' disabled='' value='".$row_colaborador['cod_colaborador']."' >	
																	</div>
																	<div class='uk-width-1-5'>
																		<label class='uk-form-label' for='Codigo Pessoa'>Cod.Pessoa</label>
																		<input type='text' class='caixadetexto form-small' id='cod_pessoa' disabled='' value='".$row_colaborador['cod_pessoa']."' >	
																	</div>

																	<div class='uk-width-3-5'>
																		<label class='uk-form-label' for='Nome'>Nome ou Razao Social</label>
																		<input type='text' class='caixadetexto form-small' id='nome_razao_social' placeholder='Nome ou razão social' style='width: 100%;' value='".$row_colaborador['nome_razao_social']."'>
																	</div>
																</div>
															</div>	
																<div class='uk-form-row uk-width-1-1'>
																	<label class='uk-form-label' for='Endereco' >Endereço</label>
																	<input type='text' class='caixadetexto form-small' id='endereco' placeholder='Endereço' onkeyup='pesquisacep(this);' style='width: 100%;' value='".$row_colaborador['endereco']."'>
																</div>
																<div class='uk-form-row uk-width-1-1'>
																	<div class='uk-grid'>
																		<div class='uk-width-1-5' style='min-width: 50px;'>
																			<label class='uk-form-label' for='Numero'>Número</label>
																			<input type='text' class='caixadetexto form-small' id='numero' placeholder='Número' style='width: 100%;' value='".$row_colaborador['numero']."'>
																		</div>
																		<div class='uk-width-2-5' style='min-width: 50px;'>
																			<label class='uk-form-label' for='Complemento'>Complemento</label>
																			<input type='text' class='caixadetexto form-small' id='complemento' placeholder='Complemento' style='width: 100%;' value='".$row_colaborador['complemento']."'>
																		</div>
																		<div class='uk-width-2-5' style='min-width: 50px;'>
																			<label class='uk-form-label' for='CEP'>CEP</label>
																			<input type='text' class='caixadetexto form-small' onkeyup='pesquisacep(this);' id='cep' placeholder='CEP' style='width: 100%;' value='".$row_colaborador['cep']."'>
																		</div>
																	</div>
																</div>
																<div class='uk-form-row uk-width-1-1'>
																	<div class='uk-grid'>
																		<div class='uk-width-4-10' style='min-width: 50px;'>
																			<label class='uk-form-label' for='bairro'>Bairro</label>
																			<input type='text' class='caixadetexto form-small' id='bairro' placeholder='Bairro' style='width: 100%;' value='".$row_colaborador['bairro']."'>
																		</div>
																		<div class='uk-width-5-10' style='min-width: 50px;'>
																			<label class='uk-form-label' for='Cidade'>Cidade</label>
																			<input type='text' class='caixadetexto form-small' id='cidade' placeholder='Cidade' style='width: 100%;' value='".$row_colaborador['cidade']."'>
																		</div>
																		<div class='uk-width-1-10' style='min-width: 20px;'>
																			<label class='uk-form-label' for='UF'>UF</label>
																			<input type='text' class='caixadetexto form-small' onkeyup='mascara('00',this);' id='uf' placeholder='UF' style='width: 100%;' value='".$row_colaborador['uf']."'>
																		</div>
																	</div>
																</div>
								
															</div>
															</div>
															<div class='uk-width-1-3'>
																<div class='uk-panel '>
																	<div class='uk-form-row'>
																		<label class='uk-form-label' for='Email'>E-mail</label>
																		<input type='text' class='caixadetexto form-small' id='email_1' placeholder='E-mail' style='width: 100%;' value='".$row_colaborador['email_1']."'>
																	</div>
																	<div class='uk-form-row'>
																		<label class='uk-form-label' for='Email'>E-mail</label>
																		<input type='text' class='caixadetexto form-small' id='email_2' placeholder='E-mail' style='width: 100%;' value='".$row_colaborador['email_2']."'>
																	</div>
																	<div class='uk-grid uk-form-row'>
																		<div class='uk-width-1-2' style='min-width: 110px;'>
																			<label class='uk-form-label' for='Telefone1'>Telefone 1</label>
																			<input type='text' class='caixadetexto form-small' id='telefone_1' placeholder='Telefone' style='width: 100%;' value='".$row_colaborador['telefone_1']."'>
																		</div>
																		<div class='uk-width-1-2' style='min-width: 110px;'>
																			<label class='uk-form-label' for='Telefone2'>Telefone 2</label>
																			<input type='text' class='caixadetexto form-small' id='telefone_2' placeholder='Telefone' style='width: 100%;' value='".$row_colaborador['telefone_2']."'>
																		</div>
																	</div>
																	<div class='uk-grid uk-form-row'>
																		<div class='uk-width-1-2' style='min-width: 110px;'>
																			<label class='uk-form-label' for='Celular1'>Celular 1</label>
																			<input type='text' class='caixadetexto form-small' id='celular_1' placeholder='Celular' style='width: 100%;'  value='".$row_colaborador['celular_1']."'>
																		</div>
																		<div class='uk-width-1-2' style='min-width: 110px;'>
																			<label class='uk-form-label' for='Celular2'>Celular 2</label>
																			<input type='text' class='caixadetexto form-small' id='celular_2' placeholder='Celular' style='width: 100%;' value='".$row_colaborador['celular_2']."'>
																		</div>
																	</div>
																</div>
															</div>

                                </div>
								
							</form>


						";
						
						
						
						}


?>