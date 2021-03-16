<?php

namespace App\Http\Controllers;

use App\Horario;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DateTime;


class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horario = horario::get();
        return view('mostrar/horario', compact('horario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/horario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'descricao' => 'required',
            'horaEntrada' => 'required',
            'horaSaida' => 'required',
            'duracaoAlmoco' => 'required',
            'almocoApartir' => 'required',
            'almocoAte' => 'required',
            // 'horasDiarias' => 'required',
            'visivel' => 'required',
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/novohorario')->withInput()->withErrors($validator);
            }


            $entrada =Carbon::parse($request->horaEntrada)->diffInSeconds(Carbon::parse('00:00:00'));
            $saida=  Carbon::parse($request->horaSaida)->diffInSeconds(Carbon::parse('00:00:00'));
            if($entrada>$saida){
              return Redirect::back()->with('warning', 'Hora de saída tem de ser superior à hora de entrada.')->withInput();
            }

            $almocoApartir =Carbon::parse($request->almocoApartir)->diffInSeconds(Carbon::parse('00:00:00'));
            $almocoAte=  Carbon::parse($request->almocoAte)->diffInSeconds(Carbon::parse('00:00:00'));
            if($almocoApartir>$almocoAte){
              return Redirect::back()->with('warning', 'Hora de saída de almoço tem de ser superior à hora de entrada para almoço.')->withInput();
            }

             $horaEntrada = Carbon::parse($request->horaEntrada);
             $horaSaida = Carbon::parse($request->horaSaida);  
             $duracaoAlmoco = Carbon::parse($request->duracaoAlmoco);    

             $almocoEntrada = Carbon::parse($request->almocoApartir); 
             $almocoSaida = Carbon::parse($request->almocoAte); 

             $totalDiarias = $horaEntrada->diff($horaSaida)->format('%H:%I:%S');
             $total = gmdate('H:i:s', strtotime($totalDiarias) - strtotime($duracaoAlmoco));

            //  $total = $totalDiarias - $duracaoAlmoco;
            $totalalmoco = gmdate('H:i:s', strtotime($almocoSaida) - strtotime($almocoEntrada));
            // return $totalalmoco;

            $almoco =Carbon::parse($totalalmoco)->diffInSeconds(Carbon::parse('00:00:00'));
            $horaalmoco=Carbon::parse($request->duracaoAlmoco)->diffInSeconds(Carbon::parse('00:00:00'));

            if($horaalmoco>$almoco){
                return Redirect::back()->with('warning', 'A sua duração de hora de almoço não pode ser superior ao intervalo do início do almoço até ao final do mesmo.')->withInput();

            }

            $time = strtotime('00:30:00');
            $halmoco=strtotime($request->duracaoAlmoco);
           if($halmoco<$time){
            return Redirect::back()->with('warning', 'A sua hora de almoço tem de ser superior a 30 minutos.')->withInput();
        }

            $horario = new horario;
            $horario->descricao = $request['descricao'];
            $horario->horaEntrada = $request['horaEntrada'];
            $horario->horaSaida = $request['horaSaida'];
            $horario->duracaoAlmoco = $request['duracaoAlmoco'];
            $horario->almocoApartir = $request['almocoApartir'];
            $horario->almocoAte = $request['almocoAte'];
            $horario->horasDiarias = $total;
            $horario->visivel = $request['visivel'];
            $horario->save();
      
     
            \Session::flash('success', 'O Horário '. $request->descricao .' foi criado com sucesso');
    
            // escrever log 
            return Redirect::to('/horarios');
        }
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function colaboradoreshorario($id)
    {
        $colabhorario=user::where('fk_horario',$id)-> where('visivel',1)->get();
        $horario=horario::find($id)->value('descricao');
  
        return view('mostrar/colaboradoresporhorario',compact('colabhorario','horario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
            $horario = horario::find($id);
            return view('editar/horario', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $horario =  horario::find($id);
        

        $validator =  Validator::make($request->all(), [

            'descricao' => 'required',
            'horaEntrada' => 'required',
            'horaSaida' => 'required',
            'duracaoAlmoco' => 'required',
            'almocoApartir' => 'required',
            'almocoAte' => 'required',
            // 'horasDiarias' => 'required',
            'visivel' => 'required',
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/editarhorario/'.$id)->withInput()->withErrors($validator);
            }


            $entrada =Carbon::parse($request->horaEntrada)->diffInSeconds(Carbon::parse('00:00:00'));
            $saida=  Carbon::parse($request->horaSaida)->diffInSeconds(Carbon::parse('00:00:00'));
            if($entrada>$saida){
              return Redirect::back()->with('warning', 'Hora de saída tem de ser superior à hora de entrada.')->withInput();
            }

            $almocoApartir =Carbon::parse($request->almocoApartir)->diffInSeconds(Carbon::parse('00:00:00'));
            $almocoAte=  Carbon::parse($request->almocoAte)->diffInSeconds(Carbon::parse('00:00:00'));
            if($almocoApartir>$almocoAte){
              return Redirect::back()->with('warning', 'Hora de saída de almoço tem de ser superior à hora de entrada para almoço.')->withInput();
            }



            $horaEntrada = Carbon::parse($request->horaEntrada);
            $horaSaida = Carbon::parse($request->horaSaida);  
            $duracaoAlmoco = Carbon::parse($request->duracaoAlmoco);    

            $almocoEntrada = Carbon::parse($request->almocoApartir); 
            $almocoSaida = Carbon::parse($request->almocoAte); 

            $totalDiarias = $horaEntrada->diff($horaSaida)->format('%H:%I:%S');
            $total = gmdate('H:i:s', strtotime($totalDiarias) - strtotime($duracaoAlmoco));

           //  $total = $totalDiarias - $duracaoAlmoco;
           $totalalmoco = gmdate('H:i:s', strtotime($almocoSaida) - strtotime($almocoEntrada));
           // return $totalalmoco;

           $almoco =Carbon::parse($totalalmoco)->diffInSeconds(Carbon::parse('00:00:00'));
           $horaalmoco=Carbon::parse($request->duracaoAlmoco)->diffInSeconds(Carbon::parse('00:00:00'));

           if($horaalmoco>$almoco){
               return Redirect::back()->with('warning', 'A sua duração de hora de almoço não pode ser superior ao intervalo do início do almoço até ao final do mesmo.')->withInput();
           }

           $time = strtotime('00:30:00');
           $halmoco=strtotime($request->duracaoAlmoco);
          if($halmoco<$time){
           return Redirect::back()->with('warning', 'A sua hora de almoço tem de ser superior a 30 minutos.')->withInput();
       }


            
            $horario->descricao = $request['descricao'];
            $horario->horaEntrada = $request['horaEntrada'];
            $horario->horaSaida = $request['horaSaida'];
            $horario->duracaoAlmoco = $request['duracaoAlmoco'];
            $horario->almocoApartir = $request['almocoApartir'];
            $horario->almocoAte = $request['almocoAte'];
            $horario->horasDiarias = $total;
            $horario->visivel = $request['visivel'];
            $horario->save();
      
     
            \Session::flash('success', 'O Horário '. $request->descricao .' foi editado com sucesso');
    
            // escrever log 
            return Redirect::to('/horarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        //
    }
}
