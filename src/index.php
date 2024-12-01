<?php
    // Inclui os controladores necessários para o funcionamento do sistema.
    require_once("./App/Controllers/crtLogin.php");
    require_once("./App/Controllers/crtSessao.php");
    require_once("./App/Controllers/crtAlmoxarife.php");
    require_once("./App/Controllers/crtEstoque.php");
    require_once("./App/Controllers/crtFornecedor.php");
    require_once("./App/Controllers/crtEpi.php");
    require_once("./App/Controllers/CrtFuncionarios.php");
    require_once("./App/Controllers/CrtAvisos.php");

    // Inclui os modelos necessários para interagir com o banco de dados.
    require_once("./App/Models/conexao.php");
    require_once("./App/Models/estoque.php");
    require_once("./App/Models/fornecedor.php");
    require_once("./App/Models/epi.php");
    require_once("./App/Models/funcionario.php");
    require_once("./App/Models/avisos.php");

    // Inclui os serviços de autenticação e respostas.
    require_once("App/Resources/Services/auths.php");
    require_once("App/Resources/Services/respostas.php");

    // Inicia uma nova sessão para o usuário.
    session_start();

    // Define o caminho base para as views.
    define("viewPath", "App/Resources/Views/");  

    // Carrega as configurações de banco de dados a partir de um arquivo de configuração.
    $ini = parse_ini_file('./pi.ini');
    
    // Cria uma nova conexão com o banco de dados usando as configurações carregadas.
    $conn = new conexao($ini['url'], $ini['user'], $ini['pass'], $ini['db_name']);
    
    // Obtém a URL da requisição atual.
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Inicia o roteamento baseado na URL solicitada.
    switch ($url){
        // Caso a URL seja "/logar", chama o método de login.
        case "/logar":
            CrtLogin::logar($conn);
            break;
        
        // Caso a URL seja "/sair", chama o método de logout e encerra a sessão.
        case "/sair":
            CrtSessao::sair();
            break;
        
        // Caso a URL seja "/tCadastroAl", inclui a view para cadastro de almoxarife.
        case "/tCadastroAl":
            CrtAlmoxarife::TcadastarAlmoxarife();
            break;
        
        // Caso a URL seja "/cadastrarAl", chama o método para cadastrar um almoxarife.
        case "/cadastrarAl":
            CrtAlmoxarife::cadastrarAlmoxarife($conn);
            break;

        // Caso a URL seja "/TadicionarEpi", inclui a view para adicionar EPI.
        case "/TadicionarEpi":
            include(viewPath."/TadicionarEpi.php");
            break;

        // Caso a URL seja "/adicionarEPI", chama o método para adicionar EPI ao estoque.
        case "/adicionarEPI":
            CrtEstoque::adicionarEPI($conn);
            break;
        
        // Caso a URL seja "/Tmenu", inclui a view do menu principal.
        case "/Tmenu":
            include(viewPath."/Tmenu.php");
            break;
        
        // Caso a URL seja "/Tcompra_epi", inclui a view para compra de EPI.
        case "/Tcompra_epi":
            include(viewPath."/Tcompra_epi.php");
            break;
        
        // Caso a URL seja "/listar_estoque", chama o método para listar os itens no estoque.
        case "/listar_estoque":
            CrtEstoque::listar_estoque($conn);
            break;
        
        // Caso a URL seja "/listar_fornecedores", chama o método para listar fornecedores.
        case "/listar_fornecedores":
            CrtFornecedor::listar_fornecedores($conn);
            break;

        // Caso a URL seja "/comprar_epi", chama o método para registrar a compra de EPI.
        case "/comprar_epi":
            CrtEpi::compra_epi($conn);
            break;
        
        // Caso a URL seja "/Tremover_epi.php", inclui a view para remover EPI.
        case "/Tremover_epi.php":
            include(viewPath."/Tremover_epi.php");
            break;
        
        // Caso a URL seja "/remover_epi", chama o método para remover EPI do estoque.
        case "/remover_epi":
            CrtEstoque::remover_epi($conn);
            break;
        
        // Caso a URL seja "/Tver_estoque", chama o método para visualizar o estoque.
        case "/Tver_estoque":
            CrtEstoque::Tver_estoque($conn);
            break;
        
        // Caso a URL seja "/Tregistrar_saida", inclui a view para registrar a saída de EPI.
        case "/Tregistrar_saida":
            include(viewPath."/Tregistrar_saida.php");
            break;
        
        // Caso a URL seja "/retirada_epi", chama o método para registrar a retirada de EPI.
        case "/retirada_epi":
            CrtAlmoxarife::retirada_epi($conn);
            break;

        // Caso a URL seja "/listar_almoxarife", chama o método para listar os almoxarifes.
        case "/listar_almoxarife":
            CrtAlmoxarife::listar_almoxarife($conn);
            break;
        
        // Caso a URL seja "/listar_funcionarios", chama o método para listar os funcionários.
        case "/listar_funcionarios":
            CrtFuncionarios::listar_funcionarios($conn);
            break;
        
        // Caso a URL seja "/Tdevolucao", inclui a view para registrar a devolução de EPI.
        case "/Tdevolucao":
            include(viewPath."/Tdevolucao.php");
            break;
        
        // Caso a URL seja "/devolucao", chama o método para registrar a devolução de EPI.
        case "/devolucao":
            CrtAlmoxarife::devolucao($conn);
            break;
        
        // Caso a URL seja "/Thistorico_saidas", chama o método para mostrar o histórico de saídas.
        case "/Thistorico_saidas":
            CrtAlmoxarife::Thistorico_saidas($conn);
            break;
        
        // Caso a URL seja "/Thistorico_devolucao", chama o método para mostrar o histórico de devoluções.
        case "/Thistorico_devolucao":
            CrtAlmoxarife::Thistorico_devolucao($conn);
            break;

        // Caso a URL seja "/Tenviar_aviso", inclui a view para enviar avisos.
        case "/Tenviar_aviso":
            include(viewPath."/Tenviar_aviso.php");
            break;
        
        // Caso a URL seja "/enviar_aviso", chama o método para enviar um aviso.
        case "/enviar_aviso":
            CrtAvisos::enviar_aviso($conn);
            break;

        // Caso a URL seja "/Tcadastrar_fornecedor", inclui a view para cadastrar fornecedor.
        case "/Tcadastrar_fornecedor":
            include(viewPath."/Tcadastrar_fornecedor.php");
            break;
        
        // Caso a URL seja "/cadastrar_fornecedor", chama o método para cadastrar um fornecedor.
        case "/cadastrar_fornecedor":
            CrtFornecedor::cadastrar_fornecedor($conn);
            break;

        // Caso a URL seja "/Tcadastrar_funcionario", inclui a view para cadastrar funcionário.
        case "/Tcadastrar_funcionario":
            include(viewPath."/Tcadastrar_funcionario.php");
            break;
        
        // Caso a URL seja "/cadastrar_funcionario", chama o método para cadastrar um funcionário.
        case "/cadastrar_funcionario":
            CrtFuncionarios::cadastrar_funcionario($conn);
            break;
        
        // Caso a URL seja "/Tchecar_avisos", chama o método para verificar avisos.
        case "/Tchecar_avisos":
            CrtAvisos::Tchecar_avisos($conn);
            break;
        
        // Caso a URL seja "/desativar_aviso", chama o método para desativar um aviso.
        case "/desativar_aviso":
            CrtAvisos::desativar_aviso($conn);
            break;
        
        // Caso a URL seja "/contagem_avisos", chama o método para contar os avisos ativos.
        case "/contagem_avisos":
            CrtAvisos::contagem_avisos($conn);
            break;

        // Caso nenhuma das URLs seja correspondida, chama a tela de login.
        default:
            CrtLogin::telaLogin();
            break;
    }
?>
