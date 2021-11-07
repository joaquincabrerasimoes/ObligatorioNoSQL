<?php

namespace App\Controllers;

use App\Libraries\Mongo;
use App\Models\CommonModel;

class Home extends BaseController
{
    public function index()
    {
        $mongo = new CommonModel();
        //$posts = $mongo->getOne('usuarios',['id' => 1]);
        $posts = $mongo->getList('usuarios');

        print_r($posts);
        /*foreach ($posts as $id => $post)
        {
            var_dump($id);
            var_dump($post);
        }*/
        die;
        return view('welcome_message');
    }
}
