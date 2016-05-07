<?php
class selects{
	function _____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label){
		include "config.php";
					if ($id!="" and $id!=0){
						$sql_select.=" where `".$campo_id."`=".$id.";";
					}
					$resultado_option=mysql_query($sql_select,$conexao) or die (mysql_error());
					$options="<option value=''></option>";
					while($row_option = mysql_fetch_array($resultado_option))
					{
						if(isset($id) and $row_option[$campo_id]==$id){
							$options.= "<option value='".$row_option[$campo_id]."' selected >".$row_option[$campo_id]." - ".$row_option[$campo_descricao]."</option>";
						}else{
							$options.= "<option value='".$row_option[$campo_id]."'>".$row_option[$campo_id]." - ".$row_option[$campo_descricao]."</option>";
						}
					}	
						echo "<label class='uk-form-label' for='".$campo_id."'>".$label."</label><select class='uk-form-small' id='".$campo_id."' name='".$campo_id."' style='width: 100%;'>".$options."</select>";
	}
	function _____modelo__2__($sql_select,$campo_id,$id,$campo_descricao,$label){
		include "config.php";

					$resultado_option=mysql_query($sql_select,$conexao) or die (mysql_error());
					$options="<option value=''></option>";
					while($row_option = mysql_fetch_array($resultado_option))
					{
						if(isset($id) and $row_option[$campo_id]==$id){
							$options.= "<option value='".$row_option[$campo_id]."' selected >".$row_option[$campo_id]." - ".$row_option[$campo_descricao]."</option>";
						}else{
							$options.= "<option value='".$row_option[$campo_id]."'>".$row_option[$campo_id]." - ".$row_option[$campo_descricao]."</option>";
						}
					}	
						echo "<label class='uk-form-label' for='".$campo_id."'>".$label."</label><select class='uk-form-small' id='".$campo_id."' name='".$campo_id."' style='width: 100%;'>".$options."</select>";
	}
	function modelo($id,$label){
		include "config.php";		
		$sql_select="SELECT * FROM ".$schema.".cad_fornecedor";
		$campo_id="cod_fornecedor";
		$campo_descricao="nome_razao_social";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}

	function cod_status_projeto($id,$label){
		include "config.php";		
		$sql_select="SELECT * FROM ".$schema.".cad_status_projeto";
		$campo_id="cod_status_projeto";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo__2__($sql_select,$campo_id,$id,$campo_descricao,$label);
	}

	
	
}

class menus{
	
	function navegador_($valores,$id){
		echo "
			<div class='uk-width-1-4' style=''>
				<a href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['min']."' class='uk-button'><i class='uk-icon-fast-backward'></i> primeiro</a>
				<a href='?act=cadastros&mod=".$_GET['mod']."&id=".max($id-1,$valores['min']) ."' class='uk-button'><i class='uk-icon-backward'></i> anterior</a>
				<a href='?act=cadastros&mod=".$_GET['mod']."&id=".min($id+1,$valores['max'])."' class='uk-button'><i class='uk-icon-forward'></i> próximo</a>
				<a href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['max']."' class='uk-button'><i class='uk-icon-fast-forward'></i> útimo</a>
			</div>";
	}
	function submenu(){
		echo "
					<li>
						<div class='uk-button-group'>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=pesquisa&mod=".$_GET['mod']."&id='  style=''><i class='uk-icon-binoculars'></i> Pesquisar</a>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=cadastros&mod=".$_GET['mod']."&id=' style=''><i class='uk-icon-file-o'></i> Novo</a> 
							<a class='uk-button uk-button-mini uk-button-primary ' href='#' id='bt_salvar'  style=''><i class='uk-icon-save '></i> Salvar</a>
						</div>		
					</li>
					<script>$('#bt_salvar').click(function(){document.getElementById('form_cadastro').submit();});</script>	

		";
	}
	function submenu_1(){
		echo "
					<li>
						<div class='uk-button-group'>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=pesquisa&mod=".$_GET['mod']."&id='  style=''><i class='uk-icon-binoculars'></i> Pesquisar</a>
							<a class='uk-button uk-button-mini uk-button-primary ' href='#' id='bt_salvar'  style=''><i class='uk-icon-save '></i> Salvar</a>
						</div>		
					</li>
					<script>$('#bt_salvar').click(function(){document.getElementById('form_cadastro').submit();});</script>	

		";
	}
	function submenu_2(){
		echo "
					<li>
						<div class='uk-button-group'>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=pesquisa&mod=".$_GET['mod']."&id='  style=''><i class='uk-icon-binoculars'></i> Pesquisar</a>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=editar&mod=".$_GET['mod']."&id=' style=''><i class='uk-icon-file-o'></i> Novo</a> 
							<a class='uk-button uk-button-mini uk-button-primary ' href='#' id='bt_salvar' style=''><i class='uk-icon-save '></i> Salvar</a>
						</div>		
					</li>
					<script>$('#bt_salvar').click(function(){document.getElementById('form_cadastro').submit();});</script>	

		";
	}
	function submenu_editar(){
		echo "
		<li>
			<div class='uk-button-group'>
				<a class='uk-button uk-button-mini uk-button-primary ' href='?act=pesquisa&mod=".$_GET['mod']."&id='  style=''><i class='uk-icon-binoculars'></i> Pesquisar</a>
				<a class='uk-button uk-button-mini uk-button-primary ' href='?act=".$_GET['act']."&mod=".$_GET['mod']."&id=' style=''><i class='uk-icon-file-o'></i> Novo</a> 
				<a class='uk-button uk-button-mini uk-button-primary ' href='#' id='bt_salvar' onclick=salvar_cadastro('".$_GET['mod']."'); style=''><i class='uk-icon-save '></i> Salvar</a>
			</div>		
		</li>
		";

	}
	function submenu_cad_documento(){
		if($_GET['id']>0 or $_GET['id']!=""){$disabled=" disabled ";$disabled_="  ";}else{$disabled="  ";$disabled_=" disabled ";}
		echo "
				<li>
					<div class='uk-button-group'>
						<a class='uk-button uk-button-mini uk-button-primary' href='?act=pesquisa&mod=".$_GET['mod']."&id=' class='uk-button-link '  style=''><i class='uk-icon-binoculars'></i> Pesquisar</a> 
						<a class='uk-button uk-button-mini uk-button-primary' href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button-link ' style=''><i class='uk-icon-file'></i> Novo documento</a> 
						<button class='uk-button uk-button-mini uk-button-primary' type='button' onclick='salvar_documento()' ".$disabled."><i class='uk-icon-check'></i> Salvar</button>
					</div>
					<div class='uk-button-group'>
						<button class='uk-button uk-button-mini uk-button-success' data-uk-modal=".'"'."{target:'#div_importar_lancamentos'}".'"'."  ".$disabled."><i class='uk-icon-sign-in'></i>  Importar lançamentos</button>
					</div>
					
					<div class='uk-button-group'>
						<button class='uk-button uk-button-mini uk-button-danger' type='button' onclick=cloneRow('tableToModify')  ".$disabled." ><i class='uk-icon-plus-circle'></i> Nova linha</button>
						<button class='uk-button uk-button-mini uk-button-danger' type='button' onclick=delAllRow('tableToModify')  ".$disabled."><i class='uk-icon-times'></i> Excluir linhas</button>
					</div>
					
					<div class='uk-button-group'>
						<a class='uk-button uk-button-mini uk-button-danger' type='button' href='?act=lancamento&mod=estornar_documento&id=".$_GET['id']."' ".$disabled_." ><i class='uk-icon-eraser'></i> Estornar documento</a>
					</div>
				</li>
		";
	}
	function menu_exportar($id_grid,$filtro){

	
	//	echo "<ul class='uk-subnav uk-subnav-line uk-navbar-flip' style='margin-bottom: 10px;'>";
		
		if($filtro!=""){
			echo	"<li>
						<div class='uk-button-dropdown' data-uk-dropdown={justify:'#principal',mode:'click'} >
							<a href='#'><i class='uk-icon-filter'></i> Filtro <i class='uk-icon-caret-down'></i></a>
								<div style='' class='uk-dropdown'>		
								";
			$relatorios=new relatorios;
			$filtro=$relatorios->filtros($filtro);					
		echo "
								</div>
						</div>							
				</li>	";	
		}				
				
		echo "
				<li>
					<div class='uk-button-group'>
						<a class='uk-button uk-button-mini uk-button-primary' href='#' onclick=exportar('xls','".$id_grid."','html'); ><i class='uk-icon-file-excel-o'></i> .xls </a>
						<a class='uk-button uk-button-mini uk-button-primary' href='#' onclick=exportar('doc','".$id_grid."','html'); ><i class='uk-icon-file-word-o'></i> .doc </a>
					</div>
				</li>
				<li id='arquivo_gerado'>
				</li>
			
		";
	}
	function menu(){

		$relatorios=new relatorios;
		
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id'])){
		
			switch ($_GET['act']) {

				case "pesquisa":
					switch ($_GET['mod']) {
						
						case "cad_conta":
							$this->submenu_1();
						break;
							
						case "cad_centro_custo":
							$this->submenu_1();
						break;
							
						case "cad_documento":
							$relatorios->filtros(1);
							echo "<li  data-uk-tooltip={pos:'right'} title='Novo'><div class='uk-button-group'><a href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button uk-button-mini uk-button-primary ' style=''><i class='uk-icon-file'></i> Incluir novo cadastro</a></div></li>";
							$this->menu_exportar('grid',0);
						break;
							
						case "razao":
							$relatorios->filtros(5);
							$this->menu_exportar('grid',0);
						break;
							
						default:
							$this->submenu();
						break;
					}				
				break;
				
				case "cadastros":
					switch ($_GET['mod']) {
						case "cad_conta":
							$this->submenu_2();
						break;
						
						case "cad_centro_custo":

							$this->submenu_2();
						break;
						
						case "cad_documento":
							$this->submenu_cad_documento();
						break;
						
						default:
							$this->submenu();
						break;
					}
				break;
				
				case "editar":
					switch ($_GET['mod']) {
						
						case "cad_conta":
							$this->submenu_editar();
						break;
						
						case "cad_centro_custo":
							$this->submenu_editar();
						break;
						
						default:
						break;
					}
				break;
				
				case "relatorios":
					switch ($_GET['mod']) {
						case "razao_conta":
							$relatorios->filtros(2);
							$this->menu_exportar('relatorio','');
						break;

						case "livro_diario":
							$relatorios->filtros(3);
							$this->menu_exportar('relatorio','');
						break;

						case "balancete":
							$relatorios->filtros(4);
							$this->menu_exportar('relatorio','');
						break;

						default:
						break;
					}				
				break;
				
				case "conciliacao":
					switch ($_GET['mod']) {
						case "conciliar":
							$relatorios->filtros(6);
							$this->menu_exportar('grid',0);
						break;
						case "compensar":
							$relatorios->filtros(6);
							echo "<li>
										<span class='uk-form'>Diferença: <input type=text value=0 id=diferenca class='uk-form-small' style='text-align: right; margin-top: -3px;' readonly></span>
								</li>";
							echo "<li>
										<div class='uk-button-group'>
											<button class='uk-button uk-button-mini uk-button-success' onclick=compensacao_selecionar_todos(false);><i class='uk-icon-square-o'></i></button>
											<button class='uk-button uk-button-mini uk-button-success' onclick=compensacao_selecionar_todos(true);><i class='uk-icon-check-square-o'></i></button>
										</div>
								</li>";
							echo "<li>
										<button class='uk-button uk-button-mini uk-button-danger' onclick=compensacao_compensar();><i class='uk-icon-magnet'></i> Compensar</button>
								</li>";
								//compensacao_selecionar_todos(status)
							$this->menu_exportar('grid',0);

						break;
							
						default:
						break;
					}
				break;
			
				default:	
				
				break;
				
				
			}
		
		
					
		 }



	
	
	
	}
	
}

class sql{
	function min_max($tabela,$campo){
		include "config.php";
		$select="
			SELECT 
				min(`".$campo."`) as min, 
				max(`".$campo."`) as max 
			FROM 
				".$schema.".".$tabela.";		
		";

		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$valores = mysql_fetch_array($resultado);
		 return $valores;
	}
	public function update($table,$campos,$where,$msg){
		
		include "config.php";
		if(isset($_SESSION['cod_usuario'])){$uid=$_SESSION['cod_usuario'];$username=$_SESSION['user'];}else{$uid=0;$username='';}
		$consulta="UPDATE `".$schema."`.`".$table."` SET ".$campos.", cod_empresa='".$_SESSION['cod_empresa']."', data_ultima_alteracao=Now(),usuario_ultima_alteracao=".$_SESSION['cod_usuario']." WHERE ".$where.";";
		$update=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
		if($msg=='S'){
		echo "
			<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert='' style=''>
				<a href='' class='uk-alert-close uk-close'></a>
				<p>O registro foi salvo com sucesso!</p>
			</div>";
		}

		//echo $consulta;
	}
	public function insert($table,$campos,$values,$msg){
		include "config.php";
		if(isset($_SESSION['cod_usuario'])){$uid=$_SESSION['cod_usuario'];$username=$_SESSION['user'];}else{$uid=0;$username='';}
		$consulta="INSERT INTO `".$schema."`.".$table." (".$campos.",`cod_empresa`,`usuario_inclusao`)  VALUES (".$values.",'".$_SESSION['cod_empresa']."','".$_SESSION['cod_usuario']."');"; 
		$insert=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	
		if($msg=='S'){
		echo "
			<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert='' style=''>
				<a href='' class='uk-alert-close uk-close'></a>
				<p>O registro foi salvo com sucesso!</p>
			</div>";
		}
	}
	public function delete($table,$where,$msg){
		include "config.php";
		$consulta="DELETE FROM ".$schema.".".$table." WHERE ".$where.";";
		$delete=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	
		if($msg=='S'){
		echo "
			<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert='' style='margin: -15px 35px 30px;'>
				<a href='' class='uk-alert-close uk-close'></a>
				<p>O registro foi excluido com sucesso!</p>
			</div>";
		}

	}
	public function salvar($tabela,$key_id){
				
		function formatar_data($data){
			if($data!=null){
				$date = str_replace('/', '-', $data);
				return date('Y-m-d', strtotime($data));
			}
		}

		$keys=array_keys($_POST);

		for($i=0;$i<count($keys);$i++){
			if(strpos($keys[$i],'data')===false){}else{$_POST[$keys[$i]]=DateTime::createFromFormat('d/m/Y', $_POST[$keys[$i]])->format('Y-m-d');}
		}

		//update
		$json="{";
			$keys=array_keys($_POST);
			for($c=0;$c<count($keys);$c++){
				$json.='"'.$keys[$c].'":"'.$_POST[$keys[$c]].'",';
			}
		$json.="}";
		
		$json=str_replace(',}',"}",$json);
		$json=str_replace('{"',"`",$json);
		$json=str_replace('":"',"`='",$json);
		$json=str_replace('","',"',`",$json);
		$json=str_replace('"}',"'",$json);
		$sql=new sql;
		$campos=$json;
		$where="`".$key_id."`='".$_POST[$key_id]."'";
			
		//insert

		$campos_insert="";
		$values="";
		for($i=0;$i<count($keys);$i++){
			if($_POST[$keys[$i]]!=""){
				$campos_insert.="`".$keys[$i]."`";
				$values.="'".$_POST[$keys[$i]]."',";
			}
		}

		$values="(".$values.")";
		$campos_insert=str_replace('``',"`,`",$campos_insert);		
		$values=str_replace(",)",")",$values);		
		$values=str_replace(")","",$values);		
		$values=str_replace("(","",$values);		

		
		if($_POST[$key_id]!="" and $_POST[$key_id]!=null){
			$sql->update($tabela,$campos,$where,'S');
		}else{
			$sql->insert($tabela,$campos_insert,$values,'S');
		}
	}
	public function estorno_documento($cod_documento){
		include "config.php";
			$pesquisa=new pesquisa;
			$documento=$pesquisa->documento($_GET['id']);
		
		//estornar
		$sql=new sql;
		$key = md5(mt_rand(1,10000).strtotime(date('Y-m-d H:i:s')));
						$select_cad_documento="
								INSERT INTO 
									`".$schema."`.`cad_documento`
										(
										`cod_empresa`,
										`cod_tipo_documento`,
										`referencia`,
										`texto_cabecalho_documento`,
										`data_lancamento`,
										`data_base`,
										`data_estorno`,
										`data_alteracao`,
										`exercicio`,
										`periodo`,
										`historico`,
										`data_inclusao`,
										`data_ultima_alteracao`,
										`usuario_inclusao`,
										`usuario_ultima_alteracao`)


								select 

									`cod_empresa`,
									'2',
									'".$key."',
									concat('ESTORNO - ',`texto_cabecalho_documento`),
									`data_lancamento`,
									`data_base`,
									DATE_FORMAT(now(),'%Y-%m-%d'),
									DATE_FORMAT(now(),'%Y-%m-%d'),
									`exercicio`,
									`periodo`,
									`historico`,
									now(),
									DATE_FORMAT(now(),'%Y-%m-%d'),
									`usuario_inclusao`,
									`usuario_ultima_alteracao`

								 from 
									".$schema.".cad_documento 
									
								where 
									cod_empresa='".$_SESSION['cod_empresa']."' and 
									cod_documento='".$cod_documento."'	";
						$resultado=mysql_query($select_cad_documento,$conexao) or die (mysql_error());
									
					//2//pesquisar cod_documento
						$select="SELECT cod_documento FROM ".$schema.".cad_documento WHERE referencia='".$key."' and cod_empresa=".$_SESSION['cod_empresa']."; ";
						$resultado=mysql_query($select,$conexao) or die (mysql_error());
						$cod_documento_ = mysql_fetch_array($resultado);
						$cod_documento_=$cod_documento_[0];

					//3//update referencia
						$tabela="cad_documento";
						$campos="referencia='ESTORNO - ".$documento['referencia']."'";
						$where="referencia='".$key."'";
						$sql->update($tabela,$campos,$where,'N');
						
						$tabela="cad_documento";
						$campos="data_estorno=DATE_FORMAT(now(),'%Y-%m-%d')";
						$where="cod_documento='".$cod_documento."'";
						$sql->update($tabela,$campos,$where,'N');
						
						$tabela="cad_documento_item";
						$campos="cod_documento_compensacao='".$key."'";
						$where="cod_documento='".$cod_documento."'";
						$sql->update($tabela,$campos,$where,'N');

		
						$select_cad_documento_item="
								 INSERT INTO 
									`".$schema."`.`cad_documento_item`
										(
										`cod_empresa`,
										`cod_documento`,
										`numero_item`,
										`codigo_lancamento`,
										`cod_conta`,
										`cod_ctr_custo`,
										`montante`,
										`historico`,
										`data_vencimento_liquidacao`,
										`cod_documento_compensacao`,
										`data_inclusao`,
										`data_ultima_alteracao`,
										`usuario_inclusao`,
										`usuario_ultima_alteracao`)

								SELECT 
									`cad_documento_item`.`cod_empresa`,
									'".$cod_documento_."',
									`cad_documento_item`.`numero_item`,
									if(`cad_documento_item`.`codigo_lancamento`='D','C','D'),
									`cad_documento_item`.`cod_conta`,
									`cad_documento_item`.`cod_ctr_custo`,
									`cad_documento_item`.`montante`,
									`cad_documento_item`.`historico`,
									`cad_documento_item`.`data_vencimento_liquidacao`,
									'".$key."',
									now(),
									now(),
									'".$_SESSION['cod_usuario']."',
									'".$_SESSION['cod_usuario']."'

									
								FROM 
									`".$schema."`.`cad_documento_item`
									
								where 
									cod_empresa='".$_SESSION['cod_empresa']."' and 
									cod_documento='".$cod_documento."'";	
						$resultado=mysql_query($select_cad_documento_item,$conexao) or die (mysql_error());		
		
	}
}

class inputs{
	function input_form_row($valor,$id,$label,$placeholder,$atributo){
	echo "<div class='uk-form-row'>
			<label class='uk-form-label' for='xxx'>".$label."</label>
			<input class='uk-form-small' placeholder='".$placeholder."' type='text' ".$atributo." style='width:100%;' name='".$id."' id='".$id."' value='".$valor."' >
		</div>	
	";

	}


}

class imagens{
	function thumbnail($id_imagem,$src,$titulo){
		echo "
			<div class='uk-width-1-2'>
				<a class='uk-thumbnail uk-overlay-toggle' href='#img_".$id_imagem."' data-uk-modal>
					<div class='uk-overlay'>
						<img src='".$src."' alt=''>
						<div class='uk-overlay-caption'>".$titulo."</div>
					</div>
				</a>
				<div id='img_".$id_imagem."' class='uk-modal'>
					<div class='uk-modal-dialog uk-modal-dialog-lightbox' style=''>
						<p style='margin-right: -20px; margin-left: -20px; margin-top: -20px;'><img src='".$src."' alt='' style=''></p>
						<div class='uk-modal-footer uk-text-right'>
							<button type='button' class='uk-button uk-modal-close '>Cancel</button>
							<button type='button' class='uk-button uk-button-primary' onclick=excluir_fotos('".$id_imagem."');>Excluir</button>
						</div>					
					</div>
				</div>				
			</div>
		";
	}
	function listar($id_item){
		include "config.php";
		$imagens=new imagens;
		//pesquisar imagens
		$sql_select="SELECT * FROM ".$schema.".cad_imagens where cod_item=".$id_item.";";
			$resultado=mysql_query($sql_select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			{
				//gerar thumbnail
				$imagens->thumbnail($row['cod_imagem'],$row['endereco_imagem'],$row['data_inclusao']);
			}
		

	
	}
	function upload($id){

	
		//move arquivo
			$arquivo = $_FILES['my_uploaded_file'];
		//Salvando o Arquivo
			$nome_arquivo = md5(mt_rand(1,10000).$arquivo['name']).'.jpg';
			$caminho_arquivo = "fotos/";
			if (!file_exists($caminho_arquivo))
			{
			mkdir($caminho_arquivo, 0755);  
			}
			$caminho = $caminho_arquivo.$nome_arquivo;
			move_uploaded_file($arquivo['tmp_name'],"../".$caminho);  
			
		$table="cad_imagens";
		$campos="`cod_item`, `endereco_imagem`";
		$values="'".$id."','".$caminho."'";
		$msg="N";
	
		$sql=new sql;
		$sql->insert($table,$campos,$values,$msg);


	
		
	}	
	function excluir($id){
		$sql=new sql;
		$table="cad_imagens";
		$where="cod_imagem='".$id."' ";
		$msg="N";
		$sql->delete($table,$where,$msg);
	}
}

class listas{
	
}

class igniteui{
	function igrid($base,$column,$tabela){
	echo 
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///border: 1px solid #ccc; bottom: 10px ! important; position: absolute; top: 60px; left: 10px; right: 10px; overflow: auto;
" 
		<div id='grid' style='margin-top: -20px;'></div>
		<style>
			tr{
				cursor:pointer;
				
			}
		.uk-form input {
			font-size: 10px !important;	
			
		}			
		.uk-form-icon input {
			 padding: 1px 1px 1px 20px !important;
			 height: 20px !important;
			 font-family: calibri !important;
			
		}			
		</style>
		<script>
				   var tabela= new Grid( {
						idGrid:'grid',
						autoGenerateColumns: false,
						tableId: '".$tabela."',
						dataSource: ".$base.",
						dataSourceType: 'json',
						columns:[".$column."],
						width: '100%',
						height: '300px',
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
					
				
			//$('#grid').igGrid({
			//	cellClick: function(evt, ui) { window.location.assign('?act=cadastros&mod=".$tabela."&id='+$('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));}
			//});
			
		</script>
";
		//$(function(){$('#".$tabela."').colResizable();});
		//Initialize
	//$('#grid').igGrid({
	//	cellClick: function(evt, ui) { window.location.assign('?act=cadastros&mod=".$tabela."&id='+$('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));}
	//});	

	///alert($('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	function TreeGrid($base,$column,$tabela,$combo,$plano_conta){
	echo "<div id='grid' style='margin-top: -20px;'></div>
		<script>
					var tabela= new TreeGrid({
						idGrid:'grid',
						width:'100%',
						height:'100%',
						ID:'ID',
						PID:'PID',	
						tableId:'".$tabela."',
						dataSource: ".$base.",
						columns: [".$column."]				
					});

		</script>";
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
	function igrid_editavel_add($base,$column,$column_editavel){
	

	echo 

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
" 
<script>
			function decimal_(valor) {
				valor = valor.replace( '-', '' );
				valor = valor.replace( ',', '' );
				valor = valor.replace( '.', '' );
				valor = valor.replace( '/', '' );
				valor = valor.replace( '/', '' );
				valor = valor.replace( '/', '' );
				valor = valor.replace( '/', '' );
				valor = valor.replace( '/', '' );
				valor = valor.replace( '/', '' );
				valor = valor.replace( '(', '' );
				valor = valor.replace( ')', '' );
				valor = valor.replace( ' ', '' );
				valor=valor/100;

				return valor;
			}
            $( '#igrid_editavel_add' ).igGrid( {
                autoGenerateColumns: false,
                dataSource: ".$base.",
                dataSourceType: 'json',
				columns:[".$column."],
                width: '100%',
                height: '100%',
				avgRowHeight : 20,
                primaryKey: 'numero_item',				
                virtualizationMode: 'fixed',
                tabIndex: 1,
                features: [
                    {
                        name: 'Selection',
                        mode: 'row'
                    },
                    {
                        name: 'Filtering',
                        type: 'local'
                    },		
					{
						name: 'Resizing'
					},					
                    {
                        name: 'Updating',
						excelNavigationMode: true,
						rowEditDialogFieldWidth: 150 ,
						addRowTooltip: 'Novo item',
						editMode: 'row',
			            enableAddRow: true,
                        enableDeleteRow: true,
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

class html{
	function json_table($json){
				$json=str_replace("[","",$json);
				$json=str_replace("]","",$json);
				$json=explode('},{',$json);
				for($i=0;$i<count($json);$i++){
					$json[$i]=str_replace("{","",$json[$i]);
					$json[$i]=str_replace("}","",$json[$i]);
					$json[$i]=str_replace("'",'"',$json[$i]);
					$array[$i]="{".$json[$i]."}";
					if($i==0){
						$keys=$array[$i];
					}
					$array[$i]=json_decode($array[$i],true);
				}
				$keys=json_decode($keys,true);
				$keys=array_keys($keys);


				$table= "<table class='uk-table uk-table-hover'>";
					for($c=0;$c<count($keys);$c++){
						$table.= "<th>";
						$table.= $keys[$c];
						$table.= "</th>";
					}
				for($l=0;$l<count($array);$l++){
					$table.= "<tr id='".$array[$l][$keys[0]]."'>";
					for($c=0;$c<count($keys);$c++){
						$table.= "<td>";
						$table.= $array[$l][$keys[$c]];
						$table.= "</td>";
					}
					$table.= "</tr>";				
				}
				$table.= "</table>";
				return $table;
	}
	function tabela($json,$colunas){
	//column
	//id:
	//headerText: 'ID',
	//key: 'id', 
	//width: '50px',
	$html=new html;
	echo $html->json_table($json);
	
	$header="";
	$body="";
	
	
	
	}
	function mensage($type,$text){
		switch ($type) {
			case "success":
				echo "<div class='uk-alert uk-alert-success' data-uk-alert=''>
						<a href='' class='uk-alert-close uk-close'></a>
						<p>".$text."</p>
					</div>";
				break;
			case "warning":
				echo "<div class='uk-alert uk-alert-warning' data-uk-alert=''>
						<a href='' class='uk-alert-close uk-close'></a>
						<p>".$text."</p>
					</div>";
				break;
			case "danger":
				echo "<div class='uk-alert uk-alert-danger' data-uk-alert=''>
						<a href='' class='uk-alert-close uk-close'></a>
						<p>".$text."</p>
					</div>";
				break;
			default:
				echo "<div class='uk-alert uk-alert-success' data-uk-alert=''>
						<a href='' class='uk-alert-close uk-close'></a>
						<p>".$text."</p>
					</div>";
		}
		
	}
	function listar_anexos($id){
	include "config.php";
						
					$select= "
					
							SELECT 
								`cad_anexo_projeto`.`cod_anexo_projeto`,
								`cad_anexo_projeto`.`cod_projeto`,
								`cad_anexo_projeto`.`cod_empresa`,
								`cad_anexo_projeto`.`nome_arquivo`,
								`cad_anexo_projeto`.`caminho_arquivo`,
								`cad_anexo_projeto`.`tamanho_arquivo`,
								`cad_anexo_projeto`.`extensao`,
								DATE_FORMAT(`cad_anexo_projeto`.`data_inclusao`,'%d/%m/%Y') as data_inclusao,
								`cad_anexo_projeto`.`usuario_inclusao`,
								`cad_anexo_projeto`.`data_ultima_alteracao`,
								`cad_anexo_projeto`.`usuario_ultima_alteracao`
							FROM 
								".$schema.".`cad_anexo_projeto`

							where 
								cad_anexo_projeto.cod_empresa=".$_SESSION['cod_empresa']." and								
								cad_anexo_projeto.cod_projeto='".$id."'							

								";
								
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					$tabela= "<table class='uk-table uk-table-hover uk-table-condensed' style='font-size: 11px;width: 100%;'>

							";
					$n=1;
					while($row = mysql_fetch_array($resultado))
					{
					$tabela.= "
							<tr style='width: 100%;'>
								<td style='width:30px;'><a href='php/delete_file.php?cod_anexo=". $row['cod_anexo_projeto']."&id=".$row['cod_projeto']."' class='uk-button uk-button-small uk-button-danger' style='padding: 4px 0px 0px; width: 25px; height: 20px;'><i class='uk-icon-trash' ></i></a></td>
								<td style='width:30px;'><a href='". $row['caminho_arquivo']."' download='". $row['nome_arquivo']."'  class='uk-button uk-button-small uk-button-success' style='padding: 4px 0px 0px; width: 25px; height: 20px;'><i class='uk-icon-download'></i></a></td>
								<td style=''><div style='width: 100px !important;' class='uk-text-truncate'>". $row['nome_arquivo']."</div></td>
								<td style='width: 10%; text-align: right;'>". $row['tamanho_arquivo']." kb</td>
								<td style='width: 5%;'>". $row['extensao']."</td>
								<td style='width: 10%;'>". $row['data_inclusao']."</td>
							</tr>";
							$n=$n+1;
					}	
					$tabela.= "</table>";
	
	
	
	
	
	
	echo "
			<div id='div_anexos' name='div_anexos' class='uk-width-1-1' >
						<form id='form_anexos' name='form_anexos' action='php/upload_file.php' method='POST' enctype='multipart/form-data'>
							<span class='uk-button uk-button-small uk-button-primary uk-navbar-flip' style='margin-right: 20px;' onclick='getFile();'><i class='uk-icon-cloud-upload'></i> Fazer o upload de arquivos</span>
							<input type='file'  name='file' id='file' style='visibility:hidden;' onchange=script:document.getElementById('form_anexos').submit(); ><br>
							<input type='text' id='cod_projeto' name='cod_projeto' value='".$id."' style=' width: 1px;  visibility: hidden;'>
							
						</form>
						<div id='anexos' name='anexos' class='anexos'>".$tabela."</div>
			</div>	
	
	";
	
	
	}
	function cad_centro_custo($cod_projeto){
		
		include "config.php";		
		$select= "
				SELECT 
					cad_centro_custo.cod_centro_custo as ID,
					if(cod_centro_custo_mae=0,-1,cod_centro_custo_mae) as PID,
					cod_centro_custo_mae,
					concat('#',numero_centro_custo) as numero_centro_custo,
					concat('#',numero_centro_custo,' - ',cad_centro_custo.descricao) as centro_custo,						
					cad_centro_custo.descricao,
					if(`status`='ativa',if(xx.`check`='true','checked',''),'disabled') as check_
					
				FROM 
					".$schema_contabil.".cad_centro_custo 
					
				LEFT JOIN (SELECT cod_projeto, cod_centro_custo,`check` FROM projetos.cad_projeto_centro_custo where cod_projeto='".$cod_projeto."') as xx on xx.cod_centro_custo=cad_centro_custo.cod_centro_custo
					
				WHERE
					cod_empresa='".$_SESSION['cod_empresa']."' 
				ORDER BY
					numero_centro_custo;";
			
		$pesquisa=new pesquisa;
		$json=$pesquisa->json($select);
		
	
			$column ="{headerText: 'Centro de Custo', key: 'centro_custo', width: '200px', dataType: 'string'},";
			//$column.="{headerText: 'Status', key: 'status',width: '50px',  dataType: 'string'},";
			$column.="{headerText: 'Check', key: 'check_',width: '30px',  dataType: 'checkbox'}";

			$tabela="cad_centro_custo";
			$combo="";
			
			
			$igniteui=new igniteui;
			echo $igniteui->TreeGrid($json,$column,$tabela,$combo,'');

	
	
	
	
	
	
	}
	
	
}

class cadastros{
	function pesquisa($select,$tabela,$id){
		include "config.php";
		
			$sql=new sql;
			$menus=new menus;
			$pesquisa=new pesquisa;
			$inputs=new inputs;
			$selects=new selects;
			
			
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			$row = mysql_fetch_array($resultado);
			for($i=0;$i<mysql_num_fields($resultado);$i++){
				$campo=mysql_field_name($resultado,$i);
				$$campo=$row[$campo];
			}
			include "includes/".$tabela.".php";


	}
	function modelo($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_fornecedor where cod_fornecedor='".$id."' and cod_empresa='".$_SESSION['cod_empresa']."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_fornecedor','cod_fornecedor');
	}
	function cad_projeto($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_projeto where cod_projeto='".$id."' and cod_empresa='".$_SESSION['cod_empresa']."' ;";
		$select="
						
				SELECT 
					`cad_projeto`.`cod_projeto`,
					`cad_projeto`.`numero_projeto`,
					`cad_projeto`.`nome_projeto`,
					`cad_projeto`.`decricao`,
					
					DATE_FORMAT(`cad_projeto`.`data_inicio`,'%d/%m/%Y') as data_inicio,
					DATE_FORMAT(`cad_projeto`.`data_fim`,'%d/%m/%Y') as data_fim,

					`cad_projeto`.`cod_status_projeto`,
					`cad_projeto`.`cod_empresa`,
					`cad_projeto`.`data_inclusao`,
					`cad_projeto`.`data_ultima_alteracao`,
					`cad_projeto`.`usuario_inclusao`,
					`cad_projeto`.`usuario_ultima_alteracao`
				FROM ".$schema.".`cad_projeto`
				
				WHERE
					cod_projeto='".$id."' and cod_empresa='".$_SESSION['cod_empresa']."' 	
				
				;
		
		
		
		
		";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_projeto','cod_projeto');
	}

	
	
}

class editar{
	function modelo($id){
		include "config.php";
		
		//var_dump($_POST);
		//var_dump($_GET);
		
		
		$select="
				SELECT 
					cad_conta.* ,
					tb_conta_mae.numero_conta as numero_conta_mae,
					tb_conta_mae.descricao as descricao_conta_mae
				FROM 
					".$schema.".cad_conta,
					(select cod_conta,numero_conta,descricao from ".$schema.".cad_conta  ) as tb_conta_mae
					
				where 
					cad_conta.cod_conta='".$id."' and 
					cad_conta.cod_conta_mae=tb_conta_mae.cod_conta and
					cad_conta.cod_empresa='".$_SESSION['cod_empresa']."' 
					
					
					;";

		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_conta','cod_conta');
		

	}

	
}
class pesquisa{
	function json($consulta_sql){
				include "config.php";
				$resultado=mysql_query($consulta_sql,$conexao) or die (mysql_error());
				$json="";
				
				while($row = mysql_fetch_array($resultado)){
					for($i=0;$i<mysql_num_fields($resultado);$i++){
						$campo=mysql_field_name($resultado,$i);
						$array[$campo]=$row[$campo];
					}
							$json_="{";
								$keys=array_keys($array);
								for($c=0;$c<count($keys);$c++){
									if(is_numeric($array[$keys[$c]])==true){
										$json_.='"'.$keys[$c].'":'.$array[$keys[$c]].',';
										
									}else{
										$json_.='"'.$keys[$c].'":"'.$array[$keys[$c]].'",';
										
									}


									
								}
							$json_.="}";
					$json.=$json_;
				}
				$json=str_replace("}{","},{",$json);	
				$json=str_replace('"',"'",$json);	
				$json=str_replace(',}',"}",$json);	
				$json=str_replace('#',"",$json);	
				$json="[".$json."]";				
				return $json;
	}
	function modelo($id){
		include "config.php";
		
		$menus=new menus;
		
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_grupo_patrimonio.cod_grupo_patrimonio like '%".$id."%' or cad_grupo_patrimonio.descricao like '%".$id."%' ";
		}
				$select= "
					SELECT
						cod_grupo_patrimonio as id,
						descricao,
						vida_util,
						taxa_depreciacao_anual
					FROM 
						".$schema.".cad_grupo_patrimonio 
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Vida útil', key: 'vida_util', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Depreciação', key: 'taxa_depreciacao_anual', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '250px', dataType: 'string'}";			

					$tabela="cad_grupo_patrimonio";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_projeto($id){
		include "config.php";
		
		$menus=new menus;
		
		
		$filtro="";

		$select="
				SELECT 
					cad_projeto.cod_projeto as id, 
					cad_projeto.numero_projeto, 
					cad_projeto.nome_projeto, 
					cad_status_projeto.descricao as status 
				FROM 
					".$schema.".cad_projeto, 
					".$schema.".cad_status_projeto 
				WHERE 
					cad_projeto.cod_status_projeto=cad_status_projeto.cod_status_projeto 
					and cad_projeto.cod_empresa=".$_SESSION['cod_empresa'].";";	

			
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Número Projeto', key: 'numero_projeto', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Nome Projeto', key: 'nome_projeto', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Status projeto', key: 'status', width: '250px', dataType: 'string'}";			

					$tabela="cad_projeto";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}



	
}


class importar{
	function ofx(){

			echo "
					<script>";
							$selects=new selects;
							$selects-> ctrcusto_autocomplete('');

			echo		"</script>
						<script>";
							$selects=new selects;
							$selects-> conta_autocomplete('');

			echo  "</script>";

		echo 
		"<div class='uk-grid' id='msg'>
			<div class='uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-4' >
				<div class='uk-panel uk-panel-box uk-panel-box-primary'>	
					<form class='uk-form uk-form-horizontal'>
						<div class='uk-form-row'>
							<p class='uk-article-meta'><i class='uk-icon-location-arrow'></i>  Suporta apenas formato de arquivo Open Finacial Exchange (OFX).</p>
						</div>
						<div class='uk-form-row'>
							<div class='uk-button-group' style='width:100%'>
								<input id='input_selecionar_ofx' disabled placeholder='.ofx' class='uk-form-small' style='height: 23px ! important;width: 60%;' type='text'>
								<button id='bt_selecionar_ofx' class='uk-button uk-button-mini uk-button-primary' style='height: 23px ! important; width: 40%; font-size: 10px; text-transform: lowercase ! important;' type='button'>selecione um arquivo</button>
							</div>
						</div>						
						<div class='uk-form-row'>
							<div class=' uk-autocomplete uk-form' data-uk-autocomplete='{source:bs_conta}' style='width:100%' id='cod_conta_banco'>
								<input  coluna='conta_ofx' id='cod_conta' placeholder='Conta Contábil' class='uk-form-small' type='text' style='width:100%' value=''>
							</div>
							<script>
								document.getElementById('cod_conta').addEventListener('click', verificar_ajax_ofx_input);
								document.getElementById('cod_conta').addEventListener('change', verificar_ajax_ofx_input);
								document.getElementById('cod_conta').addEventListener('onblur', verificar_ajax_ofx_input);
								document.getElementById('cod_conta').addEventListener('keyup', verificar_ajax_ofx_input);
								document.getElementById('cod_conta').addEventListener('keydown', verificar_ajax_ofx_input);							
							</script>
						</div>
						<div class='uk-form-row'>
							<div class=' uk-autocomplete uk-form' data-uk-autocomplete='{source:bs_conta}' style='width:100%'>
								<hr class='uk-article-divider'>
								<button class='uk-button uk-button-mini uk-button-danger' type='button' onclick='importar_transacoes_ofx();' style='width: 100%;'><i class='uk-icon-mail-forward'></i>  Importar transações</button>
							</div>
						</div>
					</form>
					<div>
						<input type='file' id='file-input' accept='.ofx' style='visibility: hidden;'/>
						<script>document.getElementById('file-input').addEventListener('change', readSingleFile, false);</script>
					</div>
				</div>
			</div>
			<div class='uk-width-small-1-1 uk-width-medium-2-3 uk-width-large-3-4'>
				<div class='uk-panel uk-panel-box uk-panel-box-primary' style='background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 0px;'>
					<div class='uk-width-1-1'  id='div_preview_' style='visibility: hidden; height: 0px; width: 0px;'></div>					
					<div class='uk-width-1-1 uk-form'  id='div_preview' style='overflow: auto; min-height: 300px; height: auto;'></div>					
				</div>			
			</div>

		</div>"	;
		
		
		
	}
	
}


class relatorios{
	function filtros($tipo){
		$inputs=new inputs;
		$selects=new selects;
		if($tipo==1){
					echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
					echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
						echo "<div class='uk-offcanvas-bar'>";
								
								echo "<div class=' uk-width-1-1' style='padding-right: 40px;'>
											<style>
												label{
													font-size: 11px !important;
												}
											</style>
											<h3>Filtro</h3>
											<form class='uk-form' action='#' method='post' style='text-align: left; color:#fff;'>
												<div class='uk-grid '>
												<div class=' uk-width-1-1'>
													<ul class='uk-subnav' style='margin-left: -40px;'>
														";
															
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'>
																<div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_lancamento_de','Data de lançamento','',"value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
															echo"</div>									
																<div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_lancamento_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
															echo"</div>
														</li>";
																		
																		
																		
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_base_de','Data base',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div>									<div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_base_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div></li>";
																		
																		
																		
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_estorno_de','Data de estorno',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div>									<div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_estorno_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div></li>";
																		
																		
																		
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_alteracao_de','Data de alteração',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div>									<div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_alteracao_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div></li>";
																		
																		
																		
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_inclusao_de','Data de inclusão',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div>									<div class='uk-width-1-2'>";
													$inputs->input_form_row('','data_inclusao_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
													echo"</div></li>";

														
														
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
													$inputs->input_form_row('','cod_documento','Cód. de documento',"","");
													echo"</div>
														<div class='uk-width-1-2'>";
													$inputs->input_form_row('','referencia','Referência',"","");
													echo"</div></li>";
													


													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'>
														<div class='uk-width-1-1'>";
													$inputs->input_form_row('','texto_cabecalho_documento','texto de cabeçalho',"","");
													echo"</div>
														</li>";
													
													
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'>
														<div class='uk-width-1-1'>";
													$inputs->input_form_row('','historico','Histórico',"","");
													echo"</div>
														</li>";
													
													
													echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
													$inputs->input_form_row('','exercicio','Exercicio (ano)',"","");
													echo"</div>
														<div class='uk-width-1-2'>";
													$inputs->input_form_row('','periodo','Período (mês)',"","");
													echo"</div></li>";
													
													
													
													
												echo "</ul>
												</div>
													<div class='uk-width-1-1'>
														<li style='text-align: right; padding-right: 0px; margin-right: -30px;'>		
															<br/>
															<button class='uk-button uk-button-mini uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>
														</li>
													</div>
											</div>

										</form>

									</div>

									
									";
							
						echo "</div>";
					echo "</div>";

		}
		if($tipo==2){
			echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
			echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
				echo "<div class='uk-offcanvas-bar'>";
					echo "<div class=' uk-width-1-1' style='padding-right: 10px; padding-left: 10px;'>
								<style>
									label{
										font-size: 11px !important;
									}
								</style>
								<h3>Filtro</h3>
								<form class='uk-form' action='#' method='post' style='text-align: left; color:#fff;'>
									<ul class='uk-list'>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-2'>
												";
													$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
								echo "
												</div>
												<div class='uk-width-1-2'>
									";
													$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
								echo	 	"
												</div>
										</div>
										</li>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-2'>
												";
													$inputs->input_form_row('','conta_inicio','Conta contábil',''," ");
								echo "
												</div>
												<div class='uk-width-1-2'>
									";
													$inputs->input_form_row('','conta_fim','até',''," ");
								echo	 	"
												</div>
										</div>
										</li>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-2'>
												";
													$inputs->input_form_row('','ctr_custo_inicio','Centro de custo',''," ");
								echo "
												</div>
												<div class='uk-width-1-2'>
									";
													$inputs->input_form_row('','ctr_custo_fim','até',''," ");
								echo	 	"
												</div>
										</div>
										</li>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-1'>
													</br>
													<p>Agrupar por:</p>
												</div>	
												<div class='uk-width-1-2'>
													<input type='radio' name='relatorio' value='conta' checked /> Conta Contábil
												</div>
												<div class='uk-width-1-2'>
													<input type='radio' name='relatorio' value='centro_custo' /> Centro de Custo
												</div>
										</div>
										</li>
										<li>
							";
							echo		 "
										</li>

										<li>
										<div class='uk-width-1-1' style='text-align: right ! important;'>
			
												<br/>
												<button class='uk-button uk-button-mini uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>

										</div>
										</li>
									</ul>
								
								</form>

							
						</div>";
				echo "</div>";
			echo "</div>";
		
		}
		if($tipo==3){
			echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
			echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
				echo "<div class='uk-offcanvas-bar'>";
				echo "<div class=' uk-width-1-1' style='padding-right: 10px; padding-left: 10px;'>
							<style>
								label{
									font-size: 11px !important;
								}
							</style>
							<h3>Filtro</h3>
							<form class='uk-form' action='#' method='post' style='text-align: left; color:#fff;'>
								<ul class='uk-list'>
									<li>
										<div class='uk-grid'>
											<div class='uk-width-1-2'>
											";
												$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
							echo "
											</div>
											<div class='uk-width-1-2'>
								";
												$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
							echo	 	"
											</div>
									</div>
									</li>
									<li>
										<div class='uk-grid'>
											<div class='uk-width-1-2'>
											";
												$inputs->input_form_row('','conta_inicio','Conta contábil',''," ");
							echo "
											</div>
											<div class='uk-width-1-2'>
								";
												$inputs->input_form_row('','conta_fim','até',''," ");
							echo	 	"
											</div>
									</div>
									</li>
									<li>
										<div class='uk-grid'>
											<div class='uk-width-1-2'>
											";
												$inputs->input_form_row('','ctr_custo_inicio','Centro de custo',''," ");
							echo "
											</div>
											<div class='uk-width-1-2'>
								";
												$inputs->input_form_row('','ctr_custo_fim','até',''," ");
							echo	 	"
											</div>
									</div>
									</li>
									<li>
									<div class='uk-width-1-1' style='text-align: right ! important;'>
		
											<br/>
											<button class='uk-button uk-button-mini uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>

									</div>
									</li>
								</ul>
							
							</form>

						
					</div>";
				echo "</div>";
			echo "</div>";
		
		}
		if($tipo==4){
			echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
			echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
				echo "<div class='uk-offcanvas-bar'>";
					echo "<div class=' uk-width-1-1' style='padding-right: 10px; padding-left: 10px;'>
								<style>
									label{
										font-size: 11px !important;
									}
								</style>
								<h3>Filtro</h3>
								<form class='uk-form' action='#' method='post' style='text-align: left; color:#fff;'>
									<ul class='uk-list'>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-2'>
												";
													$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
								echo "
												</div>
												<div class='uk-width-1-2'>
									";
													$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
								echo	 	"
												</div>
										</div>
										</li>
										<li>
										<div class='uk-width-1-1' style='text-align: right ! important;'>
											<br/>
												<button class='uk-button uk-button-mini uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>
										</div>
										</li>
									</ul>
								</form>
						</div>";
				echo "</div>";
			echo "</div>";
		
		}
		if($tipo==5){
					echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
					echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
						echo "<div class='uk-offcanvas-bar'>";

							echo "<div class=' uk-width-1-1' style='padding-right: 40px;'>
										<style>
											label{
												font-size: 11px !important;
											}
										</style>
										<h3>Filtro</h3>
										<form class='uk-form' action='#' method='post' style='text-align: left; color:#fff;'>
											<div class='uk-grid '>
											<div class=' uk-width-1-1'>
												<ul class='uk-subnav' style='margin-left: -40px;'>
													";
														
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'>
															<div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_lancamento_de','Data de lançamento','',"value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
														echo"</div>									
															<div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_lancamento_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
														echo"</div>
													</li>";
																	
																	
																	
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_base_de','Data base',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div>									<div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_base_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div></li>";
																	
																	
																	
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_estorno_de','Data de estorno',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div>									<div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_estorno_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div></li>";
																	
																	
																	
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_alteracao_de','Data de alteração',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div>									<div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_alteracao_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div></li>";
																	
																	
																	
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_inclusao_de','Data de inclusão',"","value='01/01/1900' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div>									<div class='uk-width-1-2'>";
												$inputs->input_form_row('','data_inclusao_ate','até',"","value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
												echo"</div></li>";

												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
												$inputs->input_form_row('','numero_conta','Numero Conta',"","");
												echo"</div>									<div class='uk-width-1-2'>";
												$inputs->input_form_row('','numero_ctr_custo','Numero Ctr. Custo',"","");
												echo"</div></li>";
											
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
												$inputs->input_form_row('','cod_documento','Cód. de documento',"","");
												echo"</div>
													<div class='uk-width-1-2'>";
												$inputs->input_form_row('','referencia','Referência',"","");
												echo"</div></li>";
												


												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'>
													<div class='uk-width-1-1'>";
												$inputs->input_form_row('','texto_cabecalho_documento','texto de cabeçalho',"","");
												echo"</div>
													</li>";
												
												
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'>
													<div class='uk-width-1-1'>";
												$inputs->input_form_row('','historico','Histórico',"","");
												echo"</div>
													</li>";
												
												
												echo "<li class='uk-grid' style='margin-top: 10px; margin-left: 30px; max-width: 280px; width: 100%;'><div class='uk-width-1-2'>";
												$inputs->input_form_row('','exercicio','Exercicio (ano)',"","");
												echo"</div>
													<div class='uk-width-1-2'>";
												$inputs->input_form_row('','periodo','Período (mês)',"","");
												echo"</div></li>";
												
												
												
												
											echo "</ul>
											</div>
												<div class='uk-width-1-1'>
													<li style='text-align: right; padding-right: 0px; margin-right: -30px;'>		
														<br/>
														<button class='uk-button uk-button-mini uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>
													</li>
												</div>
										</div>

									</form>

								</div>

								
								";

							
						echo "</div>";
					echo "</div>";
		}
		if($tipo==6){
			echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
			echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
				echo "<div class='uk-offcanvas-bar'>";
					echo "<div class=' uk-width-1-1' style='padding-right: 10px; padding-left: 10px;'>
								<style>
									label{
										font-size: 11px !important;
									}
								</style>
								<h3>Filtro</h3>
								<form class='uk-form' action='#' method='post' style='text-align: left; color:#fff;'>
									<ul class='uk-list'>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-2'>
												";
													$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
								echo "
												</div>
												<div class='uk-width-1-2'>
									";
													$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
								echo	 	"
												</div>
										</div>
										</li>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-1'>
												";
													$inputs->input_form_row('','conta_inicio','Conta contábil',''," ");
								echo "
												</div>
										</div>
										</li>
										<li>
											<div class='uk-grid'>
												<div class='uk-width-1-2'>
												";
													$inputs->input_form_row('','ctr_custo_inicio','Centro de custo',''," ");
								echo "
												</div>
												<div class='uk-width-1-2'>
									";
													$inputs->input_form_row('','ctr_custo_fim','até',''," ");
								echo	 	"
												</div>
										</div>
										</li>

										<li>
										<div class='uk-width-1-1' style='text-align: right ! important;'>
			
												<br/>
												<button class='uk-button uk-button-mini uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>

										</div>
										</li>
									</ul>
								
								</form>

							
						</div>";
				echo "</div>";
			echo "</div>";
		
		}

	
	}

}

class conciliacao{
	function conciliar(){

		
	}
	function compensar(){
		echo "<div id='msg'></div>";
		if($_POST['conta_inicio']!=""){
			$pesquisa=new pesquisa;
			$pesquisa->razao_conciliacao();
		}

		
	}
	
	
}




class table{
		public $thead;
		public $tbody;
		public $tfoot;
		public $select;
		public $group_by;
		public $caption;
		public $json;

		
		
		function tabela(){
			//variáveis da função
				$saldo=0;
				$table="";
			
			//executar select mysql
				include "config.php";
				$resultado=mysql_query($this->select,$conexao) or die (mysql_error());
				
			
			//montar caption
				$caption="
					<caption style='font-size: 12px ! important;  color: rgb(0, 0, 0) ! important;'>
						<div class='uk-grid'>
							<div class='uk-width-1-1'>".$this->caption['razao_social']."</div>
							<div class='uk-width-1-1'>".$this->caption['cnpj']."</div>
							<div class='uk-width-1-1'>
								<div class='uk-grid'>
									<div class='uk-width-3-5'>".$this->caption['titulo']."</div>
									<div class='uk-width-1-5'>Livro:xxx</div>
									<div class='uk-width-1-5'>Folha:xxx</div>
								</div>
							</div>
						</div>

					</caption>					
				";
			
			//montar thead
				$table.="<thead><tr>";
				for($n=1;$n<=count($this->thead);$n++){
					$l=$this->thead[$n];
					$table.="<th style='".$l['style']."'>".$l['label']."</th>";
				}
				$table.="</tr></thead>";	

				
			//montar tbody
				$conta="";
				$saldo=0;
				$table.="<tbody>";
				while($row = mysql_fetch_array($resultado))
				{
					//linhas de agrupamento
						if($row[$this->group_by]!=$conta){
							$conta=$row[$this->group_by];					
							if(isset($row['saldo_inicial_'.$this->group_by])){
								if($row['saldo_inicial_'.$this->group_by]>=0){$DC='D';}else{$DC='C';}
								$table.="<tr ><td colspan='".(count($this->tbody)-2)."'><b>".$conta."</b></td><td style='text-align: right !important;'><b>".number_format(abs((float)$row['saldo_inicial_'.$this->group_by]), 2, ',', '.')."</b></td><td>".$DC."</td></tr>";
							}else{
								$table.="<tr ><td colspan='".count($this->tbody)."'><b>".$conta."</b></td></tr>";
							}
							if(isset($row['saldo_inicial_'.$this->group_by])){
								$saldo=$row['saldo_inicial_'.$this->group_by]+$row['debito']-$row['credito'];
							}
							
						}else{
							$saldo=$saldo+$row['debito']-$row['credito'];
						}
					
					//linhas normais
						$table.="<tr>";
						for($n=1;$n<=count($this->tbody);$n++){
							$l=$this->tbody[$n];
							if($l['formato']=='decimal'){$row[$l['campo']]=number_format((float)$row[$l['campo']], 2, ',', '.');}
							if($l['formato']=='data'){$row[$l['campo']]=data($row[$l['campo']]);}
							if($l['campo']=='saldo'){$table.="<td style='".$l['style']."'>".number_format(abs((float)$saldo), 2, ',', '.')."</td>";}
							else{$table.="<td style='".$l['style']."'>".$row[$l['campo']]."</td>";}
							
						}
						$table.="</tr>";

					
				}
				$table.="<tbody>";

				
			//montar tfoot
				$table.="<tfoot><tr>";
				for($n=1;$n<=count($this->thead);$n++){
					$table.="<td>..</td>";
				}
				$table.="</tr></tfoot>";				
			
			
			//finalizar tabela
				$table="<div id='relatorio' style='width: 21.0cm;height:29.7cm; padding: 1.5cm 0.5cm;'>
							<table class='' style='font-size: 12px ! important;  color: rgb(0, 0, 0) ! important;'>
								".$caption.$table."								
							</table>
						</div>";
				
				return $table;
		}
		function criar(){
			return $this->tabela();
			//return $this->select;
		}
		function TreeGrid(){
			$pesquisa=new pesquisa;
			$this->json=$pesquisa->json($this->select);
			$igniteui=new igniteui;
			$igniteui->TreeGrid($this->json,$this->column,$this->tabela,'','');
		}
	
	
}

class imprimir{
	function ficha_ativa($id){
		include "config.php";

	
		$select="
				SELECT 
					cad_itens.*,
					cad_filial.descricao as filial,
					cad_localizacao.descricao as localizacao,
					cad_fornecedor. nome_razao_social,
					cad_grupo_patrimonio.descricao as grupo,
					cad_grupo_patrimonio.vida_util as vida_util_grupo,
					cad_grupo_patrimonio.taxa_depreciacao_anual as taxa_depreciacao_anual_grupo,
					cad_tipo_aquisicao.descricao as tipo_aquisicao,
					cad_tipo_documento.descricao as tipo_documento,
					cad_tipo_patrimonio.descricao as tipo_patrimonio,
					cad_status_patrimonio.descricao as status_patrimonio

					
				 FROM 
					".$schema.".cad_itens

				left join (".$schema.".cad_filial) on cad_itens.cod_filial=cad_filial.cod_filial
				left join (".$schema.".cad_localizacao) on cad_itens.cod_localizacao=cad_localizacao.cod_localizacao
				left join (".$schema.".cad_fornecedor) on cad_itens.cod_fornecedor=cad_fornecedor.cod_fornecedor
				left join (".$schema.".cad_grupo_patrimonio) on cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio
				left join (".$schema.".cad_tipo_aquisicao) on cad_itens.cod_tipo_aquisicao=cad_tipo_aquisicao.cod_tipo_aquisicao
				left join (".$schema.".cad_tipo_documento) on cad_itens.cod_tipo_documento=cad_tipo_aquisicao.cod_tipo_aquisicao
				left join (".$schema.".cad_tipo_patrimonio) on cad_itens.cod_tipo_patrimonio=cad_tipo_patrimonio.cod_tipo_patrimonio
				left join (".$schema.".cad_status_patrimonio) on cad_itens.cod_status_patrimonio=cad_status_patrimonio.cod_status_patrimonio

				where cad_itens.cod_item='".$id."' ;";
				
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			$row = mysql_fetch_array($resultado);
			for($i=0;$i<mysql_num_fields($resultado);$i++){
				$campo=mysql_field_name($resultado,$i);
				$$campo=$row[$campo];
			}		
			$data_aquisicao= DateTime::createFromFormat('Y-m-d', $data_aquisicao)->format('d/m/Y');
			$data_inclusao= DateTime::createFromFormat('Y-m-d H:i:s', $data_inclusao)->format('d/m/Y');
			$data_inicio_depreciacao= DateTime::createFromFormat('Y-m-d', $data_inicio_depreciacao)->format('d/m/Y');
			$data_baixa= DateTime::createFromFormat('Y-m-d', $data_baixa)->format('d/m/Y');


///////////////////////////////////////////////////////////////////////////////////	
	echo "<style>
		.uk-grid{
			margin-top: 2px !important;
		}
		label{
			 font-weight: bold;
		}
		p{
			margin-top: 2px !important;
		}
		.uk-grid:not(.uk-grid-preserve) > * {
			padding: 3px !important;
		}	
		[class*='uk-width'] {
			padding: 5px !important;
			margin: 0px !important;
		}
		.uk-panel {

			height: 40px !important;
		}
		.uk-panel-box {
			padding: 10px !important;
		}
	
	</style>";

	echo	"<div class='' style='width: 850px;margin-left:80px;'>	
				<div class='uk-grid'>
					<div class='uk-width-1-4'>
						<img src='imagens/logo.png' >					
					</div>
					<div class='uk-width-3-4' style='text-align: right;'>
					<p>".$inicio."</p>
					<p>".$cnpj." - ".$razao_social."</p>
					</div>
				</div>						


				<hr class='uk-article-divider'>	
				<h3 class='tm-article-subtitle'>Ficha de ativa</h3>			

						<div class='uk-grid'>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>codigo do item</label>
									<p>".$cod_item."</p>
								</div>
							</div>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Status</label>
									<p>".$cod_status_patrimonio." - ".$status_patrimonio."</p>
								
								</div>						
							</div>								
						</div>


						<div class='uk-grid'>	
					
							<div class='uk-width-1-1'>
								<div class=' uk-panel uk-panel-box '>							
									<label>Descrição do Item</label>
									<p>".$descricao."</p>
								</div>
							</div>
						</div>


						<div class='uk-grid'>	
							<div class='uk-width-1-3'>
								<div class=' uk-panel uk-panel-box '>							
									<label>Número de plaqueta</label>
									<p>".$codigo_patrimonio."</p>
								</div>
							</div>
							<div class='uk-width-2-3'>
								<div class=' uk-panel uk-panel-box '>
									<label>Código de barras</label>
									<p>".$codigo_barras."</p>
								</div>
							</div>
						</div>


						<div class='uk-grid'>							
							<div class='uk-width-3-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Grupo de patrimônio</label>
									<p>".$cod_grupo_patrimonio." - ".$grupo."</p>
								</div>		
							</div>	
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Vida útil do grupo</label>
									<p>".$vida_util_grupo."</p>
								</div>		
							</div>	
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Depr. a.a. do grupo</label>
									<p>".$taxa_depreciacao_anual_grupo."</p>
								</div>		
							</div>	
						</div>	
						<div class='uk-grid'>
							<div class='uk-width-1-1'>
								<div class=' uk-panel uk-panel-box '>							
									<label>Item pai</label>
									<p>".$cod_item_pai."</p>
								</div>
							</div>
						</div>	
						<div class='uk-grid'>
							<div class='uk-width-1-3'>
								<div class=' uk-panel uk-panel-box '>							
									<label>Filial</label>
									<p>".$cod_filial." - ".$filial."</p>			
								</div>						
							</div>						
							<div class='uk-width-2-3'>
								<div class=' uk-panel uk-panel-box '>							
									<label>Localização</label>
									<p>".$cod_localizacao." - ".$localizacao."</p>			
								</div>						
							</div>						
						</div>

				<hr class='uk-article-divider'>				

						<div class='uk-grid'>
							<div class='uk-width-1-1'>
								<div class=' uk-panel uk-panel-box '>
									<label>Fornecedor</label>
									<p>".$cod_fornecedor." - ".$nome_razao_social."</p>
								</div>	
							</div>	
						</div>	
						<div class='uk-grid'>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Tipo de patrimônio</label>
									<p>".$cod_tipo_patrimonio." - ".$tipo_patrimonio."</p>
								</div>						
							</div>						
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Aquisição</label>
									<p>".$cod_tipo_aquisicao." - ".$tipo_aquisicao."</p>
								</div>						
							</div>		
						</div>	
						<div class='uk-grid'>							
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Tipo de documento</label>
									<p>".$cod_tipo_documento." - ".$tipo_documento."</p>
								</div>						
							</div>						
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Número documento</label>
									<p>".$numero_documento."</p>
								</div>
							</div>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Número de Série</label>
									<p>".$serie."</p>
								</div>						
							</div>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Quantidade</label>
									<p>".$quantidade."</p>
								</div>
							</div>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Unidade</label>
									<p>".$unidade."</p>
								</div>
							</div>								
						</div>	


				<hr class='uk-article-divider'>

						<div class='uk-grid'>
				
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Valor de aquisição</label>
									<p>".$valor_aquisicao."</p>
								</div>
							</div>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Valor atual</label>
									<p>".$valor_atual."</p>
								</div>
							</div>
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Valor residual</label>
									<p>".$valor_residual."</p>
								</div>
							</div>
						
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Vida útil</label>
									<p>".$vida_util."</p>
								</div>
							</div>					
							<div class='uk-width-1-2'>
								<div class=' uk-panel uk-panel-box '>
									<label>Depreciação a.a.</label>
									<p>".$taxa_depreciacao_anual."</p>
								</div>
							</div>
						</div>	
						<div class='uk-grid'>								
							<div class='uk-width-1-4'>
								<div class=' uk-panel uk-panel-box '>
									<label>Aquisição</label>
									<p>".$data_aquisicao."</p>
								</div>
							</div>	
							<div class='uk-width-1-4'>
								<div class=' uk-panel uk-panel-box '>
									<label>Inclusão</label>
									<p>".$data_inclusao."</p>
								</div>
							</div>
							<div class='uk-width-1-4'>
								<div class=' uk-panel uk-panel-box '>
									<label>Inicio depreciação</label>
									<p>".$data_inicio_depreciacao."</p>
								</div>
							</div>						
							<div class='uk-width-1-4'>
								<div class=' uk-panel uk-panel-box '>
									<label>Baixa</label>
									<p>".$data_baixa."</p>
								</div>
							</div>
						</div>						
					</div>
				</div>";
	
	
///////////////////////////////////////////////////////////////////////////////////	
	
	
	}

}

class layout{
	function layout_1(){
}


}


	function data($data){
		if($data!=null){
			if(strpos($data,"-")!==false){
				$dat = explode ("-",$data,3);
				return $dat[2]."/".$dat[1]."/".$dat[0];
			}else{
				$dat = explode ("/",$data,3);
				return $dat[2]."-".$dat[1]."-".$dat[0];
			}
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
	function decimal_($valor){
		return number_format((float)$valor, 2, ',', '.');
	}



?>