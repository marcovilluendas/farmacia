<?php
class Image extends AppModel {

	var $name = 'Image';
	var $order = array('Image.orden' => 'asc', 'Image.id' => 'asc');
	
	var $validate = array(
		'archivo' => array('notempty'),
		'foreign_id' => array('numeric')
	);

	function afterFind($results, $primary=false) {
		foreach ($results as &$result) {
			if (isset($result['Image']['data_json'])){
				$image = $result['Image'];
			}elseif (isset($result['data_json'])){
				$image = $result;
			}else{
				$image = null;
			}
			if($image){
				$data_json = json_decode($image['data_json']);
				if($data_json){
					foreach($data_json as $key=>$value){
						$image[$key] = $value;
					}
				}
				//guardar
				if (isset($result['Image']['data_json'])){
					$result['Image'] = $image;
				}elseif (isset($result['data_json'])){
					$result = $image;
				}
			}
		}
		return $results;
	}
	
	function borrar($id){
			$dir = WWW_ROOT."files".DS."images".DS;

			$data=$this->read(null,$id);
			if($data['Image']['tipo'] == "video_flv"){
				if( $this->delete($id) && unlink($dir.$data['Image']['archivo']) && unlink($dir.$data['Image']['archivo'].".png") ){
					return true;
				}else{
					return false;
				}		
			}else{
				if( $this->delete($id) && unlink($dir.$data['Image']['archivo']) ){
					return true;
				}else{
					return false;
				}
			}
		}

}
?>