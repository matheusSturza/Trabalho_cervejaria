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
            $vetor = [];
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja");
            $pstmt->execute();
            while($linha = $pstmt->fetch()){
                $vetor[] = new cerveja(
                $linha["nome"],
                $linha["ibu"],
                $linha["data_fabri"],
                $linha["fabricante"],
                $linha["tipo"],
                $linha["teor"],
                $linha["local_degustado"],
                $linha["avaliacao"],
                $linha["comentarios"],
                $linha["img"],
                $linha["pais_origem"],
                $linha["sugestao"],
                null);
            } 
            return $vetor;
        }

        public function ListarPais(){
            $vetor = [];
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja ORDER BY pais DESC");
            $pstmt->execute();
            while($linha = $pstmt->fetch()){
                $vetor[] = new cerveja(
                $linha["nome"],
                $linha["ibu"],
                $linha["data_fabri"],
                $linha["fabricante"],
                $linha["tipo"],
                $linha["teor"],
                $linha["local_degustado"],
                $linha["avaliacao"],
                $linha["comentarios"],
                $linha["img"],
                $linha["pais_origem"],
                $linha["sugestao"],
                null);
            } 
            return $vetor;
        }

        public function listarNome(){
            $vetor = [];
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja ORDER BY nome DESC");
            $pstmt->execute();
            while($linha = $pstmt->fetch()){
                $vetor[] = new cerveja(
                $linha["nome"],
                $linha["ibu"],
                $linha["data_fabri"],
                $linha["fabricante"],
                $linha["tipo"],
                $linha["teor"],
                $linha["local_degustado"],
                $linha["avaliacao"],
                $linha["comentarios"],
                $linha["img"],
                $linha["pais_origem"],
                $linha["sugestao"],
                null);
            } 
            return $vetor;
        }

        public function listarNota(){
            $vetor = [];
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja ORDER BY avalicao DESC");
            $pstmt->execute();
            while($linha = $pstmt->fetch()){
                $vetor[] = new cerveja(
                $linha["nome"],
                $linha["ibu"],
                $linha["data_fabri"],
                $linha["fabricante"],
                $linha["tipo"],
                $linha["teor"],
                $linha["local_degustado"],
                $linha["avaliacao"],
                $linha["comentarios"],
                $linha["img"],
                $linha["pais_origem"],
                $linha["sugestao"],
                null);
            } 
            return $vetor;
        }

        public function listarEstilo($tipo){
            $vetor = [];
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja WHERE tipo=:tipo");
            $pstmt->bindValue(":tipo",$tipo);
            $pstmt->execute();
            while($linha = $pstmt->fetch()){
                $vetor[] = new cerveja(
                $linha["nome"],
                $linha["ibu"],
                $linha["data_fabri"],
                $linha["fabricante"],
                $linha["tipo"],
                $linha["teor"],
                $linha["local_degustado"],
                $linha["avaliacao"],
                $linha["comentarios"],
                $linha["img"],
                $linha["pais_origem"],
                $linha["sugestao"],
                null);
            } 
            return $vetor;
        }

        public function listarAvalicao($aval){
            $vetor = [];
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja WHERE avaliacao=:avaliacao");
            $pstmt->bindValue(":avaliacao",$aval);
            $pstmt->execute();
            while($linha = $pstmt->fetch()){
                $vetor[] = new cerveja(
                $linha["nome"],
                $linha["ibu"],
                $linha["data_fabri"],
                $linha["fabricante"],
                $linha["tipo"],
                $linha["teor"],
                $linha["local_degustado"],
                $linha["avaliacao"],
                $linha["comentarios"],
                $linha["img"],
                $linha["pais_origem"],
                $linha["sugestao"],
                null);
            } 
            return $vetor;
        }

        public function listarData($data){
            $vetor = [];
            $pstmt = $this->conexao->prepare("SELECT * FROM cerveja WHERE data_fabri=:data_fabri");
            $pstmt->bindValue(":data_fabri",$data);
            $pstmt->execute();
            while($linha = $pstmt->fetch()){
                $vetor[] = new cerveja(
                $linha["nome"],
                $linha["ibu"],
                $linha["data_fabri"],
                $linha["fabricante"],
                $linha["tipo"],
                $linha["teor"],
                $linha["local_degustado"],
                $linha["avaliacao"],
                $linha["comentarios"],
                $linha["img"],
                $linha["pais_origem"],
                $linha["sugestao"],
                null);
            } 
            return $vetor;
        }

        public function listarImgs() { 
        $lista = []; 
        $sql = "SELECT img FROM cerveja WHERE img IS NOT NULL"; $stmt = $this->conexao->query($sql);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $lista[] = $row['img'];
        }

        return $lista;
        } 
    }
?>
