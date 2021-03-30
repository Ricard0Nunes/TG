<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });
// cron




Route::get('/cronponto', 'CronJobsController@verificarponto');
Route::get('/picar', 'PontoController@entrar');
Route::post('/picar', 'PontoController@picar')->name('ponto.picar');
Route::get('/picarCalendario', function(){
    return view('registo/pinCalendario');
});
Route::get('/', function () {
    return view('auth/login');
});



Auth::routes();
Route::group(['middleware' => ['auth']], function () { 

// Route::get('/home', 'PontoController@index');


Route::get('/criar_user', function() {
    return view('criar/user');
})->name('criar_user')->middleware('auth');

Route::get('/setup', function() {
    return view('setup/setup');
});
Route::get('/setup2', function() {
    return view('setup/setup2');
});
Route::get('/setupEmpresa', function() {
    return view('setup/setupEmpresa');
});
Route::get('/setupcargohorario', function() {
    return view('setup/setupcargohorario');
});
// empresas
Route::get('/empresas', 'EmpresasController@index');
Route::get('/novaempresa', 'EmpresasController@create');
Route::get('/editarempresa/{id}', 'EmpresasController@edit');
// Route::get('/verempresa', 'EmpresasController@show');
Route::post('/editarempresas/{id}', 'EmpresasController@update')->name('empresas.update');
Route::post('/novaempresas', 'EmpresasController@store')->name('empresa.store');
Route::post('/setupEmpresa', 'EmpresasController@storeSetup')->name('empresa.storeSetup');

//licenciamento 

Route::get('/licenciamento', 'LicenciamentoController@index');
Route::post('/introduzirsn', 'LicenciamentoController@introduzirsn')->name('introduzirsn');



//gestão 

Route::get('/dashboard', 'RelatoriosController@index');
Route::post('/dashboard', 'RelatoriosController@index')->name('dashboard.ver');
Route::post('/relatoriodia', 'RelatoriosController@show')->name('relatorio.ver');

//users
Route::get('/colaboradors', 'usersController@index');
Route::get('/novouser', 'usersController@create');
Route::get('/criarcolaborador', 'usersController@create');
Route::get('/editaruser/{id}', 'usersController@edit');
Route::get('/veruser/{id}', 'usersController@show'); 
Route::get('/perfil', 'usersController@show'); 
Route::post('/novausers', 'usersController@store')->name('user.store');
Route::post('/editarusers/{id}', 'usersController@update')->name('user.update');

Route::get('/ajax-departamentoUser', 'usersController@departamentoAjax');


Route::post('/apagarnotificaacao', 'NotificacoesController@apagarnotificaacao');
Route::post('/lernotificacao', 'NotificacoesController@lernotificacao');


//cargos
Route::get('/cargos', 'cargosController@index');
Route::get('/novocargo', 'cargosController@create');
Route::post('/novocargos', 'cargosController@store')->name('cargo.store');
Route::get('/editarcargo/{id}', 'cargosController@edit');
Route::post('/editarcargos/{id}', 'cargosController@update')->name('cargo.update');


//departamento
Route::get('/departamentosempresa', 'departamentosController@indexdepempresa');
Route::get('/departamentos', 'departamentosController@index');
Route::get('/novodepartamento', 'departamentosController@create');
Route::post('/novodepartamentos', 'departamentosController@store')->name('departamento.store');
Route::get('/listarcolaboradores/{id}', 'departamentosController@listarcolaboradores');
Route::get('/editardepartamento/{id}', 'departamentosController@edit');
Route::get('/adddepemp/{id}', 'departamentosController@adddepemp');
Route::post('/adicionardepemp/{id}', 'departamentosController@adicionardepemp')->name('departamento.adicionardepemp');
Route::get('/relatoriodep', 'departamentosController@relatoriodep');
Route::post('/editardepartamentos/{id}', 'departamentosController@update')->name('departamento.update');
Route::get('/removerdepartamento/{id}', 'departamentosController@delete');



//clientes
Route::get('/clientes', 'clienteController@index');
Route::get('/rgpdcliente', 'clienteController@clientergpd');
Route::post('/clienteonrgpd', 'clienteController@ativarrgpd')->name('cliente.onrgpd');
Route::post('/clienteoffrgpd', 'clienteController@desativarrgpd')->name('cliente.offrgpd');
Route::get('/novocliente', 'clienteController@create');
Route::get('/client', 'clienteController@show')->name('cliente.ver');
Route::post('/clientes', 'clienteController@show')->name('cliente.ver');
Route::post('/editarcliente', 'clienteController@edit')->name('cliente.editar');
Route::post('/novoclientes', 'clienteController@store')->name('cliente.store');
Route::post('/editarclientes/{id}', 'clienteController@update')->name('cliente.update');
Route::post('/gravarcontacto', 'ContactoController@store');
Route::get('/editarcontato/{id}', 'ContactoController@edit');
Route::post('/editarcontato', 'ContactoController@update')->name('contacto.update');
Route::post('/apagarcontacto', 'ContactoController@apagar')->name('contacto.apagar');

//projetos

Route::get('/projeto2', function(){
    return view('ver/projeto2');
});

Route::get('/projetos', 'ProjetoController@index');
Route::get('/novoprojeto', 'ProjetoController@create');
Route::post('/novoprojetos', 'ProjetoController@store')->name('projeto.store');


Route::get('/verprojeto/{id}', 'ProjetoController@show');
Route::post('/verprojeto', 'ProjetoController@show')->name('projeto.ver');
Route::post('/campoextraprojeto', 'ProjetoController@storecampoextra')->name('campoextra.store');


Route::get('/ajax-departamento', 'ProjetoController@departamentoAjax');
Route::get('/editarprojeto/{id}', 'ProjetoController@edit');
Route::post('/editarprojetos/{id}', 'ProjetoController@update')->name('projeto.update');
Route::get('/startprojeto/{id}', 'ProjetoController@start');
Route::get('/stopprojeto/{id}', 'ProjetoController@stop');
Route::get('/restartprojeto/{id}', 'ProjetoController@restart');

//etapas
Route::get('/etapas','TasksController@mostraretapas');
Route::get('/novaetapa','TasksController@mostrarprojetos');
Route::get('/etapacriar', 'TasksController@criaretapa');
Route::post('/etapacriar', 'TasksController@criaretapa')->name('etapa.criar');
Route::post('/gravaretapa', 'TasksController@gravaretapa')->name('etapa.guardar');
Route::post('/pararetapa', 'TasksController@pararetapa')->name('etapa.pararetapa');
Route::post('/pararetapaconfrima', 'TasksController@pararetapa')->name('etapa.pararconfirma');





//Proj Departamento
Route::get('/projdep', 'ProjDepController@index');
Route::get('/ajax-departamentoUser', 'ProjDepController@departamentoAjax');
Route::post('/depempproj', 'ProjDepController@store')->name('depempproj.store');
Route::get('/removerdepproj/{id}/{projeto}', 'ProjDepController@removerdepproj');
Route::get('/adicionardepproj/{id}/{projeto}', 'ProjDepController@adicionardepproj');


//areas

Route::get('/projetoarea', 'AreaController@index');
Route::get('/novaarea', 'AreaController@create');
Route::get('/editarea/{id}', 'AreaController@edit');
Route::post('/novaareas', 'AreaController@store')->name('area.store');
Route::post('/editareas/{id}', 'AreaController@update')->name('area.update');
//urgencia

Route::get('/projetourgencia', 'UrgenciaController@index');
Route::get('/novaurgencia', 'UrgenciaController@create');
Route::get('/editarurgencia/{id}', 'UrgenciaController@edit');
Route::post('/novaurgencias', 'UrgenciaController@store')->name('urgencia.store');
Route::post('/editarurgencias/{id}', 'UrgenciaController@update')->name('urgencia.update');

//horarios
Route::get('/horarios', 'HorariosController@index');
Route::get('/novohorario', 'HorariosController@create');
Route::get('/editarhorario/{id}', 'HorariosController@edit');
Route::post('/novohorarios', 'HorariosController@store')->name('horario.store');
Route::get('/colaboradoreshorario/{id}', 'HorariosController@colaboradoreshorario');
Route::post('/editarhorario/{id}', 'HorariosController@update')->name('horario.update');


//orçamentos
Route::get('/novoorcamento','OrcamentoController@create');
Route::get('/orcamentos','OrcamentoController@index');
Route::post('/orcamento2', 'OrcamentoController@iniciar')->name('store.iniciar');
Route::get('/verorcamento', 'OrcamentoController@show');
Route::post('/verorcamento', 'OrcamentoController@show')->name('orcamento.ver');
Route::post('/editarorcamento', 'OrcamentoController@edit')->name('orcamento.edit');
Route::post('/removerartigoorcamento', 'OrcamentoController@removerartigo')->name('orcamento.removerartigo');
Route::get('/editarorcamento', 'OrcamentoController@edit');
Route::post('/orcamento3', 'OrcamentoController@store')->name('orcamento3');
Route::post('/adicionarartigoorcamento', 'OrcamentoController@adicionarartigo')->name('adicionarartigoorcamento');
Route::post('/fecharpropostta', 'OrcamentoController@fecharproposta')->name('fecharproposta');
Route::post('/orcamentopdf', 'OrcamentoController@orcamentoPdf')->name('orcamentopdf.emitir');
Route::post('/editarartigoorcemento', 'OrcamentoController@editarartigo')->name('orcamento.editarartigo');
Route::post('/update', 'OrcamentoController@updateartigo')->name('editarartigoorcamento');
Route::post('/adjudicar', 'OrcamentoController@adjudicar')->name('adjudicarorcamento');
Route::post('/naoadjudicar', 'OrcamentoController@naoadjudicar')->name('naoadjudicarorcamento');
Route::post('/enviarnaoadjudicacao', 'OrcamentoController@enviarnaoadjudicacao')->name('enviarnaoadjudicacao');
Route::post('/reverproposta', 'OrcamentoController@reverproposta')->name('reverproposta');
Route::post('/orcamentocondicoes', 'OrcamentoController@orcamentocondicoes')->name('orcamento.condiçoes');








//Ajax Orçamentos
Route::get('ajax-artigos','OrcamentoController@newOrcamentoArtigoAjax');
Route::get('ajax-valor','OrcamentoController@newOrcamentoValorAjax');
	//return View::make('welcome');

// prazos orçamento 
Route::get('/prazosorcamento', 'OrcPrazoController@index');
Route::get('/criarprazo', 'OrcPrazoController@create');
Route::post('/editarprazo', 'OrcPrazoController@editar')->name('prazo.editar');
Route::post('/updatefornecedor', 'OrcPrazoController@update')->name('prazo.update');
Route::post('/storeprazos', 'OrcPrazoController@store')->name('store.prazo');


// tipos orçamento
Route::get('/tiposorcamento', 'OrcTipoController@index');
Route::get('/criartipoorcamento', 'OrcTipoController@create');
Route::post('/editartipo', 'OrcTipoController@edit')->name('tipo.editar');
Route::post('/updatetipo', 'OrcTipoController@update')->name('tipo.update');
Route::post('/storetipo', 'OrcTipoController@store')->name('store.tipo');











Route::get('{empresa}/projetoarea', 'AreaController@index');


//Registo



Route::get('/faturaPDF', 'IntervencaoController@faturaPDF'); //faturação

// ponto

Route::get('/registo','PontoController@index');
Route::get('/registo#kanban','PontoController@index');
// if(request()->ip() == '195.23.35.164' || request()->ip() == gethostbyname('globalseven.ddns.net')||  request()->ip() == '127.0.0.1' )
{   Route::get('/entradamanha','PontoController@entradamanha');
    Route::get('/saidamanha','PontoController@saidamanha');
    Route::get('/entradatarde','PontoController@entradatarde');
    Route::get('/saida','PontoController@saida');
}
Route::get('/picarem','PontoController@store');
Route::post('/editarregisto', 'PontoController@editarregisto')->name('registo.editarregisto');;
Route::post('/salvarpontoeditado', 'PontoController@salvarpontoeditado')->name('tarefa.salvarpontoeditado');
Route::post('/registo', 'PontoController@registodia')->name('registo.ver');
Route::get('/registod', 'PontoController@registodia');
Route::get('/mostrarpontomensal', 'PontoController@mostrarpontomensal');
Route::post('/mostrarpontomensal', 'PontoController@mostrarpontomensal')->name('registo.mostrarpontomensal');

Route::post('/gravartodo', 'TodoListController@store');
Route::post('/feitotodo', 'TodoListController@feitotodo');
Route::post('/apagartodo', 'TodoListController@apagartodo');

// RH
Route::get('/colaboradores', 'usersController@index');
Route::get('/colaboradorarquivo', 'usersController@indexarquivo');
Route::get('/colaboradoresall', 'usersController@colaboradoresall');
Route::get('/status', 'usersController@status');
Route::get('/aprovarpontos', 'PontoController@mostrarregistorporaprovar');
Route::get('/aprovarpontoshistorico', 'PontoController@mostrarregistohistorico');
Route::get('/editarresgistos', 'PontoController@editarresgistos');
Route::post('/aprovarponto', 'PontoController@aprovarponto')->name('ponto.aprovar');
Route::post('/reprovarponto', 'PontoController@reprovarponto')->name('ponto.reprovar');
Route::post('/pontoedicao', 'PontoController@pontoedicao')->name('ponto.edicao');
Route::get('/consultarregistodiario', 'PontoController@consultarregistodiario');
Route::get('/relatorioponto', 'PontoController@relatorioponto');
Route::get('/processar', 'PontoController@processar');
Route::post('/processar', 'PontoController@processar')->name('registo.processar');
Route::get('/processamento', 'PontoController@mostrarProcessar');
Route::post('/processamentomensal', 'PontoController@processar2')->name('processamento.ver');

Route::post('/processarmensal', 'PontoController@processarmensal')->name('registo.processarmensal');

Route::get('/marcarausencia', 'AusenciasController@marcarausencia');
Route::get('/marcarausenciapropria', 'AusenciasController@marcarausenciapropria');
Route::post('/ausenciastore', 'AusenciasController@ausenciastore')->name('ausencia.store');
Route::post('/ausenciastorehoras', 'AusenciasController@ausenciastore')->name('ausencia.storehoras');
Route::post('/ausenciasaprovar', 'AusenciasController@ausenciaaprovar')->name('ausencia.aprovar');
Route::post('/ausenciasreprovar', 'AusenciasController@ausenciareprovar')->name('ausencia.reprovar');


Route::post('/ausenciasapagar', 'AusenciasController@ausenciasapagar')->name('ausencia.apagar');
Route::get('/mostrarausencias', 'AusenciasController@mostrarausencias');
Route::get('/ferias', 'AusenciasController@ferias');

Route::get('/noticias', 'AlertController@mostranoticias');
Route::get('/noticia', 'AlertController@mostranoticiasproprias');
Route::get('/criarnoticia', 'AlertController@create');
Route::post('/noticiastore', 'AlertController@store')->name('noticia.store');
Route::post('/noticiaupdate', 'AlertController@update')->name('noticia.update');
Route::post('/editnoticias', 'AlertController@edit')->name('noticia.edit');
Route::post('/apagarnoticias', 'AlertController@apagar')->name('noticia.apagar');


Route::get('/paragens', 'ParagemEmpresaController@mostrarParagemEmpresa');
Route::get('/adicionardiaparagem', 'ParagemEmpresaController@create');
Route::post('/paragemapagar', 'ParagemEmpresaController@apagar')->name('paragem.apagar');
Route::post('/paragemstore', 'ParagemEmpresaController@store')->name('paragem.store');
Route::post('/paragemupdate', 'ParagemEmpresaController@update')->name('paragem.update');
Route::post('/paragemeditar', 'ParagemEmpresaController@edit')->name('paragem.edit');
Route::get('/processarparagem', 'ParagemEmpresaController@processarParagem');


// tasks

Route::post('/criartarefa','TasksController@criartarefaamao')->name('criar.tarefa');
Route::get('/criartarefa','TasksController@criartarefaamao');
Route::post('/tarefastore', 'TasksController@gravartarefamao')->name('tarefa.store');


Route::get('/editartask/{id}', 'TasksController@edit')->name('tarefa.editar');

Route::post('/starttarefa', 'TasksController@starttarefa')->name('tarefa.iniciar');
Route::post('/reagendartarefa', 'TasksController@reagendartask')->name('tarefa.reagendar');
Route::post('/prereagendartarefa', 'TasksController@prereagendartask')->name('tarefa.prereagendar');

Route::post('/parartarefa', 'TasksController@parar')->name('tarefa.parar');
Route::post('/reagendartask', 'TasksController@reagendartask');
Route::get('/intervencoes','TasksController@mostratodas');

Route::post('/updateparartarefa', 'TasksController@updateTarefaRelatorio')->name('tarefa.update');
Route::post('/cancelartarefa', 'TasksController@cancelartarefa')->name('tarefa.cancelar');
Route::post('/apagartarefa', 'TasksController@apagarTarefa')->name('tarefa.apagar');
Route::post('/pausartarefa', 'TasksController@pausartarefa')->name('tarefa.pausar');
Route::post('/reiniciartarefa', 'TasksController@reiniciartarefa')->name('tarefa.reiniciar');
Route::post('/vertarefa', 'TasksController@vertarefa')->name('tarefa.ver');
Route::post('/veretapa', 'TasksController@vertarefa')->name('tarefa.veretapa');
Route::post('/editartarefa', 'TasksController@editarTarefa')->name('tarefa.editar');
Route::post('/updateparartarefaa', 'TasksController@updateTarefa')->name('tarefa.update2');



Route::get('/pausartarefa', 'TasksController@updateTarefaRelatorio');
Route::get('/teste', 'ProjetoController@get');
Route::get('/scate', function(){
    return view('teste');
});


//Ajax TASK
Route::get('ajax-projeto','TasksController@newTaskProjetoAjax');
Route::get('ajax-etapa','TasksController@newTaskEtapasAjax');
Route::get('ajax-users','TasksController@newTaskUsersAjax');


// chat

Route::get('/chat','ChatController@caixaentrada');
Route::post('/chat', 'ChatController@mostrarmensagens')->name('chat.mensagem');
Route::post('/enviar', 'ChatController@enviar')->name('chat.enviar');
Route::post('/novaconversacao', 'ChatController@novaconversacao')->name('chat.nova');
    

//Veiculos
Route::get('/veiculos', 'VeiculosController@index');
Route::get('/novoveiculo', 'VeiculosController@create');
Route::post('/editarveiculo/{id}', 'VeiculosController@edit')->name('veiculo.edit');
Route::get('/editarveiculo/{id}', 'VeiculosController@edit');
Route::post('/novoveiculos', 'VeiculosController@store')->name('veiculo.store');
Route::post('/editarveiculos/{id}', 'VeiculosController@update')->name('veiculo.update');


//Salas
Route::get('/salas', 'salasController@index');
Route::get('/novasala', 'salasController@create');
Route::put('/editarsala/{id}', 'salasController@edit')->name('sala.edit');
Route::get('/editarsala/{id}', 'salasController@edit'); 
Route::post('/novasalas', 'salasController@store')->name('sala.store');
Route::post('/editarsalas/{id}', 'salasController@update')->name('sala.update');  
Route::post('/apagarsalas', 'salasController@destroy')->name('sala.apagar');

//Equipamentosm
Route::get('/equipamentos', 'EquipamentosController@index');
Route::get('/novoequipamento', 'EquipamentosController@create');
Route::post('/editarequipamento', 'EquipamentosController@edit')->name('equipamento.edit');
Route::post('/novoequipamentos', 'EquipamentosController@store')->name('equipamento.store');
Route::post('/editarequipamentos', 'EquipamentosController@update')->name('equipamento.update');
Route::post('/equipamentover', 'EquipamentosController@show')->name('equipamento.ver');



//Requisições
Route::get('/requisicoescarro', 'RequisicaoController@requisicoescarro');
Route::get('requisitarcarro', 'RequisicaoController@createRequisicaocarro');
Route::post('/requisicaosstorecarro', 'RequisicaoController@storeRequisicaoCarro')->name('requisicaocarro.store');
Route::post('/requisicaocarroaprovar', 'RequisicaoController@requisicaocarroaprovar')->name('requisicaocarro.aprovar');
Route::post('/requisicaocarroreprovar', 'RequisicaoController@requisicaocarroreprovar')->name('requisicaocarro.reprovar');
Route::post('/requisicaocarroapagar', 'RequisicaoController@requisicaocarroapagar')->name('requisicaocarro.apagar');
Route::get('/requisicaocarrover', 'RequisicaoController@requisicaocarrover');

Route::get('/requisicoesequipamento', 'RequisicaoController@requisicoesequipamento');
Route::get('requisitarequipamento', 'RequisicaoController@createRequisicaoEquipamento')->name('requisicaoequipamento.criar');
Route::post('/requisicaosstoreequipamento', 'RequisicaoController@storeRequisicaoequipamento')->name('requisicaoequipamento.store');
Route::post('/requisicaoequipamentoedit', 'RequisicaoController@pararRequisicaoequipamento')->name('requisicaoequipamento.parar');
Route::post('/termo', 'RequisicaoController@termo')->name('termoresponsabilidade.emitir');


Route::post('/requisicaocarrover', 'RequisicaoController@requisicaocarrover')->name('requisicaocarro.ver');
Route::post('/requisicaocarroeditar', 'RequisicaoController@requisicaocarroeditar')->name('requisicaocarro.editar');
Route::post('/requisicaosupdatecarro', 'RequisicaoController@updateRequisicaoVeiculo')->name('requisicaocarro.update');
Route::post('/requisicaopartidacarro', 'RequisicaoController@requisicaocarropartida')->name('requisicaocarro.partida');
Route::post('/requisicaochegadacarro', 'RequisicaoController@requisicaocarrochegada')->name('requisicaocarro.chegada');
Route::post('/requisicaoregistoscarro', 'RequisicaoController@requisicaocarroregistos')->name('requisicaocarro.registos');


Route::get('/requisicoessala', 'RequisicaoSalaController@requisicoessala');
Route::get('/requisitarsala', 'RequisicaoSalaController@createRequisicaoSala');
Route::post('/requisicaosstoresala', 'RequisicaoSalaController@storeRequisicaoSala')->name('requisicaosala.store');
Route::post('/requisicaosalaapagar', 'RequisicaoSalaController@destroy')->name('requisicaosala.apagar');

Route::post('/requisicaosaprovar', 'RequisicaoController@requisicaoaprovar')->name('requisicao.aprovar');
Route::post('/requisicaosreprovar', 'RequisicaoController@requisicaoreprovar')->name('requisicao.reprovar');




//Medicina
Route::get('/medicina', 'MedicinaController@index');
Route::get('/criarmedicina', 'MedicinaController@create');
Route::post('/criarmedicinaasd', 'MedicinaController@store')->name('medicina.store');


//Calendário
Route::get('/calendario', function(){
    return view('ver/calendario');
});
Route::get('/ano', function(){
    return view('ver/ano');
});
Route::get('/feriascolaborador/{id}', 'EventController@get');
});


//Medicina
Route::get('/correspondencias', 'CorrespondenciaController@index');
Route::get('/correspondencianova', 'CorrespondenciaController@create');
Route::post('/correspondendiaentregar', 'CorrespondenciaController@entregar')->name('correspondencia.entregar');
Route::post('/correspondendiacomentar', 'CorrespondenciaController@comentar')->name('correspondencia.comentar');
Route::post('/correspondendiareceber', 'CorrespondenciaController@receber')->name('correspondencia.receber');
Route::post('/correspondendiastore', 'CorrespondenciaController@store')->name('correspondencia.store');

//


Route::post('/criarmanutencao', 'ManutencaoController@create')->name('manutencaoeq.criar');
// Route::get('/vermanutencao/{id}', 'ManutencaoController@show');
// Route::post('/vermanutencao', 'Manutencaocontroler@show')->name('manutencao.ver');
// Route::post('/editarmanutencao', 'Manutencaocontroller@edit')->name('manutencao.edit');
Route::post('/novamanutencao', 'Manutencaocontroller@store')->name('manutencao.store');
// Route::post('/editarmanutencao', 'Manutencaocontroller@update')->name('manutencao.update');


//Logistica

Route::get('/armazens', 'ArmazemController@index');
Route::get('/novoarmazem', 'ArmazemController@create');
Route::post('/editararmazem', 'ArmazemController@editar')->name('armazem.editar');
Route::post('/updatearmazem', 'ArmazemController@update')->name('armazem.update');
Route::post('/armazemstore', 'ArmazemController@store')->name('armazem.store');

Route::get('/familiaartigo', 'FamiliaArtigosController@index');
Route::get('/novofamiliaartigo', 'FamiliaArtigosController@create');
Route::post('/editarfamilia', 'FamiliaArtigosController@editar')->name('familiaartigos.editar');
Route::post('/familiaup', 'FamiliaArtigosController@update')->name('familiaartigos.update');
Route::post('/familiastore', 'FamiliaArtigosController@store')->name('familiaartigo.store');


Route::get('/artigos', 'ArtigoController@index');
Route::get('/novoartigo', 'ArtigoController@create')->name('artigo.criar');
Route::post('/editarartigo', 'ArtigoController@editar')->name('artigo.editar');
Route::post('/updateartigo', 'ArtigoController@update')->name('artigo.update');
Route::post('/artigostore', 'ArtigoController@store')->name('artigo.store');
Route::post('/artigover', 'ArtigoController@show')->name('artigo.ver');

Route::get('/fornecedores', 'FornecedorController@index');
Route::get('/novofornecedor', 'FornecedorController@create');
Route::post('/editarfornecedor', 'FornecedorController@editar')->name('fornecedor.editar');
Route::post('/updatefornecedor', 'FornecedorController@update')->name('fornecedor.update');
Route::post('/fornecedorstore', 'FornecedorController@store')->name('fornecedor.store');
Route::post('/fornecedorshow', 'FornecedorController@show')->name('mostrar.fornecedor');




Route::get('/compras', 'CompraController@index');
Route::get('/novocompra', 'CompraController@create');
Route::post('/editarcompra', 'CompraController@editar')->name('compras.editar');
Route::post('/apagarcompra', 'CompraController@destroy')->name('compras.apagar');
Route::post('/mostrarcompra', 'CompraController@show')->name('compras.mostrar');
Route::get('/mostrarcompra', 'CompraController@show');
Route::post('/updatecompra', 'CompraController@update')->name('compras.update');
Route::post('/fecharcompra', 'CompraController@fechar')->name('compras.fechar');
Route::post('/dataprevista', 'CompraController@dataprevista')->name('compras.dataprevista');
Route::post('/chegada', 'CompraController@chegada')->name('compras.chegada');
Route::post('/comprarstore', 'CompraController@store')->name('compras.store');
Route::post('/adicionarlinhacompra', 'CompraController@adicionarartigo')->name('compras.adicionarartigo');
Route::post('/removerlinhacompra', 'CompraController@removerartigo')->name('compras.removerartigo');

Route::get('/inventario', 'InventarioController@show');
Route::post('/inventario', 'InventarioController@show')->name('inventario.mostrar');
Route::post('/corrigir', 'InventarioController@corrigir')->name('inventario.corrigir');


Route::get('/vendas', 'VendaController@index');
Route::get('/novovenda', 'VendaController@create');
Route::post('/vendastore', 'VendaController@store')->name('venda.store');
Route::post('/mostrarvenda', 'VendaController@show')->name('venda.mostrar');
Route::get('/mostrarvenda', 'VendaController@show');
Route::post('/fecharvenda', 'VendaController@fechar')->name('venda.fechar');
Route::post('/dataprevistarec', 'VendaController@recebimento')->name('venda.recebimento');


Route::post('/adicionarlinhavemnda', 'VendaController@adicionarartigo')->name('venda.adicionarartigo');
Route::post('/adicionarlinhavenda', 'VendaController@adicionarartigo')->name('venda.adicionarartigoconfirma');
Route::post('/removerlinhavenda', 'VendaController@removerartigo')->name('venda.removerartigo');

//formacao

//Formacao
Route::get('/newformacao', 'FormacoesController@create');
Route::get('/formacao', 'FormacoesController@index');
Route::post('/novaformacao', 'FormacoesController@store')->name('formacao.store');
Route::post('/deleteformacao', 'FormacoesController@destroy')->name('formacao.apagar');
Route::post('/fecharformacao', 'FormacoesController@fecharformacao')->name('fechar.formacao');
Route::post('/terminarformacao', 'FormacoesController@terminarformacao')->name('terminar.formacao');
Route::post('/editarformacao', 'FormacoesController@edit')->name('editar.formacao');
Route::post('/updateformacao', 'FormacoesController@update')->name('update.formacao');
Route::post('/escreveravaliacao', 'formacoescontroller@formavaliacao')->name('mostrar.avaliacao');
Route::get('/minhaformacao', 'FormacoesController@avaliacao');
Route::post('/escreveravaliacao', 'FormacoesController@formavaliacao')->name('mostrar.avaliacao');
Route::post('/insertavaliacao/{id}', 'FormacoesController@insertavalicao')->name('avaliacao.store');
Route::post('/arquivarformacao', 'FormacoesController@arquivarformacao')->name('arquivar.formacao');

//inscricao
Route::get('/newinscricao', 'InscricaoController@create');
Route::post('/novainscricao', 'InscricaoController@store')->name('inscricao.store');
Route::post('/formacaoinscricao', 'InscricaoController@inscricaoformacao')->name('formacao.inscricao');
Route::post('/inscricao', 'InscricaoController@mostrarinscricao')->name('mostrar.inscricao');
Route::get('/inscricao', 'InscricaoController@mostrarinscricao');
Route::post('/insertinscricao', 'InscricaoController@inseririnscricao')->name('inscricao.inserir');
Route::post('/deleteinscricao', 'InscricaoController@destroy')->name('inscrito.apagar');


//tipo de campanha 
Route::get('/newtipocampanha', 'CrmTipoCampanhasController@create');
Route::get('/tipocampanha', 'CrmTipoCampanhasController@index');
Route::post('/novotipocampanha', 'CrmTipoCampanhasController@store')->name('tipo_campanha.store');
Route::post('/deletetipocampanha', 'CrmTipoCampanhasController@destroy')->name('tipo_campanha.apagar');
Route::post('/editartipocampanha', 'CrmTipoCampanhasController@edit')->name('editar.tipo_campanha');
Route::post('/updatetipocampanha', 'CrmTipoCampanhasController@update')->name('update.tipo_campanha');
 
//campanha
Route::get('/campanha', 'CrmCampanhasController@index');
Route::get('/novacampanha', 'CrmCampanhasController@create');
Route::post('/insertcampanha', 'CrmCampanhasController@store')->name('campanha.store');
Route::post('/editcampanha', 'CrmCampanhasController@edit')->name('campanha.edit');
Route::post('/updatecampanha', 'CrmCampanhasController@update')->name('campanha.update');
Route::post('/deletecampanha', 'CrmCampanhasController@destroy')->name('campanha.delete');

//CRM ORIGEM
Route::get('/origem','CrmOrigensController@index');
Route::get('/origemcriar', 'CrmOrigensController@create')->name('criar.crm_origem');
Route::post('/origemstore', 'CrmOrigensController@store')->name('store.crm_origem');
Route::post('/origemeditar', 'CrmOrigensController@edit')->name('editar.crm_origem');
Route::post('/origemupdate', 'CrmOrigensController@update')->name('update.crm_origem');
Route::post('/origemdelete', 'CrmOrigensController@destroy')->name('delete.crm_origem');


//potencialCliente
Route::get('/potencialcliente', 'potencialClienteController@index');
Route::get('/newpotencialcliente', 'potencialClienteController@create');
Route::post('/insertpotencialcliente', 'potencialClienteController@store')->name('potencialcliente.store');
Route::post('/deletepotencialcliente', 'potencialClienteController@destroy')->name('potencialcliente.apagar');
Route::post('/editpotencialcliente', 'potencialClienteController@edit')->name('editar.potencialcliente');
Route::post('/verpotencialcliente', 'potencialClienteController@show')->name('ver.potencialcliente');
Route::post('/updatepotencialcliente', 'potencialClienteController@update')->name('update.potencialcliente');
Route::post('/converterpotencialcliente', 'potencialClienteController@converter')->name('converter.potencialcliente');
Route::post('/verpotencialclientelead', 'potencialClienteController@showcomlead')->name('contactos.lead');
Route::get('/verpotencialclientelead', 'potencialClienteController@showcomlead');
Route::post('/storecontactosComClientes', 'potencialClienteController@storecontactos')->name('store.contactosComClientespot');
Route::post('/apagarcontactosComClientes', 'potencialClienteController@apagarcontacto')->name('contactocomcliente.apagar');
Route::post('/agendaadicionar', 'potencialClienteController@agendaadicionar')->name('adicionar.agendapotencialcliente');
Route::get('/editarcontatocomcliente/{id}', 'potencialClienteController@editcontacto');
Route::post('/editarcontatocomcliente', 'potencialClienteController@updatecontacto')->name('contactocomcliente.update');
Route::post('/apagarcontactocomcliente', 'potencialClienteController@apagarcontactoc')->name('contactocomclientec.apagar');






//tipo_contacto
Route::get('/tipocontacto','tipoContactosController@index');
Route::get('/tipocontactocriar', 'tipoContactosController@create')->name('criar.tipocontacto');
Route::post('/tipocontactostore', 'tipoContactosController@store')->name('store.tipocontacto');
Route::post('/tipocontactoeditar', 'tipoContactosController@edit')->name('editar.tipocontacto');
Route::post('/tipocontactoupdate', 'tipoContactosController@update')->name('update.tipocontacto');
//leads
Route::get('/leads', 'leadsController@index');
Route::get('/newlead', 'leadsController@create');
Route::post('/newleadpot', 'leadsController@createpot')->name('lead.create');
Route::post('/insertlead', 'leadsController@store')->name('lead.store');
Route::post('/insertleadpot', 'leadsController@storepot')->name('leadpot.store');
Route::post('/editlead', 'leadsController@edit')->name('editar.lead');
Route::post('/updatelead', 'leadsController@update')->name('update.lead');

//ContactosComCliente
Route::get('/contactosComClientes','contactosComClientesController@index');
Route::get('/newcontactosComClientes', 'contactosComClientesController@create');
Route::post('/storecontactosComCliente', 'contactosComClientesController@store')->name('store.contactosComClientes');
Route::post('/editcontactosComCliente', 'contactosComClientesController@edit')->name('edit.contactosComClientes');
Route::post('/updatecontactosComCliente', 'contactosComClientesController@update')->name('update.contactosComClientes');

//IVAs
Route::get('/ivas', 'IvaController@index');
Route::get('/novoiva', 'IvaController@create');
Route::post('/editariva', 'IvaController@edit')->name('iva.editar');
Route::post('/novoIva', 'IvaController@store')->name('iva.store');
Route::post('/updateiva', 'IvaController@update')->name('iva.update');


//Produçao

//>> estado ordem producao










//FAQ

Route::get('/faq', function(){
    return view('faq/template');
});

Route::get('/faqZonaPessoal', function(){
    return view('faq/templatezonapessoal');
});

Route::get('/faqGestao', function(){
    return view('faq/templategestao');
});

Route::get('/faqClientes', function(){
    return view('faq/templateclientes');
});

Route::get('/faqProjetos', function(){
    return view('faq/templateprojetos');
});

Route::get('/faqOrcamentos', function(){
    return view('faq/templateorcamentos');
});

Route::get('/faqRequisicoes', function(){
    return view('faq/templaterequisicoes');
});

Route::get('/faqRH', function(){
    return view('faq/templaterh');
});

Route::get('/relatorio', function(){
    return view('ver/relatoriodiario');
});


