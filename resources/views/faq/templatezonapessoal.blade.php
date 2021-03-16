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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqZonaPessoal">Zona Pessoal</a>
                  <span class="sr-only">(current)</span>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqGestao">Gestão</a>
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
                  <a class="nav-link" href="/faqRequisicoes">Requisições</a>
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
               <h5 class="card-title">Enviar ou ver mensagens.</h5>
               <p class="card-text">No menu que se encontra do lado esqurdo, clique em "Mensagens".</p>
               <p class="card-text">De seguida, para enviar uma mensagem a um colaborador da empresa, clique em "Utilizadores". Escolha o colaborador que pretende conversar, após clicar nesse utilizador, irá abrir um chat.</p>
               <p class="card-text">Pode começar a conversar.</p>
        
        
               <h5 class="card-title">Criar notícias</h5>
               <p class="card-text">Se precisar de informar todos os colaboradores de algo, pode criar uma notícia.</p>
               <p class="card-text">Para isso, aceda no menu a "Zona Pessoal" e de seguida a "Notícias". Será mostrada uma página com as notícias criadas anteriormente.</p>
               <p class="card-text">Para criar uma nova clique no botão "Criar Notícia", que se encontra por da informação das notícias criadas.</p>
               <p class="card-text">Será aberto um formulário, com os respetivos campos a preencher, como a descrição da notícia, e a data em que a notícia será mostrada.</p>


               
               <h5 class="card-title">Correspondência.</h5>
               <p class="card-text">Se pretender enviar uma correspondência a alguém escolha no menu "Zona Pessoal", e depois "Correspondência".</p>
               <p class="card-text">Será mostrada uma página com todas as suas correspondências, onde pode ver se alguém lhe mandou algo.</p>
               <p class="card-text">Para enviar uma, clique no botão "Registar Correspondências". Preencha os campos que são obrigatórios, como selecionando o destinatário da correspondência, qual o assunto, etre outros. Quando preencher tudo, clique em "Enviar", e a sua correspondência será enviada para o destinatário que escolheu. </p>
               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necessário</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>