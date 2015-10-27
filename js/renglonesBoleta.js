$(document).ready(function(){
    
    $numL=1;
    $('#agregarMateria').click(function(){
        $('#boleta').append("<tr><td> <select id='"+$numL+"'><option value=''>Materia</option><option value='1'>Option 1</option><option value='2'>Option 2</option><option value='3'>Option 3</option></select></td><td>Test"+$numL+"</td>");
        $str="#"+$numL;
        $($str).material_select();
        $numL++;
    });
});


function getLevel(){

  $.post("../Controladores/getInfo.php", {
        action: "get",
  },
  function(data){
     $("#boleta").append("<select id='nivelCombo'>" + data + "</select>");
     $('#boleta').material_select();
  });
}