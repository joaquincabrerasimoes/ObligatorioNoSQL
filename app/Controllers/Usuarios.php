<?php

namespace App\Controllers;

use App\Libraries\Mongo;
use App\Models\CommonModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use SebastianBergmann\Diff\Exception;

class Usuarios extends BaseController
{
    use ResponseTrait;
    protected $context;

    public function __construct()
    {
        $this->context = new CommonModel();
    }

    public function index()
    {
        $usuarios = $this->context->getList('usuarios');
        return $this->respond($usuarios);
    }

    public function getOne($id)
    {
        $cond = ['email' => ($id)];
        $usuario = $this->context->getOne('usuarios', $cond );

        return $this->respond($usuario);
    }

    public function create()
    {
        $ret = ['status' => 'OK'];
        $params = $this->request->getPost();
        try {
            $cond = ['email' => $params['email']];
            $usuario = $this->context->getOne('usuarios', $cond);
            if ($usuario != null) {
                throw new \Exception();
            }
            $this->context->create('usuarios', [(object)($params)]);
        } catch (\Exception $e) {
            $ret = ['status' => 'Error', 'code' => '101'];
        }

        return $this->respond($ret);
    }
}
