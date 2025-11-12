<?php

class Usuario
{
    private $nome;
    private $senha;
    private $email;
    private $id;

    public function __construct()
    {
        if(func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach($atributos as $atributo => $valor) {
                if(isset($valor) && property_exists(get_class($this), $atributo)) {
                    $this->$atributo = $valor;
                }
            }

        }
    }

    public function atualizar($atributos)
    {
        foreach($atributos as $atributo => $valor) {
            if(isset($valor) && property_exists(get_class($this), $atributo)) {
                $this->$atributo = $valor;
            }
        }

    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}