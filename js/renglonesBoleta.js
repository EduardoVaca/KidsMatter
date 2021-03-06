$(document).ready(function(){
    $num=1;
    $("#crearGrafica").click(createGraph);
});


function refresh(){
    $('#muestraBoleta').html("<p id='GPA'>Promedio Acumulado: </p><div id='gradoEducativo'></div><table class='responsive-table striped justified centered teal lighten-3 z-depth-1 tabla-actividades col s12 ' id='boleta'>"
        +" <thead> <tr> <th data-field='id' >Materia</th> <th data-field='escolaridad' >Calificación</th>"
        +"</tr> </thead> <tbody id='boleta'> </tbody> </table>"
        +"<a id='agregarMateria' class='btn-floating medium waves-effect waves-light cyan z-depth-1' onClick='getCourse()'><i class='material-icons'>save</i></a>"
        );
    getCourse();
    getMissingLevel();
    getChildGPA();
}

function getMissingLevel(){

  var actualCURP = $('#secret').text();

  $.post("../Controladores/getInfo.php", {
        action: "getMissingEducationLevel",
        CURP: actualCURP,
  },
  function(data){
      //alert(data);
     $('#gradoEducativo').append("<select id='nivelCombo'>" + data + "</select>");
     $('#nivelCombo').material_select();
     $('#comandosGrafica').html("<select id='nivelComboGrafica'>" + data + "</select>");
     $('#nivelComboGrafica').material_select();
     $('#comandosGrafica').append("<a id='crearGrafica' class='btn waves-effect waves-light right'><i class='material-icons'>search</i></a>");
     $("#crearGrafica").click(createGraph);
  });

}

function getStoredLevel(){
  var actualCURP = $('#secret').text();

  $.post("../Controladores/getInfo.php", {
        action: "getStoredEducationLevel",
        CURP: actualCURP,
  },
  function(data){
      //alert(data);
     $('#gradoEducativo').append("<select id='nivelCombo'>" + data + "</select>");
     $('#nivelCombo').material_select();
     $('#comandosGrafica').html("<select id='nivelComboGrafica'>" + data + "</select>");
     $('#nivelComboGrafica').material_select();
     $('#comandosGrafica').append("<a id='crearGrafica' class='btn waves-effect waves-light right'><i class='material-icons'>search</i></a>");
     $("#crearGrafica").click(createGraph);
  });
}

function getChildGPA(){

  var actualCURP = $('#secret').text();
  $.post("../Controladores/getInfo.php", {
        action: "getChildGPA",
        CURP:  actualCURP,
  },
  function(data){

    if(!(data == "0")){
      $('#GPA').append("<b>" + data + "</b>");
    }else{
      alert(data);
    }
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

     $('#boleta').append("<tr><td><div class='input-field'><select id='courses"+$num+"'>" + data + "</select></div></td>"
        +"<td><div class='input-field '><input id='grade"+$num+"' type='text' class='validate'>"
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
      //alert(data);
    });
}


function refreshModal2(){

  getStoredLevel();
  $('#grafica').html(" ");
}

function createGraph(){

  $('#grafica').html(" ");
  var actualCURP = $('#secret').text();
  var actualGradeId = $('#nivelComboGrafica').val();

  $.post("../Controladores/graphs.php",{
          action: "createGraphByGrade",
          curp: actualCURP,
          gradeId: actualGradeId
  },
  function(data){

    if(data != "error"){
        var json = jQuery.parseJSON(data);
        var size = json.n;

        var cols = new Array();
        for( var i = 0; i < size; i++){
            cols.push({label: json.materias[i].name, y: parseInt(json.materias[i].grade)});
        }

        var info = {
          data: [
              {
                  type: "column",
                  dataPoints: cols,
              }
              ]
        };

        $('#grafica').CanvasJSChart(info);
    }else{
        alert(data);
    }
  });
}
