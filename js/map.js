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
    
    
    $('#mapa').click(mapa);
    
        
});

function mapa(){
  
  var long=-100.4771991;
  var lati=20.6122835;

  
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
    lati=response.results[0].geometry.location.lat;
    long=response.results[0].geometry.location.lng;
    $('#debug').html("Lat: " + response.results[0].geometry.location.lat + " Lon: " + response.results[0].geometry.location.lng);
  }else{
    $('#debug').html("Favor de ingresar una direccion correcta");
  }
  
  
   var map;
    
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: lati, lng: long},
      zoom: 15
    });
    
    var marker = new google.maps.Marker({
      position: {lat: lati, lng: long},
      map: map,
      title: 'Hello World!'
    });
        
}

function formURL(){
  var url = "https://maps.googleapis.com/maps/api/geocode/json?address=";
  
  //var parameters = document.getElementById("direccionInstitucion").value.replace(/\s/g, '+');
  var parameters = $('#direccionInstitucion').val().replace(/\s/g, '+');

  return url + parameters + "&key=AIzaSyDX8mSb8xN1KR_Za_tPXHor6OJjM4smlR8";
}