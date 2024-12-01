<?php
    // Define a classe Almoxarife, que contém métodos para gerenciar a manipulação de dados do almoxarife
    class Almoxarife{

        private $pdo; // Criando um atributo para armazenar o objeto PDO, que é usado para interagir com o banco de dados
        private $stmt; // Variável para armazenar a declaração preparada (PDOStatement)
		
        // Método construtor para inicializar o objeto Almoxarife com uma conexão PDO
        public function __construct($conn){
            $this->pdo = $conn; // Armazena a conexão PDO recebida no atributo $pdo
        }

        // Método para cadastrar um novo almoxarife no banco de dados
        public function cadastrar($usuario, $senha){
            // Criptografa a senha usando o algoritmo de hash padrão do PHP
            $crypto = password_hash($senha, PASSWORD_DEFAULT);

            // Prepara a consulta SQL para inserir o novo usuário e a senha criptografada
            $stmt = $this->pdo->conn->prepare("insert into almoxarife(usuario,senha) values(:usuario, :senha)");
            
            // Executa a consulta, passando os parâmetros para a consulta preparada
            $stmt->execute([
                ":usuario" => $usuario,  // Valor do parâmetro 'usuario' (login)
                ":senha" => $crypto      // Valor do parâmetro 'senha' (senha criptografada)
            ]);
        }

        // Método para listar os almoxarifes do banco de dados
        public function listar_almoxarife($tempUsuario){
            // Se nenhum nome de usuário for fornecido, lista todos os almoxarifes
            if($tempUsuario == null) {
                $stmt = $this->pdo->conn->prepare("SELECT * FROM almoxarife"); // Prepara consulta para selecionar todos os almoxarifes
                $stmt->execute();  // Executa a consulta
                return $stmt;      // Retorna o resultado da consulta
            }

            // Se um nome de usuário for fornecido, busca esse usuário específico
            $stmt = $this->pdo->conn->prepare("SELECT * FROM almoxarife WHERE almoxarife.usuario = :tempUsuario");
            $stmt->execute([
                ":tempUsuario"=> $tempUsuario  // Passa o nome de usuário como parâmetro
            ]);
            return $stmt;  // Retorna o resultado da consulta
        }

        // Método para registrar a retirada de um EPI
        public function retirada_epi($epis_id, $quantidade, $almoxarife_id, $idfuncionario){
            // Cria um objeto Epi para acessar os dados do EPI que está sendo retirado
            $epi = new Epi($this->pdo, $epis_id);
            
            // Verifica se a quantidade de EPIs solicitada está disponível no estoque
            if ($epi->getEstoque() >= $quantidade) {
                // Prepara a consulta SQL para registrar a retirada do EPI
                $this->stmt = $this->pdo->conn->prepare("call registrar_saida(:epis_id,:almoxarife_id,:quantidade,:funcionarios_idfuncionario);");

                // Executa a consulta, passando os parâmetros necessários
                $this->stmt->execute([
                    ':epis_id' => $epi->getId(),  // ID do EPI
                    ':almoxarife_id' => $almoxarife_id,  // ID do almoxarife que está realizando a retirada
                    ':quantidade' => $quantidade,  // Quantidade de EPIs sendo retirada
                    ':funcionarios_idfuncionario' => $idfuncionario  // ID do funcionário que está retirando
                ]);
                // Exibe uma mensagem de sucesso após registrar a retirada
                Respostas::lancar_sucesso(e:"Retirada registrada com sucesso!");
            } else {
                // Exibe uma mensagem de alerta caso o estoque seja insuficiente ou haja erro
                Respostas::lancar_alerta(e:"Estoque insuficiente ou erro no registro.");
            }
        }

        // Método para registrar a devolução de um EPI
        public function registrar_devolucao($funcionarios_retira_id, $comentario) {
            try {
                // Prepara a consulta para verificar se o EPI foi devolvido ou não
                $this->stmt = $this->pdo->conn->prepare("SELECT devolvido FROM funcionarios_retira WHERE id = :funcionarios_retira_id");
                $this->stmt->execute([':funcionarios_retira_id' => $funcionarios_retira_id]); // Executa a consulta

                // Recupera o resultado da consulta
                $retirada = $this->stmt->fetch(PDO::FETCH_ASSOC);
        
                // Se a devolução ainda não foi registrada (devolvido = 0), registra a devolução
                if ($retirada && $retirada['devolvido'] == 0) {
                    // Prepara a consulta para registrar a devolução do EPI
                    $this->stmt = $this->pdo->conn->prepare("call registrar_devolucao(:funcionarios_retira_id, :comentario)");
                    // Executa a consulta passando os parâmetros necessários
                    $this->stmt->execute([
                        ':funcionarios_retira_id' => $funcionarios_retira_id,  // ID da retirada
                        ':comentario' => $comentario  // Comentário sobre a devolução
                    ]);
                } 
            } catch (PDOException $e) {
                // Caso ocorra um erro ao tentar registrar a devolução, exibe a mensagem de erro
                echo "Erro ao registrar devolução: " . $e->getMessage();
            }
        }
        
        // Método para visualizar as saídas de EPIs
        public function ver_saidas(){
            // Prepara a consulta para chamar o procedimento armazenado 'ver_saidas'
            $this->stmt = $this->pdo->conn->prepare("call ver_saidas;");
            $this->stmt->execute();  // Executa a consulta
            return $this->stmt;      // Retorna o resultado da consulta
        }

        // Método para visualizar as entradas de EPIs
        public function ver_entradas(){
            // Prepara a consulta para chamar o procedimento armazenado 'ver_entradas'
            $this->stmt = $this->pdo->conn->prepare("call ver_entradas;");
            $this->stmt->execute();  // Executa a consulta

            return $this->stmt;  // Retorna o resultado da consulta
        }
    }
?>
