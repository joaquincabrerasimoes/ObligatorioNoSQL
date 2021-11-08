<?php

namespace App\Models;

class Usuarios
{
    private $email;
    private $password;
    private $nombre;
    private $apellido;

    /**
     * @param $email
     * @param $password
     * @param $nombre
     * @param $apellido
     */
    public function __construct($email, $password, $nombre, $apellido)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido): void
    {
        $this->apellido = $apellido;
    }
}