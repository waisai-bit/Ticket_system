$(document).ready(function () 
{
	$('#datatableid').DataTable();
});

$("#addUser").click(function () {
    $("#userModal").modal("show");
    $("#userForm")[0].reset();
    $(".modal-title").html("<h4><i class='fa fa-plus'> </i> Add User</h4>");
    // $("#action").val("addUser");
    $("#save").val("Save");
});

$("#addDepartment").click(function () {
    $("#departmentModal").modal("show");
    $("#departmentForm")[0].reset();
    $(".modal-title").html("<h4><i class='fa fa-plus'> </i> Add Department</h4>");
    $("#save").val("Save");
});

$("#addTicket").click(function () {
    $("#ticketModal").modal("show");
    $("#ticketForm")[0].reset();
    $(".modal-title").html("<h4><i class='fa fa-plus'> </i> Add Ticket</h4>");
    $("#create").val("Save Ticket");
});
