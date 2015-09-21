<?php 
	$disabled="";
	if(isset($_GET['id']) and $_GET['id']==""){
		$fim_ultimo_periodo=$pesquisa->periodo(); //var_dump($fim_ultimo_periodo);
		if($fim_ultimo_periodo['data_fim']==null){
				$disabled=" ";
			
		}else{
				$disabled=" readonly ";
		}
		
		$data_inicio=data(date('Y-m-d', strtotime('+1 day', strtotime($fim_ultimo_periodo['data_fim']))));
		$date = new DateTime(date('Y-m-d', strtotime('+1 day', strtotime($fim_ultimo_periodo['data_fim']))));
		$date->modify('last day of this month');
		$data_fim=data($date->format('Y-m-d'));		
		
	}else{
		$disabled=" readonly ";
	}


?>


<div class='uk-width-2-4' style=''>
<form action="#" method="post" class="uk-form" id="form_cadastro">

<div class="uk-grid" style="max-width: 650px;min-width: 500px;">




					<div class="uk-width-1-4">
						<div class="uk-grid">
							<div class="uk-width-1-2">
								<?php 
									$inputs->input_form_row($cod_periodo,'cod_periodo','cod_periodo','','readonly');
								?>
							</div>
						</div>
					</div>
					<div class="uk-width-1-1">
						<div class="uk-grid">	
							<div class="uk-width-1-3" >
								<?php 
									$inputs->input_form_row($data_inicio,'data_inicio','Inicio',''," data-uk-datepicker={format:'DD/MM/YYYY'} ".$disabled);
								?>
							</div>
							<div class="uk-width-1-3" >
								<?php 
									$inputs->input_form_row($data_fim,'data_fim','Fim',''," data-uk-datepicker={format:'DD/MM/YYYY'} ".$disabled);
								?>
							</div>
							<div class="uk-width-1-3" >
								<?php 
									$selects->status($status,"Status");
								?>
							</div>
						</div>
					</div>


</div>

</form>








</div>