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
	function analitico_sintetico($analitico_sintetico,$label){
						$options="";
						if($analitico_sintetico=='analitico' or $analitico_sintetico=='sintetico'){
							$options.= "<option value='".$analitico_sintetico."' selected >".$analitico_sintetico."</option>";
						}
							$options.= "<option value=''></option>";
							$options.= "<option value='analitico'>analitico</option>";
							$options.= "<option value='sintetico'>sintetico</option>";
						echo "<label class='uk-form-label' for='analitico_sintetico'>".$label."</label><select class='uk-form-small' id='analitico_sintetico' name='analitico_sintetico' style='width: 100%;'>".$options."</select>";
	}
	function aquisicao_baixa($aquisicao_baixa,$label){
						$options="";
						if($aquisicao_baixa=='aquisicao' or $aquisicao_baixa=='baixa'){
							$options.= "<option value='".$aquisicao_baixa."' selected >".$aquisicao_baixa."</option>";
						}
							$options.= "<option value=''></option>";
							$options.= "<option value='aquisicao'>Aquisições</option>";
							$options.= "<option value='baixa'>Baixas</option>";
						echo "<label class='uk-form-label' for='aquisicao_baixa'>".$label."</label><select class='uk-form-small' id='aquisicao_baixa' name='aquisicao_baixa' style='width: 100%;'>".$options."</select>";
	}
	function fornecedor($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_fornecedor";
		$campo_id="cod_fornecedor";
		$campo_descricao="nome_razao_social";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function filial($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_filial";
		$campo_id="cod_filial";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function localizacao($id,$label,$cod_filial){
		$sql_select="select * from (SELECT cod_localizacao as cod_localizacao, descricao as descricao FROM imobilizado.cad_localizacao where cod_filial='".$cod_filial."') as x  ";
		$campo_id="cod_localizacao";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function tipo_aquisicao($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_tipo_aquisicao";
		$campo_id="cod_tipo_aquisicao";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function tipo_documento($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_tipo_documento";
		$campo_id="cod_tipo_documento";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function tipo_patrimonio($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_tipo_patrimonio";
		$campo_id="cod_tipo_patrimonio";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function cod_grupo_patrimonio($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_grupo_patrimonio";
		$campo_id="cod_grupo_patrimonio";
		$campo_descricao="descricao";
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function cod_item_pai($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_itens";
		$campo_id="cod_item";
		$campo_descricao="descricao";
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function cad_status_patrimonio($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_status_patrimonio";
		$campo_id="cod_status_patrimonio";
		$campo_descricao="descricao";
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function cad_motivo_baixa($id,$label){
		$sql_select="SELECT * FROM imobilizado.cad_motivo_baixa";
		$campo_id="cod_motivo_baixa";
		$campo_descricao="descricao";
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
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
	function submenu($valores,$id){
		echo "

					<li  data-uk-tooltip={pos:'right'} title='Pesquisar'><a href='?act=pesquisa&mod=".$_GET['mod']."&id=' class='uk-button-link '  style=''><i class='uk-icon-binoculars'></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Novo'><a href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button-link ' style=''><i class='uk-icon-file-o'></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Salvar'><a href='#' class=' uk-button-link  '  id='bt_salvar'  style=''><i class='uk-icon-save '></i></a> </li>
					
					<li  data-uk-tooltip={pos:'right'} title='Primeiro'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['min']."' class='uk-button-link '  style=''><i class='uk-icon-fast-backward'></i> </a></li>
					<li  data-uk-tooltip={pos:'right'} title='Anterior'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".max($id-1,$valores['min']) ."' class='uk-button-link '  style=''><i class='uk-icon-backward'></i> </a></li>
					<li  data-uk-tooltip={pos:'right'} title='Próximo'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".min($id+1,$valores['max'])."' class='uk-button-link '  style=''><i class='uk-icon-forward'></i> </a></li>
					<li  data-uk-tooltip={pos:'right'} title='Último'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['max']."' class='uk-button-link '  style=''><i class='uk-icon-fast-forward'></i> </a></li>


					<script>$('#bt_salvar').click(function(){document.getElementById('form_cadastro').submit();});</script>	

		";
	}
	function submenu_cad_itens($valores,$id){
		echo "

					<li  data-uk-tooltip={pos:'right'} title='Pesquisar'><a href='?act=pesquisa&mod=".$_GET['mod']."&id=' class='uk-button-link '  style=''><i class='uk-icon-binoculars'></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Novo'><a href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button-link ' style=''><i class='uk-icon-file-o'></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Salvar'><a href='#' class=' uk-button-link  '  id='bt_salvar'  style=''><i class='uk-icon-save '></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Imprimir ficha de ativo'><a href='?act=imprimir&mod=ficha_ativo&id=".$_GET['id']."' target='_blank'><i class='uk-icon-print'></i></a> </li>
					
					<li data-uk-tooltip={pos:'right'} title='Primeiro'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['min']."' class='uk-button-link '  style=''><i class='uk-icon-fast-backward'></i> </a></li>
					<li data-uk-tooltip={pos:'right'} title='Anterior'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".max($id-1,$valores['min']) ."' class='uk-button-link '  style=''><i class='uk-icon-backward'></i> </a></li>
					<li data-uk-tooltip={pos:'right'} title='Próximo'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".min($id+1,$valores['max'])."' class='uk-button-link '  style=''><i class='uk-icon-forward'></i> </a></li>
					<li data-uk-tooltip={pos:'right'} title='Último'><a href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['max']."' class='uk-button-link '  style=''><i class='uk-icon-fast-forward'></i> </a></li>


					<script>$('#bt_salvar').click(function(){document.getElementById('form_cadastro').submit();});</script>			


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
					<label>Exportar para: </label>
					<a href='#' onclick=exportar('xls','".$id_grid."','json'); ><i class='uk-icon-file-excel-o'></i> .xls </a>
					<a href='#' onclick=exportar('doc','".$id_grid."','json'); ><i class='uk-icon-file-word-o'></i> .doc </a>
				</li>
				<li id='arquivo_gerado'>
				</li>
			
		";
	}
	function menu_gerar_depreciacao($filtro){
		$inputs=new inputs;
		$selects=new selects;
		$menus=new menus;
			
		$relatorios=new relatorios;
			
				
		echo "<li>";
		echo "
			<!-- This is the modal -->
			<div id='modal' >
				<form class='uk-form uk-width-1-1' action='#' method='post'>
				<div class='uk-grid'>
							<div class='uk-width-1-5'>";
							$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
				echo	 "</div>
							<div class='uk-width-1-5'>";
							$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
				echo	 "</div>
							<div class='uk-width-1-5'>";
							$inputs->input_form_row('','cod_item','Item','','');
				echo	 "</div>
							<div class='uk-width-1-5'>";
							$selects->cod_grupo_patrimonio('','Grupo');
				echo	 "</div>
							<div class='uk-width-1-5'>
								<button class='uk-button uk-button-danger' type='submit' id='' style='margin-top: 17px;'><i class='uk-icon-cogs'></i> Gerar depreciações</button>
							</div>
				</div>
				</form>
			</div>
		";

		echo"</li>";

		
	}
	function menu_baixa($filtro){
		$inputs=new inputs;
		$selects=new selects;
	
		
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
				
		echo "<li>";
					echo	"
						<a href='#modal' id='confirmar_baixas' data-uk-modal><i class='uk-icon-exclamation'></i> Confirmar baixas</a>
						<!-- This is the modal -->
						<div id='modal' class='uk-modal'>
							<form action='#' method='post'>
								<div class='uk-modal-dialog'>
									<div class='uk-modal-header'>
										<h3>Confirmar baixas</h3>
									</div>
									<div>
								<div class='uk-grid'>
									<div class='uk-width-1-3'>";
									$inputs->input_form_row('00/00/0000','data_baixa','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
						echo	 	"</div>
									<div class='uk-width-1-3'>";
									$selects->cad_motivo_baixa('','Motivo de baixa');
						echo		 "</div>
									<div class='uk-width-1-1' id=''>
										<label class='uk-form-label' for='xxx'>Itens</label>
										 <textarea  style='width: 100%; height: 100px;' id='textarea_cod_item' name='textarea_cod_item' placeholder='Textarea' readonly></textarea> 
									</div>
									</div>
									<hr class='uk-article-divider'>
									<div id='div_modal_msg'></div>
									<div class='uk-modal-footer uk-text-right'>
										<button type='button' class='uk-button uk-modal-close' id='bt_cancelar'>Cancelar</button>
										<button type='submit' class='uk-button uk-button-primary' id='tb_salvar'>Salvar</button>
									</div>
								</div>
							</form>
						</div>
					";
		
		echo"</li>
			<li></li>
			<li id='arquivo_gerado'></li>

		";
	}
	function menu_reavaliar($filtro){
		$inputs=new inputs;
		$selects=new selects;
		$menus=new menus;
					$menus->menu_exportar('grid_relatorio',$filtro);					
				
		echo "
				<li>
					<a href='#modal' id='confirmar_reavaliacao' data-uk-modal><i class='uk-icon-exclamation'></i> Salvar</a>
				</li>
				<li id='arquivo_gerado'>
				</li>
		";
	}
	function menu(){
		$menus=new menus;
		$sql=new sql;
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id'])  and $_GET['act']=="cadastros"){
			//elementos de pesquisa
				//var_dump($_GET);
			$tabela=$_GET['mod'];



			//include esqueleto cadastro
			if($tabela=='cad_itens'){
				$id="cod_item";
				$valores=$sql->min_max($tabela, $id);
				$menus->submenu_cad_itens($valores,$id);
			}else{
				$id=str_replace("cad_","cod_",$_GET['mod']);
				$valores=$sql->min_max($tabela, $id);
				$menus->submenu($valores,$id);
			}							
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="pesquisa"){
				echo "<li  data-uk-tooltip={pos:'right'} title='Novo'><a href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button-link ' style=''><i class='uk-icon-file-o'></i> Incluir novo cadastro</a> </li>";
				$menus->menu_exportar('grid',0);
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="lancamento" and $_GET['mod']=="gerar_depreciacao"){
			$menus->menu_gerar_depreciacao(4);
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="lancamento" and $_GET['mod']=="baixar"){
			$menus->menu_baixa(4);
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="lancamento" and $_GET['mod']=="reavaliar"){
			$menus->menu_reavaliar(4);
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="relatorios" and $_GET['mod']=="mapa_ativo"){
			$filtro=1;
			$menus=new menus;
			$relatorios=new relatorios;
			$relatorios->filtros($filtro);
			$menus->menu_exportar('grid_relatorio','');
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="relatorios" and $_GET['mod']=="aquisicoes_baixas"){
			$filtro=2;
			$menus=new menus;
			$relatorios=new relatorios;
			$relatorios->filtros($filtro);
			$menus->menu_exportar('grid_relatorio','');
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="relatorios" and $_GET['mod']=="depreciacao"){
			$filtro=3;
			$menus=new menus;
			$relatorios=new relatorios;
			$relatorios->filtros($filtro);
			$menus->menu_exportar('grid_relatorio','');
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
				imobilizado.".$tabela.";		
		";

		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$valores = mysql_fetch_array($resultado);
		 return $valores;
	}
	public function update($table,$campos,$where,$msg){
		
		include "config.php";
		if(isset($_SESSION)){$uid=$_SESSION['cod_usuario'];$username=$_SESSION['user'];}else{$uid=0;$username='';}
		$consulta="UPDATE `imobilizado`.`".$table."` SET ".$campos." WHERE ".$where.";";
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
		if(isset($_SESSION)){$uid=$_SESSION['cod_usuario'];$username=$_SESSION['user'];}else{$uid=0;$username='';}
		$consulta="INSERT INTO `imobilizado`.".$table." (".$campos.")  VALUES (".$values.");"; 
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
		$consulta="DELETE FROM `imobilizado`.".$table." WHERE ".$where.";";
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
			if($tabela=="cad_itens"){
				$tabela="cad_movimento";
				$campos_insert="cod_item, data, valor, cod_tipo_movimento";
				$values="(SELECT max(cod_item) from imobilizado.cad_itens), '".$_POST['data_aquisicao']."','".$_POST['valor_aquisicao']."','1'";
				$sql->insert($tabela,$campos_insert,$values,'N');
			}
		}
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
		$sql_select="SELECT * FROM imobilizado.cad_imagens where cod_item=".$id_item.";";
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
	function cad_grupo_patrimonio($id){
		$select="SELECT * FROM imobilizado.cad_grupo_patrimonio  where cod_grupo_patrimonio='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_grupo_patrimonio','cod_grupo_patrimonio');
	
	}
	function cad_itens($id){
		$select="
				SELECT 
					cod_item,
					codigo_patrimonio,
					cod_tipo_patrimonio, 
					cod_status_patrimonio, 
					descricao,
					quantidade,
					unidade,
					cod_filial,
					cod_localizacao,
					cod_item_pai,
					codigo_barras, 
					serie, 
					numero_documento, 
					cod_tipo_documento, 
					cod_tipo_aquisicao,
					cod_fornecedor,
					cod_grupo_patrimonio,
					valor_aquisicao, 
					valor_residual, 
					valor_atual, 
					vida_util, 
					taxa_depreciacao_anual, 
					cod_motivo_baixa,
					
					DATE_FORMAT(data_aquisicao,'%d/%m/%Y') as data_aquisicao,
					DATE_FORMAT(data_inicio_depreciacao,'%d/%m/%Y') as data_inicio_depreciacao,
					DATE_FORMAT(data_baixa,'%d/%m/%Y') as data_baixa,
					DATE_FORMAT(data_inclusao,'%d/%m/%Y') as data_inclusao

				FROM 
					imobilizado.cad_itens 
				where 
					cod_item='".$id."' 
					
					
					;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_itens','cod_item');

	}
	function cad_fornecedor($id){
		$select="SELECT * FROM imobilizado.cad_fornecedor where cod_fornecedor='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_fornecedor','cod_fornecedor');
	}
	function cad_filial($id){
		$select="SELECT * FROM imobilizado.cad_filial where cod_filial='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_filial','cod_filial');
	}
	function cad_localizacao($id){
		$select="SELECT * FROM imobilizado.cad_localizacao where cod_localizacao='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_localizacao','cod_localizacao');
	}
	function cad_status_patrimonio($id){
		$select="SELECT * FROM imobilizado.cad_status_patrimonio where cod_status_patrimonio='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_status_patrimonio','cod_status_patrimonio');
	}
	function cad_tipo_patrimonio($id){
		$select="SELECT * FROM imobilizado.cad_tipo_patrimonio where cod_tipo_patrimonio='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_tipo_patrimonio','cod_tipo_patrimonio');
	}
	function cad_tipo_aquisicao($id){
		$select="SELECT * FROM imobilizado.cad_tipo_aquisicao where cod_tipo_aquisicao='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_tipo_aquisicao','cod_tipo_aquisicao');
	}
	function cad_tipo_documento($id){
		$select="SELECT * FROM imobilizado.cad_tipo_documento where cod_tipo_documento='".$id."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_tipo_documento','cod_tipo_documento');
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
									$json_.='"'.$keys[$c].'":"'.$array[$keys[$c]].'",';
								}
							$json_.="}";
					$json.=$json_;
				}
				$json=str_replace("}{","},{",$json);	
				$json=str_replace('"',"'",$json);	
				$json="[".$json."]";				
				return $json;
	}
	function cad_grupo_patrimonio($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
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
						imobilizado.cad_grupo_patrimonio 
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
	function cad_itens($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_itens.cod_item like '%".$id."%' or cad_itens.descricao like '%".$id."%' ";
		}
				$select= "
						SELECT
							cad_itens.cod_item as id,
							cad_itens.codigo_patrimonio as codigo_patrimonio,
							date_format(cad_itens.data_aquisicao,'%d/%m/%Y') as data_aquisicao,
							cad_itens.quantidade as quantidade,
							cad_grupo_patrimonio.descricao as grupo,
							cad_filial.descricao as filial,
							cad_itens.descricao as descricao,
							cad_itens.valor_aquisicao as valor_aquisicao,
							cad_status_patrimonio.descricao as status_patrimonio
							
						FROM 
							imobilizado.cad_itens,
							imobilizado.cad_grupo_patrimonio,
							imobilizado.cad_filial,
							imobilizado.cad_status_patrimonio

						WHERE
							cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio and
							cad_itens.cod_filial=cad_filial.cod_filial and
							cad_itens.cod_status_patrimonio=cad_status_patrimonio.cod_status_patrimonio
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Plaqueta', key: 'codigo_patrimonio', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Status', key: 'status_patrimonio', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Filial', key: 'filial', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'grupo', key: 'grupo', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Descrição do Item', key: 'descricao',  dataType: 'string'},";
					$column.="{headerText: 'Grupo', key: 'grupo', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Data Aquis.', key: 'data_aquisicao', width: '80px', dataType: 'string'},";
					$column.="{headerText: 'valor Aquis.', key: 'valor_aquisicao', width: '80px', dataType: 'string'},";
	
					
					$tabela="cad_itens";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_fornecedor($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";		
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_fornecedor.cod_fornecedor like '%".$id."%' or cad_fornecedor.nome_razao_social like '%".$id."%' ";
		}
		

				$select= "
					SELECT
						cad_fornecedor.cod_fornecedor as id,
						cad_fornecedor.nome_razao_social ,
						cad_fornecedor.cpf_cnpj ,
						cad_fornecedor.email_1 ,
						cad_fornecedor.telefone_1 ,
						cad_fornecedor.cidade ,
						cad_fornecedor.uf 
					FROM 
						imobilizado.cad_fornecedor 
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Nome ou razão social', key: 'nome_razao_social', dataType: 'string'},";	
					$column.="{headerText: 'CPF CNPJ', key: 'cpf_cnpj', width: '150px', dataType: 'string'},";						
					$column.="{headerText: 'E-mail', key: 'email_1',width: '150px', dataType: 'string'},";			
					$column.="{headerText: 'Telefone', key: 'telefone_1',width: '100px', dataType: 'string'},";			
					$column.="{headerText: 'Cidade', key: 'cidade',width: '100px', dataType: 'string'},";			
					$column.="{headerText: 'UF', key: 'uf',width: '30px', dataType: 'string'}";			
					
					$tabela="cad_fornecedor";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_filial($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_filial.cod_filial like '%".$id."%' or cad_filial.descricao like '%".$id."%' ";
		}
		

				$select= "
					SELECT
						cod_filial as id,
						descricao
					FROM 
						imobilizado.cad_filial 
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '250px', dataType: 'string'}";			
					
					$tabela="cad_filial";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_localizacao($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" and cad_localizacao.cod_localizacao like '%".$id."%' or cad_localizacao.descricao like '%".$id."%' ";
		}
		

				$select= "
					SELECT
						cad_localizacao.cod_localizacao as id,
						cad_localizacao.descricao as localizacao,
						cad_filial.descricao as filial						
					FROM 
						imobilizado.cad_localizacao,
						imobilizado.cad_filial
					 WHERE 
						cad_localizacao.cod_filial=cad_filial.cod_filial
						
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Filial', key: 'filial', width: '250px', dataType: 'string'},";			
					$column.="{headerText: 'Localização', key: 'localizacao', width: '250px', dataType: 'string'}";			
					
					$tabela="cad_localizacao";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_status_patrimonio($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_status_patrimonio.cod_status_patrimonio like '%".$id."%' or cad_status_patrimonio.descricao like '%".$id."%' ";
		}
		

				$select= "
					SELECT
						cod_status_patrimonio as id,
						descricao
					FROM 
						imobilizado.cad_status_patrimonio 
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '250px', dataType: 'string'}";			
					
					$tabela="cad_status_patrimonio";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_tipo_patrimonio($id){
		include "config.php";
		
		$menus=new menus;

		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_tipo_patrimonio.cod_tipo_patrimonio like '%".$id."%' or cad_tipo_patrimonio.descricao like '%".$id."%' ";
		}
		

				$select= "
					SELECT
						cod_tipo_patrimonio as id,
						descricao
					FROM 
						imobilizado.cad_tipo_patrimonio 
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '250px', dataType: 'string'}";			
					
					$tabela="cad_tipo_patrimonio";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_tipo_aquisicao($id){
		include "config.php";
		
		$menus=new menus;
	
		echo "<div id='grid'></div>";		
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_tipo_aquisicao.cod_tipo_aquisicao like '%".$id."%' or cad_tipo_aquisicao.descricao like '%".$id."%' ";
		}
		

				$select= "
					SELECT
						cod_tipo_aquisicao as id,
						descricao
					FROM 
						imobilizado.cad_tipo_aquisicao 
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '250px', dataType: 'string'}";			
					
					$tabela="cad_tipo_aquisicao";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_tipo_documento($id){
		include "config.php";
		
		$menus=new menus;
	
		echo "<div id='grid'></div>";		
		
		$filtro="";
		if($id!=""){
			$filtro=" WHERE  cad_tipo_documento.cod_tipo_documento like '%".$id."%' or cad_tipo_documento.descricao like '%".$id."%' ";
		}
		

				$select= "
					SELECT
						cod_tipo_documento as id,
						descricao
					FROM 
						imobilizado.cad_tipo_documento 
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '250px', dataType: 'string'}";			
					
					$tabela="cad_tipo_documento";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid($json,$column,$tabela);
      

	}
	function cad_movimento($id){
		include "config.php";
		

		
		
		$filtro="";
		if($id!=""){
			$filtro=" and  cad_movimento.cod_item='".$id."' ";
		}
				$select= "
							SELECT
								date_format(data,'%d/%m/%Y') as data,
								cad_movimento.cod_movimento,
								cad_movimento.valor,
								cad_tipo_movimento.descricao as tipo_movimento
							FROM 
								imobilizado.cad_movimento,
								imobilizado.cad_tipo_movimento
							where 
								cad_movimento.cod_tipo_movimento=cad_tipo_movimento.cod_tipo_movimento

					".$filtro." ;";

					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'cod_movimento', width: '5%', dataType: 'string'},";
					$column.="{headerText: 'Data', key: 'data', width: '15%', dataType: 'string'},";			
					$column.="{headerText: 'Valor', key: 'valor', width: '15%', dataType: 'number'},";			
					$column.="{headerText: 'Movimento', key: 'tipo_movimento', width: '55%', dataType: 'string'}";			
	
					
					$tabela="cad_movimento";
					
				$igniteui=new igniteui;
				echo $igniteui->igrid_movimento($json,$column,$tabela);
      

	}
	function depreciacao_gerada($cod_item,$cod_grupo_patrimonio,$data_inicio,$data_fim){
		include "config.php";
		$filtro="";
		if($cod_grupo_patrimonio!=""){
			$filtro.=" and cad_itens.cod_grupo_patrimonio='".$cod_grupo_patrimonio."' ";
		}
		if($cod_item!=""){
			$filtro.=" and cad_itens.cod_item='".$cod_item."' ";
		}
				$select= "
							SELECT
								cad_itens.cod_item,
								cad_itens.descricao as descricao_item,
								cad_itens.data_aquisicao,
								cad_itens.valor_aquisicao,
								cad_itens.valor_residual,
								cad_itens.vida_util,
								cad_movimento.data as data_depreciacao,
								cad_movimento.valor as valor_depreciacao,
								cad_tipo_movimento.descricao as tipo_movimento,
								cad_grupo_patrimonio.descricao as grupo
							FROM 
								imobilizado.cad_movimento,
								imobilizado.cad_tipo_movimento,
								imobilizado.cad_itens,
								imobilizado.cad_grupo_patrimonio
							where 
								cad_movimento.cod_tipo_movimento=cad_tipo_movimento.cod_tipo_movimento and
								(cad_movimento.data between '".$data_inicio."' and '".$data_fim."') and
								cad_itens.cod_item=cad_movimento.cod_item and
								cad_movimento.cod_tipo_movimento=6 and
								cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio
					".$filtro." ;";

					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					$column= "{headerText: 'ID', key: 'cod_item', width: '5%', dataType: 'string'},";
					$column.="{headerText: 'Movimento', key: 'tipo_movimento', width: '20%', dataType: 'string'},";						
					$column.="{headerText: 'Grupo', key: 'grupo', width: '20%', dataType: 'string'},";						
					$column.="{headerText: 'Descrição', key: 'descricao_item', width: '10%', dataType: 'string'},";			
					$column.="{headerText: 'Dt. Aquis.', key: 'data_aquisicao', width: '10%', dataType: 'string'},";
					$column.="{headerText: 'Dt. Depr.', key: 'data_depreciacao', width: '5%', dataType: 'string'},";					
					$column.="{headerText: 'Vl. Aquis.', key: 'valor_aquisicao', width: '5%', dataType: 'string'},";			
					$column.="{headerText: 'Vl. Resid.', key: 'valor_residual', width: '5%', dataType: 'string'},";			
					$column.="{headerText: 'V.U.', key: 'vida_util', width: '5%', dataType: 'string'},";			
					$column.="{headerText: 'Vl. Depr.', key: 'valor_depreciacao', width: '5%', dataType: 'number'}";			
		

				
				$igniteui=new igniteui;
				echo $igniteui->igrid_movimento($json,$column,'');
      

	}

	
	
}

class lancamento{
	function resultado_table_header($data_inicio,$data_fim,$processo,$registros,$consulta,$msg_erro){
					echo "<div class='uk-width-1-1' style='margin-bottom: 30px;'>
							<div class='uk-overflow-container ' style='padding: 20px; '>
								<table class='uk-table'>
									<caption>Resultado</caption>
									<thead>
										<tr>
											<th>".$data_inicio."</th>
											<th>".$data_fim."</th>
											<th>".$processo."</th>
											<th>".$registros."</th>
											<th>".$consulta."</th>
											<th>".$msg_erro."</th>
										</tr>
									</thead>
									<tbody>";
	}
	function resultado_table_footer(){
							
					echo	"			</tbody>
								</table>
							</div>
					
					
					";		
	}
	function resultado_tr($data_inicio,$data_fim,$processo,$registros,$consulta,$msg_erro){
			echo "
								<tr>
									<td>".$data_inicio."</td>
									<td>".$data_fim."</td>
									<td>".$processo."</td>
									<td>". $registros."</td>
									<td>
										<div  data-uk-dropdown={mode:'click',justify:'table'}>
											<button class='uk-button'> SQL <i class='uk-icon-caret-down'></i></button>
											<div style='margin-left: -59px;' class='uk-dropdown uk-dropdown-center'>
												". $consulta."
											</div>
										</div>
									</td>
									<td><span class='uk-badge uk-badge-notification uk-badge-danger'>".$msg_erro."</span></td>
								</tr>			
			";	
	}
	function sql($select){
		include "config.php";
		$consulta=mysql_query($select,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	
}

//Depreciação	
	function calculo_depreciacao($cod_item,$cod_grupo_patrimonio,$data_inicio,$data_fim){
		$filtro="";
		if($cod_grupo_patrimonio!=""){
			$filtro.="and cad_itens.cod_grupo_patrimonio='".$cod_grupo_patrimonio."' ";
		}
		if($cod_item!=""){
			$filtro.="and cad_itens.cod_item='".$cod_item."' ";
		}
		include "config.php";
		
		$select_="
				insert into imobilizado.cad_movimento (cod_item,data, valor ,cod_tipo_movimento) 
				select tb_calculo.cod_item,tb_calculo.data_depreciacao,-tb_calculo.valor_depreciacao,6 from (
				select 
					tb_movimento_.*,
					TIMESTAMPDIFF(MONTH,tb_movimento_.data_ultimo_movimento,tb_movimento_.data_morte) as meses_vida_util,
					(tb_movimento_.valor_residual/TIMESTAMPDIFF(MONTH,tb_movimento_.data_ultimo_movimento,tb_movimento_.data_morte)) as valor_depreciacao,
					LAST_DAY(DATE_ADD(tb_movimento_.data_ultimo_movimento, INTERVAL 1 month)) as data_depreciacao
				from
				(
					SELECT 
						cad_itens.cod_item,
						cad_itens.valor_aquisicao,
						cad_itens.cod_grupo_patrimonio,
						tb_movimento.valor_residual,
						cad_itens.data_inicio_depreciacao,
						DATE_ADD(cad_itens.data_inicio_depreciacao,INTERVAL IF(cad_itens.vida_util!=0,cad_itens.vida_util*365,cad_grupo_patrimonio.vida_util*365)  DAY) as data_morte,
						tb_movimento.data_ultimo_movimento,
						cad_itens.vida_util as vida_util_item,
						cad_grupo_patrimonio.vida_util as vida_util_grupo
						
					 FROM 
						imobilizado.cad_itens,
						imobilizado.cad_grupo_patrimonio,
						(
							SELECT
								cod_item,
								max(data) as data_ultimo_movimento,
								sum(valor) as valor_residual
							FROM 
								imobilizado.cad_movimento
							GROUP BY
								cod_item
						) as tb_movimento 

					where
						cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio and
						tb_movimento.cod_item=cad_itens.cod_item ".$filtro."

				) as tb_movimento_	

				) as tb_calculo
				where (tb_calculo.data_depreciacao between '".$data_inicio."' and '".$data_fim."') 
		";
		$select="
				insert into imobilizado.cad_movimento (cod_item,data, valor ,cod_tipo_movimento) 
				select tb_calculo.cod_item,tb_calculo.data_depreciacao,-tb_calculo.valor_depreciacao,6 from (
				select 
					tb_movimento_.*,
					TIMESTAMPDIFF(MONTH,tb_movimento_.data_ultimo_movimento,tb_movimento_.data_morte) as meses_vida_util,
					(tb_movimento_.valor_aquisicao/IF(vida_util_item=0,vida_util_grupo,vida_util_item)/12) as valor_depreciacao,
					LAST_DAY(DATE_ADD(tb_movimento_.data_ultimo_movimento, INTERVAL 1 month)) as data_depreciacao
				from
				(
					SELECT 
						cad_itens.cod_item,
						cad_itens.valor_aquisicao,
						cad_itens.cod_grupo_patrimonio,
						tb_movimento.valor_residual,
						cad_itens.data_inicio_depreciacao,
						DATE_ADD(cad_itens.data_inicio_depreciacao,INTERVAL IF(cad_itens.vida_util!=0,cad_itens.vida_util*365,cad_grupo_patrimonio.vida_util*365)  DAY) as data_morte,
						tb_movimento.data_ultimo_movimento,
						cad_itens.vida_util as vida_util_item,
						cad_grupo_patrimonio.vida_util as vida_util_grupo
						
					 FROM 
						imobilizado.cad_itens,
						imobilizado.cad_grupo_patrimonio,
						(
							SELECT
								cod_item,
								max(data) as data_ultimo_movimento,
								sum(valor) as valor_residual
							FROM 
								imobilizado.cad_movimento
							GROUP BY
								cod_item
						) as tb_movimento 

					where
						cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio and
						cad_itens.data_aquisicao<='".$data_fim."' and
						cad_itens.data_inicio_depreciacao<='".$data_fim."' and
						tb_movimento.cod_item=cad_itens.cod_item ".$filtro."

				) as tb_movimento_	

				) as tb_calculo
				where (tb_calculo.data_depreciacao between '".$data_inicio."' and '".$data_fim."') 
		";

		$lancamento=new lancamento;
		$lancamento->sql($select);
		
				$processo="Gerar depreciações";
				$registros=mysql_affected_rows();
				$consulta=$select;
				$msg_erro=mysql_error();
				
				$lancamento->resultado_tr($data_inicio,$data_fim,$processo,$registros,$consulta,$msg_erro);
				
	
	}
	function deletar_depreciacao($cod_item,$cod_grupo_patrimonio,$data_inicio,$data_fim){
		//$data_inicio=date("Y-m-d", strtotime($data_inicio) );
		include "config.php";
		$filtro="";
		if($cod_grupo_patrimonio!=""){
			$filtro.=" and cad_itens.cod_grupo_patrimonio=".$cod_grupo_patrimonio." ";
		}
		if($cod_item!=""){
			$filtro.=" and cad_itens.cod_item=".$cod_item." ";
		}
		$select="
				DELETE  
					imobilizado.cad_movimento
				FROM 
					imobilizado.cad_movimento,
					imobilizado.cad_grupo_patrimonio,
					imobilizado.cad_itens
				WHERE

					cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio and
					cad_itens.cod_item=cad_movimento.cod_item and
					cad_movimento.data>='".$data_inicio."' and
					cad_movimento.cod_tipo_movimento=6
					".$filtro."
					;
		";
		$lancamento=new lancamento;
		$lancamento->sql($select);
		
				$processo="Excluir depreciações";
				$registros=mysql_affected_rows();
				$consulta=$select;
				$msg_erro=mysql_error();
				
				$lancamento->resultado_tr($data_inicio,$data_fim,$processo,$registros,$consulta,$msg_erro);	
	}
	function calcular_saldo($data_inicio,$data_fim){
		$select="
				UPDATE 
					`imobilizado`.`cad_itens`,
					(select
						cad_itens.cod_item,
						cad_itens.valor_aquisicao,
						sum(cad_movimento.valor) as saldo
					FROM 
						imobilizado.cad_movimento,
						imobilizado.cad_grupo_patrimonio,
						imobilizado.cad_itens
					WHERE
						cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio and
						cad_itens.cod_item=cad_movimento.cod_item 
					group by
						cad_itens.cod_item) as tb_update
				SET 
					cad_itens.valor_atual=tb_update.saldo
				WHERE 
					cad_itens.cod_item=tb_update.cod_item;	
		";

		$lancamento=new lancamento;
		$lancamento->sql($select);
		
				$processo="Calcular saldos atuais";
				$registros=mysql_affected_rows();
				$consulta=$select;
				$msg_erro=mysql_error();
				
				$lancamento->resultado_tr($data_inicio,$data_fim,$processo,$registros,$consulta,$msg_erro);

		
	}
	function gerar_depreciacao(){
			$inputs=new inputs;
			$selects=new selects;
			$lancamento=new lancamento;
			
		if(isset($_POST) and $_POST!=null and $_POST['data_inicio']!="00/00/0000" and $_POST['data_fim']!="00/00/0000"){
			
			$data_inicio= DateTime::createFromFormat('d/m/Y', $_POST['data_inicio'])->format('Y-m-d');
			$data_fim= DateTime::createFromFormat('d/m/Y', $_POST['data_fim'])->format('Y-m-d');
			$cod_grupo_patrimonio=$_POST['cod_grupo_patrimonio'];
			$cod_item=$_POST['cod_item'];
			
			$data_intervalo_inicio = new DateTime($data_inicio);
			$data_intervalo_fim = new DateTime($data_fim);
			$date1 = new DateTime($data_inicio);
			$date2 = new DateTime($data_fim);
			$date2->modify( '+1 day' );
			$interval = date_diff($date1, $date2);


			//echo $interval->d . "d<br/>";
			//echo $interval->m . "m<br/>";
			//echo $interval->y . "y<br/>";
			//echo $interval->m + ($interval->y * 12) . ' months'."<br/>";
			
			$i=$interval->m + ($interval->y * 12);
			$data_intervalo_inicio->modify( '-1 months' );

			$lancamento->resultado_table_header('Data Inicio','Data Fim','Processo','Registros afetados','Consulta SQL','Mensagem de erro')	;								

				for($n=0;$n< $i; $n++){
					
					$data_intervalo_inicio->modify( '+1 months');
					$data_inicio=$data_intervalo_inicio->format("Y-m-1");
					$data_fim=$data_intervalo_inicio->format("Y-m-t");
					
					$lancamento->deletar_depreciacao($cod_item,$cod_grupo_patrimonio,$data_inicio,$data_fim);			
					$lancamento->calculo_depreciacao($cod_item,$cod_grupo_patrimonio,$data_inicio,$data_fim);
					$lancamento->calcular_saldo($data_inicio,$data_fim);
				
				}
			
			$lancamento->resultado_table_footer();
		
		}else{


		
		}
	
		
	
	}

//Baixas	
	function baixar(){
			$html=new html;
			$lancamento=new lancamento;	
			
			function update($table,$campos,$where){
				$lancamento=new lancamento;
				include "config.php";
				$consulta="UPDATE `imobilizado`.`".$table."` SET ".$campos." WHERE ".$where.";";
				$update=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
				
				$processo="Baixa de ativo imobilizado";
				$registros=mysql_affected_rows();
				$consulta=$consulta;
				$msg_erro=mysql_error();
				
				$lancamento->resultado_tr('','',$processo,$registros,$consulta,$msg_erro);

			}
		


			if(
					isset($_POST) and 
					$_POST!=null and 
					
					isset($_POST['cod_motivo_baixa']) and 
					isset($_POST['textarea_cod_item']) and 
					$_POST['cod_motivo_baixa']!="" and 
					$_POST['textarea_cod_item']!="" and 
					$_POST['data_baixa']!="00/00/0000" 
					
				){
					$data_baixa= DateTime::createFromFormat('d/m/Y', $_POST['data_baixa'])->format('Y-m-d');
					$table="cad_itens";
					$campos="cod_motivo_baixa=".$_POST['cod_motivo_baixa'].", data_baixa='".$data_baixa."', cod_status_patrimonio=2 ";
					$cod_tens=$_POST['textarea_cod_item'];
					$cod_tens=str_replace("}{","},{",$cod_tens);
					$cod_tens=explode(',',$cod_tens);
					
	
					$lancamento->resultado_table_header('Processo','Registros afetados','Consulta SQL','Mensagem de erro')	;	
							for($i=0;$i<count($cod_tens);$i++){
								$cod_tens[$i]=str_replace("}","",$cod_tens[$i]);
								$cod_tens[$i]=str_replace("{","",$cod_tens[$i]);
								$where="cod_item=".$cod_tens[$i];
								update($table,$campos,$where);
							}
					$lancamento->resultado_table_footer();
					
					
					
					
					
					
					
				
			}else{}
		if(
				isset($_POST) and 
				$_POST!=null and 
				
				isset($_POST['data_inicio']) and 
				isset($_POST['data_fim']) and 
				isset($_POST['cod_item']) and 
				isset($_POST['cod_grupo_patrimonio']) and 
				isset($_POST['cod_filial']) 	
				

				
				){
		
		
		
		
		
		
		
			$data_inicio= DateTime::createFromFormat('d/m/Y', $_POST['data_inicio'])->format('Y-m-d');
			$data_fim= DateTime::createFromFormat('d/m/Y', $_POST['data_fim'])->format('Y-m-d');
			$filtro="";
			
			if($_POST['data_inicio']!="00/00/0000"){
				$filtro.="and cad_itens.data_aquisicao >= '".$data_inicio."'  ";
			}
			if($_POST['data_fim']!="00/00/0000"){
				$filtro.="and cad_itens.data_aquisicao <= '".$data_fim."'  ";
			}
			if($_POST['cod_item']!=""){
				$filtro.=" and cad_itens.cod_item='".$_POST['cod_item']."' ";
			}
			if($_POST['cod_grupo_patrimonio']!=""){
				$filtro.=" and cad_itens.cod_grupo_patrimonio='".$_POST['cod_grupo_patrimonio']."' ";
			}
			if($_POST['cod_filial']!=""){
				$filtro.=" and cad_itens.cod_filial='".$_POST['cod_filial']."' ";
			}
			
		//////////////////////////////////	
					$select="
									select
										cad_itens.cod_item as id,
										cad_filial.descricao as filial,										
										cad_grupo_patrimonio.descricao as grupo,
										cad_itens.descricao as Item,
										date_format(cad_itens.data_aquisicao,'%d/%m/%Y') as DtAquis,
										cad_itens.valor_aquisicao as VlAquis,
										cad_itens.valor_atual VlAtual,
										cad_status_patrimonio.descricao as status
										
									from
										imobilizado.cad_itens,
										imobilizado.cad_status_patrimonio,
										imobilizado.cad_grupo_patrimonio,
										imobilizado.cad_filial
									where
										cad_itens.cod_status_patrimonio=cad_status_patrimonio.cod_status_patrimonio	and
										cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio and
										cad_itens.cod_filial=cad_filial.cod_filial 
									".$filtro." ";

					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
		echo "
		<style>
			.tr_selecionada{
				background-color: #D32C46;
				background-image: linear-gradient(to bottom, #EE465A, #C11A39);
				color: #fff;
			}
		</style>
		<script>
        $(function(){
            $('.uk-table tr').click( function(){
				var id_tr=$(this).attr('id');
				var class_name=document.getElementById(id_tr).className;
				if(class_name=='tr_selecionada'){
					document.getElementById(id_tr).className='';
				}else{
					document.getElementById(id_tr).className ='tr_selecionada';
				}
            });
        })
		$(function(){
			$('#confirmar_baixas').click(function(){

			ids=document.getElementsByClassName('tr_selecionada');
			var n=ids.length;
			ids_='';
			for(var i=0;i<n;i++){
				ids_+='{'+ids[i].getElementsByTagName('td')[0].innerHTML+'}';
				document.getElementById('textarea_cod_item').value=ids_;		
			}

		});
		});
		
		</script>	
		";					
					
					echo "<div id='grid' class='uk-width-1-1'>";

				echo $html->tabela($json,'');
					echo "</div>";
			
		//////////////////////////////////	
			
			
			
			
			
			}

			
	}
	function reavaliar(){
			$html=new html;
			$lancamento=new lancamento;	



		if(
				isset($_POST) and 
				$_POST!=null and 
				
				isset($_POST['data_inicio']) and 
				isset($_POST['data_fim']) and 
				isset($_POST['cod_item']) and 
				isset($_POST['cod_grupo_patrimonio']) and 
				isset($_POST['cod_filial']) 	
				
			){
		
		
			$data_inicio= DateTime::createFromFormat('d/m/Y', $_POST['data_inicio'])->format('Y-m-d');
			$data_fim= DateTime::createFromFormat('d/m/Y', $_POST['data_fim'])->format('Y-m-d');
			$filtro="";
			
			if($_POST['data_inicio']!="00/00/0000"){
				$filtro.="and cad_itens.data_aquisicao >= '".$data_inicio."'  ";
			}
			if($_POST['data_fim']!="00/00/0000"){
				$filtro.="and cad_itens.data_aquisicao <= '".$data_fim."'  ";
			}
			if($_POST['cod_item']!=""){
				$filtro.=" and cad_itens.cod_item='".$_POST['cod_item']."' ";
			}
			if($_POST['cod_grupo_patrimonio']!=""){
				$filtro.=" and cad_itens.cod_grupo_patrimonio='".$_POST['cod_grupo_patrimonio']."' ";
			}
			if($_POST['cod_filial']!=""){
				$filtro.=" and cad_itens.cod_filial='".$_POST['cod_filial']."' ";
			}
			
		//////////////////////////////////	
					$select="
									select
										cad_itens.cod_item as id,
										cad_filial.descricao as filial,										
										cad_grupo_patrimonio.descricao as grupo,
										cad_itens.descricao as item,
										date_format(cad_itens.data_aquisicao,'%d/%m/%Y') as data_aquisicao,
										date_format(cad_itens.data_inicio_depreciacao,'%d/%m/%Y') as data_inicio_depreciacao,
										cad_itens.valor_aquisicao as valor_aquisicao,
										cad_itens.valor_atual valor_atual,
										cad_status_patrimonio.descricao as status,
										cad_itens.vida_util,
										cad_itens.taxa_depreciacao_anual
										
									from
										imobilizado.cad_itens,
										imobilizado.cad_status_patrimonio,
										imobilizado.cad_grupo_patrimonio,
										imobilizado.cad_filial
									where
										cad_itens.cod_status_patrimonio=cad_status_patrimonio.cod_status_patrimonio	and
										cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio and
										cad_itens.cod_filial=cad_filial.cod_filial and
										cad_itens.cod_status_patrimonio=1 
									".$filtro." ";

					
					echo "<div id='grid_msg'></div>";
					echo "<div id='grid_relatorio'></div>";
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);
					
					
					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Status', key: 'status',width: '100px', dataType: 'string'},";						
					$column.="{headerText: 'Filial', key: 'filial', width: '100px', dataType: 'string'},";
					$column.="{headerText: 'Grupo', key: 'grupo', width: '100px', dataType: 'string'},";
					$column.="{headerText: 'Descrição do Item', key: 'item', dataType: 'string'},";
					$column.= "{
								headerText: 'Aquisição',
								group: [
										{headerText: 'Data', key: 'data_aquisicao', width: '80px', dataType: 'string'},
										{headerText: 'Valor', key: 'valor_aquisicao', width: '80px', dataType: 'string'}
								]
							},";
					$column.= " {
								headerText: 'Reavaliação',
								group: [
										{headerText: 'Data', key: 'data_inicio_depreciacao', width: '70px', dataType: 'string'},
										{headerText: '% Depr. aa', key: 'taxa_depreciacao_anual', width: '70px', dataType: 'string'},
										{headerText: 'Vida útil', key: 'vida_util', width: '70px', dataType: 'string'},
										{headerText: 'Valor', key: 'valor_atual', width: '70px', dataType: 'string'}
								]
							}";

					$column_editavel="
                        {
                            columnKey: 'id',
                            readOnly: true
                        },
                        {
                            columnKey: 'filial',
                            readOnly: true
                        },
                        {
                            columnKey: 'grupo',
                            readOnly: true
                        },
                        {
                            columnKey: 'item',
                            readOnly: true
                        },
                        {
                            columnKey: 'status',
                            readOnly: true
                        },
                        {
                            columnKey: 'data_aquisicao',
                            readOnly: true
                        },
                        {
                            columnKey: 'valor_aquisicao',
                            readOnly: true
                        },

                        {
                            columnKey: 'data_inicio_depreciacao',
							editorType: 'string'
                        },
						{
							columnKey: 'valor_atual',
							editorType: 'number'
						}";
					
					$igniteui=new igniteui;
					$igniteui->igrid_editavel($json,$column,$column_editavel);
			
			
		echo "
		<script>
        $(function(){
            $('.uk-table tr').click( function(){
				var id_tr=$(this).attr('id');
				var class_name=document.getElementById(id_tr).className;
				if(class_name=='tr_selecionada'){
					document.getElementById(id_tr).className='';
				}else{
					document.getElementById(id_tr).className ='tr_selecionada';
				}
            });
        })
		$(function(){
			$('#confirmar_reavaliacao').click(function(){

						$('#grid_relatorio').igGrid('commit');
						var formData = new FormData();
							formData.append('json', JSON.stringify($('#grid_relatorio').data('igGrid').dataSource.data()));
							formData.append('tabela', 'reavaliacao');
						var xhr = new XMLHttpRequest();
							xhr.onreadystatechange = function()
							{
								if(xhr.readyState == 4 && xhr.status == 200)
								{
									document.getElementById('grid_msg').innerHTML=xhr.responseText;
								}
							}						
							xhr.open('POST', 'php/salvar_reavaliacao.php',true);
							xhr.send(formData);				


		});
		});
		
		</script>	
		";					

			
			
			
			}

			
	}
	
	
}

class relatorios{
	function filtros($tipo){
		$inputs=new inputs;
		$selects=new selects;
		if($tipo==1){
			echo "
					<div>
						<h3>Filtro</h3>
						<form class='uk-form' action='#' method='post'>
							<ul class='uk-subnav'>
								<li>
									<div class='uk-form-row'>
										<label class='uk-form-label' for='xxx'>de</label>
										<div class='uk-form-controls'>
											<input class='uk-form-small' placeholder='' data-uk-datepicker={format:'DD/MM/YYYY'} style='width:100%;text-align: right;' name='data_inicio' id='data_inicio' value='00/00/0000' type='text'>
										</div>
									</div>	
								</li>
								<li>									
									<div class='uk-form-row'>
										<label class='uk-form-label' for='xxx'>até</label>
										<div class='uk-form-controls'>
											<input class='uk-form-small' placeholder='' data-uk-datepicker={format:'DD/MM/YYYY'} style='width:100%;text-align: right;' name='data_fim' id='data_fim' value='00/00/0000' type='text'>
										</div>
									</div>									
								</li>
								<li>	
									<br/>
									<button class='uk-button uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>
								</li>
							</ul>
							
						</form>
						<hr class='uk-article-divider'>
				</div>";

		}
		if($tipo==2){
			echo "<div class='uk-grid uk-width-1-1' style=''>
					<div class='uk-width-1-1' style='margin-bottom: 30px;'>
						<h3>Filtro</h3>
						<form class='uk-form' action='#' method='post'>						
							<ul class='uk-subnav'>
								<li>";
									$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
						echo	 	"
								</li>
								<li>";
									$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
						echo		 "
								</li>
								<li>";
									$selects->aquisicao_baixa('','Relatório');
						echo		 "
								</li>
								<li>";
									$selects->cad_motivo_baixa('','Motivo de baixa');
						echo		 "
								</li>
								<li>";
									$selects->cod_grupo_patrimonio('','Grupo');
						echo		 "
								</li>
								<li>";
									$selects->filial('','Filial');
						echo		 "
								</li>
								<li>";
									$selects->tipo_patrimonio('','Tipo de patrimônio');
						echo		 "
								</li>
								<li>";
									$selects->tipo_aquisicao('','Aquisição');
						echo		 "
								</li>
								<li>
									</br>
									<button class='uk-button uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>
								</li>
							</ul>
						</form>
						<hr class='uk-article-divider'>
					</div>
				</div>";
		
		}
		if($tipo==3){
			echo "<div class='uk-grid uk-width-1-1' style=''>
					<div class='uk-width-1-1' style='margin-bottom: 30px;'>
						<h3>Filtro</h3>
						<form class='uk-form' action='#' method='post'>
							<ul class='uk-subnav'>
								<li>";
								$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
					echo	 	"
								</li>
								<li>
					";
								$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
					echo		 "
								</li>
								<li>
					";
								$selects->cod_grupo_patrimonio('','Grupo');
					echo		 "
								</li>
								<li>
					";
								$selects->filial('','Filial');
					echo		 "
								</li>
								<li>
									</br>
									<button class='uk-button uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>
								</li>
							</ul>
						</form>
						<hr class='uk-article-divider'>
					</div>
				</div>";
		
		}
		if($tipo==4){
			echo "<div class='uk-grid uk-width-1-1' style=''>
					<div class='uk-width-1-1' style='margin-bottom: 30px;'>
						<h3>Filtro</h3>
						<form class='uk-form' action='#' method='post'>
							<div class='uk-grid'>
								<div class='uk-width-1-5'>";
								$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
					echo	 	"</div>
								<div class='uk-width-1-5'>";
								$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
					echo		 "</div>
								<div class='uk-width-1-5'>";
								$inputs->input_form_row('','cod_item','Cod. Item','','');
					echo		 "</div>
								<div class='uk-width-1-5'>";
								$selects->cod_grupo_patrimonio('','Grupo');
					echo		 "</div>
								<div class='uk-width-1-5'>";
								$selects->filial('','Filial');
					echo		 "</div>
								<div class='uk-width-1-1'>
								<hr class='uk-article-divider'>
									<button class='uk-button uk-button-danger' type='submit' id='' ><i class='uk-icon-check'></i> Confirmar</button>
								</div>
							</div>
						</form>
					</div>
				</div>";
		
		}

	
	}
	function mapa_ativo(){


			echo "<div id='grid_relatorio' class='uk-width-1-1'></div>";
			
		if(isset($_POST) and $_POST!=null and $_POST['data_inicio']!="00/00/0000" and $_POST['data_fim']!="00/00/0000"){
			
			$data_inicio= DateTime::createFromFormat('d/m/Y', $_POST['data_inicio'])->format('Y-m-d');
			$data_fim= DateTime::createFromFormat('d/m/Y', $_POST['data_fim'])->format('Y-m-d');

		$select="
				SELECT 
					cad_grupo_patrimonio.cod_grupo_patrimonio,
					cad_grupo_patrimonio.numero,
					cad_grupo_patrimonio.descricao,
					ROUND(ifnull(tb_saldo_inicial.valor_aquisicao,0),2) as valor_aquisicao,
					ROUND(ifnull(tb_depreciacao_anterior.valor,0),2) as depreciacao_anterior,
					ROUND(ifnull(tb_saldo_inicial.total,0),2) as saldo_inicial,
					ROUND(ifnull(tb_aquisicoes.total,0),2) as aquisicoes,
					ROUND(ifnull(-tb_baixas.total,0),2) as baixas,
					ROUND(ifnull(tb_saldo_atual.total,0),2) as saldo_atual,
					ROUND(ifnull(tb_depreciacao_acumulada.valor,0)-ifnull(tb_depreciacao_periodo.valor,0),2) as depreciacao_acumulada_inicial,					
					ROUND(ifnull(tb_depreciacao_periodo.valor,0),2) as depreciacao_periodo,
					ROUND(ifnull(tb_depreciacao_acumulada.valor,0),2) as depreciacao_acumulada_final,
					ROUND((ifnull(tb_saldo_atual.total,0)+ifnull(tb_depreciacao_acumulada.valor,0)-ifnull(tb_depreciacao_periodo.valor,0)),2) as saldo_liquido_anterior,
					ROUND((ifnull(tb_saldo_atual.total,0)+ifnull(tb_depreciacao_acumulada.valor,0)),2) as saldo_liquido_atual

				 FROM 
					imobilizado.cad_grupo_patrimonio

				left join (
					SELECT 
						sum(valor_aquisicao) as total,
						cod_grupo_patrimonio
					FROM 
						imobilizado.cad_itens
					where
						(data_aquisicao between '".$data_inicio."' and '".$data_fim."')
					group by
						cod_grupo_patrimonio
				) as tb_aquisicoes on tb_aquisicoes.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio

				left join (
					SELECT 
						cad_itens.valor_aquisicao as valor_aquisicao,
						sum(cad_movimento.valor) as total,
						cad_itens.cod_grupo_patrimonio
					FROM 
						imobilizado.cad_itens,
						imobilizado.cad_movimento
					where
						cad_itens.cod_item=cad_movimento.cod_item and
						(cad_itens.data_aquisicao < '".$data_inicio."') and
						(cad_movimento.data < '".$data_inicio."') 
					group by
						cad_itens.cod_grupo_patrimonio
						
				) as tb_saldo_inicial on tb_saldo_inicial.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio

				left join (
					SELECT 
						sum(valor_aquisicao) as total,
						cod_grupo_patrimonio
					FROM 
						imobilizado.cad_itens
					where
						(data_baixa between '".$data_inicio."' and '".$data_fim."')
					group by
						cod_grupo_patrimonio

				) as tb_baixas on tb_baixas.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio

				left join (
					SELECT 
						sum(valor_aquisicao) as total,
						cod_grupo_patrimonio
					FROM 
						imobilizado.cad_itens
					where
						(data_aquisicao <= '".$data_fim."') and
						(data_baixa > '".$data_fim."' or data_baixa='0000-00-00' )
					group by
						cod_grupo_patrimonio

				) as tb_saldo_atual on tb_saldo_atual.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio

				left join(
					SELECT 
						cad_itens.cod_grupo_patrimonio,
						sum(cad_movimento.valor) as valor 
					FROM 
						imobilizado.cad_movimento,
						imobilizado.cad_itens
					where
						cad_movimento.cod_item=cad_itens.cod_item and
						(cad_movimento.data between '".$data_inicio."' and '".$data_fim."') and
						cad_movimento.cod_tipo_movimento=6
					group by
						cad_itens.cod_grupo_patrimonio

				) as tb_depreciacao_periodo on tb_depreciacao_periodo.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio

				left join(
					SELECT 
						cad_itens.cod_grupo_patrimonio,
						sum(cad_movimento.valor) as valor 
					FROM 
						imobilizado.cad_movimento,
						imobilizado.cad_itens
					where
						cad_movimento.cod_item=cad_itens.cod_item and
						cad_movimento.data < '".$data_inicio."' and
						cad_movimento.cod_tipo_movimento=6
					group by
						cad_itens.cod_grupo_patrimonio

				) as tb_depreciacao_anterior on tb_depreciacao_anterior.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio

				left join(
					SELECT 
						cad_itens.cod_grupo_patrimonio,
						sum(cad_movimento.valor) as valor 
					FROM 
						imobilizado.cad_movimento,
						imobilizado.cad_itens
					where
						cad_movimento.cod_item=cad_itens.cod_item and
						(cad_movimento.data <= '".$data_fim."') and
						(cad_itens.data_aquisicao <= '".$data_fim."') and
						(cad_itens.data_baixa > '".$data_fim."' or data_baixa='0000-00-00' ) and
						cad_movimento.cod_tipo_movimento=6
					group by
						cad_itens.cod_grupo_patrimonio

				) as tb_depreciacao_acumulada on tb_depreciacao_acumulada.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio
				;
		";
			$pesquisa=new pesquisa;
			$base=	$pesquisa->json($select);
			
			$column= "{headerText: 'ID', key: 'cod_grupo_patrimonio', width: '50px', dataType: 'string'},";
			$column.="{headerText: 'numero', key: 'numero', width: '150px', dataType: 'string'},";
			$column.="{headerText: 'descricao', key: 'descricao',  dataType: 'string'},";
			
			$column.= " {
                        headerText: 'Movimentoação do Período',
                        group: [
								{headerText: 'Valor de <br/>aquisição', key: 'valor_aquisicao', width: '90px', dataType: 'number', format: '0.00'},
								{headerText: 'Valor<br/> depreciado', key: 'depreciacao_anterior', width: '90px', dataType: 'number', format: '0.00'},
								{headerText: 'Saldo<br/>inicial', key: 'saldo_inicial', width: '90px', dataType: 'number', format: '0.00'},
								{headerText: 'Aquisições', key: 'aquisicoes', width: '90px', dataType: 'number', format: '0.00'},
								{headerText: 'Baixas', key: 'baixas', width: '90px', dataType: 'number', format: '0.00'},
								{headerText: 'Depreciação <br/>do período', key: 'depreciacao_periodo', width: '90px', dataType: 'number', format: '0.00'},
								{headerText: 'Saldo liquido <br/>final', key: 'saldo_liquido_atual', width: '90px', dataType: 'number', format: '0.00'}
                        ]
                    },";


					
	


			$igniteui=new igniteui;
			$igniteui->igrid_relatorios($base,$column,'');			
		}

	}
	function aquisicoes_baixas(){
			echo "<div id='grid_relatorio' class='uk-width-1-1'></div>";
	
		if(isset($_POST) and $_POST!=null and $_POST['data_inicio']!="00/00/0000" and $_POST['data_fim']!="00/00/0000" and $_POST['aquisicao_baixa']!=""){
			$data_inicio= DateTime::createFromFormat('d/m/Y', $_POST['data_inicio'])->format('Y-m-d');
			$data_fim= DateTime::createFromFormat('d/m/Y', $_POST['data_fim'])->format('Y-m-d');
			$filtro="";
			
			if($_POST['aquisicao_baixa']=="aquisicao"){
				$filtro.=" where (cad_itens.data_aquisicao between '".$data_inicio."' and '".$data_fim."') ";
			}
			if($_POST['aquisicao_baixa']=="baixa"){
				$filtro.=" where (cad_itens.data_baixa between '".$data_inicio."' and '".$data_fim."') ";
			}
			
			if($_POST['cod_grupo_patrimonio']!=""){
				$filtro.=" and cad_itens.cod_grupo_patrimonio='".$_POST['cod_grupo_patrimonio']."' ";
			}
			if($_POST['cod_filial']!=""){
				$filtro.=" and cad_itens.cod_filial='".$_POST['cod_filial']."' ";
			}
			if($_POST['cod_tipo_patrimonio']!=""){
				$filtro.=" and cad_itens.cod_tipo_patrimonio='".$_POST['cod_tipo_patrimonio']."' ";
			}
			if($_POST['cod_tipo_aquisicao']!=""){
				$filtro.=" and cad_itens.cod_tipo_aquisicao='".$_POST['cod_tipo_aquisicao']."' ";
			}
			if($_POST['cod_motivo_baixa']!=""){
				$filtro.=" and cad_itens.cod_motivo_baixa='".$_POST['cod_motivo_baixa']."' ";
			}
		$select="
				SELECT 
					cad_itens.*,
					cad_grupo_patrimonio.descricao as grupo,
					cad_filial.descricao as filial,
					cad_fornecedor.nome_razao_social as fornecedor,
					cad_motivo_baixa.descricao as motivo_baixa
					
				FROM 
					imobilizado.cad_itens

				left join imobilizado.cad_grupo_patrimonio  on cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio
				left join imobilizado.cad_filial on cad_itens.cod_filial=cad_filial.cod_filial
				left join imobilizado.cad_fornecedor on cad_itens.cod_fornecedor=cad_fornecedor.cod_fornecedor
				left join imobilizado.cad_motivo_baixa on cad_itens.cod_motivo_baixa=cad_motivo_baixa.cod_motivo_baixa
			".$filtro."
		";
		
		//echo $select;
			$pesquisa=new pesquisa;
			$base=	$pesquisa->json($select);

			
			$column= "{headerText: 'ID', key: 'cod_item', width: '50px', dataType: 'string'},";
			$column.="{headerText: 'Plaqueta', key: 'codigo_patrimonio', width: '50px', dataType: 'string'},";
			$column.="{headerText: 'Grupo', key: 'grupo', width:'100px',  dataType: 'string'},";
			$column.="{headerText: 'Filial', key: 'filial', width:'100px',  dataType: 'string'},";
			$column.="{headerText: 'Descrição do Item', key: 'descricao',  dataType: 'string'},";
			$column.="{headerText: 'Fornecedor', key: 'fornecedor', width:'100px',  dataType: 'string'},";
			$column.="{headerText: 'Documento', key: 'numero_documento', width:'70px',  dataType: 'string'},";
			$column.="{headerText: 'Aquisição', key: 'data_aquisicao', width:'70px',  dataType: 'date', format:'d/MM/yyyy'},";
			$column.="{headerText: 'Baixa', key: 'data_baixa', width:'70px', dataType: 'date', format:'d/MM/yyyy'},";
			$column.="{headerText: 'Motivo de baixa', key: 'motivo_baixa', width:'70px', dataType: 'string'},";
			$column.="{headerText: 'Vl.Aquisição', key: 'valor_aquisicao', width:'70px',  dataType: 'number', format:'0.00'}";

			$groupby="{columnKey: 'grupo',isGroupBy: true},";
			//$groupby.="{columnKey: 'filial',isGroupBy: true},";
			
		$xxx="	cod_filial
			cod_fornecedor
			cod_grupo_patrimonio

			cod_item_pai
			cod_status_patrimonio
			cod_tipo_aquisicao
			cod_tipo_documento
			cod_tipo_patrimonio
			codigo_barras


			data_baixa
			data_inclusao





			quantidade
			serie
			taxa_depreciacao_anual
			unidade

			valor_atual
			valor_residual
			vida_util";


					


			$igniteui=new igniteui;
			$igniteui->igrid_relatorios($base,$column,$groupby);			
		}
	
	


	}
	function depreciacao(){

			echo "<div id='grid_relatorio' class='uk-width-1-1'></div>";		
	
		if(isset($_POST) and $_POST!=null and $_POST['data_inicio']!="00/00/0000" and $_POST['data_fim']!="00/00/0000" ){
			$data_inicio= DateTime::createFromFormat('d/m/Y', $_POST['data_inicio'])->format('Y-m-d');
			$data_fim= DateTime::createFromFormat('d/m/Y', $_POST['data_fim'])->format('Y-m-d');
			$filtro="";
			
			if($_POST['cod_grupo_patrimonio']!=""){
				$filtro.=" and cad_itens.cod_grupo_patrimonio='".$_POST['cod_grupo_patrimonio']."' ";
			}
			if($_POST['cod_filial']!=""){
				$filtro.=" and cad_itens.cod_filial='".$_POST['cod_filial']."' ";
			}
		$select="
				SELECT 
					cad_itens.cod_item,
					cad_grupo_patrimonio.descricao as nome_grupo,
					cad_itens.descricao,
					cad_itens.data_aquisicao,
					ROUND(cad_itens.valor_aquisicao,2) as valor_aquisicao,
					cad_itens.vida_util as vida_util_item,
					cad_itens.taxa_depreciacao_anual as taxa_depreciacao_anual_item,

					cad_grupo_patrimonio.vida_util as vida_util_grupo,
					cad_grupo_patrimonio.taxa_depreciacao_anual as taxa_depreciacao_anual_grupo,

					ROUND(ifnull(tb_saldo_inicial.valor, cad_itens.valor_aquisicao),2) as saldo_inicial,
					ROUND(tb_depreciacao.valor,2) as depreciacao,
					ROUND(ifnull(tb_saldo_inicial.valor, cad_itens.valor_aquisicao)+ tb_depreciacao.valor,2) as saldo_final
					
				FROM 
					imobilizado.cad_itens

				left join imobilizado.cad_grupo_patrimonio  on cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio
				left join ( select cod_item,data,sum(valor) as valor from imobilizado.cad_movimento where (data between '".$data_inicio."' and '".$data_fim."') and cod_tipo_movimento=6 group by cod_item) as tb_depreciacao  on cad_itens.cod_item=tb_depreciacao.cod_item
				left join ( select cod_item,sum(valor) as valor from imobilizado.cad_movimento where (data < '".$data_inicio."' )  group by cod_item) as tb_saldo_inicial  on cad_itens.cod_item=tb_saldo_inicial.cod_item
				
				where 
					cad_itens.data_aquisicao<'".$data_fim."'
					".$filtro."

				group by
					cad_itens.cod_item
					

		";
		
		//echo $select;
			$pesquisa=new pesquisa;
			$base=	$pesquisa->json($select);
			//echo $base;
			
			$column= "{headerText: 'ID', key: 'cod_item', width: '50px', dataType: 'string'},";
			$column.="{headerText: 'Grupo', key: 'nome_grupo',  dataType: 'string'},";
			$column.="{headerText: 'Descrição do Item', key: 'descricao',  dataType: 'string'},";
			
			$column.="{
                        headerText: 'Aquisição',
                        group: [
								{headerText: 'Data', key: 'data_aquisicao', width:'80px',  dataType: 'date', format:'d/MM/yyyy'},
								{headerText: 'Valor', key: 'valor_aquisicao', width:'80px',  dataType: 'number', format:'0.00'},
						]
						},";
			$column.="{
                        headerText: 'Vida útil',
                        group: [
								{
								headerText: 'Item',
								group: [
										{headerText: 'V.U.', key: 'vida_util_item', width:'50px',  dataType: 'number', format:'int'},
										{headerText: 'Taxa Anual', key: 'taxa_depreciacao_anual_item', width:'50px',  dataType: 'number', format:'0.00'},
									]
								},
								{
								headerText: 'Grupo',
								group: [
										{headerText: 'V.U.', key: 'vida_util_grupo', width:'50px',  dataType: 'number', format:'int'},
										{headerText: 'Taxa Anual', key: 'taxa_depreciacao_anual_grupo', width:'50px',  dataType: 'number', format:'0.00'},
									]
								},
						
						]
						},";
			$column.="{
                        headerText: 'Saldos',
                        group: [
								{headerText: 'Inicial', key: 'saldo_inicial', width:'80px',  dataType: 'number', format:'0.00'},
								{headerText: 'Depreciação', key: 'depreciacao', width:'80px',  dataType: 'number', format:'0.00'},
								{headerText: 'Final', key: 'saldo_final', width:'80px',  dataType: 'number', format:'0.00'}
						]
						},";

			

			$groupby="";
	
			$igniteui=new igniteui;
			$igniteui->igrid_relatorios($base,$column,$groupby);			
		}
	
	


	}

}
class imprimir{
	function ficha_ativo($id){
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
					imobilizado.cad_itens

				left join (imobilizado.cad_filial) on cad_itens.cod_filial=cad_filial.cod_filial
				left join (imobilizado.cad_localizacao) on cad_itens.cod_localizacao=cad_localizacao.cod_localizacao
				left join (imobilizado.cad_fornecedor) on cad_itens.cod_fornecedor=cad_fornecedor.cod_fornecedor
				left join (imobilizado.cad_grupo_patrimonio) on cad_itens.cod_grupo_patrimonio=cad_grupo_patrimonio.cod_grupo_patrimonio
				left join (imobilizado.cad_tipo_aquisicao) on cad_itens.cod_tipo_aquisicao=cad_tipo_aquisicao.cod_tipo_aquisicao
				left join (imobilizado.cad_tipo_documento) on cad_itens.cod_tipo_documento=cad_tipo_aquisicao.cod_tipo_aquisicao
				left join (imobilizado.cad_tipo_patrimonio) on cad_itens.cod_tipo_patrimonio=cad_tipo_patrimonio.cod_tipo_patrimonio
				left join (imobilizado.cad_status_patrimonio) on cad_itens.cod_status_patrimonio=cad_status_patrimonio.cod_status_patrimonio

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
				<h3 class='tm-article-subtitle'>Ficha de ativo</h3>			

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
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Vida útil do grupo</label>
									<p>".$vida_util_grupo."</p>
								</div>		
							</div>	
							<div class='uk-width-1-5'>
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
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Tipo de documento</label>
									<p>".$cod_tipo_documento." - ".$tipo_documento."</p>
								</div>						
							</div>						
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Número documento</label>
									<p>".$numero_documento."</p>
								</div>
							</div>
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Número de Série</label>
									<p>".$serie."</p>
								</div>						
							</div>
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Quantidade</label>
									<p>".$quantidade."</p>
								</div>
							</div>
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Unidade</label>
									<p>".$unidade."</p>
								</div>
							</div>								
						</div>	


				<hr class='uk-article-divider'>

						<div class='uk-grid'>
				
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Valor de aquisição</label>
									<p>".$valor_aquisicao."</p>
								</div>
							</div>
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Valor atual</label>
									<p>".$valor_atual."</p>
								</div>
							</div>
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Valor residual</label>
									<p>".$valor_residual."</p>
								</div>
							</div>
						
							<div class='uk-width-1-5'>
								<div class=' uk-panel uk-panel-box '>
									<label>Vida útil</label>
									<p>".$vida_util."</p>
								</div>
							</div>					
							<div class='uk-width-1-5'>
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

?>