<?php

use Illuminate\Database\Seeder;

class JustificacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::connection('geraltg')->table('justificacoes')->get()->count() == 0){

           DB::connection('geraltg')->table('justificacoes')->insert([



            
                [
                    'descricao' => 'Doença C/ Baixa',
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Doença S/ Baixa',
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Falecimento Familiares 1º Grau',
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 1,                  
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Falecimento Familiares 2º Grau',    
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 1,              
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Assistência à Familia S/Retribuição',  
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 0,                
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Assistência à Familia C/Retribuição',   
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 1,               
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Licença de Maternidade',    
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 0,              
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Nascimento de Filhos(PAI)',  
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 0,                
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Dispensa Exames Escolares',  
                    'duracaoHoras'=> 2,
                    'comRetribuicao'=> 1,                
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Consultas Médicas ou Tratamentos Médicos',       
                    'duracaoHoras'=> 2,
                    'comRetribuicao'=> 1,               
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Comparência em Organismos Oficiais',   
                    'duracaoHoras'=> 2,
                    'comRetribuicao'=> 1,                   
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Acidentes de Trabalho',      
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 0,                
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ], 
                [
                    'descricao' => 'Férias ',      
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 1,                
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Outro - Descrever no campo comentário ',        
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 0,              
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Fora da Empresa ',    
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 1,    
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Folga de Compensação ', 
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 1,                  
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Feriado ', 
                    'duracaoHoras'=> 0,
                    'comRetribuicao'=> 0,                  
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Day Off', 
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 1,                  
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'descricao' => 'Tolerância ', 
                    'duracaoHoras'=> 1,
                    'comRetribuicao'=> 1,                  
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);

            } else 
            { echo "\e A Tabela não está vazia. "; 
            }
    
     }
 }

