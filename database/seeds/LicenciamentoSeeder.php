<?php

use Illuminate\Database\Seeder;

class LicenciamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

 


         



    for ($a=0; $a<50; $a++){
        {
            $template   = 'XX99-XX99-99XX-99XX-XXXX-99XX';
            $k = strlen($template);
            $sernum = '';
            for ($i=0; $i<$k; $i++)
            {
                switch($template[$i])
                {
                    case 'X': $sernum .= chr(rand(65,90)); break;
                    case '9': $sernum .= rand(0,9); break;
                    case '-': $sernum .= '-';  break; 
                }
            }
            DB::connection('licenciamento')->table('serial')->insert([
                [
                    'sn' => $sernum,
                    'ativo'=> '0',
                    'tipoSN'=> '0',
               
                ],
                ]);
        }
    }
    
}}
