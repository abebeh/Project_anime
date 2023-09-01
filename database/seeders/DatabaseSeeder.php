<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Datetime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        
        $this->call(AnimeSeeder::class);            
        
        DB::table('users')->insert([
            'name' => 'aaa',
            'email' => 'aa@gmail.com',
            'password' => Hash::make('qwertyuiop'),
        ]);
        
        
    }
}
