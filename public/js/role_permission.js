$(document).ready(function(){


});
// function to insert and update role permission
function save(obj)
{
    var x = $(obj).val();
    if(x==1)
    {
        $(obj).val("0");
    }
    else
    {
        $(obj).val("1");
    }
    var tr = $(obj).parent().parent().parent();
    var tds = $(tr).find("label");
    var l, i, u, d;
    l = $(tds[0]).children("input").val();
    i = $(tds[1]).children("input").val();
    u = $(tds[2]).children("input").val();
    d = $(tds[3]).children("input").val();
    // create data object to insert or update

    var data = {
        id: $(tr).attr('id'),
        role_id: $(tr).attr("role-id"),
        permission_id: $(tr).attr('permission-id'),
        list: l,
        insert: i,
        update: u,
        delete: d
    };

     $.ajax({
            type: "POST",
            url: burl + "/rolepermission/save",
            data: data,

            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success: function (sms) {
                 $(tr).attr('id', sms);
             
            }
        });
}