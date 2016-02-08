function initialize() { 
    
    //tell google maps what div to grab on to
    var mapCanvas = document.getElementById('map');
    
    //some default settings needed to initialize the map
    var mapOptions = {
        //where the map starts in its location
        center: new google.maps.LatLng(43.991621, -120.637167),
        //zoom level to see all of oregon
        zoom: 7,
        //setting the hybrid roadmap and satlilite image
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    
    //creation of the map with the above descriptions
    var map = new google.maps.Map(mapCanvas, mapOptions);
    
    //Marker Locaiton Definitions
    var OSU = {lat:44.563036, lng:-123.281925};
    
    //
    
    //set a new marker
    var marker = new google.maps.Marker({
        //call the OSU locaiton variable
        position: OSU,
        //this sets it to the specified div
        map: map,
        //make the pin drop in upon loading
        animation: google.maps.Animation.DROP,
        //hover title
        title: 'OSU Campus'
    });
}

//when the HTML loads and the window is ready, run the initialize function
google.maps.event.addDomListener(window, 'load', initialize);