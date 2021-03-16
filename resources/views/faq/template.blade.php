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
                  <a class="nav-link" href="/faq">Início
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Como fazer login na aplicação?</h5>
               <p class="card-text">Depois de iniciar a aplicação, é nos mostrado uma página de login, onde é pedido o email e password.</p>
               <p class="card-text">Para aceder a aplicação é necessário inserir o seu email da empresa, seguido da password e clicar no botão entrar.</p>
               <h5 class="card-title">O que fazer caso me esqueça da password?</h5>
               <p class="card-text">Caso se esqueça da sua password, deve clicar em "Recuperar a password".</p>
               <p class="card-text">Depois será necessário inserir o seu email da empresa, e clicar no botão "Enviar link de recuperação de password". Será enviado um email, com as indicações do que tem de fazer para recuperar a sua password.</p>
               <p class="card-text">Depois disso, só necessita de fazer o login normalmente.</p>
               <h5 class="card-title">Como sair/fazer logout da aplicação?</h5>
               <p class="card-text">Para sair da aplicação, basta fechar a aplicação na cruz do canto superior direito, ou então, na página principal, clicar no seu nome, que se encontra também no canto superior direito, será lhe mostrado um botão "Sair", clicando nele, terminará sessão.</p>
               <h5 class="card-title">Cheguei a empresa, e preciso de picar o ponto, como faço?</h5>
               <p class="card-text">Depois de ter efetuado login com sucesso, será redirecionado para a página principal.</p>
               <p class="card-text">Na página principal, encontra-se um botão "Entrada", clique nele, a partir desse momento, o seu tempo trabalhado começa a contar. </p>
               <h5 class="card-title">Chegou a hora de almoço, preciso de picar saída?</h5>
               <p class="card-text">Não necessariamente, apenas precisa de meter uma pausa no tempo trabalhado. Para isso, no lugar do botão "Entrada", encontra-se agora o botão "Iniciar almoço".</p>
               <p class="card-text">Após clicar nele o tempo trabalhado que estava a contar fica em pausa e começa a contar o tempo de hora de almoço e já pode ir almoçar, gira bem o seu tempo, não se esqueça que tem uma hora de almoço. </p>
               <h5 class="card-title">Acabei a minha hora de almoço, como faço para continuar o meu dia de trabalho?</h5>
               <p class="card-text">Depois de fazer a sua hora de almoço, no botão onde carregou "Entrada" e "Iniciar Almoço", agora aparece "Acabar almoço".</p>
               <p class="card-text">Ao clicar nesse botão, o tempo trabalhado continua a contar, e poder continuar o seu dia de trabalho.</p>
               <h5 class="card-title">Concluí o meu dia de trabalho, como pico a minha saída?</h5>
               <p class="card-text">Quando concluir o seu dia de trabalho, no mesmo botão onde carregou "Entrada", "Iniciar almoço" e "Acabar almoço", agora aparece "Saída".</p>
               <p class="card-text">Clique nele e está concluído o seu dia de trabalho, podendo ver as horas que trabalhou e o tempo que levou na hora de almoço.</p>
               <h5 class="card-title">Cliquei em almoçar/saída sem querer, ou esqueci-me de picar entrada, ou saída para o almoço, ou quando regressei do almoço.</h5>
               <p class="card-text">Não tem problema. Ao lado do botão "Entrada" ou "Iniciar almoço", ou "Acabar almoço", ou "Saída", encontra-se outro botão, onde contém uma estrela. Ao clicar nele aparece várias opções, escolha "Editar Ponto".</p>
               <p class="card-text">Depois irá abrir uma página onde pode editar a entrada de manhã, a saída de manhã, a entrada de tarde e a saída de tarde. Basta meter as horas que entrou ou saiu. Se quiser acrescentar algum comentário a essa edição, como por exemplo uma justificação, basta escrever na caixa onde diz "Comentário".</p>
               <p class="card-text">Depois de ter inserido as horas certas e o comentário, basta clicar em "Guardar". Para a edição ficar concluída, o departamento de RH ou TI, tem de autorizar essa edição.</p>
               <h5 class="card-title">Ver a minha atividade mensal.</h5>
               <p class="card-text">Pode ver o seu registo mensal, ao clicar no botão que contém uma estrela, e depois em "Ver registo mensal".</p>
               <p class="card-text">Irá abrir uma página, com todo o seu registo de trabalho, onde em cada dia mostra as horas que entrou e saiu de manha, a duração da hora de almoço, e as horas que entrou e saiu à tarde, e o total de horas trabalhadas, nesse mesmo dia.</p>   
               <h5 class="card-title">Não vou estar presente na empresa.</h5>
               <p class="card-text">Se for faltar um dia, ou então vai começar as suas férias, ou por outro motivo qualquer, é preciso avisar a empresa, caso alguém necessite dos seus serviços, saber que naquele momento não se encontra em funções.</p>   
               <p class="card-text">Para isso, no botão que contém uma estrela, escolha a opção "Marcar Ausência".</p>   
               <p class="card-text">Irá para uma página "Criar uma Ausência", nessa página terá de preencher alguns campos. No campo "Colaborador", selecione o seu nome, no campo "Descrição de Ausência", selecione qual é, e de seguida escolha o dia de começo da ausência e o término dessa mesma ausência. </p> 
               <h5 class="card-title">Agendar tarefas para o meu dia a dia.</h5>
               <p class="card-text">Pode agendar as tarefas que vai realizar ou que já realizou. Só tem de clicar no botão que contém a estrela, e de seguida em "Criar Tarefa".</p> 
               <p class="card-text">Vai abrir a página "Criar uma Tarefa", com vários campos.</p> 
               <p class="card-text">No campo "Cliente", escolha a sua empresa, no "Projeto", escolha o que se adequa a sua tarefa, na "Etapa", escolha o que vai realizar, na "Descrição", faça um pequeno resumo do que vai fazer, e escolha a data de início e hora da tarefa, como também a data e hora do fim da tarefa. </p> 
               <p class="card-text">Depois tem de selecionar se a tarefa que está a criar já foi realizada, ou ainda não. Se a tarefa já tiver sido realizada no campo "A tarefa foi executada?", selecione "Sim", abrirá uma caixa de texto "Relatório", onde tem de escrever o que fez na realização dessa tarefa, e clique em "Adiconar Tarefa", se ainda não a executou, selecione a opção "Não", e de seguida clique em "Adicinar Tarefa".</p> 
               <h5 class="card-title">Preciso de me ausentar, ou realizar outra tarefa, mas ainda não finalizei a tarefa que estou a realizar.</h5>
               <p class="card-text">Se ainda não finalizou a tarefa mas precisa de se ausentar, faça "Pausa" na tarefa.</p> 
               <p class="card-text">Na página principal, ao lado da tarefa tem vários botões, para fazer uma pausa clique no botão com o simbolo de pausa.</p> 
               <p class="card-text">Irá abrir uma página, que lhe pede um pequeno relatório da tarefa, e se pretende reagendar tarefa, se selecionarmos a opção "Sim", é lhe pedido que escolha uma hora prevista de início, e clique em "Adicionar Relatório", se selcionar "Não", basta clicar em "Adicionar Relatório", e a tarefa fica automaticamente em pausa.</p> 
               <h5 class="card-title">Já finalizei a minha tarefa.</h5>
               <p class="card-text">Se já finalizou a sua tarefa, carregue no botão que contém um quadrado ao lado da tarefa.</p> 
               <p class="card-text">De seguida irá abrir uma página onde lhe pede que faça um pequeno relatório da tarefa. Indique, se por exemplo conclui tudo o que tinha para fazer, se falta alguns pontos, etc. De seguida clique em "Adicionar Relatório".</p> 
               <h5 class="card-title">Veja o seu perfil.</h5>
               <p class="card-text">Para ver o seu perfil, como por exemplo, as horas que já trabalhou esta semana, se precisa de compensar horas, dias de férias, etc.</p>
               <p class="card-text">Clique no seu nome, que se encontra no canto superior direito, e de seguida em "Perfil".</p>
               <p class="card-text">Ou então, no menu que se encontra do lado esquerdo, clique em "Zona Pessoal", e depois em "Perfil".</p>
               <h5 class="card-title">Consultar calendário.</h5>
               <p class="card-text">No menu que se encontra do lado esquerdo, clique em "Calendário".</p> 
               <h5 class="card-title">Ver colaboradores da empresa.</h5>
               <p class="card-text">Se quiser ver se algum colaborador se encontra disponível, ou ausente, nesse mesmo menu do lado esquerdo, clique em "Status dos Colaboradores".</p> 

               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necessário</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>