<?php 
    include_once 'Conexao_config.php';

    class conexao {
    
    private static $conexao;
    
    private function __construct() {} 
             
    public static function getConexao() {
    	$config = new Conexao_config();
    	
    	if (!isset(self::$conexao)) {
    		self::$conexao = new PDO($config->getSgbd().":host=".$config->getHost()."; dbname=".$config->getBd().";", $config->getUsuario(), $config->getSenha());
    		self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	}
    	
    	return self::$conexao;
    }
        
}
?>