<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(UrgenciaTableSeeder::class);
         $this->call(DepartamentosTableSeeder::class);
         $this->call(EstadoProjetosTableSeeder::class);
         $this->call(EstadoIntervencoesTableSeeder::class);
         $this->call(TipoPicagensTableSeeder::class);
         $this->call(TipoNotificacoesTableSeeder::class);
        $this->call(JustificacoesTableSeeder::class);
        $this->call(NivelAcessoTableSeeder::class);
        $this->call(LicenciamentoSeeder::class);


        
         
    }
}
