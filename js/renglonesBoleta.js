$(document).ready(function(){
    getLevel();
    $num=1;
    $('#agregarMateria').click(function(){
        getCourse();
    });
});


function getLevel(){

  $.post("../Controladores/getInfo.php", {
        action: "getEducationLevelFromDb",
  },
  function(data){
      //alert(data);
     $('#gradoEducativo').append("<select id='nivelCombo'>" + data + "</select>");
     $('#nivelCombo').material_select();
  });
  
}

function getCourse(){

  $.post("../Controladores/getInfo.php", {
        action: "getCoursesFromDb",
  },
  function(data){
      //alert(data);
      
      if($num > 1){
          insertGradeInReportCard();
      }
      
     $('#boleta').append("<tr><td><div class='input-field col s4'><select id='courses"+$num+"'>" + data + "</select></div></td>"
        +"<td><div class='input-field col s4'><input id='grade"+$num+"' type='text' class='validate'>"
        +"<label for='"+$num+"'>Calificacion</label></div></td></tr>");
     $str="#courses"+$num;
     $($str).material_select();
     $num++;
  });
  
}


function insertGradeInReportCard(){
    var actualCURP = $('#secret').text();
    var actualNum = $num - 1;
    var actualCourseName = $('#courses' + actualNum + ' option:selected').text();
    var actualCourseId = $('#courses' + actualNum).val();
    var actualGradeObtained = $('#grade' + actualNum).val();
    var actualGradeLevel = $("#nivelCombo").val();
    
    alert("CURP : " + actualCURP + " Grade: " + actualGradeObtained + " Val : " + actualCourseId + " Nivel " + actualGradeLevel);
}