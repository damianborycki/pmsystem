$('.table-clickable.projects-list-table tr').click(function (event) {
	if($(this).attr('id') != undefined){
		window.location = "/"+$(this).attr('id')+"/";
	}
});
