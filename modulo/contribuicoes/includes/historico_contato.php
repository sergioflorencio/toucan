<?php
	if(isset($_POST['wysiwyg_nota']) and isset($_POST['wysiwyg_cod_carta']) and isset($_POST['wysiwyg_cod_usuario']) and $_POST['wysiwyg_nota']!='' ){
		$sql=new sql;
		
		$table='cad_historico_carta';

		$campos ="cod_carta,";
		$campos.="nota ";


		$values="'".$_POST['wysiwyg_cod_carta']."',";
		$values.="'".str_replace("'","",str_replace('"',"'", $_POST['wysiwyg_nota']))."'";

		
		$sql-> insert($table,$campos,$values);
	
	}	

?>

<div class="uk-width-1-1" >

	<h3><i class="uk-icon-history"></i> Histórico de contato</h3>


	<script type="text/javascript">
	$(function()
	{
	$('#wysiwyg_nota').wysiwyg();
	});
	</script>	
	<form id="form_historico_carta" action="#" method="post" class="uk-width-1-1">
		<textarea id="wysiwyg_nota" name="wysiwyg_nota" rows="5" cols="50"  ></textarea>
		<button class="uk-button uk-button-small uk-button-primary " type="submit" style="margin: 20px 0px 0px 0px;"><i class="uk-icon-send"></i> Enviar</button>
		<input type="text" readonly="" style="width: 0px;visibility: hidden;" name="wysiwyg_cod_carta" id="wysiwyg_cod_carta" value="<?php echo $cod_carta;?>">
		<input type="text" readonly="" style="width: 0px;visibility: hidden;" name="wysiwyg_cod_usuario" id="wysiwyg_cod_usuario" value="<?php echo $_SESSION['cod_usuario']['cod_usuario'];?>">
	</form>

	<hr class='uk-article-divider'>
	<div class="uk-width-1-1">
		<?php
		if(isset($cod_carta)){
			$tabelas=new tabelas;
			$tabelas->historico_carta($cod_carta);
		}
		?>
	</div>
</div>


