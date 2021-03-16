<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        if(DB::table('departamentos')->get()->count() == 0){

            DB::table('departamentos')->insert([
                [
                    'descricao' => 'Administração',
                    'abreviatura' => 'ADM',
                    'created_at' => Carbon::now(),
                ],
                [
                'descricao' => 'Sistemas de Informação',
                'abreviatura' => 'S.I.',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Recursos Humanos',
                'abreviatura' => 'R.H.',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Marketing',
                'abreviatura' => 'M.K.T.',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Contabilidade',
                'abreviatura' => 'CONT.',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Gestão e Execução de Projetos',
                'abreviatura' => 'G.E.P.',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Qualidade Ambiente e Segurança',
                'abreviatura' => 'Q.A.S.',
                'created_at' => Carbon::now(),
            ],
            [
                'descricao' => 'Projetos Gestão e Inovação',
                'abreviatura' => 'PRJ.',
                'created_at' => Carbon::now(),
            ],
            
                              
            ]);
        } else { echo "A Tabela não está vazia. "; }
    }


}
