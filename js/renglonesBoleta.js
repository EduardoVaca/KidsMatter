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
     $('#grafica').append("<select id='nivelComboGrafica'>" + data + "</select>");
     $('#nivelComboGrafica').material_select();
     $('#grafica').append("<a id='crearGrafica' class='btn waves-effect waves-light right'><i class='material-icons'>search</i></a>");
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

    $.post("../Controladores/insertions.php", {
          action: "insertGradeCard",
          curp: actualCURP,
          courseId: actualCourseId,
          gradeLevelId: actualGradeLevel,
          gradeObtained: actualGradeObtained
    }, function(data){
      alert(data);
    });
}
