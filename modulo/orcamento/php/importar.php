<?php
	//print_r($_POST);

			
	class MyDB extends SQLite3{
		function __construct(){
			$schema="../bases_sec3/".$_POST['schema'];
			$this->open($schema);
		}
	}

	class action{
		function tabela(){
			$db = new MyDB();

			$result = $db->query("SELECT '".$_POST['schema']."' as schema,".$_POST['tabela'].".* from ".$_POST['tabela']." ");
			
				$json= "[";
					while ($row = $result->fetchArray()) {
						$json.= "{";
						for($n=0;$n<$result->numColumns();$n++){
							$json.= '"'.$result->columnName($n).'"'.":".'"'.$row[$n].'"|';
						}
						$json.= "}";
					}
				$json.= "]";
				$json=str_replace("}{","},{",$json);
				$json=str_replace('"|"','","',$json);
				$json=str_replace('|}','}',$json);
				
				echo $json;
		
		}
		function tabela_(){
			$db = new MyDB();

			$result = $db->query("SELECT * from ".$_POST['tabela']." ");
			
				echo "<table class='uk-table uk-table-condensed uk-table-hover'>";
				echo "<tr>";
				for($n=0;$n<$result->numColumns();$n++){
					echo "<th>".$result->columnName($n)."</th>";
				}
				echo "</tr>";
				
				
			while ($row = $result->fetchArray()) {
				echo "<tr>";
				for($n=0;$n<$result->numColumns();$n++){
					echo "<td>".$row[$n]."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";	
		
		}
		function tabela_lancamentos__(){
			$db = new MyDB();

			$result = $db->query("
			
select 
movimento_analitico.*,
plano_de_contas.id,
plano_de_contas.numero,
plano_de_contas.descricao,
centro_de_custos.id,
centro_de_custos.numero,
centro_de_custos.descricao,
caixas.tipo,
caixas.descricao




 from (


--  Saldo Inicial --------------------------
select
		id,
		'1900-01-01' as data_operacao,
		
		id as caixa,

		'' as planodecontas,
		'' as centrodecustos,
		
		saldo_inicial as valor_rateado,

		saldo_inicial as total_geral,
		
		'' as inclusao,
		'Saldo Inicial' as tipo_movimento
from
	caixas
--  Saldo Inicial --------------------------

union all

--  contas a pagar --------------------------

select 
		movimento_rateado_pagar.id,
		movimento_rateado_pagar.data_operacao,
		
		movimento_rateado_pagar.cx_saida as caixa,

		rateio.planodecontas,
		rateio.centrodecustos,
		
		- ROUND(contas_pagar.valor_liquido*rateio.porcentagem*movimento_rateado_pagar.porcentagem, 2) as valor_rateado,
--		- ROUND(movimento.valor_saida*rateio.porcentagem, 2) as valor_rateado,

		rateio.total_geral,
		
		contas_pagar.inclusao,
		'Contas a Pagar' as tipo_movimento
from 

	(
		select
			movimento.cx_saida,
			movimento.data_operacao,
			movimento.id,
			movimento.origem,
			sum(movimento.valor_saida)/rateio_movimento.total as porcentagem
		from
			movimento,
			(
				select
					origem,
					sum(valor_saida) as total
				from
					movimento
				where
					movimento.tipo=9
				group by
					origem
			) as rateio_movimento
			
		where
			rateio_movimento.origem=movimento.origem and
			movimento.tipo=9
		group by
			movimento.id,
			movimento.origem

	) as movimento_rateado_pagar,
	contas_pagar,
	(
	SELECT 
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.valor,
		tb_total.total as total_geral,
		sum(rateio_efetivo_composicao.valor)/tb_total.total as porcentagem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos

	FROM 
		rateio_efetivo_composicao,
		(SELECT 
				origem,
				sum(valor) as total

			FROM 
				rateio_efetivo_composicao
			where
				tipo=2
			group by
				origem) as tb_total
	where
		tb_total.origem=rateio_efetivo_composicao.origem and
		rateio_efetivo_composicao.tipo=2
	group by
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos
	
		) as rateio
	
	
where
	movimento_rateado_pagar.origem=contas_pagar.grupo_baixa and
	rateio.origem=contas_pagar.inclusao
group by
	movimento_rateado_pagar.id,
	movimento_rateado_pagar.origem,
	movimento_rateado_pagar.cx_saida,
	movimento_rateado_pagar.data_operacao,
	contas_pagar.inclusao,
	contas_pagar.id,
	rateio.planodecontas,
	rateio.centrodecustos
	
--  contas a pagar -------------------------------

union all
	
	
----- contas a receber ---------------------------

select 
		movimento_rateado_receber.id,
		movimento_rateado_receber.data_operacao,
		
		movimento_rateado_receber.cx_entrada as caixa,

		rateio.planodecontas,
		rateio.centrodecustos,
		
		ROUND(contas_receber.valor_liquido*rateio.porcentagem*movimento_rateado_receber.porcentagem, 2) as valor_rateado,
--		ROUND(movimento.valor_entrada*rateio.porcentagem, 2) as valor_rateado,

		rateio.total_geral,
		
		contas_receber.inclusao,
		'Contas a Receber' as tipo_movimento
from 

	(
		select
			movimento.cx_entrada,
			movimento.data_operacao,
			movimento.id,
			movimento.origem,
			sum(movimento.valor_entrada)/rateio_movimento.total as porcentagem
		from
			movimento,
			(
				select
					origem,
					sum(valor_entrada) as total
				from
					movimento
				where
					movimento.tipo=10
				group by
					origem
			) as rateio_movimento
			
		where
			rateio_movimento.origem=movimento.origem and
			movimento.tipo=10
		group by
			movimento.id,
			movimento.origem

	) as movimento_rateado_receber,

	contas_receber,
	(
	SELECT 
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.valor,
		tb_total.total as total_geral,
		sum(rateio_efetivo_composicao.valor)/tb_total.total as porcentagem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos

	FROM 
		rateio_efetivo_composicao,
		(SELECT 
				origem,
				sum(valor) as total

			FROM 
				rateio_efetivo_composicao
			where
				tipo=3
			group by
				origem) as tb_total
	where
		tb_total.origem=rateio_efetivo_composicao.origem and
		rateio_efetivo_composicao.tipo=3
	group by
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos
	
		) as rateio
	
	
where
	movimento_rateado_receber.origem=contas_receber.grupo_baixa and
	rateio.origem=contas_receber.inclusao
group by
	movimento_rateado_receber.id,
	movimento_rateado_receber.origem,
	movimento_rateado_receber.cx_entrada,
	movimento_rateado_receber.data_operacao,
	contas_receber.inclusao,
	contas_receber.id,
	rateio.planodecontas,
	rateio.centrodecustos
	
-- contas a receber -------------------------------------

union all

-- lançamentos a credito --------------------------------




select 
		movimento.id,
		movimento.data_operacao,
		
		movimento.cx_saida as caixa,

		rateio.planodecontas,
		rateio.centrodecustos,
		
		- ROUND(lancamentos_bancarios.valor*rateio.porcentagem, 2) as valor_rateado,

		rateio.total_geral,
		
		lancamentos_bancarios.id as origem,
		'Lançamentos bancarios a crédito' as tipo_movimento
from 
	movimento,
	lancamentos_bancarios,
	(
	SELECT 
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.valor,
		tb_total.total as total_geral,
		rateio_efetivo_composicao.valor/tb_total.total as porcentagem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos

	FROM 
		rateio_efetivo_composicao,
		(SELECT 
				origem,
				sum(valor) as total

			FROM 
				rateio_efetivo_composicao
			where
				tipo=5
			group by
				origem) as tb_total
	where
		tb_total.origem=rateio_efetivo_composicao.origem and
		tipo=5
	group by
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos
	
		) as rateio
	
	
where
	movimento.tipo='5' and
	lancamentos_bancarios.tipo=0 and
	movimento.origem=lancamentos_bancarios.id and
	rateio.origem=lancamentos_bancarios.id
group by
	movimento.id,
	movimento.origem,
	movimento.cx_entrada,
	lancamentos_bancarios.id,
	rateio.planodecontas,
	rateio.centrodecustos







	
	
-- lançamentos a credito --------------------------------

union all
	
-- lançamentos a debito --------------------------------

select 
		movimento.id,
		movimento.data_operacao,
		
		movimento.cx_entrada as caixa,

		rateio.planodecontas,
		rateio.centrodecustos,
		
		ROUND(lancamentos_bancarios.valor*rateio.porcentagem, 2) as valor_rateado,

		rateio.total_geral,
		
		lancamentos_bancarios.id as origem,
		'Lançamentos bancarios a debito' as tipo_movimento
from 
	movimento,
	lancamentos_bancarios,
	(
	SELECT 
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.valor,
		tb_total.total as total_geral,
		rateio_efetivo_composicao.valor/tb_total.total as porcentagem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos

	FROM 
		rateio_efetivo_composicao,
		(SELECT 
				origem,
				sum(valor) as total

			FROM 
				rateio_efetivo_composicao
			where
				tipo=6
			group by
				origem) as tb_total
	where
		tb_total.origem=rateio_efetivo_composicao.origem and
		tipo=6
	group by
		rateio_efetivo_composicao.origem,
		rateio_efetivo_composicao.planodecontas,
		rateio_efetivo_composicao.centrodecustos
	
		) as rateio
	
	
where
	movimento.tipo='6' and
	lancamentos_bancarios.tipo=1 and
	movimento.origem=lancamentos_bancarios.id and
	rateio.origem=lancamentos_bancarios.id
group by
	movimento.id,
	movimento.origem,
	movimento.cx_entrada,
	lancamentos_bancarios.id,
	rateio.planodecontas,
	rateio.centrodecustos



	
	
-- lançamentos a debito --------------------------------

union all
	
-- Adiantamentos recebidos --------------------------------

	select
			movimento.id,
			movimento.data_operacao,
			
			movimento.cx_entrada as caixa,

			'' as planodecontas,
			'' as centrodecustos,
			
			ROUND(movimento.valor_entrada, 2) as valor_rateado,

			'' as total_geral,
			
			movimento.origem,
			'Adiantamentos recebidos' as tipo_movimento
	from 
			movimento
	where
			movimento.tipo=8 and
			movimento.cx_entrada!=''

union all		
		
	select
			movimento.id,
			movimento.data_operacao,
			
			movimento.cx_saida as caixa,

			'' as planodecontas,
			'' as centrodecustos,
			
			- ROUND(movimento.valor_saida, 2) as valor_rateado,

			'' as total_geral,
			
			movimento.origem,
			'Adiantamentos recebidos' as tipo_movimento
	from 
			movimento
	where
			movimento.tipo=8 and
			movimento.cx_saida!=''
			
	
-- Adiantamentos recebidos --------------------------------

union all
	
-- Adiantamentos pagos --------------------------------

	select
			movimento.id,
			movimento.data_operacao,
			
			movimento.cx_saida as caixa,

			'' as planodecontas,
			'' as centrodecustos,
			
			- ROUND(movimento.valor_saida, 2) as valor_rateado,

			'' as total_geral,
			
			movimento.origem,
			'Adiantamentos feitos' as tipo_movimento
	from 
			movimento
	where
			movimento.tipo=7 and
			movimento.cx_saida!=''
	
union all

	select
			movimento.id,
			movimento.data_operacao,
			
			movimento.cx_entrada as caixa,

			'' as planodecontas,
			'' as centrodecustos,
			
			ROUND(movimento.valor_entrada, 2) as valor_rateado,

			'' as total_geral,
			
			movimento.origem,
			'Adiantamentos feitos' as tipo_movimento
	from 
			movimento
	where
			movimento.tipo=7 and
			movimento.cx_entrada!=''

-- Adiantamentos pagos --------------------------------

union all
	
-- Transferencias bancárias -------------------------------	


select
		movimento.id,
		movimento.data_operacao,
		
		movimento.cx_entrada as caixa,

		'' as planodecontas,
		'' as centrodecustos,
		
		ROUND(movimento.valor_entrada, 2) as valor_rateado,

		'' as total_geral,
		
		movimento.origem,
		'Transferencias recebidas' as tipo_movimento
from 
		movimento
where
		movimento.tipo=4 and
		movimento.cx_entrada!=''
	

union all
	

select
		movimento.id,
		movimento.data_operacao,
		
		movimento.cx_saida as caixa,

		'' as planodecontas,
		'' as centrodecustos,
		
		- ROUND(movimento.valor_saida, 2) as valor_rateado,

		'' as total_geral,
		
		movimento.origem,
		'Transferencias pagas' as tipo_movimento
from 
		movimento
where
		movimento.tipo=4 and
		movimento.cx_saida!=''





















-- Transferencias bancárias -------------------------------	









) as movimento_analitico



	left join plano_de_contas on movimento_analitico.planodecontas =plano_de_contas.id 
	left join centro_de_custos on movimento_analitico.centrodecustos =centro_de_custos.id
	left join caixas on movimento_analitico.caixa = caixas.id
			
			
			
			
			
			
			
			");
			
				echo "<table class='uk-table uk-table-condensed uk-table-hover'>";
				echo "<tr>";
				for($n=0;$n<$result->numColumns();$n++){
					echo "<th>".$result->columnName($n)."</th>";
				}
				echo "</tr>";
				
				
			while ($row = $result->fetchArray()) {
				echo "<tr>";
				for($n=0;$n<$result->numColumns();$n++){
					echo "<td>".$row[$n]."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";	
		
		}
		function tabela_lancamentos(){
			$db = new MyDB();

			$result = $db->query("
			
				select 
				
					'".$_POST['schema']."' as `schema`,
					tb_base_lcto.id  as  id ,
					tb_base_lcto.inclusao  as  inclusao ,
					tb_base_lcto.tipo_movimento  as  tipo_movimento ,
					tb_base_lcto.data_operacao  as  data ,
					tb_base_lcto.valor_rateado  as  valor ,
					tb_base_lcto.caixa  as  idcaixa ,
					tb_base_lcto.planodecontas  as  idconta ,
					tb_base_lcto.centrodecustos  as  idctrcusto 
					
				
				from (
						select 
							movimento_analitico.*,
							plano_de_contas.id,
							plano_de_contas.numero,
							plano_de_contas.descricao,
							centro_de_custos.id,
							centro_de_custos.numero,
							centro_de_custos.descricao,
							caixas.tipo,
							caixas.descricao




							 from (


							--  Saldo Inicial --------------------------
							select
									id,
									'1900-01-01' as data_operacao,
									
									id as caixa,

									'' as planodecontas,
									'' as centrodecustos,
									
									saldo_inicial as valor_rateado,

									saldo_inicial as total_geral,
									
									'' as inclusao,
									'Saldo Inicial' as tipo_movimento
							from
								caixas
							--  Saldo Inicial --------------------------

							union all

							--  contas a pagar --------------------------

							select 
									movimento_rateado_pagar.id,
									movimento_rateado_pagar.data_operacao,
									
									movimento_rateado_pagar.cx_saida as caixa,

									rateio.planodecontas,
									rateio.centrodecustos,
									
									- ROUND(contas_pagar.valor_liquido*rateio.porcentagem*movimento_rateado_pagar.porcentagem, 2) as valor_rateado,
							--		- ROUND(movimento.valor_saida*rateio.porcentagem, 2) as valor_rateado,

									rateio.total_geral,
									
									contas_pagar.inclusao,
									'Contas a Pagar' as tipo_movimento
							from 

								(
									select
										movimento.cx_saida,
										movimento.data_operacao,
										movimento.id,
										movimento.origem,
										sum(movimento.valor_saida)/rateio_movimento.total as porcentagem
									from
										movimento,
										(
											select
												origem,
												sum(valor_saida) as total
											from
												movimento
											where
												movimento.tipo=9
											group by
												origem
										) as rateio_movimento
										
									where
										rateio_movimento.origem=movimento.origem and
										movimento.tipo=9
									group by
										movimento.id,
										movimento.origem

								) as movimento_rateado_pagar,
								contas_pagar,
								(
								SELECT 
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.valor,
									tb_total.total as total_geral,
									sum(rateio_efetivo_composicao.valor)/tb_total.total as porcentagem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos

								FROM 
									rateio_efetivo_composicao,
									(SELECT 
											origem,
											sum(valor) as total

										FROM 
											rateio_efetivo_composicao
										where
											tipo=2
										group by
											origem) as tb_total
								where
									tb_total.origem=rateio_efetivo_composicao.origem and
									rateio_efetivo_composicao.tipo=2
								group by
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos
								
									) as rateio
								
								
							where
								movimento_rateado_pagar.origem=contas_pagar.grupo_baixa and
								rateio.origem=contas_pagar.inclusao
							group by
								movimento_rateado_pagar.id,
								movimento_rateado_pagar.origem,
								movimento_rateado_pagar.cx_saida,
								movimento_rateado_pagar.data_operacao,
								contas_pagar.inclusao,
								contas_pagar.id,
								rateio.planodecontas,
								rateio.centrodecustos
								
							--  contas a pagar -------------------------------

							union all
								
								
							----- contas a receber ---------------------------

							select 
									movimento_rateado_receber.id,
									movimento_rateado_receber.data_operacao,
									
									movimento_rateado_receber.cx_entrada as caixa,

									rateio.planodecontas,
									rateio.centrodecustos,
									
									ROUND(contas_receber.valor_liquido*rateio.porcentagem*movimento_rateado_receber.porcentagem, 2) as valor_rateado,
							--		ROUND(movimento.valor_entrada*rateio.porcentagem, 2) as valor_rateado,

									rateio.total_geral,
									
									contas_receber.inclusao,
									'Contas a Receber' as tipo_movimento
							from 

								(
									select
										movimento.cx_entrada,
										movimento.data_operacao,
										movimento.id,
										movimento.origem,
										sum(movimento.valor_entrada)/rateio_movimento.total as porcentagem
									from
										movimento,
										(
											select
												origem,
												sum(valor_entrada) as total
											from
												movimento
											where
												movimento.tipo=10
											group by
												origem
										) as rateio_movimento
										
									where
										rateio_movimento.origem=movimento.origem and
										movimento.tipo=10
									group by
										movimento.id,
										movimento.origem

								) as movimento_rateado_receber,

								contas_receber,
								(
								SELECT 
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.valor,
									tb_total.total as total_geral,
									sum(rateio_efetivo_composicao.valor)/tb_total.total as porcentagem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos

								FROM 
									rateio_efetivo_composicao,
									(SELECT 
											origem,
											sum(valor) as total

										FROM 
											rateio_efetivo_composicao
										where
											tipo=3
										group by
											origem) as tb_total
								where
									tb_total.origem=rateio_efetivo_composicao.origem and
									rateio_efetivo_composicao.tipo=3
								group by
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos
								
									) as rateio
								
								
							where
								movimento_rateado_receber.origem=contas_receber.grupo_baixa and
								rateio.origem=contas_receber.inclusao
							group by
								movimento_rateado_receber.id,
								movimento_rateado_receber.origem,
								movimento_rateado_receber.cx_entrada,
								movimento_rateado_receber.data_operacao,
								contas_receber.inclusao,
								contas_receber.id,
								rateio.planodecontas,
								rateio.centrodecustos
								
							-- contas a receber -------------------------------------

							union all

							-- lançamentos a credito --------------------------------




							select 
									movimento.id,
									movimento.data_operacao,
									
									movimento.cx_saida as caixa,

									rateio.planodecontas,
									rateio.centrodecustos,
									
									- ROUND(lancamentos_bancarios.valor*rateio.porcentagem, 2) as valor_rateado,

									rateio.total_geral,
									
									lancamentos_bancarios.id as origem,
									'Lançamentos bancarios a crédito' as tipo_movimento
							from 
								movimento,
								lancamentos_bancarios,
								(
								SELECT 
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.valor,
									tb_total.total as total_geral,
									rateio_efetivo_composicao.valor/tb_total.total as porcentagem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos

								FROM 
									rateio_efetivo_composicao,
									(SELECT 
											origem,
											sum(valor) as total

										FROM 
											rateio_efetivo_composicao
										where
											tipo=5
										group by
											origem) as tb_total
								where
									tb_total.origem=rateio_efetivo_composicao.origem and
									tipo=5
								group by
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos
								
									) as rateio
								
								
							where
								movimento.tipo='5' and
								lancamentos_bancarios.tipo=0 and
								movimento.origem=lancamentos_bancarios.id and
								rateio.origem=lancamentos_bancarios.id
							group by
								movimento.id,
								movimento.origem,
								movimento.cx_entrada,
								lancamentos_bancarios.id,
								rateio.planodecontas,
								rateio.centrodecustos







								
								
							-- lançamentos a credito --------------------------------

							union all
								
							-- lançamentos a debito --------------------------------

							select 
									movimento.id,
									movimento.data_operacao,
									
									movimento.cx_entrada as caixa,

									rateio.planodecontas,
									rateio.centrodecustos,
									
									ROUND(lancamentos_bancarios.valor*rateio.porcentagem, 2) as valor_rateado,

									rateio.total_geral,
									
									lancamentos_bancarios.id as origem,
									'Lançamentos bancarios a debito' as tipo_movimento
							from 
								movimento,
								lancamentos_bancarios,
								(
								SELECT 
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.valor,
									tb_total.total as total_geral,
									rateio_efetivo_composicao.valor/tb_total.total as porcentagem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos

								FROM 
									rateio_efetivo_composicao,
									(SELECT 
											origem,
											sum(valor) as total

										FROM 
											rateio_efetivo_composicao
										where
											tipo=6
										group by
											origem) as tb_total
								where
									tb_total.origem=rateio_efetivo_composicao.origem and
									tipo=6
								group by
									rateio_efetivo_composicao.origem,
									rateio_efetivo_composicao.planodecontas,
									rateio_efetivo_composicao.centrodecustos
								
									) as rateio
								
								
							where
								movimento.tipo='6' and
								lancamentos_bancarios.tipo=1 and
								movimento.origem=lancamentos_bancarios.id and
								rateio.origem=lancamentos_bancarios.id
							group by
								movimento.id,
								movimento.origem,
								movimento.cx_entrada,
								lancamentos_bancarios.id,
								rateio.planodecontas,
								rateio.centrodecustos



								
								
							-- lançamentos a debito --------------------------------

							union all
								
							-- Adiantamentos recebidos --------------------------------

								select
										movimento.id,
										movimento.data_operacao,
										
										movimento.cx_entrada as caixa,

										'' as planodecontas,
										'' as centrodecustos,
										
										ROUND(movimento.valor_entrada, 2) as valor_rateado,

										'' as total_geral,
										
										movimento.origem,
										'Adiantamentos recebidos' as tipo_movimento
								from 
										movimento
								where
										movimento.tipo=8 and
										movimento.cx_entrada!=''

							union all		
									
								select
										movimento.id,
										movimento.data_operacao,
										
										movimento.cx_saida as caixa,

										'' as planodecontas,
										'' as centrodecustos,
										
										- ROUND(movimento.valor_saida, 2) as valor_rateado,

										'' as total_geral,
										
										movimento.origem,
										'Adiantamentos recebidos' as tipo_movimento
								from 
										movimento
								where
										movimento.tipo=8 and
										movimento.cx_saida!=''
										
								
							-- Adiantamentos recebidos --------------------------------

							union all
								
							-- Adiantamentos pagos --------------------------------

								select
										movimento.id,
										movimento.data_operacao,
										
										movimento.cx_saida as caixa,

										'' as planodecontas,
										'' as centrodecustos,
										
										- ROUND(movimento.valor_saida, 2) as valor_rateado,

										'' as total_geral,
										
										movimento.origem,
										'Adiantamentos feitos' as tipo_movimento
								from 
										movimento
								where
										movimento.tipo=7 and
										movimento.cx_saida!=''
								
							union all

								select
										movimento.id,
										movimento.data_operacao,
										
										movimento.cx_entrada as caixa,

										'' as planodecontas,
										'' as centrodecustos,
										
										ROUND(movimento.valor_entrada, 2) as valor_rateado,

										'' as total_geral,
										
										movimento.origem,
										'Adiantamentos feitos' as tipo_movimento
								from 
										movimento
								where
										movimento.tipo=7 and
										movimento.cx_entrada!=''

							-- Adiantamentos pagos --------------------------------

							union all
								
							-- Transferencias bancárias -------------------------------	


							select
									movimento.id,
									movimento.data_operacao,
									
									movimento.cx_entrada as caixa,

									'' as planodecontas,
									'' as centrodecustos,
									
									ROUND(movimento.valor_entrada, 2) as valor_rateado,

									'' as total_geral,
									
									movimento.origem,
									'Transferencias recebidas' as tipo_movimento
							from 
									movimento
							where
									movimento.tipo=4 and
									movimento.cx_entrada!=''
								

							union all
								

							select
									movimento.id,
									movimento.data_operacao,
									
									movimento.cx_saida as caixa,

									'' as planodecontas,
									'' as centrodecustos,
									
									- ROUND(movimento.valor_saida, 2) as valor_rateado,

									'' as total_geral,
									
									movimento.origem,
									'Transferencias pagas' as tipo_movimento
							from 
									movimento
							where
									movimento.tipo=4 and
									movimento.cx_saida!=''





















							-- Transferencias bancárias -------------------------------	









							) as movimento_analitico



								left join plano_de_contas on movimento_analitico.planodecontas =plano_de_contas.id 
								left join centro_de_custos on movimento_analitico.centrodecustos =centro_de_custos.id
								left join caixas on movimento_analitico.caixa = caixas.id				
				
				) as tb_base_lcto
			
			
			
			
			
			
			
			");
			
				$json= "[";
					while ($row = $result->fetchArray()) {
						$json.= "{";
						for($n=0;$n<$result->numColumns();$n++){
							$json.= '"'.$result->columnName($n).'"'.":".'"'.$row[$n].'"|';
						}
						$json.= "}";
					}
				$json.= "]";
				$json=str_replace("}{","},{",$json);
				$json=str_replace('"|"','","',$json);
				$json=str_replace('|}','}',$json);
				
				echo $json;	
		
		}

		function insert(){
			include "config.php";

				$action=$_POST['action'];
				
				$db=$_POST['db'];
				$db=json_decode($db, true);
				$schema=$_POST['schema'];
				$tabela=$_POST['tabela'];
				$campos=array_keys($db[0]);
				
				$insert_campos="";
				$insert_valores="";

			//conexão
				$mysqli = new mysqli($servidor, $usuario, $senha, $schema_mysql);
				$mysqli->autocommit(FALSE);
				
			//limpar base	
				$select= "DELETE FROM `orcamento`.`".$tabela."` where `schema`='".$schema."';";
				$mysqli->query($select);
				$mysqli->commit();
				
			//inserir	de 1000 em 1000
				$x=0;
				for($i=0;$i<count($campos);$i++){
					$insert_campos.="`".$campos[$i]."`";
				}
			
				for($i=0;$i<count($db);$i++){
				
						$insert_valores.="(";
					for($n=0;$n<count($campos);$n++){
							$insert_valores.="'".str_replace(",","",str_replace("'","",$db[$i][$campos[$n]]))."'";
						}
						$insert_valores.=")";	
						
					if($x==1000){
						$x=0;
						
						$insert_campos=str_replace("``","`,`",$insert_campos);
						$insert_valores=str_replace(")(","),(",$insert_valores);
						$insert_valores=str_replace("''","','",$insert_valores);
						
						$select= "INSERT INTO `orcamento`.`".$tabela."` (".$insert_campos.") VALUES ".$insert_valores.";";
						$mysqli->query($select);
						$mysqli->commit();		
						
						$insert_valores="";
					}else{$x=$x+1;}

				}
						$insert_campos=str_replace("``","`,`",$insert_campos);
						$insert_valores=str_replace(")(","),(",$insert_valores);
						$insert_valores=str_replace("''","','",$insert_valores);
						
						$select= "INSERT INTO `orcamento`.`".$tabela."` (".$insert_campos.") VALUES ".$insert_valores.";";
						$mysqli->query($select);
						$mysqli->commit();
				


				
			//	echo $insert_campos;
			//	echo $insert_valores;
				
			//	$select= "DELETE FROM `orcamento`.`".$tabela."` where `schema`='".$schema."';";
			//	$resultado=mysql_query($select,$conexao) or die (mysql_error());				
			
			// echo "INSERT INTO `orcamento`.`".$tabela."` (".$insert_campos.") VALUES ".$insert_valores.";";
			
			//	$select= "INSERT INTO `orcamento`.`".$tabela."` (".$insert_campos.") VALUES ".$insert_valores.";";
			//	$resultado=mysql_query($select,$conexao) or die (mysql_error());
				
				


				

				
		echo "
				<div class='uk-alert uk-alert-success' data-uk-alert=''>
					<a href='' class='uk-alert-close uk-close'></a>
					<p>Os dados foram importados com sucesso!</p>
				</div>		
		";


				
				
		//		echo $db[1]['id'];
		//		echo $tabela;
		//		echo $action;
				
		//	echo $_POST['db'];
		//	echo   count($_POST);
		
		}		
		
		
	}

		$action= new action;
		$action-> $_POST['action']();


	?>