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
               <li class="nav-item">
                  <a class="nav-link" href="/faqRH">RH</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRequisicoes">Requisi????es</a>
                  <span class="sr-only">(current)</span>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRequisicoes">Requisi????es</a>
                  <span class="sr-only">(current)</span>
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
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRequisicoes">Requisi????es</a>
                  <span class="sr-only">(current)</span>
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
               <h5 class="card-title">Ver ve??culos requisitados.</h5>
               <p class="card-text">Para ver os ve??culos requisitados para um certo dia, basta aceder no menu principal a "Requisi????es", depois "Registo Requisi????es", e por ??ltimo "Ve??culos".</p>
               <p class="card-text">Ser?? mostrada a informa????o das requisi????es efetuadas em rela????o a ve??culos, com algumas informa????es, como o colaborador que fez a requisi????o, qual foi o ve??culo, que rota o colaborador vai fazer, a data de requisi????o, etc.</p>
               <p class="card-text">Para ver informa????es mais detalhadas em rela????o ?? requisi????o do ve??culo, encontra-se um bot??o que cont??m um "olho" ?? frente de cada requisi????o, ao clicar nele ir?? aparecer mais informa????es a cerca dessa requisi????o</p>
               <h5 class="card-title">Necessito de requisitar um ve??culo.</h5>
               <p class="card-text">Para requisitar um ve??culo, aceda ao menu explicado anteriormente (Ver ve??culos requisitados).</p>
               <p class="card-text">Depois, no final da p??gina encontra-se um bot??o "Requisitar Ve??culo".</p> 
               <p class="card-text">Aparecer?? um formul??rio com alguns campos para preencher, para fazer a respetiva requisi????o do ve??culo. Depois de preencher os campos, como a rota que vai fazer, se vai levar ocupantes ou n??o, o hor??rio, e os campos que s??o obrigat??rios, carregue em "Adicionar Requisi????o". </p>  
               <p class="card-text">Depois de clicar no bot??o, ser?? criada a sua requisi????o da viatura.</p> 
               <h5 class="card-title">Ver equipamentos requisitados.</h5>
               <p class="card-text">Para ver os equipamentos requisitados, basta aceder no menu principal a "Requisi????es", depois "Registo Requisi????es", e por ??ltimo "Equipamentos".</p> 
               <p class="card-text">Ser?? mostrada a informa????o das requisi????es efetuadas em rela????o aos equipamentos da empresa, com algumas informa????es, como o colaborador que fez a requisi????o, qual foi o equipamento, a data da requisi????o, o estado, se ainda est?? a ser requisitado ou n??o, etc.</p>
               <h5 class="card-title">Assinatura termo responsabilidade do equipamento.</h5>
               <p class="card-text">Para o colaborador utilizar o equipamento, ?? necess??rio o colaborador assinar um termo de responsabilidade. Para isso aceda ao menu do ponto anterior (Ver equipamentos requisitados).</p> 
               <p class="card-text">Do lado direito, existe um bot??o azul, que cont??m uma "folha". Ao clicar nesse bot??o, ?? gerado um pdf, onde o colaborador assume a responsabilidade do uso desse equipamento, basta depois do pdf ter sido gerado, imprimir, e entregar ao colaborador, para ele assinar.</p> 
               <h5 class="card-title">Requisitar um equipamento.</h5>
               <p class="card-text">Para requisitar um equipamento aceda ao menu explicado no ponto (Ver equipamentos requisitados).</p> 
               <p class="card-text">Depois no final da p??gina encontra-se um bot??o "Requisitar Equipamento".</p> 
               <p class="card-text">Ao clicar nele, ?? aberto um formul??rio, com alguns campos para preencher. Depois de preencher todos os campos, como o equipamento que vai requisitar, a data, etc, clique no bot??o "Adicionar Requisi????o".</p> 
               <p class="card-text">A partir desse momento, a sua requisi????o aparece na lista dos equipamentos requisitados.</p> 
               <h5 class="card-title">Cancelar uma requisi????o.</h5>
               <p class="card-text">TEXTO.</p>
               <h5 class="card-title">Ver veiculos da empresa.</h5>
               <p class="card-text">Para ver os ve??culos da empresa, v?? at?? "Requisi????es", depois "Imobilizado", e por ??ltimo "Ve??culos" .</p>
               <p class="card-text">?? aberta uma p??gina onde ?? mostrado todos os ve??culos que naquele momento a empresa possui, com algumas informa????es, como a marca do ve??culo, o modelo, matr??cula, entre outras.</p>
               <h5 class="card-title">Adicionar um novo ve??culo ?? empresa.</h5>
               <p class="card-text">Para adicionar um novo ve??culo ?? empresa, aceda ao menu explicado anteriormente (Ver veiculos da empresa).</p>
               <p class="card-text">No final deste p??gina, existe um bot??o "Criar ve??culo". Ao clicar nele ser?? aberto um formul??rio.</p>
               <p class="card-text">Nesse formul??rio, tem de preencher os campos que sejam obrigat??rios, (os que cont??m ?? frente do nome do campo o s??mbolo (*)), e de seguida clicar em "Enviar".</p>
               <p class="card-text">Ao clicar em "Enviar" vai adicionar ?? lista dos ve??culos da empresa, o novo ve??culo que acabou de criar.</p>
               <h5 class="card-title">Atualizar dados de um ve??culo.</h5>
               <p class="card-text">Aceda ao menu como explicado no ponto "Ver veiculos da empresa".</p>
               <p class="card-text">Para atualizar os dados de um ve??culo, clique no bot??o alaranjado que cont??m um "l??pis", que se encontra do lado direito, em frente aos dados de cada ve??culo.</p>
               <p class="card-text">Ser?? aberto um formul??rio semelhante ao de "Adicionar um novo ve??culo", s?? que agora, nos campos do formul??rio aparece as informa????es do ve??culo que escolheu. Altere os campos que s??o necess??rios e guarde os novos dados clicando em "Editar Ve??culo".</p>
               <p class="card-text">Os novos dados do ve??culo ser??o alterados, e pode consult??-los no menu explicado em "Ver ve??culos da empresa".</p>
            
               <h5 class="card-title">Ver equipamentos da empresa.</h5>
               <p class="card-text">Para ver os equipamentos da empresa, v?? at?? "Requisi????es", depois "Imobilizado", e por ??ltimo "Equipamentos" .</p>
               <p class="card-text">?? aberta uma p??gina onde ?? mostrado todos os equipamentos que naquele momento a empresa possui, com algumas informa????es, como a marca, o modelo, fornecedor, entre outras.</p>
             
               <h5 class="card-title">Adicionar um novo equipamento ?? empresa.</h5>
               <p class="card-text">Para adicionar um novo equipamento ?? empresa, aceda ao menu explicado anteriormente (Ver equipamentos da empresa).</p>
               <p class="card-text">No final deste p??gina, existe um bot??o "Criar equipamento". Ao clicar nele ser?? aberto um formul??rio.</p>
               <p class="card-text">Nesse formul??rio, tem de preencher os campos que sejam obrigat??rios, (os que cont??m ?? frente do nome do campo o s??mbolo (*)), e de seguida clicar em "Enviar".</p>
               <p class="card-text">Ao clicar em "Enviar" vai adicionar ?? lista dos equipamentos da empresa, o novo equipamento que acabou de criar.</p>
               <h5 class="card-title">Atualizar dados de um equipamento.</h5> 
               <p class="card-text">Aceda ao menu como explicado no ponto "Ver equipamentos da empresa".</p>
               <p class="card-text">Para atualizar os dados de um equipamento, clique no bot??o alaranjado que cont??m um "l??pis", que se encontra do lado direito, em frente aos dados de cada equipamento.</p>
               <p class="card-text">Ser?? aberto um formul??rio semelhante ao de "Adicionar um novo equipamento", s?? que agora, nos campos do formul??rio aparece as informa????es do equipamento que escolheu. Altere os campos que s??o necess??rios e guarde os novos dados clicando em "Enviar".</p>
               <p class="card-text">Os novos dados do equipamento ser??o alterados, e pode consult??-los no menu explicado em "Ver equipamentos da empresa".</p>

            
{{--             
               <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necess??rio</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>