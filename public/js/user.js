$(document).ready(function () {
    // enable user profile for edit
    $("#btnEdit").click(function (event) {
        event.preventDefault();
        $("#frm input, #frm select, #frm button").removeAttr("disabled");
    });
    $("#btnCancel").click(function () {
        $("#frm input, #frm select, #frm button").attr("disabled", "disabled");
        location.reload();
    });
});
function loadFile(e){
    var output = document.getElementById('preview');
    output.src = URL.createObjectURL(e.target.files[0]);
}

