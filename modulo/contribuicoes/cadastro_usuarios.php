<?php session_start();?>
<?php include "menu.php";?>

<?php





//atualizar
if(
	isset($_POST['cod_usuario']) and 
	isset($_POST['nome']) and  
	isset($_POST['username']) and  
	isset($_POST['email']) and 
	isset($_POST['status']) and 
	($_POST['cod_usuario']!='')
){
	$table='cad_usuarios';

	$campos="nome='".$_POST['nome']."', ";
	$campos.="username='".$_POST['username']."', ";
	$campos.="email='".$_POST['email']."', ";
	$campos.="status='".$_POST['status']."'";


	$where=" cod_usuario=".$_POST['cod_usuario']."";

	$sql=new sql;
	$sql->update($table,$campos,$where);
		
}

//salvar novo
if(
	isset($_POST['cod_usuario']) and 
	isset($_POST['nome']) and  
	isset($_POST['username']) and  
	isset($_POST['email']) and 
	isset($_POST['status']) and 
	($_POST['cod_usuario']=='')
){
	$table='cad_usuarios';

	$campos ="`cod_usuario`, `nome`, `username`, `email`, `status` ";

	$values="'".$_POST['cod_usuario']."','". 
				$_POST['nome'] ."','".   
				$_POST['username'] ."','".   
				$_POST['email'] ."','".  
				$_POST['status'] ."' ";
	
	$sql=new sql;
	$sql->insert($table,$campos,$values);


}



	$cod_usuario="";
	$nome="";
	$username="";
	$email="";
	$password="";
	$status="";


if(isset($_GET['id']) and $_GET['id']!='novo'){
//consultar cadastro
					$select= "
							select 
								*
								
							from 
								".$schema.".cad_usuarios 
								
							where  
								`cad_usuarios`.`cod_usuario` = ".$_GET['id'].";";
					$cadastro="
					<form class='uk-form'>
						<fieldset>
					";
					
					$resultado=mysql_query($select,$conexao) or die ("nao foi possivel conectar");
					while($row = mysql_fetch_array($resultado))
					  {
							$cod_usuario=$row['cod_usuario'];
							$nome=$row['nome'];
							$username=$row['username'];
							$email=$row['email'];
							$status=$row['status'];
					  }
				
					  
					  
					  
					  
					  

	}





?>










<body>

<!-- sub-menú -->
<div class="uk-grid uk-grid-preserve" style="padding-left: 10px;">
		<div class="uk-width-1-1">
			<form  action="#" method="get">
				<div class="uk-button-group">
					<input style="width: 100%;max-width: 300px;min-width: 100px;" type="text" id="pesquisa" name="pesquisa" class="uk-form-small" placeholder="Pesquisar">
					 <button class="uk-button uk-button-small uk-button-primary">Pesquisar  <i class="uk-icon-search"></i></button>
					<a href="?id=novo" class="uk-button uk-button-small"><i class="uk-icon-star"></i>  Novo</a>
					<a href="#" class="uk-button uk-button-small"><i class="uk-icon-print"></i>  Imprimir</a>
				</div>
			</form>
		</div>
</div>


<div style="margin: 20px;width: 500px;">
	<div class="tm-container">
			<div class="tm-content">

			<?php if(isset($_GET['pesquisa'])){	$tabelas=new tabelas;$tabelas->listar_usuarios($_GET['pesquisa']);} ?>
			<?php if(isset($_GET['id'])){ include 'includes/cad_usuarios.php';}?>


		</div>	
	</div>
</div>




</body>