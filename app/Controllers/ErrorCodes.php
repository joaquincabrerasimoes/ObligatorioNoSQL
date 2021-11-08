<?php

namespace App\Controllers;

use App\Libraries\Mongo;
use App\Models\CommonModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use SebastianBergmann\Diff\Exception;

class ErrorCodes extends BaseController
{
    use ResponseTrait;
    protected $context;

    public function __construct()
    {
        $this->context = new CommonModel();
    }

    public function index()
    {
        $ret = [
            [
                'code' => 101,
                'description' => "El usuario que quiere crear ya existe."
            ],
            [
                'code' => 102,
                'description' => "El usuario no existe."
            ],
            [
                'code' => 103,
                'description' => "El rol indicado no se encuentra asignado a ese usuario."
            ],
            [
                'code' => 104,
                'description' => "la contraseña no coincide."
            ]
        ];

        return $this->respond($ret);
    }
}
