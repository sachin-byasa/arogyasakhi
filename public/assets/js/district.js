$("#districtForm").validate({
    rules: {
        district_name: "required",
        state :"required"
    },
    messages: {
        district_name: "Please Enter District Name",
        state :"Please Select State",
    }
});