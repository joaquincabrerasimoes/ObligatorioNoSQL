<?php

namespace App\Controllers;

use App\Libraries\Mongo;
use App\Models\CommonModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use SebastianBergmann\Diff\Exception;

class Roles extends BaseController
{
    use ResponseTrait;
    protected $context;

    public function __construct()
    {
        $this->context = new CommonModel();
    }

    public function index()
    {
        $roles = $this->context->getList("roles");
        return $this->respond($roles);
    }

    public function getOne($nombre)
    {
        $cond = ['nombre' => $nombre];
        $rol = $this->context->getOne('roles', $cond);

        return $this->respond($rol);
    }

    public function create()
    {
        $ret = ['status' => 'OK'];
        $params = $this->request->getPost();
        try {
            $cond = ['nombre' => $params['nombre']];
            $rol = $this->context->getOne('roles', $cond);
            if ($rol != null) {
                throw new \Exception();
            }
            $this->context->create('roles', [(object)($params)]);
        } catch (\Exception $e) {
            $ret = ['status' => 'Error', 'code' => '101'];
        }

        return $this->respond($ret);
    }

}
