$(document).ready(function () {
	//Se definen elementos del DOM
	var elem = {
		idTable: "#TablaTiposUsuario",
		pagerTable: "#TablaTiposUsuarioPager",
		botonOpciones: ".viewOptions",
		modalOpciones: "#ModalOpciones",
		botonEliminar: "#btnEliminar",
	};
	
	//jqGrid
	$(elem.idTable).jqGrid({
		url: baseUrl() + 'TiposUsuario/listar',
		mtype: "post",
		styleUI : 'Bootstrap',
		datatype: "json",
		colNames: ["Nombre","Estado","",""],
		colModel: [
			{ name: 'nombre_tipo', width: 75 },
			{ name: 'estado', width: 150 },
			{ name: '', width: 50 },
			{ name: 'link', width: 150, hidden:true }
		],
		height: "auto",
		//autowidth: true,
		width: $(elem.idTable).parent().width()/2,
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
		
		$(elem.modalOpciones).find('.modal-title').empty().html('Tipo de usuario: <b>'+ rowINFO["nombre_tipo"] +'</b>');
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
			url: baseUrl() + "TiposUsuario/eliminar",
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