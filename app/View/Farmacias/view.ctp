
<div class="section-colored">
<div class="row">

			<?php echo $this->Form->create('Farmacia'); ?> 

				<h1><?=$farmacia['Farmacia']['nombre']?></h1>
				<hr>

		
			<? foreach($farmacia['Image'] as $img): ?>
				<img src="<?=Router::url("/files/images/".$img['archivo']) ?>" style="height:200px; width:200px">
			<? endforeach; ?>
			
			
			<body onLoad="load();"  onunload="GUnload();">
     	
					<!-- div donde se dibuja el mapa-->
					<div id="map_canvas" style="width:600px;height:400px;"></div>
					 <br>
					<!--campos ocultos donde guardamos los datos-->
					<!-- <p><label>Latitud: </label><input type="text" readonly name="lat" id="lat"/></p> -->
					
					<?php echo $this->Form->input('lat', array('readonly name' => 'lat', 'id' => 'lat', 'type' => 'hidden')); ?></p>
					<?php echo $this->Form->input('long', array('readonly name' => 'long', 'id' => 'long', 'type' => 'hidden')); ?></p>
		
		</form>

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
		
     </body>

		
	
			
			</div>
			
			
			<label>Dirección: <h3><?=$farmacia['Farmacia']['direccion']?></h3>
			
			<label>Código Postal: </label><h3><?=$farmacia['Farmacia']['cp']?></h3>
			<label>Email: </label> <h3><?=$farmacia['Farmacia']['email']?></h3>
			
</div>
</div>	
		
		
		<? // debug($farmacia)?>
		

<script type="text/javascript">
	//Declaramos las variables que vamos a user
	var lat = null;
	var lng = null;
	var map = null;
	var geocoder = null;
	var marker = null;
	         
	jQuery(document).ready(function(){
	     //obtenemos los valores en caso de tenerlos en un formulario ya guardado en la base de datos
	     lat = jQuery('#lat').val();
	     lng = jQuery('#long').val();
		 
	     //Asignamos al evento click del boton la funcion codeAddress
	     jQuery('#pasar').click(function(){
	        codeAddress();
	        return false;
	     });
	     //Inicializamos la funci?n de google maps una vez el DOM este cargado
	    initialize();
	});
	     
	    function initialize() {
	     
	      geocoder = new google.maps.Geocoder();
	        
	       //Si hay valores creamos un objeto Latlng
	       if(lat !='' && lng != '')
	      {
	         var latLng = new google.maps.LatLng(lat,lng);
	      }
	      else
	      {
	         var latLng = new google.maps.LatLng(<?=$farmacia['Farmacia']['lat']?>,<?=$farmacia['Farmacia']['long']?>);
	      }
	      //Definimos algunas opciones del mapa a crear
	       var myOptions = {
	          center: latLng,//centro del mapa
	          zoom: 15,//zoom del mapa
	          mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, h?brido,etc
	        };
	        //creamos el mapa con las opciones anteriores y le pasamos el elemento div
	        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	         
	        //creamos el marcador en el mapa
	        marker = new google.maps.Marker({
	            map: map,//el mapa creado en el paso anterior
	            position: latLng,//objeto con latitud y longitud
	            draggable: true //que el marcador se pueda arrastrar
	        });
	        
	       //funci?n que actualiza los input del formulario con las nuevas latitudes
	       //Estos campos suelen ser hidden
		   
		   google.maps.event.addListener(marker, 'dragend', function(){
	                updatePosition(marker.getPosition());
	            });
	        updatePosition(latLng);
	         
	         
	    }
	     
	    //funcion que traduce la direccion en coordenadas
	    function codeAddress() {
	         
	        //obtengo la direccion del formulario
	        var address = document.getElementById("direccion").value;
	        //hago la llamada al geodecoder
	        geocoder.geocode( { 'address': address}, function(results, status) {
	         
	        //si el estado de la llamado es OK
	        if (status == google.maps.GeocoderStatus.OK) {
	            //centro el mapa en las coordenadas obtenidas
	            map.setCenter(results[0].geometry.location);
	            //coloco el marcador en dichas coordenadas
	            marker.setPosition(results[0].geometry.location);
	            //actualizo el formulario      
	            updatePosition(results[0].geometry.location);
	             
	            //A?ado un listener para cuando el markador se termine de arrastrar
	            //actualize el formulario con las nuevas coordenadas
	            google.maps.event.addListener(marker, 'dragend', function(){
	                updatePosition(marker.getPosition());
	            });
	      } else {
	          //si no es OK devuelvo error
	          alert("No podemos encontrar la direcci&oacute;n, error: " + status);
	      }
	    });
	  }
	   
	  //funcion que simplemente actualiza los campos del formulario
	  function updatePosition(latLng)
	  {
	       
	       jQuery('#lat').val(latLng.lat());
	       jQuery('#long').val(latLng.lng());
	   
	  }
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1749329-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
