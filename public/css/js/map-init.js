

    function initMap() {
    // const uluru = { lat: 9.3220475, lng: 2.313138 };

    const myLatLng = { lat: 9.3220475, lng:  2.313138};
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
  window.initMap = initMap;


  const click = document.getElementById("clickItem");

  click.addEventListener('onClick', function()
  {
    // alert('Click sucess');
    // event.preventDefault(); 
    click.innerHTML = "C'est cliqué !"            
  }, true);


  function recupLatLong() 
  {
    var latitude = document.getElementById('latitude');
    var longitude = document.getElementById('longitude');

    if( typeof(latitude) == int && typeof(longitude)==int)
    {
      alert(" Variables entiers /n Lat : "+latitude+" Long : "+longitude);
    }
    else{
      lati,longi = parseInt(latitude) , parseInt(longitude);
      alert(" Variables convertis entiers /n Lat : "+latitude+" Long : "+longitude);
    }
  }
  window.recupLatLong = recupLatLong;