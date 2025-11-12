<?php 
    include_once("conexao.php");
    include_once("Cerveja.php");

    class CervejaDAO{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getConexao();
        }

        public function inserir(Cerveja $cerveja){        
            $pstmt = $this->conexao->prepare("INSERT INTO cerveja (nome, ibu, data_fabri, fabricante, tipo,local_degustado, 
            avalicao, comentarios, img, pais_origem, teor) VALUES (:nome, :ibu, :data_fabri, :fabricante, :tipo, 
            :local_degustado, :avalicao, :comentarios, :img, :pais_origem, :teor)");
            $pstmt->bindValue(":nome", $cerveja->getNome());
            $pstmt->bindValue(":ibu", $cerveja->getIbu());
            $pstmt->bindValue(":data_fabri", $cerveja->getData());
            $pstmt->bindValue(":fabricante", $cerveja->getFabricante());
            $pstmt->bindValue(":tipo", $cerveja->getTipo());
            $pstmt->bindValue(":teor", $cerveja->getTeor());
            $pstmt->bindValue(":local_degustado", $cerveja->getLocal());
            $pstmt->bindValue(":avaliacao", $cerveja->getAvalicao());
            $pstmt->bindValue(":comentarios", $cerveja->getComentarios());
            $pstmt->bindValue(":img", $cerveja->getImg());
            $pstmt->bindValue(":pais_origem", $cerveja->getPais_origem());
            $pstmt->execute();
        }

        public function listar(){
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja");

             
        }
    }
?>
