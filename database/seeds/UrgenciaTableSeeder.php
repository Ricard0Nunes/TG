<?php

use Illuminate\Database\Seeder;

class UrgenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     if(DB::table('urgencias')->get()->count() == 0){
        DB::table('urgencias')->insert([

      

            [
                'descricaoUrgencia' => 'Emergente',
                'pesoUrgencia'=>'1.5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descricaoUrgencia' => 'Urgente',
                'pesoUrgencia'=>'1.25',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descricaoUrgencia' => 'Pouco Urgente',
                'pesoUrgencia'=>'1.05',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descricaoUrgencia' => 'Não Urgente',
                'pesoUrgencia'=>'1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]


        ]);
    }
}
}
