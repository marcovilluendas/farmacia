<?php
class ImagesController extends AppController {
	var $components = array('Session');
	var $name = 'Images';

	public function admin_upload($foreign_id, $model= 'Oferta'){
		$this->autoRender = false;
		$this->layout = 'ajax';
	
		$dir = WWW_ROOT."files".DS."images".DS;

		if(isset($this->data['fields'])){
			if(!is_array($this->data['fields'])){
				parse_str( urldecode($this->data['fields']) , $output);
				$this->set('fields', $output );
			}else{
				$this->set('fields', $this->data['fields']);
			}
		}else{
			$this->set('fields', array('title'=>'Título'));
		}

		$image['file'] = $_FILES['file'];

	
		if(!empty($image['file']['error'])){
		}elseif(empty($image['file']['tmp_name']) || $image['file']['tmp_name'] == 'none'){
		}else{
		
			//Calcular nombre nuevo
			$nombre_original = $image['file']['name'];
			$extension = end(explode(".", strtolower($nombre_original)));
			if( !isAllowedExtension($nombre_original) ){ return "error extension";} //comprobar extension valida
			$titulo = substr($nombre_original,0,-4);
			$nombre_nuevo = slug(cortarTexto(substr($nombre_original,0,-4),30));
			$nombre_nuevo = $nombre_nuevo.rand(0,99999).".".$extension;

			//Grabar
			if (move_uploaded_file($image['file']['tmp_name'], $dir.$nombre_nuevo)){
			
				//buscar el orden
				$max_orden = $this->Image->field('orden', array('Image.foreign_id' => $foreign_id), 'Image.orden DESC');
			
				//es imagen o FLV?
				$image = array();
				$image['Image']['tipo'] = "imagen";
			
				//grabar en la BBDD
				$this->Image->create();
				$image['Image']['data_json'] = json_encode(array('title' => $titulo));
				$image['Image']['archivo'] = $nombre_nuevo;
				$image['Image']['foreign_id'] = $foreign_id;
				$image['Image']['model'] = $model;
				$image['Image']['orden'] = $max_orden+1;
				if ($this->Image->save($image)) {

					$this->Image->recursive = -1;
					$data = $this->Image->read(array("Image.*"),$this->Image->id);
					
					$this->set('image',$data['Image']);
					$this->render('/Elements/admin_caja_foto','ajax');

					
				}

				//for security reason, we force to remove all uploaded file
				@unlink($image['file']);

			}else{ return "ERROR: no subido";}
	
		}
		
		//$this->redirect($this->referer());

	}


	function editar_ajax($tipo){
		$this->layout = 'ajax';
		$this->autoRender=false;
		
		if (!empty($this->data)) {
			$json_arr = json_decode($this->Image->field('data_json', array('Image.id' => $this->data['Image']['id'])), true);
			$json_arr[$tipo] = $this->data['Image'][$tipo];
			$data = array(
				'Image' => array(
					'id' => $this->data['Image']['id'],
					'data_json' => json_encode($json_arr)
				)
			);

			if ($this->Image->save($data)) {
				return $this->data['Image'][$tipo];
			} 
		}
	}


	//Borrado mediante ajax
	function delete($id){
		$this->layout = 'ajax';
		$this->autoRender=false;

		if ($this->request->isAjax()){
			if( $this->Image->borrar($id) ){
				return true;
			}
		} 
	}
	
	
	function ordenar($model = 'Oferta'){
		//loop through the data sent via the ajax call
		foreach ($this->request->data['foto'] as $orden => $id){
			$this->Image->id = $id;
			//debug("UPDATE ".$this->Image->tablePrefix."images AS images SET `orden` =  '$orden' WHERE `id` = $id AND `model` = '$model'");
			if( $this->Image->query("UPDATE ".$this->Image->tablePrefix."images AS images SET `orden` =  '$orden' WHERE `id` = $id AND `model` = '$model'") ) { 
			//we have success!
			} else {
				//deal with possible errors!
			}
		}
		$this->autoRender=false;
	}  

		
}

?>