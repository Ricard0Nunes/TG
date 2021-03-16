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
               <li class="nav-item">
                  <a class="nav-link" href="/faqRH">RH</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="/faqRequisicoes">Requisições</a>
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
                  <a class="nav-link" href="/faqRequisicoes">Requisições</a>
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
                  <a class="nav-link" href="/faqRequisicoes">Requisições</a>
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
               <h5 class="card-title">Ver veículos requisitados.</h5>
               <p class="card-text">Para ver os veículos requisitados para um certo dia, basta aceder no menu principal a "Requisições", depois "Registo Requisições", e por último "Veículos".</p>
               <p class="card-text">Será mostrada a informação das requisições efetuadas em relação a veículos, com algumas informações, como o colaborador que fez a requisição, qual foi o veículo, que rota o colaborador vai fazer, a data de requisição, etc.</p>
               <p class="card-text">Para ver informações mais detalhadas em relação à requisição do veículo, encontra-se um botão que contém um "olho" à frente de cada requisição, ao clicar nele irá aparecer mais informações a cerca dessa requisição</p>
               <h5 class="card-title">Necessito de requisitar um veículo.</h5>
               <p class="card-text">Para requisitar um veículo, aceda ao menu explicado anteriormente (Ver veículos requisitados).</p>
               <p class="card-text">Depois, no final da página encontra-se um botão "Requisitar Veículo".</p> 
               <p class="card-text">Aparecerá um formulário com alguns campos para preencher, para fazer a respetiva requisição do veículo. Depois de preencher os campos, como a rota que vai fazer, se vai levar ocupantes ou não, o horário, e os campos que são obrigatórios, carregue em "Adicionar Requisição". </p>  
               <p class="card-text">Depois de clicar no botão, será criada a sua requisição da viatura.</p> 
               <h5 class="card-title">Ver equipamentos requisitados.</h5>
               <p class="card-text">Para ver os equipamentos requisitados, basta aceder no menu principal a "Requisições", depois "Registo Requisições", e por último "Equipamentos".</p> 
               <p class="card-text">Será mostrada a informação das requisições efetuadas em relação aos equipamentos da empresa, com algumas informações, como o colaborador que fez a requisição, qual foi o equipamento, a data da requisição, o estado, se ainda está a ser requisitado ou não, etc.</p>
               <h5 class="card-title">Assinatura termo responsabilidade do equipamento.</h5>
               <p class="card-text">Para o colaborador utilizar o equipamento, é necessário o colaborador assinar um termo de responsabilidade. Para isso aceda ao menu do ponto anterior (Ver equipamentos requisitados).</p> 
               <p class="card-text">Do lado direito, existe um botão azul, que contém uma "folha". Ao clicar nesse botão, é gerado um pdf, onde o colaborador assume a responsabilidade do uso desse equipamento, basta depois do pdf ter sido gerado, imprimir, e entregar ao colaborador, para ele assinar.</p> 
               <h5 class="card-title">Requisitar um equipamento.</h5>
               <p class="card-text">Para requisitar um equipamento aceda ao menu explicado no ponto (Ver equipamentos requisitados).</p> 
               <p class="card-text">Depois no final da página encontra-se um botão "Requisitar Equipamento".</p> 
               <p class="card-text">Ao clicar nele, é aberto um formulário, com alguns campos para preencher. Depois de preencher todos os campos, como o equipamento que vai requisitar, a data, etc, clique no botão "Adicionar Requisição".</p> 
               <p class="card-text">A partir desse momento, a sua requisição aparece na lista dos equipamentos requisitados.</p> 
               <h5 class="card-title">Cancelar uma requisição.</h5>
               <p class="card-text">TEXTO.</p>
               <h5 class="card-title">Ver veiculos da empresa.</h5>
               <p class="card-text">Para ver os veículos da empresa, vá até "Requisições", depois "Imobilizado", e por último "Veículos" .</p>
               <p class="card-text">É aberta uma página onde é mostrado todos os veículos que naquele momento a empresa possui, com algumas informações, como a marca do veículo, o modelo, matrícula, entre outras.</p>
               <h5 class="card-title">Adicionar um novo veículo à empresa.</h5>
               <p class="card-text">Para adicionar um novo veículo à empresa, aceda ao menu explicado anteriormente (Ver veiculos da empresa).</p>
               <p class="card-text">No final deste página, existe um botão "Criar veículo". Ao clicar nele será aberto um formulário.</p>
               <p class="card-text">Nesse formulário, tem de preencher os campos que sejam obrigatórios, (os que contém à frente do nome do campo o símbolo (*)), e de seguida clicar em "Enviar".</p>
               <p class="card-text">Ao clicar em "Enviar" vai adicionar à lista dos veículos da empresa, o novo veículo que acabou de criar.</p>
               <h5 class="card-title">Atualizar dados de um veículo.</h5>
               <p class="card-text">Aceda ao menu como explicado no ponto "Ver veiculos da empresa".</p>
               <p class="card-text">Para atualizar os dados de um veículo, clique no botão alaranjado que contém um "lápis", que se encontra do lado direito, em frente aos dados de cada veículo.</p>
               <p class="card-text">Será aberto um formulário semelhante ao de "Adicionar um novo veículo", só que agora, nos campos do formulário aparece as informações do veículo que escolheu. Altere os campos que são necessários e guarde os novos dados clicando em "Editar Veículo".</p>
               <p class="card-text">Os novos dados do veículo serão alterados, e pode consultá-los no menu explicado em "Ver veículos da empresa".</p>
            
               <h5 class="card-title">Ver equipamentos da empresa.</h5>
               <p class="card-text">Para ver os equipamentos da empresa, vá até "Requisições", depois "Imobilizado", e por último "Equipamentos" .</p>
               <p class="card-text">É aberta uma página onde é mostrado todos os equipamentos que naquele momento a empresa possui, com algumas informações, como a marca, o modelo, fornecedor, entre outras.</p>
             
               <h5 class="card-title">Adicionar um novo equipamento à empresa.</h5>
               <p class="card-text">Para adicionar um novo equipamento à empresa, aceda ao menu explicado anteriormente (Ver equipamentos da empresa).</p>
               <p class="card-text">No final deste página, existe um botão "Criar equipamento". Ao clicar nele será aberto um formulário.</p>
               <p class="card-text">Nesse formulário, tem de preencher os campos que sejam obrigatórios, (os que contém à frente do nome do campo o símbolo (*)), e de seguida clicar em "Enviar".</p>
               <p class="card-text">Ao clicar em "Enviar" vai adicionar à lista dos equipamentos da empresa, o novo equipamento que acabou de criar.</p>
               <h5 class="card-title">Atualizar dados de um equipamento.</h5> 
               <p class="card-text">Aceda ao menu como explicado no ponto "Ver equipamentos da empresa".</p>
               <p class="card-text">Para atualizar os dados de um equipamento, clique no botão alaranjado que contém um "lápis", que se encontra do lado direito, em frente aos dados de cada equipamento.</p>
               <p class="card-text">Será aberto um formulário semelhante ao de "Adicionar um novo equipamento", só que agora, nos campos do formulário aparece as informações do equipamento que escolheu. Altere os campos que são necessários e guarde os novos dados clicando em "Enviar".</p>
               <p class="card-text">Os novos dados do equipamento serão alterados, e pode consultá-los no menu explicado em "Ver equipamentos da empresa".</p>

            
{{--             
               <a class="card-link">Link para imagem</a>
               <a class="card-link">Outro link se necessário</a> --}}
            </div>
         </div>
      </div>
   </body>
</html>