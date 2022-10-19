(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Español)
 */
$.extend($.validator.messages, {
	required: "Esta información es obligatoria.",
	remote: "Llenar este registro.",
	email: "Escribe una dirección de correo válida.",
	url: "Escribe una URL válida.",
	date: "Escribe una fecha válida.",
	dateISO: "Por favor, escribe una fecha (ISO) válida.",
	number: "Escribe un número válido.",
	digits: "Escribe sólo dígitos.",
	caracter: "Escribe sólo letras",
	creditcard: "Ecribe un número de tarjeta válido.",
	equalTo: "Escribe el mismo valor de nuevo.",
	extension: "Escribe un valor con una extensión aceptada.",
	maxlength: $.validator.format("Caracteres no más de {0} permitidos."),
	minlength: $.validator.format("Caracteres no menos de {0} permitidos."),
	rangelength: $.validator.format("Escribir valor entre {0} y {1} caracteres."),
	range: $.validator.format("Escribir un valor entre {0} y {1}."),
	max: $.validator.format("Escribir un valor menor o igual a {0}."),
	min: $.validator.format("Escribir un valor mayor o igual a {0}."),
	nifES: "Por favor, escribe un NIF válido.",
	nieES: "Por favor, escribe un NIE válido.",
	cifES: "Por favor, escribe un CIF válido."
});

}));