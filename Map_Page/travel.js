function begin() { 
    
    //tell google maps what div to grab on to
    var mapCanvas = document.getElementById('map');
    
    //initialize the map
    var mapOptions = loadOnCorvallis();
    
    //creation of the map with the above descriptions
    var map = new google.maps.Map(mapCanvas, mapOptions);
    
    //set the locations
    var markers = setMarkers();
    
    drop(map, markers);
}

function setMarkers() {
    var markers = [
        ['OSU', 44.563036, -123.281925],
        ['KEC', 44.567193, -123.278480],
        ['The Waterfront', 44.564291,-123.260745],
        ['Qdoba', 44.568208, -123.275887],
        ['Corvallis High School', 44.575642, -123.268859],
        ['The Covered Bridge', 44.566488, -123.300811],
        ['Reser Stadium', 44.559464,-123.2808783],
        ['Avery Park', 44.553933, -123.273736],
        ['Downtown Corvallis', 44.562807, -123.261438],
        ['The MU', 44.565118, -123.278900],
        ['Benton Hall', 44.566219, -123.274299],
        ['Linus Pauling Institute', 44.566537, -123.283643],
        ['The Valley Library', 44.565185, -123.275987],
        ['Mary\'s Peak', 44.504233, -123.551345],
        ['Silver Falls State Park', 44.861062, -122.624477],
        ['McNcary Dining', 44.564075, -123.27211],
        ['Space Needle', 47.620390, -122.349139],
        ['White House',	38.898010, -77.036519],
        ['Eiffel Tower', 48.858020, 2.294813],
        ['Leaning Tower of Piza', 43.723169, 10.396425],
        ['Great Pyramid at Giza', 29.977741, 31.132775],
        ['Monterey Bay Aquarium', 36.617966, -121.901948],
        ['Sydney Opera House', -33.847617, 151.215137],
        ['Tokyo Skytree', 35.710714, 139.811475],
        ['Taipei', 24.78091, 120.993382],
        ['Big Ben', 52.50082, -0.124503],
        ['Kremlin', 55.75212, 37.617328],
        ['Angkor Wat', 13.412396, 103.868316],
        ['Machu Picchu', -13.163089, -72.544534],
        ['Taj Mahal', 27.174538, 78.042187],
        ['Statue of Liberty', 40.689746, -74.044962],
        ['The Louvre', 48.860639, 2.337397],
        ['Egyptian Museum of Antiquities', 30.047293, 31.233635],
        ['Pyongyang', 39.009792, 125.757451]
    ];
    return markers;
}

function loadOnOregon() {
    //some default settings needed to initialize the map
    var mapOptions = {
        //Center of Oregon
        center: new google.maps.LatLng(43.991621, -120.637167),
        //zoom level to see all of oregon
        zoom: 7,
        //setting the hybrid roadmap and satlilite image
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    return mapOptions;
}

function loadOnCorvallis() {
    var mapOptions = {
        center: new google.maps.LatLng(44.5656766,-123.2807153),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    return mapOptions;
}

function loadOnWorld() {
    var mapOptions = {
        center: new google.maps.LatLng(31.331230, -14.361263),
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    return mapOptions;
}

function drop(map, markers) {
    for (var i = 0; i < markers.length; i++) {
        addMarkerWithTimeout(map, markers[i], i * 100);
    }
}

function addMarkerWithTimeout(map, markers, timeout) {
    var position = new google.maps.LatLng(markers[1], markers[2]);
    var name = markers[0];
    window.setTimeout(function() {
        markers.push(new google.maps.Marker({
            position: position,
            map: map,
            animation: google.maps.Animation.DROP,
            title: name
        }));
    }, timeout);
}


//when the HTML loads and the window is ready, run the initialize function
google.maps.event.addDomListener(window, 'load', begin);