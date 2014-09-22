function redirectToIssuesAction(){
    $('.table-clickable tr').click(function (event) {
    	window.location = "/issue/"+$(this).attr('id');
   });
}

redirectToIssuesAction();