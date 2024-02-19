<?php
include 'ConexaoBD.php';
class UsuarioDAO {
    
    public function incluir($nome,$email,$login, $senha) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar(); 
        // Inserir registro
        $sql = "INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `login`, `senha`) VALUES (NULL, '$nome', '$email', '$login', '$senha');";
        if ($conecta->query($sql) === TRUE) {
            echo "<script>"."alert('Conta criada com sucesso');"."</script>";
            die;
        } else {
            echo "Erro: " . $sql . "<br>" . $conecta->error."<br>";
        }
    }
    public function excluir($id) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        $sql = "DELETE FROM consultas WHERE id_con=$id";
        if ($conecta->query($sql) === TRUE) {
            echo "<script>Registro apagado com sucesso</script>";
        } else {
            echo "Erro ao apagar o registro: " . $conecta->error."<br>";
        }
        $conexao->desconectar();
    }
    public function alterar($nome,$senha,$id_usuario,$email,$usuario) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        /** @var type $email */
        $sql = "UPDATE usuario SET nome = '$nome', email = '$email', login = '$usuario', senha = '$senha' WHERE id_usuario = $id_usuario;";
        if ($conecta->query($sql) === TRUE) {
            echo "<script>alert('Registro atualizado com sucesso');</script>";
            header('Location:perfil.php');
        } else {
            echo "Erro na atualização do registro: " . $conecta->error."<br>";
        }
        $conexao->desconectar();
    }
    
    public function buscar() {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT id_usuario, nome, email FROM usuario";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
        // saída dos dados
        while($linha = $resultado->fetch_assoc()) {
            echo "id: " . $linha["id_usuario"]. " - Name: " . $linha["nome"]. " " . $linha["email"]. "<br>";
        }
        } else {
            echo "0 results";
        }
        
        $conexao->desconectar();
    }
    
    
    public function buscarIdPorLogin($login){
        
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT id_usuario, login FROM usuario WHERE login like '%$login%'";
        $resultado = $conecta->query($sql);
        
        $conexao->desconectar();
        return $resultado;
        
        }
        
    public function pegarIdVet($nome){
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT id_vet FROM veterinarios WHERE nome like '%$nome%'";
        $resultado = $conecta->query($sql);
        
        $conexao->desconectar();
        return $resultado;
        
    }
    
    public function buscarUsuario($id_usuario) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows >= 0) {
            return $resultado;
            die;
        } else {
            echo "0 results";
        }
        
        $conexao->desconectar();
    }
    
    public function logar($usuario,$senha) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT senha, login FROM usuario WHERE senha='$senha' and login='$usuario'";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
        // saída dos dados
        while($linha = $resultado->fetch_assoc()) {
            echo "<script>"."alert('Login efetuado com sucesso');"."</script>";
            header('location:pagina.php');
            die;
            //Colocar a ação que irá fazer ao logar. Exemplo: redirecionamento com header  
        }
        } else {
            echo "<script>alert('Usuário ou senha incorretos');</script>";
        }
        
        $conexao->desconectar();
    }
    
    public function deslogar(){
        session_destroy();
        header('Location: login.php');
    }
    
    public function adicionarConsulta($data, $hora, $tipo_animal, $obs, $id_usuario, $id_vet){
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "INSERT INTO `consultas` (`id_con`, `data_consulta`, `hora_consulta`, `animal`, `obs`, `fk_usuario`, `fk_vet`) "
                . "VALUES (NULL, '$data', '$hora', '$tipo_animal', '$obs', '$id_usuario', '$id_vet');";
        
        if($conecta->query($sql) === TRUE){
            echo "<script>alert('Consulta adicionada com sucesso!')</script>";
            header('Location: perfil.php');
            die;
        }else{
            echo "<script>alert('Erro na criação da sua consulta')</script>";
        }
        
        $conexao->desconectar();
    }
    
    public function buscarConsulta($id) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT usuario.nome, veterinarios.nome as nomeveterinario, data_consulta, hora_consulta, animal, obs, id_con from consultas INNER JOIN usuario on fk_usuario = '$id' INNER JOIN veterinarios on fk_vet = id_vet GROUP BY id_con;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows >= 0) {
            return $resultado;
        } else {
            echo "0 results";
        }
        
        $conexao->desconectar();
    }
    
    public function pesquisarConsulta($info, $id){
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT usuario.nome, veterinarios.nome as nomeveterinario, data_consulta, hora_consulta, animal, obs, id_con from usuario INNER JOIN consultas on fk_usuario = '$id' INNER JOIN veterinarios on fk_vet = id_vet WHERE animal LIKE '%$info%' OR data_consulta LIKE '%$info%' OR hora_consulta LIKE '%$info%' OR veterinarios.nome LIKE '%$info%' OR obs LIKE '%$info%' GROUP BY id_con;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows >= 0) {
            return $resultado;
        } else {
            echo "<script>alert('Nenhuma consulta encontrada!');</script>";
        }
        
        $conexao->desconectar();
    }
    
}
