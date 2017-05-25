
$(function() {
    var elem = {
		paso:"#paso",
		seccion:"#seccion",
		subseccion:"#subseccion"
	}
	var tags = {
		optionVacio:'<option value="">Seleccione</option>'
	};
	
	$(elem.paso).change(function(e){
		var id_paso = $(this).val();
		
		$.ajax({
			url: baseUrl() + "AdmDiagnosticoSG_SST/ajax_buscarSecciones",
			type:"post",
			async:false,
			data: { id_paso: id_paso },
			success:function(response,status){
				var data = $.parseJSON(response);
				if(data.finish == true){
					var options = data.options;
					$(elem.seccion).html(tags.optionVacio);
					_.forEach(options,function(option){
						var tagOption = '<option value="'+option.id+'">'+option.texto+'</option>';
						$(elem.seccion).append(tagOption);
					});
				}
			}
		});
	});

});
