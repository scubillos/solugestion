$(document).ready(function () {
	
	var idTable = "#TablaTiposUsuario";
	var pagerTable = "#TablaTiposUsuarioPager";
	
	
	$(idTable).jqGrid({
		url: '',
		mtype: "GET",
		styleUI : 'Bootstrap',
		datatype: "json",
		colModel: [
			{ label: 'Nombre', name: 'nombre_tipo', key: true, width: 75 },
			{ label: 'Estado', name: 'estado', width: 150 }
		],
		viewrecords: true,
		height: 250,
		width: $(idTable).parent().width()-100,
		rowNum: 20,
		pager: pagerTable
	});
});