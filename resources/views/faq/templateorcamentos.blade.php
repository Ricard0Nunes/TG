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
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqOrcamentos">Orçamentos</a>
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Ver Orçamentos</h5>
               <p class="card-text">Se pretender ver os orçamentos criados, basta aceder a "Orçamentos", e por último "Ver Orçamentos".</p>
               <p class="card-text">Será mostrada uma página com todos os orçamentos criados, podendo ver algumas informações de cada um..</p>

               <h5 class="card-title">Criar Orçamentos</h5>
               <p class="card-text">Se deseja criar um novo orçamento, no menu escolha "Orçamentos", e depois a opção "Criar Orçamento".</p>
               <p class="card-text">Será exibido um formulário com alguns campos que são necessários preencher para criar um orçamento. Depois de preencher corretamente todos os campos obrigatórios, será criado então um novo orçamento.</p>


               <h5 class="card-title">Editar Orçamentos</h5>
               <p class="card-text">Se pretender editar um orçamento que já foi criado, vá a "Orçamentos", e depois "Editar Orçamentos".</p>
               <p class="card-text">Será mostrada uma tabela com os orçamentos, depois disso do lado direito existe um botão alaranjado, clique nele.</p>
               <p class="card-text">Depois será mostrado o orçamento que pretendeu editar, preencha os campos que pretende editar e clique em "Enviar". O orçamento será editado autmaticamente.</p>
               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necessário</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>