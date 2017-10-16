/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 34);
/******/ })
/************************************************************************/
/******/ ({

/***/ 34:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(35);


/***/ }),

/***/ 35:
/***/ (function(module, exports) {

var API_KEY = 'AIzaSyBixSBMVXJ-a_8a7VNzXttqmCIm7GP1WbU';

//MAIN MAP
var MAP;
var MARKER;

//SET LOCATION ON THE INPUT ELEMENTS
function setLocation(LatLng, pan) {
  addMarker({ coords: LatLng });
  document.getElementById('long').value = LatLng.lng;
  document.getElementById('lat').value = LatLng.lat;
  if (pan) {
    MAP.setCenter(LatLng);
    MAP.setZoom(15);
  }
}

//GET LATLNG THROUGH GEOCODING
function getLatLng() {
  var address = document.getElementById('addressInput').value;
  geocode(address).then(function (response) {
    var l = response.data.results[0].geometry.location;
    setLocation(response.data.results[0].geometry.location, true);
  }).catch(function (error) {
    console.log(error);
  });
}

//Show the list of locations
function showResults(results) {}

//GEO LOCATING
function geolocate(props) {
  return new Promise(function (res, rej) {
    //First try by browser
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        res(position.coords);
      }, function (error) {
        axios.post('https://www.googleapis.com/geolocation/v1/geolocate?key=' + API_KEY).then(function (response) {
          res(response);
        }).catch(function (error) {
          console.log(error);
        });
      });
    }
  });
}

//GEO-CODING
function geocode(location) {
  return axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
    params: {
      address: location,
      key: API_KEY
    }
  });
}

//CREATING MAP
function initMap() {
  geolocate().then(function (location) {
    MAP = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: { lat: location.latitude, lng: location.longitude }
    });

    MAP.addListener('click', function (event) {
      setLocation({ lat: event.latLng.lat(), lng: event.latLng.lng() }, false);
    });
  });
}

//ADDING MARKER
function addMarker(props) {
  //if marker exists set new position
  if (MARKER) {
    MARKER.setPosition(props.coords);
  } else {
    MARKER = new google.maps.Marker({
      position: props.coords,
      map: MAP
    });
  }
  //icon
  if (props.icon) {
    MARKER.setIcon(props.icon);
  }
  //content
  if (props.content) {
    var infoWindow = new google.maps.InfoWindow({
      content: props.content
    });
    MARKER.addListener('click', function () {
      infoWindow.open(map, marker);
    });
  }
}

//INIT
function loadGoogleMapsApi() {
  if (typeof google === "undefined") {
    var script = document.createElement("script");
    script.src = 'https://maps.googleapis.com/maps/api/js?key=' + API_KEY + '&callback=initMap';
    document.getElementsByTagName("head")[0].appendChild(script);
  } else {
    initMap();
  }
}
loadGoogleMapsApi();

/***/ })

/******/ });