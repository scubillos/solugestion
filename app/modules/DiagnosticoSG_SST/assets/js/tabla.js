$(document).ready(function () {
	//Se definen elementos del DOM
	var elem = {
		idTable: "#TablaDiagnostico",
		pagerTable: "#TablaDiagnosticoPager",
		botonOpciones: ".viewOptions",
		modalOpciones: "#ModalOpciones",
		botonEditar: "#btnEditar",
	};
	
	//jqGrid
	$(elem.idTable).jqGrid({
		url: baseUrl() + 'DiagnosticoSG_SST/listar',
		mtype: "post",
		styleUI : 'Bootstrap',
		datatype: "json",
		colNames: ["fecha_diagnostico","estado","observaciones_diagnostico","",""],
		colModel: [
			{ name: 'fecha_diagnostico', width: 75 },
			{ name: 'estado', width: 75 },
			{ name: 'observaciones_diagnostico', width: 75 },
			{ name: '', width: 50 },
			{ name: 'link', width: 150, hidden:true }
		],
		height: "auto",
		width: $(elem.idTable).parent().width() - 50,
		rowList: [10, 20,50, 100],
		rowNum: 10,
		page: 1,
		pager: elem.pagerTable,
		loadtext: '<p>Cargando...',
		beforeRequest: function(data, status, xhr){},
		align:"center",
		viewrecords: true
	});
	
	//Modal opciones
	$(elem.idTable).on("click",elem.botonOpciones,function(e){
		e.preventDefault();
		e.returnValue=false;
		e.stopPropagation();
		
		var id = $(this).data("id");
		var rowINFO = $(elem.idTable).getRowData(id);
		var options = rowINFO["link"];
		
		$(elem.modalOpciones).find('.modal-title').empty().html('DiagnosticoSG_SST: <b>'+ rowINFO["fecha_diagnostico"]+'</b>');
		$(elem.modalOpciones).find('.modal-body').empty().html(options);
		$(elem.modalOpciones).find('.modal-footer').empty();
		$(elem.modalOpciones).modal('show');
	});
	
});