<?php
class Imagem {

    private $nomeArquivo;

    // Função para salvar a imagem na pasta 'img' e guardar o nome
    public function salvar($arquivo){
        if(!isset($arquivo) || $arquivo['name'] == ""){
            return false;
        }

        // Pasta onde as imagens serão salvas
        $pasta = "img/";

        // Cria a pasta se não existir
        if(!is_dir($pasta)){
            mkdir($pasta, 0777, true);
        }

        // Gera nome único para evitar sobrescrever
        $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $this->nomeArquivo = uniqid() . "." . $ext;

        $destino = $pasta . $this->nomeArquivo;
        return move_uploaded_file($arquivo['tmp_name'], $destino);
    }

    public function getNomeArquivo(){
        return $this->nomeArquivo;
    }
}
