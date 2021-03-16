<?php

namespace App\Http\Controllers;

use App\Paragem;
use App\User;
use App\Empresa;
use App\Ponto;
use App\Task;
use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;

class ParagemEmpresaController extends Controller
 {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function mostrarParagemEmpresa()
 {

        $paragens = paragem::get();
        return view( 'mostrar/paragens', compact( 'paragens' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create()
 {

        $justificacoes = DB::connection( 'geraltg' )->table( 'justificacoes' )->where( 'pk_justificacao', '>=', 13 )->where( 'duracaoHoras', 0 )->pluck( 'descricao', 'pk_justificacao' );
        return view( 'criar/paragem', compact( 'justificacoes' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request )
 {

        $paragem = new paragem;
        $paragem->descricao = $request['descricao'];
        $paragem->dia = $request['dia'];
        $paragem->ano = carbon::parse( $request['dia'] )->format( 'Y' );
        $paragem->fk_justificacao = $request['fk_ausencia'];
        $paragem->save();

        \Session::flash( 'success', 'O dia  '. $paragem->dia .' foi adicionado como um dia de paragem.' );

        // escrever log
        return Redirect::to( '/paragens' );

    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Area  $area
    * @return \Illuminate\Http\Response
    */

    public function show( Area $area )
 {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Area  $area
    * @return \Illuminate\Http\Response
    */

    public function edit( Request $request )
 {

        $paragem = paragem::find( $request->id );
        $justificacoes = DB::connection( 'geraltg' )->table( 'justificacoes' )->where( 'pk_justificacao', '>=', 13 )->where( 'duracaoHoras', 0 )->pluck( 'descricao', 'pk_justificacao' );

        return view( 'editar/paragem', compact( 'paragem', 'justificacoes' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Area  $area
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request )
 {
        $paragem =  paragem::find( $request->id );
        $paragem->descricao = $request->descricao;
        $paragem->dia = $request['dia'];
        $paragem->ano = carbon::parse( $request['dia'] )->format( 'Y' );
        $paragem->fk_justificacao = $request['fk_ausencia'];

        $paragem->save();

        \Session::flash( 'success', 'O dia  '. $paragem->dia .' foi editado.' );

        // escrever log
        return Redirect::to( '/paragens' );

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Area  $area
    * @return \Illuminate\Http\Response
    */

    public function apagar( Request $request )
 {
        $paragem = paragem::find( $request->id );
        $paragem->delete();
        \Session::flash( 'success', 'A mensagaem '. $paragem->descricao .' foi apagada com sucesso' );

        // escrever log
        return Redirect::to( '/paragens' );

    }

    public function processarParagem() {

        $paragem = paragem::where('ano', carbon::now()->format('Y'))->get();

        $users = user::where( 'id', '>', 1 )->where( 'visivel', 1 )->get();
        for ( $i = 0; $i <count( $paragem ) ;  $i++ ) {

          $dia[$i] = carbon::parse( $paragem[$i]->dia );
            if ( $dia[$i]->isWeekday() == 1 ) {  //ver se dia é dia de trabalho
                for ( $u = 0; $u <count( $users ) ;  $u++ ) {

                    $ponto = ponto::where( 'data',  $dia[$i] )->where( 'ccuser', $users[$u]->bi )->get();
                    if ( count( $ponto )>0 ) {
                        // Tem ponto. Ver se o ponto que existe é um ponto de justificação ou um ponto nomral
                        if ( $ponto[0]->fk_justificacao >= 13 ) {
                            // return $ponto[0]->fk_justificacao;

                        }
                         else {
                            $ponto[0]->delete();
                            $registo = new ponto;
                            $registo->dia = Carbon::parse( $paragem[$i]->dia )->formatLocalized( '%A %d de %B de %Y' );
                            $registo->data =  $dia[$i];
                            $registo->entradaManha = '00:00:00';
                            $registo->saidaManha = '00:00:00';
                            $registo->entradaTarde = '00:00:00';
                            $registo->saidaTarde = '00:00:00';
                            $registo->totalDia = '00:00:00';
                            $registo->tempoAlmoco = '00:00:00';
                            $registo->comentario =  $paragem[$i]->descricao;
                            $registo->fk_justificacao = $paragem[$i]->fk_justificacao;
                            $registo->ccuser = $users[$u]->bi;
                            $registo->empresapicagem = $registo->nifempresa  = empresa::where( 'visivel', 1 )->value( 'nif' );
                            $registo->fk_tipo = 7;

                            $registo->save();

                            $task = new Task();
                            $task->text = DB::connection( 'geraltg' )->table( 'justificacoes' )->where( 'pk_justificacao', $paragem[$i]->fk_justificacao )->value( 'descricao' ) .': '.$users[$u]->name;
                            $task->duration = 1;
                            $task->progress = 1;
                            $task->parent = 0;
                            $task->tipo = 3;
                            $task->start_date =  $task->horaInicioPrev = Carbon::parse( $paragem[$i]->dia )->format( 'Y-m-d H:i:s' );
                            $task->end_date = $task->horaFimPrev = Carbon::parse( $paragem[$i]->dia . '23:59:59' )->format( 'Y-m-d H:i:s' );
                            $task->fk_tecnico = $users[$u]->id;
                            $task->fk_estadoIntervencao = 1;

                            $task->save();
                        }

                    } else {
                        $registo = new ponto;
                        $registo->dia = Carbon::parse( $paragem[$i]->dia )->formatLocalized( '%A %d de %B de %Y' );
                        $registo->data =  $paragem[$i]->dia;
                        $registo->entradaManha = '00:00:00';
                        $registo->saidaManha = '00:00:00';
                        $registo->entradaTarde = '00:00:00';
                        $registo->saidaTarde = '00:00:00';
                        $registo->totalDia = '00:00:00';
                        $registo->tempoAlmoco = '00:00:00';
                        $registo->comentario =  $paragem[$i]->descricao;
                        $registo->fk_justificacao = $paragem[$i]->fk_justificacao;
                        $registo->ccuser = $users[$u]->bi;
                        $registo->empresapicagem = $registo->nifempresa  = empresa::where( 'visivel', 1 )->value( 'nif' );
                        $registo->fk_tipo = 7;

                        $registo->save();

                        $task = new Task();
                        $task->text = DB::connection( 'geraltg' )->table( 'justificacoes' )->where( 'pk_justificacao', $paragem[$i]->fk_justificacao )->value( 'descricao' ) .': '.$users[$u]->name;
                        $task->duration = 1;
                        $task->progress = 1;
                        $task->parent = 0;
                        $task->tipo = 3;
                        $task->start_date =  $task->horaInicioPrev = Carbon::parse( $paragem[$i]->dia )->format( 'Y-m-d H:i:s' );
                        $task->end_date = $task->horaFimPrev = Carbon::parse( $paragem[$i]->dia . '23:59:59' )->format( 'Y-m-d H:i:s' );
                        $task->fk_tecnico = $users[$u]->id;
                        $task->fk_estadoIntervencao = 1;

                        $task->save();
                    }

                }
            }
            //   ver se tem evento para todos. dar o subject
             $calendario = Event::where( 'text', 'like', 'Todos ->'. strip_tags( DB::connection( 'geraltg' )->table( 'justificacoes' )->where( 'pk_justificacao', $paragem[$i]->fk_justificacao )->value( 'descricao' ) ) )->where( 'start_date', $paragem[$i]->dia.' 00:00:00' )->where( 'fk_tecnico', 0 )->get();
            if ( count( $calendario )>0 ) {

                } else {
                    $event = new Event();
                    $event->text = 'Todos ->'. strip_tags( DB::connection( 'geraltg' )->table( 'justificacoes' )->where( 'pk_justificacao', $paragem[$i]->fk_justificacao )->value( 'descricao' ) );
                    $event->start_date =    Carbon::parse( $paragem[$i]->dia )->format( 'Y-m-d H:i:s' );
                    $event->end_date = carbon::parse( $paragem[$i]->dia )->addDays( 1 )->format( 'Y-m-d H:i:s' );
                    if ( $paragem[$i]->fk_justificacao == 13 ) {
                            $event->subject = 1;
            #FERIAS
                        } elseif ( $paragem[$i]->fk_justificacao == 17 ) {
                            $event->subject = 5;
            #feriado
                        }
                        elseif ( $paragem[$i]->fk_justificacao >= 18 ) {
                            $event->subject = 9;
            #tolerancia
                        }
                        else {
                            $event->subject = 2;
            #ausencia
                        }
                    $event->fk_tecnico = 0;
                    $event->obs = null;
                    $event->localizacao = 'sede';
                    $event->save();
            }

        }
        \Session::flash( 'success', 'O calendário foi Processado' );

        // escrever log
        return Redirect::to( '/paragens' );

    }
}
