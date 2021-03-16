<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notificacoes;

class NotificacoesController extends Controller
{
    public function apagarnotificaacao(Request $request){
       $notificacao= notificacoes::find($request->id);
    $notificacao->delete();
    return back();

    }
    public function lernotificacao(Request $request){
        $notificacao= notificacoes::find($request->id);
        $notificacao->lida=1;
        $notificacao->save();
        return back();
            }
}
