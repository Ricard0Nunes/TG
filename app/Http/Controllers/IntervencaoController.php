<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class IntervencaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
return Task::where('tipo',2)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Intervencao  $intervencao
     * @return \Illuminate\Http\Response
     */
    public function show(Intervencao $intervencao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Intervencao  $intervencao
     * @return \Illuminate\Http\Response
     */
    public function edit(Intervencao $intervencao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Intervencao  $intervencao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intervencao $intervencao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Intervencao  $intervencao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intervencao $intervencao)
    {
        //
    }

    public function faturaPDF(/*$id*/){
        // $pdf = \App::make('dompdf.wrapper');
        //$pdf->loadHTML('<h1>Test</h1>');
        //return $pdf->stream();

        $pdf = PDF::loadView('registo/fatura');
        return $pdf->stream();
    }
}
