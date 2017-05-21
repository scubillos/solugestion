jQuery.extend(jQuery.validator.messages, {
    required: "Este campo es obligatorio."
});
$(function() {
    $( "#CrearForm" ).validate( {
		rules: {
			"campo[nit]":{
				required: true,
				number: true
			},

			"campo[telefono]":{
				number: true
			},

			"campo[num_percontacto]":{
				number: true
			},

			"campo[num_movil]":{
				number: true
			},

			"campo[correo]":{
				email: true
			},

			rpass:{
				equalTo: pass
			}

		},
		messages: {
			"campo[nit]": "Este campo debe ser un número",
			"campo[telefono]": "Este campo debe ser un número",
			"campo[num_percontacto]": "Este campo debe ser un número",
			"campo[num_movil]": "Este campo debe ser un número",
			"campo[correo]": "Ingrese una direccion de correo valida",
			rpass: "Las contraseñas no coinciden"
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		}
	} );

});
