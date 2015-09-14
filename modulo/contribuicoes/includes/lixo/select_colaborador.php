<?php
					$select_option= "
							select 
								cad_colaboradores.cod_colaborador,
								cad_pessoas.nome_razao_social
								
							from 
								nico.cad_colaboradores,
								nico.cad_pessoas
								
							where 
								nico.cad_pessoas.cod_pessoa=nico.cad_colaboradores.cod_pessoa and							
								cad_pessoas.status=1 and
								nico.cad_colaboradores.status=1
								
							order by 
								`nome_razao_social`;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_colaborador' name='cod_colaborador' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_colaborador) and $row_option['cod_colaborador']==$cod_colaborador){
								echo "<option value='".$row_option['cod_colaborador']."' selected >".$row_option['nome_razao_social']."</option>";
							}else{
								echo "<option value='".$row_option['cod_colaborador']."'>".$row_option['nome_razao_social']."</option>";
							}
						}	
					echo "</select>";
?>