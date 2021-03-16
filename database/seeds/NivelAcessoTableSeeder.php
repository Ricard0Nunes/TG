<?php

use Illuminate\Database\Seeder;

class NivelAcessoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table  is empty
        if(DB::table('nivel_acessos')->get()->count() == 0){
            
            DB::table('nivel_acessos')->insert([

                // [
                //     'nivel' => 'Valor a ser Introduzido',
                //     'created_at' => Introduzir a sintax correcta de date.(date('Y-m-d H:i:s'))
                //     'updated_at' => Introduzir a sintax correcta de date.(date('Y-m-d H:i:s'))
                // ],

                [
                    'nivel' => 'Administrador',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricaoTitulo' => 'RH',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricaoTitulo' => 'Gestor',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricaoTitulo' => 'Tecnico',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
               
                


            ]);

        } else { echo "\e[31mTabela não está vazia. "; }

    }
}
