<?php

class Cerveja
{
    private $nome;
    private $tipo;
    private $teor;
    private $ibu;
    private $pais_origem;
    private $data_fabri;
    private $local_degustado;
    private $avalicao;
    private $comentarios;
    private $img;
    private $fabricante;

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

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getTeor()
    {
        return $this->teor;
    }

    public function setTeor($teor)
    {
        $this->teor = $teor;
        return $this;
    }

    public function getIbu()
    {
        return $this->ibu;
    }

    public function setIbu($ibu)
    {
        $this->ibu = $ibu;
        return $this;
    }

    public function getPais_origem()
    {
        return $this->pais_origem;
    }

    public function setPais_origem($pais_origem)
    {
        $this->pais_origem = $pais_origem;
        return $this;
    }

    public function getData()
    {
        return $this->data_fabri;
    }

    public function setData($data_fabri)
    {
        $this->data = $data_fabri;
        return $this;
    }

    public function getLocal()
    {
        return $this->local_degustado;
    }

    public function setLocal($local_degustado)
    {
        $this->local = $local_degustado;
        return $this;
    }

    public function getAvalicao()
    {
        return $this->avalicao;
    }

    public function setAvalicao($avalicao)
    {
        $this->avalicao = $avalicao;
        return $this;
    }

    public function getComentarios()
    {
        return $this->comentarios;
    }

    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
        return $this;
    }

    public function getFabricante()
    {
        return $this->fabricante;
    }

    public function setFabricante($fabricante)
    {
        $this->fabricante = $fabricante;
        return $this;
    }
}