//Resources for pin grouping: http://www.appelsiini.net/2008/introduction-to-marker-clustering-with-google-maps

/*DONT CALL ANY OF THESE THINGS. THEY ARENT DONE
var offset = 268435456
var radius = 85445659.4471

function longToX(longitude) {
    return Math.round(offset + radius * longitude * Math.PI / 180);
}

function latToY(latitude) {
    var plusOne = 1 + Math.sin(latitude * Math.PI / 180);
    var minusOne = 1 - Math.sin(latitude * Math.PI / 180);
    var mathLog = Math.log((1 + (plusOne / minusOne) / 2);
    return Math.round(offset - radius * mathLog);
}

function pixelDistance(lat1, long1, lat2, lon2, zoom) {
    var x1 = lonToX(lon1);
    var y1 = latToY(lat1);
    var x2 = lonTox(lon2);
    var y2 = latToY(lat2);
    return Math.sqrt(Math.pow((x1-x2),2) + Math.pow((y1-y2),2)) >> (21 - zoom);
}

function cluster(markers, distance, zoom) {
    var clustered = [];
    while (markers.length) {
        var marker = markers.pop();
        var cluster = [];
        for(var x = 0; x < markers.length-2; x++) {
            var pixels = pixelDistance(markers[x][1], markers[x][2], markers[x+1][1], markers[x+1][2], zoom);
            if (distance > pixels) {
                
            }
        }
    }
}*/

function toRadians(number) {
    return number * (Math.PI/180);
}
function toDegrees(number) {
    return (number * 180) / Math.PI;
}

var map;
var markers;

function begin() {

    //tell google maps what div to grab on to
    var mapCanvas = document.getElementById('map');

    //initialize the map
    var mapOptions = loadOnOregon();

    //creation of the map with the above descriptions
//    var map = new google.maps.Map(mapCanvas, mapOptions);
    map = new google.maps.Map(mapCanvas, mapOptions);

    //set the locations
//    var markers = setMarkers();
    markers = setMarkers();

    //atempt at marker manages
//    var mgr = new MarkerManager(map);
//
//    mgr.addMarkers(markers);
//    mgr.refresh();

    drop();
    
    showBadgeRange();
}


function showBadgeRange() {
    
    // Define the LatLng coordinates for the polygon's path.
    for (var v = 0; v < markers.length; v++) {
        setBadgeRange(map, markers[v][0], parseFloat(markers[v][1]), parseFloat(markers[v][2]), parseFloat(markers[v][3]));
    }
}

//function setBadgeRange(map, name, lat1, lon1, d) {
//    var R = 6371000; // metres
//    var φ1 = toRadians(lat1);
//    var λ1 = toRadians(lon1);
//
//    var brng = 0;
//    
//    var φ2 = Math.asin(Math.sin(φ1)*Math.cos(d/R) + Math.cos(φ1)*Math.sin(d/R)*Math.cos(brng));
//    brng = 90;
//    var λ2 = λ1 + Math.atan2(Math.sin(brng)*Math.sin(d/R)*Math.cos(φ1), Math.cos(d/R)-Math.sin(φ1)*Math.sin(φ2));
//    
//    var latRange = toDegrees(φ2) - lat1;
//    var longRange = toDegrees(λ2) - lon1;
//    
//    console.log(name, lat1, lon1, d, toDegrees(φ2), toDegrees(λ2));
//    
//    
//    var upperLat = lat1+latRange;
//    var lowerLat = lat1-latRange;
//    
//    var upperLong = lon1+longRange;
//    var lowerLong = lon1-longRange;
//        
//    var rangeCoords = [
//        {lat: lowerLat, lng: lowerLong},
//        {lat: lowerLat, lng: upperLong},
//        {lat: upperLat, lng: upperLong},
//        {lat: upperLat, lng: lowerLong}
//    ];    
//    
//    var colorFill = ' ';
//    if (d >= 1000) {
//        colorFill = '#a35125';   
//    }
//    else if (d >= 500 && d < 1000) {
//        colorFill = '#289090';   
//    }
//    else {
//        colorFill = '#9943d8';   
//    }
//    
//    var shape = new google.maps.Polygon({
//        paths: rangeCoords,
//        strokeColor: '#606262',
//        strokeOpacity: 0.8,
//        strokeWeight: 2,
//        fillColor: colorFill,
//        fillOpacity: 0.3
//    });
//    shape.setMap(map);
//}

function setBadgeRange(map, name, latitude, longitude, range) {
    //Credit: http://www.movable-type.co.uk/scripts/latlong.html
    var earthRadius = 6371000; // metres
    var Rlat = toRadians(latitude);
    var Rlong = toRadians(longitude);
    var angularDistance = range/earthRadius;
    
    var bearing = 0;
    
    var Rlat2 = Math.asin(Math.sin(Rlat)*Math.cos(angularDistance) + Math.cos(Rlat)*Math.sin(angularDistance)*Math.cos(bearing));
    bearing = 90;
    var Rlong2 = Rlong + Math.atan2(Math.sin(bearing)*Math.sin(angularDistance)*Math.cos(Rlat), Math.cos(angularDistance)-Math.sin(Rlat)*Math.sin(Rlat2));
    
    var latRange = toDegrees(Rlat2) - latitude;
    var longRange = toDegrees(Rlong2) - longitude;
    
    console.log(name, latitude, longitude, range, toDegrees(Rlat2), toDegrees(Rlong2));
    
    
    var upperLat = latitude+latRange;
    var lowerLat = latitude-latRange;
    
    var upperLong = longitude+longRange;
    var lowerLong = longitude-longRange;
        
    var rangeCoords = [
        {lat: lowerLat, lng: lowerLong},
        {lat: lowerLat, lng: upperLong},
        {lat: upperLat, lng: upperLong},
        {lat: upperLat, lng: lowerLong}
    ];    
    
    var colorFill = ' ';
    if (range >= 1000) {
        colorFill = '#a35125';   
    }
    else if (range >= 500 && range < 1000) {
        colorFill = '#289090';   
    }
    else {
        colorFill = '#9943d8';   
    }
    
    var shape = new google.maps.Polygon({
        paths: rangeCoords,
        strokeColor: '#606262',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: colorFill,
        fillOpacity: 0.3
    });
    shape.setMap(map);
}

//function setBadgeRange(map, name, latitude, longitude, range) {

//    var latRange, longRange, upperLat, lowerLat, upperLong, lowerLong;
    
    
//    var φ2 = lat2.toRadians();
//    var Δφ = (lat2-lat1).toRadians();
//    var Δλ = (lon2-lon1).toRadians();

//    var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
//            Math.cos(φ1) * Math.cos(φ2) *
//            Math.sin(Δλ/2) * Math.sin(Δλ/2);
//    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
//    var d = R * c;
    
    
    
//    latRange = range / 111132;
//    longRange = range / ((Math.cos(Math.abs(latitude)) * 111) * 1000);
    
    //in meters
//    var earthRadius = 6371000;
//    var angularDistance = range/earthRadius;
//    var dueNorth = 0;
//    var dueEast = 90;
//    
//    var northWest = 45;
//    var southEast = 135;
//    var southWest = 225;
//    var northWest = 320;
//    
//    var radianLat = toRadians(latitude);
//    var radianLong = toRadians(longitude);
    
    
//    upperLat = Math.asin(Math.sin(latitude)*Math.cos(angularDistance) + Math.cos(latitude)*Math.sin(angularDistance)*Math.cos(northBearing));
//    lowerLong = longitude + Math.atan2(Math.sin(eastBearing)*Math.sin(angularDistance)*Math.cos(latitude), Math.cos(angularDistance)-Math.sin(latitude)*Math.sin(upperLat));
    
//    upperLat = Math.asin(Math.sin(radianLat)*Math.cos(angularDistance) + Math.cos(radianLat)*Math.sin(angularDistance)*Math.cos(dueNorth));
//    lowerLong = radianLong + Math.atan2(Math.sin(dueEast)*Math.sin(angularDistance)*Math.cos(radianLat), Math.cos(angularDistance)-Math.sin(radianLat)*Math.sin(upperLat));
    
//    latRange = upperLat - latitude;
//    longRange = longitude - lowerLong;
    
//    latRange = upperLat;
//    longRange = lowerLong;
//    
//    upperLat = latitude+latRange;
//    lowerLat = latitude-latRange;
//    
//    upperLong = longitude+longRange;
//    lowerLong = longitude-longRange;
//    
//    console.log(name, range, latitude, longitude, angularDistance, latRange, longRange, 
//                upperLat, lowerLong);
//        
//    var rangeCoords = [
//        {lat: lowerLat, lng: lowerLong},
//        {lat: lowerLat, lng: upperLong},
//        {lat: upperLat, lng: upperLong},
//        {lat: upperLat, lng: lowerLong}
//    ];    
//    
//    var colorFill = ' ';
//    if (range >= 1000) {
//        colorFill = '#a35125';   
//    }
//    else if (range >= 500 && range < 1000) {
//        colorFill = '#289090';   
//    }
//    else {
//        colorFill = '#9943d8';   
//    }
//    
//    var shape = new google.maps.Polygon({
//        paths: rangeCoords,
//        strokeColor: '#606262',
//        strokeOpacity: 0.8,
//        strokeWeight: 2,
//        fillColor: colorFill,
//        fillOpacity: 0.3
//    });
//    shape.setMap(map);

//Current measurement in feet

function setMarkers() {
    var markers = [];
    $.ajax({
        method:"post",
        async:false, 
        url:"http://web.engr.oregonstate.edu/~chriconn/javascript/get_locations.php",
        dataType:"json",
        error:function(jqXHR) {alert(jqXHR.status);},
        success:function(list) {
            for (var i = 0; i < list.length; i++) {
                var temp = list[i];
                if(temp.public == "1") {
                    markers.push([temp.name,temp.latitude,temp.longitude,temp.range]);
                }
            }
        }
	});
    console.log(markers);
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

function drop() {
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
