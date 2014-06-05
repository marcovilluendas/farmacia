<?php

echo $this->Html->css('jquery.autocomplete.css');

echo $this->Html->script('jquery-2.1.0.min.js');
echo $this->Html->script('jquery.autocomplete-min');

echo $this->Html->script('plupload/plupload.js');
echo $this->Html->script('plupload/plupload.flash.js');
echo $this->Html->script('plupload/plupload.html4.js');
echo $this->Html->script('plupload/plupload.html5.js');
echo $this->Html->script('plupload/i18n/es.js');

echo $this->Html->script('jquery.jeditable.mini.js');
echo $this->Html->script('jquery-ui-1.10.4/ui/jquery-ui.js');


echo $this->Html->css('/js/fancybox/jquery.fancybox');
echo $this->Html->script('fancybox/jquery.fancybox.js');

?>
<div class="containerindex">
<div class="container">
<div class="row">
	<div class="col-lg-12 col-md-12">
	
	
	<div class="formularioedit">

<h1>Registre su Farmacia</h1>

<?php
		echo $this->Form->create('Farmacia');
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('direccion');
		echo $this->Form->input('cp');
		
		$options = array(
			'' => '== Todas las localidades ==',
			'A Coruña' => 'A Coruña',
			'Alava' => 'Alava',
			'Albacete' => 'Albacete',
			'Alicante' => 'Alicante',
			'Almería' => 'Almería',
			'Avila' => 'Avila',
			'Badajoz' => 'Badajoz',
			'Barcelona' => 'Barcelona',
			'Bilbao' => 'Bilbao',
			'Madrid' => 'Madrid',
			'Zaragoza' => 'Zaragoza'
			

		);

		echo $this->Form->input('localidad', array('options' => $options));

		echo $this->Form->input('telefono');
		echo $this->Form->input('email');
?>		
		<div onLoad="load();"  onunload="GUnload();">
     	<h4> Localizar su farmacia en google maps </h4>
		<div class="pull-right">
			<p> Le aconsejamos buscar su dirección con el siguiente formato: (Fita 15, Zaragoza) </p>
		</div>
	 
			<form id="google" name="google" action="#">
	 
			<p><label>Direcci&oacute;n: </label>
			<input style="width:400px" type="text" id="direccion" name="direccion" value=""/>
			<button id="pasar">Obtener coordenadas</button> 
			</p>
			
			 
			<!-- div donde se dibuja el mapa-->
			<div id="map_canvas" style="width:800px;height:300px;"></div>
			 <br>
			<!--campos ocultos donde guardamos los datos-->
			<!-- <p><label>Latitud: </label><input type="text" readonly name="lat" id="lat"/></p> -->
			
			<p><label> Latitud:</label> <?php echo $this->Form->input('lat', array('readonly name' => 'lat', 'id' => 'lat')); ?></p>
			<p><label> Longitud:</label> <?php echo $this->Form->input('long', array('readonly name' => 'long', 'id' => 'long')); ?></p>
		
		</form>
		

 		
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
		<?php echo $this->Form->end('Guardar');?>
		</div>
     </div>
	 
		


</div>	
</div>



	<script>
				$(function() {
					$("#imagenes_sortable").sortable({
						/*placeholder: "ui-state-highlight",*/
						forcePlaceholderSize: true,
						items: 'DIV.caja_ver_foto',
						axis: 'y',
						handle: ".handle",
						stop:function(event, ui) {},
						update:function(event, ui) {
							$.ajax({
								async:true,
								type:'post',
								url:'/images/ordenar/Post',
								data:$('#imagenes_sortable').sortable('serialize')
							});
						}
					});
				});
			</script>
		


<script>

/******************************************
	PLUPLOAD
******************************************/
	var plupload_params = {
		runtimes : 'html5,flash',
		browse_button : 'uploadfiles',
		max_file_size : '2mb',
		//url : "/images/upload/<?=$this->request->data['Farmacia']['id'];?>/Farmacia",
		url : "<?=Router::url(array('controller'=>'images', 'action'=>'upload', $this->request->data['Farmacia']['id'], 'Farmacia'))?>",
		flash_swf_url : '/js/plupload/plupload.flash.swf',
		filters : [
			{title : "Archivos de imagen", extensions : "jpg,jpeg,gif,png"}
		]
	};

	var uploader = new plupload.Uploader(plupload_params);
	uploader.init();
	uploader.bind('FilesAdded', function(up, files) {
		$.each(files, function(i, file) {
			if(file.status == 1){
				var $div = $('<div class="uploader_container"><div id="' + file.id + '" style="width: 0%;"></div></div>').delay(2000).fadeOut(2000);
				$('#upload_wrapper').append($div);
			}
		});
		up.refresh(); // Reposition Flash/Silverlight
		up.start();

	});
	uploader.bind('Error', function(up, err) {
		alert(err.message);
	});
	uploader.bind('UploadProgress', function(up, file) {
		$('#' + file.id).css('width',file.percent + "%");
	});
	uploader.bind('FileUploaded', function(up, file, r) {
		$('#' + file.id)
			.addClass('finished')
			.css('width',"100%");
		if(r.status == 200){
			var $div = $(r.response);
			$('#upload').before($div);
			//console.log( $div.attr('id') );
			$div.hide().slideDown(1000);
		}
    });

</script>

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
	         var latLng = new google.maps.LatLng(41.6485060606558,-0.8896419148803716);
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