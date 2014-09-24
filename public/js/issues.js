$('.table-clickable.issues-list-table tr').click(function (event) {
	if($(this).attr('id') != undefined){
		window.location = "/issue/"+$(this).attr('id');
	}
});

$("#inputProjectList").change(function() {
	window.location = "/"+$("#inputProjectList option:selected").val()+"/issues";
});

$("#inputProject").change(function() {
	window.location = "/"+$("#inputProject option:selected").val()+"/issues/add";
});