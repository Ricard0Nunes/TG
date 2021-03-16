<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TipoPicagensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::connection('geraltg')->table('tipopicagens')->get()->count() == 0){

            DB::connection('geraltg')->table('tipopicagens')->insert([
                [
                'descricao' => 'Entrada',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Saída Manhã',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Entrada Tarde',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Saída',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Editado',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Falta',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Ausencia',
                'created_at' => Carbon::now(),
            ],
               
                           
            ]);
        } else { echo "A Tabela não está vazia. "; }
    }
}
