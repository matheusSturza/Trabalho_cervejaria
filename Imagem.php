<?php
class Imagem {

    private $nomeArquivo;

    public function salvar($arquivo){
        if(!isset($arquivo) || $arquivo['name'] == ""){
            return false;
        }

        $pasta = "img/";

        if(!is_dir($pasta)){
            mkdir($pasta, 0777, true);
        }
        $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $this->nomeArquivo = uniqid() . "." . $ext;

        $destino = $pasta . $this->nomeArquivo;
        return move_uploaded_file($arquivo['tmp_name'], $destino);
    }

    public function getNomeArquivo(){
        return $this->nomeArquivo;
    }
}
