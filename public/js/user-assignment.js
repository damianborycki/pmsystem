$(function() {
  var assignment    = $("#assignment");
  var usersList     = assignment.find("#users");
  var assignedUsers = $("#assigned-users");

  assignment.find("#assign-user").on("click", function() {
    usersList.html("");

    $.get("/userassignment/fetchusers/" + assignment.data('issue-id'))
     .done(function(data) {
      usersList.html(data);
    });
  });

  $(document).on("click", "#assignment #users li a", function(e) {
    e.preventDefault();
    var self = $(this);

    $.post("/issue/" + assignment.data('issue-id') + "/assignuser", { 
      userId: self.data("id")
    }).done(function() {
      assignedUsers.append(self.text() + "<br>");
    });
  });
});
