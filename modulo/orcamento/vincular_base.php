<?php
	session_start();
	
	include "php/php.php";
	include "../dependencias.php";
	include "../php/nav_bar.php";

	$navbar=new navbar;
	$navbar->navbar_modulo('orcamento');


?>

<div class="uk-grid uk-grid-divider" data-uk-grid-match>
    <div class="uk-width-small-1-1 uk-width-medium-1-4 uk-width-large-2-6">
		<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>
			<li class="uk-parent">
				<a href="#"><i class="uk-icon-upload"></i> Upload</a>
				<ul class="uk-nav-sub">
					<li>

						<div class="uk-grid">
							<div >
								<input id="uploaded_base" name="uploaded_base" type="file" accept=".sec3">
							</div>
							<div >
								<button id="bt_upload" data-uk-modal="{target:'#msg_modal'}">Enviar</button>
							</div>
						</div>
					</li>
				</ul>
			</li>

			<li class="uk-parent">
				<a href="#"><i class="uk-icon-database"></i>Base: <span id="span_base"></span> </a>
				
				<ul class="uk-nav-sub uk-overflow-container uk-panel-divider" style="max-height: 300px;">
					<li >
							<?php 
								$tabelas= new tabelas;
								$tabelas-> lista_bases();
							?>
			
					
					</li>
				</ul>
			</li>
			<li class="uk-parent">
				<a href="#"><i class="uk-icon-refresh"></i> Importar e atualizar cadastros</a>
				<ul class="uk-nav-sub">
					<li>
						<ul class="uk-list uk-list-space">
							<li><a href="#" id="bt_importar_centro_custo" ><i class="uk-icon-list"></i> Centros de Custos</a></li>
							<li><a href="#" id="bt_importar_contas_contabeis" ><i class="uk-icon-list"></i> Contas contábeis</a></li>
							<li><a href="#" id="bt_importar_contas_financeiras"><i class="uk-icon-list"></i> Contas financeiras</a></li>
							<li><a href="#" id="bt_importar_lancamentos"><i class="uk-icon-money"></i> Lançamentos</a></li>
						</ul>
						<input type="text" name="schema" id="schema" style=" border: 0px none;visibility: hidden;" readonly>					
					</li>
				</ul>
			</li>
		</ul>
	</div>
    <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-6">
			<h3 class="uk-panel-title">Visualização dos dados:  <span id="span_tabela"></span></h3>
				<div id="visualizador_dados">
				</div>
				<hr class="uk-article-divider">				
				<div id="div_bt_confirmar_importacao">
					<button class="uk-button uk-button-danger" id="bt_confirmar_importacao" disabled>Confirmar e importar</button>
				</div>
	</div>
</div>



<?php
	include "footer.php";


?>