<!DOCTYPE html>
<html lang="PT-pt">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Turtlegest-FAQ</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
      <!-- Google Fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      <!-- Bootstrap core CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/css/mdb.min.css" rel="stylesheet">
      <!-- JQuery -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/js/mdb.min.js"></script>
   </head>
   <body>
      <!--Navbar -->
      <nav class="mb-1 navbar navbar-expand-lg navbar-dark green lighten-1">
         <a class="navbar-brand" href="#"><strong>Turtle</strong>Gest</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
            aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item">
                  <a class="nav-link" href="/faq">Início
                  </a>
               </li>
               @if(Auth::user()->fk_nivelAcesso ==1)
               <li class="nav-item">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqGestao">Gestão</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqOrcamentos">Orçamentos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqRH">RH</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqRequisicoes">Requisições</a>
               </li>
               @endif
               @if(Auth::user()->fk_nivelAcesso ==2)
               <li class="nav-item">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqRH">RH</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqRequisicoes">Requisições</a>
               </li>
               @endif
               @if(Auth::user()->fk_nivelAcesso >=3)
               <li class="nav-item">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqRequisicoes">Requisições</a>
               </li>
               @endif
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
               <li class="nav-item avatar">
                  <a class="nav-link p-0" href="/registo">
                  Voltar
                  </a>
               </li>
            </ul>
         </div>
      </nav>
      <!--/.Navbar -->
      <br>
      <div class="container">
         <div class="card">
            <div class="card-body">
               <h5 class="card-title">Ver os vários projetos na empresa</h5>
               <p class="card-text">Para ver os vários projetos da empresa, no menu selecione "Projetos" -> "Gerir Projetos" -> "Ver Projetos".</p>
               <p class="card-text">Será apresentado uma página com os vários projetos da empresa, com algumas informações, como a "Área" onde se enquadra o projeto, qual o "Cliente" que solicitou o projeto, o "Responsável", o "Prazo", entre outros.</p>
               <p class="card-text">Se pretender ver o projeto mais pormenorizado, clique no botão que contém um "olho", que se encontra do lado direito, em frente a cada do projeto.</p>
               <h5 class="card-title">Criar um novo projeto.</h5>
               <p class="card-text">Se pretender criar um projeto novo, basta escolher no menu "Projetos" -> "Gerir Projetos" -> "Criar Projeto"</p>
               <p class="card-text">Vai ser mostrado um formulário, com os devidos campos para preencher, para ser criado um novo projeto</p>
               <p class="card-text">Depois de preencher todos os campos obrigatórios, basta clicar no botão "Adicionar Projeto", que se enocntra no final do formulário.</p>
               <h5 class="card-title">Ver áreas de projetos disponíveis na empresa.</h5>
               <p class="card-text">Para ver as áreas que existem na empresa para efetuar os projetos, aceda no menu a "Projetos" -> "Gerir Projetos" -> "Configurações" -> "Áreas Projetos"</p>
               <p class="card-text">Será disponibilizado uma página com todas as áreas existentes.</p>
               <h5 class="card-title">Editar uma área de projeto disponível na empresa.</h5>
               <p class="card-text">Na página onde é mostrada todas as áreas de projetos da empresa (referido no ponto anterior como se acede a esta página) do lado direito, em frente ao nome de cada área, encontra-se um botão com uma cor alaranjada, que contém um lápis, ao clicar nele, irá abrir um formulário para editar a área que escolheu.</p>
               <p class="card-text">Será mostrado um pequeno formulário onde pode editar o nome da área.</p>
               <h5 class="card-title">Criar uma nova área de projeto na empresa.</h5>
               <p class="card-text">Para aceder à página "Criar Área", aceda ao menu explicado no ponto "Ver áreas de projetos disponíveis na empresa".</p>
               <p class="card-text">No final do formulário clique em "Criar Área". De seguida dê um nome a nova área e clique em "Enviar". Será criada então uma nova área.</p>
               <h5 class="card-title">Que urgências em relação as realizações dos projetos existem?</h5>
               <p class="card-text">No menu, aceda a "Projetos" -> "Gerir Projetos" -> "Configurações" -> "Urgências de Projetos".</p>
               <p class="card-text">Serão mostrados os vários tipos de urgências de projetos que se pode associar a cada um.</p>
               <h5 class="card-title">Editar um tipo de urgência de projeto na empresa.</h5>
               <p class="card-text">Na página onde é mostrada todos os tipos de urgências de projetos(referido no ponto anterior como se acede a esta página) do lado direito, em frente ao nome de cada urgência, encontra-se um botão com uma cor alaranjada, que contém um lápis, ao clicar nele, irá abrir um formulário para editar a urgência que escolheu.</p>
               <p class="card-text">Será mostrado um pequeno formulário onde pode editar o nome da urgência.</p>
               <h5 class="card-title">Criar um novo tipo de urgência de projeto.</h5>
               <p class="card-text">Para aceder à página "Criar Urgência", aceda ao menu explicado no ponto "Que urgências em relação as realizações dos projetos existem?".</p>
               <p class="card-text">No final do formulário clique em "Criar Urgência". De seguida dê um nome a nova urgência e clique em "Enviar". Será criada então um novo tipo de urgência.</p>
               <h5 class="card-title">Ver projetos organizados por departamentos.</h5>
               <p class="card-text">Aceda no menu a "Projetos", e depois a "Proj. por Departamento".</p>
               <p class="card-text">Serão apresentados os projetos da empresa, organizado por Departamentos.</p>
          
          
               <h5 class="card-title">Ver etapas.</h5>
               <p class="card-text">Para ver as várias etapas da empresa, clique em "Projetos" -> "Etapas" -> "Ver Etapas".</p>
               <p class="card-text">É apresentada uma tabela com as várias etapas criadas na empresa, onde é possível algumas estatísticas de cada uma.</p>

               <h5 class="card-title">Criar etapas.</h5>
               <p class="card-text">Aceda ao menu "Projetos" -> "Etapas" -> "Criar Etapas".</p>
               <p class="card-text">Depois, do lado  direito, em frente a cada projeto, aparece um botão azul que contém uma "ampulheta". Clique nele.</p>
               <p class="card-text">Ao clicar nele, será apresentado um formulário. Depois de preencher os vários campos, clique em "Adicionar Urgência".</p>

               <h5 class="card-title">Ver as várias intervenções da empresa.</h5>
               <p class="card-text">É possível ver as várias intervenções realizadas na empresa, ao aceder no menu a "Projetos", de seguida "Intervenções" e por último "Ver Intervenções".</p>
               <p class="card-text">Ao clicar neste menu, é possível visualizar as várias intervenções que foram realizadas na empresa, como também algumas informações acerca delas, como por exemplo, o nome do projeto em que essa intervenção foi feita, como também, o nome da intervenção, o responsável, o cliente, o estado, etc.</p>
               <p class="card-text">Se quiser ver a tarefa mais detalhadamente, do lado direito, em frente a cada tarefa encontra-se um botão que contém um "olho", ao clicar nele pode ver mais informações acerca da tarefa.</p>
               <h5 class="card-title">Criar uma intervenção.</h5>
               <p class="card-text">É possível criar uma nova intervenção, para isso basta aceder ao menu explicado no ponto anterior (Ver as várias intervenções da empresa).</p>
               <p class="card-text">No final desta página encontra-se um botão "Criar Intervenção".</p>
               <p class="card-text">Depois de clicar nele, irá abrir um formulário, com alguns campos para preencher, de modo a criar uma nova intervenção. Depois de preencher todos os campos, clique em "Adicionar Tarefa". Deste modo será criada uma nova intervenção na empresa.</p>

               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necessário</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>