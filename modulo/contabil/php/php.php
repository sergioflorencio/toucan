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
	function status($bloqueada_ativa,$label){
						$options="";
						if($bloqueada_ativa=='bloqueada' or $bloqueada_ativa=='ativa'){
							$options.= "<option value='".$bloqueada_ativa."' selected >".$bloqueada_ativa."</option>";
						}
							$options.= "<option value=''></option>";
							$options.= "<option value='bloqueada'>bloqueada</option>";
							$options.= "<option value='ativa'>ativa</option>";
						echo "<label class='uk-form-label' for='status'>".$label."</label><select class='uk-form-small' id='status' name='status' style='width: 100%;'>".$options."</select>";
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
		include "config.php";		
		$sql_select="SELECT * FROM ".$schema.".cad_fornecedor";
		$campo_id="cod_fornecedor";
		$campo_descricao="nome_razao_social";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function cod_tipo_documento($id,$label){
		include "config.php";		
		$sql_select="SELECT * FROM ".$schema.".cad_tipo_documento";
		$campo_id="cod_tipo_documento";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function cod_tipo_conta($id,$label){
		include "config.php";		
		$sql_select="SELECT * FROM ".$schema.".cad_tipo_conta";
		$campo_id="cod_tipo_conta";
		$campo_descricao="descricao";
		
		$select=new selects;
		$select->_____modelo____($sql_select,$campo_id,$id,$campo_descricao,$label);
	}
	function ctrcusto_autocomplete($id_orcamento){
		include "config.php";
		$select = "SELECT ".$schema.".cad_centro_custo.numero_centro_custo as 'text', concat(".$schema.".cad_centro_custo.numero_centro_custo,' - ',".$schema.".cad_centro_custo.descricao) as 'value'  FROM ".$schema.".cad_centro_custo where status='ativa' and cod_empresa='".$_SESSION['cod_empresa']."';";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$bs_ctrcusto="";
		while($row = mysql_fetch_array($resultado))
		{
			$bs_ctrcusto.=json_encode($row);
		}	
			$bs_ctrcusto=str_replace("}{","},{",$bs_ctrcusto);
			$bs_ctrcusto="var bs_ctrcusto=[".$bs_ctrcusto."];";
			echo $bs_ctrcusto;
	
		
		
	
	}
	function conta_autocomplete($id_orcamento){
		include "config.php";
		$select = "SELECT ".$schema.".cad_conta.numero_conta as 'text', concat(".$schema.".cad_conta.numero_conta,' - ',".$schema.".cad_conta.descricao) as 'value'   FROM ".$schema.".cad_conta  where  status='ativa' and cod_empresa='".$_SESSION['cod_empresa']."' ;";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$bs_conta="";
		while($row = mysql_fetch_array($resultado))
		{
			$bs_conta.=json_encode($row);
		}	
			$bs_conta=str_replace("}{","},{",$bs_conta);
			$bs_conta="var bs_conta=[".$bs_conta."];";
			echo $bs_conta;
		
		
		
	
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
					<li>
						<div class='uk-button-group'>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=pesquisa&mod=".$_GET['mod']."&id='  style=''><i class='uk-icon-binoculars'></i> Pesquisar</a>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=".$_GET['act']."&mod=".$_GET['mod']."&id=' style=''><i class='uk-icon-file-o'></i> Novo</a> 
							<a class='uk-button uk-button-mini uk-button-primary ' href='#' id='bt_salvar'  style=''><i class='uk-icon-save '></i> Salvar</a>
						</div>		
					</li>
					<li>
						<div class='uk-button-group'>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['min']."' style=''><i class='uk-icon-fast-backward'></i> Primeiro</a>							
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=cadastros&mod=".$_GET['mod']."&id=".max($id-1,$valores['min']) ."' style=''><i class='uk-icon-backward'></i> Anterior</a>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=cadastros&mod=".$_GET['mod']."&id=".min($id+1,$valores['max'])."' style=''><i class='uk-icon-forward'></i> Próximo</a>
							<a class='uk-button uk-button-mini uk-button-primary ' href='?act=cadastros&mod=".$_GET['mod']."&id=".$valores['max']."' style=''><i class='uk-icon-fast-forward'></i> Último</a>
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
				<a class='uk-button uk-button-mini uk-button-primary ' href='#' id='bt_salvar'  style=''><i class='uk-icon-save '></i> Salvar</a>
			</div>		
		</li>
		";

	}
	function submenu_cad_documento($valores,$id){
		if($_GET['id']>0 or $_GET['id']!=""){$disabled=" disabled ";}else{$disabled="  ";}
		echo $id;
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
						<button class='uk-button uk-button-mini uk-button-danger' type='button' onclick='cloneRow()'  ".$disabled." ><i class='uk-icon-plus-circle'></i> Nova linha</button>
						<button class='uk-button uk-button-mini uk-button-danger' type='button' onclick='delAllRow()'  ".$disabled."><i class='uk-icon-times'></i> Excluir linhas</button>
					</div>
				</li>
		";
	}
	function submenu_cad_itens($valores,$id){
		echo "

					<li  data-uk-tooltip={pos:'right'} title='Pesquisar'><a href='?act=pesquisa&mod=".$_GET['mod']."&id=' class='uk-button-link '  style=''><i class='uk-icon-binoculars'></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Novo'><a href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button-link ' style=''><i class='uk-icon-file-o'></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Salvar'><a href='#' class=' uk-button-link  '  id='bt_salvar'  style=''><i class='uk-icon-save '></i></a> </li>
					<li  data-uk-tooltip={pos:'right'} title='Imprimir ficha de ativa'><a href='?act=imprimir&mod=ficha_ativa&id=".$_GET['id']."' target='_blank'><i class='uk-icon-print'></i></a> </li>
					
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
					<div class='uk-button-group'>
						<a class='uk-button uk-button-mini uk-button-primary' href='#' onclick=exportar('xls','".$id_grid."','html'); ><i class='uk-icon-file-excel-o'></i> .xls </a>
						<a class='uk-button uk-button-mini uk-button-primary' href='#' onclick=exportar('doc','".$id_grid."','html'); ><i class='uk-icon-file-word-o'></i> .doc </a>
					</div>
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
							<div class='uk-width-1-2'>";
							$inputs->input_form_row('00/00/0000','data_inicio','de',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
				echo	 "</div>
							<div class='uk-width-1-2'>";
							$inputs->input_form_row('00/00/0000','data_fim','até',''," data-uk-datepicker={format:'DD/MM/YYYY'}");
				echo	 "</div>
							<div class='uk-width-1-2'>";
							$inputs->input_form_row('','cod_item','Item',"","data-uk-datepicker={format:'DD/MM/YYYY'}");
				echo	 "</div>
							<div class='uk-width-1-2'>";
							$selects->cod_grupo_patrimonio('','Grupo');
				echo	 "</div>
							<div class='uk-width-1-2'>
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
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id'])  and $_GET['act']=="cadastros" and $_GET['mod']!="cad_documento"){
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
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id'])  and $_GET['act']=="cadastros"  and $_GET['mod']=="cad_documento"){
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
				$menus->submenu_cad_documento($valores,$id);
			}							
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id'])  and $_GET['act']=="editar"  and ($_GET['mod']=="cad_conta" or $_GET['mod']=="cad_centro_custo")){
			$filtro=1;
			$menus=new menus;
			//$relatorios=new relatorios;
			//$relatorios->filtros('');
			//$menus->menu_exportar('relatorio','');
				$id=str_replace("cad_","cod_",$_GET['mod']);
				$valores=$sql->min_max($_GET['mod'], $id);
				$menus->submenu_editar();

		
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="pesquisa" and $_GET['mod']=="cad_documento"){
				echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
				echo "<li  data-uk-tooltip={pos:'right'} title='Novo'><div class='uk-button-group'><a href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button uk-button-mini uk-button-primary ' style=''><i class='uk-icon-file'></i> Incluir novo cadastro</a></div></li>";
				$menus->menu_exportar('grid',0);
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="pesquisa" and $_GET['mod']=="razao"){
				echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
				//echo "<li  data-uk-tooltip={pos:'right'} title='Novo'><div class='uk-button-group'><a href='?act=cadastros&mod=".$_GET['mod']."&id=' class='uk-button uk-button-mini uk-button-primary ' style=''><i class='uk-icon-file'></i> Incluir novo cadastro</a></div></li>";
				$menus->menu_exportar('grid',0);
		 }
		if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id']) and $_GET['id']=="" and $_GET['act']=="relatorios"){
			echo "<button class='uk-button uk-button-mini uk-button-primary' data-uk-offcanvas={target:'#div_filtro'}><i class='uk-icon-filter'></i> Filtro</button>";
			$filtro=1;
			$menus=new menus;
			$relatorios=new relatorios;
			$relatorios->filtros('');
			$menus->menu_exportar('relatorio','');
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
		<div id='grid' style=''></div>
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
		//Initialize
	//$('#grid').igGrid({
	//	cellClick: function(evt, ui) { window.location.assign('?act=cadastros&mod=".$tabela."&id='+$('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));}
	//});	

	///alert($('#grid').igGrid('getCellValue', ui.rowIndex, 'id'));

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	function TreeGrid($base,$column,$tabela,$combo,$plano_conta){
	echo 
		"
		<div id='grid' style=''></div>
		<style>
			tr{
				cursor:pointer;
				
			}
		</style>
		
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
	function cad_fornecedor($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_fornecedor where cod_fornecedor='".$id."' and cod_empresa='".$_SESSION['cod_empresa']."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_fornecedor','cod_fornecedor');
	}
	function cad_periodo($id){
		include "config.php";
		$select="SELECT 
			cod_periodo,
			DATE_FORMAT(data_inicio,'%d/%m/%Y') as data_inicio,
			DATE_FORMAT(data_fim,'%d/%m/%Y') as data_fim,
			status
			
		FROM ".$schema.".cad_periodo where cod_periodo='".$id."'  and cod_empresa='".$_SESSION['cod_empresa']."';";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_periodo','cod_periodo');
	}
	function cad_cliente($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_cliente where cod_cliente='".$id."'  and cod_empresa='".$_SESSION['cod_empresa']."';";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_cliente','cod_cliente');
	}
	function cad_plano_conta($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_plano_conta where cod_plano_conta='".$id."'  and cod_empresa='".$_SESSION['cod_empresa']."' ;";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_plano_conta','cod_plano_conta');
	}
	function cad_plano_centro_custo($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_plano_centro_custo where cod_plano_centro_custo='".$id."'  and cod_empresa='".$_SESSION['cod_empresa']."';";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_plano_centro_custo','cod_plano_centro_custo');
	}
	function cad_documento($id){
		include "config.php";
		$select="
				SELECT 
					cod_documento, 
					cod_empresa, 
					cod_tipo_documento, 
					referencia, 
					texto_cabecalho_documento, 
					DATE_FORMAT(data_lancamento,'%d/%m/%Y') as data_lancamento,
					DATE_FORMAT(data_base,'%d/%m/%Y') as data_base,
					DATE_FORMAT(data_estorno,'%d/%m/%Y') as data_estorno,
					DATE_FORMAT(data_alteracao,'%d/%m/%Y') as data_alteracao,
					exercicio, 
					periodo, 
					historico, 
					DATE_FORMAT(data_inclusao,'%d/%m/%Y') as data_inclusao,
					DATE_FORMAT(data_ultima_alteracao,'%d/%m/%Y') as data_ultima_alteracao,
					usuario_inclusao, 
					usuario_ultima_alteracao 
				FROM ".$schema.".cad_documento
				where cod_documento='".$id."'  and cod_empresa='".$_SESSION['cod_empresa']."';";
		$cadastro=new cadastros;
		$cadastro->pesquisa($select,'cad_documento','cod_documento');
	}
	function cad_documento_item_json_____excluir____($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_documento_item where cod_documento='".$id."'  and cod_empresa='".$_SESSION['cod_empresa']."';";
		$pesquisa=new pesquisa;
		$base=$pesquisa->json($select);
			include "includes/cad_documento_item.php";		
	}
	function cad_documento_item($id){
		include "config.php";
		$select="SELECT * FROM ".$schema.".cad_documento_item where cod_documento='".$id."'  and cod_empresa='".$_SESSION['cod_empresa']."';";
		$pesquisa=new pesquisa;
		$base=$pesquisa->json($select);
			include "includes/cad_documento_item.php";		
	}
	function cad_conta($id){
		
		include "config.php";		
		$select= "
				SELECT 
					cod_conta as ID,
					if(cod_conta_mae=0,-1,cod_conta_mae) as PID,
					cad_conta.cod_tipo_conta,
					concat('#',numero_conta) as numero_conta,
					concat('#',numero_conta,' - ',cad_conta.descricao) as conta,					
					cad_conta.descricao,
					REPLACE(REPLACE(REPLACE(FORMAT(`saldo_inicial`,2),'.','|'),',','.'),'|',',') as saldo_inicial,
					REPLACE(REPLACE(REPLACE(FORMAT(`saldo_atual`,2),'.','|'),',','.'),'|',',') as saldo_atual,
					`status`,
					cad_tipo_conta.descricao as tipo_conta
				FROM 
					".$schema.".cad_conta 
					
				left join ".$schema.".cad_tipo_conta on cad_tipo_conta.cod_tipo_conta=cad_conta.cod_tipo_conta
					
				WHERE
					cod_plano_conta='".$id."' 
				ORDER BY
					numero_conta;";
			
		$pesquisa=new pesquisa;
		$json=$pesquisa->json($select);
		
		$select= "
				SELECT 
					-1 as ID,
					0 as PID,
					concat('Conta Raiz') as conta,
					'Conta Raiz' as descricao
				union all
				SELECT 
					cod_conta as ID,
					cod_conta_mae as PID,
					concat('#',numero_conta,' - ',descricao) as conta,
					descricao

				FROM 
					".$schema.".cad_conta 
				WHERE
					cod_plano_conta='".$id."' ;";	
					
		$contas=$pesquisa->json($select);
		
		$select= "
				SELECT 
					cod_tipo_conta,
					descricao as tipo_conta
					
				FROM 
					".$schema.".cad_tipo_conta;";	
					
		$tipo_conta=$pesquisa->json($select);
		



			$column="{headerText: 'conta', key: 'conta', width: '350px', dataType: 'string'},";
			$column.="{headerText: 'Tipo de conta', key: 'tipo_conta', width: '200px',  dataType: 'string'},";			
			$column.="{headerText: 'Saldo inicial', key: 'saldo_inicial',width: '100px',  dataType: 'number'},";
			$column.="{headerText: 'Saldo atual', key: 'saldo_atual',width: '100px',  dataType: 'number'},";
			$column.="{headerText: 'Status', key: 'status',width: '150px',  dataType: 'string'}";

			$tabela="cad_conta";
			$combo="
                        {
                            columnKey: 'cod_conta_mae',
                            editorType: 'combo',
							required: true,
                            editorOptions: {
                                dataSource: ".$contas.",
								textKey: 'conta',
                                valueKey: 'ID'								
                            }
                        },
                        {
                            columnKey: 'cod_tipo_conta',
                            editorType: 'combo',
							required: true,
                            editorOptions: {
                                dataSource: ".$tipo_conta.",
								textKey: 'tipo_conta',
                                valueKey: 'cod_tipo_conta'								
                            }
                        },
                        {
                            columnKey: 'status',
                            editorType: 'combo',
							required: true,
                            editorOptions: {
                                dataSource: [{'status':'ativa'},{'status':'bloqueada'}]							
                            }
                        },{
							columnKey: 'tipo_conta',
							readOnly: true						
							
                        },{
							columnKey: 'ID',
							readOnly: true,
							required: true							
							
                        },{
							columnKey: 'numero_conta',
							readOnly: false,
							required: true
							
                        },{
							columnKey: 'descricao',
							readOnly: false,
							required: true
						},		
			";
			
			
			$igniteui=new igniteui;
			echo $igniteui->TreeGrid($json,$column,$tabela,$combo,$_GET['id']);
	
	
	
	
	
	
	
	}
	function cad_centro_custo($id){
		
		include "config.php";		
		$select= "
				SELECT 
					cod_centro_custo as ID,
					if(cod_centro_custo_mae=0,-1,cod_centro_custo_mae) as PID,
					cod_centro_custo_mae,
					concat('#',numero_centro_custo) as numero_centro_custo,
					concat('#',numero_centro_custo,' - ',cad_centro_custo.descricao) as centro_custo,						
					cad_centro_custo.descricao,
					REPLACE(REPLACE(REPLACE(FORMAT(`saldo_inicial`,2),'.','|'),',','.'),'|',',') as saldo_inicial,					
					REPLACE(REPLACE(REPLACE(FORMAT(`saldo_atual`,2),'.','|'),',','.'),'|',',') as saldo_atual,					
					`status`
				FROM 
					".$schema.".cad_centro_custo 
				WHERE
					cod_plano_centro_custo='".$id."' 
				ORDER BY
					numero_centro_custo;";
			
		$pesquisa=new pesquisa;
		$json=$pesquisa->json($select);
		
		$select= "
				SELECT 
					-1 as ID,
					0 as PID,
					concat('Centro de custo raiz') as centro_custo,
					'Centro de custo raiz' as descricao
				union all
				SELECT 
					cod_centro_custo as ID,
					cod_centro_custo_mae as PID,
					concat('#',numero_centro_custo,' - ',descricao) as centro_custo,
					descricao

				FROM 
					".$schema.".cad_centro_custo 
				WHERE
					cod_plano_centro_custo='".$id."' ;";	
					
		$centro_custos=$pesquisa->json($select);
		
			
			$column ="{headerText: 'Centro de Custo', key: 'centro_custo', width: '200px', dataType: 'string'},";
			$column.="{headerText: 'Status', key: 'status',width: '50px',  dataType: 'string'}";

			$tabela="cad_centro_custo";
			$combo="
                        {
                            columnKey: 'cod_centro_custo_mae',
                            editorType: 'combo',
							required: true,
                            editorOptions: {
                                dataSource: ".$centro_custos.",
								textKey: 'centro_custo',
                                valueKey: 'ID'								
                            }
                        },
                        {
                            columnKey: 'status',
                            editorType: 'combo',
							required: true,
                            editorOptions: {
                                dataSource: [{'status':'ativa'},{'status':'bloqueada'}]							
                            }
                        },{
							columnKey: 'tipo_centro_custo',
							readOnly: true						
							
                        },{
							columnKey: 'ID',
							readOnly: true,
							required: true							
							
                        },{
							columnKey: 'numero_centro_custo',
							readOnly: false,
							required: true
							
                        },{
							columnKey: 'descricao',
							readOnly: false,
							required: true
						},		
			";
			
			
			$igniteui=new igniteui;
			echo $igniteui->TreeGrid($json,$column,$tabela,$combo,$_GET['id']);
	
	
	
	
	
	
	
	}
}

class editar{
	function cad_conta($id){
		include "config.php";
		
		//var_dump($_POST);
		//var_dump($_GET);
		
		include "salvar_cadastro.php";		
		
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
	function cad_cliente($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro="  and ( cad_cliente.cod_cliente like '%".$id."%' or cad_cliente.razao_social like '%".$id."%' )";
		}
				$select= "
					SELECT
						cod_cliente as id,
						cad_cliente.*
					FROM 
						".$schema.".cad_cliente 
					WHERE 
						cod_empresa='".$_SESSION['cod_empresa']."'
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Razão Social', width: '350px',key: 'razao_social', dataType: 'string'},";
					$column.="{headerText: 'CNPJ', key: 'cnpj', width: '150px', dataType: 'string'}";
	

					$tabela="cad_cliente";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_periodo($id){
		include "config.php";
		
		$menus=new menus;
		//echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro="  and ( cad_periodo.cod_periodo like '%".$id."%' )";
		}
				$select= "
					SELECT
						cod_periodo as id,
						DATE_FORMAT(data_inicio,'%d/%m/%Y') as data_inicio,
						DATE_FORMAT(data_fim,'%d/%m/%Y') as data_fim,
						status
					FROM 
						".$schema.".cad_periodo 
					WHERE 
						cod_empresa='".$_SESSION['cod_empresa']."'
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Inicio', key: 'data_inicio',width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Fim', key: 'data_fim', width: '150px', dataType: 'string'},";
					$column.="{headerText: 'Status', key: 'status', width: '100px', dataType: 'string'}";


	

					$tabela="cad_periodo";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_fornecedor($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" and ( cad_fornecedor.cod_fornecedor like '%".$id."%' or cad_fornecedor.razao_social like '%".$id."%') ";
		}
				$select= "
					SELECT
						cod_fornecedor as id,
						cad_fornecedor.*
					FROM 
						".$schema.".cad_fornecedor 
					WHERE 
						cod_empresa='".$_SESSION['cod_empresa']."'						
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Razão Social', key: 'razao_social', width: '350px', dataType: 'string'},";
					$column.="{headerText: 'CNPJ', key: 'cnpj', width: '150px', dataType: 'string'}";
	

					$tabela="cad_fornecedor";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_plano_conta($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" and (cad_plano_conta.cod_plano_conta like '%".$id."%' or cad_plano_conta.descricao like '%".$id."%')  ";
		}
				$select= "
					SELECT
						cod_plano_conta as id,
						cad_plano_conta.*
					FROM 
						".$schema.".cad_plano_conta
					WHERE 
						cod_empresa='".$_SESSION['cod_empresa']."'						
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '350px', dataType: 'string'},";
					$column.="{headerText: 'Status', key: 'status', width: '150px', dataType: 'string'}";

	

					$tabela="cad_plano_conta";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_conta($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" and(cad_plano_conta.cod_plano_conta like '%".$id."%' or cad_plano_conta.descricao like '%".$id."%' )";
		}
				$select= "
					SELECT
						cod_plano_conta as id,
						cad_plano_conta.*
					FROM 
						".$schema.".cad_plano_conta
					WHERE 
						cod_empresa='".$_SESSION['cod_empresa']."'						
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao', width: '350px',dataType: 'string'},";
					$column.="{headerText: 'Status', key: 'status', width: '150px', dataType: 'string'}";

	

					$tabela="cad_conta";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_plano_centro_custo($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" and(cod_empresa='".$_SESSION['cod_empresa']."' and (cad_plano_centro_custo.cod_plano_centro_custo like '%".$id."%' or cad_plano_centro_custo.descricao like '%".$id."%' ) )";
		}
				$select= "
					SELECT
						cod_plano_centro_custo as id,
						cad_plano_centro_custo.*
					FROM 
						".$schema.".cad_plano_centro_custo
					WHERE 
						cod_empresa='".$_SESSION['cod_empresa']."'						
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao',width: '350px', dataType: 'string'},";
					$column.="{headerText: 'Status', key: 'status', width: '150px', dataType: 'string'}";

	

					$tabela="cad_plano_centro_custo";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_centro_custo($id){
		include "config.php";
		
		$menus=new menus;
		echo "<div id='grid'></div>";
		
		$filtro="";
		if($id!=""){
			$filtro=" and((cad_plano_centro_custo.cod_plano_centro_custo like '%".$id."%' or cad_plano_centro_custo.descricao like '%".$id."%' ) )";
		}
				$select= "
					SELECT
						cod_plano_centro_custo as id,
						cad_plano_centro_custo.*
					FROM 
						".$schema.".cad_plano_centro_custo
					WHERE 
						cod_empresa='".$_SESSION['cod_empresa']."'						
					".$filtro." ;";
					
					$pesquisa=new pesquisa;
					$json=$pesquisa->json($select);

					$column= "{headerText: 'ID', key: 'id', width: '50px', dataType: 'string'},";
					$column.="{headerText: 'Descrição', key: 'descricao',width: '350px', dataType: 'string'},";
					$column.="{headerText: 'Status', key: 'status', width: '150px', dataType: 'string'}";

	

					$tabela="cad_centro_custo";
					
					$igniteui=new igniteui;
					echo $igniteui->igrid($json,$column,$tabela);
	}
	function cad_documento($id){

				echo "<div class='uk-grid ' style=' '>";			
					echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
						echo "<div class='uk-offcanvas-bar'>";
							$relatorios= new relatorios;
							$relatorios->filtros(1);	
							
						echo "</div>";
					echo "</div>";
					echo "<div class=' uk-width-1-1    ' style='overflow: auto; padding-left: 10px;'>";						if(isset($_POST)==true and $_POST!=null){
								include "config.php";		
								$select= "
										SELECT 
											cod_documento as id,
											cod_documento, 
											cod_empresa, 
											cod_tipo_documento, 
											referencia, 
											texto_cabecalho_documento, 
											DATE_FORMAT(data_lancamento,'%d/%m/%Y') as data_lancamento,
											DATE_FORMAT(data_base,'%d/%m/%Y') as data_base,
											DATE_FORMAT(data_estorno,'%d/%m/%Y') as data_estorno,
											DATE_FORMAT(data_alteracao,'%d/%m/%Y') as data_alteracao,
											exercicio, 
											periodo, 
											historico, 
											DATE_FORMAT(data_inclusao,'%d/%m/%Y') as data_inclusao,
											DATE_FORMAT(data_ultima_alteracao,'%d/%m/%Y') as data_ultima_alteracao,
											usuario_inclusao, 
											usuario_ultima_alteracao 
										FROM 
											".$schema.".cad_documento 
											
										WHERE
											cod_empresa='".$_SESSION['cod_empresa']."' ";
										
								if ($_POST['cod_documento']!=""){ $select=$select. "and `cod_documento` = '".$_POST['cod_documento']."'";}
								if ($_POST['referencia']!=""){ $select=$select. "and `referencia` = '".$_POST['referencia']."'";}
								if ($_POST['texto_cabecalho_documento']!=""){ $select=$select. "and `texto_cabecalho_documento` = '".$_POST['texto_cabecalho_documento']."'";}
								if ($_POST['historico']!=""){ $select=$select. "and `historico` = '".$_POST['historico']."'";}
								if ($_POST['exercicio']!=""){ $select=$select. "and `exercicio` = '".$_POST['exercicio']."'";}
								if ($_POST['periodo']!=""){ $select=$select. "and `periodo` = '".$_POST['periodo']."'";}
								if ($_POST['data_lancamento_de']!="01/01/1900" || $_POST['data_lancamento_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.`cad_cartas`.`data_cancelamento` between '".data($_POST['data_lancamento_de'])."' and '".data($_POST['data_lancamento_ate'])."')";}
								if ($_POST['data_inclusao_de']!="01/01/1900" || $_POST['data_inclusao_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.cad_documento.`data_inclusao` between '".data($_POST['data_inclusao_de'])." 00:00:00' and '".data($_POST['data_inclusao_ate'])." 23:59:59')";}
								if ($_POST['data_base_de']!="01/01/1900" || $_POST['data_base_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.`cad_cartas`.`data_cancelamento` between '".data($_POST['data_base_de'])."' and '".data($_POST['data_base_ate'])."')";}
								if ($_POST['data_estorno_de']!="01/01/1900" || $_POST['data_estorno_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.`cad_cartas`.`data_cancelamento` between '".data($_POST['data_estorno_de'])."' and '".data($_POST['data_estorno_ate'])."')";}
								if ($_POST['data_alteracao_de']!="01/01/1900" || $_POST['data_alteracao_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.`cad_cartas`.`data_cancelamento` between '".data($_POST['data_alteracao_de'])."' and '".data($_POST['data_alteracao_ate'])."')";}

											
								$select.= ";";
									
								$pesquisa=new pesquisa;
								$json=$pesquisa->json($select);
							

								$column ="{headerText: 'ID', key: 'id', width: '50px',  dataType: 'string'},";
								$column.="{headerText: 'cod_documento', key: 'cod_documento', width: '100px',  dataType: 'string'},";
								$column.="{headerText: 'cod_tipo_documento', key: 'cod_tipo_documento', width: '50px',  dataType: 'string'},";
								$column.="{headerText: 'referencia', key: 'referencia', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'texto_cabecalho_documento', key: 'texto_cabecalho_documento',  dataType: 'string'},";
								$column.="{headerText: 'data_lancamento', key: 'data_lancamento', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'data_inclusao', key: 'data_inclusao', width: '150px',  dataType: 'string'},";				
								$column.="{headerText: 'data_base', key: 'data_base', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'data_estorno', key: 'data_estorno', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'exercicio', key: 'exercicio', width: '100px',  dataType: 'string'},";
								$column.="{headerText: 'periodo', key: 'periodo', width: '50px',  dataType: 'string'},";




								$tabela="cad_documento";
								$combo="";
								
								
								$igniteui=new igniteui;
								echo $igniteui->igrid($json,$column,$tabela,$combo,$_GET['id']);

						}
						
					echo "</div>";
				echo "</div>";

		//var_dump($_POST);
	}
	function periodo(){
		include "config.php";
		$select="SELECT max(data_fim) as data_fim FROM ".$schema.".cad_periodo WHERE cod_empresa='".$_SESSION['cod_empresa']."' ";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$valores = mysql_fetch_array($resultado);
		 return $valores;
		
	}
	function periodo_aberto(){
		include "config.php";
		$select="
			SELECT 
				min(data_inicio) as data_inicio,
				tb_max.data_fim
				
			FROM 
				".$schema.".cad_periodo,
				(
					SELECT 
						max(data_fim) as data_fim 
					FROM 
						".$schema.".cad_periodo 
					where 
						cod_empresa=".$_SESSION['cod_empresa']." and status='ativa'
				) as tb_max
			where 
					cod_empresa=".$_SESSION['cod_empresa']." 
				and status='ativa'
				and tb_max.data_fim=cad_periodo.data_fim;";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$valores = mysql_fetch_array($resultado);
		 return $valores;
		
	}
	function razao($id){

				echo "<div class='uk-grid ' style=' '>";			
					echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
						echo "<div class='uk-offcanvas-bar'>";
							$relatorios= new relatorios;
							$relatorios->filtros(5);	
							
						echo "</div>";
					echo "</div>";
					echo "<div class=' uk-width-1-1    ' style='overflow: auto; padding-left: 10px;'>";
						if(isset($_POST)==true and $_POST!=null){
							include "config.php";		
								
							$select= "
									SELECT 
										cad_documento.cod_documento as id, 
										cad_documento.cod_documento, 
										cad_documento.referencia, 
										cad_documento.texto_cabecalho_documento, 
										DATE_FORMAT(cad_documento.data_lancamento,'%d/%m/%Y') as data_lancamento, 
										DATE_FORMAT(cad_documento.data_base,'%d/%m/%Y') as data_base, 
										DATE_FORMAT(cad_documento.data_estorno,'%d/%m/%Y') as data_estorno, 
										cad_documento.exercicio,
										cad_documento.periodo, 
										cad_documento.historico, 
										DATE_FORMAT(cad_documento.data_inclusao,'%d/%m/%Y') as data_inclusao, 
										cad_documento_item.codigo_lancamento,
										if(cad_documento_item.codigo_lancamento='D',replace(cad_documento_item.montante,'.',','),0) as debito,
										if(cad_documento_item.codigo_lancamento='C',replace(cad_documento_item.montante,'.',','),0) as credito,
										cad_documento_item.cod_conta,
										concat('#',cad_conta.numero_conta) as numero_conta,
										cad_conta.descricao as conta,
										cad_documento_item.cod_ctr_custo,
										concat('#',cad_centro_custo.numero_centro_custo) as numero_centro_custo,
										cad_centro_custo.descricao as centro_custo
									
									FROM 
										".$schema.".cad_documento,
										".$schema.".cad_documento_item,
										".$schema.".cad_conta,
										".$schema.".cad_centro_custo
									
									WHERE 
										cad_documento.cod_documento=cad_documento_item.cod_documento and 
										cad_documento_item.cod_conta=cad_conta.cod_conta and
										cad_documento_item.cod_ctr_custo=cad_centro_custo.cod_centro_custo and
										cad_documento.cod_empresa='".$_SESSION['cod_empresa']."' ";					
										
										
							if ($_POST['cod_documento']!=""){ $select=$select. "and ".$schema.".cad_documento.`cod_documento` = '".$_POST['cod_documento']."'";}
							if ($_POST['referencia']!=""){ $select=$select. "and ".$schema.".cad_documento.`referencia` = '".$_POST['referencia']."'";}
							if ($_POST['texto_cabecalho_documento']!=""){ $select=$select. "and ".$schema.".cad_documento.`texto_cabecalho_documento` = '".$_POST['texto_cabecalho_documento']."'";}
							if ($_POST['historico']!=""){ $select=$select. "and ".$schema.".cad_documento.`historico` = '".$_POST['historico']."'";}
							if ($_POST['exercicio']!=""){ $select=$select. "and ".$schema.".cad_documento.`exercicio` = ".$_POST['exercicio']." ";}
							if ($_POST['periodo']!=""){ $select=$select. "and ".$schema.".cad_documento.`periodo` = ".$_POST['periodo']." ";}
							if ($_POST['data_lancamento_de']!="01/01/1900" || $_POST['data_lancamento_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.cad_documento.`data_lancamento` between '".data($_POST['data_lancamento_de'])."' and '".data($_POST['data_lancamento_ate'])."')";}
							if ($_POST['data_inclusao_de']!="01/01/1900" || $_POST['data_inclusao_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.cad_documento.`data_inclusao` between '".data($_POST['data_inclusao_de'])." 00:00:00' and '".data($_POST['data_inclusao_ate'])." 23:59:59')";}
							if ($_POST['data_base_de']!="01/01/1900" || $_POST['data_base_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.cad_documento.`data_base` between '".data($_POST['data_base_de'])."' and '".data($_POST['data_base_ate'])."')";}
							if ($_POST['data_estorno_de']!="01/01/1900" || $_POST['data_estorno_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.cad_documento.`data_estorno` between '".data($_POST['data_estorno_de'])."' and '".data($_POST['data_estorno_ate'])."')";}
							if ($_POST['data_alteracao_de']!="01/01/1900" || $_POST['data_alteracao_ate']!="01/01/9999"){ $select=$select. "and (`".$schema."`.cad_documento.`data_alteracao` between '".data($_POST['data_alteracao_de'])."' and '".data($_POST['data_alteracao_ate'])."')";}
							if ($_POST['numero_ctr_custo']!=""){ $select=$select. "and  cad_centro_custo.numero_centro_custo='".$_POST['numero_ctr_custo']."'";}
							if ($_POST['numero_conta']!=""){ $select=$select. "and  cad_conta.numero_conta='".$_POST['numero_conta']."'";}
						
										
							$select.= ";";
								
							$pesquisa=new pesquisa;
							$json=$pesquisa->json($select);
							
							//echo $select;

								$column ="{headerText: 'ID', key: 'id', width: '50px',  dataType: 'string'},";
								$column.="{headerText: 'referencia', key: 'referencia', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'texto_cabecalho_documento', key: 'texto_cabecalho_documento', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'data_lancamento', key: 'data_lancamento', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'data_inclusao', key: 'data_inclusao', width: '150px',  dataType: 'string'},";				
								$column.="{headerText: 'data_base', key: 'data_base', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'data_estorno', key: 'data_estorno', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'exercicio', key: 'exercicio', width: '80px',  dataType: 'string'},";
								$column.="{headerText: 'periodo', key: 'periodo', width: '50px',  dataType: 'string'},";
								$column.="{headerText: 'debito', key: 'debito', width: '150px',  dataType: 'number'},";
								$column.="{headerText: 'credito', key: 'credito', width: '150px',  dataType: 'number'},";
								$column.="{headerText: 'numero_conta', key: 'numero_conta', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'conta', key: 'conta', width: '250px',  dataType: 'string'},";
								$column.="{headerText: 'numero_centro_custo', key: 'numero_centro_custo', width: '150px',  dataType: 'string'},";
								$column.="{headerText: 'centro_custo', key: 'centro_custo', width: '250px',  dataType: 'string'},";

								$tabela="cad_documento";
								$combo="";
								

								$igniteui=new igniteui;
								echo $igniteui->igrid($json,$column,$tabela,$combo,$_GET['id']);

						}
					echo "</div>";
				echo "</div>";
	
	

		

		
		
		//var_dump($_POST);
	}
	
}

class lancamento{
	function listar_cad_documento_item($cod_documento){
		/////////////////////////////////////////////////////////////////////////////
	
		function tbody($codigo_lancamento,$cod_ctr_custo,$cod_conta,$historico,$montante,$data_vencimento_liquidacao){

				if(intval($_GET['id'])>0){
					$disabled=" disabled ";
				}else{
					$disabled="  ";
					
				}

		return "<tr id='rowToClone'>
						<td class='uk-form-row' style='width: 20px;'>
							<input ".$disabled." coluna='codigo_lancamento' id='codigo_lancamento' placeholder='' onchange='calcular_total_debito_credito();' onkeyup='calcular_total_debito_credito();' class='uk-form-small' type='text' style='width: 100%;' value='".$codigo_lancamento."'></td>
						<td class='uk-form-row' style='width: 150px;'>
							<div class='uk-autocomplete uk-form' data-uk-autocomplete='{source:bs_ctrcusto}' style='width: 100%;'>
								<input ".$disabled." coluna='cod_ctr_custo' id='cod_ctr_custo' placeholder='' class='uk-form-small' type='text' style='width: 100%;' value='".$cod_ctr_custo."'>
							</div>
						</td>
						<td class='uk-form-row' style='width: 150px;'>
							<div class='uk-autocomplete uk-form' data-uk-autocomplete='{source:bs_conta}' style='width: 100%;'>
								<input ".$disabled." coluna='cod_conta' id='cod_conta' placeholder='' class='uk-form-small' type='text' style='width: 100%;' value='".$cod_conta."'>
							</div>
						</td>
						<td class='uk-form-row' style='min-width: 100px; '><input ".$disabled." coluna='historico_' id='historico_' placeholder='' class='uk-form-small' type='text' style='width: 100%;' value='".$historico."'></td>
						<td class='uk-form-row' style='width: 100px;'><input ".$disabled." coluna='montante' id='montante' placeholder='' class='uk-form-small' type='text' style='width: 100%;text-align: right;' onchange='formatar_numero(this);calcular_total_debito_credito();' onkeyup='formatar_numero(this);calcular_total_debito_credito();' value='".$montante."'></td>
						<td class='uk-form-row' style='width: 100px;'><input ".$disabled." coluna='data_vencimento_liquidacao' id='data_vencimento_liquidacao' placeholder='' class='uk-form-small' type='text' style='width: 100%;' onchange='formatar_data(this);' onkeyup='formatar_data(this);' value='".$data_vencimento_liquidacao."'></td>
						<td class='uk-form-row' style='width: 10px;'>
							<button ".$disabled." class='uk-button uk-button-mini uk-button-danger' type='button' onclick='delRow(this)' data-uk-tooltip title='Excluir linha'><i class='uk-icon-trash-o'></i></button>
						</td>
					</tr>";
		}
		if(intval($_GET['id'])>0){
			$tbody="";
		}else{
			$tbody=tbody('','' ,'','','','');
			
		}
		
		include "config.php";
		$select = "
					SELECT 
							cad_documento_item.cod_documento_item, 
							cad_documento_item.cod_documento, 
							cad_documento_item.numero_item, 
							cad_documento_item.codigo_lancamento,
							
							concat(cad_conta.numero_conta,' - ', cad_conta.descricao) as cod_conta,
							concat(cad_centro_custo.numero_centro_custo,' - ', cad_centro_custo.descricao) as cod_ctr_custo,

							
							montante, 
							historico, 

							DATE_FORMAT(data_vencimento_liquidacao,'%d/%m/%Y') as data_vencimento_liquidacao,
							cod_documento_compensacao
					 FROM 
						".$schema.".cad_documento_item, 
						".$schema.".cad_conta,
						".$schema.".cad_centro_custo 
						
						where 
							cad_documento_item.cod_conta=cad_conta.cod_conta and
							cad_documento_item.cod_ctr_custo=cad_centro_custo.cod_centro_custo and
							cod_documento='".$cod_documento."'  and cad_documento_item.cod_empresa=".$_SESSION['cod_empresa']." ; ";
							
							
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		while($row = mysql_fetch_array($resultado))
		{
			$tbody.=tbody($row['codigo_lancamento'],$row['cod_ctr_custo'] ,$row['cod_conta'] ,$row['historico'] ,$row['montante'] ,$row['data_vencimento_liquidacao'] );
		}	
	
	
	
	
			echo	" <div>
						<script>";
							$selects=new selects;
							$selects-> ctrcusto_autocomplete('');

			echo		"</script>
						<script>";
							$selects=new selects;
							$selects-> conta_autocomplete('');

			echo		"</script>
					</div>
					<div class='uk-form'>
						<table class='uk-table uk-table-hover uk-table-condensed' id='tableToModify'>
							<thead>
								<tr>
									<th style='width: 20px;'>CL</th>
									<th style='width: 150px;'>Ctr. Custo</th>
									<th style='width: 150px;'>Conta</th>
									<th style='min-width: 100px;'>Descrição</th>
									<th style='width: 100px;'>Valor</th>
									<th style='width: 100px;'>Vencimento</th>
									<th style='width: 10px;'></th>
								</tr>
							</thead>
				<tbody>
					".$tbody."
				</tbody>
			</table>
	</div>
	
	";
		
		
		
		
		
		
		/////////////////////////////////////////////////////////////////////////////
		
		
		
		
		
		
		
		
		
		
		
		
	}


}

class relatorios{
	function filtros($tipo){
		$inputs=new inputs;
		$selects=new selects;
		if($tipo==1){

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

		}
		if($tipo==2){
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
											<input type='radio' name='relatorio' value='conta' checked> Conta Contábil
										</div>
										<div class='uk-width-1-2'>
											<input type='radio' name='relatorio' value='centro_custo'> Centro de Custo
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
		
		}
		if($tipo==3){
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
		
		}
		if($tipo==4){
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
		
		}
		if($tipo==5){

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

		}

	
	}
	function razao_conta(){
		echo "<div class='uk-grid ' style=' '>";			
			echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
				echo "<div class='uk-offcanvas-bar'>";
					$this->filtros(2);	
				echo "</div>";
			echo "</div>";
			echo "<div class=' uk-width-1-1    ' style=''>";		
			if(isset($_POST) and isset($_POST['data_inicio']) and isset($_POST['data_fim']) and isset($_POST['conta_inicio']) and isset($_POST['conta_fim']) and isset($_POST['ctr_custo_inicio']) and isset($_POST['ctr_custo_fim'])){			
			
				//set variables 
				$table=new table;
				$table->select=$this->razao_conta_consulta_sql();
				$table->group_by=$_POST['relatorio'];
				$table->caption=array(
					'titulo'=>"Livro Razão de ".$_POST['data_inicio']." a ".$_POST['data_fim'].", agrupado por ".$_POST['relatorio']." ",
					'razao_social'=>$_SESSION['razao_social'],
					'cnpj'=>$_SESSION['cnpj']
				);
				$table->thead=array(
					1=>array('style'=>'width: 1.5cm;','label'=>'Data'),
					2=>array('style'=>'','label'=>'Histórico'),
					3=>array('style'=>'width: 2.0cm;','label'=>'Lançamento'),
					4=>array('style'=>'width: 2.0cm; text-align: center !important;','label'=>'Documento'),
					5=>array('style'=>'width: 2.0cm; text-align: right !important;','label'=>'Débito'),
					6=>array('style'=>'width: 2.0cm; text-align: right !important;','label'=>'Crédito'),
					7=>array('style'=>'width: 2.0cm; text-align: right !important;','label'=>'Saldo'),
					8=>array('style'=>'width: 0.5cm; text-align: left !important;','label'=>'')
				);
				$table->tbody=array(
					1=>array('formato'=>'data','style'=>'','campo'=>'data'),
					2=>array('formato'=>'','style'=>'','campo'=>'historico'),
					3=>array('formato'=>'','style'=>'text-align: center !important;','campo'=>'lancamento'),
					4=>array('formato'=>'','style'=>'text-align: center !important;','campo'=>'documento'),
					5=>array('formato'=>'decimal','style'=>'text-align: right !important;','campo'=>'debito'),
					6=>array('formato'=>'decimal','style'=>'text-align: right !important;','campo'=>'credito'),
					7=>array('formato'=>'decimal','style'=>'text-align: right !important;','campo'=>'saldo'),
					8=>array('formato'=>'','style'=>'','campo'=>'DC')
				);
				echo $table->criar();
			}
		

			
			echo "</div>";
		echo "</div>";
		

		
	}
	function razao_conta_consulta_sql(){
				include "config.php";
				
				//Construir filtro para o select
				$filtro="";
					
				if($_POST['data_inicio']!="00/00/0000" or $_POST['data_fim']!="00/00/0000"){
					$filtro.="  and ( cad_documento.data_base between '".data($_POST['data_inicio'])."' and '".data($_POST['data_fim'])."' )";
				}
				if($_POST['conta_inicio']!="" or $_POST['conta_fim']!=""){
					$filtro.="  and ( novo_numero_conta between '".numero_conta_limpo($_POST['conta_inicio'])."' and '".numero_conta_limpo($_POST['conta_fim'])."' )";
				}
				if($_POST['ctr_custo_inicio']!="" or $_POST['ctr_custo_fim']!=""){
					$filtro.="  and ( novo_numero_centro_custo between '".numero_centro_custo_limpo($_POST['ctr_custo_inicio'])."' and '".numero_centro_custo_limpo($_POST['ctr_custo_fim'])."' )";
				}
				if($_POST['relatorio']!="" and $_POST['relatorio']=="conta"){
					$group_by="conta";

				}else{
					$group_by="centro_custo";

				}
				
				//select mysql
				$select="
						SELECT 
							cod_documento_item,
							cad_documento.data_base as data,
							cad_documento_item.historico,
							cad_documento.cod_documento as lancamento,
							cad_documento.referencia as documento,
							cad_documento_item.cod_conta,
							cad_documento_item.cod_ctr_custo,
							cad_documento_item.montante,
							
							if(cad_documento_item.codigo_lancamento='D',cad_documento_item.montante,0) as debito,
							if(cad_documento_item.codigo_lancamento='C',cad_documento_item.montante,0) as credito,

							cad_documento_item.codigo_lancamento,
							cad_documento_item.codigo_lancamento as DC,
							'0' as saldo,

							concat(cad_conta.numero_conta,' - ',cad_conta.descricao) as conta,
							concat(cad_centro_custo.numero_centro_custo,' - ',cad_centro_custo.descricao) as centro_custo,

							cad_conta.numero_conta,
							tb_novo_numero_conta.novo_numero_conta,

							cad_centro_custo.numero_centro_custo,
							tb_novo_numero_centro_custo.novo_numero_centro_custo,

							tb_saldo_inicial_conta.saldo_ini_conta as saldo_inicial_conta,
							tb_saldo_inicial_centro_custo.saldo_ini_centro_custo as saldo_inicial_centro_custo


						FROM 
							".$schema.".cad_documento_item,
							".$schema.".cad_documento,
							".$schema.".cad_conta,
							".$schema.".cad_centro_custo,
							(SELECT cod_conta,1*concat(replace(numero_conta,'.',''),REPEAT('0',tb_lr_max.lr_max-length(replace(numero_conta,'.','')))) as novo_numero_conta FROM ".$schema.".cad_conta, (SELECT max(length(replace(numero_conta,'.',''))) as lr_max FROM ".$schema.".cad_conta where cod_empresa='".$_SESSION['cod_empresa']."') as tb_lr_max where cod_empresa='".$_SESSION['cod_empresa']."') as tb_novo_numero_conta,
							(SELECT cod_centro_custo,1*concat(replace(numero_centro_custo,'.',''),REPEAT('0',tb_lr_max.lr_max-length(replace(numero_centro_custo,'.','')))) as novo_numero_centro_custo FROM ".$schema.".cad_centro_custo, (SELECT max(length(replace(numero_centro_custo,'.',''))) as lr_max FROM ".$schema.".cad_centro_custo where cod_empresa='".$_SESSION['cod_empresa']."') as tb_lr_max where cod_empresa='".$_SESSION['cod_empresa']."') as tb_novo_numero_centro_custo,
							(
										SELECT 
											cad_conta.cod_conta,
											(saldo_inicial+if (total>0,total,0)) as saldo_ini_conta
										 FROM 
											".$schema.".cad_conta
										left join
											(
												SELECT 
													cod_conta,
													sum(montante*if(cad_documento_item.codigo_lancamento='D',1,-1)) as total
												FROM 
													".$schema.".cad_documento_item,
													".$schema.".cad_documento
												where
													cad_documento.cod_documento=cad_documento_item.cod_documento and
													cad_documento.cod_empresa='".$_SESSION['cod_empresa']."' and
													cad_documento.data_base<'".data($_POST['data_inicio'])."'												
												group by 
													cod_conta
											) as tb_movimento_conta on cad_conta.cod_conta=tb_movimento_conta.cod_conta
							) as tb_saldo_inicial_conta,						
							(
										SELECT 
											cad_centro_custo.cod_centro_custo,
											if (total>0,total,0) as saldo_ini_centro_custo
										 FROM 
											".$schema.".cad_centro_custo
										left join
											(
												SELECT 
													cod_ctr_custo as cod_centro_custo,
													sum(montante*if(cad_documento_item.codigo_lancamento='D',1,-1)) as total
												FROM 
													".$schema.".cad_documento_item,
													".$schema.".cad_documento
												where
													cad_documento.cod_documento=cad_documento_item.cod_documento and
													cad_documento.cod_empresa='".$_SESSION['cod_empresa']."' and
													cad_documento.data_base<'".data($_POST['data_inicio'])."'												
												group by 
													cod_centro_custo
											) as tb_movimento_centro_custo on cad_centro_custo.cod_centro_custo=tb_movimento_centro_custo.cod_centro_custo
							) as tb_saldo_inicial_centro_custo						
							

						where
							cad_documento_item.cod_documento=cad_documento.cod_documento and
							cad_documento_item.cod_conta=cad_conta.cod_conta and
							cad_documento_item.cod_conta=tb_novo_numero_conta.cod_conta and
							cad_documento_item.cod_ctr_custo=cad_centro_custo.cod_centro_custo and
							cad_documento_item.cod_ctr_custo=tb_novo_numero_centro_custo.cod_centro_custo and
							cad_documento_item.cod_conta=tb_saldo_inicial_conta.cod_conta and
							cad_documento_item.cod_ctr_custo=tb_saldo_inicial_centro_custo.cod_centro_custo
							".$filtro."
							

						order by
							".$group_by.", data,cad_documento.cod_documento,codigo_lancamento

				";
				
				return $select;
		
	}
	function livro_diario(){
		echo "<div class='uk-grid ' style=' '>";			
			echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
				echo "<div class='uk-offcanvas-bar'>";
					$this->filtros(3);	
				echo "</div>";
			echo "</div>";
			echo "<div class=' uk-width-1-1    ' style=''>";	
			if(isset($_POST) and isset($_POST['data_inicio']) and isset($_POST['data_fim']) and isset($_POST['conta_inicio']) and isset($_POST['conta_fim']) and isset($_POST['ctr_custo_inicio']) and isset($_POST['ctr_custo_fim'])){			
			
				//set variables 
				$table=new table;
				$table->select=$this->livro_diario_consulta_sql();
				$table->group_by='data';
				$table->caption=array(
					'titulo'=>"Livro Diário de ".$_POST['data_inicio']." a ".$_POST['data_fim']." ",
					'razao_social'=>$_SESSION['razao_social'],
					'cnpj'=>$_SESSION['cnpj']
				);
				$table->thead=array(
					1=>array('style'=>'','label'=>'Conta'),
					2=>array('style'=>'','label'=>'Histórico'),
					3=>array('style'=>'width: 2.0cm; text-align: center !important;','label'=>'Documento'),
					4=>array('style'=>'width: 2.0cm; text-align: right !important;','label'=>'Débito'),
					5=>array('style'=>'width: 2.0cm; text-align: right !important;','label'=>'Crédito')

				);
				$table->tbody=array(
					1=>array('formato'=>'','style'=>'','campo'=>'conta'),
					2=>array('formato'=>'','style'=>'','campo'=>'historico'),
					3=>array('formato'=>'','style'=>'text-align: center !important;','campo'=>'documento'),
					4=>array('formato'=>'decimal','style'=>'text-align: right !important;','campo'=>'debito'),
					5=>array('formato'=>'decimal','style'=>'text-align: right !important;','campo'=>'credito')
				);
				echo $table->criar();
			}

			echo "</div>";	
		echo "</div>";	
			
			
		

		
	}
	function livro_diario_consulta_sql(){
			include "config.php";
					
				//Construir filtro para o select
				$filtro="";
				if($_POST['data_inicio']!="00/00/0000" or $_POST['data_fim']!="00/00/0000"){
					$filtro.="  and ( cad_documento.data_base between '".data($_POST['data_inicio'])."' and '".data($_POST['data_fim'])."' )";
				}
				if($_POST['conta_inicio']!="" or $_POST['conta_fim']!=""){
					$filtro.="  and ( novo_numero_conta between '".numero_conta_limpo($_POST['conta_inicio'])."' and '".numero_conta_limpo($_POST['conta_fim'])."' )";
				}
				if($_POST['ctr_custo_inicio']!="" or $_POST['ctr_custo_fim']!=""){
					$filtro.="  and ( novo_numero_centro_custo between '".numero_centro_custo_limpo($_POST['ctr_custo_inicio'])."' and '".numero_centro_custo_limpo($_POST['ctr_custo_fim'])."' )";
				}
			
			
				include "config.php";
				$select="
						SELECT 
							DATE_FORMAT(cad_documento.data_base,'%d/%m/%Y') as data,
							cad_documento_item.historico,
							cad_documento.cod_documento as lancamento,
							cad_documento.referencia as documento,
							cad_documento_item.montante,
							
							if(cad_documento_item.codigo_lancamento='D',cad_documento_item.montante,0) as debito,
							if(cad_documento_item.codigo_lancamento='C',cad_documento_item.montante,0) as credito,
							
							cad_documento_item.codigo_lancamento,

							concat(cad_conta.numero_conta,' - ',cad_conta.descricao) as conta,
							concat(cad_centro_custo.numero_centro_custo,' - ',cad_centro_custo.descricao) as centro_custo,

							cad_conta.numero_conta,
							tb_novo_numero_conta.novo_numero_conta,

							cad_centro_custo.numero_centro_custo,
							tb_novo_numero_centro_custo.novo_numero_centro_custo


						FROM 
							".$schema.".cad_documento_item,
							".$schema.".cad_documento,
							".$schema.".cad_conta,
							".$schema.".cad_centro_custo,
							(SELECT cod_conta,1*concat(replace(numero_conta,'.',''),REPEAT('0',tb_lr_max.lr_max-length(replace(numero_conta,'.','')))) as novo_numero_conta FROM ".$schema.".cad_conta, (SELECT max(length(replace(numero_conta,'.',''))) as lr_max FROM ".$schema.".cad_conta where cod_empresa='".$_SESSION['cod_empresa']."') as tb_lr_max where cod_empresa='".$_SESSION['cod_empresa']."') as tb_novo_numero_conta,
							(SELECT cod_centro_custo,1*concat(replace(numero_centro_custo,'.',''),REPEAT('0',tb_lr_max.lr_max-length(replace(numero_centro_custo,'.','')))) as novo_numero_centro_custo FROM ".$schema.".cad_centro_custo, (SELECT max(length(replace(numero_centro_custo,'.',''))) as lr_max FROM ".$schema.".cad_centro_custo where cod_empresa='".$_SESSION['cod_empresa']."') as tb_lr_max where cod_empresa='".$_SESSION['cod_empresa']."') as tb_novo_numero_centro_custo


						where
							cad_documento_item.cod_documento=cad_documento.cod_documento and
							cad_documento_item.cod_conta=cad_conta.cod_conta and
							cad_documento_item.cod_conta=tb_novo_numero_conta.cod_conta and
							cad_documento_item.cod_ctr_custo=cad_centro_custo.cod_centro_custo and
							cad_documento_item.cod_ctr_custo=tb_novo_numero_centro_custo.cod_centro_custo 
							".$filtro."
							
							
						order by
							data_base,cad_documento.cod_documento,codigo_lancamento
				";
					
				return $select;
		
	}
	function balancete(){
		echo "<div class='uk-grid ' style=' '>";			
			echo "<div class=' uk-offcanvas' id='div_filtro'  style=''>";			
				echo "<div class='uk-offcanvas-bar'>";
					$this->filtros(4);	
				echo "</div>";
			echo "</div>";
			echo "<div class=' uk-width-1-1    ' style=''>";	
			if(isset($_POST) and isset($_POST['data_inicio']) and isset($_POST['data_fim']) ){			
			
				//set variables 
				$table=new table;
				$table->select=$this->balancete_consulta_sql();
				$table->caption=array(
					'titulo'=>"Balancete Analítico ".$_POST['data_inicio']." a ".$_POST['data_fim']." ",
					'razao_social'=>$_SESSION['razao_social'],
					'cnpj'=>$_SESSION['cnpj']
				);
				
			$pesquisa=new pesquisa;


			$column="{headerText: 'conta', key: 'conta', width: '350px', dataType: 'string'},";
			$column.="{headerText: 'Saldo inicial', key: 'saldo_inicial',width: '100px',  dataType: 'number'},";
			$column.="{headerText: 'Débito', key: 'debito',width: '100px',  dataType: 'number'},";
			$column.="{headerText: 'Crédito', key: 'credito',width: '100px',  dataType: 'number'},";
			$column.="{headerText: 'Saldo Final', key: 'saldo_final',width: '100px',  dataType: 'number'}";


			$table->column=$column;
			
			$table->tabela="cad_conta";
				


				
				///////////////////////////////////
				
		//montar caption
				$caption="
					<div style=''>
						<div class='uk-grid'>
							<div class='uk-width-1-1'>".$table->caption['razao_social']."</div>
							<div class='uk-width-1-1'>".$table->caption['cnpj']."</div>
							<div class='uk-width-1-1'>
								<div class='uk-grid'>
									<div class='uk-width-3-5'>".$table->caption['titulo']."</div>
									<div class='uk-width-1-5'>Livro:xxx</div>
									<div class='uk-width-1-5'>Folha:xxx</div>
								</div>
							</div>
						</div>
					</div>					
				";			
			
			//finalizar tabela
				echo "<div id='relatorio' style='width: 21.0cm;height:29.7cm; padding: 1.5cm 0.5cm;  font-family: times ! important; color: rgb(0, 0, 0) ! important;'>";
				echo $caption;
				echo $table->TreeGrid();
				echo "</div>";					
				
				///////////////////////////////////
				
				
				
				
			}
		
		
			echo "</div>";			
		echo "</div>";			
			
			
	
			//echo $table->select;
		
	}
	function balancete_consulta_sql(){
				include "config.php";
				
				//select mysql
				$select="
					select 
						tb_grid.*,
						REPLACE(REPLACE(REPLACE(FORMAT(sum(tb_grid2.saldo_inicial),2),'.','|'),',','.'),'|',',') as saldo_inicial,
						REPLACE(REPLACE(REPLACE(FORMAT(sum(tb_grid2.debito),2),'.','|'),',','.'),'|',',') as debito,
						REPLACE(REPLACE(REPLACE(FORMAT(sum(tb_grid2.credito),2),'.','|'),',','.'),'|',',') as credito,
						REPLACE(REPLACE(REPLACE(FORMAT(sum(tb_grid2.saldo_final),2),'.','|'),',','.'),'|',',') as saldo_final
						

					 from

					 (
									SELECT 
										cad_conta.cod_conta as ID,
										if(cad_conta.cod_conta_mae=0,-1,cad_conta.cod_conta_mae) as PID,
										concat('#',cad_conta.numero_conta,' - ',cad_conta.descricao) as conta,
										concat(REPLACE(cad_conta.numero_conta,'.',''),repeat(0,20-length(REPLACE(cad_conta.numero_conta,'.','')))) as conta_ini,
										concat(REPLACE(cad_conta.numero_conta,'.',''),repeat(9,20-length(REPLACE(cad_conta.numero_conta,'.','')))) as conta_fim

									FROM 
										".$schema.".cad_conta

									WHERE
										cod_plano_conta='1' 

									ORDER BY
										cad_conta.cod_conta




					) as tb_grid


					,(
									SELECT 
										cad_conta.cod_conta as ID,
										if(cad_conta.cod_conta_mae=0,-1,cad_conta.cod_conta_mae) as PID,
										concat('#',cad_conta.numero_conta,' - ',cad_conta.descricao) as conta,


										concat(REPLACE(cad_conta.numero_conta,'.',''),repeat(0,20-length(REPLACE(cad_conta.numero_conta,'.','')))) as conta_ini,
										concat(REPLACE(cad_conta.numero_conta,'.',''),repeat(9,20-length(REPLACE(cad_conta.numero_conta,'.','')))) as conta_fim,


										IFNULL(cad_conta.saldo_inicial,0) + IFNULL(tb_saldo_inicial.saldo_inicial,0) as saldo_inicial,
										IFNULL(tb_movimento.debito,0) as debito,
										IFNULL(tb_movimento.credito,0) as credito,
										IFNULL(cad_conta.saldo_inicial,0) + IFNULL(tb_saldo_inicial.saldo_inicial,0)+IFNULL(tb_movimento.debito,0)-IFNULL(tb_movimento.credito,0) as saldo_final

									FROM 
										".$schema.".cad_conta,
										(
													SELECT 
														cad_conta.cod_conta,
														tb_saldo.saldo_inicial

													FROM 
														".$schema.".cad_conta
													left join (
														SELECT 
															cod_conta,
															sum(montante*if(codigo_lancamento='D',1,-1)) as saldo_inicial
														FROM 
															".$schema.".cad_documento_item,
															".$schema.".cad_documento
														where 
															cad_documento_item.cod_empresa='".$_SESSION['cod_empresa']."' and
															cad_documento.data_base<'".data($_POST['data_inicio'])."' and
															cad_documento.cod_empresa='".$_SESSION['cod_empresa']."'
														group by 
															cod_conta
													) as tb_saldo on tb_saldo.cod_conta=cad_conta.cod_conta

												) as tb_saldo_inicial,
										(
													SELECT 
														cad_conta.cod_conta,
														tb_mov.debito,
														tb_mov.credito

													FROM 
														".$schema.".cad_conta
													left join (
																SELECT 
																	cod_conta,
																	sum(if(codigo_lancamento='D',montante,0)) as debito,
																	sum(if(codigo_lancamento='C',montante,0)) as credito
																FROM 
																	".$schema.".cad_documento_item,
																	".$schema.".cad_documento
																where 
																	cad_documento_item.cod_documento=cad_documento.cod_documento and
																	cad_documento_item.cod_empresa='".$_SESSION['cod_empresa']."' and															
																	cad_documento.data_base>='".data($_POST['data_inicio'])."' and
																	cad_documento.data_base<='".data($_POST['data_fim'])."' and
																	cad_documento.cod_empresa='".$_SESSION['cod_empresa']."'
																group by 
																	cod_conta
													) as tb_mov on tb_mov.cod_conta=cad_conta.cod_conta

												) as tb_movimento


									WHERE
										cod_plano_conta='".$_SESSION['cod_empresa']."' and
										tb_saldo_inicial.cod_conta=cad_conta.cod_conta and
										tb_movimento.cod_conta=cad_conta.cod_conta

									ORDER BY
										cad_conta.cod_conta




					) as tb_grid2

					where tb_grid2.conta_ini>=tb_grid.conta_ini and tb_grid2.conta_fim<=tb_grid.conta_fim

					group by tb_grid.ID		

				";
				
				return $select;
		
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
					<caption style='font-size: 12px ! important; font-family: times ! important; color: rgb(0, 0, 0) ! important;'>
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
							<table class='uk-table uk-table-condensed' style='font-size: 12px ! important; font-family: times ! important; color: rgb(0, 0, 0) ! important;'>
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
	function decimal_($valor){
		return number_format((float)$valor, 2, ',', '.');
	}



?>