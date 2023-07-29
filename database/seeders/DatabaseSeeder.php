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
        DB::table('animes')->insert([
            'title' => 'aaa',
            'url' => 'aaa.com',
        ]);
        
        DB::table('users')->insert([
            'name' => 'aaa',
            'email' => 'aaa@gmail.com',
            'password' => Hash::make('qwertyuiop'),
        ]);
        
        DB::table('posts')->insert([
                'title' => '命名の心得',
                'body' => '命名はデータを基準に考える',
                'image_url' => 'aaa.com',
                'user_id' => 1,
                'anime_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
}
