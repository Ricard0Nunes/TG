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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
                  <span class="sr-only">(current)</span>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
                  <span class="sr-only">(current)</span>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqClientes">Clientes</a>
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Ver clientes da empresa.</h5>
               <p class="card-text">Para ver os clientes da empresa, ?? necess??rio aceder no menu do lado esquerdo a "Clientes", e de seguida em "Ver Clientes".</p>
               <p class="card-text">Ir?? ser mostrado uma p??gina com os clientes da empresa, com algumas informa????es.</p>
               <h5 class="card-title">Criar um novo cliente.</h5>
               <p class="card-text">Para criar um novo cliente, no menu do lado esquerdo, clique em "Clientes", de seguida em "Criar Cliente".</p>
               <p class="card-text">Ser?? mostrado um formul??rio com v??rios campos para preencher, de forma a criar um novo cliente..</p>
               <p class="card-text">Tenha em aten????o que os campos com (*) s??o obrigat??rios.</p>
               <h5 class="card-title">O cliente quer ocultar os seus dados.</h5>
               <p class="card-text">Se o cliente solicitar a oculta????o dos seus dados, no menu, escolha "Clientes", e depois "RGPD".</p>
               <p class="card-text">Depois de escolhida essa op????o, ir?? aparecer os v??rios clientes da empresa, e ?? frente do nome de cada empresa, encontram-se dois bot??es. Um para ver as informa????es do cliente, que ?? o bot??o que cont??m um "olho", e depois tem outro bot??o que diz "RGPD".</p>
               <p class="card-text">Ao selecionar este ??ltimo bot??o, ir?? esconder os informa????es de um cliente. Depois se reparar, as informa????es do cliente s??o substitu??das por "*".</p>
               <p class="card-text">Se desejar recuar com a oculta????o dos dados, agora no lugar do bot??o "RGPD", encontra-se um bot??o a vermelho com o mesmo conte??do, "RGPD", ao escolher este bot??o agora, ir?? mostrar de novo as informa????es do cliente.</p>

               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necess??rio</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>