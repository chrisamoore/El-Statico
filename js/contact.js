$(function() {


$('#main-text .loc').live('click',function(){
$('#main-text .loc').removeClass('current');										   
	

$el = $(this);
$el.addClass('current')
	point = new google.maps.LatLng($el.attr("data-lat"), $el.attr("data-lon"));
          map.panTo(point);
          
       if($el.hasClass("added")){
		   
	   } else {
		   $el.addClass("added");
		 var zaddress = $el.html();
          // Add new marker
     	var    marker = new google.maps.Marker({
               		position: point,
               		map: map,
               		icon: "images/marker.png"
          		});
	 
	 	var infowindow = new google.maps.InfoWindow({ content:'<div class="ad">'+ zaddress +'</div>' });
	google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});
	}
										   
});

var latlng = new google.maps.LatLng(38.8679423, -77.4483507);


var moptions = {
	panControl: false,
  	zoomControl: true,
  	mapTypeControl: false,
  	scaleControl: false,
  	streetViewControl:false,
	zoom: 14,
  	center: latlng,
   	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("map"),moptions);
var infowindow = new google.maps.InfoWindow(
      { content: '<div class="ad">5103 Westfields Blvd.<br /> Centreville, VA 20120 </div>'
      });

//SETUP for the marker
var image = new google.maps.MarkerImage('images/marker.png');

var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: image
});
 google.maps.event.addListener(marker, 'click', function(){


infowindow.open(map,marker);

});
});