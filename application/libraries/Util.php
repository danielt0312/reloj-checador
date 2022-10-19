<?php
class Util 	{

	public function setPOST($data)	{
		$post = array();
		if(is_array($data))	{

			if(count($data) > 0)	{
				foreach($data as $indice => $valor)	{
					$post[$indice]			= $valor;
				}
				return ['error' => 0, 'mensaje' => 'Operación exitosa', 'data' => $post];
			}else{
				return ['error' => 1, 'mensaje' => 'El arreglo no tiene datos'];
			}

		}else{
			return ['error' => 1, 'mensaje' => 'Tipo de datos no válido'];
		}

	}

	public function randomString($length) 	{

		$characters = '0123456789_.#$abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];

        }

        return $randomString;

	}

	public function setArreglo($arreglo, $key = 'id'){
	    $setArreglo = [];
	    $rows = count($arreglo);
	    for($i = 0; $i < $rows; $i++){
	        $setArreglo[$i+1] = $arreglo[$i]->$key;
        }
	    return $setArreglo;
    }

    public function validaSeteo($resultado_metodo){
	    if($resultado_metodo > 0){
	        $data = [
	            'error' => 0,
                'mensaje' => "Operación exitosa",
                'retorno' => $resultado_metodo
            ];
        }else{
            $data = [
                'error' => 1,
                'mensaje' => "Error: Error inesperado, por favor verifique",
                'retorno' => $resultado_metodo
            ];
        }
	    return $data;
    }

}