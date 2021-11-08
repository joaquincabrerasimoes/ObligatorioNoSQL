<?php

namespace App\Controllers;

use App\Libraries\Mongo;
use App\Models\CommonModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use SebastianBergmann\Diff\Exception;

class Autenticar extends BaseController
{
    use ResponseTrait;
    protected $context;

    public function __construct()
    {
        $this->context = new CommonModel();
    }

    public function index()
    {
        $ret = ['status' => 'OK'];
        $params = $this->request->getPost();
        try {
            $cond = ['email' => $params['email'], 'password' => $params['password']];
            $usuario = $this->context->getOne('usuarios', $cond );
            if ($usuario == null) {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            $ret = ['status' => 'Error'];
        }

        return $this->respond($ret);
    }
}
