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
               <li class="nav-item">
                  <a class="nav-link" href="/faqProjetos">Projetos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/faqOrcamentos">Or??amentos</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRH">RH</a>
                  <span class="sr-only">(current)</span>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRH">RH</a>
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Ver colaboradores da empresa.</h5>
               <p class="card-text">No menu que se encontra do lado esquerdo, clique em "RH", depois "Colaboradores", de seguida em "Ver Colaboradores", depois ?? poss??vel consultar alguns contactos, como tamb??m outras informa????es dos colaboradores da empresa.</p> 
               <h5 class="card-title">Criar um novo colaborador da empresa.</h5>
               <p class="card-text">Para criar um novo colaborador, siga os mesmos passos do "Ver colaboradores da empresa", mas quando carregar em "Colaboradores", em vez de escolher "Ver Colaboradores", clique em "Criar Colaborador".</p>
               <p class="card-text">De seguida ir?? surgir um formul??rio, com v??rios campos, onde tem de preench??-los corretamente.</p>
               <p class="card-text">Tenha em aten????o que os campos que contenham o s??mbolo "(*)" ?? frente, s??o campos onde tem de preench??-los obrigatoriamente.</p>

               <h5 class="card-title">Ver cargos na empresa.</h5>
               <p class="card-text">Aceda a "RH", depois "Cargos", e por ??ltimo "Ver Cargos".</p>
               <p class="card-text">Ser?? aberta uma p??gina com todos os cargos existentes na empresa.</p>
               <h5 class="card-title">Criar um novo cargo na empresa.</h5>
               <p class="card-text">Aceda a "RH", depois "Cargos", de seguida "Criar Cargo".</p>
               <p class="card-text">Depois disso, basta inserir o nome do cargo a criar e clicar em "Enviar".</p>
               <h5 class="card-title">Ver hor??rios dos colaboradores.</h5>
               <p class="card-text">Para ver os hor??rios dos v??rios colaboradores, aceda no menu do lado esquerdo a "RH" -> "Ver Hor??rios" -> "Hor??rios" -> "Ver Hor??rios", e ser?? apresentado os hor??rios de cada colaborador da empresa.</p>

               <h5 class="card-title">Ver os departamentos existentes na empresa.</h5>
               <p class="card-text">Aceda a "RH", depois "Departamentos", e por ??ltimo "Ver Departamentos".</p>
               <p class="card-text">De seguida ir?? abrir uma p??gina com os v??rios departamentos da empresa, podendo ver quais s??o os colaboradores por cada departamento, clicando no bot??o azul, que se encontra do lado direito, ?? frente de cada departamento.</p>
               <p class="card-text">Tamb??m pode editar um departamento, clicando no bot??o laranja, que se encontra ao lado do bot??o azul, abrindo uma p??gina, onde vai inserir o nome do departamento, como tamb??m a sua abreviatura. Depois de preenchido os campos, clica-se no bot??o "Enviar".</p>

               <h5 class="card-title">Criar um novo departamento na empresa.</h5>
               <p class="card-text">Para criar um novo departamento, basta seguir o mesmo caminho para ver os departamentos, mas em vez de clicar "Ver Departamentos", clicar em "Criar Departamento".</p>
               <p class="card-text">Onde ir?? abrir uma p??gina, com dois campos, a "Descri????o", onde se insere o nome do departamento, e o campo "Abreviatura", onde se insere as inicias do novo departamento. Depois de preenchido os campos, clica-se no bot??o "Enviar".</p>
               <p class="card-text">Outro caminho para criar um novo departamento, ?? na pagina "Ver Departamentos". Nessa p??gina, encontra-se em baixo dos departamentos todos, um bot??o "Criar Departamento", ao clicar nele, abre a p??gina para criar um novo departamento, e ?? so seguir os mesmo passos.</p>

               
               <h5 class="card-title">Marcar aus??ncia.</h5>
               <p class="card-text">Se for faltar um dia, ou ent??o vai come??ar as suas f??rias, ou por outro motivo qualquer, ?? preciso avisar a empresa, caso algu??m necessite dos seus servi??os, saber que naquele momento n??o se encontra em fun????es.</p>   
               <p class="card-text">Para isso, aceda no menu a "RH", depois "Aus??ncias", por ??ltimo "Marcar Aus??ncias".</p>   
               <p class="card-text">Ir?? para uma p??gina "Criar uma Aus??ncia", nessa p??gina ter?? de preencher alguns campos. No campo "Colaborador", selecione o seu nome, no campo "Descri????o de Aus??ncia", selecione qual ??, e de seguida escolha o dia de come??o da aus??ncia e o t??rmino dessa mesma aus??ncia. </p> 

               <h5 class="card-title">Ver quem est?? ausente da empresa.</h5>
               <p class="card-text">Se quiser ver quem est?? ausente da empresa, no menu escolha a op????o "RH", depois "Aus??ncias", e por ??ltimo "Mostrar Aus??ncias".</p>   
               <p class="card-text">Ser?? mostrada uma p??gina, com os nomes dos colaboradores que se encontram ausentes, porque motivo, e a data de in??cio e fim.</p>   

               <h5 class="card-title">Ver que colaboradores est??o de f??rias.</h5>
               <p class="card-text">Aceda ao menu a "RH", depois "Aus??ncias", e por ??ltimo "F??rias".</p>   
               <p class="card-text">Ser?? mostrada uma p??gina, com os nomes dos colaboradores que se encontram de f??rias, e a data de in??cio e fim.</p>   

               <h5 class="card-title">Consultar se v??o existir paragens na empresa.</h5>
               <p class="card-text">Se pretende consultar se vai existir alguma paragem na empresa, aceda no menu a "RH", "Paragens Empresa".</p>   
               <p class="card-text">Ser?? exibida uma p??gina com as paragens que a empresa ir?? realizar, informando o tipo de paragem, como por exemplo "Feriado", "F??rias", etc, como tamb??m mostra o dia, ou dias, que se encontrar?? fechada.</p>   

               <h5 class="card-title">Editar paragens na empresa.</h5>
               <p class="card-text">Se pretender editar uma paragem que a empresa tem programada, aceda ao mesmo menu explicado no ponto anterior (Consultar se v??o existir paragens na empresa).</p>   
               <p class="card-text">No lado direito encontra-se um bot??o alaranjado, que cont??m um l??pis, clique nele.</p>
               <p class="card-text">?? apresentado um formul??rio com o dia que escolheu. Edite o que ?? necess??rio e clique no bot??o "Enviar".</p>   

               <h5 class="card-title">Eliminar uma paragem.</h5>
               <p class="card-text">Se pretender eliminar uma paragem que a empresa tem programada, aceda ao mesmo menu explicado no ponto anterior (Consultar se v??o existir paragens na empresa).</p>   
               <p class="card-text">No lado direito encontra-se um bot??o vermelho, que cont??m um caixote do lixo, clique nele.</p>
               <p class="card-text">Depois de clicar nele, a paragem ?? automaticamente eliminada..</p> 

               <h5 class="card-title">Adicionar paragem</h5>
               <p class="card-text">Se pretende adicionar alguma paragem na empresa, aceda no menu a "RH", "Paragens Empresa".</p>   
               <p class="card-text">No final da p??gina encotra-se um bot??o "Adicionar Dia". Clique nele.</p>   
               <p class="card-text">Ir?? abrir um formul??rio, preencha os campos de acordo com o tipo de paragem, os dias que v??o ser, etc. e clique no bot??o "Enviar".</p>   

               <h5 class="card-title">Criar not??cias</h5>
               <p class="card-text">Se precisar de informar todos os colaboradores de algo, pode criar uma not??cia.</p>
               <p class="card-text">Para isso, aceda no menu a "RH" e de seguida a "Not??cias". Ser?? mostrada uma p??gina com as not??cias criadas anteriormente.</p>
               <p class="card-text">Para criar uma nova clique no bot??o "Criar Not??cia", que se encontra por da informa????o das not??cias criadas.</p>
               <p class="card-text">Ser?? aberto um formul??rio, com os respetivos campos a preencher, como a descri????o da not??cia, e a data em que a not??cia ser?? mostrada.</p>
               <h5 class="card-title">Consultar registo di??rio de um colaborador</h5>
               <p class="card-text">Se pretender ver o registo di??rio de um colaborador, no menu escolha a op????o "RH", e depois "Consultar Registo Di??rio".</p>
               <p class="card-text">Ser?? mostrada uma p??gina com todos os colaboradores da empresa. Escolha o colaborador que pretende, escolha o dia que quer consultar, e clique no bot??o que cont??m uma "lupa".</p>
               <p class="card-text">De seguida, ser?? exibido toda a atividade que esse colaborador registou no dia que escolheu.

               <h5 class="card-title">Medicina no trabalho</h5>
               <p class="card-text">Se pretender ver que consultas cada colaborador tem marcadas, aceda no menu a "RH", e depois "Medicina no trabalho".</p>   
               <p class="card-text">Ser?? mostrada uma tabela com as v??rias consultas marcadas de cada colaborador, com algumas informa????es.</p>
               <h5 class="card-title">Adicionar Exame M??dico</h5>
               <p class="card-text">Se pretende adicionar um novo, aceda ao menu explicado no ponto anterior (Medicina no trabalho).</p>
               <p class="card-text">Clique em "Criar Exame M??dico".</p>
               <p class="card-text">Ser?? apresentado um formul??rio, com os campos necess??rios para adicionar um novo exame, como o tipo de exame, que colaborador vai faz??-lo, etc.</p>
               <h5 class="card-title">Ver ponto mensal de um colaborador</h5>
               <p class="card-text">Se quer ver todos os pontos de um colaborador num determinado m??s, aceda a "RH", depois "Registos de Ponto", e po ??ltimo "Relat??rio Ponto".</p>
               <p class="card-text">?? apresentado todos os colaboradores, com as datas a frente de cada nome. Escolha o colaborador, escolha o m??s que pretende ver, e clique no bot??o que cont??m uma "lupa".</p>
               <p class="card-text">Depois de carregar no bot??o, ?? apresentado, todos os registos desse colaborador, com todas as informa????es de cada dia.</p>
               <h5 class="card-title">Ver pontos de todos os claboradores mensalmente</h5>
               <p class="card-text">Para ver todos os registos de todos os colaboradores aceda a "RH", depois "Registos Ponto", e de seguida a "Mostrar Processamento".</p>
               <p class="card-text">?? apresentado uma tabela com todos os registos de todos os colaboradores da empresa num m??s. </p>
               <p class="card-text">Se pretender imprimir esses registos, no canto superior direito, aparece "Gerar folha resumo m??s", escolha o m??s que pretende, e depois clique na "lupa" que aparece por baixo.</p>
               <p class="card-text">?? gerado um pdf, com todos esses registos, e depois j?? ?? posssivel imprimir.</p>
               <h5 class="card-title">Aprovar um ponto</h5>
               <p class="card-text">Se um colaborador editar o seu ponto, ?? necess??rio aprovar a sua edi????o.</p>
               <p class="card-text">Para isso aceda a "RH", depois "Registos Ponto", e de seguida "Aprovar Ponto". ?? lhe mostrado uma tabela, com informa????o do colaborador que editou o seu ponto.</p>
               <p class="card-text">Do lado esquerdo possui 2 bot??es, um verde e um vermelho. Se a edi????o do ponto do colaborador ?? v??lida clique no verde, se acha que n??o ?? v??lida, clique no vermelho.</p>
               <h5 class="card-title">Editar um ponto</h5>
               <p class="card-text">?? necess??rio editar um ponto, ent??o aceda a "RH" -> "Registos Pontos" -> "Editar Ponto".</p>
               <p class="card-text">?? apresentado todos os colaboradores, escolha o que pretende alterar, escolha qual ?? o dia, e clique na "lupa".</p>
               <p class="card-text">Preencha os campos, com as novas informa????es, e clique em "Guardar". E o ponto ?? atualizado automaticamente.</p>






               {{-- <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necess??rio</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>