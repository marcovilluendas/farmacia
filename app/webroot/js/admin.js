/***************************************
	ADMIN_INDEX
***************************************/

$('A.ajax_bool').click(function(e){
	e.preventDefault();
	var $this = $(this);
	var url = $(this).attr('href');
	var url_arr = url.split("/");
	url_arr.splice( url_arr.indexOf('boolean_ajax')+1 , 3);
	
	$this.html('<span class="estado_loading">esperando...</span>');

	$.get(url, function(data){
		if(!data.error){
			//data.estado = 1, data.field = activo, data.id = 1;
			if(data.estado == 1){
				var span = '<span class="estado_activo">SÃ­</span>';
			}else{
				var span = '<span class="estado_inactivo">No</span>';
			}
			var href = url_arr.join('/')+"/"+data.id+"/"+data.estado+"/"+data.field;
			$this
				.attr('href', href)
				.html(span);

			
		}
	}, "json");
});


$('A.boton_admin.activar').click(function(e){
	e.preventDefault();
	var $this = $(this);
	var url = $(this).attr('href');
	var url_arr = url.split("/");
	url_arr.splice( url_arr.indexOf('boolean_ajax')+1 , 3);

	$this.find('span').html('esperando...');
	//$this.html('<span class="estado_loading">esperando...</span>');

	$.get(url, function(data){
		if(!data.error){
			//data.estado = 1, data.field = activo, data.id = 1;
			if(data.estado == 1){
				var span = '<span class="desactivar">Desactivar</span>';
			}else{
				var span = '<span class="activar">Activar</span>';
			}
			var href = url_arr.join('/')+"/"+data.id+"/"+data.estado+"/"+data.field;
			$this
				.attr('href', href)
				.html(span);

			
		}
	}, "json");
});