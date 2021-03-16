<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EstadoIntervencoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('estadointervencoes')->get()->count() == 0){

            DB::table('estadointervencoes')->insert([
                [
                'descricao' => 'Agendada',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Em Curso',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Concluida',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Reagendada',
                'created_at' => Carbon::now(),
            ],
              [
                'descricao' => 'Em Pausa',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Cancelada',
                'created_at' => Carbon::now(),
            ],
                              
            ]);
        } else { echo "A Tabela não está vazia. "; }
    }
}
