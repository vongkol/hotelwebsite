function getDistrictByProvince(pid)
{
    $.ajax({
        type: "GET",
        url: burl + "/district/get/" + pid,
        success: function(data)
        {
            for(var i=0; i<data.length; i++)
            {
                
            }
        }
    });
}