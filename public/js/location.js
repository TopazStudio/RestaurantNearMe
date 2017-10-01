var API_KEY = 'AIzaSyBixSBMVXJ-a_8a7VNzXttqmCIm7GP1WbU';

//MAIN MAP
var MAP;
var MARKER;

//SET LOCATION ON THE INPUT ELEMENTS
function setLocation(LatLng,pan){
	addMarker({coords:LatLng});
	document.getElementById('long').value = LatLng.lng;
	document.getElementById('lat').value = LatLng.lat;

    if(pan){
		MAP.setCenter(LatLng);
        MAP.setZoom(15);
	}
}

//GET LATLNG THROUGH GEOCODING
function getLatLng(){
  var address = document.getElementById('addressInput').value;
  geocode(address)
  .then(function(response){
		// var l = response.data.results[0].geometry.location;
    setLocation(response.data.results[0].geometry.location,true);
  })
  .catch(function(error){
    console.log(error)
  });
}

//Show the list of locations
function showResults(results){
	
}

//GEO LOCATING
function geolocate(props){
  return new Promise(function(res,rej){
    //First try by browser
    if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(
      function(position){
        res(position.coords); 
      },function(error){
          axios.post(`https://www.googleapis.com/geolocation/v1/geolocate?key=${API_KEY}`)
          .then(function(response){
            res(response);
          })
          .catch(function(error){
            console.log(error);
          });
      });
    }
  });
}

//GEO-CODING
function geocode(location){
 return axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
    params:{
      address: location,
      key: API_KEY
    }
  })
}

//CREATING MAP
function initMap(){
  geolocate()
		.then(function(location){
			MAP = new google.maps.Map(document.getElementById('map'),{
				zoom: 8,
				center: {lat:location.latitude,lng:location.longitude}
			});
		
			MAP.addListener('click',function(event){
				setLocation({lat: event.latLng.lat(), lng: event.latLng.lng()},false);
  		    });
		});  
}

//ADDING MARKER
function addMarker(props){
	//if marker exists set new position
	if(MARKER){
		MARKER.setPosition(props.coords);
	}else{
		MARKER = new google.maps.Marker({
			position: props.coords,
			map:MAP,
 		});	
	}
  //icon
  if(props.icon){
    MARKER.setIcon(props.icon);
  }
	//content
  if(props.content){
    var infoWindow = new google.maps.InfoWindow({
      content: props.content
    });
    MARKER.addListener('click',function(){
      infoWindow.open(map,marker);
    })
  }
}

//INIT
function loadGoogleMapsApi(){
	if(typeof google === "undefined"){
		var script = document.createElement("script");
		script.src = `https://maps.googleapis.com/maps/api/js?key=${API_KEY}&callback=initMap`;
		document.getElementsByTagName("head")[0].appendChild(script);
	} else {
		initMap();
	}
}

//TODO: load only when needed
loadGoogleMapsApi();