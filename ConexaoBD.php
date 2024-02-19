<?php
class ConexaoBD {
    private $nome_servidor = "localhost";
    private $nome_usuario = "root";
    private $senha = "123321";
    private $banco = "usuarios";
    private $porta = "3306";
    private $conecta;
    
    function __construct() {
        
    }

    public function conectar() {
        $this->conecta = new mysqli($this->nome_servidor, $this->nome_usuario, $this->senha, $this->banco);
        // Verificar Conexão
        if ($this->conecta->connect_error) {
            die("Conexão falhou: " . $this->conecta->connect_error."<br>");
        }
        return $this->conecta;
    }
    
    public function desconectar() {
        $this->conecta->close();
    }
    
    public function getConecta() {
        return $this->conecta;
    }

}