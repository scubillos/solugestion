//Toast
function Toast(message, status, title){
	if(status === undefined){
		status = "success";
	}
	if(title === undefined){
		title = "";
	}
	$.toast({
		heading: "<b>"+title+"</b>",
		text: message,
		icon: status,
		position: "top-right",
		hideAfter: 5000
	});
}