<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class CustomerService
{
    use ConsumesExternalService;

    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = env('SERVICE_URL');
    }

    public function listar($data)
    {
        if(!isset($data["pageSize"])) $data["pageSize"]=100;
        return $this->performRequest('GET', 'customers',Array(),Array(),$data);
    }
    public function obtenerId($id)
    {
        return $this->performRequest('GET', 'customers/'.$id,Array(),Array(),Array());
    }
    public function actualizar($data,$id)
    {
        return $this->performRequest('PUT', 'customers',Array(),Array(),Array(),$data);
    }
    public function registrar($data)
    {
        return $this->performRequest('POST', 'customers',Array(),Array(),Array(),$data);
    }
    public function borrar($id)
    {
        return $this->performRequest('DELETE', 'customers/'.$id,Array(),Array(),Array());
    }


}
