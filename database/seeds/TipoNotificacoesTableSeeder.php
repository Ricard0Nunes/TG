<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TipoNotificacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('tiponotificacoes')->get()->count() == 0){

            DB::table('tiponotificacoes')->insert([
                [
                'descricao' => 'Tarefas',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Ponto',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Ausencias',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Eventos',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Requisicoes',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Correspondencia',
                'created_at' => Carbon::now(),
            ],
                              
            ]);
        } else { echo "A Tabela não está vazia. "; }
    }
}
