<?

App::uses('AppHelper', 'View/Helper');

class FilterHelper extends AppHelper {

	function eliminarFiltro($filtro){
		$filtros = $this->params['named'];
		$url = "";

		foreach($filtros as $key => $value){
			if($key != $filtro){
				$url .= "/".$key.":".$value;
			}else{
				$url .= "/".$key.":-1";
			}
		}
		return $url;
	}
	

	function cambiarFiltro($filtro,$nuevo_valor){
		$filtros = $this->params['named'];
		$url = "";
		$cambio = false;
		
		foreach($filtros as $key => $value){
			if($key != $filtro){
				$url .= "/".$key.":".$value;
			}else{
				$url .= "/".$key.":".$nuevo_valor;
				$cambio = true;
			}
		}
		if(!$cambio){
			$url .= "/".$filtro.":".$nuevo_valor;
		}
		return $url;
	}

}
?>