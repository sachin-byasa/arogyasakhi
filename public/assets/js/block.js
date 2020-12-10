$("#blockForm").validate({
    rules: {
        block_name: "required",
        state :"required",
        district :"required"
    },
    messages: {
        block_name: "Please Enter District Name",
        state :"Please Select State",
        district :"Please Select District",

    }
});

$("#state").change(function () {

    var stateId = this.value;
    $.ajax({
        url: BASE_URL + "/admin/blocks/getDistrictFromState/" + stateId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if(response.status === "pass"){
                $('#district').empty(); 
                $('#district').append('<option value="">Please select District</option>');
                $.each(response.district, function (i, data) {
                    var div_data = "<option value=" + data.district_id + ">" + data.district_name + "</option>";
                    $('#district').append(div_data);
                });
            }

        }

    });
});