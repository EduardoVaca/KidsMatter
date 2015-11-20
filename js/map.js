$(document).ready(function(){
    
    function detectBrowser() {
      var useragent = navigator.userAgent;
      var mapdiv = document.getElementById("modal2");
    
      if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1 ) {
        mapdiv.style.width = '100%';
        mapdiv.style.height = '100%';
      } else {
        mapdiv.style.width = '600px';
        mapdiv.style.height = '800px';
      }
    }
    
    
    $('#map').click(mapa);
    
        
});

function mapa(){
  
  var long=46.414385;
  var lat=10.013980;

  
  var response = '';
  $.ajax({ type: "GET",
           url: formURL(),
           async: false,
           dataType: 'json',
           success : function(text)
           {
               response = text;
           }
  });

  if (response.results.length > 0){
    console.log(response.results[0].geometry.location);
    lat=response.results[0].geometry.location.lat;
    long=response.results[0].geometry.location.lng;
    $('#debug').html("Lat: " + response.results[0].geometry.location.lat + " Lon: " + response.results[0].geometry.location.lng);
  }else{
    $('#debug').html("Favor de ingresar una direccion correcta");
  }
  
  $('#editable').html("<iframe class='center'"
      +"width='600' "
      +"height='450' "
      +"frameborder='0' style='border:0' "
      +"src='https://www.google.com/maps/embed/v1/view?key=AIzaSyBrXxF4_7GPXpK8Tohc1w8yicTLF8d4mnk&center="+lat+","+long+"&zoom=15&maptype=satellite' allowfullscreen>"
      +"</iframe>"
    )
    
   // $('.modal-trigger').leanModal();
}

function formURL(){
  var url = "https://maps.googleapis.com/maps/api/geocode/json?address=";
  
  //var parameters = document.getElementById("direccionInstitucion").value.replace(/\s/g, '+');
  var parameters = $('#direccionInstitucion').val().replace(/\s/g, '+');

  return url + parameters + "&key=AIzaSyDX8mSb8xN1KR_Za_tPXHor6OJjM4smlR8";
}