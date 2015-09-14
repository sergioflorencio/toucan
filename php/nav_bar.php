<?php
class navbar{
	function listar_menu($label,$cod_menu,$cod_menu_pai,$modulo,$icone,$hidden,$cod_usuario,$href){
		$navbar=new navbar;
		if($cod_menu_pai==0){$tooltip="data-uk-tooltip={pos:'left'} title='".$label."' style='padding-top: 20px; ' ";$label_="";}else{$tooltip="";$label_=$label;}
			echo 
			"<li class='uk-parent' data-uk-dropdown={mode:'click'} style='' ".$hidden." >
				<a href='".$href."' ".$tooltip." ><i class='".$icone."'></i> ".$label_."";
			
				$navbar->listar_cad_menu($modulo,$cod_menu,$cod_usuario);
				
			echo 	
				"</a>
			</li>";
			
	}	
	function listar_cad_menu($modulo,$cod_menu_pai,$cod_usuario){
			$navbar=new navbar;
			include "config.php";
			$select="
					SELECT 
						cad_menu.*,
						if(tb_hidden.status=0,'hidden','') as hidden
					FROM 
						".$schema.".cad_menu 
					left join
						(select cod_menu, status from ".$schema.".cad_menu_acessos where cod_usuario='".$cod_usuario."') as tb_hidden on tb_hidden.cod_menu=cad_menu.cod_menu
					where 
						cod_menu_pai='".$cod_menu_pai."' and 
						modulo='".$modulo."';";
			if($cod_menu_pai==0){

					echo "
						<ul class='uk-navbar-nav uk-hidden-small'  style=''>
							<li class='uk-parent'>
								<a href='#' data-uk-tooltip={pos:'bottom'} title='".$_SESSION['razao_social']."'>
									<img src='../../".$_SESSION['logo']."' alt='tucan' style='margin: 10px; max-height: 35px; max-width: 145px;' border='0'>
								</a>							
							</li>
							<li class='uk-parent' data-uk-dropdown={mode:'click'}>
								<a href='../../index.php' data-uk-tooltip={pos:'right'} title='Home'  style='padding-top: 20px;'><i class='uk-icon-home'></i> </a>
							</li>						
						
						";
			}else{
					echo "
						<div class='uk-dropdown uk-dropdown-navbar'>
							<ul class='uk-nav uk-nav-navbar'>";
			}		

			$resultado=mysql_query($select,$conexao) or die (mysql_error());
				while($row = mysql_fetch_array($resultado)){
			
				$navbar->listar_menu($row['label'],$row['cod_menu'],$row['cod_menu_pai'],$modulo,$row['icone'],$row['hidden'],$cod_usuario,$row['href']);
			}
			
			if($cod_menu_pai==0){
					echo "
							</ul>";	
			}else{
					echo "

							</ul>
					
						</div>
						";	
			
			}
		
		

		

	
	}
	function listar_menu_offcanvas($label,$cod_menu,$cod_menu_pai,$modulo,$icone,$hidden,$cod_usuario,$href){
		$navbar=new navbar;
		echo "<li class='uk-parent'  style='' ".$hidden." ><a href='".$href."'><i class='".$icone."'></i> ".$label."";
		$navbar->listar_cad_menu_offcanvas($modulo,$cod_menu,$cod_usuario);
			
		echo 	
		"</a></li>";
	
	}	
	function listar_cad_menu_offcanvas($modulo,$cod_menu_pai,$cod_usuario){
			$navbar=new navbar;
			include "config.php";
			$select="
					SELECT 
						cad_menu.*,
						if(tb_hidden.status=0,'hidden','') as hidden
					FROM 
						".$schema.".cad_menu 
					left join
						(select cod_menu, status from ".$schema.".cad_menu_acessos where cod_usuario='".$cod_usuario."') as tb_hidden on tb_hidden.cod_menu=cad_menu.cod_menu
					where 
						cod_menu_pai='".$cod_menu_pai."' and 
						modulo='".$modulo."';";
			if($cod_menu_pai==0){
					echo "
						<ul class='uk-nav  uk-nav-offcanvas' data-uk-nav>
							<li class='uk-parent'>
								<img src='../../".$_SESSION['logo']."' alt='tucan' style='margin:10px ;width: 145px;' border='0'>
							</li>
							<li class='uk-parent' >
								<a href='../../index.php' data-uk-tooltip={pos:'right'} title='Home'  style='padding-top: 20px;'><i class='uk-icon-home'></i> </a>
							</li>						
						
						";
			}else{
					echo "
						<div class=''>
							<ul class=''>";
			}		

			$resultado=mysql_query($select,$conexao) or die (mysql_error());
				while($row = mysql_fetch_array($resultado)){
			
				$navbar->listar_menu_offcanvas($row['label'],$row['cod_menu'],$row['cod_menu_pai'],$modulo,$row['icone'],$row['hidden'],$cod_usuario,$row['href']);
			}
			
			if($cod_menu_pai==0){
					echo "
							</ul>";	
			}else{
					echo "

							</ul>
					
						</div>
						";	
			
			}
		
		

		

	
	}


	function navbar_intranet(){
		if(isset($_SESSION['cod_usuario']) and $_SESSION['cod_usuario']!=null){
		
		include "config.php";
			$select="
			SELECT 
				cad_menu.* ,
				if(tb_acessos.status=1,'','uk-hidden') as hidden

			FROM 
				".$schema.".cad_menu 

			left join (select cod_menu, status from ".$schema.".cad_menu_acessos where cod_usuario='".$_SESSION['cod_usuario']."') as tb_acessos on tb_acessos.cod_menu=cad_menu.cod_menu
			where 
				modulo='tucan';
			";
			echo "<div class='uk-width-1-1'><div class='uk-grid'>";
				$resultado=mysql_query($select,$conexao) or die (mysql_error());
				while($row = mysql_fetch_array($resultado)){
					echo "
					<div class='box-modulo  uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-5 ".$row['hidden']."'>
						<a class='uk-thumbnail' href='".$row['href']."'>
							<i class='".$row['icone']." uk-icon-large'></i>
							<div class='uk-thumbnail-caption'>".$row['label']."</div>
						</a>
					</div>			
					
					";
					
				}
			echo "</div></div>";
		
		}
	}
	function navbar_modulo($modulo){

		include "config.php";
		$navbar=new navbar;
		
		echo "<div id='menu' class='' style=''><nav class='uk-navbar'>";
		
	echo "
	<ul class='uk-navbar-nav'>
	<li>
		<a href='#' style='padding-top: 15px; font-size: 25px;' class='uk-hidden-medium uk-hidden-large' data-uk-offcanvas={target:'#my-id'}><i class='uk-icon-bars'></i> </a>

	</li>
	</ul>
		<div id='my-id' class='uk-offcanvas'>
			<div class='uk-offcanvas-bar'>

				";
				$navbar->listar_cad_menu_offcanvas($modulo,'0',$_SESSION['cod_usuario']);
				echo "
		   </div>
		</div>	
	
	";
		
		$navbar->listar_cad_menu($modulo,'0',$_SESSION['cod_usuario']);
		echo "
				<div class='uk-navbar-flip'>
					<ul class='uk-navbar-nav'>
						<li data-uk-dropdown={mode:'click'}   ><a href='#'  data-uk-tooltip={pos:'bottom'} title='Alertas' style='padding-top: 0px; padding-left: 10px; padding-right: 10px;' id='alertas' click='alertas();' onmouseover='alertas();'><i class='uk-icon-exclamation-circle uk-icon-button' style='border-radius: 40px;'></i> <div class='uk-badge uk-badge-danger' id='cad_alertas_numero'></div></a> <div class='uk-dropdown uk-dropdown-scrollable' style='width:450px;max-height: 500px !important;'><a href='alertas.php'>Visualizar todos os alertas</a><div  id='div_alertas' style='width:400px;'></div></div></li>
						<li>
							<a href='../../index.php?act=mudar_empresa' data-uk-tooltip={pos:'bottom'} title='mudar de empresa'><i class='uk-icon-exchange' style='padding-top: 17px;'></i></a>
						</li>
						<li><a href='".$DNS."?login=logout' data-uk-tooltip={pos:'bottom'} title='' style='padding-top: 20px;' data-cached-title='Sair'><i class='uk-icon-sign-out'></i> </a></li>
					</ul>
				</div>	
		</nav>
		
		</div>";

		
		
	}

}

class navempresa{
	function listar_empresa($label,$cod_empresa,$cod_empresa_matriz,$hidden,$cod_usuario){
		$navempresa=new navempresa;
		$icone="";
		if($cod_empresa_matriz==0){$icone="<i class='uk-icon-building'></i>";}
		if($cod_empresa_matriz!=0){$icone="<i class='uk-icon-building-o'></i>";}
		
		echo "<li class='uk-parent'   ><a href='#' style='' class='".$hidden."' onclick='login_empresa(".$cod_empresa.");'>".$icone." ".$label."";
		$navempresa->listar_cad_empresa($cod_empresa,$cod_usuario);
			
		echo 	
		"</a></li>";
	
	}	
	function listar_cad_empresa($cod_empresa_matriz,$cod_usuario){
			$navempresa=new navempresa;
			include "config.php";
			$select="
					SELECT 
						cad_empresa.*,
						if(tb_hidden.status=1,'','desabilitado') as hidden
					FROM 
						".$schema.".cad_empresa 
					left join
						(select cod_empresa, status from ".$schema.".cad_empresa_acessos where cod_usuario='".$cod_usuario."') as tb_hidden on tb_hidden.cod_empresa=cad_empresa.cod_empresa
					where 
						cod_empresa_matriz='".$cod_empresa_matriz."';";
			if($cod_empresa_matriz==0){
					echo "<ul>";
			}else{
					echo "
						<div class=''>
							<ul class=''>";
			}		

			$resultado=mysql_query($select,$conexao) or die (mysql_error());
				while($row = mysql_fetch_array($resultado)){
			
				$navempresa->listar_empresa($row['razao_social'],$row['cod_empresa'],$row['cod_empresa_matriz'],$row['hidden'],$cod_usuario);
			}
			
			if($cod_empresa_matriz==0){
					echo "
							</ul>";	
			}else{
					echo "

							</ul>
					
						</div>
						";	
			
			}
		
		

		

	
	}

	function listar_empresa_($label,$cod_empresa,$cod_empresa_matriz,$hidden,$cod_usuario,$cnpj){
		$navempresa=new navempresa;
		$icone="";
		if($cod_empresa_matriz==0){$icone="<i class='uk-icon-building'></i>";}
		if($cod_empresa_matriz!=0){$icone="<i class='uk-icon-building-o'></i>";}
		if($cod_empresa_matriz!=0){$espaco="<i class='uk-icon-caret-right'></i>";}else{$espaco="";}
		
		echo "


			<tr onclick='login_empresa(".$cod_empresa.");' class='".$hidden."'>
				<td style='font-size: 12px ! important;'>
					<div class='uk-width-1-1'>
						<div class='uk-grid'>
							<div class='uk-width-small-1-1 uk-width-medium-2-3 uk-width-large-4-5'>
							".$espaco." ".$icone." ".$label."
							</div>
							<div class='uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-5'>
							".$cnpj."
							</div>
						</div>
					</div>			
				</td>
			</tr>
			
			";
		$navempresa->listar_cad_empresa_($cod_empresa,$cod_usuario);		
	
	}	
	function listar_cad_empresa_($cod_empresa_matriz,$cod_usuario){
			$navempresa=new navempresa;
			include "config.php";
			$select="
					SELECT 
						cad_empresa.*,
						if(tb_hidden.status=1,'','desabilitado') as hidden
					FROM 
						".$schema.".cad_empresa 
					left join
						(select cod_empresa, status from ".$schema.".cad_empresa_acessos where cod_usuario='".$cod_usuario."') as tb_hidden on tb_hidden.cod_empresa=cad_empresa.cod_empresa
					where 
						cod_empresa_matriz='".$cod_empresa_matriz."';";


			$resultado=mysql_query($select,$conexao) or die (mysql_error());
				while($row = mysql_fetch_array($resultado)){
			
				$navempresa->listar_empresa_($row['razao_social'],$row['cod_empresa'],$row['cod_empresa_matriz'],$row['hidden'],$cod_usuario,$row['cnpj']);
			}
			

		
		

		

	
	}
	function escolher_empresa(){
			echo "<div class='uk-width-1-1 '>
					<div class='uk-grid '>
						<div class='uk-width-1-1'>
							<div class='uk-text-left  uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
								<div class='uk-thumbnail uk-width-1-1' style='background: none repeat scroll 0% 0% rgb(255, 255, 255) ! important;'>
									<div class='uk-thumbnail-caption uk-text-left'>
										<div id=''>
										<span class='uk-article-lead'><i class='uk-icon-exchange' style=''></i>  Mudar de empresa</br>
											<span class='uk-article-meta'>Escolha uma empresa para se logar</span>
										</span>
										
											<table  class='uk-table  uk-table-hover'   style='font-size: 12px ! important;'  >
											    <thead>
													<tr>
														<th>
															<div class='uk-width-1-1'>
																<div class='uk-grid'>
																	<div class='uk-width-small-1-1 uk-width-medium-2-3 uk-width-large-4-5'>
																	Razão Social
																	</div>
																	<div class='uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-5'>
																	CNPJ
																	</div>
																</div>
															</div>
															
														</th>
													</tr>
												</thead>";

													$navempresa=new navempresa;
													$navempresa->listar_cad_empresa_('0',$_SESSION['cod_usuario']);
													

				echo					"</table>
										</div>
										<form action='index.php' method='post' id='form_login_empresa'>
											<input type='text' name='cod_empresa' id='cod_empresa' hidden />
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
		
		
		
	}
	
	
	
}



?>