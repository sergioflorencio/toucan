
	function Grid(a){

		a.idGrid=a.idGrid;
		a.dataSource=a.dataSource;
		a.columns=a.columns;
		a.width=a.width;
		a.height=a.height;
		a.filtering=a.filtering;
		a.paging=a.paging;
		a.filter_key="";
		a.filter_value="";
		a.tableId=a.tableId;
		
		this.filter = function (filter_key,filter_value) {
			a.filter_key=filter_key;
			a.filter_value=filter_value;
			constroi_tbody(a);
		};		
			
		function constroi_thead(a){
			//thead
				var tbody="";			
				var thead="";			
				var nColunas=a.columns.length;
				var thead="<thead><tr>";
				for(var x=0;x<nColunas;x++){
					thead+=
						"<th style='padding: 0px;width:"+a.columns[x].width+"'>"+
							"<div class='uk-text-truncate' data-uk-tooltip title='"+a.columns[x].headerText+"' style='width:"+a.columns[x].width+";padding: 2px; text-align: center; vertical-align: middle;'>"
								+a.columns[x].headerText+
							"</div>"+
							"<div class='uk-form uk-form-icon' style='width:"+a.columns[x].width+";padding: 2px; text-align: center; vertical-align: middle;'>"+
							"<i class='uk-icon-filter'></i>"+
							"<input class='filter_table' id='"+a.columns[x].key+"' placeholder='contém...' style='width: 100%;' class='uk-form-small' type='text'>"+
							"</div>"+
						"</th>";
				}
				 thead+="<th></th></tr></thead>";			
				 tbody="<tbody id='tbody_"+a.idGrid+"' style=' overflow-y: auto ! important; overflow-x: hidden; position: absolute; top: 69px; bottom: 15px;'><tbody>"
				document.getElementById(a.idGrid).innerHTML="<div style='width:"+a.width+"; ' ><table class='uk-table uk-table-condensed uk-table-hover' style=' border-top: 0px none ! important;'>"+thead+tbody+"</table></div>";
			
		
		
		}	
		function constroi_tbody(a){
			//alert(a.filter_value);
			//tbody
				var tbody="";
				var nColunas=a.columns.length;
				var nLinhas=a.dataSource.length;

					///1/// percorrer linhas
					for(var x=0;x<nLinhas;x++){
						incluir=0;
						tbody_="<tr id='"+a.dataSource[x].id+"'>";
						///2/// percorrer colunas
						for(var y=0;y<nColunas;y++){
							var valor_=String(a.dataSource[x][a.columns[y].key]);
								if(a.filter_key==a.columns[y].key && a.filter_value!="" && valor_.indexOf(a.filter_value) != -1){
									incluir=incluir+1;
								}
								if(a.filter_key=="" || a.filter_value==""){
									incluir=incluir+1;
								}
								if(a.columns[y].dataType=='number'){ align="text-align: right !important;"; }
								else{align="text-align: left !important;";}		
								tbody_+=
								"<td style='padding: 0px;width:"+a.columns[y].width+";'>"+
									"<div class='uk-text-truncate' style='width:"+a.columns[y].width+";padding: 2px; vertical-align: middle;"+align+"'>"
										+a.dataSource[x][a.columns[y].key]+
									"</div>"+						
								"</td>";
						}
						tbody_+="<td></td></tr>";
						if(incluir>0){
						tbody+=tbody_;
						}
					}

					document.getElementById("tbody_"+a.idGrid).innerHTML=tbody;
		
		
		}	
		
		constroi_thead(a);
		constroi_tbody(a);
		
		$('.filter_table').keyup(function(){ 
			tabela.filter(this.id,this.value);
		});
		$('tbody tr').dblclick(function(){ 
		
			window.location.assign('?act=cadastros&mod='+a.tableId+'&id='+this.id);
		});
		
		
	}

	
	function TreeGrid(a){

		a.idGrid=a.idGrid;
		a.dataSource=a.dataSource;
		a.columns=a.columns;
		a.width=a.width;
		a.height=a.height;
		a.ID=a.ID;
		a.PID=a.PID;

		var data=a.dataSource;
		var tbody="";			
		var thead="";			
		var nColunas=a.columns.length;
		
		
		var thead="<thead style=''><tr><td style='display: none;'></td>";
		//display: none;
		for(var x=0;x<nColunas;x++){
			if(a.columns[x].dataType=='number'){ align="text-align: right !important;"; }
			else{align="text-align: left !important;";}		
			
			thead+=
				"<th style='width:"+a.columns[x].width+";  "+align+"' class='uk-text-truncate' style='width:"+a.columns[x].width+"; vertical-align: middle;'>"+
						a.columns[x].headerText+
				"</th>";
		}
		 thead+="</tr></thead>";			
	
		function getTbody( parentID,padding_,nivel ){
			return data.filter(function(node){ return ( node.PID === parentID ) ; }).sort(function(a,b){return a.ID > b.ID}).map(function(node){
				var exists = data.some(function(childNode){  return childNode.PID === node.ID; });
				var subMenu = (exists) ? getTbody(node.ID,padding_+30,nivel+1).join('') : "";
				var table_tr= "<tr class='nivel' id='"+node.ID+"'><td style='display: none;'>"+nivel+"</td>";
				//display: none;
				var nColunas=a.columns.length;
				for(var y=0;y<nColunas;y++){
					var valor_=String(node[a.columns[y].key]);
						if(a.filter_key==a.columns[y].key && a.filter_value!="" && valor_.indexOf(a.filter_value) != -1){
							incluir=incluir+1;
						}
						if(a.filter_key=="" || a.filter_value==""){
							incluir=incluir+1;
						}
						if(y==0){padding=padding_;}else{padding=0;}
						
						if(a.columns[y].dataType=='number'){ align="text-align: right !important;"; }
						else{align="text-align: left !important;";}
						
						table_tr+=
						"<td class='uk-text-truncate' style='width:"+a.columns[y].width+";padding-left:"+padding+"px; vertical-align: middle;"+align+"'>"+
							node[a.columns[y].key]+
						"</td>";
				}
				table_tr+= "</tr>";
				table_tr+= subMenu;
				return  table_tr;
			});
		}

			tbody="<tbody id='tbody_"+a.idGrid+"' style=''>"+getTbody(-1,0,0)+"<tbody>";
		var table="<div style='width:"+a.width+"; ' ><table class='uk-table uk-table-condensed uk-table-hover'>"+thead+tbody+"</table></div>";
			document.getElementById(a.idGrid).innerHTML=table;
		$(function() {
			$("tr").click(function(event) {
				var tr=document.getElementsByClassName('nivel');
				var display=tr[this.rowIndex].style.display;
				for(x=this.rowIndex;tr[x].getElementsByTagName('td')[0].innerHTML>this.childNodes[0].innerHTML;x++){
					if(display == "none"){tr[x].style.display = "";}else{tr[x].style.display = "none";	}
				}
			});
		});
		$('tbody tr').dblclick(function(){ 
			if(this.id!=""){
				window.open('?act=editar&mod='+a.tableId+'&id='+this.id, '_blank');				
				
			}

		});
	
	}
