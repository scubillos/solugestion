
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
				}else{
					$(elem.seccion).html('<option value="">Seleccione primero un paso</option>');
				}
			}
		});
	});
	
	$(elem.seccion).change(function(e){
		var id_seccion = $(this).val();
		
		$.ajax({
			url: baseUrl() + "AdmDiagnosticoSG_SST/ajax_buscarSubsecciones",
			type:"post",
			async:false,
			data: { id_seccion: id_seccion },
			success:function(response,status){
				var data = $.parseJSON(response);
				
				if(data.finish == true){
					var options = data.options;
					$(elem.subseccion).html(tags.optionVacio);
					_.forEach(options,function(option){
						var tagOption = '<option value="'+option.id+'">'+option.texto+'</option>';
						$(elem.subseccion).append(tagOption);
					});
				}else{
					$(elem.subseccion).html('<option value="">Seleccione primero una sección</option>');
				}
			}
		});
	});

});
