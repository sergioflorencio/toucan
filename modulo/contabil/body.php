
<body style="margin-bottom: 0px;">
		<script src="js/grids_js.js"></script>

	<?php 
		$navbar=new navbar;
		$navbar->navbar_modulo('contabil');

	?>


<div class="uk-width-1-1 uk-container-center uk-text-center">
	<div class="uk-grid ">



			<?php

		 
					if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id'])){
						if(isset($_GET['act']) and $_GET['act']!='imprimir'){
			?>

				<div class="uk-width-1-1 " style="">
						<div id='principal' class='' style="margin: -10px 0px 0px; text-align: left; border-bottom: 1px solid rgb(204, 204, 204); padding-bottom: 10px;">
							<div class='' style='style="text-align: left; margin: 5px 10px;"'>			
								<ul class='uk-subnav uk-subnav-line' style='margin-bottom: 0px;'>

									<?php 
									$menus=new menus;
									$menus->menu();
									?>
									
								</ul>
							</div>
						</div>
				</div>
			<?php
							
						}		

					 }
			?>					

		

		<div class="uk-width-1-1 " style="text-align: left;">
			<div id='cadastro'></div>
			<div id='div_msg'></div>			
			<div id='principal' style=''></div>
		</div>
		<div class="uk-width-1-1 " style="text-align: left;">
			<?php

		 
					if(isset($_GET['act']) and isset($_GET['mod']) and isset($_GET['id'])){
						if(isset($_POST) and $_POST!=null and isset($_GET['act']) and $_GET['act']=='cadastros'){
							$keys=array_keys($_POST);
							$sql=new sql;
							$sql->salvar($_GET['mod'],$keys[0]);
						}		
						$$_GET['act']=new $_GET['act'];
						$$_GET['act']->$_GET['mod']($_GET['id']);
					 }
			?>
		
		</div>

	</div>
</div>








		

</body>

		<script src="js/script.js"></script>

