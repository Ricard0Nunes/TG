<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->get()->count() == 0){

            DB::table('users')->insert([
                'sigla' => 'admin',
                'name' => 'admin',
                'password'=>bcrypt('admin'),
                'email'=>'admin@turtlegest.com',
              
                
            ]);
        } else { echo "A Tabela não está vazia. "; }
    }
}
