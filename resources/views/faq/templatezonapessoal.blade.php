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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqGestao">Gest??o</a>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
                  <span class="sr-only">(current)</span>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Enviar ou ver mensagens.</h5>
               <p class="card-text">No menu que se encontra do lado esqurdo, clique em "Mensagens".</p>
               <p class="card-text">De seguida, para enviar uma mensagem a um colaborador da empresa, clique em "Utilizadores". Escolha o colaborador que pretende conversar, ap??s clicar nesse utilizador, ir?? abrir um chat.</p>
               <p class="card-text">Pode come??ar a conversar.</p>
        
        
               <h5 class="card-title">Criar not??cias</h5>
               <p class="card-text">Se precisar de informar todos os colaboradores de algo, pode criar uma not??cia.</p>
               <p class="card-text">Para isso, aceda no menu a "Zona Pessoal" e de seguida a "Not??cias". Ser?? mostrada uma p??gina com as not??cias criadas anteriormente.</p>
               <p class="card-text">Para criar uma nova clique no bot??o "Criar Not??cia", que se encontra por da informa????o das not??cias criadas.</p>
               <p class="card-text">Ser?? aberto um formul??rio, com os respetivos campos a preencher, como a descri????o da not??cia, e a data em que a not??cia ser?? mostrada.</p>


               
               <h5 class="card-title">Correspond??ncia.</h5>
               <p class="card-text">Se pretender enviar uma correspond??ncia a algu??m escolha no menu "Zona Pessoal", e depois "Correspond??ncia".</p>
               <p class="card-text">Ser?? mostrada uma p??gina com todas as suas correspond??ncias, onde pode ver se algu??m lhe mandou algo.</p>
               <p class="card-text">Para enviar uma, clique no bot??o "Registar Correspond??ncias". Preencha os campos que s??o obrigat??rios, como selecionando o destinat??rio da correspond??ncia, qual o assunto, etre outros. Quando preencher tudo, clique em "Enviar", e a sua correspond??ncia ser?? enviada para o destinat??rio que escolheu. </p>
               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necess??rio</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>