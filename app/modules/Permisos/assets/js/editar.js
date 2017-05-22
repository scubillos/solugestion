$(document).ready(function () {
	//Se definen elementos del DOM
	var elem = {
		idTable: "#TablaPermisos",
		allPermissions: "#allPermissions",
		onePermission: ".onePermission"
	};
	
	$(elem.allPermissions).change(function(e){
		if($(this).is(":checked")){
			$(elem.onePermission).each(function(i){
				$(this).prop("checked",true);
			});
		}else{
			$(elem.onePermission).each(function(i){
				$(this).prop("checked",false);
			});
		}
	});
	
	$(elem.onePermission).change(function(e){
		if($(this).hasClass("menuPadre")){
			var valor = $(this).val();
			if($(this).is(":checked")){
				$("input[data-idpadre='"+valor+"']").each(function(i){
					$(this).prop("checked",true);
				});
			}else{
				$("input[data-idpadre='"+valor+"']").each(function(i){
					$(this).prop("checked",false);
				});
			}
		}else{
			var idPadre = $(this).data("idpadre");
			if(idPadre !== undefined){
				if($(this).is(":checked")){				
					$("#Padre_"+idPadre).prop("checked",true);
				}
			}
		}
	});
	
});