$(document).ready(function () {
	//Se definen elementos del DOM
	var elem = {
		idTable: "#TablaAdmCatalogos",
		pagerTable: "#TablaAdmCatalogosPager",
		botonOpciones: ".viewOptions",
		modalOpciones: "#ModalOpciones",
		botonEditar: "#btnEditar",
		botonEliminar: "#btnEliminar",
		botonReset: "#resetForm",
	};
	
	//jqGrid
	$(elem.idTable).jqGrid({
		url: baseUrl() + 'AdmCatalogos/listar',
		mtype: "post",
		styleUI : 'Bootstrap',
		datatype: "json",
		colNames: ["Módulo","Tipo","Valor","Texto","Observaciones","",""],
		colModel: [
			{ name: 'modulo', width: 75 },
			{ name: 'tipo', width: 75 },
			{ name: 'valor', width: 75 },
			{ name: 'texto', width: 75 },
			{ name: 'observaciones', width: 75 },
			{ name: '', width: 50 },
			{ name: 'link', width: 150, hidden:true }
		],
		height: "auto",
		autowidth: true,
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
		
		$(elem.modalOpciones).find('.modal-title').empty().html('Catalogo: <b>'+ rowINFO["texto"] +'</b>');
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
	//Editar
	$(elem.modalOpciones).on("click",elem.botonEditar,function(e){
		e.preventDefault();
		e.returnValue=false;
		e.stopPropagation();
		
		var id = $(this).data("id");
		
		$.ajax({
			url: baseUrl() + "AdmCatalogos/ajax_editar",
			type:"post",
			async:false,
			data: { id: id },
			success:function(response,status){
				var data = $.parseJSON(response);
				$("#id_hidden").val(data.id);
				$("#modulo").val(data.modulo);
				$("#tipo").val(data.tipo);
				$("#valor").val(data.valor);
				$("#texto").val(data.texto);
				if(data.oculto == 1){
					$("#oculto").prop("checked",true);
				}
				$("#observaciones").val(data.observaciones);
				$(elem.modalOpciones).modal("hide");
			}
		});
	});
});