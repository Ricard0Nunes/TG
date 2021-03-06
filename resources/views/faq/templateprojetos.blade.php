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
                  <a class="nav-link" href="/faq">In??cio
                  </a>
               </li>
               @if(Auth::user()->fk_nivelAcesso ==1)
               <li class="nav-item">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqGestao">Gest??o</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqOrcamentos">Or??amentos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqRH">RH</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqRequisicoes">Requisi????es</a>
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
                  <a class="nav-link" href="/faqRequisicoes">Requisi????es</a>
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
                  <a class="nav-link" href="/faqRequisicoes">Requisi????es</a>
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
               <h5 class="card-title">Ver os v??rios projetos na empresa</h5>
               <p class="card-text">Para ver os v??rios projetos da empresa, no menu selecione "Projetos" -> "Gerir Projetos" -> "Ver Projetos".</p>
               <p class="card-text">Ser?? apresentado uma p??gina com os v??rios projetos da empresa, com algumas informa????es, como a "??rea" onde se enquadra o projeto, qual o "Cliente" que solicitou o projeto, o "Respons??vel", o "Prazo", entre outros.</p>
               <p class="card-text">Se pretender ver o projeto mais pormenorizado, clique no bot??o que cont??m um "olho", que se encontra do lado direito, em frente a cada do projeto.</p>
               <h5 class="card-title">Criar um novo projeto.</h5>
               <p class="card-text">Se pretender criar um projeto novo, basta escolher no menu "Projetos" -> "Gerir Projetos" -> "Criar Projeto"</p>
               <p class="card-text">Vai ser mostrado um formul??rio, com os devidos campos para preencher, para ser criado um novo projeto</p>
               <p class="card-text">Depois de preencher todos os campos obrigat??rios, basta clicar no bot??o "Adicionar Projeto", que se enocntra no final do formul??rio.</p>
               <h5 class="card-title">Ver ??reas de projetos dispon??veis na empresa.</h5>
               <p class="card-text">Para ver as ??reas que existem na empresa para efetuar os projetos, aceda no menu a "Projetos" -> "Gerir Projetos" -> "Configura????es" -> "??reas Projetos"</p>
               <p class="card-text">Ser?? disponibilizado uma p??gina com todas as ??reas existentes.</p>
               <h5 class="card-title">Editar uma ??rea de projeto dispon??vel na empresa.</h5>
               <p class="card-text">Na p??gina onde ?? mostrada todas as ??reas de projetos da empresa (referido no ponto anterior como se acede a esta p??gina) do lado direito, em frente ao nome de cada ??rea, encontra-se um bot??o com uma cor alaranjada, que cont??m um l??pis, ao clicar nele, ir?? abrir um formul??rio para editar a ??rea que escolheu.</p>
               <p class="card-text">Ser?? mostrado um pequeno formul??rio onde pode editar o nome da ??rea.</p>
               <h5 class="card-title">Criar uma nova ??rea de projeto na empresa.</h5>
               <p class="card-text">Para aceder ?? p??gina "Criar ??rea", aceda ao menu explicado no ponto "Ver ??reas de projetos dispon??veis na empresa".</p>
               <p class="card-text">No final do formul??rio clique em "Criar ??rea". De seguida d?? um nome a nova ??rea e clique em "Enviar". Ser?? criada ent??o uma nova ??rea.</p>
               <h5 class="card-title">Que urg??ncias em rela????o as realiza????es dos projetos existem?</h5>
               <p class="card-text">No menu, aceda a "Projetos" -> "Gerir Projetos" -> "Configura????es" -> "Urg??ncias de Projetos".</p>
               <p class="card-text">Ser??o mostrados os v??rios tipos de urg??ncias de projetos que se pode associar a cada um.</p>
               <h5 class="card-title">Editar um tipo de urg??ncia de projeto na empresa.</h5>
               <p class="card-text">Na p??gina onde ?? mostrada todos os tipos de urg??ncias de projetos(referido no ponto anterior como se acede a esta p??gina) do lado direito, em frente ao nome de cada urg??ncia, encontra-se um bot??o com uma cor alaranjada, que cont??m um l??pis, ao clicar nele, ir?? abrir um formul??rio para editar a urg??ncia que escolheu.</p>
               <p class="card-text">Ser?? mostrado um pequeno formul??rio onde pode editar o nome da urg??ncia.</p>
               <h5 class="card-title">Criar um novo tipo de urg??ncia de projeto.</h5>
               <p class="card-text">Para aceder ?? p??gina "Criar Urg??ncia", aceda ao menu explicado no ponto "Que urg??ncias em rela????o as realiza????es dos projetos existem?".</p>
               <p class="card-text">No final do formul??rio clique em "Criar Urg??ncia". De seguida d?? um nome a nova urg??ncia e clique em "Enviar". Ser?? criada ent??o um novo tipo de urg??ncia.</p>
               <h5 class="card-title">Ver projetos organizados por departamentos.</h5>
               <p class="card-text">Aceda no menu a "Projetos", e depois a "Proj. por Departamento".</p>
               <p class="card-text">Ser??o apresentados os projetos da empresa, organizado por Departamentos.</p>
          
          
               <h5 class="card-title">Ver etapas.</h5>
               <p class="card-text">Para ver as v??rias etapas da empresa, clique em "Projetos" -> "Etapas" -> "Ver Etapas".</p>
               <p class="card-text">?? apresentada uma tabela com as v??rias etapas criadas na empresa, onde ?? poss??vel algumas estat??sticas de cada uma.</p>

               <h5 class="card-title">Criar etapas.</h5>
               <p class="card-text">Aceda ao menu "Projetos" -> "Etapas" -> "Criar Etapas".</p>
               <p class="card-text">Depois, do lado  direito, em frente a cada projeto, aparece um bot??o azul que cont??m uma "ampulheta". Clique nele.</p>
               <p class="card-text">Ao clicar nele, ser?? apresentado um formul??rio. Depois de preencher os v??rios campos, clique em "Adicionar Urg??ncia".</p>

               <h5 class="card-title">Ver as v??rias interven????es da empresa.</h5>
               <p class="card-text">?? poss??vel ver as v??rias interven????es realizadas na empresa, ao aceder no menu a "Projetos", de seguida "Interven????es" e por ??ltimo "Ver Interven????es".</p>
               <p class="card-text">Ao clicar neste menu, ?? poss??vel visualizar as v??rias interven????es que foram realizadas na empresa, como tamb??m algumas informa????es acerca delas, como por exemplo, o nome do projeto em que essa interven????o foi feita, como tamb??m, o nome da interven????o, o respons??vel, o cliente, o estado, etc.</p>
               <p class="card-text">Se quiser ver a tarefa mais detalhadamente, do lado direito, em frente a cada tarefa encontra-se um bot??o que cont??m um "olho", ao clicar nele pode ver mais informa????es acerca da tarefa.</p>
               <h5 class="card-title">Criar uma interven????o.</h5>
               <p class="card-text">?? poss??vel criar uma nova interven????o, para isso basta aceder ao menu explicado no ponto anterior (Ver as v??rias interven????es da empresa).</p>
               <p class="card-text">No final desta p??gina encontra-se um bot??o "Criar Interven????o".</p>
               <p class="card-text">Depois de clicar nele, ir?? abrir um formul??rio, com alguns campos para preencher, de modo a criar uma nova interven????o. Depois de preencher todos os campos, clique em "Adicionar Tarefa". Deste modo ser?? criada uma nova interven????o na empresa.</p>

               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necess??rio</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>