$('.table-clickable tr').click(function (event) {
	if($(this).attr('id') != undefined){
		window.location = "/issue/"+$(this).attr('id');
	}
});

$("#inputProject").change(function() {
	window.location = "/"+$("#inputProject option:selected").val()+"/issues";
});

