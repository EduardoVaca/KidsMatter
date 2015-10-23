$(document).ready(function(){
    $numL=1;
    $('#agregarMateria').click(function(){
        $('#boleta').append("<tr><td>Test2</td><td> <select id='"+$numL+"'><option value=''>Escolaridad</option><option value='1'>Option 1</option><option value='2'>Option 2</option><option value='3'>Option 3</option></select></td>");
        $str="#"+$numL;
        alert($str);
        $($str).material_select();
        $numL++;
    });
});