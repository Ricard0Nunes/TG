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
               <li class="nav-item">
                  <a class="nav-link" href="/faqOrcamentos">Orçamentos</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRH">RH</a>
                  <span class="sr-only">(current)</span>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRH">RH</a>
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Ver colaboradores da empresa.</h5>
               <p class="card-text">No menu que se encontra do lado esquerdo, clique em "RH", depois "Colaboradores", de seguida em "Ver Colaboradores", depois é possível consultar alguns contactos, como também outras informações dos colaboradores da empresa.</p> 
               <h5 class="card-title">Criar um novo colaborador da empresa.</h5>
               <p class="card-text">Para criar um novo colaborador, siga os mesmos passos do "Ver colaboradores da empresa", mas quando carregar em "Colaboradores", em vez de escolher "Ver Colaboradores", clique em "Criar Colaborador".</p>
               <p class="card-text">De seguida irá surgir um formulário, com vários campos, onde tem de preenchê-los corretamente.</p>
               <p class="card-text">Tenha em atenção que os campos que contenham o símbolo "(*)" à frente, são campos onde tem de preenchê-los obrigatoriamente.</p>

               <h5 class="card-title">Ver cargos na empresa.</h5>
               <p class="card-text">Aceda a "RH", depois "Cargos", e por último "Ver Cargos".</p>
               <p class="card-text">Será aberta uma página com todos os cargos existentes na empresa.</p>
               <h5 class="card-title">Criar um novo cargo na empresa.</h5>
               <p class="card-text">Aceda a "RH", depois "Cargos", de seguida "Criar Cargo".</p>
               <p class="card-text">Depois disso, basta inserir o nome do cargo a criar e clicar em "Enviar".</p>
               <h5 class="card-title">Ver horários dos colaboradores.</h5>
               <p class="card-text">Para ver os horários dos vários colaboradores, aceda no menu do lado esquerdo a "RH" -> "Ver Horários" -> "Horários" -> "Ver Horários", e será apresentado os horários de cada colaborador da empresa.</p>

               <h5 class="card-title">Ver os departamentos existentes na empresa.</h5>
               <p class="card-text">Aceda a "RH", depois "Departamentos", e por último "Ver Departamentos".</p>
               <p class="card-text">De seguida irá abrir uma página com os vários departamentos da empresa, podendo ver quais são os colaboradores por cada departamento, clicando no botão azul, que se encontra do lado direito, à frente de cada departamento.</p>
               <p class="card-text">Também pode editar um departamento, clicando no botão laranja, que se encontra ao lado do botão azul, abrindo uma página, onde vai inserir o nome do departamento, como também a sua abreviatura. Depois de preenchido os campos, clica-se no botão "Enviar".</p>

               <h5 class="card-title">Criar um novo departamento na empresa.</h5>
               <p class="card-text">Para criar um novo departamento, basta seguir o mesmo caminho para ver os departamentos, mas em vez de clicar "Ver Departamentos", clicar em "Criar Departamento".</p>
               <p class="card-text">Onde irá abrir uma página, com dois campos, a "Descrição", onde se insere o nome do departamento, e o campo "Abreviatura", onde se insere as inicias do novo departamento. Depois de preenchido os campos, clica-se no botão "Enviar".</p>
               <p class="card-text">Outro caminho para criar um novo departamento, é na pagina "Ver Departamentos". Nessa página, encontra-se em baixo dos departamentos todos, um botão "Criar Departamento", ao clicar nele, abre a página para criar um novo departamento, e é so seguir os mesmo passos.</p>

               
               <h5 class="card-title">Marcar ausência.</h5>
               <p class="card-text">Se for faltar um dia, ou então vai começar as suas férias, ou por outro motivo qualquer, é preciso avisar a empresa, caso alguém necessite dos seus serviços, saber que naquele momento não se encontra em funções.</p>   
               <p class="card-text">Para isso, aceda no menu a "RH", depois "Ausências", por último "Marcar Ausências".</p>   
               <p class="card-text">Irá para uma página "Criar uma Ausência", nessa página terá de preencher alguns campos. No campo "Colaborador", selecione o seu nome, no campo "Descrição de Ausência", selecione qual é, e de seguida escolha o dia de começo da ausência e o término dessa mesma ausência. </p> 

               <h5 class="card-title">Ver quem está ausente da empresa.</h5>
               <p class="card-text">Se quiser ver quem está ausente da empresa, no menu escolha a opção "RH", depois "Ausências", e por último "Mostrar Ausências".</p>   
               <p class="card-text">Será mostrada uma página, com os nomes dos colaboradores que se encontram ausentes, porque motivo, e a data de início e fim.</p>   

               <h5 class="card-title">Ver que colaboradores estão de férias.</h5>
               <p class="card-text">Aceda ao menu a "RH", depois "Ausências", e por último "Férias".</p>   
               <p class="card-text">Será mostrada uma página, com os nomes dos colaboradores que se encontram de férias, e a data de início e fim.</p>   

               <h5 class="card-title">Consultar se vão existir paragens na empresa.</h5>
               <p class="card-text">Se pretende consultar se vai existir alguma paragem na empresa, aceda no menu a "RH", "Paragens Empresa".</p>   
               <p class="card-text">Será exibida uma página com as paragens que a empresa irá realizar, informando o tipo de paragem, como por exemplo "Feriado", "Férias", etc, como também mostra o dia, ou dias, que se encontrará fechada.</p>   

               <h5 class="card-title">Editar paragens na empresa.</h5>
               <p class="card-text">Se pretender editar uma paragem que a empresa tem programada, aceda ao mesmo menu explicado no ponto anterior (Consultar se vão existir paragens na empresa).</p>   
               <p class="card-text">No lado direito encontra-se um botão alaranjado, que contém um lápis, clique nele.</p>
               <p class="card-text">É apresentado um formulário com o dia que escolheu. Edite o que é necessário e clique no botão "Enviar".</p>   

               <h5 class="card-title">Eliminar uma paragem.</h5>
               <p class="card-text">Se pretender eliminar uma paragem que a empresa tem programada, aceda ao mesmo menu explicado no ponto anterior (Consultar se vão existir paragens na empresa).</p>   
               <p class="card-text">No lado direito encontra-se um botão vermelho, que contém um caixote do lixo, clique nele.</p>
               <p class="card-text">Depois de clicar nele, a paragem é automaticamente eliminada..</p> 

               <h5 class="card-title">Adicionar paragem</h5>
               <p class="card-text">Se pretende adicionar alguma paragem na empresa, aceda no menu a "RH", "Paragens Empresa".</p>   
               <p class="card-text">No final da página encotra-se um botão "Adicionar Dia". Clique nele.</p>   
               <p class="card-text">Irá abrir um formulário, preencha os campos de acordo com o tipo de paragem, os dias que vão ser, etc. e clique no botão "Enviar".</p>   

               <h5 class="card-title">Criar notícias</h5>
               <p class="card-text">Se precisar de informar todos os colaboradores de algo, pode criar uma notícia.</p>
               <p class="card-text">Para isso, aceda no menu a "RH" e de seguida a "Notícias". Será mostrada uma página com as notícias criadas anteriormente.</p>
               <p class="card-text">Para criar uma nova clique no botão "Criar Notícia", que se encontra por da informação das notícias criadas.</p>
               <p class="card-text">Será aberto um formulário, com os respetivos campos a preencher, como a descrição da notícia, e a data em que a notícia será mostrada.</p>
               <h5 class="card-title">Consultar registo diário de um colaborador</h5>
               <p class="card-text">Se pretender ver o registo diário de um colaborador, no menu escolha a opção "RH", e depois "Consultar Registo Diário".</p>
               <p class="card-text">Será mostrada uma página com todos os colaboradores da empresa. Escolha o colaborador que pretende, escolha o dia que quer consultar, e clique no botão que contém uma "lupa".</p>
               <p class="card-text">De seguida, será exibido toda a atividade que esse colaborador registou no dia que escolheu.

               <h5 class="card-title">Medicina no trabalho</h5>
               <p class="card-text">Se pretender ver que consultas cada colaborador tem marcadas, aceda no menu a "RH", e depois "Medicina no trabalho".</p>   
               <p class="card-text">Será mostrada uma tabela com as várias consultas marcadas de cada colaborador, com algumas informações.</p>
               <h5 class="card-title">Adicionar Exame Médico</h5>
               <p class="card-text">Se pretende adicionar um novo, aceda ao menu explicado no ponto anterior (Medicina no trabalho).</p>
               <p class="card-text">Clique em "Criar Exame Médico".</p>
               <p class="card-text">Será apresentado um formulário, com os campos necessários para adicionar um novo exame, como o tipo de exame, que colaborador vai fazê-lo, etc.</p>
               <h5 class="card-title">Ver ponto mensal de um colaborador</h5>
               <p class="card-text">Se quer ver todos os pontos de um colaborador num determinado mês, aceda a "RH", depois "Registos de Ponto", e po último "Relatório Ponto".</p>
               <p class="card-text">É apresentado todos os colaboradores, com as datas a frente de cada nome. Escolha o colaborador, escolha o mês que pretende ver, e clique no botão que contém uma "lupa".</p>
               <p class="card-text">Depois de carregar no botão, é apresentado, todos os registos desse colaborador, com todas as informações de cada dia.</p>
               <h5 class="card-title">Ver pontos de todos os claboradores mensalmente</h5>
               <p class="card-text">Para ver todos os registos de todos os colaboradores aceda a "RH", depois "Registos Ponto", e de seguida a "Mostrar Processamento".</p>
               <p class="card-text">É apresentado uma tabela com todos os registos de todos os colaboradores da empresa num mês. </p>
               <p class="card-text">Se pretender imprimir esses registos, no canto superior direito, aparece "Gerar folha resumo mês", escolha o mês que pretende, e depois clique na "lupa" que aparece por baixo.</p>
               <p class="card-text">É gerado um pdf, com todos esses registos, e depois já é posssivel imprimir.</p>
               <h5 class="card-title">Aprovar um ponto</h5>
               <p class="card-text">Se um colaborador editar o seu ponto, é necessário aprovar a sua edição.</p>
               <p class="card-text">Para isso aceda a "RH", depois "Registos Ponto", e de seguida "Aprovar Ponto". É lhe mostrado uma tabela, com informação do colaborador que editou o seu ponto.</p>
               <p class="card-text">Do lado esquerdo possui 2 botões, um verde e um vermelho. Se a edição do ponto do colaborador é válida clique no verde, se acha que não é válida, clique no vermelho.</p>
               <h5 class="card-title">Editar um ponto</h5>
               <p class="card-text">É necessário editar um ponto, então aceda a "RH" -> "Registos Pontos" -> "Editar Ponto".</p>
               <p class="card-text">É apresentado todos os colaboradores, escolha o que pretende alterar, escolha qual é o dia, e clique na "lupa".</p>
               <p class="card-text">Preencha os campos, com as novas informações, e clique em "Guardar". E o ponto é atualizado automaticamente.</p>






               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necessário</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>