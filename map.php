<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyhAG7XU7oxlzvzduNJYjFdJxV6LkiY8">
 </script>
 <style>
 #map-canvas { 
		height: 100%;
		width:100%;
		margin: 0; 
		padding: 0;
	}
	</style>
<script>
$(document).ready(function(){

	$.ajax({
	    type: 'get',
		url: 'fm_map.php',
	    success: function(response) {

	    	response = JSON.parse(response);
	    	console.log(response);
			var count = 0;

			 var map = new google.maps.Map(document.getElementById('map-canvas'), {
			      zoom: 17,
			      center: new google.maps.LatLng(43.147668,-79.369579),
			 });

			 var infowindow = new google.maps.InfoWindow();
			 var marker;
	    	for(var resp in response){
				var latitude = response[resp].lat;
				var longitude = response[resp].long;
				var name = response[resp].lat;
				var addr = response[resp].addr;
				
				marker = new google.maps.Marker({
		        position: new google.maps.LatLng(latitude, longitude),
		        map: map
		      });

		      google.maps.event.addListener(marker, 'click', (function(marker, count,addr) {
		        return function() {
		        	console.log(addr);
		          infowindow.setContent(addr);
		          infowindow.open(map, marker);
		        }
		      })(marker, count, addr));
				
				
		 		count++;
		 	}
		}
	});
});					 	
</script>

<div id="map-canvas">

</div>

 </html>