
//On load of document (after html is loaded)
$(document).ready(function(){
    //Initialise date time picker
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('#timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '4:00pm',
        maxTime: '8:30pm',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});