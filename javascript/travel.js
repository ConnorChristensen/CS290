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

function begin() {

    //tell google maps what div to grab on to
    var mapCanvas = document.getElementById('map');

    //initialize the map
    var mapOptions = loadOnOregon();

    //creation of the map with the above descriptions
    var map = new google.maps.Map(mapCanvas, mapOptions);

    //set the locations
    var markers = setMarkers();

    //atempt at marker manages
//    var mgr = new MarkerManager(map);
//
//    mgr.addMarkers(markers);
//    mgr.refresh();

    drop(map, markers);
}

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
