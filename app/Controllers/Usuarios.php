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
        $usuario = $this->context->getOne('usuarios', $cond);

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
            $tmp = [
                'email' => $params['email'],
                'password' => $params['password'],
                'nombre' => $params['nombre'],
                'apellido' => $params['apellido'],
                'roles' => []
            ];
            $this->context->create('usuarios', [(object)($tmp)]);
        } catch (\Exception $e) {
            $ret = ['status' => 'Error', 'code' => '101'];
        }

        return $this->respond($ret);
    }

    public function addrol()
    {
        $ret = ['status' => 'OK'];
        $params = $this->request->getPost();
        try {
            $cond = ['email' => $params['email']];
            $usuario = $this->context->getOne('usuarios', $cond);
            if ($usuario == null) {
                throw new \Exception('', 102);
            }
            if ($usuario->password != $params['password']) {
                throw new \Exception('', 104);
            }
            $rolestoadd = explode(',', $params['roles']);
            $roltosave = (array)$usuario->roles;
            foreach ($rolestoadd as $rol){
                if(!in_array(trim($rol), $roltosave)){
                    $dbRol = $this->context->getOne('roles', ['nombre' => trim($rol)]);
                    if($dbRol != null){
                        $roltosave[] = trim($rol);
                    } else {
                        //probably the best is if doesnt exists the rol give an error but that is not require
                        $ret['warning'] = "some roles doesn't exists";
                    }
                }
            }

            $this->context->updateOne('usuarios', ['email'=>$params['email']], ['roles' => $roltosave]);
        } catch (\Exception $e) {
            $ret = ['status' => 'Error', 'code' => "{$e->getCode()}"];
        }

        return $this->respond($ret);
    }

    public function delrol()
    {
        $ret = ['status' => 'OK'];
        $params = $this->request->getPost();
        try {
            $cond = ['email' => $params['email']];
            $usuario = $this->context->getOne('usuarios', $cond);
            if ($usuario == null) {
                throw new \Exception('', 102);
            }
            if ($usuario->password != $params['password']) {
                throw new \Exception('', 104);
            }
            $rolestoadd = explode(',', $params['roles']);
            $roltosave = (array)$usuario->roles;
            foreach ($rolestoadd as $rol){
                if(in_array(trim($rol), $roltosave)){
                    $dbRol = $this->context->getOne('roles', ['nombre' => trim($rol)]);
                    if($dbRol != null){
                        $key = array_search(trim($rol), $roltosave);
                        unset($roltosave[$key]);
                    } else {
                        //probably the best is if doesnt exists the rol give an error but that is not require
                        $ret['warning'] = "some roles doesn't exists";
                    }
                } else {
                    throw new \Exception('El rol '.$rol.' no esta asignado al usuario', 103);
                }
            }

            $this->context->updateOne('usuarios', ['email'=>$params['email']], ['roles' => $roltosave]);
        } catch (\Exception $e) {
            $ret = ['status' => 'Error', 'code' => "{$e->getCode()}"];
            if($e->getMessage() != ''){
                $ret['description'] = $e->getMessage();
            }
        }

        return $this->respond($ret);
    }
}
