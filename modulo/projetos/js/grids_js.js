
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
					if(a.columns[x].width==undefined || a.columns[x].width==""){var width="100px";}else{var width=a.columns[x].width;}
					thead+=
						"<th style='padding: 0px;'>"+
							"<div class='uk-text-truncate' data-uk-tooltip title='"+a.columns[x].headerText+"' style='width:"+width+";padding: 2px; text-align: center; vertical-align: middle;'>"
								+a.columns[x].headerText+
							"</div>"+
							"<div class='uk-form uk-form-icon' style='width:"+width+";padding: 2px; text-align: center; vertical-align: middle;'>"+
							"<i class='uk-icon-filter'></i>"+
							"<input class='filter_table' id='"+a.columns[x].key+"' placeholder='contém...' style='width: 100%;' class='uk-form-small' type='text'>"+
							"</div>"+
						"</th>";
				}
				 thead+="<th style='width: 100% !important;'></th></tr></thead>";			
				 //overflow-y: auto ! important; overflow-x: hidden; position: absolute; top: 69px; bottom: 15px;
				 tbody="<tbody id='tbody_"+a.idGrid+"' style=' '><tbody>"
				document.getElementById(a.idGrid).innerHTML="<div style='width:"+a.width+"; ' ><table id='"+a.tableId+"' class='uk-table uk-table-condensed uk-table-hover' style='font-size: 12px; border-top: 0px none ! important;'>"+thead+tbody+"</table></div>";
			
		
		
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
								if(a.columns[y].width==undefined || a.columns[y].width==""){var width="100px";}else{var width=a.columns[y].width;}
								tbody_+=
								"<td style='padding: 0px 1px 0px 0px;'>"+
									"<div class='uk-text-truncate' style='width:"+width+";padding: 2px; vertical-align: middle;"+align+"'>"
										+a.dataSource[x][a.columns[y].key]+
									"</div>"+						
								"</td>";
						}
						tbody_+="<td style='width: 100% !important;'></td></tr>";
						if(incluir>0){
						tbody+=tbody_;
						}
					}

					document.getElementById("tbody_"+a.idGrid).innerHTML=tbody;
					$('tbody tr').dblclick(function(){ 
						if(this.id!=""){
							//window.open('?act=editar&mod='+a.tableId+'&id='+this.id, '_blank');	
							window.open('?act=cadastros&mod='+a.tableId+'&id='+this.id, '_blank');							
							
						}					
						
					});
		
		}	
		
		constroi_thead(a);
		constroi_tbody(a);
		
		$('.filter_table').keyup(function(){ 
			tabela.filter(this.id,this.value);
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
			
			thead+="<th style='width:"+a.columns[x].width+";  "+align+"' class='uk-text-truncate' style='width:"+a.columns[x].width+"; vertical-align: middle;'>"+a.columns[x].headerText+"</th>";
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
						
						if(a.columns[y].dataType=='checkbox'){

								table_tr+="<td class='uk-text-truncate' style='width:"+a.columns[y].width+";padding-left:"+padding+"px; vertical-align: middle;"+align+"'>"+'<input type=checkbox '+node[a.columns[y].key]+'>'+"</td>";							
							}
						else{
								table_tr+="<td class='uk-text-truncate' style='width:"+a.columns[y].width+";padding-left:"+padding+"px; vertical-align: middle;"+align+"'>"+node[a.columns[y].key]+"</td>";
							
						}
						
						
						
				}
				table_tr+= "</tr>";
				table_tr+= subMenu;
				return  table_tr;
			});
		}

		tbody="<tbody id='tbody_"+a.idGrid+"' style=''>"+getTbody(-1,0,0)+"<tbody>";
		var table="<div style='100%' ><table class='uk-table uk-table-condensed uk-table-hover'>"+thead+tbody+"</table></div>";
		document.getElementById(a.idGrid).innerHTML=table;
		


	
	}
// colResizable 1.5 - a jQuery plugin by Alvaro Prieto Lauroba http://www.bacubacu.com/colresizable/
//(function($){var d=$(document),h=$("head"),drag=null,tables=[],count=0,ID="id",PX="px",SIGNATURE="JColResizer",FLEX="JCLRFlex",I=parseInt,M=Math,ie=navigator.userAgent.indexOf('Trident/4.0')>0,S;try{S=sessionStorage}catch(e){};h.append("<style type='text/css'>  .JColResizer{table-layout:fixed;} .JColResizer td, .JColResizer th{overflow:hidden;padding-left:0!important; padding-right:0!important;}  .JCLRgrips{ height:0px; position:relative;} .JCLRgrip{margin-left:-5px; position:absolute; z-index:5; } .JCLRgrip .JColResizer{position:absolute;background-color:red;filter:alpha(opacity=1);opacity:0;width:10px;height:100%;cursor: e-resize;top:0px} .JCLRLastGrip{position:absolute; width:1px; } .JCLRgripDrag{ border-left:1px dotted black;	} .JCLRFlex{width:auto!important;}</style>");var init=function(tb,options){var t=$(tb);t.opt=options;if(t.opt.disable)return destroy(t);var id=t.id=t.attr(ID)||SIGNATURE+ count++;t.p=t.opt.postbackSafe;if(!t.is("table")||tables[id]&&!t.opt.partialRefresh)return;t.addClass(SIGNATURE).attr(ID,id).before('<div class="JCLRgrips"/>');t.g=[];t.c=[];t.w=t.width();t.gc=t.prev();t.f=t.opt.fixed;if(options.marginLeft)t.gc.css("marginLeft",options.marginLeft);if(options.marginRight)t.gc.css("marginRight",options.marginRight);t.cs=I(ie?tb.cellSpacing||tb.currentStyle.borderSpacing:t.css('border-spacing'))||2;t.b=I(ie?tb.border||tb.currentStyle.borderLeftWidth:t.css('border-left-width'))||1;tables[id]=t;createGrips(t)},destroy=function(t){var id=t.attr(ID),t=tables[id];if(!t||!t.is("table"))return;t.removeClass(SIGNATURE+" "+FLEX).gc.remove();delete tables[id]},createGrips=function(t){var th=t.find(">thead>tr>th,>thead>tr>td");if(!th.length)th=t.find(">tbody>tr:first>th,>tr:first>th,>tbody>tr:first>td, >tr:first>td");t.cg=t.find("col");t.ln=th.length;if(t.p&&S&&S[t.id])memento(t,th);th.each(function(i){var c=$(this),g=$(t.gc.append('<div class="JCLRgrip"></div>')[0].lastChild);g.append(t.opt.gripInnerHtml).append('<div class="'+SIGNATURE+'"></div>');if(i==t.ln-1){g.addClass("JCLRLastGrip");if(t.f)g.html("")};g.bind('touchstart mousedown',onGripMouseDown);g.t=t;g.i=i;g.c=c;c.w=c.width();t.g.push(g);t.c.push(c);c.width(c.w).removeAttr("width");g.data(SIGNATURE,{i:i,t:t.attr(ID),last:i==t.ln-1})});t.cg.removeAttr("width");syncGrips(t);t.find('td, th').not(th).not('table th, table td').each(function(){$(this).removeAttr('width')});if(!t.f)t.removeAttr('width').addClass(FLEX)},memento=function(t,th){var w,m=0,i=0,aux=[],tw;if(th){t.cg.removeAttr("width");if(t.opt.flush){S[t.id]="";return};w=S[t.id].split(";");tw=w[t.ln+1];if(!t.f&&tw)t.width(tw);for(;i<t.ln;i++){aux.push(100*w[i]/w[t.ln]+"%");th.eq(i).css("width",aux[i])};for(i=0;i<t.ln;i++)t.cg.eq(i).css("width",aux[i])}else{S[t.id]="";for(;i<t.c.length;i++){w=t.c[i].width();S[t.id]+=w+";";m+=w};S[t.id]+=m;if(!t.f)S[t.id]+=";"+t.width()}},syncGrips=function(t){t.gc.width(t.w);for(var i=0;i<t.ln;i++){var c=t.c[i];t.g[i].css({left:c.offset().left-t.offset().left+c.outerWidth(false)+t.cs/2+PX,height:t.opt.headerOnly?t.c[0].outerHeight(false):t.outerHeight(false)})}},syncCols=function(t,i,isOver){var inc=drag.x-drag.l,c=t.c[i],c2=t.c[i+1],w=c.w+inc,w2=c2.w-inc;c.width(w+PX);t.cg.eq(i).width(w+PX);if(t.f){c2.width(w2+PX);t.cg.eq(i+1).width(w2+PX)};if(isOver){c.w=w;c2.w=t.f?w2:c2.w}},applyBounds=function(t){var w=$.map(t.c,function(c){return c.width()});t.width(t.width()).removeClass(FLEX);$.each(t.c,function(i,c){c.width(w[i]).w=w[i]});t.addClass(FLEX)},onGripDrag=function(e){if(!drag)return;var t=drag.t,oe=e.originalEvent.touches,ox=oe?oe[0].pageX:e.pageX,x=ox-drag.ox+drag.l,mw=t.opt.minWidth,i=drag.i,l=t.cs*1.5+mw+t.b,last=i==t.ln-1,min=i?t.g[i-1].position().left+t.cs+mw:l,max=t.f?i==t.ln-1?t.w-l:t.g[i+1].position().left-t.cs-mw:Infinity;x=M.max(min,M.min(max,x));drag.x=x;drag.css("left",x+PX);if(last){var c=t.c[drag.i];drag.w=c.w+x-drag.l};if(t.opt.liveDrag){if(last){c.width(drag.w);t.w=t.width()}else syncCols(t,i);syncGrips(t);var cb=t.opt.onDrag;if(cb){e.currentTarget=t[0];cb(e)}};return false},onGripDragOver=function(e){d.unbind('touchend.'+SIGNATURE+' mouseup.'+SIGNATURE).unbind('touchmove.'+SIGNATURE+' mousemove.'+SIGNATURE);$("head :last-child").remove();if(!drag)return;drag.removeClass(drag.t.opt.draggingClass);var t=drag.t,cb=t.opt.onResize,i=drag.i,last=i==t.ln-1,c=t.g[i].c;if(last){c.width(drag.w);c.w=drag.w}else syncCols(t,i,true);if(!t.f)applyBounds(t);syncGrips(t);if(cb){e.currentTarget=t[0];cb(e)};if(t.p&&S)memento(t);drag=null},onGripMouseDown=function(e){var o=$(this).data(SIGNATURE),t=tables[o.t],g=t.g[o.i],oe=e.originalEvent.touches;g.ox=oe?oe[0].pageX:e.pageX;g.l=g.position().left;d.bind('touchmove.'+SIGNATURE+' mousemove.'+SIGNATURE,onGripDrag).bind('touchend.'+SIGNATURE+' mouseup.'+SIGNATURE,onGripDragOver);h.append("<style type='text/css'>*{cursor:"+t.opt.dragCursor+"!important}</style>");g.addClass(t.opt.draggingClass);drag=g;if(t.c[o.i].l)for(var i=0,c;i<t.ln;i++){c=t.c[i];c.l=false;c.w=c.width()};return false},onResize=function(){for(t in tables){var t=tables[t],i,mw=0;t.removeClass(SIGNATURE);if(t.f&&t.w!=t.width()){t.w=t.width();for(i=0;i<t.ln;i++)mw+=t.c[i].w;for(i=0;i<t.ln;i++)t.c[i].css("width",M.round(1e3*t.c[i].w/mw)/10+"%").l=true};syncGrips(t.addClass(SIGNATURE))}};$(window).bind('resize.'+SIGNATURE,onResize);$.fn.extend({colResizable:function(options){var defaults={draggingClass:'JCLRgripDrag',gripInnerHtml:'',liveDrag:false,fixed:true,minWidth:15,headerOnly:false,hoverCursor:"e-resize",dragCursor:"e-resize",postbackSafe:false,flush:false,marginLeft:null,marginRight:null,disable:false,partialRefresh:false,onDrag:null,onResize:null},options=$.extend(defaults,options);return this.each(function(){init(this,options)})}})})(jQuery)
	


