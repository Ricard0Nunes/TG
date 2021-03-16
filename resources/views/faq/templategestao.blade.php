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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqGestao">Gestão</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
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
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
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
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
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
               <h5 class="card-title">Ver informações sobre a empresa.</h5>
               <p class="card-text">Para ver algumas informações sobre a empresa, aceda no menu do lado esquerdo a "Gestão", depois "Empresa" e de seguida em "Ver empresa".</p>
               <p class="card-text">Irá abrir uma página com alguma informação da empresa, como o email, contacto, horário, etc.</p>
               <h5 class="card-title">Ver cargos na empresa.</h5>
               <p class="card-text">Aceda a "Gestão", depois "Empresa", de seguida a "Cargos" e por último "Ver Cargos".</p>
               <p class="card-text">Será aberta uma página com todos os cargos existentes na empresa.</p>
               <h5 class="card-title">Criar um novo cargo na empresa.</h5>
               <p class="card-text">Aceda a "Gestão", depois "Empresa", de seguida a "Cargos" e por último "Criar Cargo".</p>
               <p class="card-text">Depois disso, basta inserir o nome do cargo a criar e clicar em "Enviar".</p>
               <h5 class="card-title">Ver os departamentos existentes na empresa.</h5>
               <p class="card-text">Aceda a "Gestão", depois "Empresa", de seguida a "Departamentos" e por último "Ver Departamentos".</p>
               <p class="card-text">De seguida irá abrir uma página com os vários departamentos da empresa, podendo ver quais são os colaboradores por cada departamento, clicando no botão azul, que se encontra do lado direito, à frente de cada departamento.</p>
               <p class="card-text">Também pode editar um departamento, clicando no botão laranja, que se encontra ao lado do botão azul, abrindo uma página, onde vai inserir o nome do departamento, como também a sua abreviatura. Depois de preenchido os campos, clica-se no botão "Enviar".</p>
               <h5 class="card-title">Criar um novo departamento na empresa.</h5>
               <p class="card-text">Para criar um novo departamento, basta seguir o mesmo caminho para ver os departamentos, mas em vez de clicar "Ver Departamentos", clicar em "Criar Departamento".</p>
               <p class="card-text">Onde irá abrir uma página, com dois campos, a "Descrição", onde se insere o nome do departamento, e o campo "Abreviatura", onde se insere as inicias do novo departamento. Depois de preenchido os campos, clica-se no botão "Enviar".</p>
               <p class="card-text">Outro caminho para criar um novo departamento, é na pagina "Ver Departamentos". Nessa página, encontra-se em baixo dos departamentos todos, um botão "Criar Departamento", ao clicar nele, abre a página para criar um novo departamento, e é so seguir os mesmo passos.</p>
               <h5 class="card-title">Ver colaboradores da empresa.</h5>
               <p class="card-text">No menu que se encontra do lado esquerdo, clique em "Gestão", depois "Colaboradores", de seguida em "Gerir Colaboradores", e por último em "Ver Colaboradores", depois é possível consultar alguns contactos dos colaboradores da empresa.</p> 
               <h5 class="card-title">Criar um novo colaborador da empresa.</h5>
               <p class="card-text">Para criar um novo colaborador, siga os mesmos passos do "Ver colaboradores da empresa", mas quando carregar em "Gerir Colaboradores", em vez de carregar "Ver Colaboradores", clique em "Criar Colaborador".</p>
               <p class="card-text">De seguida irá surgir um formulário, com vários campos, onde tem de preenchê-los corretamente.</p>
               <p class="card-text">Tenha em atenção que os campos que contenham o símbolo "(*)" à frente, são campos onde tem de preenchê-los obrigatoriamente.</p>
               <h5 class="card-title">Ver horários dos colaboradores.</h5>
               <p class="card-text">Para ver os horários dos vários colaboradores, aceda no menu do lado esquerdo a "Gestão" -> "Colaboradores" -> "Horários" -> "Ver Horários", e será apresentado os horários de cada colaborador da empresa. .</p>
               <h5 class="card-title">Criar um novo horário.</h5>
               <p class="card-text">Para criar um novo horário aceda a "Gestão" -> "Colaboradores" -> "Horários" -> "Criar Horários".</p>
               <p class="card-text">De seguida será aberto uma página, onde contém os vários campos para criar um novo horário.</p>






{{-- 
               <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necessário</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>