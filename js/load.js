$(document).ready(function() { 
    $('select').material_select();
    
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 60,
    format: 'yyyy-mm-dd'// Creates a dropdown of 15 years to control year
    });
});