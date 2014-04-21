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
<div class="container">
	<div class="formulario">
		<h1>Añadir Producto</h1>

			<?php
					echo $this->Form->create('Oferta');

					echo $this->Form->input('id');
					echo $this->Form->input('articulo');
					echo $this->Form->input('descripcion');
					echo $this->Form->input('precio');
					echo $this->Form->input('stock');

			?>


				<div class="fotos caja">
					<h4>Media</h4>
					<div id="imagenes_sortable" class="caja_content">	
			
					<?//Crear cajas de muestra de foto

						if(isset($this->data['Image'])):
							$fotos_creadas = count($this->data['Image']); ?>
							<? for($i=0; $i<$fotos_creadas; $i++): ?>
								<? echo $this->element('admin_caja_foto', array('image' => $this->data['Image'][$i], 'fields' => array('title'=>'Título')) ); ?>
							<? endfor; ?>
						<? else: ?>
							<? $fotos_creadas=0; ?>
						<? endif; ?>
			
						<div id="upload">
							<div id="upload_wrapper"></div>
							<a href="#" id="uploadfiles" class="boton_admin"><span class="add">Subir imágenes</span></a>
						</div>

					</div>

					
				</div>
				
				
		<? echo $this->Form->end('Guardar'); ?>
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
		url : "<?=Router::url(array('controller'=>'images', 'action'=>'upload', $this->request->data['Oferta']['id'], 'Oferta'))?>",
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

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1749329-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>