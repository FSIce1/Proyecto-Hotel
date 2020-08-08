<?php

use Illuminate\Database\Seeder;
use proyecto_inicial\User;

class UsersTableSeeder extends Seeder{
    
    public function run(){
        factory(User::class,20)->create();
    }
    
}
