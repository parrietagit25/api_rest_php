<?php 

class respuestas{

    private $response = [
        'status' => 'ok', 
        'result' => []
    ];

    public function error_405(){
        $this->response['status'] = 'error';
        $this->response['result'] = [
            'error_id' => '405', 
            'error_msg' => 'Metodo no permitido'
        ];
        return $response;
    }

    public function error_200($string = "Datos incorrectos"){
        $this->response['status'] = 'error';
        $this->response['result'] = [
            'error_id' => '200', 
            'error_msg' => $string
        ];
        return $response;
    }

    public function error_400(){
        $this->response['status'] = 'error';
        $this->response['result'] = [
            'error_id' => '400', 
            'error_msg' => 'Datos imcompletos o formato incorrectos'
        ];
        return $response;
    }


}