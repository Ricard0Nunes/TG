<?php

use Illuminate\Database\Seeder;

class EstadoProjetosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         if(DB::table('estadoprojetos')->get()->count() == 0){
           
            DB::table('estadoprojetos')->insert([

              

                [
                    'descricaoEstado' => 'Aberto',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricaoEstado' => 'Pendente',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricaoEstado' => 'Reaberto',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricaoEstado' => 'Concluido',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);

        } else { echo "\e[31mTabela não está vazia. "; }
    }
}
