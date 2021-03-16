<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = area::get();
        return view('mostrar/projetoarea', compact('a'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/area');
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

            'area' => 'required',
            'visivel' => 'required',
           
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/novaarea')->withInput()->withErrors($validator);
            }
            $area = new area;
            $area->projArea = $request['area'];
            $area->visivel = $request['visivel'];
            
            $area->save();
      
     
            \Session::flash('success', 'A Área '. $area->projArea .' foi criada com sucesso');
    
            // escrever log 
            return Redirect::to('/projetoarea');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = area::find($id);
        return view('editar/area', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $validator =  Validator::make($request->all(), [
            'area' => 'required',
            'visivel' => 'required',
           
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/editarea/'.$id)->withInput()->withErrors($validator);
            }
            $area = area::find($id);
            $area->projArea = $request->area;
            $area->visivel = $request->visivel;
          
            $area->save();
      
     
            \Session::flash('success', 'A Área '. $area->projArea .' foi editada com sucesso');
    
            // escrever log 
            return Redirect::to('/projetoarea');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
