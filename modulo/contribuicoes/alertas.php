<?php 
	session_start();
	include "menu.php";

	$menu=new menus;
	$menu->menu_alertas();
	
	if (isset($_GET['status_alerta']) and $_GET['status_alerta']!=''){
		$html=new html;
		echo "<div class='uk-panel  uk-width-1-2 uk-container-center uk-text-center'>";
		echo  $html->cad_alertas($_GET['status_alerta']);
		echo "</div>";

	
	}
	
?>