

<?if(isset($image['id'])): //comprabamos si existe la id para saber si está grabado en la BBDD y no viene de un intento fallido de guardar ?>

	<? if($image['tipo']=='imagen'): ?>
		<div class="caja_ver_foto" id="foto_<?=$image['id']?>">
			<h5 class="handle">Imagen subida</h5>
			<a href="/files/images/<?=$image['archivo']?>" class="imagen fancybox">
				<img src="<?=$this->Resizer->Resize("files/images/{$image['archivo']}", array('width'=>300, 'height'=>180, 'crop'=>true));?>">
			</a>
	<? elseif($image['tipo']=='video_ext'): ?>
		<div class="caja_ver_foto video_ext" id="foto_<?=$image['id']?>">
			<h5 class="handle">Vídeo externo</h5>
			<?
				if($image['fuente']=="vimeo"){
					$video_url = "http://vimeo.com/moogaloop.swf?clip_id={$image['clave']}";
				}else{
					$video_url = "http://www.youtube.com/embed/{$image['clave']}";
				}
			?>
			<a href="<?=$video_url?>" class="imagen fancybox fancybox.iframe">
				<div class="play_video"></div>
				<img src="<?=$this->Resizer->Resize("files/images/{$image['archivo']}", array('width'=>120, 'height'=>80, 'crop'=>true));?>">
			</a>
	<? elseif($image['tipo']=='archivo'): ?>
		<div class="caja_ver_foto archivo" id="foto_<?=$image['id']?>">
			<h5 class="handle">Archivo subido</h5>
			<a href="/files/images/<?=$image['archivo']?>" class="imagen" target="_blank">
				<img src="/img/admin/attachment.png" alt="Archivo" />
			</a>
	<? else: ?>
		<div class="caja_ver_foto video_flv" id="foto_<?=$image['id']?>">
			<h5 class="handle">Vídeo subido</h5>
			<a href="/images/video_flv/<?=$image['archivo']?>/640/500" class="imagen fancybox.iframe">
				<? $frame = substr($image['archivo'],0,-3)."jpg"; ?>
				<div class="play_video"></div>
				<img src="<?=$this->Resizer->Resize("files/images/{$image['archivo']}.png", array('width'=>120, 'height'=>80, 'crop'=>true));?>">
			</a>
	<? endif; ?>
		
		<div class="caja_ver_foto_content">

			<? foreach($fields as $field=>$label): ?>

				<? if(is_array($label)): ?>
					<? $opt = $label; ?>
					<?//'tipo' => array('label' => 'Tipo', 'type' => 'select', 'options' => $tipo_imagen_opts)?>
					<? if($opt['type'] == 'select'): ?>

						<p class="<?=$field?>"><strong><?=$opt['label']?>:</strong>
							<?if( !isset($image[$field]) || $image[$field]==""): ?>
								<span id="foto_<?=$field?>_<?=$image['id'];?>" class="editable">[ editar ]</span>
							<? else: ?>
								<span id="foto_<?=$field?>_<?=$image['id'];?>" class="editable"><?=$image[$field];?></span>
							<? endif; ?>

							<script>
								$('#<?='foto_'.$field.'_'.$image['id']?>').editable('/images/editar_ajax/<?=$field?>', { 
									submit:	'ok',
									tooltip: 'Click para editar...',
									indicator: '<img src="/img/admin/ajax-loader.gif" />',
									width: '150px',
									name: 'data[Image][<?=$field?>]',
									submitdata: <?=json_encode(array('data[Image][id]'=>$image['id']))?>,

									data: <?=json_encode($opt['options'])?>,
									type: 'select',
									style: 'display: inline'
								});
							</script>
						</p>						

					<? elseif($opt['type'] == 'boolean'): ?>

						<p class="<?=$field?>"><strong><?=$opt['label']?>: </strong>
							<span id="<?=$field?>_<?=$image['id']?>" class="estado">
								<?php
									if( $image[$field] ){
										$estado = '<span class="estado_activo"><strong>Sí</strong></span>';
									}else{
										$image[$field] = 0;
										$estado = '<span class="estado_inactivo">No</span>';
									}
									echo '<a class="ajax_bool" href="/admin/images/boolean_ajax/'.$image['id'].'/'.$image[$field].'/'.$field.'">'.$estado.'</a>';
									?>
							</span>
						</p>

					<? elseif($opt['type'] == 'textarea'): ?>

						<p class="<?=$field?>"><strong><?=$opt['label']?>:</strong>
							<?if( !isset($image[$field]) || $image[$field]==""): ?>
								<span id="foto_<?=$field?>_<?=$image['id'];?>" class="editable">[ editar ]</span>
							<? else: ?>
								<span id="foto_<?=$field?>_<?=$image['id'];?>" class="editable"><?=$image[$field];?></span>
							<? endif; ?>
							<?php echo $this->Ajax->editor('foto_'.$field.'_'.$image['id'],
									'/images/editar_ajax/'.$field,
									array(
											'type'      => 'textarea',
											'submit'	=> 'ok',
											'tooltip'   => 'Click para editar...',
											'indicator' => '<img src="/img/admin/ajax-loader.gif" />',
											'width'		=> '180px',
											'height'	=> '80px',
											'name'		=> 'data[Image]['.$field.']',
											'submitdata'=> array('data[Image][id]'=>$image['id'])
									)); ?>
						</p>
					<? endif; ?>


				<? else: ?>

					<p class="<?=$field?>"><strong><?=$label?>:</strong>
						<?if( !isset($image[$field]) || $image[$field]==""): ?>
							<span id="foto_<?=$field?>_<?=$image['id'];?>" class="editable">[ editar ]</span>
						<? else: ?>
							<span id="foto_<?=$field?>_<?=$image['id'];?>" class="editable"><?=$image[$field];?></span>
						<? endif; ?>
						<?php echo $this->Ajax->editor('foto_'.$field.'_'.$image['id'],
								'/images/editar_ajax/'.$field,
								array(
										'submit'	=> 'ok',
										'tooltip'   => 'Click para editar...',
										'indicator' => '<img src="/img/admin/ajax-loader.gif" />',
										'width'		=> '150px',
										'name'		=> 'data[Image]['.$field.']',
										'submitdata'=> array('data[Image][id]'=>$image['id'])
								)); ?>
					</p>

				<? endif; ?>

			<? endforeach; ?>

			
			<?=$this->Ajax->link( '<span class="borrar">X</span>',
							"/images/delete/{$image['id']}",
							array(
								'complete' => '$("#foto_'.$image['id'].'").fadeOut();',
								'class' => 'quitar_foto_creada boton_admin boton_admin_pqno'
							),
							'¿Estás seguro de querer borrar la foto?',
							false);
			?>
			
			
		</div>
			<hr class="clear" />
	</div>
<? endif; ?>

<script>
	$('#foto_<?=$image['id']?> .fancybox').fancybox();
</script>