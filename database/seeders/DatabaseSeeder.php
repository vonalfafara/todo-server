<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Status;
use \App\Models\Todo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        
        Status::factory()->create([
            'name' => 'Not Started',
        ]);
        Status::factory()->create([
            'name' => 'Ongoing',
        ]);
        Status::factory()->create([
            'name' => 'Completed',
        ]);

        Todo::factory(500)->create();
    }
}
