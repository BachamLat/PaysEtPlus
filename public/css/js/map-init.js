function initMap() 
  {
    
    const lati = parseFloat( (document.getElementById("lat").innerHTML).trim() );
    const long = parseFloat( (document.getElementById("long").innerHTML).trim() );

    if((lati == 0)&&(long==0)){
      document.getElementById("map").style.height = "2px";
      document.getElementById("map").style.textAlign="center";
      document.getElementById("map").style.fontSize = "18px";
      document.getElementById("map").style.fontWeight = "bold";
      document.getElementById("map").style.fontFamily = "Arial-Serif";     
      document.getElementById("map").innerText="Aucun Emplacement Disponible Sur la Carte Geographique";
    }
    else{
        const myLatLng = { lat: lati, lng: long};
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: myLatLng,  
        });
      
        new google.maps.Marker({
          position: myLatLng,
          map,
          title: "Hello World!",
        });
    }
  }
  window.initMap = initMap;


  function click(){
    initMap();
  }