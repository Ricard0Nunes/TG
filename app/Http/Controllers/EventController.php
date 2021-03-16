<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event; 
use App\User; 
use App\usersComuns;
use Auth;
use URL;
class EventController extends Controller
{
    
    public function index(Request $request){
   //  return response()->json([
//            6248643884386674874274
//             ]);

$users = new User();
    
$events = new Event();

$from = $request->from;
$to = $request->to;


// $departamento = DB::table('projdeps')->where('fk_projeto',$id)->pluck('fk_departamento');

$usersArray = $users->where('visivel',1)->where('id','>',1)->get()->all();



//  array_unshift($usersArray, ["id"=>"909", "sigla" => "Todos"]);// add 'unassigned' user
// return response()->json([
//     $id
//     ]);
return response()->json([
              "data" => $events->
        where("start_date", "<", $to)->
        where("end_date", ">=", $from)->get(),

       "collections" =>[ "users" => array_map(function ($users) {
           return [
                
                "value" => $users["bi"],
                "label" => $users["sigla"].' (' .$users['name'].')'
            ];
        },
         $usersArray
    ),]]
);
}

public function indexFerias(Request $request){
    //  return response()->json([
 //            6248643884386674874274
 //             ]);
 $str= URL::previous();
 $id= (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
 $usr=user::find($id);


 $users = new User();
     
 $events = new Event();
 
 $from = $request->from;
 $to = $request->to;

 
 // $departamento = DB::table('projdeps')->where('fk_projeto',$id)->pluck('fk_departamento');
 
 $usersArray = $users->where('visivel',1)->where('id','>',1)->get()->all();
 
 
 
 //  array_unshift($usersArray, ["id"=>"909", "sigla" => "Todos"]);// add 'unassigned' user
//  return response()->json([
//     $usercomum
//      ]);
 return response()->json([

               "data" => $events->
         where("start_date", "<", $to)->
         whereIn('subject',[5,9,1])->
         whereIn('fk_tecnico',[$usr->bi,0])->
         where("end_date", ">=", $from)->get(),
 
        "collections" =>[ "users" => array_map(function ($users) {
            return [
                 
                 "value" => $users["bi"],
                 "label" => $users["sigla"].' (' .$users['name'].')'
             ];
         },
          $usersArray
     ),]]
 );
 }
    public function get(Request $request){
        if ($request->id==null) {
            $request->id=Auth::id();
        }else {
            $request->id=$request->id;
        }
        $user = user::find($request->id);
        return view('ver/feriasUser', compact('user'));
    }


    public function store(Request $request){
    $abreviatura='';
    $array = explode(',', $request->fk_tecnico);
    // return response()->json([
    //         $array
    //          ]);
    for ($i=0; $i <count($array) ; $i++)  {
  
        $users=user::where('bi',$array[$i])->value('sigla');
        $abreviatura=$users.' + '.$abreviatura;

  
    }
 
     $last= $abreviatura[strlen($abreviatura) - 2];
    if ($last=='+') {
      $participantes= substr($abreviatura, 0, -2);
    } else {
    # code...
        }
    // return response()->json([
    //         $last
    //          ]);
        $event = new Event();
       
        $event->text =$participantes.'->'. strip_tags($request->text);
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->subject = $request->subject;
        $event->fk_tecnico = $request->bi;
        $event->obs = $request->obs;
        $event->localizacao = $request->localizacao;
     $event->save();
if ($event->subject==3) {
    # reuniao
}elseif ($event->subject==4) {
 #Call Skype
}elseif ($event->subject==7) { 
    #formaçao
}elseif ($event->subject==8) {
#outros
}

        return response()->json([
            "action"=> "inserted",
            "tid" => $event->id
        ]);
    }
  
    public function update($id, Request $request){
        $event = Event::find($id);
       $texto= explode("->",$event->text);
       $texto[count($texto)-1];
        $abreviatura='';
        $array = explode(',', $request->fk_tecnico);
        for ($i=0; $i <count($array) ; $i++)  {
      
            $users=user::where('id',$array[$i])->value('sigla');
            $abreviatura=$users.'+'.$abreviatura;
    
      
        }
    
         $last= $abreviatura[strlen($abreviatura) - 1];
        if ($last=='+') {
          $participantes= substr($abreviatura, 0, -1);
        } else {
        # code...
            }


        $event->text =$participantes.'->'. strip_tags($request->text);

        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->subject = $request->subject;
        $event->fk_tecnico = $request->bi;
        $event->obs = $request->obs;
        $event->localizacao = $request->localizacao;
        $event->save();
  
        return response()->json([
            "action"=> "updated"
        ]);
    }
  
    public function destroy($id){
        $event = Event::find($id);
        $event->delete();
  
        return response()->json([
            "action"=> "deleted"
        ]);
    }
}
