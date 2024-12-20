<div align="center">
  <img src="./imagens/logo.png" alt="DOT logo" width="200"/>
  <h1>DOT</h1>
  <h2>SISTEMA PARA ALMOXARIFADO</h2>
  
</div>

![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)


<h2>DESCRIÇÃO</h2>
<p >
  Esse repositório será usado para catalogar o desenvolvimento do PI do 2º semestre do tecnólogo em Desenvolvimento de Softwares Multiplataforma.
</p>
<p >
  Apesar do grande avanço dos softwares de gestão e gerenciamento de recursos que o mercado presenciou. Ainda se vê um alto número de empresas de pequeno e médio porte que ainda não adotaram o uso de programas para realizar o controle de seus        estoques, utilizando ainda o papel como forma de registro de movimentações.
</p>
<p >
  Com isso em mente pretendemos criar uma alternativa mais eficiente e acessível para registrar as movimentações de estoque. Tendo como objetivo a criação de um sistema de controle de estoque de almoxarifados. 
</p>

<h2>GRUPO</h2>
<ul>
  <li><a href="https://github.com/DaviBonelli">DAVI BONELLI RODRIGUES</a></li>
  <li><a href="https://github.com/DaviBonelli">DAVI SAMUEL SCHWARTZ</a></li>
  <li><a href="https://github.com/izakerollayne">IZABELA KEROLLAYNE PEREIRA SOUZA</a></li>
  <li><a href="https://github.com/jp8002">JOAO PEDRO PEREIRA DOS SANTOS</a></li>
  <li><del><a>JUAN FELIPE DA SILVA SANTOS</a></del></li>
</ul>

<h2>FUNCIONALIDADES</h2>

- [x] Permitir o cadastro de novos almoxarifes.
- [x] Permitir a realização de login.
- [x] Permitir o cadastro de novos epis.
- [x] Incrementar o número de epis no estoque.
- [x] Registrar a entrega de epis para colaboradoes.
- [x] Consultar a lista de epis em estoque.
- [x] Consultar a lista de epis que foram entregues.
- [x] Registrar a devolução de epis.
- [x] Consultar o histórico de devoluções.
- [x] Permitir a criação de alertas. 

# Guia de Implementação do Aplicativo

Este guia descreve os passos necessários para configurar e rodar o aplicativo.

## Requisitos

Antes de iniciar a instalação, verifique se você possui os seguintes requisitos instalados em seu sistema:

- [Git](https://git-scm.com/) instalado
- [XAMPP](https://www.apachefriends.org/index.html) instalado no seu sistema

## 1. Clonar o Repositório
Clone o repositório contendo o código-fonte do aplicativo:

```git clone https://github.com/jp8002/PI_FATEC_2024_2-Semestre.git```

## 2. Renomear e Mover Diretórios
Acesse o diretório clonado e renomeie a pasta src para PI2V2, movendo-a para o diretório htdoocs do XAMPP:
```
cd ./PI_FATEC_2024_2-Semestre
ren src PI2V2
move PI2V2 C:\xampp\htdocs
move .htaccess C:\xampp\htdocs
```
## 3. Iniciar o XAMPP
Inicie o XAMPP para rodar o servidor Apache e MySQL:

````\xampp\xampp_start.exe````

## 4. Importar o Script SQL no MySQL
Agora, importe o arquivo SQL 'almoxarifado' presente na pasta sql, do projeto, para criar o banco de dados

## 5. Acessar o Aplicativo no Navegador
Por fim, abra o navegador e acesse o aplicativo digitando localhost na barra de pesquisa

<h2>TELAS</h2>

<label>Interface da página para realizar o Login</label>
<img src="./imagens/Tela1.png" alt="error"/>

<label>Interface da página de “Menu” do Usuário “adm” (um usuário do tipo supervisor)</label>
<img src="./imagens/Tela2.png" alt="error"/>

<label>Interface da página "Histórico de Devoluções"</label>
<img src="./imagens/Tela3.png" alt="error"/>

<label>Interface da página "Histórico de Saídas"</label>
<img src="./imagens/Tela4.png" alt="error"/>

<label>Interface da página "Ver Estoque"</label>
<img src="./imagens/Tela5.png" alt="error"/>

<label>Interface da página "Cadastrar Almoxarife"</label>
<img src="./imagens/Tela6.png" alt="error"/>

<label>Interface da página "Cadastrar Fornecedor"</label>
<img src="./imagens/Tela7.png" alt="error"/>

<label>Interface da página "Cadastrar Funcionário"</label>
<img src="./imagens/Tela8.png" alt="error"/>

<label>Interface da página "Registrar Compra"</label>
<img src="./imagens/Tela9.png" alt="error"/>

<label>Interface da página "Checar Alertas"</label>
<img src="./imagens/Tela10.png" alt="error"/>

<label>Interface da página "Menu" do usuário "almoxarife" (um usuário do tipo normal)</label>
<img src="./imagens/Tela11.png" alt="error"/>

<label>Interface da página "Registrar Devolução"</label>
<img src="./imagens/Tela12.png" alt="error"/>

<label>Interface da página "Registrar Saída"</label>
<img src="./imagens/Tela13.png" alt="error"/>

<label>Interface da página "Adicionar EPI"</label>
<img src="./imagens/Tela14.png" alt="error"/>

<label>Interface da página "Remover EPI"</label>
<img src="./imagens/Tela15.png" alt="error"/>

<label>Interface da página "Enviar Alerta"</label>
<img src="./imagens/Tela16.png" alt="error"/>
