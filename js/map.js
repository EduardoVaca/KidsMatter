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
    
    mapa();
    
        
});

function mapa(){
  
  var long=46.414385;
  var lat=10.013980;
  
  $('#editable2').html("<iframe class='center'"
      +"width='600' "
      +"height='450' "
      +"frameborder='0' style='border:0' "
      +"src='https://www.google.com/maps/embed/v1/view?key=AIzaSyBrXxF4_7GPXpK8Tohc1w8yicTLF8d4mnk&center="+long+","+lat+"&zoom=15&maptype=satellite' allowfullscreen>"
      +"</iframe>"
    )
    $('.modal-trigger').leanModal();
}