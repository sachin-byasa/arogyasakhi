$("#stateForm").validate({
    rules: {
        state_name: "required",
    },
    messages: {
        state_name: "Please Enter State Name",
    }
});


// $(document).ready( function () {
    $('#myStates').DataTable();
// } );