<?php 
    include_once("conexao.php");
    include_once("Usuario.php");


    class UsuarioDAO{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getConexao();
        }

        public function inserir(Usuario $user){        
            $pstmt = $this->conexao->prepare("INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)");
            $pstmt->bindValue(":nome", $user->getNome());
            $pstmt->bindValue(":email", $user->getEmail());
            $pstmt->bindValue(":senha", $user->getSenha());
            $pstmt->execute();
        }

        public function editar(Usuario $user){        
            $pstmt = $this->conexao->prepare("UPDATE SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
            $pstmt->bindValue(":nome", $user->getNome());
            $pstmt->bindValue(":email", $user->getEmail());
            $pstmt->bindValue(":senha", $user->getSenha());
            $pstmt->bindValue(":id", $user->getId());
            $pstmt->execute();
        }


        public function logar(Usuario $user){
            $pstmt = $this->conexao->prepare("SELECT nome,senha FROM usuario WHERE nome = :nome AND senha = :senha");
            $pstmt->bindValue(":nome",$user->getNome());
            $pstmt->bindValue(":senha",$user->getSenha());
            $pstmt->execute();

            $linha = $pstmt->fetch();

            if($linha["nome"] == $user->getNome() && $linha["senha"] == $user->getSenha()){
                return true;
            }else{
                return false;
            }
            
        }
    }

?>