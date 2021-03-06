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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqGestao">Gest??o</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
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
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
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
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
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
               <h5 class="card-title">Ver informa????es sobre a empresa.</h5>
               <p class="card-text">Para ver algumas informa????es sobre a empresa, aceda no menu do lado esquerdo a "Gest??o", depois "Empresa" e de seguida em "Ver empresa".</p>
               <p class="card-text">Ir?? abrir uma p??gina com alguma informa????o da empresa, como o email, contacto, hor??rio, etc.</p>
               <h5 class="card-title">Ver cargos na empresa.</h5>
               <p class="card-text">Aceda a "Gest??o", depois "Empresa", de seguida a "Cargos" e por ??ltimo "Ver Cargos".</p>
               <p class="card-text">Ser?? aberta uma p??gina com todos os cargos existentes na empresa.</p>
               <h5 class="card-title">Criar um novo cargo na empresa.</h5>
               <p class="card-text">Aceda a "Gest??o", depois "Empresa", de seguida a "Cargos" e por ??ltimo "Criar Cargo".</p>
               <p class="card-text">Depois disso, basta inserir o nome do cargo a criar e clicar em "Enviar".</p>
               <h5 class="card-title">Ver os departamentos existentes na empresa.</h5>
               <p class="card-text">Aceda a "Gest??o", depois "Empresa", de seguida a "Departamentos" e por ??ltimo "Ver Departamentos".</p>
               <p class="card-text">De seguida ir?? abrir uma p??gina com os v??rios departamentos da empresa, podendo ver quais s??o os colaboradores por cada departamento, clicando no bot??o azul, que se encontra do lado direito, ?? frente de cada departamento.</p>
               <p class="card-text">Tamb??m pode editar um departamento, clicando no bot??o laranja, que se encontra ao lado do bot??o azul, abrindo uma p??gina, onde vai inserir o nome do departamento, como tamb??m a sua abreviatura. Depois de preenchido os campos, clica-se no bot??o "Enviar".</p>
               <h5 class="card-title">Criar um novo departamento na empresa.</h5>
               <p class="card-text">Para criar um novo departamento, basta seguir o mesmo caminho para ver os departamentos, mas em vez de clicar "Ver Departamentos", clicar em "Criar Departamento".</p>
               <p class="card-text">Onde ir?? abrir uma p??gina, com dois campos, a "Descri????o", onde se insere o nome do departamento, e o campo "Abreviatura", onde se insere as inicias do novo departamento. Depois de preenchido os campos, clica-se no bot??o "Enviar".</p>
               <p class="card-text">Outro caminho para criar um novo departamento, ?? na pagina "Ver Departamentos". Nessa p??gina, encontra-se em baixo dos departamentos todos, um bot??o "Criar Departamento", ao clicar nele, abre a p??gina para criar um novo departamento, e ?? so seguir os mesmo passos.</p>
               <h5 class="card-title">Ver colaboradores da empresa.</h5>
               <p class="card-text">No menu que se encontra do lado esquerdo, clique em "Gest??o", depois "Colaboradores", de seguida em "Gerir Colaboradores", e por ??ltimo em "Ver Colaboradores", depois ?? poss??vel consultar alguns contactos dos colaboradores da empresa.</p> 
               <h5 class="card-title">Criar um novo colaborador da empresa.</h5>
               <p class="card-text">Para criar um novo colaborador, siga os mesmos passos do "Ver colaboradores da empresa", mas quando carregar em "Gerir Colaboradores", em vez de carregar "Ver Colaboradores", clique em "Criar Colaborador".</p>
               <p class="card-text">De seguida ir?? surgir um formul??rio, com v??rios campos, onde tem de preench??-los corretamente.</p>
               <p class="card-text">Tenha em aten????o que os campos que contenham o s??mbolo "(*)" ?? frente, s??o campos onde tem de preench??-los obrigatoriamente.</p>
               <h5 class="card-title">Ver hor??rios dos colaboradores.</h5>
               <p class="card-text">Para ver os hor??rios dos v??rios colaboradores, aceda no menu do lado esquerdo a "Gest??o" -> "Colaboradores" -> "Hor??rios" -> "Ver Hor??rios", e ser?? apresentado os hor??rios de cada colaborador da empresa. .</p>
               <h5 class="card-title">Criar um novo hor??rio.</h5>
               <p class="card-text">Para criar um novo hor??rio aceda a "Gest??o" -> "Colaboradores" -> "Hor??rios" -> "Criar Hor??rios".</p>
               <p class="card-text">De seguida ser?? aberto uma p??gina, onde cont??m os v??rios campos para criar um novo hor??rio.</p>






{{-- 
               <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necess??rio</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>