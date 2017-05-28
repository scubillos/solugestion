$(document).ready(function () {
	//Se definen elementos del DOM
	var elem = {
		idTable: "#TablaAdmParamDiagnostico",
		pagerTable: "#TablaAdmParamDiagnosticoPager",
		botonOpciones: ".viewOptions",
		modalOpciones: "#ModalOpciones",
		botonEditar: "#btnEditar",
		botonEliminar: "#btnEliminar"
	};
	
	//jqGrid
	$(elem.idTable).jqGrid({
		url: baseUrl() + 'AdmDiagnosticoSG_SST/listar',
		mtype: "post",
		styleUI : 'Bootstrap',
		datatype: "json",
		colNames: ["Paso","Seccion","Subseccion","Numeral","Marco legal","Criterio","Modo de verificación","",""],
		colModel: [
			{ name: 'paso', width: 40 },
			{ name: 'seccion', width: 75 },
			{ name: 'subseccion', width: 75 },
			{ name: 'numeral', width: 40 },
			{ name: 'marco_legal', width: 75 },
			{ name: 'criterio', width: 75 },
			{ name: 'modo_verificacion', width: 75 },
			{ name: '', width: 50 },
			{ name: 'link', width: 150, hidden:true }
		],
		height: "auto",
		width: $(elem.idTable).parent().width() - 100,
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
		
		$(elem.modalOpciones).find('.modal-title').empty().html('Catalogo: <b>'+ rowINFO["numeral"]+rowINFO["marco_legal"] +'</b>');
		$(elem.modalOpciones).find('.modal-body').empty().html(options);
		$(elem.modalOpciones).find('.modal-footer').empty();
		$(elem.modalOpciones).modal('show');
	});
	//Eliminar
	$(elem.modalOpciones).on("click",elem.botonEliminar,function(e){
		e.preventDefault();
		e.returnValue=false;
		e.stopPropagation();
		
		var id = $(this).data("id");
		
		$.ajax({
			url: baseUrl() + "AdmCatalogos/eliminar",
			type:"post",
			async:false,
			data: { id: id },
			success:function(response,status){
				var data = $.parseJSON(response);
				if(data.finish == true){
					Toast(data.message, data.status, data.title);
					$(elem.modalOpciones).modal("hide");
				}
			}
		});
	});
});