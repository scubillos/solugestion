jQuery.extend(jQuery.validator.messages, {
    required: "Este campo es obligatorio."
});
$(function() {
    $( "#CrearForm" ).validate( {
		rules: {
			"campo[nombre_tipo]":{
				required: true
			},
			"campo[estado]":{
				required: true
			},
			"campo[subseccion]":{
				required: true
			},
		},
		messages: {
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