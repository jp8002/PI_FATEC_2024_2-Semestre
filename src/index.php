<?php
    require_once("./App/Controllers/crtLogin.php");
    require_once("./App/Controllers/crtSessao.php");
    require_once("./App/Controllers/crtAlmoxarife.php");
    require_once("./App/Controllers/crtEstoque.php");
    require_once("./App/Controllers/crtFornecedor.php");
    require_once("./App/Controllers/crtEpi.php");
    require_once("./App/Controllers/CrtFuncionarios.php");
    require_once("./App/Controllers/CrtAvisos.php");
    require_once("./App/Models/conexao.php");
    require_once("./App/Models/estoque.php");
    require_once("./App/Models/fornecedor.php");
    require_once("./App/Models/epi.php");
    require_once("./App/Models/funcionario.php");
    require_once("./App/Models/avisos.php");
    require_once("App/Resources/Services/auths.php");
    require_once("App/Resources/Services/respostas.php");
    session_start();

     define("viewPath","App/Resources/Views/");  

    $ini = parse_ini_file('./pi.ini');
    $conn = new conexao($ini['url'], $ini['user'], $ini['pass'], $ini['db_name']);
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    

    
    switch ($url){
        case "/logar":
            CrtLogin::logar($conn);
            break;
        
        case "/sair":
            CrtSessao::sair();
            break;
        
        case "/tCadastroAl":
            CrtAlmoxarife::TcadastarAlmoxarife();
            break;
        
        case "/cadastrarAl":
            CrtAlmoxarife::cadastrarAlmoxarife($conn);
            break;

        case "/TadicionarEpi":
            include(viewPath."/TadicionarEpi.php");
            break;

        case "/adicionarEPI":
            CrtEstoque::adicionarEPI($conn);
            break;
        
        case "/Tmenu":
            include(viewPath."/Tmenu.php");
            break;
        
        case "/Tcompra_epi":
            include(viewPath."/Tcompra_epi.php");
            break;
        
        case "/listar_estoque":
            CrtEstoque::listar_estoque($conn);
            break;
        
        case "/listar_fornecedores":
            CrtFornecedor::listar_fornecedores($conn);
            break;

        case "/comprar_epi":
            CrtEpi::compra_epi($conn);
            break;
        
        case "/Tremover_epi.php":
            include(viewPath."/Tremover_epi.php");
            break;
        
        case"/remover_epi":
            CrtEstoque::remover_epi($conn);
            break;
        
        case "/Tver_estoque":
            CrtEstoque::Tver_estoque($conn);
            break;
        
        case "/Tregistrar_saida":
            include (viewPath."/Tregistrar_saida.php");
            break;
        
        case "/retirada_epi":
            CrtAlmoxarife::retirada_epi($conn);
            break;

        case "/listar_almoxarife":
            CrtAlmoxarife:: listar_almoxarife($conn);
            break;
        
        case "/listar_funcionarios":
            CrtFuncionarios::listar_funcionarios($conn);
            break;
        
        case "/Tdevolucao":
            include (viewPath."/Tdevolucao.php");
            break;
        
        case "/devolucao":
            CrtAlmoxarife::devolucao($conn);
            break;
        
        case "/Thistorico_saidas":
            CrtAlmoxarife::Thistorico_saidas($conn);
            break;
        
        case "/Thistorico_devolucao":
            CrtAlmoxarife::Thistorico_devolucao($conn);
            break;

        case "/Tenviar_aviso":
            include (viewPath."/Tenviar_aviso.php");
            break;
        
        case "/enviar_aviso":
            CrtAvisos::enviar_aviso($conn);
            break;

        case "/Tcadastrar_fornecedor":
            include(viewPath."/Tcadastrar_fornecedor.php");
            break;
        
        case "/cadastrar_fornecedor":
            CrtFornecedor::cadastrar_fornecedor($conn);
            break;

        case "/Tcadastrar_funcionario":
            include(viewPath."/Tcadastrar_funcionario.php");
            break;
        
        case "/cadastrar_funcionario":
            CrtFuncionarios::cadastrar_funcionario($conn);
            break;
        
        case "/Tchecar_avisos":
            CrtAvisos::Tchecar_avisos($conn);
            break;
        
        case "/desativar_aviso":
            CrtAvisos::desativar_aviso($conn);
            break;
        
        case "/contagem_avisos":
            CrtAvisos::contagem_avisos($conn);
            break;

        default:
            CrtLogin::telaLogin();
            break;

    }

    

   