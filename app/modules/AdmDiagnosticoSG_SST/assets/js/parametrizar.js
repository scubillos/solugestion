
$(function() {
    var elem = {
		tipoUsuario:"#tipo_usuario",
		tablaParametros:"#divTblParametros"
	}
	
	$(elem.tipoUsuario).change(function(){
		var tipoUsuario = $(this).val();
		if(tipoUsuario != ""){
			$.ajax({
				url: baseUrl() + "AdmDiagnosticoSG_SST/ajax_getParametrizacionTipo",
				type:"post",
				async:false,
				data: { tipoUsuario: tipoUsuario },
				success:function(response,status){
					var data = response;
					$(elem.tablaParametros).empty();
					$(elem.tablaParametros).html(data);
				}
			});
		}else{
			$(elem.tablaParametros).empty();
		}
	});
	
});
