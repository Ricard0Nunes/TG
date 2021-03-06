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
               <li class="nav-item active">
                  <a class="nav-link" href="/faq">In??cio
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Como fazer login na aplica????o?</h5>
               <p class="card-text">Depois de iniciar a aplica????o, ?? nos mostrado uma p??gina de login, onde ?? pedido o email e password.</p>
               <p class="card-text">Para aceder a aplica????o ?? necess??rio inserir o seu email da empresa, seguido da password e clicar no bot??o entrar.</p>
               <h5 class="card-title">O que fazer caso me esque??a da password?</h5>
               <p class="card-text">Caso se esque??a da sua password, deve clicar em "Recuperar a password".</p>
               <p class="card-text">Depois ser?? necess??rio inserir o seu email da empresa, e clicar no bot??o "Enviar link de recupera????o de password". Ser?? enviado um email, com as indica????es do que tem de fazer para recuperar a sua password.</p>
               <p class="card-text">Depois disso, s?? necessita de fazer o login normalmente.</p>
               <h5 class="card-title">Como sair/fazer logout da aplica????o?</h5>
               <p class="card-text">Para sair da aplica????o, basta fechar a aplica????o na cruz do canto superior direito, ou ent??o, na p??gina principal, clicar no seu nome, que se encontra tamb??m no canto superior direito, ser?? lhe mostrado um bot??o "Sair", clicando nele, terminar?? sess??o.</p>
               <h5 class="card-title">Cheguei a empresa, e preciso de picar o ponto, como fa??o?</h5>
               <p class="card-text">Depois de ter efetuado login com sucesso, ser?? redirecionado para a p??gina principal.</p>
               <p class="card-text">Na p??gina principal, encontra-se um bot??o "Entrada", clique nele, a partir desse momento, o seu tempo trabalhado come??a a contar. </p>
               <h5 class="card-title">Chegou a hora de almo??o, preciso de picar sa??da?</h5>
               <p class="card-text">N??o necessariamente, apenas precisa de meter uma pausa no tempo trabalhado. Para isso, no lugar do bot??o "Entrada", encontra-se agora o bot??o "Iniciar almo??o".</p>
               <p class="card-text">Ap??s clicar nele o tempo trabalhado que estava a contar fica em pausa e come??a a contar o tempo de hora de almo??o e j?? pode ir almo??ar, gira bem o seu tempo, n??o se esque??a que tem uma hora de almo??o. </p>
               <h5 class="card-title">Acabei a minha hora de almo??o, como fa??o para continuar o meu dia de trabalho?</h5>
               <p class="card-text">Depois de fazer a sua hora de almo??o, no bot??o onde carregou "Entrada" e "Iniciar Almo??o", agora aparece "Acabar almo??o".</p>
               <p class="card-text">Ao clicar nesse bot??o, o tempo trabalhado continua a contar, e poder continuar o seu dia de trabalho.</p>
               <h5 class="card-title">Conclu?? o meu dia de trabalho, como pico a minha sa??da?</h5>
               <p class="card-text">Quando concluir o seu dia de trabalho, no mesmo bot??o onde carregou "Entrada", "Iniciar almo??o" e "Acabar almo??o", agora aparece "Sa??da".</p>
               <p class="card-text">Clique nele e est?? conclu??do o seu dia de trabalho, podendo ver as horas que trabalhou e o tempo que levou na hora de almo??o.</p>
               <h5 class="card-title">Cliquei em almo??ar/sa??da sem querer, ou esqueci-me de picar entrada, ou sa??da para o almo??o, ou quando regressei do almo??o.</h5>
               <p class="card-text">N??o tem problema. Ao lado do bot??o "Entrada" ou "Iniciar almo??o", ou "Acabar almo??o", ou "Sa??da", encontra-se outro bot??o, onde cont??m uma estrela. Ao clicar nele aparece v??rias op????es, escolha "Editar Ponto".</p>
               <p class="card-text">Depois ir?? abrir uma p??gina onde pode editar a entrada de manh??, a sa??da de manh??, a entrada de tarde e a sa??da de tarde. Basta meter as horas que entrou ou saiu. Se quiser acrescentar algum coment??rio a essa edi????o, como por exemplo uma justifica????o, basta escrever na caixa onde diz "Coment??rio".</p>
               <p class="card-text">Depois de ter inserido as horas certas e o coment??rio, basta clicar em "Guardar". Para a edi????o ficar conclu??da, o departamento de RH ou TI, tem de autorizar essa edi????o.</p>
               <h5 class="card-title">Ver a minha atividade mensal.</h5>
               <p class="card-text">Pode ver o seu registo mensal, ao clicar no bot??o que cont??m uma estrela, e depois em "Ver registo mensal".</p>
               <p class="card-text">Ir?? abrir uma p??gina, com todo o seu registo de trabalho, onde em cada dia mostra as horas que entrou e saiu de manha, a dura????o da hora de almo??o, e as horas que entrou e saiu ?? tarde, e o total de horas trabalhadas, nesse mesmo dia.</p>   
               <h5 class="card-title">N??o vou estar presente na empresa.</h5>
               <p class="card-text">Se for faltar um dia, ou ent??o vai come??ar as suas f??rias, ou por outro motivo qualquer, ?? preciso avisar a empresa, caso algu??m necessite dos seus servi??os, saber que naquele momento n??o se encontra em fun????es.</p>   
               <p class="card-text">Para isso, no bot??o que cont??m uma estrela, escolha a op????o "Marcar Aus??ncia".</p>   
               <p class="card-text">Ir?? para uma p??gina "Criar uma Aus??ncia", nessa p??gina ter?? de preencher alguns campos. No campo "Colaborador", selecione o seu nome, no campo "Descri????o de Aus??ncia", selecione qual ??, e de seguida escolha o dia de come??o da aus??ncia e o t??rmino dessa mesma aus??ncia. </p> 
               <h5 class="card-title">Agendar tarefas para o meu dia a dia.</h5>
               <p class="card-text">Pode agendar as tarefas que vai realizar ou que j?? realizou. S?? tem de clicar no bot??o que cont??m a estrela, e de seguida em "Criar Tarefa".</p> 
               <p class="card-text">Vai abrir a p??gina "Criar uma Tarefa", com v??rios campos.</p> 
               <p class="card-text">No campo "Cliente", escolha a sua empresa, no "Projeto", escolha o que se adequa a sua tarefa, na "Etapa", escolha o que vai realizar, na "Descri????o", fa??a um pequeno resumo do que vai fazer, e escolha a data de in??cio e hora da tarefa, como tamb??m a data e hora do fim da tarefa. </p> 
               <p class="card-text">Depois tem de selecionar se a tarefa que est?? a criar j?? foi realizada, ou ainda n??o. Se a tarefa j?? tiver sido realizada no campo "A tarefa foi executada?", selecione "Sim", abrir?? uma caixa de texto "Relat??rio", onde tem de escrever o que fez na realiza????o dessa tarefa, e clique em "Adiconar Tarefa", se ainda n??o a executou, selecione a op????o "N??o", e de seguida clique em "Adicinar Tarefa".</p> 
               <h5 class="card-title">Preciso de me ausentar, ou realizar outra tarefa, mas ainda n??o finalizei a tarefa que estou a realizar.</h5>
               <p class="card-text">Se ainda n??o finalizou a tarefa mas precisa de se ausentar, fa??a "Pausa" na tarefa.</p> 
               <p class="card-text">Na p??gina principal, ao lado da tarefa tem v??rios bot??es, para fazer uma pausa clique no bot??o com o simbolo de pausa.</p> 
               <p class="card-text">Ir?? abrir uma p??gina, que lhe pede um pequeno relat??rio da tarefa, e se pretende reagendar tarefa, se selecionarmos a op????o "Sim", ?? lhe pedido que escolha uma hora prevista de in??cio, e clique em "Adicionar Relat??rio", se selcionar "N??o", basta clicar em "Adicionar Relat??rio", e a tarefa fica automaticamente em pausa.</p> 
               <h5 class="card-title">J?? finalizei a minha tarefa.</h5>
               <p class="card-text">Se j?? finalizou a sua tarefa, carregue no bot??o que cont??m um quadrado ao lado da tarefa.</p> 
               <p class="card-text">De seguida ir?? abrir uma p??gina onde lhe pede que fa??a um pequeno relat??rio da tarefa. Indique, se por exemplo conclui tudo o que tinha para fazer, se falta alguns pontos, etc. De seguida clique em "Adicionar Relat??rio".</p> 
               <h5 class="card-title">Veja o seu perfil.</h5>
               <p class="card-text">Para ver o seu perfil, como por exemplo, as horas que j?? trabalhou esta semana, se precisa de compensar horas, dias de f??rias, etc.</p>
               <p class="card-text">Clique no seu nome, que se encontra no canto superior direito, e de seguida em "Perfil".</p>
               <p class="card-text">Ou ent??o, no menu que se encontra do lado esquerdo, clique em "Zona Pessoal", e depois em "Perfil".</p>
               <h5 class="card-title">Consultar calend??rio.</h5>
               <p class="card-text">No menu que se encontra do lado esquerdo, clique em "Calend??rio".</p> 
               <h5 class="card-title">Ver colaboradores da empresa.</h5>
               <p class="card-text">Se quiser ver se algum colaborador se encontra dispon??vel, ou ausente, nesse mesmo menu do lado esquerdo, clique em "Status dos Colaboradores".</p> 

               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necess??rio</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>