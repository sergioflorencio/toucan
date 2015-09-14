<?php 

	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		
		$salvar=new salvar;
		$salvar->ctrreceita();

	include "php/config.php";

?>
<body>

<!-- sub-menú -->
<div class="uk-grid uk-grid-preserve" style="padding-left: 10px;">
		<div class="uk-width-1-1">
			<form  action="#" method="post" class="uk-form">
					<label>Nível:</label>
					<select id='analitico_sintetico' name='analitico_sintetico' class="uk-form-small">
						<option value=''></option>
						<option value='analitico'>Analítico</option>
						<option value='sintetico'>Sintético</option>
					</select>
					<label>Campo Pai:</label> 
					<?php
						$selects=new selects;
						$selects->select_ctrreceita_campo_pai();
					?>
					<label>Nome:</label>
					<input type='text' id='nome' name='nome'  class="uk-form-small">
				<div class="uk-button-group">
					 <button class="uk-button uk-button-small uk-button-primary">Salvar  <i class="uk-icon-save"></i></button>
					<a href="#" class="uk-button uk-button-small"><i class="uk-icon-print"></i>  Imprimir</a>
				</div>
			</form>
		</div>
</div>
<hr class="uk-article-divider">
<div class="uk-width-medium-1-1 uk-container-center uk-panel uk-panel-divider" >
	<div class="uk-width-1-1 uk-grid uk-panel uk-panel-space ">
			<div class="uk-width-1-1 ">
			<!-- Título -->
				<h3>Cadastro de Centros de Receita</h3>
			</div>
			<div class="uk-width-1-2">
<?php

	echo 
		"<div class='css-treeview'>
			<ul class='uk-list'>";
					
		///Etapa 1
				function createTreeView($array, $currentParent, $currLevel = 0, $prevLevel = -1) {

					foreach ($array as $categoryId => $category) {

						if ($currentParent == $category['nivel_pai']) {
						if ($currLevel > $prevLevel) echo "<ul>";
						if ($currLevel == $prevLevel) echo "</li>";

						//Pasta	
						if ($category['nivel']=='sintetico') {
							echo "<li><i class='uk-icon-caret-right'></i>
									
									<label><b>".$category['nome']."</b></label>
									";
							} 
						else{
							echo "<li><i class='uk-icon-angle-double-right'></i>
									".$category['nome']."
									";
							}

//  1										<image class='icone' src='imagens/edit.png' onclick=popupatualizar('cad_ctrreceitas','nome','cod_ctrreceita','".$category['codigo']."','".str_replace(" ","_",$category['nome'])."');> <image class='icone' src='imagens/delete2.png' onclick=excluirorigem('cad_ctrreceitas','cod_ctrreceita','".$category['codigo']."')>
							
//	2								<image class='icone' src='imagens/delete2.png' onclick=excluirorigem('cad_ctrreceitas','cod_ctrreceita','".$category['codigo']."')>									<image class='icone' src='imagens/edit.png' onclick=popupatualizar('cad_ctrreceitas','nome','cod_ctrreceita','".$category['codigo']."','".str_replace(" ","_",$category['nome'])."');>


						if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }

						$currLevel++; 

						createTreeView ($array, $categoryId, $currLevel, $prevLevel);

						$currLevel--;
						}   

					}

					if ($currLevel == $prevLevel) echo "</li></ul> ";

				}
		///Etapa 2	


						$select="SELECT * FROM ".$schema.".cad_ctrreceitas where status=1;";	
						$resultado=mysql_query($select,$conexao) or die ("nao foi possivel conectar");

						$arrayCategories = array();

						while($row = mysql_fetch_assoc($resultado)){
						 $arrayCategories[$row['cod_ctrreceita']] = array("nivel_pai" => $row['nivel_pai'], "nome" =>$row['nome'], "nivel" =>$row['analitico_sintetico'],"codigo"=>$row['cod_ctrreceita'],"cod_ctrreceita"=>$row['cod_ctrreceita']);
						  }



						if(mysql_num_rows($resultado)!=0)
						{
						createTreeView($arrayCategories, 0); 
						}
	echo "<div>";

	


?>
			
			</div>
			
	</div>
		
</div>


</body>
	<?php } ?>