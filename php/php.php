<?php

	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){

		Class email{
			function enviar_senha($destinatario,$usuario,$senha){


			  // Check if the "from" input field is filled out
			// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <'.$destinatario.'>' . "\r\n";
				$headers .= 'Reply-To: captacao@tucan.org.br' . "\r\n";
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
		class selects{
			function select_menu($cod_menu){
				include "config.php";
							$select_option= "
									select 
										* 
										
									from 
										".$schema.".cad_menu
										
										;";
										
							$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
							echo "<div class='uk-form-row'>
									<label class='uk-form-label' for='xxx'>Banco</label>
									<div class='uk-form-controls'>
									<select class='uk-form-small' id='cod_menu' name='cod_menu' style='width: 100%;'>
										<option value=''></option>";
										while($row_option = mysql_fetch_array($resultado_option))
										{
										
										if(isset($cod_menu) and $row_option['cod_menu']==$cod_menu){
												echo "<option value='".$row_option['cod_menu']."' selected >".$row_option['label']."</option>";
											}else{
												echo "<option value='".$row_option['cod_menu']."'>".$row_option['label']."</option>";
											}
										}	
								echo "</select>
									</div></div>";

			
			}
			function select_menu_pai($cod_menu_pai){
				include "config.php";
							$select_option= "
									select 
										* 
										
									from 
										".$schema.".cad_menu
									where
										cod_menu_pai=0
										
										;";
										
							$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
							echo "<div class='uk-form-row'>
									<label class='uk-form-label' for='xxx'>menu pai</label>
									<div class='uk-form-controls'>
									<select class='uk-form-small' id='cod_menu_pai' name='cod_menu_pai' style='width: 100%;'>
										<option value=''></option>";
										while($row_option = mysql_fetch_array($resultado_option))
										{
										
										if(isset($cod_menu_pai) and $row_option['cod_menu_pai']==$cod_menu_pai){
												echo "<option value='".$row_option['cod_menu']."' id='menu_pai_".$row_option['cod_menu']."' value='".$row_option['cod_menu_pai']."' selected >".$row_option['modulo']." - ".$row_option['label']."</option>";
											}else{
												echo "<option value='".$row_option['cod_menu']."' id='menu_pai_".$row_option['cod_menu']."' value='".$row_option['cod_menu_pai']."'>".$row_option['modulo']." - ".$row_option['label']."</option>";
											}
										}	
								echo "</select>
									</div></div>";

			
			}
			function select_empresa($cod_empresa){
				include "config.php";
							$select_option= "
									select 
										* 
										
									from 
										".$schema.".cad_empresa
										
										;";
										
							$resultado_option=mysql_query($select_option,$conexao) or die (mysql_error());
							echo "
													<option value=''></option>";
										while($row_option = mysql_fetch_array($resultado_option))
										{
										
										if(isset($cod_empresa) and $row_option['cod_empresa']==$cod_empresa){
												echo "<option value='".$row_option['cod_empresa']."' selected >".$row_option['razao_social']."</option>";
											}else{
												echo "<option value='".$row_option['cod_empresa']."'>".$row_option['razao_social']."</option>";
											}
										}	

			
			}
			function select_matriz_filial($matriz_filial){
				if(isset($matriz_filial) and $matriz_filial=='matriz'){
					echo "<option value='matriz' selected >Matriz</option>";
				}
				if(isset($matriz_filial) and $matriz_filial=='filial'){
					echo "<option value='filial' selected >Filial</option>";
				}
					echo "<option value='matriz' >Matriz</option>";
					echo "<option value='filial' >Filial</option>";		
				
			}


		}

		class cadastro{
			function pesquisa($select,$tabela,$id){
				include "config.php";
				
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					$row = mysql_fetch_array($resultado);
					for($i=0;$i<mysql_num_fields($resultado);$i++){
						$campo=mysql_field_name($resultado,$i);
						global  $$campo;
								$$campo=$row[$campo];
					}
			}
			function cad_usuarios($id){
				include "config.php";
				$select="SELECT 
							cad_usuario.`cod_usuario` as id, 
							cad_usuario.`email`, 
							cad_usuario.`senha`, 
							cad_usuario.`nome`, 
							cad_usuario.`status`, 
							cad_usuario.`lebretesenha`, 
							cad_usuario.`usuario`,
							
							acoes_banco.`insert`,
							acoes_banco.`update`,
							acoes_banco.`delete`
						FROM 
							".$schema.".cad_usuario 
						left join
							(SELECT cod_usuario,`insert`,`update`,`delete` FROM ".$schema.".cad_usuarios_acoes_banco_dados  where cod_usuario='".$id."') as acoes_banco  on acoes_banco.cod_usuario=cad_usuario.cod_usuario
						where 
							cad_usuario.cod_usuario='".$id."' ;";
				$cadastro=new cadastro;
				$cadastro->pesquisa($select,'cad_usuario','cod_usuarios');
			
			}
			function cad_empresas($id){
				include "config.php";
				$select="SELECT 
							cad_empresa.*
						FROM 
							".$schema.".cad_empresa 
						where 
							cad_empresa.cod_empresa='".$id."' ;";
				$cadastro=new cadastro;
				$cadastro->pesquisa($select,'cad_empresa','cod_empresa');
			
			}
			function listar_menu($label,$cod_menu,$cod_menu_pai,$modulo,$icone){
				$cadastro=new cadastro;
				echo "<li><a href='#' onclick='pesquisar_cad_modulo(this);' data-uk-modal={target:'#modal_editar_cad_modulo'} cod_menu='".$cod_menu."' cod_menu_pai='".$cod_menu_pai."'   > <i class='".$icone."'></i> ".$label."</a>";
				$cadastro->cad_menu($modulo,$cod_menu);
					
				echo 	
				"</li>";
			
			}	
			function cad_menu($modulo,$cod_menu_pai){
					$cadastro=new cadastro;
					include "config.php";
					$select="
							SELECT 
								*
							FROM 
								".$schema.".cad_menu 
							where 
								cod_menu_pai='".$cod_menu_pai."' and 
								modulo='".$modulo."';";
								
					echo "<ul class='uk-list'>";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado)){
					
						$cadastro->listar_menu($row['label'],$row['cod_menu'],$row['cod_menu_pai'],$modulo,$row['icone']);
					}
					echo "</ul>";			
				

				

			
			}


		}
		class html{
			function menu_principal(){
				include "config.php";
				if(isset($_SESSION['logo'])){$logo=$_SESSION['logo'];}else{$logo="";}
				if(isset($_SESSION['razao_social'])){$razao_social=$_SESSION['razao_social'];}else{$razao_social="";}
					echo "
						 <div id='menu'>
							<nav  class='uk-navbar'  >
								<ul class='uk-navbar-nav'  style=''>
												<li class='uk-parent'>
													<a href='#' data-uk-tooltip={pos:'bottom'} title='".$razao_social."'>
														<img src='".$logo."' alt='' style='margin: 10px; max-height: 35px; max-width: 145px;' border='0'>
													</a>
												</li>
												<li class='uk-parent' data-uk-dropdown={mode:'click'}>
													<a data-cached-title='Home' href='index.php' data-uk-tooltip={pos:'right'} title='' style='padding-top: 20px;'><i class='uk-icon-home'></i> </a>
												</li>									
								</ul>
								<div class='uk-navbar-flip'>

									<ul class='uk-navbar-nav'>
										<li>
											<a href='index.php?act=mudar_empresa' data-uk-tooltip={pos:'bottom'} title='mudar de empresa'><i class='uk-icon-exchange' style='padding-top: 17px;'></i></a>
										</li>									
										<li><a href='".$DNS."?login=logout'  data-uk-tooltip={pos:'left'} title='Sair' style='padding-top: 20px;'><i class='uk-icon-sign-out'></i> </a></li>
									</ul>
								</div>
							</nav>
						</div>		
					
					
					";
					
				

			
			
			
			
			
			
			
			}
			function template_usuarios(){
			echo "
					<div class='  uk-width-1-4 uk-width-medium-1-3 uk-width-large-1-4'>

						<ul class='uk-list  uk-width-1-1'>
							<li>
								<a class='uk-thumbnail uk-width-1-1' href='#'>
									<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'>Usuario 1</div>
								</a>
							</li>
							<li>
								<a class='uk-thumbnail uk-width-1-1' href='#'>
									<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'>Usuario 1</div>
								</a>
							</li>
							<li>
								<a class='uk-thumbnail uk-width-1-1' href='#'>
									<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'>Usuario 1</div>
								</a>
							</li>
							<li>
								<a class='uk-thumbnail uk-width-1-1' href='#'>
									<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'>Usuario 1</div>
								</a>
							</li>
							<li>
								<a class='uk-thumbnail uk-width-1-1' href='#'>
									<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'>Usuario 1</div>
								</a>
							</li>


						</ul>

					</div>
					 <div class=' uk-width-3-4 uk-width-medium-2-3 uk-width-large-3-4'>

						
						<div class='uk-grid  uk-text-left '>
								
								<div class='uk-width-1-1 uk-form'>
										<h3>Cadastro de usuarios</h3>

											<div class='uk-width-1-1' id='div_msg'></div>
											<div class='uk-form-row uk-grid'>
												<div class='uk-width-1-4'>
													<label class='uk-form-label' for='cod_usuario'>cod_usuario</label>
													<input class='uk-form-small' name='cod_usuario' id='cod_usuario' style='width: 100%;' value='' readonly='' type='text'>
												</div>
												<div class='uk-width-3-4'>
													<label class='uk-form-label' for='nome'>Nome</label>
													<input class='uk-form-small' name='nome' id='nome' style='width: 100%;' value='' type='text'>
												</div>
											</div>

											<div class='uk-form-row uk-grid'>
												<div class='uk-width-1-2'>
													<label class='uk-form-label' for='username'>username</label>
													<input class='uk-form-small' name='username' id='username' style='width: 100%;' value='' type='text'>
												</div>
												<div class='uk-width-1-2'>

													<label class='uk-form-label' for='email'>email</label>
													<input class='uk-form-small' name='email' id='email' style='width: 100%;' value='' type='text'>
												</div>
											</div>
											<div class='uk-form-row uk-grid'>
										
												<div class='uk-width-1-4'>	
													<label class='uk-form-label' for='email'>Status</label>
													<select class='uk-form-small' name='status' id='status' style='width: 100%;'>
														<option value=''></option>
														<option value='A'>Ativo</option>
														<option value='B'>Bloqueado</option>
													</select>
												</div>
												<div class='uk-width-3-4'><br>
													<a class='uk-button uk-button-small uk-button-primary' onclick='gerar_senha();' style='width: 100%;'><i class='uk-icon-save'></i> Gerar senha</a>
												</div>	
													
													
											</div>
											<div class='uk-form-row'>
												<span class='uk-button uk-button-small uk-button-primary'><i class='uk-icon-save'></i>  Salvar</span>
											</div>

											<hr class='uk-article-divider'>	

								</div>

								
								
								<div class='uk-width-1-1'>

										<h3>Acessos de banco</h3>
											<div class='uk-form'>
												<label class='uk-margin-small-top'><input type='checkbox' name='update' id='update'> Update</label>
												<label class='uk-margin-small-top'><input type='checkbox' name='insert' id='insert'> Insert</label>
												<label class='uk-margin-small-top'><input type='checkbox' name='delete' id='delete'> Delete</label>
											</div>								
										
										
										<hr class='uk-article-divider'>	
									
									
								</div>

								
								
								
								<div class='uk-width-1-1'>
										<h3>Acessos de módulo</h3>
										<ul class='uk-list'>
											<li><label><input type='checkbox'> <b>módulo 1</b></label></li>
											<li>
												<ul class='uk-list'>
													<li><label><input type='checkbox'> Item 1</label></li>
													<li><label><input type='checkbox'> Item 2</label></li>
													<li><label><input type='checkbox'> Item 2</label></li>
													<li>
														<ul class='uk-list'>
															<li><label><input type='checkbox'> Item 1</label></li>
															<li><label><input type='checkbox'> Item 2</label></li>
															<li><label><input type='checkbox'> Item 3</label></li>
														</ul>											
													</li>
													<li><label><input type='checkbox'> Item 2</label></li>
													<li><label><input type='checkbox'> Item 3</label></li>
												</ul>											
											</li>
											<li><label><input type='checkbox'> <b>módulo 2</b></label></li>
											<li>
												<ul class='uk-list'>
													<li><label><input type='checkbox'> Item 1</label></li>
													<li><label><input type='checkbox'> Item 2</label></li>
													<li><label><input type='checkbox'> Item 3</label></li>
												</ul>											
											</li>
										</ul>						
								
								</div>

						
						</div>
					 
					 
					 
					</div>
				
			
			";
			
			
			}
			function listar_usuarios(){
				include "config.php";
				function lista($nome,$cod_usuario){
					return "
							<li>
								<a class='uk-thumbnail uk-width-1-1' href='?cod_usuario=".$cod_usuario."'>
									<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'>".$nome."</div>
								</a>
							</li>			
					";
				
				}
				
				$select="SELECT * FROM ".$schema.".cad_usuario ;";
				$resultado=mysql_query($select,$conexao) or die (mysql_error());
				while($row = mysql_fetch_array($resultado)){
					echo lista($row['nome'],$row['cod_usuario']);
				}
			
			
			}
			function listar_empresas(){
				include "config.php";
				function lista($razao_social,$cod_empresa,$cnpj){
					return "
							<li>
								<a class='uk-thumbnail uk-width-1-1' href='?cod_empresa=".$cod_empresa."'>
									<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'>".$razao_social."<br/>".$cnpj."</div>
								</a>
							</li>			
					";
				
				}
				
				$select="SELECT * FROM ".$schema.".cad_empresa ;";
				$resultado=mysql_query($select,$conexao) or die (mysql_error());
				while($row = mysql_fetch_array($resultado)){
					echo lista($row['razao_social'],$row['cod_empresa'],$row['cnpj']);
				}
			
			
			}
			function listar_menu($label,$cod_menu,$cod_menu_pai,$modulo,$icone,$cheked,$cod_usuario){
				$html=new html;
				echo "<li><label><input type='checkbox' onclick='cad_menu_acessos(this);' cod_menu='".$cod_menu."' cod_menu_pai='".$cod_menu_pai."' ".$cheked."  > <i class='".$icone."'></i> ".$label."</label>";
				$html->listar_cad_menu($modulo,$cod_menu,$cod_usuario);
					
				echo 	
				"</li>";
			
			}	
			function listar_cad_menu($modulo,$cod_menu_pai,$cod_usuario){
					$html=new html;
					include "config.php";
					$select="
							SELECT 
								cad_menu.*,
								if(tb_checked.status=1,'checked','') as checked
							FROM 
								".$schema.".cad_menu 
							left join
								(select cod_menu, status from ".$schema.".cad_menu_acessos where cod_usuario='".$cod_usuario."') as tb_checked on tb_checked.cod_menu=cad_menu.cod_menu
							where 
								cod_menu_pai='".$cod_menu_pai."' and 
								modulo='".$modulo."';";
								
					echo "<ul class='uk-list'>";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado)){
					
						$html->listar_menu($row['label'],$row['cod_menu'],$row['cod_menu_pai'],$modulo,$row['icone'],$row['checked'],$cod_usuario);
					}
					echo "</ul>";			
				

				

			
			}
			
			function listar_empresa($cod_empresa,$razao_social,$cod_usuario,$checked,$cnpj){
				echo "

							<tr>
								<td><input onclick='cad_empresa_acessos(this);' cod_empresa='".$cod_empresa."' cod_usuario='".$cod_usuario."'  ".$checked." type='checkbox'></td>
								<td>".$razao_social."</td>
								<td>".$cnpj."</td>
							</tr>

				";
				
				
			}

			function listar_cad_empresa($cod_usuario){
					$html=new html;
					include "config.php";
					$select="
							SELECT 
								cad_empresa.*,
								if(tb_checked.status=1,'checked','') as checked
							FROM 
								".$schema.".cad_empresa 
							left join
								(select cod_empresa, status from ".$schema.".cad_empresa_acessos where cod_usuario='".$cod_usuario."') as tb_checked on tb_checked.cod_empresa=cad_empresa.cod_empresa
							";
								
					echo "
						<table class='uk-table uk-table-condensed uk-table-hover'>
							<caption>Empresas cadastradas</caption>
							<thead>
								<tr>
									<th></th>
									<th>Razão Social</th>
									<th>CNPJ</th>
								</tr>
							</thead>
							<tbody>					
					";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado)){
						$html->listar_empresa($row['cod_empresa'],$row['razao_social'],$cod_usuario,$row['checked'],$row['cnpj']);
					}
					echo "
							</tbody>
						</table>					
					";				
			}

		}
		class imagens{
				function upload_logo(){
					$sql=new sql;
			
				//move arquivo
					$arquivo = $_FILES['upload_logo'];
				//Salvando o Arquivo
					$nome_arquivo = md5(mt_rand(1,10000).$arquivo['name']).'.jpg';
					$caminho_arquivo = "imagens/";
					$caminho = $caminho_arquivo.$nome_arquivo;
					move_uploaded_file($arquivo['tmp_name'],"../".$caminho);  
					
					$table="cad_empresa";
					$campos="`logo`='".$caminho."'";
					$where="cod_empresa='".$_POST['cod_empresa']."'";
					$msg="N";
					$sql->update($table,$campos,$where,$msg);
					
					echo "<img src='".$caminho."' class='uk-cover-background' alt='' height='100' width='200'>";

				
			}
			
			
		}
	}

?>