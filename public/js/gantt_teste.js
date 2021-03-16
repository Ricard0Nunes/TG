
  



gantt.config.date_format = "%Y-%m-%d %H:%i:%s"; //Configura o formato do dateTime do gráfico

gantt.serverList("users", []); //server list que cria o array com os users
// Função que irá fazer loop à procura do nome do user que corresponda à fk_tecnico.
   function getUser(fk_tecnico) {
       var users = gantt.serverList("users");
       for (var s = 0; s < users.length; s++) {
           if (users[s].key == fk_tecnico) {
               return users[s].label;
           }
       }
       return "";
   }
//Secções da lightbox
   gantt.locale.labels.section_users = "Responsável"; 
   gantt.locale.labels.section_start_date = "Data de Inicio";
   gantt.locale.labels.section_end_date = "Data de Fim";
   gantt.locale.labels.section_nulo = "";
   gantt.locale.labels.section_inicio = "Data de Inicio";
   gantt.locale.labels.section_fim = "Data de Fim";
//------------------

//Cria a coluna "Gerir" no dashboard do gráfico e aplica os botões de adicionar/editar/apagar
var colHeader = 'Gerir',
colContent = function (task) {
 if ( task.$level > 1 ){ //se a task conter um nivel superior a 1 apenas aparece o editar e apagar
       return ('<i class="fa gantt_button_grid gantt_grid_edit fa-pencil-alt" onclick="clickGridButton(' + task.id + ', \'edit\')"></i>' +
           
               '<i class="fa gantt_button_grid gantt_grid_delete fa-times" onclick="clickGridButton(' + task.id + ', \'delete\')"></i>');
       
   }
   //se não aparecem todos os botões normais
   return ('<i class="fa gantt_button_grid gantt_grid_edit fa-pencil-alt" onclick="clickGridButton(' + task.id + ', \'edit\')"></i>' +
               '<i class="fa gantt_button_grid gantt_grid_add fa-plus" onclick="clickGridButton(' + task.id + ', \'add\')"></i>' +
               '<i class="fa gantt_button_grid gantt_grid_delete fa-times" onclick="clickGridButton(' + task.id + ', \'delete\')"></i>');
       
   };
//------------------

//função que adiciona ação aos botões de gerir
function clickGridButton(id, action) {
   
       switch (action) {
           case "edit":
               gantt.showLightbox(id);
               break;
           case "add":
               gantt.createTask(null, id);
               break;
           case "delete":
               gantt.confirm({
                   title: gantt.locale.labels.confirm_deleting_title,
                   text: gantt.locale.labels.confirm_deleting,
                   callback: function (res) {
                       if (res)
                           gantt.deleteTask(id);
                   }
               });
               break;
       }
   }
//------------------
//Template que adiciona ao lado esquerdo das barras do gráfico a duração da mesma
       gantt.templates.leftside_text = function(start, end, task){
           if(task.duration ==1 )
           return task.duration + " dia";
           else
           return task.duration + " dias";
   };
//------------------

//configurações que permitem mover as tasks na vertical dentro do dashboard
   gantt.config.order_branch = true;
   gantt.config.order_branch_free = true;
//------------------

//função do dia
// var piada = function(titanic){
//   this.float = null;
// }

//------------------
//Evento accionado assim que a lightbox fecha, dando refresh ao gráfico para aparecer as novas tasks adicionadas
gantt.attachEvent("onAfterLightbox",function(){
     gantt.clearAll();
               gantt.init('gantt_here');
gantt.load("/api/data");}	);
//------------------

//------------------
gantt.config.time_step = 5;
gantt.config.duration_unit = "hour";
//configuração das secções das lightboxes
gantt.config.lightbox.sections = [
       //height: funciona como css, have fun
       { name: "users", height: 25, map_to: "fk_tecnico", type: "select", options:gantt.serverList("users") },
       { name: "description", height: 70, map_to: "text", type: "textarea", focus: true },
       { name: "start_date", height: 25, map_to: "start_date", type: "duration",time_format:["%d","%m","%Y","%H:%i"],single_date:"true"},
       { name: "end_date", height: "25px !important", map_to: "end_date", type: "duration",time_format:["%d","%m","%Y","%H:%i"], single_date:"true"}
       
   ];
//------------------

//configuração das colunas de dashboard do gráfico
   gantt.config.columns = [
       {name: "text", tree: true, width: '*', resize: true},
   {
       name: "fk_tecnico", label: "Responsável",align: "center", template: function (obj) {
       return getUser(obj.fk_tecnico);
       }
       },
       {
           name: "buttons",
           label: colHeader,
           width: 75,
           template: colContent
       }
 ];
//------------------
//todo o código que faz o zoom funcionar
var hourRangeFormat = function(step){
   return function(date){
       var intervalEnd = new Date(gantt.date.add(date, step, "hora") - 1)
       return hourToStr(date) + " - " + hourToStr(intervalEnd);
   };
};

var tasks = gantt.getTaskByTime();
var data = new Date();
gantt.config.min_column_width = 80;

var zoomConfig ={
   minColumnWidth: 80,
   maxColumnWidth: 150,
   
   levels: [
       [
           { unit: "month", format: "%M %Y", step: 1},
           {unit: "week", step: 1, format: function (date) {
                   var dateToStr = gantt.date.date_to_str("%d %M");
                   var endDate = gantt.date.add(date, -6, "day");
                   var weekNum = gantt.date.date_to_str("%W")(date);
                   return "Sem #" + weekNum + ", " + dateToStr(date) + " - " + dateToStr(endDate);
               }}
       ],
       [
           { unit: "month", format: "%M %Y", step: 1},
           { unit: "day", format: "%d %M", step: 1}
       ],
       [
           { unit: "day", format: "%d %M", step: 1},
           { unit: "hour", format: hourRangeFormat(12), step: 12}
       ],
       [
           {unit: "day", format: "%d %M",step: 1},
           {unit: "hour",format: hourRangeFormat(6),step: 6}
       ],
       [
           { unit: "day", format: "%d %M", step: 1 },
           { unit: "hour", format: "%H:%i", step: 1}
       ]
   ],


   useKey: "ctrlKey",
   trigger: "wheel",
   element: function(){
       return gantt.$root.querySelector(".gantt_task");
   }
}

gantt.ext.zoom.init(zoomConfig);
//------------------

  
gantt.init("gantt_here");

gantt.load("/api/data");
   gantt.ajax.get("/api/users").then(function(response){
   
       var users = JSON.parse(response.responseText); 
       gantt.updateCollection("users", users);
       gantt.render();
   });
var dp = new gantt.dataProcessor("/api");
gantt.attachEvent("onLightboxSave", function(id, item){
   if(!item.text){
       gantt.message({type:"error", text:"Introduza uma descrição"});
       return false;
   }
   if(!item.fk_tecnico){
       gantt.message({type:"error", text:"Escolha um técnico válido"});
       return false;
   }
   if(!item.start_date){
       gantt.message({type:"error", text:"Introduza uma Data de Inicio válida"});
       return false;
   }
   if(!item.end_date){
       gantt.message({type:"error", text:"Introduza uma Data de Fim válida"});
       return false;
   }
       return true;
});
dp.init(gantt);
dp.setTransactionMode("REST");