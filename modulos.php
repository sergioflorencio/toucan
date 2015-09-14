<?php
	session_start();
	include "php/login.php";
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
	


?>
 <head>
	<title>sistema.osuc.org.br</title>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<link rel="stylesheet" href="js/uikit/css/uikit.css" />
	<link rel="stylesheet" href="js/uikit/css/uikit.avenue.css" />
	<link rel="stylesheet" href="js/uikit/css/uikit.theme.css" />
	
	<script src="js/uikit/js/jquery.js"></script>
	<script src="js/uikit/js/uikit.js"></script>
	
 </head>

<?php

	
	$html=new html;
	$html->menu_principal();
	
	$cadastro=new cadastro;
	//$cadastro->cad_usuarios($cod_usuario);	
	//cad_menu($modulo,$cod_menu_pai,$cod_usuario)



?>

 <div class="uk-width-4-5 uk-container-center uk-text-center ">

<div id="div_msg"></div>


						<div class='uk-width-1-1 uk-text-left '>
								<h3>Acessos de módulo</h3>
								<div class="uk-grid">
									<div class='uk-width-medium-1-1 uk-width-small-1-1 uk-width-large-1-1 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Módulos</h4>
											<?php $cadastro->cad_menu('tucan','0'); ?>
										</div>	
									</div>
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Contabilidade</h4>
											<?php $cadastro->cad_menu('contabil','0'); ?>
										</div>	
									</div>
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Orçamento</h4>
											<?php $cadastro->cad_menu('orcamento','0'); ?>
										</div>	
									</div>	
									
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Contribuições</h4>
											<?php $cadastro->cad_menu('contribuicoes','0'); ?>
										</div>	
									</div>
									
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Imobilizado</h4>
											<?php $cadastro->cad_menu('imobilizado','0'); ?>
										</div>	
									</div>
									

							
								</div>	



						</div>





 
 </div>
 
 
<div id="modal_editar_cad_modulo" class="uk-modal">
		<div class="uk-modal-dialog">
			<button type="button" class="uk-modal-close uk-close"></button>
			<div class="uk-modal-header">
				<h2>Informações do módulo</h2>
			</div>
			<div id="div_editar_cad_modulo">
				<form class="uk-form">
				<div class="uk-form-row">
					<label class="uk-form-label" for="" cod_modulo="">label</label>
					<input placeholder="label" class="uk-form-small uk-width-1-1" id='label' name='label' type="text">
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label" for="">href</label>
					<input placeholder="href" class="uk-form-small uk-width-1-1" id='href' name='href' type="text">
				</div>
				<?php
				
					$selects = new selects;
					$selects->select_menu_pai('');
				
				?>
				<div class="uk-form-row">
					<label class="uk-form-label" for="">icone</label>
					<div class="uk-button-group uk-width-1-1">
						<div class="uk-button uk-button-primary uk-width-1-1" data-uk-dropdown>
							<i id='icone' class="uk-icon-folder-open"></i> <span id='icone_label'>Post</span>

							<div style="" class="uk-dropdown uk-dropdown-small uk-text-left"  id='icone_lista'>
								<ul class="uk-nav uk-nav-dropdown uk-dropdown-scrollable uk-grid uk-grid-width-1-2 uk-grid-width-medium-1-3">
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-adjust"></i> adjust</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-anchor"></i> anchor</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-archive"></i> archive</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-area-chart"></i> area-chart</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-arrows"></i> arrows</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-arrows-h"></i> arrows-h</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-arrows-v"></i> arrows-v</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-asterisk"></i> asterisk</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-at"></i> at</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-automobile"></i> automobile <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-ban"></i> ban</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bank"></i> bank <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bar-chart"></i> bar-chart</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bar-chart-o"></i> bar-chart-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-barcode"></i> barcode</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bars"></i> bars</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bed"></i> bed</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-beer"></i> beer</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bell"></i> bell</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bell-o"></i> bell-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bell-slash"></i> bell-slash</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bell-slash-o"></i> bell-slash-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bicycle"></i> bicycle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-binoculars"></i> binoculars</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-birthday-cake"></i> birthday-cake</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bolt"></i> bolt</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bomb"></i> bomb</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-book"></i> book</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bookmark"></i> bookmark</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bookmark-o"></i> bookmark-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-briefcase"></i> briefcase</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bug"></i> bug</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-building"></i> building</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-building-o"></i> building-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bullhorn"></i> bullhorn</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bullseye"></i> bullseye</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-bus"></i> bus</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cab"></i> cab <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-calculator"></i> calculator</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-calendar"></i> calendar</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-calendar-o"></i> calendar-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-camera"></i> camera</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-camera-retro"></i> camera-retro</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-car"></i> car</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-caret-square-o-down"></i> caret-square-o-down</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-caret-square-o-left"></i> caret-square-o-left</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-caret-square-o-right"></i> caret-square-o-right</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-caret-square-o-up"></i> caret-square-o-up</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cart-arrow-down"></i> cart-arrow-down</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cart-plus"></i> cart-plus</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cc"></i> cc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-certificate"></i> certificate</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-check"></i> check</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-check-circle"></i> check-circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-check-circle-o"></i> check-circle-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-check-square"></i> check-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-check-square-o"></i> check-square-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-child"></i> child</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-circle"></i> circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-circle-o"></i> circle-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-circle-o-notch"></i> circle-o-notch</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-circle-thin"></i> circle-thin</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-clock-o"></i> clock-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-close"></i> close <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cloud"></i> cloud</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cloud-download"></i> cloud-download</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cloud-upload"></i> cloud-upload</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-code"></i> code</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-code-fork"></i> code-fork</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-coffee"></i> coffee</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cog"></i> cog</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cogs"></i> cogs</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-comment"></i> comment</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-comment-o"></i> comment-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-comments"></i> comments</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-comments-o"></i> comments-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-compass"></i> compass</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-copyright"></i> copyright</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-credit-card"></i> credit-card</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-crop"></i> crop</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-crosshairs"></i> crosshairs</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cube"></i> cube</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cubes"></i> cubes</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-cutlery"></i> cutlery</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-dashboard"></i> dashboard <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-database"></i> database</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-desktop"></i> desktop</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-diamond"></i> diamond</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-dot-circle-o"></i> dot-circle-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-download"></i> download</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-edit"></i> edit <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-ellipsis-h"></i> ellipsis-h</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-ellipsis-v"></i> ellipsis-v</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-envelope"></i> envelope</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-envelope-o"></i> envelope-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-envelope-square"></i> envelope-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-eraser"></i> eraser</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-exchange"></i> exchange</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-exclamation"></i> exclamation</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-exclamation-circle"></i> exclamation-circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-exclamation-triangle"></i> exclamation-triangle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-external-link"></i> external-link</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-external-link-square"></i> external-link-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-eye"></i> eye</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-eye-slash"></i> eye-slash</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-eyedropper"></i> eyedropper</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-fax"></i> fax</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-female"></i> female</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-fighter-jet"></i> fighter-jet</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-archive-o"></i> file-archive-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-audio-o"></i> file-audio-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-code-o"></i> file-code-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-excel-o"></i> file-excel-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-image-o"></i> file-image-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-movie-o"></i> file-movie-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-pdf-o"></i> file-pdf-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-photo-o"></i> file-photo-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-picture-o"></i> file-picture-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-powerpoint-o"></i> file-powerpoint-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-sound-o"></i> file-sound-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-video-o"></i> file-video-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-word-o"></i> file-word-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-file-zip-o"></i> file-zip-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-film"></i> film</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-filter"></i> filter</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-fire"></i> fire</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-fire-extinguisher"></i> fire-extinguisher</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-flag"></i> flag</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-flag-checkered"></i> flag-checkered</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-flag-o"></i> flag-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-flash"></i> flash <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-flask"></i> flask</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-folder"></i> folder</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-folder-o"></i> folder-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-folder-open"></i> folder-open</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-folder-open-o"></i> folder-open-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-frown-o"></i> frown-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-futbol-o"></i> futbol-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-gamepad"></i> gamepad</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-gavel"></i> gavel</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-gear"></i> gear <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-gears"></i> gears <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-genderless"></i> genderless <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-gift"></i> gift</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-glass"></i> glass</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-globe"></i> globe</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-graduation-cap"></i> graduation-cap</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-group"></i> group <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-hdd-o"></i> hdd-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-headphones"></i> headphones</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-heart"></i> heart</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-heart-o"></i> heart-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-heartbeat"></i> heartbeat</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-history"></i> history</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-home"></i> home</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-hotel"></i> hotel <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-image"></i> image <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-inbox"></i> inbox</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-info"></i> info</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-info-circle"></i> info-circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-institution"></i> institution <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-key"></i> key</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-keyboard-o"></i> keyboard-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-language"></i> language</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-laptop"></i> laptop</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-leaf"></i> leaf</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-legal"></i> legal <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-lemon-o"></i> lemon-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-level-down"></i> level-down</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-level-up"></i> level-up</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-life-bouy"></i> life-bouy <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-life-buoy"></i> life-buoy <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-life-ring"></i> life-ring</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-life-saver"></i> life-saver <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-lightbulb-o"></i> lightbulb-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-line-chart"></i> line-chart</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-location-arrow"></i> location-arrow</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-lock"></i> lock</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-magic"></i> magic</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-magnet"></i> magnet</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-mail-forward"></i> mail-forward <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-mail-reply"></i> mail-reply <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-mail-reply-all"></i> mail-reply-all <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-male"></i> male</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-map-marker"></i> map-marker</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-meh-o"></i> meh-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-microphone"></i> microphone</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-microphone-slash"></i> microphone-slash</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-minus"></i> minus</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-minus-circle"></i> minus-circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-minus-square"></i> minus-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-minus-square-o"></i> minus-square-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-mobile"></i> mobile</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-mobile-phone"></i> mobile-phone <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-money"></i> money</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-moon-o"></i> moon-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-mortar-board"></i> mortar-board <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-motorcycle"></i> motorcycle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-music"></i> music</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-navicon"></i> navicon <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-newspaper-o"></i> newspaper-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-paint-brush"></i> paint-brush</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-paper-plane"></i> paper-plane</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-paper-plane-o"></i> paper-plane-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-paw"></i> paw</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-pencil"></i> pencil</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-pencil-square"></i> pencil-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-pencil-square-o"></i> pencil-square-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-phone"></i> phone</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-phone-square"></i> phone-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-photo"></i> photo <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-picture-o"></i> picture-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-pie-chart"></i> pie-chart</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-plane"></i> plane</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-plug"></i> plug</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-plus"></i> plus</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-plus-circle"></i> plus-circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-plus-square"></i> plus-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-plus-square-o"></i> plus-square-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-power-off"></i> power-off</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-print"></i> print</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-puzzle-piece"></i> puzzle-piece</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-qrcode"></i> qrcode</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-question"></i> question</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-question-circle"></i> question-circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-quote-left"></i> quote-left</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-quote-right"></i> quote-right</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-random"></i> random</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-recycle"></i> recycle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-refresh"></i> refresh</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-remove"></i> remove <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-reorder"></i> reorder <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-reply"></i> reply</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-reply-all"></i> reply-all</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-retweet"></i> retweet</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-road"></i> road</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-rocket"></i> rocket</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-rss"></i> rss</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-rss-square"></i> rss-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-search"></i> search</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-search-minus"></i> search-minus</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-search-plus"></i> search-plus</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-send"></i> send <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-send-o"></i> send-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-server"></i> server</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-share"></i> share</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-share-alt"></i> share-alt</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-share-alt-square"></i> share-alt-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-share-square"></i> share-square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-share-square-o"></i> share-square-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-shield"></i> shield</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-ship"></i> ship</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-shopping-cart"></i> shopping-cart</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sign-in"></i> sign-in</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sign-out"></i> sign-out</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-signal"></i> signal</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sitemap"></i> sitemap</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sliders"></i> sliders</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-smile-o"></i> smile-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-soccer-ball-o"></i> soccer-ball-o <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort"></i> sort</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-alpha-asc"></i> sort-alpha-asc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-alpha-desc"></i> sort-alpha-desc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-amount-asc"></i> sort-amount-asc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-amount-desc"></i> sort-amount-desc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-asc"></i> sort-asc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-desc"></i> sort-desc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-down"></i> sort-down <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-numeric-asc"></i> sort-numeric-asc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-numeric-desc"></i> sort-numeric-desc</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sort-up"></i> sort-up <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-space-shuttle"></i> space-shuttle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-spinner"></i> spinner</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-spoon"></i> spoon</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-square"></i> square</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-square-o"></i> square-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-star"></i> star</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-star-half"></i> star-half</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-star-half-empty"></i> star-half-empty <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-star-half-full"></i> star-half-full <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-star-half-o"></i> star-half-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-star-o"></i> star-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-street-view"></i> street-view</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-suitcase"></i> suitcase</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-sun-o"></i> sun-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-support"></i> support <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tablet"></i> tablet</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tachometer"></i> tachometer</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tag"></i> tag</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tags"></i> tags</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tasks"></i> tasks</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-taxi"></i> taxi</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-terminal"></i> terminal</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-thumb-tack"></i> thumb-tack</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-thumbs-down"></i> thumbs-down</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-thumbs-o-down"></i> thumbs-o-down</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-thumbs-o-up"></i> thumbs-o-up</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-thumbs-up"></i> thumbs-up</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-ticket"></i> ticket</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-times"></i> times</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-times-circle"></i> times-circle</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-times-circle-o"></i> times-circle-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tint"></i> tint</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-toggle-down"></i> toggle-down <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-toggle-left"></i> toggle-left <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-toggle-off"></i> toggle-off</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-toggle-on"></i> toggle-on</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-toggle-right"></i> toggle-right <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-toggle-up"></i> toggle-up <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-trash"></i> trash</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-trash-o"></i> trash-o</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tree"></i> tree</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-trophy"></i> trophy</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-truck"></i> truck</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-tty"></i> tty</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-umbrella"></i> umbrella</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-university"></i> university</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-unlock"></i> unlock</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-unlock-alt"></i> unlock-alt</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-unsorted"></i> unsorted <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-upload"></i> upload</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-user"></i> user</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-user-plus"></i> user-plus</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-user-secret"></i> user-secret</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-user-times"></i> user-times</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-users"></i> users</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-video-camera"></i> video-camera</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-volume-down"></i> volume-down</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-volume-off"></i> volume-off</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-volume-up"></i> volume-up</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-warning"></i> warning <span class="uk-text-muted">(alias)</span></a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-wheelchair"></i> wheelchair</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-wifi"></i> wifi</a></li>
                                <li><a href="#" onclick="selecionar_icone(this);"><i class="uk-icon-wrench"></i> wrench</a></li>
                            
								</ul>
							</div>
						</div>
					</div>

				</div>

				</form>
			</div>
			<div class="uk-modal-footer uk-text-right">
				<button type="button" class="uk-button uk-modal-close">Cancelar</button>
				<button type="button" onclick="salvar_cad_modulo();" class="uk-button uk-button-primary uk-modal-close">Salvar</button>
			</div>
		</div>
</div>

 <script src="js/script.js"></script>
 
	<?php } ?>